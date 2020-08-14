<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_Perwalian_Model extends CI_Model
{
    private $_table = "jadwal_perwalian";

    public $nim;
    public $dosen_id;
    public $user_id;
    public $waktu;
    public $status;

    public function rules()
    {
        return [
            ['field' => 'nim',
            'label' => 'NIM',
            'rules' => 'required'],

            ['field' => 'dosen_id',
            'label' => 'Dosen',
            'rules' => 'required'],
        ];
    }

    public function rulesedit()
    {
        return [
            ['field' => 'nim',
            'label' => 'NIM',
            'rules' => 'required'],

            ['field' => 'dosen_id',
            'label' => 'Dosen',
            'rules' => 'required'],
        ];
    }

    public function ruleseditisi()
    {
        return [
            ['field' => 'id',
            'label' => 'ID Jadwal',
            'rules' => 'required'],

            ['field' => 'isi_perwalian',
            'label' => 'Isi Perwalian',
            'rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getWithPagination($limit, $start)
    {
        $query = $this->db->select($this->_table.'.*, dosen.nama_dosen, mahasiswa.nama_mahasiswa, users.full_name, perwalian.isi_perwalian')
         ->from($this->_table)
         ->join('dosen', 'dosen.id = '.$this->_table.'.dosen_id')
         ->join('mahasiswa', 'mahasiswa.nim = '.$this->_table.'.nim')
         ->join('users', 'users.id = '.$this->_table.'.user_id')
         ->join('perwalian', 'perwalian.jadwal_perwalian_id = '.$this->_table.'.id','left')
         ->limit($limit, $start)
         ->get();
        return $query;
    }

    public function getWithPaginationCondition($limit, $start, $cond='')
    {
        if (empty($cond)) {
            return $this->getWithPagination($limit, $start);
        }

        $query = $this->db->select($this->_table.'.*, dosen.nama_dosen, mahasiswa.nama_mahasiswa, users.full_name, perwalian.isi_perwalian')
         ->from($this->_table)
         ->join('dosen', 'dosen.id = '.$this->_table.'.dosen_id')
         ->join('mahasiswa', 'mahasiswa.nim = '.$this->_table.'.nim')
         ->join('users', 'users.id = '.$this->_table.'.user_id')
         ->join('perwalian', 'perwalian.jadwal_perwalian_id = '.$this->_table.'.id','left')
         ->limit($limit, $start)
         ->where($this->_table.'.status', $cond)
         ->get();
        return $query;
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();

        $user_logged_id = $this->session->userdata("user_logged");
        $admin_id = (int)$user_logged_id->id;

        $waktu = $post["waktu"];
        $waktu = date('Y-m-d H:i:s', strtotime($waktu));

        $data_insert = array(
            'nim' => $post["nim"],
            'dosen_id' => $post["dosen_id"],
            'user_id' => $admin_id,
            'waktu' => $waktu,
            'status' => 'waiting',
        );
        /**
         * Status
         * 1. waiting
         * 2. canceled
         * 3. expired
         * 4. onprocess
         * 5. done
         */

        return $this->db->insert($this->_table, $data_insert);
    }

    public function update()
    {
        $post = $this->input->post();

        $waktu = $post["waktu"];
        $waktu = date('Y-m-d H:i:s', strtotime($waktu));

        $data_update = array(
            'nim' => $post["nim"],
            'dosen_id' => $post["dosen_id"],
            'waktu' => $waktu,
        );

        return $this->db->update($this->_table, $data_update, array('id' => $post['id']));
    }

    public function updateisi()
    {
        $post = $this->input->post();

        $data_update = array(
            'isi_perwalian' => $post["isi_perwalian"],
        );

        return $this->db->update('perwalian', $data_update, array('id' => $post['id']));
    }

    public function delete($id)
    {
        $data = [];
        $data['status'] = 'failed';
        $data['message'] = '';

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

        return $data;
    }
}