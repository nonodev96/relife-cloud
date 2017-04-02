<?php
class Users_model extends CI_Model {
    
    /*
    SQL:
    
    CREATE DATABASE relife;
    CREATE TABLE IF NOT EXISTS `users` (
        `nickname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NOT NULL,
        `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
        `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
        `email` varchar(340) COLLATE utf8_unicode_ci DEFAULT NOT NULL,
        `password` varchar(40) COLLATE utf8_unicode_ci DEFAULT NOT NULL,
        `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `join_date` datetime DEFAULT NOT NULL,
        `birth_date` datetime NOT NULL,
        `profile_avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL
    )
       
    */
    
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
    
}
?>