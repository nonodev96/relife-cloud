<?php
class Users_model extends CI_Model {
    
    public function getAllUsers() {
        $query = $this->db->get('users');
        return $query->result();
    }

    public function getTotalUsers() {
        $this->db->from('users');
        $query = $this->db->get();
        return $query->num_rows();
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
        return $insert_id;
    }
    
    public function updateById($data, $id) {
        var_dump($data);
exit;
        $this->db->where('id', $id);
        $valid = preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $data["password"]) ? true : false;
        if (!empty($data['password']) and $data['password'] != '' and true == $valid) {
            $data["password"] = md5($data["password"]); 
        } else {
            unset($data['password']);
        }
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
    
    public function dashboard() {
        $result = array();
        $last_week = new DateTime();
        $last_week->modify("-7 day");

        for ($i = 0; $i <= 7; $i++) {
            $this->db->where('Date(join_date)', date_format($last_week, 'Y-m-d'));
            $query = $this->db->get('users');
            $result[$i]["total"] = $query->num_rows();
            $result[$i]["date"] = date_format($last_week, 'Y-m-d');
            $last_week->modify("+1 day");
        }
        return $result;
    }

}
