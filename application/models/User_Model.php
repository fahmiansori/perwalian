<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model
{
    private $_table = "users";

    public $username;
    public $password;
    public $email;
    public $full_name;
    public $role;
    public $photo;
    public $is_active;

    public function doLogin(){
		$post = $this->input->post();

        // cari user berdasarkan email dan username
        $this->db->where('email', $post["username"])
                ->or_where('username', $post["username"]);
        $user = $this->db->get($this->_table)->row();

        // jika user terdaftar
        if($user){
            // periksa password-nya
            $isPasswordTrue = password_verify($post["password"], $user->password);
            // periksa role-nya
            $isAdmin = $user->role == 1;

            // jika password benar dan dia admin
            if($isPasswordTrue && $isAdmin){
                // login sukses yay!
                $this->session->set_userdata(['user_logged' => $user]);
                $this->_updateLastLogin($user->id);
                return true;
            }
        }

        // login gagal
		return false;
    }

    public function isNotLogin(){
        return $this->session->userdata('user_logged') === null;
    }

    private function _updateLastLogin($user_id){
        $sql = "UPDATE {$this->_table} SET last_login=now() WHERE id={$user_id}";
        $this->db->query($sql);
    }

    public function rules()
    {
        return [
            ['field' => 'username',
            'label' => 'Username',
            'rules' => 'required'],

            ['field' => 'full_name',
            'label' => 'Nama',
            'rules' => 'required'],

            // ['field' => 'password',
            // 'label' => 'Password',
            // 'rules' => 'required'],

            ['field' => 'role',
            'label' => 'Role',
            'rules' => 'numeric'],
        ];
    }

    public function rulesedit()
    {
        return [
            ['field' => 'username',
            'label' => 'Username',
            'rules' => 'required'],

            ['field' => 'full_name',
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

        $this->username = $post["username"];
        // $this->password = $post["password"];
        $this->password = password_hash($this->username, PASSWORD_DEFAULT);
        $this->email = $post["email"];
        $this->full_name = $post["full_name"];
        $this->role = $post["role"];
        // $this->photo = $post["photo"];
        $this->is_active = 1;
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();

        // $this->username = $post["username"];
        // $this->password = $post["password"];
        // $this->email = $post["email"];
        // $this->full_name = $post["full_name"];
        // $this->role = $post["role"];
        // $this->photo = $post["photo"];
        // $this->is_active = $post["is_active"];

        $data_update = array(
            'username' => $post["username"],
            'email' => $post["email"],
            'full_name' => $post["full_name"],
        );
        // 'role' => $post["role"],

        return $this->db->update($this->_table, $data_update, array('id' => $post['id']));
    }

    public function resetpassword($id)
    {
        $data_find = $this->db->get_where($this->_table, ["id" => $id])->row();

        $data_update = array(
            'password' => password_hash($data_find->username, PASSWORD_DEFAULT),
        );
        return $this->db->update($this->_table, $data_update, array('id' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }
}
