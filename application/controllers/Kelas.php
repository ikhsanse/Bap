<?php
class Kelas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata['user_id'] == true) {
            $this->load->model('kelas_m');
            $this->load->library('form_validation');
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

        if ($this->session->userdata['user_role'] == '1') {
            $this->load->view("master/header/kelas/headadm", $data);
            $this->load->view("master/sidebar/sidebar");
            $this->load->view('main/kelas/listkelasadm', $data);
        } else {
            $prod = $this->getProdi($this->session->userdata['id_prodi']);
            $data['prodi'] = $prod->namaprod;
            $this->load->view("master/header/kelas/headkps", $data);
            $this->load->view("master/sidebar/sidebarkps");
            $this->load->view('main/kelas/listkelaskps', $data);
        }
        // $this->load->view("master/sidebar/sidebar");

        // $this->load->view('main/kelas/listkelasadm', $data);
        $this->load->view('master/modal/addkelas');
        $this->load->view('master/modal/editkelas');
        $this->load->view("master/footer/foot");
    }

    public function getProdi($id_prodi)
    {
        $this->load->model('rekap_pertemuan');
        $data = $this->rekap_pertemuan->get_prodi($id_prodi);

        // $this->session->set_userdata('id_mkdosen', $id_mkdosen);
        return $data;
    }

    public function getAllKelas()
    {

        // $bln = $this->session->userdata['bulan'];
        $prodi = $this->session->userdata['id_prodi'];
        // var_dump($prodi);exit;
        if ($prodi != null) {
            $data = $this->kelas_m->get_kelas_prodi($prodi);
        } else {
            $data = $this->kelas_m->get_kelas_jurusan();
        };

        // var_dump($data);exit;
        echo json_encode($data);
    }

    public function addKelas()
    {
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('prodi', 'Prodi', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('tahun', 'Tahun Masuk', 'required');

        if ($this->form_validation->run() != false) {

            $data['nama_kelas'] = $this->input->post('kelas', true);
            $data['id_prodi'] = $this->input->post('prodi', true);
            $data['semester'] = $this->input->post('semester', true);
            $data['thn_masuk'] = $this->input->post('tahun', true);

            $kelas = $this->kelas_m->check_kelas($data['nama_kelas'], $data['thn_masuk']);
            if ($kelas == true) {
                $this->session->set_flashdata('error', 'Data Kelas' . $data['nama_kelas'] . ' Tahun Masuk ' . $data['thn_masuk'] . ' Sudah Ada');

                return redirect(site_url('kelas'));
            } else {
                $result = $this->kelas_m->create($data, 'kelas');
                if ($result == true) {
                    $this->session->set_flashdata('success', 'Data Berhasil Dimasukan');
                    return redirect(site_url('kelas'));
                } else {
                    $this->session->set_flashdata('error', 'DB Erorr');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'Form Input Tidak Boleh Kosong');

            return redirect(site_url('kelas'));
        }
    }

    public function editKelas()
    {
        $id = $this->input->post('id');
        $kelas = $this->input->post('kelas');
        $kelasAwal = $this->input->post('kelasAwal');
        $tahun = $this->input->post('tahun');
        $tahunAwal = $this->input->post('tahunAwal');


        // var_dump($pertemuan,$awal);exit;
        $check_kelas_sama = $this->kelas_m->check_kelas_edit($kelas, $tahun);
        $check_tahun_sama = $this->kelas_m->check_tahun_edit($kelas, $tahun);
        // var_dump($check_kelas_sama, $check_tahun_sama);exit;
        if ($check_kelas_sama != $kelasAwal || $check_tahun_sama != $tahunAwal) {
            $check_kelas = $this->kelas_m->check_kelas($kelas, $tahun);

            if ($check_kelas == true) {
                $this->session->set_flashdata('error', 'Data Kelas' . $kelas . ' Tahun Masuk ' . $tahun . ' Sudah Ada');
                return redirect(site_url('kelas'));
            } else {
                // var_dump('masuk');exit;
                $data = $this->kelas_m->update();
                if ($data == true) {
                    $this->session->set_flashdata('success', 'Data Berhasil Di Ubah');
                    return redirect(site_url('kelas'));
                } else {
                    $this->session->set_flashdata('error', 'DB Erorr');
                    return redirect(site_url('kelas'));
                }
            }
        } elseif ($check_kelas_sama == $kelasAwal && $check_tahun_sama == $tahunAwal) {
            $data = $this->kelas_m->update();
            if ($data == true) {
                $this->session->set_flashdata('success', 'Data Berhasil Di Ubah');
                return redirect(site_url('kelas'));
            } else {
                $this->session->set_flashdata('error', 'DB Erorr');
                return redirect(site_url('kelas'));
            }
        }
    }
}
