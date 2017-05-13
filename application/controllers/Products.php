<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Products_model');
        $this->load->model('Users_model');
    }
    
    public function index() {
        $data["total_products_deletes"] = $this->session->tempdata('total_products_deletes') ?: NULL;
        $data["get_all_products"] = $this->Products_model->getAllProducts();
        $data["templates"]["products"]['title'] = "Productos";
        $data["templates"]["products"]['content'] = $this->load->view('products/index', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('templates/content', $data);
        $this->load->view('templates/scripts', $data);
    }
    
    public function edit($id) {
        $data["product_exist"] = $this->Products_model->productExist($id);
        if ($data["product_exist"] != true) {
            redirect ('/products/');
        }
        $data["product_update"] = $this->session->tempdata('product_update') ? TRUE : NULL;
        $input_post = $this->input->post();

        if (!empty($input_post["submit"]) and $input_post["submit"] == "submit") { 
            unset($input_post["submit"]);
            $this->load->helper("dates_helper");
            $input_post["datetime_product"] = dateToMySql($this->input->post('datetime_product'));
            $this->Products_model->updateById($input_post, $input_post["id"]);
            $this->session->set_tempdata('product_update', TRUE, 30);
            $data["product_update"] = $this->session->tempdata('product_update') ? TRUE : NULL;
        }

        $data["module"]["dropzone_plugin"] = true;
        $data["module"]["select_plugin"] = true;
        $data["module"]["lightgallery_plugin"] = true;
        $data["module"]["datetimepicker_plugin"] = true;
        $data["module"]["datetimepicker_plugin_edit_user"] = true;
        $data["get_product"] = $this->Products_model->getProductByID($id);
        $data["get_product"] = !empty($data["get_product"]) ? $data["get_product"][0] : array();
        $data["templates"]["edit"]['title'] = "Editar producto: ";
        $data["templates"]["edit"]['content'] = $this->load->view('products/edit', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('templates/content', $data);
        $this->load->view('templates/scripts', $data);
    }
    
    public function database() {
        $data["get_all_products"] = $this->Products_model->getAllProducts();
        $data["templates"]["products"]['title'] = "Productos";
        $data["templates"]["products"]['content'] = $this->load->view('products/database_table_products', $data, true);
        $data["module"]["database_table"] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('templates/content', $data);
        $this->load->view('templates/scripts', $data);
    }
    
     public function new_product() {
        $input_post = $this->input->post();
        
        $data["product_create"] = $this->session->tempdata('product_create') ? TRUE : NULL;
        unset($input_post["submit"]);
        if (!empty($input_post)) {
            $data["product_create_id"] = $this->Products_model->insert($input_post);
            if ( is_numeric($data["product_create_id"]) ) {
                $this->session->set_tempdata('product_create', TRUE, 5);
                $data["product_create"] = $this->session->tempdata('product_create') ? TRUE : NULL;
                $data["get_product"] = $this->Products_model->getProductByID($data["product_create_id"]);
                $data["get_product"] = !empty($data["get_product"]) ? $data["get_product"][0] : array();
            }
        }

        $data["module"]["dropzone_plugin"] = true;
        $data["module"]["select_plugin"] = true;
        $data["module"]["lightgallery_plugin"] = true;
        $data["module"]["datetimepicker_plugin"] = true;
        $data["module"]["datetimepicker_plugin_edit_user"] = true;
        $data["templates"]["new"]['title'] = "Nuevo producto: ";
        $data["templates"]["new"]['content'] = $this->load->view('products/new', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('templates/content', $data);
        $this->load->view('templates/scripts', $data);
    }
    
    public function deleteProducts() {
        $input_post = $this->input->post();
        $i = 0;
        if (!empty($input_post["deleteByID"])) {
            $this->Products_model->deleteById($input_post["deleteByID"]);
            $i++;
        } elseif(!empty($input_post["deleteByIds"])) {
            if(!empty($input_post["checkbox_products"])) {
                foreach ($input_post["checkbox_products"] as $key => $value ) {
                    $this->Products_model->deleteById($value);
                    $i++;
                }
            }    
        }
        
        $this->session->set_tempdata('total_products_deletes', $i, 5);
        redirect('/products');
    }
    
    public function uploadImage($id) {
        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $format = strtolower(explode(".", $_FILES['file']['name'])[1]);
            $fileName = "products_" . $id . "." . $format;
            $targetPath = getcwd() . '/assets/images/products/';
            $targetFile = $targetPath . $fileName ;
            $move_uploaded_file = move_uploaded_file($tempFile, $targetFile);
            if ($move_uploaded_file) {
                $data_upload['image'] = $fileName;
                $this->db->where('id', $id);
                $this->db->update('products', $data_upload);
                $this->session->set_tempdata('product_update', TRUE, 30);
            }
        }
        redirect('/products/edit/' . $id);
    }
}