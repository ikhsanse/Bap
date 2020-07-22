<?php

class Rekap extends CI_Controller {

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
        if ($this->session->userdata['user_role'] == '1') {
            $this->load->view("master/header/admin/headrekapadm1", $data);
            $this->load->view("master/sidebar/sidebar");
        }else {
            $prod = $this->getProdi($this->session->userdata['id_prodi']);
            $data['prodi'] = $prod->namaprod;
            $this->load->view("master/header/rekap/headrekap1", $data);
            $this->load->view("master/sidebar/sidebarkps");
        }

        $bulan = $this->input->post('bulan');
        $this->session->set_userdata('bulan', $bulan);       
        $this->load->view('main/rekap/rekapbulan', $data);
        $this->load->view('master/modal/modal', $data);
        $this->load->view('master/modal/modal1', $data);

        $this->load->view('master/modal/modal2', $data);
        // $this->load->view('master/modal/modaEditKps', $data);
        $this->load->view("master/footer/foot");
    }
    public function getProdi($id_prodi)
    {
        $data = $this->rekap_pertemuan->get_prodi($id_prodi);

        // $this->session->set_userdata('id_mkdosen', $id_mkdosen);
        return $data;
    }

    public function getRekapProdi() {
        $bln = $this->session->userdata['bulan'];
        $prodi = $this->session->userdata['id_prodi'];
        // var_dump($prodi);exit;
        if($prodi != null) {
            $data = $this->rekap_pertemuan->get_rekap_prodi($prodi, $bln);
        } else {
            $data = $this->rekap_pertemuan->get_rekap_jurusan($bln);
        };
      
        // var_dump($data);exit;
        echo json_encode($data);
    }

    public function getTopikPertemuan($id)
    {
        $data = $this->list_pertemuan->get_topik_cp($id);

        // var_dump($data);exit;
        return $data;
    }
}

?>