<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sale extends CI_Controller {

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
        $this->load->model("Sale_model");
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
    
    private function checkData($all_correct){
        if ($all_correct["id_user"] == false) {
            $this->status["meta"]["id_user"] = "Id usuario erroneo";
        }
        if ($all_correct["id_product"] == false) {
            $this->status["meta"]["id_product"] = "Id producto incorrecto";
        }
        if ($all_correct["bid"] == false) {
            $this->status["meta"]["bid"] = "Error en la puja";
        }
        return 400;
    }
    //endregion

    //region HTTP Methods
    public function get($id_product = 0) {
        $hasBids = $this->Sale_model->hasBids($id_product);
        if ($hasBids) {
            $getAllBidsByIdProduct = $this->Sale_model->getAllBidsByIdProduct($id_product);
            $getAllBids = array();
            foreach ($getAllBidsByIdProduct as $key => $value) {
                $getAllBids = $value;
                $getAllBids->user = $this->Users_model->getUserByID($value->id_user)[0];
            }
            $countAllBidsByIdProduct = $this->Sale_model->countAllBidsByIdProduct($id_product);
            $maxBidByIdProduct = $this->Sale_model->maxBidByIdProduct($id_product);
            $minBidByIdProduct = $this->Sale_model->minBidByIdProduct($id_product);
            $this->status["data"] = $getAllBids;
            $this->status["meta"]["total"] = $countAllBidsByIdProduct;
            $this->status["meta"]["max"] = $maxBidByIdProduct;
            $this->status["meta"]["min"] = $minBidByIdProduct;
        }
        $status = 200;
        $this->show($this->status, $status);
    }
    
    public function getAllBids() {
        $this->status["data"] = $this->Sale_model->getAllBids();
        $status = 200;
        $this->show($this->status, $status);
    }

    public function insert() {
        $data = $this->getJSON();
        $http_status = 400;
        $all_correct["id_user"] = is_numeric($data["id_user"]) ? true : false;
        $all_correct["id_product"] = is_numeric($data["id_product"]) ? true : false;
        $all_correct["bid"] = is_numeric($data["bid"]) ? true : false;

        if (!in_array(false, $all_correct)) {

            $insert_id = $this->Sale_model->insert($data);
            if (!empty($insert_id)) {
                $this->status["data"]["id"] = $insert_id;
                $http_status = 201;
            }
        } else {
            $this->checkData($all_correct);
        }
        $this->show($this->status, $http_status);
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