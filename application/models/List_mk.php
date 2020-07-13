<?php 

class List_mk extends CI_Model {
    function get_mkdosen($nip) {
        $this->db->select('md.id_mkdosen, md.id_kelas, md.id_prodi, md.kode_matkul, md.nip_dosen, d.nama, k.nama_kelas, k.semester, mk.namamk');
        $this->db->from('mk_dosen as md');
        $this->db->join('users as d', 'd.nip=md.nip_dosen');
        $this->db->join('kelas as k', 'k.id_kelas=md.id_kelas');
        $this->db->join('matakuliah as mk', 'mk.kodemk=md.kode_matkul');
        $this->db->where('md.nip_dosen', $nip);
        $query= $this->db->get();
        
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function get_kelas_prodi($id){
        $this->db->select('md.id_mkdosen, md.id_kelas, md.id_prodi, md.kode_matkul, md.nip_dosen, d.nama, k.nama_kelas, k.semester, mk.namamk');
        $this->db->from('mk_dosen as md');
        $this->db->join('users as d', 'd.nip=md.nip_dosen');
        $this->db->join('kelas as k', 'k.id_kelas=md.id_kelas');
        $this->db->join('matakuliah as mk', 'mk.kodemk=md.kode_matkul');
        $this->db->where('md.id_prodi', $id);
        $query= $this->db->get();
        
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }

    }
    function get_all_kelas() {
        $this->db->select('md.id_mkdosen, md.id_kelas, md.id_prodi, md.kode_matkul, md.nip_dosen, d.nama, k.nama_kelas, k.semester, mk.namamk, pd.namaprod');
        $this->db->from('mk_dosen as md');
        $this->db->join('users as d', 'd.nip=md.nip_dosen');
        $this->db->join('kelas as k', 'k.id_kelas=md.id_kelas');
        $this->db->join('matakuliah as mk', 'mk.kodemk=md.kode_matkul');
        $this->db->join('prodi as pd', 'pd.prodi_id=md.id_prodi');
        $query= $this->db->get();
        // var_dump($query->result());exit;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
}
