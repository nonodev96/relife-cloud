<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Debug extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $data = array();
        $data["templates"]["debug"]["title"] = "Depurar";
        $data["templates"]["debug"]["content"] = $this->load->view('templates/debug', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('templates/content', $data);
        $this->load->view('templates/scripts', $data);
    }   
}