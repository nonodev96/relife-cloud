<?php
class Authenticate{
    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('Back_end_model');
    }
  
    public function check_user_login() {
        $route_segment = $this->CI->uri->segment(1);
        
        if ($route_segment != "api") {
            
            $cookie_logged_in = $this->CI->input->cookie('logged_in', false);
            $cookie_user_id = $this->CI->input->cookie('user_id', false);
            
            $logged_in = $this->CI->session->userdata('logged_in');
            $user_id = $this->CI->session->userdata('user_id');
            
            if ($logged_in != TRUE) {
                      if ($cookie_logged_in != TRUE and $logged_in != TRUE and $_SERVER["PATH_INFO"] != "/index/login") {
                    redirect('index/login');
                } elseif ($cookie_logged_in != TRUE and $logged_in == TRUE) {
                    echo '($cookie_logged_in != TRUE and $logged_in == TRUE)';
                    var_dump($_COOKIE);
                    var_dump($_SESSION);
                    exit;
                } elseif ($cookie_logged_in == TRUE and $logged_in != TRUE) {
                    echo '($cookie_logged_in == TRUE and $logged_in != TRUE)';
                    var_dump($_COOKIE);
                    var_dump($_SESSION);
                    $this->loginWithCookieHook($_COOKIE['user_id']);
                    exit;
                } elseif ($cookie_logged_in == TRUE and $logged_in == TRUE) {
                    
                }
            }
        }
    }
    
    private function loginWithCookieHook($id) {
        $this->CI->Back_end_model->loginWithCookies($id);  
    }
}
?>