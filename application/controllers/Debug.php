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
    
    public function deleteSession() {
        $this->session->sess_destroy();
        redirect("debug");
    }
    
    public function deleteCookies() {
        var_dump($_COOKIE);
        foreach ($_COOKIE as $key => $value) {
            if (isset($_COOKIE[$key])) {
                unset($_COOKIE[$key]);
                setcookie($key, null, -1, '/');
            }
        }
        var_dump($_COOKIE);
    }
    
    public function editor() {
        $data = array();
        $data["module"]["editor_md"] = true;
        $data["templates"]["editor_md"]["title"] = "Editar";
        $data["templates"]["editor_md"]["content"] = $this->load->view('editor/simple_example', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('templates/content', $data);
        $this->load->view('templates/scripts', $data);
    }
}