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
        // var_dump($pass);exit;
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('nip', $nip);
        $this->db->where('password',$password);
        $this->db->limit(1);
        $query = $this->db->get();
        // var_dump($query->result());exit;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    // function get_password($username, $password)
    // {
    //     return sha1($username . $password);
    // }
}
