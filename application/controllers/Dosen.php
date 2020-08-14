<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("dosen_model");
        $this->load->library('form_validation');
        $this->load->library('pagination');
    }

    function index(){
        //konfigurasi pagination
        $config['base_url'] = site_url('dosen'); //site url
        $config['total_rows'] = $this->db->count_all('dosen'); //total row
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
        $data['data'] = $this->dosen_model->getWithPagination($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

        //load view data view
        $this->load->view('app/dosen/list_page',$data);
    }

    public function add()
    {
        $model = $this->dosen_model;
        $validation = $this->form_validation;
        $validation->set_rules($model->rules());

        if ($validation->run()) {
            $model->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("app/dosen/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect(site_url('dosen'));

        $model = $this->dosen_model;
        $validation = $this->form_validation;
        $validation->set_rules($model->rulesedit());

        if ($validation->run()) {
            $model->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["data_detail"] = $model->getById($id);
        if (!$data["data_detail"]) show_404();

        $this->load->view("app/dosen/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        $delete = $this->dosen_model->delete($id);

        if ($delete['status'] == 'success') {
            $this->session->set_flashdata('success', $delete['message']);
        }else {
            $this->session->set_flashdata('failed', $delete['message']);
        }

        redirect(site_url('dosen'));
    }
}
