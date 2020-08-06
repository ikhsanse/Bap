<?php
class Users extends CI_Model
{

    function logged_in()
    {
        return $this->session->userdata('user_id');
    }

    function check_login($nip, $password)
    {
        // $pass = (json_encode($password));
        // var_dump($password);exit;
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('nip', $nip);
        $this->db->where('password',$password);
        $this->db->where('status','active');
        $this->db->limit(1);
        $query = $this->db->get();
        // var_dump($query->result());exit;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
    
    function check_user($nip)
    {
        // $pass = (json_encode($password));
        // var_dump($pass);exit;
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('nip', $nip);
        // $this->db->where('password',$password);
        $this->db->limit(1);
        $query = $this->db->get();
        // var_dump($query->result());exit;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function check_nip($nip)
    {
        // $pass = (json_encode($password));
        // var_dump($pass);exit;
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('nip', $nip);
        // $this->db->where('password',$password);
        $this->db->limit(1);
        $query = $this->db->get();
        // var_dump($query->result());exit;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row()->nip;
        }
    }
    public function get_list_user() {
        $this->db->select('u.nip, u.nama, u.status, u.password, u.roles, r.role');
        $this->db->from('users as u');
        $this->db->join('roles as r', 'r.id_role=u.roles');
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function create($data, $table) {

        // var_dump($data['tanggal']);exit;
        $query = $this->db->insert($table, $data);
        // var_dump($query);exit;
        return $query;   
    }

    public function get_roles()
    {
        $this->db->select('*');
        $this->db->from('roles');
        // $this->db->where('roles');
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
    
    public function update () {
        $nip = $this->input->post('nip');
        $awal = $this->input->post('nip-awal');
        $nama = $this->input->post('user');
        $pass = $this->input->post('password');
        // $password = sha1($pass);
        $role = $this->input->post('id-role');
        $status = $this->input->post('status');
    
       
        $this->db->set('nip', $nip);
        $this->db->set('roles', $role);
        $this->db->set('nama', $nama);
        $this->db->set('status', $status);
        $this->db->where('nip', $awal);
        $query = $this->db->update('users');

        return $query;
    }
    public function updatemk() {
        $nip = $this->input->post('nip');
        $awal = $this->input->post('nip-awal');
        $this->db->set('nip_dosen', $nip);
        $this->db->where('nip_dosen', $awal);
        $query = $this->db->update('mk_dosen');
        return $query;
    }
    public function updatenip() {
        $nip = $this->input->post('nip');
        $awal = $this->input->post('nip-awal');
        $this->db->set('nip_dosen', $nip);
        $this->db->where('nip_dosen', $awal);
        $query = $this->db->update('bap');
        return $query;
    }
}
