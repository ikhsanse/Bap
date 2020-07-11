<?php

    class Homebap extends CI_Controller {

        function __construct()
        {
            parent::__construct();
            $this->load->model('list_mk');
        }
        
        public function index(){
            $this->load->view("master/mastercode");
            $data['nip'] = $this->session->userdata['user_id'];
            $data['nama'] = $this->session->userdata['user_nama'];
            $this->load->view("master/header/head",$data);
            // $this->load->view("master/sidebar/sidebar");
            $this->load->view('main/listmk', $data);
            $this->load->view("master/footer/foot");
        }

        public function getMatkulList(){
            $data= $this->list_mk->get_mkdosen($this->session->userdata['user_id']);
            // $data = json_encode($datamk);
            // $data = array();
            // $data['data'] = $datamk;
            // var_dump($datamk);exit;
            // var_dump($data)
            
            
            echo json_encode($data);
        }
    };
