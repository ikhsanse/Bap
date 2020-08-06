<?php
class ListUser extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata['user_id'] == true) {
            $this->load->model('users');
            $this->load->library('form_validation');
            // $this->load->library('encrypt');
            $this->load->helper('url');
        } else {
            return redirect(site_url('auth'));
        }
    }

    public function index()
    {
        $this->load->view("master/mastercode");

        $data['nip'] = $this->session->userdata['user_id'];
        $data['nama'] = $this->session->userdata['user_nama'];
        $data['roles'] = $this->getRoles();

        $this->load->view("master/header/admin/headuseradm", $data);
        $this->load->view("master/sidebar/sidebar");

        $this->load->view('main/users/listuser', $data);
        $this->load->view("master/modal/addUser");
        $this->load->view("master/modal/editUser");

        $this->load->view("master/footer/foot");
    }

    public function getAllUser()
    {

        $data = $this->users->get_list_user();
        // var_dump($data);exit;
        echo json_encode($data);
    }

    public function getRoles()
    {
        $data = $this->users->get_roles();
        return $data;
    }
    public function addUser()
    {
        $this->form_validation->set_rules('user', 'Nama User', 'required');
        $this->form_validation->set_rules('nip', 'Nomor Induk', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('roles', 'Roles', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() != false) {

            $data['nama'] = $this->input->post('user', true);
            $data['nip'] = $this->input->post('nip', true);
            $password = $this->input->post('password', true);
            $data['password'] = sha1($password);
            $data['roles'] = $this->input->post('roles', true);
            $data['status'] = $this->input->post('status', true);

            $user = $this->users->check_user($data['nip']);
            if ($user == true) {
                $this->session->set_flashdata('error', 'User Dengan NIP ' . $data['nip'] . ' Sudah Terdaftar');
                return redirect(site_url('ListUser'));
            } else {
                $result = $this->users->create($data, 'users');
                if ($result == true) {
                    $this->session->set_flashdata('success', 'User Berhasil Ditambahkan');
                    return redirect(site_url('ListUser'));
                } else {
                    $this->session->set_flashdata('error', 'DB Erorr');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Form Tidak Boleh Kosong');

            return redirect(site_url('ListUser'));
        }
    }

    public function updateUser()
    {
        $nip = $this->input->post('nip');
        $awal = $this->input->post('nip-awal');

        if ($nip != $awal) {
            $user = $this->users->check_user($nip);
            if ($user == true) {
                $this->session->set_flashdata('error', 'User Dengan NIP ' . $nip . ' Sudah Terdaftar');
                return redirect(site_url('ListUser'));
            } else {
                $result = $this->users->update();
                if ($result == true) {
                    $mkdosen = $this->users->updatemk();
                    if($mkdosen == true) {
                        $bap = $this->users->updatenip();
                    }
                    $this->session->set_flashdata('success', 'Data Berhasil Diubah');
                    return redirect(site_url('ListUser'));
                } else {
                    $this->session->set_flashdata('error', 'DB Erorr');
                }
            }
        } else {
            $result = $this->users->update();
            if ($result == true) {
                $this->session->set_flashdata('success', 'Data Berhasil Diubah');
                return redirect(site_url('ListUser'));
            } else {
                $this->session->set_flashdata('error', 'DB Erorr');
            }
        }
    }
}
