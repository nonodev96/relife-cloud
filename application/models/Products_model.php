<?php
class Products_model extends CI_Model {
    
    public function getAllProducts() {
        $query = $this->db->get('products');
        return $query->result();
    }
    
    public function getProductByID($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('products');
        return $query->result();
    }
    
    public function insert($data) {
        $this->db->insert('products', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    
    public function updateById($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('products', $data); 
        return $this->getProductByID($id);
    }
    
    public function deleteById($id) {
        return $this->db->delete('products', array('id' => $id));
    }
    
    public function productExist($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('products');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
        
    public function getProductsOfToday() {
        $this->db->select('p.*, u.nickname, u.first_name, u.last_name, u.email, u.profile_avatar');
        $this->db->from('products as p');
        $this->db->join('users as u', 'p.id_user = u.id');
        $this->db->where('p.datetime_product >= now() - INTERVAL 24 HOUR');
        $this->db->order_by("p.datetime_product", "ASC");
        $query = $this->db->get();

        return $query->result();
    }
}
