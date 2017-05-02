<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Products_model');
    }
    
    public function index() {
        $data["total_users_deletes"] = $this->session->tempdata('total_users_deletes') ?: NULL;
        $data["get_all_products"] = $this->Products_model->getAllProducts();
        $data["templates"]["products"]['title'] = "Productos";
        $data["templates"]["products"]['content'] = $this->load->view('products/index', $data, true);
        $data["module"]["database_table_user"] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('templates/content', $data);
        $this->load->view('templates/scripts', $data);
    } 
    
    public function database() {
        $data["get_all_products"] = $this->Products_model->getAllProducts();
        $data["templates"]["products"]['title'] = "Productos";
        $data["templates"]["products"]['content'] = $this->load->view('products/database_table_products', $data, true);
        $data["module"]["database_table_user"] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('templates/content', $data);
        $this->load->view('templates/scripts', $data);
    }
}