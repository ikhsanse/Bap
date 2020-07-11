<?php 

class List_mk extends CI_Model {
    function get_mkdosen($nip) {
        $this->db->select('md.id_mkdosen, md.id_kelas, md.kode_matkul, md.nip_dosen, d.nama, k.nama_kelas, k.semester, mk.namamk');
        $this->db->from('mk_dosen as md');
        $this->db->join('dosen as d', 'd.nip=md.nip_dosen');
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
}
?>