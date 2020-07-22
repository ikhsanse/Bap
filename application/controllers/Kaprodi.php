<?php
class Kaprodi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('list_mk');
    }

    public function index()
    {
        $this->load->view("master/mastercode");
        $data['nip'] = $this->session->userdata['user_id'];
        $data['nama'] = $this->session->userdata['user_nama'];
        
        if ($this->session->userdata['user_role'] == '3') {
            $data['prodi'] = '111';
            $this->session->set_userdata('id_prodi', $data['prodi']);
        } elseif ($this->session->userdata['user_role'] == '4') {
            $data['prodi'] = '113';
            $this->session->set_userdata('id_prodi', $data['prodi']);
        } elseif ($this->session->userdata['user_role'] == '5') {
            $data['prodi'] = '112';
            $this->session->set_userdata('id_prodi', $data['prodi']);
        } else {
            $this->session->set_userdata('id_prodi', null);
        }
        $this->session->set_userdata('id_prodi', $data['prodi']);
        // var_dump($this->session->userdata);exit;
        $this->load->view("master/header/kaprodi/headerkps", $data);
        $this->load->view("master/sidebar/sidebarkps");
        $this->load->view('main/kaprodi/listkelas', $data);
        $this->load->view("master/footer/foot");
    }

    public function getKelasProdi(){
        $id = $this->session->userdata['id_prodi'];
        if($id == null) {
            $data = $this->list_mk->get_all_kelas();
        } else {
            $data = $this->list_mk->get_kelas_prodi($id);
        }
        
        // var_dump($data);exit;
        echo json_encode($data);
    }
}
