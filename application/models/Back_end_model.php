<?php
class Back_end_model extends CI_Model {

    public function login($email, $password) {
        $this->db->where('email' , $email);
        $this->db->where('password', md5($password));
        $this->db->where('role', '2');
        $query = $this->db->get('users');
        
        if ($query->num_rows() > 0) {
            $res = $query->row_array();
            $data = $res;
            $data['logged_in'] = TRUE;
            
            $this->session->set_userdata($data);
            return true;
        } else {
            return false;
        }
    }
    
    public function loginWithCookies($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        
        if ($query->num_rows() > 0) {
            $res = $query->row_array();
            $data = $res;
            $data['logged_in'] = TRUE;
            
            $this->session->set_userdata($data);
            return true;
        } else {
            return false;
        }
    }
}