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

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
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

        return $this->db->insert($this->_table, $data_insert);
    }

    public function update()
    {
        $post = $this->input->post();

        $data_update = array(
            'nip' => $post["nip"],
            'nama_dosen' => $post["nama_dosen"],
            'alamat_dosen' => $post["alamat_dosen"],
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
        }

        return $data;
    }
}
