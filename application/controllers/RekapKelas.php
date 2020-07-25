<?php

class RekapKelas extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('rekap_pertemuan');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view("master/mastercode");
        $data['nip'] = $this->session->userdata['user_id'];
        $data['nama'] = $this->session->userdata['user_nama'];
        // $prodi = $this->getProdi($this->session->userdata['id_prodi']);
        // $data['prodi'] = $prodi->namaprod;
        $data['kelas'] = $this->getKelas();

        if ($this->session->userdata['user_role'] == '2') {
            $this->load->view("master/header/dosen/head1", $data);
        } elseif ($this->session->userdata['user_role'] == '3') {
            $this->load->view("master/header/rekap/headrekap", $data);
            $this->load->view("master/sidebar/sidebarkps");
            // $this->load->view('main/rekap/pilihbulankps', $data);
        } elseif ($this->session->userdata['user_role'] == '4') {
            $this->load->view("master/header/rekap/headrekap", $data);
            $this->load->view("master/sidebar/sidebarkps");
            // $this->load->view('main/rekap/pilihbulankps', $data);
        } elseif ($this->session->userdata['user_role'] == '5') {
            $this->load->view("master/header/rekap/headrekap", $data);
            $this->load->view("master/sidebar/sidebarkps");
            // $this->load->view('main/rekap/pilihbulankps', $data);
        } elseif ($this->session->userdata['user_role'] == '1') {
            $this->load->view("master/header/admin/headrekapadm", $data);
            $this->load->view("master/sidebar/sidebar");
            // $this->load->view('main/rekap/pilihdosen', $data);
        };
        $this->load->view('main/rekap/pilihkelas', $data);
        $this->load->view("master/footer/foot");
    }
    public function getProdi($id_prodi)
    {
        $data = $this->rekap_pertemuan->get_prodi($id_prodi);

        $this->session->set_userdata('id_mkdosen',);
        return $data;
    }
    
    public function getkelas()
    { 
        $this->load->model('kelas_mk');
        if($this->session->userdata['id_prodi'] != null) {
            // $this->load->model('kelas_mk');
            $data = $this->kelas_mk->get_kelas_prodi($this->session->userdata['id_prodi']);
        } else {
            $data = $this->kelas_mk->get_kelas_jurusan();
        }
    //    var_dump($data);exit;
        return $data;
    }

    public function getTopikPertemuan($id)
    {
        $data = $this->list_pertemuan->get_topik_cp($id);

        // var_dump($data);exit;
        return $data;
    }
}

?>