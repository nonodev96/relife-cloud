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
    
}
?>