<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

    var $data = array(
        "templates" => array(
        )
    );

    public function __construct() {
        parent::__construct();
        $this->load->model('Back_end_model');
        $this->load->model('Users_model');
        $this->load->model('Products_model');
        $this->load->helper('date');
        $this->load->helper('language');
    }

    public function index() {
        $data = $this->data;
        //region DASHBOARD USERS
        $data["dashboard"]["total_users"] = $this->Users_model->getTotalUsers();
        $data["dashboard"]["dashboard_users"] = $this->Users_model->dashboard();
        $data["dashboard"]["dashboard_users_chart_js"] = $this->dashboardChartjs($data["dashboard"]["dashboard_users"]);
        //endregion
        //region DASHBOARD PRODUCTS
        $data["dashboard"]["total_products"] = $this->Products_model->getTotalProducts();
        $data["dashboard"]["dashboard_products"] = $this->Products_model->dashboard();
        $data["dashboard"]["dashboard_products_chart_js"] = $this->dashboardChartjs($data["dashboard"]["dashboard_products"]);
        //endregion
        $data["templates"]["dashboard"]["title"] = "Dashboard";
        $data["templates"]["dashboard"]["content"] = $this->load->view('dashboard/index', $data, true);
        $data["body_class"] = "theme-red";
        $data["module"]["chartjs_dashboard"] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('templates/content', $data);
        $this->load->view('templates/scripts', $data);
    }

    public function user() {
        $data["body_class"] = "theme-red";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('templates/content', $data);
        $this->load->view('templates/scripts', $data);

    }
    
    public function login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        
        $remember_me_post = $this->input->post('rememberme');
        $result = $this->Back_end_model->login($email, $password);
        
        $data["body_class"] ="login-page";
        $this->load->view('templates/header', $data);
        $this->load->view('auth/login', $data);
        $this->load->view('templates/scripts', $data);
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in == true) {
            if ($remember_me_post == TRUE) {
                $cookie = array(
                    'name'   => 'user_id',
                    'value'  => $this->session->userdata('user_id'),
                    'expire' =>  365*24*60*60,
                    'secure' => false
                );
                $this->input->set_cookie($cookie);
                
                $cookie = array(
                    'name'   => 'logged_in',
                    'value'  => TRUE,
                    'expire' =>  365*24*60*60,
                    'secure' => false
                );
                $this->input->set_cookie($cookie); 
            }
            redirect ('');
        }
        
    }
    
    public function logout() {
        $this->session->sess_destroy();
        // unset cookies
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }
        redirect('index/index');
    }
    
    private function dashboardChartjs($dashboard) {
        $return = array(
            "labels"=>"",
            "data"=>""
        );
        foreach ($dashboard as $key => $value) {
          $date_letters = $this->dateInSpanish(strftime('%A', strtotime($value["date"])));
          $date_number = strftime('%d', strtotime($value["date"]));
          
          $return["labels"] .= '"' . $date_letters . ', ' . $date_number . '",';
        }
        
        foreach ($dashboard as $key => $value) {
          $return["data"] .= '"' . $value["total"] . '",';
        }
        
        return $return;
    }
    
    private function dateInSpanish($date_letters) {
        $return = "";
        switch ($date_letters) {
            case "Monday": 
                $return = "Lunes"; 
                break;
            case "Tuesday": 
                $return = "Martes"; 
                break;
            case "Wednesday": 
                $return = "Miércoles"; 
                break;
            case "Thursday": 
                $return = "Jueves"; 
                break;
            case "Friday": 
                $return = "Viernes"; 
                break;
            case "Saturday": 
                $return = "Sábado"; 
                break;
            case "Sunday": 
                $return = "Domingo"; 
                break;
        }
        return $return;
    }
}