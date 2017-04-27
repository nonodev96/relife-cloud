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
    
    public function get_all_users() {
        $query = $this->db->get('users');
        return $query->result();
    }
    
    public function get_number_users() {
        $this->db->from('users');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function get_number_products() {
        $this->db->from('products');
        $query = $this->db->get();
        return $query->num_rows();
    }
}