<?php
class List_pertemuan extends CI_Model
{
    public function get_kelas_matkul($id_mkdosen)
    {
        $this->db->select('md.id_mkdosen, md.id_kelas, md.kode_matkul, md.nip_dosen, d.nama, k.nama_kelas, k.semester, mk.namamk');
        $this->db->from('mk_dosen as md');
        $this->db->join('users as d', 'd.nip=md.nip_dosen');
        $this->db->join('kelas as k', 'k.id_kelas=md.id_kelas');
        $this->db->join('matakuliah as mk', 'mk.kodemk=md.kode_matkul');
        $this->db->where('md.id_mkdosen', $id_mkdosen);
        $query = $this->db->get();
        $data = $query->result();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $data[0];
        }
    }

    public function get_list_pertemuan($id_mkdosen){
        $this->db->select('*');
        $this->db->from('bap');
        $this->db->where('bap_id_mkdosen', $id_mkdosen);
        $query =$this->db->get();

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_topik_cp($id) {
        $this->db->select('kode_tpk, tpk_utama, cp_pertemuan, pertemuan');
        $this->db->from('topik');
        $this->db->where('matakuliah_kodemk', $id);
        $query = $this->db->get();

        return $query->result();

    }
    public function get_cp_pertemuan ($id) {
        $this->db->select('cp_pertemuan');
        $this->db->from('topik');
        $this->db->where('tpk_utama', $id);
        $query = $this->db->get();

        // var_dump($query->result());exit;
        return $query->result();
    }

    public function create($data, $table) {
        // var_dump($data);exit;
        $query = $this->db->insert($table, $data);
        // var_dump($query);exit;
        return $query;   
    }

    public function get_pertemuan($id){
        $this->db->select('*');
        $this->db->from('bap');
        $this->db->where('bap_id_mkdosen', $id);
        $query =$this->db->get();

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function update_data() {
        $id = $this->input->post('id-bap');
        $topik = $this->input->post('topik-utama');
        $cp = $this->input->post('cp-edit');
        $deskripsi = $this->input->post('deskripsi');
       
        $tanggal = $this->input->post('tanggal');
        $status = $this->input->post('status-perkuliahan');
        $pertemuan = $this->input->post('pertemuan-edit');
        // var_dump($tanggal);exit;
        $this->db->set('topik', $topik);
        $this->db->set('cp_pertemuan',$cp);
        $this->db->set('deskripsi', $deskripsi);
        $this->db->set('pertemuan', $pertemuan);
        $this->db->set('tanggal', $tanggal);
        $this->db->set('status', $status);
        $this->db->where('id_bap', $id);
        $query = $this->db->update('bap');

        return $query;
    }

}
