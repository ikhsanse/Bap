<?php
class Rekap_pertemuan extends CI_Model {

    public function get_prodi($id_prodi) {
        
        $this->db->select('*');
        $this->db->from('prodi');
        $this->db->where('prodi_id', $id_prodi);
        $query = $this->db->get();
        $data = $query->result();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $data[0];
        }
    }
    public function get_rekap_prodi($prodi, $bln){
        $this->db->select('id_bap, matakuliah, kelas, topik, cp_pertemuan, deskripsi,  status, nip_dosen, bap_id_mkdosen, bap_id_prodi, pertemuan');
        $this->db->select("to_char(tanggal,'DD Month YYYY') AS tanggal");
        $this->db->from('bap');
        $this->db->where('bap_id_prodi', $prodi);
        $this->db->where("to_char(tanggal,'mm-yyyy')", $bln);
        $query =$this->db->get();

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }

    }
    public function get_rekap_jurusan($bln){
        $this->db->select('id_bap, matakuliah, kelas, topik, cp_pertemuan, deskripsi,  status, nip_dosen, bap_id_mkdosen, bap_id_prodi, pertemuan');
        $this->db->select("to_char(tanggal,'DD Month YYYY') AS tanggal");
        $this->db->from('bap');
        $this->db->where("to_char(tanggal,'mm-yyyy')", $bln);
        $query =$this->db->get();

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }

    }
}
?>