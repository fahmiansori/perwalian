<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen_Model extends CI_Model
{
    private $_table = "dosen";

    public $nip;
    public $nama_dosen;
    public $alamat_dosen;
    public $user_id;

    public function rules()
    {
        return [
            ['field' => 'nama_dosen',
            'label' => 'Nama',
            'rules' => 'required'],
        ];
    }

    public function rulesedit()
    {
        return [
            ['field' => 'nama_dosen',
            'label' => 'Nama',
            'rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getWithPagination($limit, $start)
    {
        $query = $this->db->get($this->_table, $limit, $start);
        return $query;
    }

    public function getWithPaginationMB($limit, $start, $dosen_id)
    {
        // Mahassiwa bimbingan
        $query = $this->db->select('mahasiswa.*, (select count(*) from jadwal_perwalian jp where jp.nim=jadwal_perwalian.nim) as jumlah_perwalian')
         ->from('jadwal_perwalian')
         ->join('dosen', 'dosen.id = jadwal_perwalian.dosen_id')
         ->join('mahasiswa', 'mahasiswa.nim = jadwal_perwalian.nim')
         ->join('users', 'users.id = jadwal_perwalian.user_id')
         ->join('perwalian', 'perwalian.jadwal_perwalian_id = jadwal_perwalian.id','left')
         ->where('jadwal_perwalian.dosen_id', $dosen_id)
         ->limit($limit, $start)
         ->group_by('mahasiswa.nim')
         ->get();
        return $query;
    }

    public function getJadwalWithPaginationCondition($limit, $start, $nim, $cond='')
    {
        $user_logged = $this->session->userdata("user_logged");
        $dosen = $this->db->get_where('dosen', ["user_id" => $user_logged->id])->row();
        $dosen_id = $dosen->id;

        $this->db->where('jadwal_perwalian.dosen_id', $dosen_id);
        $this->db->where('jadwal_perwalian.nim', $nim);

        if (!empty($cond)) {
            $this->db->where('jadwal_perwalian.status', $cond);
        }

        $this->db->select('jadwal_perwalian.*, dosen.nama_dosen, mahasiswa.nama_mahasiswa, users.full_name, perwalian.isi_perwalian')
         ->from('jadwal_perwalian')
         ->join('dosen', 'dosen.id = '.'jadwal_perwalian.dosen_id')
         ->join('mahasiswa', 'mahasiswa.nim = '.'jadwal_perwalian.nim')
         ->join('users', 'users.id = '.'jadwal_perwalian.user_id')
         ->join('perwalian', 'perwalian.jadwal_perwalian_id = '.'jadwal_perwalian.id', 'left')
         ->order_by('jadwal_perwalian.waktu', 'desc')
         ->limit($limit, $start);

         $query = $this->db->get();
        return $query;
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function getByIdUser($user_id)
    {
        return $this->db->get_where($this->_table, ["user_id" => $user_id])->row();
    }

    private function _uploadImage($file_name)
    {
        $config['upload_path']          = './assets/images/tanda_tangan';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $file_name;
        $config['overwrite']			= true;
        $config['max_size']             = 10240; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('tanda_tangan')) {
            return $this->upload->data("file_name");
        }

        return "default.jpg";
    }

    public function save()
    {
        $post = $this->input->post();

        $data_user = array(
            'username' => $post["username"],
            'password' => password_hash($post["username"], PASSWORD_DEFAULT),
            'full_name' => $post["nama_dosen"],
            'role' => 2,
            'is_active' => 1,
        );

        $this->db->insert('users', $data_user);
        $last_user_id = $this->db->insert_id();

        $data_insert = array(
            'nip' => $post["nip"],
            'nama_dosen' => $post["nama_dosen"],
            'alamat_dosen' => $post["alamat_dosen"],
            'user_id' => $last_user_id,
        );

        $insert = $this->db->insert($this->_table, $data_insert);
        $last_dosen_id = $this->db->insert_id();

        if (!empty($_FILES["tanda_tangan"]["name"])) {
            $tanda_tangan_ = $this->_uploadImage($last_dosen_id);
            $data_update = array(
                'tanda_tangan' => $tanda_tangan_,
            );
            $this->db->update($this->_table, $data_update, array('id' => $last_dosen_id));
        } else {
            $tanda_tangan_ = '';
        }

        return $insert;
    }

    public function update()
    {
        $post = $this->input->post();

        if (!empty($_FILES["tanda_tangan"]["name"])) {
            $tanda_tangan_ = $this->_uploadImage($post['id']);
        } else {
            $tanda_tangan_ = $post["old_tanda_tangan"];
        }

        $data_update = array(
            'nip' => $post["nip"],
            'nama_dosen' => $post["nama_dosen"],
            'alamat_dosen' => $post["alamat_dosen"],
            'tanda_tangan' => $tanda_tangan_,
        );

        $dosen = $this->db->get_where($this->_table, ["id" => $post['id']])->row();
        if ($dosen) {
            $data_update_user = array(
                'full_name' => $post["nama_dosen"],
            );
            $this->db->update('users', $data_update_user, array('id' => $dosen->user_id));
        }

        return $this->db->update($this->_table, $data_update, array('id' => $post['id']));
    }

    public function delete($id)
    {
        $data = [];
        $data['status'] = 'failed';
        $data['message'] = '';

        $dosen = $this->db->get_where($this->_table, ["id" => $id])->row();
        // $delete_dosen = $this->db->delete($this->_table, array("id" => $id));
        if ($dosen) {
            try {
                $db_debug_temp = $this->db->db_debug;
                $this->db->db_debug = FALSE;
                $this->db->delete($this->_table, array("id" => $id));

                $db_error = $this->db->error();
                $this->db->db_debug = $db_debug_temp;
                if (!empty($db_error) && $db_error['code'] != 0 && !empty($db_error['message'])) {
                    throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                    return $data;
                }

                $data['status'] = 'success';
                $data['message'] = 'Data telah dihapus';
            } catch (Exception $e) {
                log_message('error: ',$e->getMessage());
                $data['message'] = $e->getMessage();
                return $data;
            }
        }

        if ($dosen) {
            $this->db->delete('users', array("id" => $dosen->user_id));
            $this->_deleteImage($dosen);
        }

        return $data;
    }

    private function _deleteImage($dosen)
    {
        if ($dosen->tanda_tangan != "default.jpg") {
            $filename = explode(".", $dosen->tanda_tangan)[0];
            return array_map('unlink', glob(FCPATH."assets/images/tanda_tangan/$filename.*"));
        }
    }


    public function countMahasiswaBimbingan($dosen_id)
    {
        return $this->db->select('mahasiswa.*, (select count(*) from jadwal_perwalian jp where jp.nim=jadwal_perwalian.nim) as jumlah_perwalian')
         ->from('jadwal_perwalian')
         ->join('dosen', 'dosen.id = jadwal_perwalian.dosen_id')
         ->join('mahasiswa', 'mahasiswa.nim = jadwal_perwalian.nim')
         ->join('users', 'users.id = jadwal_perwalian.user_id')
         ->join('perwalian', 'perwalian.jadwal_perwalian_id = jadwal_perwalian.id','left')
         ->where('jadwal_perwalian.dosen_id', $dosen_id)
         ->group_by('mahasiswa.nim')
         ->count_all_results();
    }

    public function countMahasiswaBimbinganDetail($nim, $cond='')
    {
        $user_logged = $this->session->userdata("user_logged");
        $dosen = $this->db->get_where('dosen', ["user_id" => $user_logged->id])->row();
        $dosen_id = $dosen->id;

        $this->db->where('jadwal_perwalian.dosen_id', $dosen_id);
        $this->db->where('jadwal_perwalian.nim', $nim);

        if (!empty($cond)) {
            $this->db->where('jadwal_perwalian.status', $cond);
        }

        $this->db->select('jadwal_perwalian.*, dosen.nama_dosen, mahasiswa.nama_mahasiswa, users.full_name, perwalian.isi_perwalian')
         ->from('jadwal_perwalian')
         ->join('dosen', 'dosen.id = '.'jadwal_perwalian.dosen_id')
         ->join('mahasiswa', 'mahasiswa.nim = '.'jadwal_perwalian.nim')
         ->join('users', 'users.id = '.'jadwal_perwalian.user_id')
         ->join('perwalian', 'perwalian.jadwal_perwalian_id = '.'jadwal_perwalian.id', 'left')
         ->order_by('jadwal_perwalian.waktu', 'desc');

        return $this->db->count_all_results();
    }
}
