<?php
class Admin extends CI_Controller
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

        // var_dump($this->session->userdata);exit;
        $this->load->view("master/header/admin/headeradm", $data);
        // $this->load->view("master/sidebar/sidebar");
        $this->load->view('main/admin/listallkelas', $data);
        $this->load->view("master/footer/foot");
    }

    public function getAllKelas(){
 
        $data = $this->list_mk->get_all_kelas();
        // var_dump($data);exit;
        echo json_encode($data);
    }
}
