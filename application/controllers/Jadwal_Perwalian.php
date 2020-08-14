<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_Perwalian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("jadwal_perwalian_model");
        $this->load->library('form_validation');
        $this->load->library('pagination');
    }

    function index(){
        $config['base_url'] = site_url('jadwal_perwalian');
        $config['total_rows'] = $this->db->count_all('jadwal_perwalian');
        $config['per_page'] = 4;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

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

        $data['data'] = $this->jadwal_perwalian_model->getWithPagination($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

        $data['today'] = date('Y-m-d H:i:s');

        $this->load->view('app/jadwal_perwalian/list_page',$data);
    }

    protected function indexcondition($cond){
        $config['base_url'] = site_url('jadwal_perwalian');
        $config['total_rows'] = $this->db->count_all('jadwal_perwalian');
        $config['per_page'] = 4;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

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

        $data['data'] = $this->jadwal_perwalian_model->getWithPaginationCondition($config["per_page"], $data['page'], $cond);

        $data['pagination'] = $this->pagination->create_links();

        $data['today'] = date('Y-m-d H:i:s');

        $this->load->view('app/jadwal_perwalian/list_page',$data);
    }

    public function menunggu()
    {
        $this->indexcondition('waiting');
    }
    public function dibatalkan()
    {
        $this->indexcondition('canceled');
    }
    public function telah_lewat()
    {
        $this->indexcondition('expired');
    }
    public function berlangsung()
    {
        $this->indexcondition('onprocess');
    }
    public function selesai()
    {
        $this->indexcondition('done');
    }

    protected function updatestatus($id, $url, $status)
    {
        $data_update = array(
            'status' => $status,
        );
        $this->db->update('jadwal_perwalian', $data_update, array('id' => $id));

        redirect(site_url('jadwal_perwalian/'.implode('/',explode('-',$url))));
    }

    public function batalkan($id, $url=null)
    {
        $this->updatestatus($id, $url, 'canceled');
    }

    public function bimbingan($id, $url=null)
    {
        $this->updatestatus($id, $url, 'onprocess');
    }

    public function selesaikan($id, $url=null)
    {
        $this->updatestatus($id, 'editisi-'.$id, 'done');
    }

    public function editisi($id = null)
    {
        if (!isset($id)) redirect(site_url('jadwal_perwalian'));

        $model = $this->jadwal_perwalian_model;
        $validation = $this->form_validation;
        $validation->set_rules($model->ruleseditisi());

        if ($validation->run()) {
            $model->updateisi();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $data = [];

        $data["data_detail"] = $model->getById($id);
        if (!$data["data_detail"]) show_404();
        $data["data_detail_perwalian"] = $this->db->get_where('perwalian', ["jadwal_perwalian_id" => $data["data_detail"]->id])->row();
        if ($data["data_detail_perwalian"]) {}
        else {
            $data_insert = array(
                'jadwal_perwalian_id' => $data["data_detail"]->id,
            );

            $this->db->insert('perwalian', $data_insert);
            $last_insert_id = $this->db->insert_id();
            $data["data_detail_perwalian"] = $this->db->get_where('perwalian', ["jadwal_perwalian_id" => $data["data_detail"]->id])->row();
        }

        $this->load->view("app/jadwal_perwalian/edit_form_isi", $data);
    }

    public function add()
    {
        $model = $this->jadwal_perwalian_model;
        $validation = $this->form_validation;
        $validation->set_rules($model->rules());

        if ($validation->run()) {
            $model->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $data = [];
        $data['dosen'] = $this->db->get('dosen')->result();
        $data['mahasiswa'] = $this->db->get('mahasiswa')->result();

        $this->load->view("app/jadwal_perwalian/new_form",$data);
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect(site_url('jadwal_perwalian'));

        $model = $this->jadwal_perwalian_model;
        $validation = $this->form_validation;
        $validation->set_rules($model->rulesedit());

        if ($validation->run()) {
            $model->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $data = [];
        $data['dosen'] = $this->db->get('dosen')->result();
        $data['mahasiswa'] = $this->db->get('mahasiswa')->result();

        $data["data_detail"] = $model->getById($id);
        if (!$data["data_detail"]) show_404();

        $this->load->view("app/jadwal_perwalian/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        $delete = $this->jadwal_perwalian_model->delete($id);

        if ($delete['status'] == 'success') {
            $this->session->set_flashdata('success', $delete['message']);
        }else {
            $this->session->set_flashdata('failed', $delete['message']);
        }

        redirect(site_url('jadwal_perwalian'));
    }
}
