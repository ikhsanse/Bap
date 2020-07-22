<?php
class Kelasmk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('kelas_mk');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view("master/mastercode");

        $data['nip'] = $this->session->userdata['user_id'];
        $data['nama'] = $this->session->userdata['user_nama'];
        $data['kelas'] = $this->getAllKelas();
        $data['tahun'] = $this->getTahunKelas();
        $data['matkul'] = $this->getMatkul();
        $data['dosen'] = $this->getDosen();
        // var_dump($data['dosen']);exit;
        if ($this->session->userdata['user_role'] == '1') {
            $this->load->view("master/header/kelasmk/headadm", $data);
            $this->load->view("master/sidebar/sidebar");
            $this->load->view('main/kelasmk/listkelasadm', $data);
        } else {
            $prod = $this->getProdi($this->session->userdata['id_prodi']);
            $data['prodi'] = $prod->namaprod;
            $this->load->view("master/header/kelasmk/headkps", $data);
            $this->load->view("master/sidebar/sidebarkps");
            $this->load->view('main/kelasmk/listkelasadm', $data);
        }
        $this->load->view('master/modal/addmk');
        $this->load->view('master/modal/editmk');
        $this->load->view('master/modal/detailmk');
        $this->load->view("master/footer/foot");
    }
    public function getProdi($id_prodi)
    {
        $this->load->model('rekap_pertemuan');
        $data = $this->rekap_pertemuan->get_prodi($id_prodi);

        // $this->session->set_userdata('id_mkdosen', $id_mkdosen);
        return $data;
    }

    public function getAllMk()
    {

        // $bln = $this->session->userdata['bulan'];
        $prodi = $this->session->userdata['id_prodi'];
        // var_dump($prodi);exit;
        if ($prodi != null) {
            $data = $this->kelas_mk->get_matkul_prodi($prodi);
        } else {
            $data = $this->kelas_mk->get_matkul_jurusan();
        };

        // var_dump($data);exit;
        echo json_encode($data);
    }

    private function getAllKelas()
    {
        $data = $this->kelas_mk->get_kelas_jurusan();

        return $data;
    }
    private function getTahunKelas()
    {
        $data = $this->kelas_mk->get_tahun_kelas();

        return $data;
    }

    public function getDosen()
    {
        $data = $this->kelas_mk->get_dosen();
        return $data;
    }
    public function getMatkul()
    {
        // $prodi = $this->session->userdata['id_prodi'];
        // var_dump($prodi);exit;

        $data = $this->kelas_mk->get_matkul_all();

        return $data;
    }
    public function getProdiKelas($kelas)
    {
        $data = $this->kelas_mk->get_prodi_kelas($kelas);

        return $data;
    }

    private function getIdKelas($kelas, $tahun)
    {
        $data = $this->kelas_mk->get_id_kelas($kelas, $tahun);
        return $data;
    }

    private function getMkdosen($data)
    {
        // var_dump($data['id_kelas']);exit;
        $data = $this->kelas_mk->get_mkdosen($data);

        return $data;
    }

    public function getKodeMatkul($id)
    {
        $data = array($this->kelas_mk->get_kode_matkul($id));
        foreach ($data[0] as $dt) {
            $output = $dt->kodemk;
        }
        echo $output;
    }

    public function getNipDosen($id)
    {
        $data = array($this->kelas_mk->get_nip_dosen($id));
        foreach ($data[0] as $dt) {
            $output = $dt->nip;
        }
        echo $output;
    }
    public function addDosenMatkul()
    {
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('matkul', 'Mata Kuliah', 'required');
        $this->form_validation->set_rules('dosen', 'Dosen', 'required');
        $this->form_validation->set_rules('tahun', 'Tahun Masuk', 'required');

        if ($this->form_validation->run() != false) {

            $tahun = $this->input->post('tahun', true);
            $kls = $this->input->post('kelas', true);
            $data['thn_masuk_kls'] = $tahun;
            $data['id_kelas'] = $this->getIdKelas($kls, $tahun);
            $data['id_prodi'] = $this->getProdiKelas($kls);
            $data['kode_matkul'] = $this->input->post('matkul', true);
            $data['nip_dosen'] = $this->input->post('dosen', true);
            $data['status'] = 'active';
            // var_dump($data);exit;
            // $tahun = $this->input->post('tahun', true);


            $kelas = $this->kelas_mk->check_kelas($kls, $tahun);
            if ($kelas == true) {
                $check_mkdosen = $this->getMkdosen($data);
                if ($check_mkdosen == false) {
                    $result = $this->kelas_mk->create($data, 'mk_dosen');
                    if ($result == true) {
                        $this->session->set_flashdata('success', 'Data Berhasil Dimasukan');
                        return redirect(site_url('kelasmk'));
                    } else {
                        $this->session->set_flashdata('error', 'DB Erorr');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Data Mata Kuliah Dosen Sudah ada');
                    return redirect(site_url('kelasmk'));
                }
            } else {
                $this->session->set_flashdata('error', 'Data Kelas Belum Terdaftar');
                return redirect(site_url('kelasmk'));
            }
        } else {
            $this->session->set_flashdata('error', 'Form Input Tidak Boleh Kosong');

            return redirect(site_url('kelasmk'));
        }
    }

    public function editDosenMatkul()
    {
        $kls =$this->input->post('kelas');
        $klsAwal = $this->input->post('kelas-awal');
        $prodiAwal = $this->getProdiKelas($klsAwal);
        $kodeAwal = $this->input->post('kode-awal');
        $thnAwal = $this->input->post('tahun-awal');
        $nipAwal = $this->input->post('nip-awal');
        $idkelasAwal = $this->getIdKelas($klsAwal, $thnAwal);

        $data['id_mkdosen'] = $this->input->post('id-mkdosen');
        $data['thn_masuk_kls'] = $this->input->post('tahun');
        $data['id_prodi'] = $this->getProdiKelas($kls);
        $data['id_kelas'] = $this->getIdKelas($kls, $data['thn_masuk_kls']);
        $data['kode_matkul'] = $this->input->post('kode');
        $data['nip_dosen'] =$this->input->post('nip');
        $data['status'] = $this->input->post('status');


        // var_dump($data);exit;
        // $check_kelas = $this->kelas_m->check_kelas($kls, $data['thn_masuk_kls']);
        if($data['id_kelas'] == false) {
            $this->session->set_flashdata('error', 'Data Kelas Tidak Ditemukan');
            return redirect(site_url('kelasmk'));
        } else {
            $check_prodi_sama = $this->kelas_mk->check_prodi_edit($data);
            $check_kelas_sama = $this->kelas_mk->check_kelas_edit($data);
            $check_tahun_sama = $this->kelas_mk->check_tahun_edit($data);
            $check_matkul_sama = $this->kelas_mk->check_matkul_edit($data);
            $check_nip_sama = $this->kelas_mk->check_nip_edit($data);
            // var_dump($check_kelas_sama, $idkelasAwal, $check_tahun_sama, $thnAwal, $check_matkul_sama, $kodeAwal, $check_nip_sama, $nipAwal,  $check_prodi_sama, $prodiAwal);exit;
            if ($check_prodi_sama != $prodiAwal || $check_tahun_sama != $thnAwal ||  $check_matkul_sama != $kodeAwal ||  $check_nip_sama != $nipAwal || $check_kelas_sama != $idkelasAwal ) {
                $check_mkdosen = $this->kelas_mk->check_mkdosen($data);
                // var_dump($check_mkdosen);exit;
                if ($check_mkdosen == true) {
                    $this->session->set_flashdata('error', 'Data Mata Kuliah Dosen Sudah Ada');
                    return redirect(site_url('kelasmk'));
                } else {
                    // var_dump('masuk');exit;
                    $data = $this->kelas_mk->update($data);
                    if ($data == true) {
                        $this->session->set_flashdata('success', 'Data Berhasil Di Ubah');
                        return redirect(site_url('kelasmk'));
                    } else {
                        $this->session->set_flashdata('error', 'DB Erorr');
                        return redirect(site_url('kelasmk'));
                    }
                }
            } elseif ($check_prodi_sama == $prodiAwal && $check_tahun_sama == $thnAwal &&  $check_matkul_sama == $kodeAwal &&  $check_nip_sama == $nipAwal && $check_kelas_sama == $idkelasAwal) {
                $data = $this->kelas_mk->update($data);
                if ($data == true) {
                    $this->session->set_flashdata('success', 'Data Berhasil Di Ubah');
                    return redirect(site_url('kelasmk'));
                } else {
                    $this->session->set_flashdata('error', 'DB Erorr');
                    return redirect(site_url('kelasmk'));
                }
            }
        }
    }
}
