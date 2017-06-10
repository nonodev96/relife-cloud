<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Favorites extends CI_Controller {

    //region ATTRIBUTES
    public $status = array(
        "meta" => array(),
        "data" => array()
    );
    //endregion

    //region CONSTRUCT
    function __construct() {
        parent::__construct();
        $this->load->model("Users_model");
        $this->load->model("Products_model");
        $this->load->model("Favorites_model");
        $this->output->set_content_type('application/json');

        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Allow-Origin: *');
            header('Cache-Control: no-cache');
        }
    }
    //endregion

    //region CONTROLLER
    private function getJSONError($json_last_error) {
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
    
    private function getJSON() {
        $data_receive = file_get_contents('php://input');
        $json_decode = json_decode($data_receive);
        $json_last_error = json_last_error();
        if ($json_last_error > 0) {
            $JSON_ERROR = $this->getJSONError($json_last_error);
            $this->status["meta"]["json"] = $JSON_ERROR;
            $this->show($this->status, 400);
            exit;
        }

        return json_decode(json_encode($json_decode), TRUE);
    }
    //endregion

    //region HTTP Methods
    public function get($id_user = 0) {
        $user_exist = $this->Users_model->userExist($id_user);
        $status = 200;
        if ($user_exist) {
            $getFavoritesByUserId = $this->Favorites_model->getFavoritesByUserId($id_user);
            $this->status["data"] = $getFavoritesByUserId;
        } else {
            $this->status["data"] = false;
            $status = 404;
        }
        $this->show($this->status, $status);

    }
    
    public function insert() {
        $data = $this->getJSON();
        $http_status = 400;
        $all_correct["id_user_exist"] = $this->Users_model->userExist($data["id_user"]);
        $all_correct["id_product_exist"] = $this->Products_model->productExist($data["id_product"]);
        $all_correct["id_user"] = !empty($data["id_user"]) ? true : false;
        $all_correct["id_product"] = !empty($data["id_product"]) ? true : false;

        if (!in_array(false, $all_correct)) {
            $data_to_insert["id_user"] = $data["id_user"];
            $data_to_insert["id_product"] = $data["id_product"];
            $favorite_exist = $this->Favorites_model->favoriteExist($data_to_insert["id_user"], $data_to_insert["id_product"]);
            if (!$favorite_exist) {
                $insert_id = $this->Favorites_model->insert($data_to_insert);
                if (!empty($insert_id)) {
                    $this->status["data"]["id"] = $insert_id;
                    $http_status = 201;
                }
            } else {
                $this->status["meta"]["error"] = "Favorite exist";
                $http_status = 403;
            }
        } else {
            $this->all_correct($all_correct);

            $http_status = 400;
        }
        $this->show($this->status, $http_status);
    }
    
    public function delete($id = 0) {
        $favorite_exist_by_id = $this->Favorites_model->favoriteExistById($id);
        $status = 200;
        if ($favorite_exist_by_id) {
            $delete = $this->Favorites_model->deleteById($id);
            if ($delete) {
                $this->status["data"]["delete"] = true;
            } else {
                $this->status["data"]["delete"] = false;
                $this->status["meta"]["delete"] = "The favorite could not be deleted";
            }
        } else {
            $this->status["meta"]["delete"] = "The favorite not exist";
            $this->status["data"]["delete"] = false;
            $status = 404;
        }
        $this->show($this->status, $status);
    }
    //endregion

    //region FORMATTED JSON OUTPUT
    private function show($data, $status_http = 200) {
        $in_array_status_http = in_array($status_http, array(400));
        try {
            if (!empty($data) and $in_array_status_http == false) {
                $this->output->set_status_header($status_http);
                echo json_encode($data);
            } elseif (!empty($this->status["meta"])) {
                $this->output->set_status_header($status_http);
                echo json_encode($this->status);
            } else {
                echo json_encode($this->status);
            }
        } catch (Exception $e) {
            echo json_encode(array());
        }
    }
    //endregion
}