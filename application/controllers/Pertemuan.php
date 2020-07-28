<?php

class Pertemuan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata['user_id'] == true) {
            $this->load->model('list_pertemuan');
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
        $id = $this->input->get();
        $id_mkdosen = $id['id'];
        $datamk = $this->getKelas($id_mkdosen);
        $data['prodi'] = $datamk->id_prodi;
        $data['topik'] = $this->getTopikPertemuan($datamk->kode_matkul);
        $data['kelas'] = $datamk->nama_kelas;
        $data['matkul'] = $datamk->namamk;
        $data['kode_matkul'] = $datamk->kode_matkul;
        
        if ($this->session->userdata['user_role'] == '2') {
            $this->load->view("master/header/dosen/head1", $data);
        } elseif ($this->session->userdata['user_role'] == '3') {
            $this->load->view("master/header/kaprodi/headerkps2", $data);
        } elseif ($this->session->userdata['user_role'] == '4') {
            $this->load->view("master/header/kaprodi/headerkps2", $data);
        } elseif ($this->session->userdata['user_role'] == '5') {
            $this->load->view("master/header/kaprodi/headerkps2", $data);
        };

        // $this->load->view("master/header/head1", $data);

        // var_dump($this->session->userdata);exit;
        $this->load->view("master/sidebar/sidebar");
        $this->load->view('main/dosen/listpertemuan', $data);
        $this->load->view('master/modal/modal', $data);
        $this->load->view('master/modal/modal1', $data);

        $this->load->view('master/modal/modal2', $data);
        // $this->load->view('master/modal/modaEditKps', $data);
        $this->load->view("master/footer/foot");
    }

    public function getKelas($id_mkdosen)
    {
        $data = $this->list_pertemuan->get_kelas_matkul($id_mkdosen);

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
        // var_dump($id);exit;
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

        if ($this->form_validation->run() != false) {
            // var_dump($this->form_validation->run());exit;
            $data['matakuliah'] = $this->input->post('matkul');
            $data['kelas'] = $this->input->post('kelas');
            $topik =  $this->input->post('topik', true);
            $data['topik'] =$this->list_pertemuan->get_topik($topik);
            $data['cp_pertemuan'] = $this->input->post('cp-pertemuan');
            $data['deskripsi'] = $this->input->post('deskripsi', true);
            $data['tanggal'] = $this->input->post('tanggal', true);
            $data['status'] = $this->input->post('status', true);
            $data['nip_dosen'] = $this->session->userdata['user_id'];
            $data['bap_id_mkdosen'] = $this->session->userdata['id_mkdosen'];
            $data['pertemuan'] = $this->input->post('pertemuan', true);
            $data['bap_id_prodi'] = $this->input->post('prodi');
            $data['bap_kode_matkul'] = $this->input->post('kode-matkul');
            // var_dump($data['tanggal']);exit;
            // $data['prodi'] = $this->list_pertemuan->get_prodi($data['kelas']);
            $jmlpertemuan = $this->list_pertemuan->check_jumlah($data['bap_id_mkdosen']);
            // var_dump($jmlpertemuan);exit;
            if ($jmlpertemuan <= 18) {
                $pertemuan = $this->list_pertemuan->check_pertemuan($data['pertemuan'], $data['bap_id_mkdosen']);
                // var_dump($pertemuan);exit;
                $id = $this->session->userdata('id_mkdosen');
                if ($pertemuan == true) {
            
                    $this->session->set_flashdata('error', 'Pertemuan Ke-'.$data['pertemuan'].' Sudah Terisi');

                    return redirect('pertemuan/?id=' . $id);
                } else {
                    $result = $this->list_pertemuan->create($data, 'bap');
                    $id = $this->session->userdata('id_mkdosen');
                    if ($result == true) {
                        $this->session->set_flashdata('success', 'Data Berhasil Dimasukan');
                        return redirect('pertemuan/?id=' . $id);
                    } else {
                        $this->session->set_flashdata('error', 'DB Erorr');
                    }
                }
            } else {
                $this->session->set_flashdata('error', 'Sudah 18 Kali Pertemuan');
            }
        } else {
            $this->session->set_flashdata('error', 'Form Input Tidak Boleh Kosong');
            $id = $this->session->userdata('id_mkdosen');

            // return redirect('pertemuan/?id=' . $id);
            return redirect(site_url());
        }
    }

    public function getPertemuanList()
    {
        $data = $this->list_pertemuan->get_list_pertemuan($this->session->userdata('id_mkdosen'));
        // var_dump($data);exit;

        echo json_encode($data);
    }

    public function getPertemuan($id)
    {
        $id = $this->input->get();
        $id_bap = $id['id_bap'];

        $datas = $this->list_pertemuan->get_pertemuan($id_bap);

        return $datas;
    }

    function update()
    {
        $id_dosen = $this->session->userdata['id_mkdosen'];
        $pertemuan = $this->input->post('pertemuan-baru');
        
        $awal = $this->input->post('pertemuan-awal');
        // var_dump($pertemuan,$awal);exit;

        $check_edit = $this->list_pertemuan->check_edit($pertemuan, $id_dosen);
        if ($check_edit != $awal) {
            $check_temu = $this->list_pertemuan->check_pertemuan($pertemuan, $id_dosen);
            // var_dump($check_temu);exit;
            if ($check_temu == true) {
                $msg = 'Pertemuan Ke-'.$pertemuan.' Sudah Terisi';
                $this->session->set_flashdata('error', $msg);

                $id = $this->session->userdata('id_mkdosen');
                // echo $data;
                return redirect('pertemuan/?id=' . $id);
            } else {
                $data = $this->list_pertemuan->update_data();
                $msg = 'Data behasil diubah';
                $this->session->set_flashdata('success', $msg);
                $id = $this->session->userdata('id_mkdosen');

                return redirect('pertemuan/?id=' . $id);
            }
        } elseif ($check_edit == $awal) {
            // var_dump($check_edit, $pertemuan);exit;
            $data = $this->list_pertemuan->update_data();
            $msg = 'Data behasil diubah';
            $this->session->set_flashdata('success', $msg);
            $id = $this->session->userdata('id_mkdosen');
            return redirect('pertemuan/?id=' . $id);
        }


        // var_dump($check_pertemuan);exit;


        // return redirect()
        // echo json_encode($data);
    }
};
