<?php

class Rekap extends CI_Controller
{

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
        } else {
            $prod = $this->getProdi($this->session->userdata['id_prodi']);
            $data['prodi'] = $prod->namaprod;
            $this->load->view("master/header/rekap/headrekap1", $data);
            $this->load->view("master/sidebar/sidebarkps");
        }

        $awal = $this->input->post('tanggal-awal');
        $akhir = $this->input->post('tanggal-akhir');
        $prodi = $this->input->post('prodi');
        $dosen = $this->input->post('dosen');
        $matkul = $this->input->post('matkul');
        $kelas = $this->input->post('kelas');
        $this->session->set_userdata('tanggal-awal', $awal);
        $this->session->set_userdata('tanggal-akhir', $akhir);
        $this->session->set_userdata('prodi-rekap', $prodi);
        $this->session->set_userdata('nip-rekap', $dosen);
        $this->session->set_userdata('matkul-rekap', $matkul);
        $this->session->set_userdata('kelas-rekap', $kelas);

        if ($dosen != null) {
            $this->load->view('main/rekap/rekapdosen', $data);
        } elseif ($matkul != null) {
            $this->load->view('main/rekap/rekapmatkul', $data);
        } elseif($kelas != null) {
            $this->load->view('main/rekap/rekapkelas', $data);
        } else {
            $this->load->view('main/rekap/rekapbulan', $data);
        }

        // $this->load->view('master/modal/modal', $data);
        // $this->load->view('master/modal/modal1', $data);

        // $this->load->view('master/modal/modal2', $data);
        // $this->load->view('master/modal/modaEditKps', $data);
        $this->load->view("master/footer/foot");
    }
    public function getProdi($id_prodi)
    {
        $data = $this->rekap_pertemuan->get_prodi($id_prodi);

        // $this->session->set_userdata('id_mkdosen', $id_mkdosen);
        return $data;
    }

    public function getRekapProdi()
    {
        $awal = $this->session->userdata['tanggal-awal'];
        $akhir = $this->session->userdata['tanggal-akhir'];
        $prodirekap = $this->session->userdata['prodi-rekap'];
        $prodi = $this->session->userdata['id_prodi'];
        // var_dump($awal);exit;
        if ($prodi != null) {
            $data = $this->rekap_pertemuan->get_rekap_prodi($prodi, $awal, $akhir);
        } else {
            if ($prodirekap != null) {
                $data = $this->rekap_pertemuan->get_rekap_prodi($prodirekap, $awal, $akhir);
            } else {
                $data = $this->rekap_pertemuan->get_rekap_jurusan($awal, $akhir);
            }
        };

        // var_dump($data);exit;
        echo json_encode($data);
    }

    public function getRekapDosen()
    {
        // var_dump('masuk');exit;
        $awal = $this->session->userdata['tanggal-awal'];
        $akhir = $this->session->userdata['tanggal-akhir'];
        $dosen = $this->session->userdata['nip-rekap'];
        $prodi = $this->session->userdata['id_prodi'];

        if ($prodi != null) {
            $data = $this->rekap_pertemuan->get_rekap_dosen_prodi($dosen, $awal, $akhir, $prodi);
        } else {
            $data = $this->rekap_pertemuan->get_rekap_dosen($dosen, $awal, $akhir);
        }



        echo json_encode($data);
    }

    public function getRekapMatkul()
    {
        $awal = $this->session->userdata['tanggal-awal'];
        $akhir = $this->session->userdata['tanggal-akhir'];
        $matkul = $this->session->userdata['matkul-rekap'];
        $prodi = $this->session->userdata['id_prodi'];

        if ($prodi != null) {
            $data = $this->rekap_pertemuan->get_rekap_matkul_prodi($matkul, $awal, $akhir, $prodi);
        } else {
            $data = $this->rekap_pertemuan->get_rekap_matkul($matkul, $awal, $akhir);
        }

        echo json_encode($data);
    }

    public function getRekapKelas() {
        $awal = $this->session->userdata['tanggal-awal'];
        $akhir = $this->session->userdata['tanggal-akhir'];
        $kelas = $this->session->userdata['kelas-rekap'];
        $prodi = $this->session->userdata['id_prodi'];

        if ($prodi != null) {
            $data = $this->rekap_pertemuan->get_rekap_kelas_prodi($kelas, $awal, $akhir, $prodi);
        } else {
            $data = $this->rekap_pertemuan->get_rekap_kelas($kelas, $awal, $akhir);
        }

        echo json_encode($data);
    }
    public function getTopikPertemuan($id)
    {
        $data = $this->list_pertemuan->get_topik_cp($id);

        // var_dump($data);exit;
        return $data;
    }
}
