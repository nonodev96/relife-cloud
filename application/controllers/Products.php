<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Products_model');
        $this->load->model('Users_model');
        $this->load->model('Sale_model');
    }
    
    public function index() {
        $data["total_products_deletes"] = $this->session->tempdata('total_products_deletes') ?: NULL;
        $data["opensearch"] = $this->session->tempdata('opensearch') ?: NULL;
        
        $input_post = $this->input->post();
        if (
            (!empty($input_post["text"]) and !empty($input_post["search"]) and $input_post["search"] == "search")
            or 
            (!empty($data["opensearch"]["text"]) and !empty($data["opensearch"]["search"]) and $data["opensearch"]["search"] == "search")
        ) {
            $text = !empty($input_post["text"]) ? $input_post["text"] : $data["opensearch"]["text"];
            $keyword = strip_tags($text);
            $keyword = urldecode($keyword);
             
            $data["get_all_products"] = $this->Products_model->search($keyword);
            $data["templates"]["products"]['title'] = "Buscado productos";
            $data["templates"]["products"]['keyword'] = $keyword;
            $data["templates"]["products"]['content'] = $this->load->view('products/index', $data, true);
        } else {
            $data["get_all_products"] = $this->Products_model->getAllProducts();    
            $data["templates"]["products"]['title'] = "Productos";
            $data["templates"]["products"]['content'] = $this->load->view('products/index', $data, true);
        }
        
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
        $data["get_bids"] = array();
        $data["has_bids"] = $this->Sale_model->hasBids($id);
        if ($data["has_bids"] == TRUE) {
            $data["get_bids"]["max"] = $this->Sale_model->maxBidByIdProduct($id);
            $data["get_bids"]["min"] = $this->Sale_model->minBidByIdProduct($id);
            $data["get_bids"]["count"] = $this->Sale_model->countAllBidsByIdProduct($id);
            $data["get_bids"]["all_bids"] = $this->Sale_model->getAllBidsByIdProduct($id);
        }
        
        $data["get_product"] = !empty($data["get_product"]) ? $data["get_product"][0] : array();
        $data["templates"]["edit"]['title'] = "Editar producto: ";
        $data["templates"]["edit"]['content'] = $this->load->view('products/edit', $data, true);
        $data["templates"]["bids"]['title'] = "Editar pujas: ";
        $data["templates"]["bids"]['content'] = $this->load->view('products/bids', $data, true);
        
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
    
    public function search($query) {
        $tempdata = array(
            'text' => $query,
            'search' => 'search'
        );
        $this->session->set_tempdata('opensearch', $tempdata, 15);
        redirect('products');
    }
    
    public function new_product() {
        $input_post = $this->input->post();
        
        $data["product_create"] = $this->session->tempdata('product_create') ? TRUE : NULL;
        unset($input_post["submit"]);
        if (!empty($input_post)) {
            $data["product_create_id"] = $this->Products_model->insert($input_post);
            if (is_numeric($data["product_create_id"])) {
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
    
    public function addBid() {
        $input_post = $this->input->post();
        $data = array(
            'id_product' => $input_post['id_product'],
            'id_user' => $input_post['id_user'],
            'bid' => $input_post['bid']
        );
        $data["sale_id"] = $this->Sale_model->insert($data);

        redirect('/products/' . $input_post["id_product"]);
    }
    
    public function deleteBid() {
        $input_post = $this->input->post();
        $data = array(
            'id' => $input_post['id'],
        );
        $delete = $this->Sale_model->deleteBid($data);

        redirect('/products/' . $input_post["id_product"]);
    }
}