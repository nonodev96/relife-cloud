<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Back_end_model');
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in != true) {
            redirect ('index/login');
        }
    }
    
    public function index() {
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('templates/scripts');
    }   
}