<?php

class Homebap extends CI_Controller
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
        if ($this->session->userdata['user_role'] == '2') {
            $this->load->view("master/header/dosen/head", $data);
        } elseif ($this->session->userdata['user_role'] == '3') {
            $this->load->view("master/header/kaprodi/headerkps", $data);
        } elseif ($this->session->userdata['user_role'] == '4') {
            $this->load->view("master/header/kaprodi/headerkps", $data);
        } elseif ($this->session->userdata['user_role'] == '5') {
            $this->load->view("master/header/kaprodi/headerkps", $data);
        }
        $this->load->view("master/sidebar/sidebar");
        $this->load->view('main/dosen/listmk', $data);
        $this->load->view("master/footer/foot");
    }

    public function getMatkulList()
    {
        $data = $this->list_mk->get_mkdosen($this->session->userdata['user_id']);
        echo json_encode($data);
    }
};
