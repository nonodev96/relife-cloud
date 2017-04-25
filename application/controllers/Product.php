<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
    
    public $status = array(
        "meta" => array(),
        "data" => array()
    );

    function __construct() {
        parent::__construct();
        $this->load->model("Products_model");
        $this->output->set_content_type('application/json');
        
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
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
     * https://relifecloud-nonodev96.c9users.io/api/product/1
     */ 
    public function get($id = 0) {
        $product_exist = $this->Products_model->productExist($id);
		$status = 200;
		if ($product_exist) {
			$product_by_id = $this->Products_model->getProductByID($id);
			$this->status["data"] = $product_by_id[0];
		} else {
			$this->status["meta"]["id"] = $id;
			$this->status["meta"]["info"] = "The product no exist";
			$status = 404;
		}
		$this->show($this->status, $status);	
        
    }
    
    /**
     * https://relifecloud-nonodev96.c9users.io/api/product
    {
    	"id_user":"",
    	"title":"",
    	"description":"",
    	"image":"",
    	"location":""
    }
    return 
    {
        "meta": [
        ],
        "data": {
            "id":3
        }
    }
     */
    public function insert() {
        $data = $this->get_json();
        $http_status = 400;
        $all_correct["id_user"] = !empty($data["id_user"]) ? true : false;
        $all_correct["title"] = !empty($data["title"]) ? true : false;
        $all_correct["starting_price"] = !empty($data["starting_price"]) ? true : false;
        $all_correct["description"] = !empty($data["description"]) ? true : false;
        $all_correct["location"] = !empty($data["location"]) ? true : false;
        $all_correct["image"] = !empty($data["image"]) ? true : false;

        if (!in_array(false, $all_correct)) {
            $data["datetime_product"] = date("Y-m-d H:i:s");
            $insert_id = $this->Products_model->insert($data);
            if(!empty($insert_id)) {
                if (!empty($data["image"])) {
    				$image = $data["image"];
    				$image_base_64["string_64"] = explode(",", $image)[1];
    				$image_base_64["base64"] = explode(";",  explode(",", $image)[0])[1];
    				$image_base_64["type"] = explode(";", explode("/", $image)[1])[0];
    				$image_base_64["data_image"] = explode("/",  $image)[0];
    
    				$data["image"] = "product_" . $insert_id . "." . $image_base_64["type"];
    				$base64_decode = base64_decode($image_base_64["string_64"]);
                    if ($base64_decode != false) {
    				    file_put_contents(getcwd() . '/assets/images/products/' . $data["image"], $base64_decode);
                    } else {
                        $this->status["meta"]["image"] = "Decode image base64 error";   
                    }
    			}
	        	$update_by_id = $this->Products_model->updateById($data, $insert_id);

                $this->status["data"]["id"] = $insert_id;
				$http_status = 201;
			}
        } else {
            $this->all_correct($all_correct);
            
            $http_status = 400;
        }
        $this->show($this->status, $http_status);
    }
    
    /**
     * https://relifecloud-nonodev96.c9users.io/api/product/1
    {
    	"id":"",
    	"title":"",
    	"description":"",
    	"starting_price":"",
    	"image":"",
    	"location":""
    }
     */
    public function update($id) {
    	$data = $this->get_json();
		$product_exist = $this->Products_model->productExist($id);
    	$http_status = 200;
	
		if ($product_exist) {
            $data["datetime_product"] = date("Y-m-d H:i:s");

			$all_correct["id_user"] = !empty($data["id_user"]) ? true : false;
            $all_correct["title"] = !empty($data["title"]) ? true : false;
            $all_correct["description"] = !empty($data["description"]) ? true : false;
            $all_correct["starting_price"] = !empty($data["starting_price"]) ? true : false;
            $all_correct["location"] = !empty($data["location"]) ? true : false;
            $all_correct["image"] = !empty($data["image"]) ? true : false;
            
	        if (!in_array(false, $all_correct)) {

				if (!empty($data["image"])) {
					$image = $data["image"];
					$image_base_64["string_64"] = explode(",", $image)[1];
					$image_base_64["base64"] = explode(";",  explode(",", $image)[0])[1];
					$image_base_64["type"] = explode(";", explode("/", $image)[1])[0];
					$image_base_64["data_image"] = explode("/",  $image)[0];

					$data["image"] = "product_" . $id . "." . $image_base_64["type"];
					$base64_decode = base64_decode($image_base_64["string_64"]);
                    if ($base64_decode != false) {
					    file_put_contents(getcwd() . '/assets/images/products/' . $data["image"], $base64_decode);
                    } else {
                        $this->status["meta"]["image"] = "Decode image base64 error";   
                    }
				}
	        	$update_by_id = $this->Products_model->updateById($data, $id);
				$this->status["data"] = $update_by_id;
	        } else {
	            $this->all_correct($all_correct);
		    	$http_status = 400;
	        }
		} else {
			$this->status["meta"]["error"] = "No update";
			$http_status = 404;
		}
    	$this->show($this->status, $http_status);
    }
    
    /**
     * https://relifecloud-nonodev96.c9users.io/api/product/3
     * 
     {
        "meta": [
        ],
        "data": {
           "delete": true
        }
    }
     */ 
    public function delete($id = 0) {
		$product_exist = $this->Products_model->productExist($id);
		$status = 200;
		if ($product_exist) {
			$delete = $this->Products_model->deleteById($id);
			if ($delete) {
				$this->status["data"]["delete"] = true;
			} else {
				$this->status["data"]["delete"] = false;
				$this->status["meta"]["delete"] = "The product could not be deleted";
		}
		} else {
			$this->status["meta"]["delete"] = "The product not exist";
			$this->status["data"]["delete"] = false;
			$status = 404;
		}
		$this->show($this->status, $status);
    }
    
    /**
     * https://relifecloud-nonodev96.c9users.io/api/product/getProductsOfToday
     */
    public function getProductsOfToday() {
 		$getProductsOfToday = $this->Products_model->getProductsOfToday();
		$status = 200;
 		if (!empty($getProductsOfToday)){
    		$this->status["data"] = $getProductsOfToday;
 		} else {
 		    $this->status["meta"]["error"] = "No products for today";
 			$status = 200;
    	}
		$this->show($this->status, $status);
    }
    
    /**
     * https://relifecloud-nonodev96.c9users.io/product/search
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
        if (true) {
            
        }
    }
    
    /**
     * Funcions
     */
    private function all_correct($all_correct) {
        if ($all_correct["id_user"] == false) {
            $this->status["meta"]["id_user"] = "I do not know who you are, tell me your user id";
        }
        if ($all_correct["title"] == false) {
            $this->status["meta"]["title"] = "The title is empty";
        }
        if ($all_correct["description"] == false) {
            $this->status["meta"]["description"] = "The description is empty";
        }
        if ($all_correct["starting_price"] == false) {
            $this->status["meta"]["starting_price"] = "An exit price is required";
        }
        if ($all_correct["location"] == false) {
            $this->status["meta"]["location"] = "It is advisable to put a location";
        }
        if ($all_correct["image"] == false) {
            $this->status["meta"]["image"] = "An image is needed";
        }
    }
   
	private function malformed() {
		$this->status["meta"]["error"] = "URIError: URI malformed";
		echo json_encode($this->status, 400);
	}
	
    private function show($data, $status_http = 200) {
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