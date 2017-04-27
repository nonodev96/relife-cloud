<?php
class Back_end_model extends CI_Model {

    public function login($email, $password) {
        
        $this->db->where('email' , $email);
        $this->db->where('password', md5($password));
    
        $query = $this->db->get('users');
        
        if ($query->num_rows() > 0) {
            $res = $query->row_array();
    
            $data = array(
                'id' => $res['id'],
                'email' => $res['email'],
                'logged_in' => true,
                'validated' => true
            );
    
            $this->session->set_userdata($data);
            return true;
        } else {
            return false;
        }
    }
}