<?php
class Auth extends CI_Controller
{
    // var $api_server;

    function __construct()
    {
        parent::__construct();
        // $this->load->helper('url_helper');
        // $this->load->library('form_validation');
        // $this->load->library('session');
        $this->load->model('user_dosen');
        // $this->api_server = $this->config->item('api_server'); 
        // var_dump($this->api_server);exit;
    }

    public function index()
    {
        $this->load->view("master/mastercode");
        $this->load->view("master/header/headlogin");

        if ($this->user_dosen->logged_in()) {
            redirect("homebap");
        } else {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            $this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
                    <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

            if ($this->form_validation->run() == true) {

                $username = $this->input->post('username', true);
                $pass = $this->input->post('password', true);
                // var_dump($pass);exit;
                $password = sha1($username . $pass);
                // var_dump($password);exit;

                $checking = $this->user_dosen->check_login($username, $password);

                if ($checking == false) {
                    $data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
                    <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> username atau password salah!</div></div>';
                    $this->load->view("main/login", $data);
                } else {
                    foreach ($checking as $check) {
                        // var_dump($check->nip);exit;
                        $session_data = array(
                            'user_id' => $check->nip,
                            'user_pass' => $check->password,
                            'user_nama' => $check->nama
                        );
                        // var_dump($session_data['user_id']);exit;
                        $this->session->set_userdata($session_data);
                        // var_dump($this->session->userdata);exit;
                        redirect('homebap', $session_data);
                    }
                }
            } else {
                $this->load->view("main/login");
            }
        }

        $this->load->view("master/footer/foot");
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('auth');
    }
}
