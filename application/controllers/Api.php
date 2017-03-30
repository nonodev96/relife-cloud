<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("Users_model");
    }
    
	public function index() {
	    $all_users = $this->Users_model->getAllUsers();
		var_dump($all_users);
	}
}
