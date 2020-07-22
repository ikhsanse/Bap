<?php
class Kelas_m extends CI_Model {

    public function get_kelas_jurusan(){
        $this->db->select('k.id_kelas, k.nama_kelas, k.semester, k.id_prodi, k.thn_masuk, p.namaprod');
        $this->db->from('kelas as k');
        $this->db->join('prodi as p', 'p.prodi_id=k.id_prodi');
        $query =$this->db->get();

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
    public function get_kelas_prodi($prodi){
        $this->db->select('k.id_kelas, k.nama_kelas, k.semester, k.id_prodi, k.thn_masuk, p.namaprod');
        $this->db->from('kelas as k');
        $this->db->join('prodi as p', 'p.prodi_id=k.id_prodi');
        $this->db->where('k.id_prodi', $prodi);
        $query =$this->db->get();

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
    public function check_kelas($kelas, $tahun) {
        $this->db->select('*');
        $this->db->from('kelas');
        $this->db->where('nama_kelas', $kelas);
        $this->db->where('thn_masuk', $tahun);
        $query =$this->db->get();
        // var_dump($query->result());exit;
        return $query->result();
    }
    public function create($data, $table) {

        // var_dump($data['tanggal']);exit;
        $query = $this->db->insert($table, $data);
        // var_dump($query);exit;
        return $query;   
    }

    public function check_kelas_edit ($kelas, $tahun) {
        $this->db->select('*');
        $this->db->from('kelas');
        $this->db->where('nama_kelas', $kelas);
        $this->db->where('thn_masuk', $tahun);
        $query =$this->db->get();

        if($query->num_rows() == 0) {
            return false;
        } else {
            return $query->row()->nama_kelas;
        }
    }
    public function check_tahun_edit ($kelas, $tahun) {
        $this->db->select('*');
        $this->db->from('kelas');
        $this->db->where('nama_kelas', $kelas);
        $this->db->where('thn_masuk', $tahun);
        $query =$this->db->get();

        if($query->num_rows() == 0) {
            return false;
        } else {
            return $query->row()->thn_masuk;
        }
    }

    public function update () {
        $id = $this->input->post('id');
        $tahun = $this->input->post('tahun');
        $semester = $this->input->post('semester');
        $kelas = $this->input->post('kelas');
        $prod = $this->input->post('prodi');
        if($prod == 'TI'){
            $prodi = 111;
        } elseif($prod == 'TMJ'){
            $prodi = 112;
        }elseif($prod == 'TMD'){
            $prodi = 113;
        };
       
        $this->db->set('nama_kelas', $kelas);
        $this->db->set('id_prodi', $prodi);
        $this->db->set('thn_masuk', $tahun);
        $this->db->set('semester', $semester);
        $this->db->where('id_kelas', $id);
        $query = $this->db->update('kelas');

        return $query;
    }
}
?>