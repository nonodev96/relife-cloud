<?php
class Favorites_model extends CI_Model {
    
    public function getAllFavorites() {
        $query = $this->db->get('favorites');
        return $query->result();
    }

    public function getFavoritesByUserId($id_user) {
        $this->db->select('*');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('favorites');
        return $query->result();
    }
    
    public function insert($data) {
        $this->db->insert('favorites', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    
    public function favoriteExist($id_user, $id_product) {
        $this->db->select('*');
        $this->db->where('id_user', $id_user);
        $this->db->where('id_product', $id_product);
        $query = $this->db->get('favorites');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function favoriteExistById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('favorites');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function deleteById($id) {
        return $this->db->delete('favorites', array('id' => $id));
    }
}
