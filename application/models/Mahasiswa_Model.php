<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_Model extends CI_Model
{
    private $_table = "mahasiswa";

    public $nim;
    public $nama_mahasiswa;
    public $alamat_mahasiswa;
    public $dosen_id;
    public $program_studi_id;
    public $user_id;

    public function rules()
    {
        return [
            ['field' => 'nim',
            'label' => 'NIM',
            'rules' => 'required'],
        ];
    }

    public function rulesedit()
    {
        return [
            ['field' => 'nim',
            'label' => 'NIM',
            'rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getWithPagination($limit, $start)
    {
        // $query = $this->db->get($this->_table, $limit, $start);
        $query = $this->db->select($this->_table.'.*, dosen.nama_dosen, program_studi.nama_prodi')
         ->from($this->_table)
         ->join('dosen', 'dosen.id = '.$this->_table.'.dosen_id')
         ->join('program_studi', 'program_studi.id = '.$this->_table.'.program_studi_id')
         ->limit($limit, $start)
         ->get();
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

    public function save()
    {
        $post = $this->input->post();

        $data_user = array(
            'username' => $post["username"],
            'password' => password_hash($post["username"], PASSWORD_DEFAULT),
            'full_name' => $post["nama_mahasiswa"],
            'role' => 3,
            'is_active' => 1,
        );

        $this->db->insert('users', $data_user);
        $last_user_id = $this->db->insert_id();

        $data_insert = array(
            'nim' => $post["nim"],
            'nama_mahasiswa' => $post["nama_mahasiswa"],
            'alamat_mahasiswa' => $post["alamat_mahasiswa"],
            'dosen_id' => $post["dosen_id"],
            'program_studi_id' => $post["program_studi_id"],
            'user_id' => $last_user_id,
            'tahun_masuk' => $post["tahun_masuk"],
        );

        return $this->db->insert($this->_table, $data_insert);
    }

    public function update()
    {
        $post = $this->input->post();

        $data_update = array(
            'nim' => $post["nim"],
            'nama_mahasiswa' => $post["nama_mahasiswa"],
            'alamat_mahasiswa' => $post["alamat_mahasiswa"],
            'dosen_id' => $post["dosen_id"],
            'program_studi_id' => $post["program_studi_id"],
            'tahun_masuk' => $post["tahun_masuk"],
        );

        $mahasiswa = $this->db->get_where($this->_table, ["id" => $post['id']])->row();
        if ($mahasiswa) {
            $data_update_user = array(
                'full_name' => $post["nama_mahasiswa"],
            );
            $this->db->update('users', $data_update_user, array('id' => $mahasiswa->user_id));
        }

        return $this->db->update($this->_table, $data_update, array('id' => $post['id']));
    }

    public function delete($id)
    {
        $data = [];
        $data['status'] = 'failed';
        $data['message'] = '';

        $mahasiswa = $this->db->get_where($this->_table, ["id" => $id])->row();

        if ($mahasiswa) {
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

        if ($mahasiswa) {
            $this->db->delete('users', array("id" => $mahasiswa->user_id));
        }

        return $data;
    }
}
