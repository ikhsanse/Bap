<?php

class KaprodiPertemuan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('list_pertemuan');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view("master/mastercode");
        $data['nip'] = $this->session->userdata['user_id'];
        $data['nama'] = $this->session->userdata['user_nama'];
        if($this->session->userdata['user_role'] == '1'){
            $this->load->view("master/header/admin/headeradm1", $data);
        } else {
            $this->load->view("master/header/kaprodi/headerkps1", $data);
        }
        
        $id = $this->input->get();
        $id_mkdosen = $id['id'];
        $datamk = $this->getKelas($id_mkdosen);
        $data['topik'] = $this->getTopikPertemuan($datamk->kode_matkul);
        $data['kelas'] = $datamk->nama_kelas;
        $data['matkul'] = $datamk->namamk;
        // var_dump($this->session->userdata);exit;
        $this->load->view('main/kaprodi/pertemuankps', $data);
        $this->load->view('master/modal/modal', $data);
        $this->load->view('master/modal/modal1', $data);
        
        $this->load->view('master/modal/modal2',$data);
        $this->load->view("master/footer/foot");
        
    }

    public function getKelas($id_mkdosen)
    {
        $data = $this->list_pertemuan->get_kelas_matkul($id_mkdosen);


        // $session_data = array(
            // 'user_id' => $this->session->userdata('user_id'),
            // 'user_pass' => $this->session->userdata('user_pass'),
            // 'user_nama' => $this->session->userdata('user_nama'),
            // 'id_mkdosen' => $id_mkdosen
            // 'kode_matkul' => $data[0]->kode_matkul
        // );
        $this->session->set_userdata('id_mkdosen', $id_mkdosen);
        return $data;
    }


    public function getTopikPertemuan($id)
    {
        $data = $this->list_pertemuan->get_topik_cp($id);

        // var_dump($data);exit;
        return $data;
    }
    public function getCp($id)
    {
        $data = array($this->list_pertemuan->get_cp_pertemuan($id));
        // var_dump($data);exit;
        // $output = '<option value="" selected>Topik Utama</option>';
        foreach ($data[0] as $cp) {
            $output = '<option selected value="' . $cp->cp_pertemuan . '">' . $cp->cp_pertemuan . '</option>';
        }

        echo $output;
    }

    public function setBap()
    {
        $this->form_validation->set_rules('pertemuan', 'Pertemuan', 'required');
        $this->form_validation->set_rules('topik', 'Topik', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Perkuliahan', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('status', 'Status Perkuliahan', 'required');


        $this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
                    <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

        if ($this->form_validation->run() == true) {
            $data['matakuliah'] = $this->input->post('matkul');
            $data['kelas'] = $this->input->post('kelas');
            $data['topik'] = $this->input->post('topik');
            $data['cp_pertemuan'] = $this->input->post('cp-pertemuan');
            $data['deskripsi'] = $this->input->post('deskripsi');
            $data['tanggal'] = $this->input->post('tanggal');
            $data['status'] = $this->input->post('status');
            $data['nip_dosen'] = $this->session->userdata['user_id'];
            $data['bap_id_mkdosen'] = $this->session->userdata['id_mkdosen'];
            $data['pertemuan'] = $this->input->post('pertemuan');

            $result = $this->list_pertemuan->create($data, 'bap');
            $id = $this->session->userdata('id_mkdosen');

            if ($result == true) {
                $this->session->set_flashdata('msg', 'Input BAP berhasil');

                return redirect('pertemuan/?id=' . $id);
            } else {
                $this->session->set_flashdata('msg', 'perikas kembali data yang anda masukan');
            }
        } else {
            // $this->index();
        }
    }
    public function getPertemuanList()
    {
        $data = $this->list_pertemuan->get_list_pertemuan($this->session->userdata('id_mkdosen'));

        echo json_encode($data);
    }

    public function getPertemuan($id)
    {
        $id = $this->input->get();
        $id_bap = $id['id_bap'];

        $datas = $this->list_pertemuan->get_pertemuan($id_bap);
       
        return $datas;
    }

    function update(){
        $data = $this->list_pertemuan->update_data();
        $id = $this->session->userdata('id_mkdosen');
        // echo $data;
        return redirect('pertemuan/?id=' . $id);
        // return redirect()
        // echo json_encode($data);
    }
};
