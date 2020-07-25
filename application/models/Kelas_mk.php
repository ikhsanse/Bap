<?php

class Kelas_mk extends CI_Model
{
    public function get_matkul_jurusan()
    {
        $this->db->select('md.id_mkdosen, md.id_kelas, md.id_prodi, md.kode_matkul, md.nip_dosen, md.status, md.thn_masuk_kls, d.nama, k.nama_kelas, k.semester, mk.namamk, pd.namaprod');
        $this->db->from('mk_dosen as md');
        $this->db->join('users as d', 'd.nip=md.nip_dosen');
        $this->db->join('kelas as k', 'k.id_kelas=md.id_kelas');
        $this->db->join('matakuliah as mk', 'mk.kodemk=md.kode_matkul');
        $this->db->join('prodi as pd', 'pd.prodi_id=md.id_prodi');
        $query = $this->db->get();
        // var_dump($query->result());exit;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
    public function get_matkul_prodi($prodi)
    {
        $this->db->select('md.id_mkdosen, md.id_kelas, md.id_prodi, md.kode_matkul, md.nip_dosen, md.status, md.thn_masuk_kls, d.nama, k.nama_kelas, k.semester, mk.namamk, pd.namaprod');
        $this->db->from('mk_dosen as md');
        $this->db->join('users as d', 'd.nip=md.nip_dosen');
        $this->db->join('kelas as k', 'k.id_kelas=md.id_kelas');
        $this->db->join('matakuliah as mk', 'mk.kodemk=md.kode_matkul');
        $this->db->join('prodi as pd', 'pd.prodi_id=md.id_prodi');
        $this->db->where('md.id_prodi', $prodi);
        $query = $this->db->get();
        // var_dump($query->result());exit;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_kelas_jurusan()
    {
        $this->db->distinct();
        $this->db->select('nama_kelas');
        $this->db->order_by("nama_kelas", "asc");
        // $this->db->where('id_prodi', '111');
        $query = $this->db->get('kelas');

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
    public function get_kelas_prodi($prodi)
    {
        $this->db->distinct();
        $this->db->select('nama_kelas');
        $this->db->order_by("nama_kelas", "asc");
        $this->db->where('id_prodi', $prodi);
        $query = $this->db->get('kelas');

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_tahun_kelas()
    {
        $this->db->distinct();
        $this->db->select('thn_masuk');
        $this->db->order_by("thn_masuk", "desc");
        $query = $this->db->get('kelas');

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_prodi_kelas($kelas)
    {
        $this->db->select('id_prodi');
        $this->db->from('kelas');
        $this->db->where('nama_kelas', $kelas);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row()->id_prodi;
        }
    }

    public function get_dosen()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('roles', '2');
        $this->db->or_where('roles', '3');
        $this->db->or_where('roles', '4');
        $this->db->or_where('roles', '5');
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function get_matkul_all()
    {
        $this->db->select('*');
        $this->db->from('matakuliah');
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
 
    public function get_id_kelas($kelas, $tahun){
        $this->db->select('id_kelas');
        $this->db->from('kelas');
        $this->db->where('nama_kelas', $kelas);
        $this->db->where('thn_masuk', $tahun);
        $query =$this->db->get();

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row()->id_kelas;
        }
    }
    public function get_mkdosen($data){
        $this->db->select('*');
        $this->db->from('mk_dosen');
        $this->db->where('id_kelas', $data['id_kelas']);
        $this->db->where('nip_dosen', $data['nip_dosen']);
        $this->db->where('kode_matkul', $data['kode_matkul']);
        $this->db->where('thn_masuk_kls', $data['thn_masuk_kls']);

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

    public function get_kode_matkul($id) {
        $this->db->select('kodemk');
        $this->db->from('matakuliah');
        $this->db->where('kodemk', $id);
        $query = $this->db->get();

        // var_dump($query->result());exit;
        return $query->result();
    }

    public function get_nip_dosen($id) {
        $this->db->select('nip');
        $this->db->from('users');
        $this->db->where('nip', $id);
        $query = $this->db->get();

        // var_dump($query->result());exit;
        return $query->result();
    }

    public function check_prodi_edit($data) {
        $this->db->select('*');
        $this->db->from('mk_dosen');
        $this->db->where('id_prodi', $data['id_prodi']);
        $this->db->where('thn_masuk_kls', $data['thn_masuk_kls']);
        $this->db->where('nip_dosen', $data['nip_dosen']);
        $this->db->where('id_kelas', $data['id_kelas']);
        $this->db->where('kode_matkul', $data['kode_matkul']);
        $query =$this->db->get();

        if($query->num_rows() == 0) {
            return false;
        } else {
            return $query->row()->id_prodi;
        }
    }
    public function check_kelas_edit($data) {
        $this->db->select('*');
        $this->db->from('mk_dosen');
        $this->db->where('id_prodi', $data['id_prodi']);
        $this->db->where('thn_masuk_kls', $data['thn_masuk_kls']);
        $this->db->where('nip_dosen', $data['nip_dosen']);
        $this->db->where('id_kelas', $data['id_kelas']);
        $this->db->where('kode_matkul', $data['kode_matkul']);
        $query =$this->db->get();

        if($query->num_rows() == 0) {
            return false;
        } else {
            return $query->row()->id_kelas;
        }
    }
    public function check_tahun_edit($data) {
        $this->db->select('*');
        $this->db->from('mk_dosen');
        $this->db->where('id_prodi', $data['id_prodi']);
        $this->db->where('thn_masuk_kls', $data['thn_masuk_kls']);
        $this->db->where('nip_dosen', $data['nip_dosen']);
        $this->db->where('id_kelas', $data['id_kelas']);
        $this->db->where('kode_matkul', $data['kode_matkul']);
        $query =$this->db->get();

        if($query->num_rows() == 0) {
            return false;
        } else {
            return $query->row()->thn_masuk_kls;
        }
    }
    public function check_matkul_edit($data) {
        $this->db->select('*');
        $this->db->from('mk_dosen');
        $this->db->where('id_prodi', $data['id_prodi']);
        $this->db->where('thn_masuk_kls', $data['thn_masuk_kls']);
        $this->db->where('nip_dosen', $data['nip_dosen']);
        $this->db->where('id_kelas', $data['id_kelas']);
        $this->db->where('kode_matkul', $data['kode_matkul']);
        $query =$this->db->get();

        if($query->num_rows() == 0) {
            return false;
        } else {
            return $query->row()->kode_matkul;
        }
    }
    public function check_nip_edit($data) {
        $this->db->select('*');
        $this->db->from('mk_dosen');
        $this->db->where('id_prodi', $data['id_prodi']);
        $this->db->where('thn_masuk_kls', $data['thn_masuk_kls']);
        $this->db->where('nip_dosen', $data['nip_dosen']);
        $this->db->where('id_kelas', $data['id_kelas']);
        $this->db->where('kode_matkul', $data['kode_matkul']);
        $query =$this->db->get();

        if($query->num_rows() == 0) {
            return false;
        } else {
            return $query->row()->nip_dosen;
        }
    }
    public function check_mkdosen($data) {
        $this->db->select('*');
        $this->db->from('mk_dosen');
        $this->db->where('id_prodi', $data['id_prodi']);
        $this->db->where('thn_masuk_kls', $data['thn_masuk_kls']);
        $this->db->where('nip_dosen', $data['nip_dosen']);
        $this->db->where('id_kelas', $data['id_kelas']);
        $this->db->where('kode_matkul', $data['kode_matkul']);
        $query =$this->db->get();

        if($query->num_rows() == 0) {
            return false;
        } else {
            return $query->result();
        }
    }

    public function update($data) {
        $this->db->set('id_prodi', $data['id_prodi']);
        $this->db->set('id_kelas', $data['id_kelas']);
        $this->db->set('thn_masuk_kls', $data['thn_masuk_kls']);
        $this->db->set('nip_dosen', $data['nip_dosen']);
        $this->db->set('kode_matkul', $data['kode_matkul']);
        $this->db->set('status', $data['status']);
        $this->db->where('id_mkdosen', $data['id_mkdosen']);
        $query = $this->db->update('mk_dosen');

        return $query;
    }
}
