<?php
class Auth extends CI_Controller
{
    // var $api_server;

    function __construct()
    {
        parent::__construct();
        $this->load->model('users');
    }

    public function index()
    {
        $this->load->view("master/mastercode");
        $this->load->view("master/header/auth/headlogin");

        if ($this->users->logged_in()) {
            redirect("homebap");
        } else {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            $this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
                    <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

            if ($this->form_validation->run() == true) {

                $username = $this->input->post('username', true);
                $pass = $this->input->post('password', true);
                $password = sha1($pass);
                // var_dump($password);exit;
                $checking = $this->users->check_login($username, $password);
                // var_dump($checking);exit;
                if ($checking == false) {
                    $data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
                    <div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> NIP atau password salah!</div></div>';
                    $this->load->view("main/auth/login", $data);
                } else {
                    foreach ($checking as $check) {
                        $session_data = array(
                            'user_id' => $check->nip,
                            'user_pass' => $check->password,
                            'user_nama' => $check->nama,
                            'user_role' => $check->roles
                        );
                        $this->session->set_userdata($session_data);
                        if ($this->session->userdata['user_role'] == '1') {
                            redirect('admin', $session_data);
                        } elseif ($this->session->userdata['user_role'] == '2') {
                            redirect('homebap', $session_data);
                        } else {
                            redirect('kaprodi', $session_data);
                        };

                    }
                }
            } else {
                $this->load->view("main/auth/login");
            }
        }

        $this->load->view("master/footer/foot");
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
