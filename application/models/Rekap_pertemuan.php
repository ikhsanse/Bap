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
    public function get_rekap_prodi($prodi, $awal, $akhir){
        $this->db->select('b.id_bap, b.matakuliah, b.kelas, b.topik, b.cp_pertemuan, b.deskripsi,  b.status, b.nip_dosen, b.bap_id_mkdosen, b.bap_id_prodi, b.pertemuan, u.nama');
        $this->db->select("to_char(b.tanggal,'DD/MM/YYYY') AS tanggal");
        $this->db->from('bap as b');
        $this->db->join('users as u', 'u.nip=b.nip_dosen');
        $this->db->where('bap_id_prodi', $prodi);
        $this->db->where(" b.tanggal >= ", $awal);
        $this->db->where("b.tanggal <= ", $akhir);
        $query =$this->db->get();

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }

    }
    public function get_rekap_jurusan($awal, $akhir){
        $this->db->select('b.id_bap, b.matakuliah, b.kelas, b.topik, b.cp_pertemuan, b.deskripsi,  b.status, b.nip_dosen, b.bap_id_mkdosen, b.bap_id_prodi, b.pertemuan, u.nama');
        $this->db->select("to_char(b.tanggal,'DD/MM/YYYY') AS tanggal");
        $this->db->from('bap as b');
        $this->db->join('users as u', 'u.nip=b.nip_dosen');
        $this->db->where(" b.tanggal >= ", $awal);
        $this->db->where("b.tanggal <= ", $akhir);
        $query =$this->db->get();
        // var_dump($query->result());exit;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }

    }

    public function get_rekap_dosen($dosen, $awal, $akhir) {
        // var_dump($dosen, $awal, $akhir);exit;
        $this->db->select('b.id_bap, b.matakuliah, b.kelas, b.topik, b.cp_pertemuan, b.deskripsi,  b.status, b.nip_dosen, b.bap_id_mkdosen, b.bap_id_prodi, b.pertemuan, u.nama');
        $this->db->select("to_char(b.tanggal,'DD/MM/YYYY') AS tanggal");
        $this->db->from('bap as b');
        $this->db->join('users as u', 'u.nip=b.nip_dosen');
        $this->db->where('nip_dosen', $dosen);
        // $this->db->where('tanggal BETWEEN  "'. date('Y-m-d', strtotime($awal)). '" and "'. date('Y-m-d', strtotime($akhir)).'"');
        // $this->db->where("to_char(tanggal,'dd/mm/yyyy') >= ", $awal);
        // $this->db->where("to_char(tanggal,''dd/mm/yyyy') < ", $akhir);
        $this->db->where(" b.tanggal >= ", $awal);
        $this->db->where("b.tanggal <= ", $akhir);
        $query =$this->db->get();
        // var_dump($query->result());exit;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_rekap_dosen_prodi($dosen, $awal, $akhir, $prodi) {
        // var_dump($dosen, $awal, $akhir);exit;
        $this->db->select('b.id_bap, b.matakuliah, b.kelas, b.topik, b.cp_pertemuan, b.deskripsi,  b.status, b.nip_dosen, b.bap_id_mkdosen, b.bap_id_prodi, b.pertemuan, u.nama');
        $this->db->select("to_char(b.tanggal,'DD/MM/YYYY') AS tanggal");
        $this->db->from('bap as b');
        $this->db->join('users as u', 'u.nip=b.nip_dosen');
        $this->db->where('bap_id_prodi', $prodi);
        $this->db->where('nip_dosen', $dosen);
        $this->db->where(" b.tanggal >= ", $awal);
        $this->db->where("b.tanggal <= ", $akhir);
        $query =$this->db->get();
        // var_dump($query->result());exit;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_rekap_matkul($matkul, $awal, $akhir) {
        // var_dump($dosen, $awal, $akhir);exit;
        $this->db->select('b.id_bap, b.matakuliah, b.kelas, b.topik, b.cp_pertemuan, b.deskripsi,  b.status, b.nip_dosen, b.bap_id_mkdosen, b.bap_id_prodi, b.pertemuan, u.nama');
        $this->db->select("to_char(b.tanggal,'DD/MM/YYYY') AS tanggal");
        $this->db->from('bap as b');
        $this->db->join('users as u', 'u.nip=b.nip_dosen');
        $this->db->where('bap_kode_matkul', $matkul);
        $this->db->where(" b.tanggal >= ", $awal);
        $this->db->where("b.tanggal <= ", $akhir);
        $query =$this->db->get();
        // var_dump($query->result());exit;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
    public function get_rekap_matkul_prodi($matkul, $awal, $akhir, $prodi) {
        // var_dump($dosen, $awal, $akhir);exit;
        $this->db->select('b.id_bap, b.matakuliah, b.kelas, b.topik, b.cp_pertemuan, b.deskripsi,  b.status, b.nip_dosen, b.bap_id_mkdosen, b.bap_id_prodi, b.pertemuan, u.nama');
        $this->db->select("to_char(b.tanggal,'DD/MM/YYYY') AS tanggal");
        $this->db->from('bap as b');
        $this->db->join('users as u', 'u.nip=b.nip_dosen');
        $this->db->where('bap_id_prodi', $prodi);
        $this->db->where('bap_kode_matkul', $matkul);
        $this->db->where(" b.tanggal >= ", $awal);
        $this->db->where("b.tanggal <= ", $akhir);
        $query =$this->db->get();
        // var_dump($query->result());exit;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_rekap_kelas($kelas, $awal, $akhir) {
        // var_dump($dosen, $awal, $akhir);exit;
        $this->db->select('b.id_bap, b.matakuliah, b.kelas, b.topik, b.cp_pertemuan, b.deskripsi,  b.status, b.nip_dosen, b.bap_id_mkdosen, b.bap_id_prodi, b.pertemuan, u.nama');
        $this->db->select("to_char(b.tanggal,'DD/MM/YYYY') AS tanggal");
        $this->db->from('bap as b');
        $this->db->join('users as u', 'u.nip=b.nip_dosen');
        $this->db->where('kelas', $kelas);
        $this->db->where(" b.tanggal >= ", $awal);
        $this->db->where("b.tanggal <= ", $akhir);
        $query =$this->db->get();
        // var_dump($query->result());exit;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
    public function get_rekap_kelas_prodi($kelas, $awal, $akhir, $prodi) {
        // var_dump($dosen, $awal, $akhir);exit;
        $this->db->select('b.id_bap, b.matakuliah, b.kelas, b.topik, b.cp_pertemuan, b.deskripsi,  b.status, b.nip_dosen, b.bap_id_mkdosen, b.bap_id_prodi, b.pertemuan, u.nama');
        $this->db->select("to_char(b.tanggal,'DD/MM/YYYY') AS tanggal");
        $this->db->from('bap as b');
        $this->db->join('users as u', 'u.nip=b.nip_dosen');
        $this->db->where('bap_id_prodi', $prodi);
        $this->db->where('kelas', $kelas);
        $this->db->where(" b.tanggal >= ", $awal);
        $this->db->where("b.tanggal <= ", $akhir);
        $query =$this->db->get();
        // var_dump($query->result());exit;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
    
}
?>