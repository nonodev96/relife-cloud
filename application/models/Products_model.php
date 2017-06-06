<?php
class Products_model extends CI_Model {
    
    public function getAllProducts() {
        $query = $this->db->get('products');
        return $query->result();
    }

    public function getTotalProducts() {
        $this->db->from('products');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getProductByID($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('products');
        return $query->result();
    }
    
    public function insert($data) {
        $data["datetime_product"] = date('Y-m-d H:i:s');
        $this->db->insert('products', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    
    public function updateById($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('products', $data); 
        return $this->getProductByID($id);
    }
    
    public function deleteById($id) {
        return $this->db->delete('products', array('id' => $id));
    }
    
    public function search($keyword) {
        $this->db->like('title', $keyword);
        $this->db->or_like('description', $keyword);
        $query = $this->db->get('products');
        return $query->result();
    }
    
    public function getProductsSearch($data) {
        if (!empty($data["title"])) $this->db->like('title', $data["title"]);
        if (!empty($data["description"])) $this->db->or_like('description', $data["description"]);
        if (!empty($data["starting_price"]["lower"])) $this->db->where('starting_price >=', $data["starting_price"]["lower"]);
        if (!empty($data["starting_price"]["upper"])) $this->db->where('starting_price <=', $data["starting_price"]["upper"]);
        if (!empty($data["datetime_product"])) $this->db->where('DATE(datetime_product)', $data["datetime_product"]);
        if (!empty($data["category"])) $this->db->where('category', $data["category"]);
        if (!empty($data["location"])) $this->db->like('location', $data["location"]);
        
        $query = $this->db->get('products');
        return $query->result();
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
        $this->db->order_by("p.datetime_product", "DESC");
        $query = $this->db->get();

        return $query->result();
    }
    
    public function dashboard() {
        $result = array();
        $last_week = new DateTime();
        $last_week->modify("-7 day");
        $now = new DateTime();
        for ($i = 0; $i <= 7; $i++) {
            $this->db->where('Date(datetime_product)', date_format($last_week, 'Y-m-d'));
            $query = $this->db->get('products');
            $result[$i]["total"] = $query->num_rows();
            $result[$i]["date"] = date_format($last_week, 'Y-m-d');
            $last_week->modify("+1 day");
        }
        return $result;
    }
}
