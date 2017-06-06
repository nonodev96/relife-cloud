<?php
class Sale_model extends CI_Model {
    
    public function getAllBids() {
        $query = $this->db->get('sale');
        return $query->result();
    }

    public function getAllBidsByIdProduct($id_product = 1) {
        $this->db->where('id_product', $id_product);
        $this->db->from('sale');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function countAllBidsByIdProduct($id_product = 1) {
        $this->db->where('id_product', $id_product);
        $this->db->from('sale');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function maxBidByIdProduct($id_product = 1) {
        $this->db->select('*');
        $this->db->select_max('bid');
        $this->db->where('id_product', $id_product);
        $this->db->from('sale');
        $query = $this->db->get();
        return $query->result()[0];
    }
    
    public function minBidByIdProduct($id_product = 1) {
        $this->db->select('*');
        $this->db->select_min('bid');
        $this->db->where('id_product', $id_product);
        $this->db->from('sale');
        $query = $this->db->get();
        return $query->result()[0];
    }
    
    public function hasBids($id_product) {
        $this->db->where('id_product', $id_product);
        $query = $this->db->get('sale');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function insert($data) {
        $data["datetime_sale"] = date('Y-m-d H:i:s');
        $this->db->insert('sale', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    
    public function deleteBid($data) {
        $this->db->where(
            array(
                "id" => $data["id"]
            )
        );
        $this->db->delete("sale");
        if($this->db->affected_rows() > 0){
            return true;
        } else{
            return false;
        }
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
