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
}
