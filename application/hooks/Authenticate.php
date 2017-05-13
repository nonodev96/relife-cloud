<?php
class Authenticate {
    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('Back_end_model');
        $this->CI->load->helper('url');
		$this->CI->load->library('user_agent');
    }
  
    public function check_user_login() {
        $route_segment = $this->CI->uri->segment(1);
        
        if ($route_segment != "api") {
            
            $cookie_logged_in = $this->CI->input->cookie('logged_in', false);
            $cookie_user_id = $this->CI->input->cookie('user_id', false);
            
            $logged_in = $this->CI->session->userdata('logged_in');
            $user_id = $this->CI->session->userdata('id');
            
            if ($logged_in != TRUE) {
                if ($cookie_logged_in != TRUE and $logged_in != TRUE and $_SERVER["PATH_INFO"] != "/index/login") {
                    $this->CI->session->set_flashdata('uri_string', uri_string(), 3);
                    redirect('index/login');
                } elseif ($cookie_logged_in == TRUE and $logged_in == TRUE) {
                    // echo '($cookie_logged_in != TRUE and $logged_in == TRUE)';
                    // var_dump($_COOKIE);
                    // var_dump($_SESSION);
                } elseif ($cookie_logged_in == TRUE and !empty($cookie_user_id) and is_numeric($cookie_user_id) and $logged_in != TRUE) {
                    // echo '($cookie_logged_in == TRUE and $logged_in != TRUE)';
                    // var_dump($_COOKIE);
                    // var_dump($_SESSION);
                    $this->loginWithCookieHook($cookie_user_id);
                    redirect('index');
                } elseif ($cookie_logged_in == TRUE and $logged_in == TRUE) {
                    // echo $this->CI->session->flashdata('uri_string');
                    // exit;
                }
            }
        }
    }
    
    private function loginWithCookieHook($id) {
        $this->CI->Back_end_model->loginWithCookies($id);  
    }
    
    private function user_agent() {
        if ($this->CI->agent->is_browser()) {
            $agent = $this->CI->agent->browser() . ' ' . $this->CI->agent->version() . ' ' . $this->CI->agent->mobile();
        } elseif ($this->CI->agent->is_robot()) {
            $agent = $this->CI->agent->robot();
        } elseif ($this->CI->agent->is_mobile()) {
            $agent = $this->CI->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }
        return $agent;
    }
}
?>