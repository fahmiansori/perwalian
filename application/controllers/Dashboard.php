<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        if($this->user_model->isNotLogin()) redirect(site_url('login'));
        $this->load->model("jadwal_perwalian_model");
    }

    public function index()
    {
        $user_logged = $this->session->userdata("user_logged");

        $data = [];

        if ($user_logged->role === '2') {
            $dosen = $this->db->get_where('dosen', ["user_id" => $user_logged->id])->row();
            $dosen_id = $dosen->id;
            $this->db->where('jadwal_perwalian.dosen_id', $dosen_id);
        }elseif ($user_logged->role === '3') {
            $mahasiswa = $this->db->get_where('mahasiswa', ["user_id" => $user_logged->id])->row();
            $nim = $mahasiswa->nim;
            $this->db->where('jadwal_perwalian.nim', $nim);
        }
        $data['all'] = $this->db->from('jadwal_perwalian')->count_all_results();

        if ($user_logged->role === '2') {
            $dosen = $this->db->get_where('dosen', ["user_id" => $user_logged->id])->row();
            $dosen_id = $dosen->id;
            $this->db->where('jadwal_perwalian.dosen_id', $dosen_id);
        }elseif ($user_logged->role === '3') {
            $mahasiswa = $this->db->get_where('mahasiswa', ["user_id" => $user_logged->id])->row();
            $nim = $mahasiswa->nim;
            $this->db->where('jadwal_perwalian.nim', $nim);
        }
        $data['waiting'] = $this->db->from('jadwal_perwalian')->where('jadwal_perwalian.status', 'waiting')->count_all_results();

        if ($user_logged->role === '2') {
            $dosen = $this->db->get_where('dosen', ["user_id" => $user_logged->id])->row();
            $dosen_id = $dosen->id;
            $this->db->where('jadwal_perwalian.dosen_id', $dosen_id);
        }elseif ($user_logged->role === '3') {
            $mahasiswa = $this->db->get_where('mahasiswa', ["user_id" => $user_logged->id])->row();
            $nim = $mahasiswa->nim;
            $this->db->where('jadwal_perwalian.nim', $nim);
        }
        $data['onprocess'] = $this->db->from('jadwal_perwalian')->where('jadwal_perwalian.status', 'onprocess')->count_all_results();

        if ($user_logged->role === '2') {
            $dosen = $this->db->get_where('dosen', ["user_id" => $user_logged->id])->row();
            $dosen_id = $dosen->id;
            $this->db->where('jadwal_perwalian.dosen_id', $dosen_id);
        }elseif ($user_logged->role === '3') {
            $mahasiswa = $this->db->get_where('mahasiswa', ["user_id" => $user_logged->id])->row();
            $nim = $mahasiswa->nim;
            $this->db->where('jadwal_perwalian.nim', $nim);
        }
        $data['done'] = $this->db->from('jadwal_perwalian')->where('jadwal_perwalian.status', 'done')->count_all_results();

        if ($user_logged->role === '2') {
            $dosen = $this->db->get_where('dosen', ["user_id" => $user_logged->id])->row();
            $dosen_id = $dosen->id;
            $this->db->where('jadwal_perwalian.dosen_id', $dosen_id);
        }elseif ($user_logged->role === '3') {
            $mahasiswa = $this->db->get_where('mahasiswa', ["user_id" => $user_logged->id])->row();
            $nim = $mahasiswa->nim;
            $this->db->where('jadwal_perwalian.nim', $nim);
        }
        $data['data_jadwal'] = [];
        $data_ = $this->db->select('jadwal_perwalian.*, dosen.nama_dosen, mahasiswa.nama_mahasiswa, users.full_name, perwalian.isi_perwalian')
          ->from('jadwal_perwalian')
          ->join('dosen', 'dosen.id = '.'jadwal_perwalian.dosen_id')
          ->join('mahasiswa', 'mahasiswa.nim = '.'jadwal_perwalian.nim')
          ->join('users', 'users.id = '.'jadwal_perwalian.user_id')
          ->join('perwalian', 'perwalian.jadwal_perwalian_id = '.'jadwal_perwalian.id','left')
          ->where('jadwal_perwalian.status != \'waitingapproval\'')
          ->get();

        foreach ($data_->result() as $key) {
            $data_temp = [];
            $data_temp['id'] = $key->id;
            $data_temp['calendarId'] = '1';
            $data_temp['title'] = $key->nama_mahasiswa;
            if ($user_logged->role === '1') {
                $data_temp['title'] = $key->nama_dosen.': '.$key->nama_mahasiswa;
            }
            $data_temp['category'] = 'time';
            $data_temp['dueDateClass'] = 'text-danger';
            $data_temp['start'] = date("Y-m-d H:i:s+07:00", strtotime($key->waktu));
            $data_temp['end'] = date('Y-m-d H:i:s+07:00', strtotime($key->waktu.'+1hour'));
            $data_temp['isReadOnly'] = true;

            $data['data_jadwal'][] = $data_temp;
        }
        $data['data_jadwal_json'] = json_encode($data['data_jadwal']);
        // echo $data['data_jadwal_json'];
        // exit();

        $this->load->view('app/dashboard', $data);
    }
}
