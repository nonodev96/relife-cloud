<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    var $data = array(
        "templates" => array(
            "t1" => array(
                'title'     =>   'Hello World!',
                'content'   =>   'This is the content',
                'posts'     =>   array('Post 1', 'Post 2', 'Post 3')
            )
        )
    );

    public function __construct() {
        parent::__construct();
        $this->load->model('Back_end_model');
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in != true) {
            redirect ('index/login');
        }
    }
    
    public function index() {
        $data["all_users"] = $this->Back_end_model->get_all_users();
        $data["templates"]["users"]['title'] = "Usuarios";
        $data["templates"]["users"]['content'] = $this->load->view('users/index', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('templates/content', $data);
        $this->load->view('templates/scripts', $data);
    }  
    
    public function edit($id) {
        $data["getUserByID"] = $this->Back_end_model->getUserByID($id);
        $data["templates"]["edit"]['title'] = "Editar: ";
        $data["templates"]["edit"]['content'] = $this->load->view('users/edit', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('templates/content', $data);
        $this->load->view('templates/scripts', $data);
    }  
    
    
    
    public function database() {
        $data["all_users"] = $this->Back_end_model->get_all_users();
        $data["templates"]["users"]['title'] = "Usuarios";
        $data["templates"]["users"]['content'] = $this->load->view('users/database_table_users', $data, true);
        $data["module"]["database_table_user"] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('templates/content', $data);
        $this->load->view('templates/scripts', $data);
    }  
}