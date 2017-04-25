<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    public $status = array(
        "meta" => array(),
        "data" => array()
    );

    function __construct() {
        parent::__construct();
        $this->load->model("Users_model");
        $this->output->set_content_type('application/json');
        header('Access-Control-Allow-Origin: *');
        header('Cache-Control: no-cache');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            // header('Access-Control-Allow-Credentials: true');
            // header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }
    }
    
    private function get_json_error($json_last_error) {
        $JSON_ERROR = null;
        switch ($json_last_error) {
            case JSON_ERROR_NONE:
                $JSON_ERROR = 'Json no errors';
                break;
            case JSON_ERROR_DEPTH:
                $JSON_ERROR = 'Json maximum stack depth exceeded';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $JSON_ERROR = 'Json underflow or the modes mismatch';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $JSON_ERROR = 'Json unexpected control character found';
                break;
            case JSON_ERROR_SYNTAX:
                $JSON_ERROR = 'Json syntax error, malformed JSON';
                break;
            case JSON_ERROR_UTF8:
                $JSON_ERROR = 'Json malformed UTF-8 characters, possibly incorrectly encoded';
                break;
            default:
                $JSON_ERROR = 'Json unknown error';
                break;
        }
        return $JSON_ERROR;
    }
    
    private function get_json() {
        //Json_decode of StdClass to Arrayuyntax
        $data_receive = file_get_contents('php://input');
        $json_decode = json_decode($data_receive);
        $json_last_error = json_last_error();
        if ($json_last_error > 0) {
            $JSON_ERROR = $this->get_json_error($json_last_error);
            $this->status["meta"]["json"] = $JSON_ERROR;
            $this->show($this->status, 400);
            exit;
        }

        return json_decode(json_encode($json_decode), TRUE);
    }
    
    public function index() {
        
    }
    
    /**
     * https://relifecloud-nonodev96.c9users.io/api/user/1
     */ 
    public function get($id = 0) {
        $user_exist = $this->Users_model->userExist($id);
		$status = 200;
		if ($user_exist) {
			$user_by_id = $this->Users_model->getUserByID($id);
			$this->status["data"] = $user_by_id[0];
		} else {
			$this->status["data"] = false;
			$status = 404;
		}
		$this->show($this->status, $status);	
        
    }
    
    /**
     * https://relifecloud-nonodev96.c9users.io/api/user
    { 
    	"nickname":"", 
    	"email":"", 
    	"password":"" 
    }
    return 
    {
        "meta": {
            "nickname": "Nickname cannot be empty"
        }, "data": {
        	
        } 
    }
     */
    public function insert() {
        $data = $this->get_json();
        
        $all_correct["nickname"] = preg_match('/[a-zA-Z]\w{4,14}/', $data["nickname"]) ? true : false;
        $all_correct["email"] = filter_var($data["email"], FILTER_VALIDATE_EMAIL) ? true : false;
        if ($all_correct["email"]) {
            $all_correct["email_count"] = $this->Users_model->countEmail($data["email"]) <= 0 ? true : false;
        } else {
            $all_correct["email_count"] = false;
        }
        $all_correct["password"] = preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $data["password"]) ? true : false;

        if (!in_array(false, $all_correct)) {
            $data["join_date"] = date("Y-m-d H:i:s");
// 			$data["password"] = password_hash($data["password"], PASSWORD_BCRYPT, ["cost" => 12]);
			$data["password"] = md5($data["password"]);
            $insert_id = $this->Users_model->insert($data);
            if(!empty($insert_id)) {
                $this->status["data"]["id"] = $insert_id;
                // $this->status_insert["data"]["uri"] = "/api/user/" . $insert_id;
				$http_status = 201;
			}
        } else {
            if ($all_correct["nickname"] == false) {
                $this->status["meta"]["nickname"] = "Nickname is invalid";
            }
            if ($all_correct["email"] == false) {
                $this->status["meta"]["email"] = "Invalid email: '" . $data["email"] . "'";
            }
            if ($all_correct["password"] == false) {
                $this->status["meta"]["password"] = "Password is invalid";
            }
            
            $http_status = 400;
        }
        $this->show($this->status, $http_status);
    }
    
    
    /**
     * https://relifecloud-nonodev96.c9users.io/api/user/1
    {
        "id":"",
        "nickname":"",
        "first_name":"", 
        "last_name":, 
        "email":"",
        "password":"",
        "location":"",
        "birth_date":"",
        "profile_avatar":""
    }
     */
    public function update($id) {
    	$data = $this->get_json();
		$user_exist = $this->Users_model->userExist($id);
    	$http_status = 200;
	
		if ($user_exist) {
			$all_correct["nickname"] = preg_match('/[a-zA-Z]\w{4,14}/', $data["nickname"]) ? true : false;
	        $all_correct["email"] = filter_var($data["email"], FILTER_VALIDATE_EMAIL) ? true : false;
	        if ($all_correct["email"]) {
                $all_correct["email_count"] = $this->Users_model->countEmail($data["email"]) <= 1 ? true : false;
            } else {
                $all_correct["email_count"] = false;
            }
	        $all_correct["password"] = preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $data["password"]) ? true : false;
			
	        if (!in_array(false, $all_correct)) {
				// $data["password"] = password_hash($data["password"], PASSWORD_BCRYPT, ["cost" => 12]);
				$data["password"] = md5($data["password"]);

				if (!empty($data["profile_avatar"])) {
					$profile_avatar = $data["profile_avatar"];

					$image_base_64["string_64"] = explode(",", $profile_avatar)[1];
					$image_base_64["base64"] = explode(";",  explode(",", $profile_avatar)[0])[1];
					$image_base_64["type"] = explode(";", explode("/", $profile_avatar)[1])[0];
					$image_base_64["data_image"] = explode("/",  $profile_avatar)[0];

					$base64_decode = base64_decode($image_base_64["string_64"]);
                    if ($base64_decode != false) {
    					$data["profile_avatar"] = "user_" . $id . "." . $image_base_64["type"];
					    file_put_contents(getcwd() . '/assets/images/users/' . $data["profile_avatar"], $base64_decode);
                    } else {
                        $data["profile_avatar"] = "stop";
                    }
				}

	        	$update_by_id = $this->Users_model->updateById($data, $id);
				$this->status["data"] = $update_by_id;
	        } else {
	        	if ($all_correct["nickname"] == false) {
	                $this->status["meta"]["nickname"] = "Nickname is invalid";
	            }
	            if ($all_correct["email"] == false) {
	                $this->status["meta"]["email"] = "Invalid email: '" . $data["email"] . "'";
	            }
	            if ($all_correct["password"] == false) {
	                $this->status["meta"]["password"] = "Password is invalid";
				}
		    	$http_status = 400;
	        }
		} else {
			$this->status["meta"]["error"] = "No update";
			$http_status = 404;
		}
    	$this->show($this->status, $http_status);
    }
    
    /**
     * https://relifecloud-nonodev96.c9users.io/api/user/3
     */ 
    public function delete($id = 0) {
		$user_exist = $this->Users_model->userExist($id);
		$status = 200;
		if ($user_exist) {
			$delete = $this->Users_model->deleteById($id);
			if ($delete) {
				$this->status["data"]["delete"] = true;
			}
		} else {
			$this->status["data"]["delete"] = false;
			$status = 404;
		}
		$this->show($this->status, $status);
    }
    
    /**
     * https://relifecloud-nonodev96.c9users.io/api/user/login
     */ 
    public function login() {
        $data = $this->get_json();
   		$http_status = 200;
        $this->status["data"]["status"] = "failed";
        if (!empty($data["email"]) and !empty($data["password"])) {
        	$user_login = $this->Users_model->login($data["email"], $data["password"]);
    		$user_login = count($user_login) > 0 ? $user_login[0] : $user_login;
            $user_login = json_decode(json_encode($user_login), true);
            if (count($user_login) > 0) {
                $user_login["status"] = "succes";
                $this->status["data"] = $user_login;
            }
        } else {
	        $this->status["meta"]["error"] = "Error login";
            if (empty($data["email"])) {
                $this->status["meta"]["email"] = "Invalid email";
            }
            if (empty($data["password"])) {
                $this->status["meta"]["password"] = "Invalid password";
            }
		}
		$this->show($this->status, $http_status);
    }
    
    
    /**
     * https://relifecloud-nonodev96.c9users.io/user/search
    {
      "terms": {
        "nickname": "",
        "email": ""
      },
      "order": {
          
      }
    }
    */
    public function search() {
        echo "search";
    }
   
	public function malformed() {
		$this->status["meta"]["error"] = "URIError: URI malformed";
		echo json_encode($this->status, 400);
	}
	
    public function show($data, $status_http = 200) {
        $in_array_status_http = in_array($status_http, array(400));
        try{
            if (!empty($data) and $in_array_status_http == false) {
                $this->output->set_status_header($status_http);
                echo json_encode($data);
            } elseif(!empty($this->status["meta"])) {
                $this->output->set_status_header($status_http);
                echo json_encode($this->status);
            } else {
                echo json_encode($this->status);
            }
        } catch (Exception $e) {
            echo json_encode(array());
            // $this->output->set_status_header(500)->set_output($e);
        }
    }
}