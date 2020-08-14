<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->library('form_validation');
        $this->load->library('pagination');
    }

    public function index()
    {
        $data["data"] = $this->user_model->getAll();
        $this->load->view("app/user/list", $data);
    }

    function indexpage(){
        //konfigurasi pagination
        $config['base_url'] = site_url('user/indexpage'); //site url
        $config['total_rows'] = $this->db->count_all('users'); //total row
        $config['per_page'] = 4;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //panggil function getWithPagination yang ada pada model model.
        $data['data'] = $this->user_model->getWithPagination($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

        //load view data view
        $this->load->view('app/user/list_page',$data);
    }

    public function add()
    {
        $model = $this->user_model;
        $validation = $this->form_validation;
        $validation->set_rules($model->rules());

        if ($validation->run()) {
            $model->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("app/user/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect(site_url('user'));

        $model = $this->user_model;
        $validation = $this->form_validation;
        $validation->set_rules($model->rulesedit());

        if ($validation->run()) {
            $model->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["data_detail"] = $model->getById($id);
        if (!$data["data_detail"]) show_404();

        $this->load->view("app/user/edit_form", $data);
    }

    public function resetpassword($id = null)
    {
        if (!isset($id)) redirect(site_url('user'));

        $model = $this->user_model;

        $model->resetpassword($id);
        $this->session->set_flashdata('success', 'Berhasil direset');

        redirect(site_url('user'));
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->user_model->delete($id)) {
            redirect(site_url('user'));
        }
    }
}
