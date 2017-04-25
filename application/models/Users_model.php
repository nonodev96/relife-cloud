<?php
class Users_model extends CI_Model {
    
    public function getAllUsers() {
        $query = $this->db->get('users');
        return $query->result();
    }
    
    public function getUserByID($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->result();
    }
    
    public function insert($data) {
        $this->db->insert('users', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    
    public function updateById($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        return $this->getUserByID($id);
    }
    
    public function deleteById($id) {
        return $this->db->delete('users', array('id' => $id));
    }
    
    public function userExist($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function countEmail($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->num_rows();
    }
    
    public function login($email, $password) {
        $this->db->select('*');
        $this->db->where('email', $email);
        $password = md5($password);
        $this->db->where('password', $password);
        $query = $this->db->get('users');
        return $query->result();
    }
    
}
