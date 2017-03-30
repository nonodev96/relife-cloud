<?php
class Users_model extends CI_Model {
    
    /*
    SQL:
    
    
    CREATE DATABASE relife;
    CREATE TABLE IF NOT EXISTS `users` (
        `nickname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
        `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
        `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
        `email` varchar(340) COLLATE utf8_unicode_ci DEFAULT NULL,
        `password` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
        `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `join_date` datetime DEFAULT NULL,
        `birth_date` datetime NOT NULL,
        `profile_avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL
    )
       
    */
    
    public function getAllUsers() {
            $query = $this->db->get('users');
            return $query->result();
    }
}
?>