<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    var $data = array(
        "templates" => array(
            "t1" => array(
                'title'     =>   'Hello World!',
                'content'   =>   'This is the content',
                'posts'     =>   array('Post 1', 'Post 2', 'Post 3')
            )
        )
    );

    function __construct() {
        parent::__construct();
        $this->load->model('Users_model');
    }
    
    public function index() {
        $data["total_users_deletes"] = $this->session->tempdata('total_users_deletes') ?: NULL;
        $data["all_users"] = $this->Users_model->getAllUsers();
        $data["templates"]["users"]['title'] = "Usuarios";
        $data["templates"]["users"]['content'] = $this->load->view('users/index', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('templates/content', $data);
        $this->load->view('templates/scripts', $data);
    }
    
    public function new_user() {
        $input_post = $this->input->post();
        
        $data["user_create"] = $this->session->tempdata('user_create') ? TRUE : NULL;
        unset($input_post["submit"]);
        if (!empty($input_post)) {
            $data["user_create_id"] = $this->Users_model->insert($input_post);
            if ( is_numeric($data["user_create_id"]) ) {
                $this->session->set_tempdata('user_create', TRUE, 5);
                $data["user_create"] = $this->session->tempdata('user_create') ? TRUE : NULL;
                $data["get_user"] = $this->Users_model->getUserByID($data["user_create_id"]);
                $data["get_user"] = !empty($data["get_user"]) ? $data["get_user"][0] : array();
            }
        }

        $data["module"]["dropzone_plugin"] = true;
        $data["module"]["select_plugin"] = true;
        $data["module"]["lightgallery_plugin"] = true;
        $data["module"]["datetimepicker_plugin"] = true;
        $data["module"]["datetimepicker_plugin_edit_user"] = true;
        $data["templates"]["new"]['title'] = "Nuevo usuario: ";
        $data["templates"]["new"]['content'] = $this->load->view('users/new', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('templates/content', $data);
        $this->load->view('templates/scripts', $data);
    }
    
    public function edit($id) {
        $data["user_exist"] = $this->Users_model->userExist($id);
        if ($data["user_exist"] != true) {
            redirect ('/users/');
        }
        $data["user_update"] = $this->session->tempdata('user_update') ? TRUE : NULL;
        $input_post = $this->input->post();

        if (!empty($input_post["submit"]) and $input_post["submit"] == "submit") { 
            unset($input_post["submit"]);
            $this->load->helper("dates_helper");
            $input_post["birth_date"] = dateToMySql($this->input->post('birth_date'));

            $this->Users_model->updateById($input_post, $input_post["id"]);
            $this->session->set_tempdata('user_update', TRUE, 30);
            $data["user_update"] = $this->session->tempdata('user_update') ? TRUE : NULL;
        }

        $data["module"]["dropzone_plugin"] = true;
        $data["module"]["select_plugin"] = true;
        $data["module"]["lightgallery_plugin"] = true;
        $data["module"]["datetimepicker_plugin"] = true;
        $data["module"]["datetimepicker_plugin_edit_user"] = true;
        $data["get_user"] = $this->Users_model->getUserByID($id);
        $data["get_user"] = !empty($data["get_user"]) ? $data["get_user"][0] : array();
        $data["templates"]["edit"]['title'] = "Editar usuario: ";
        $data["templates"]["edit"]['content'] = $this->load->view('users/edit', $data, true);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('templates/content', $data);
        $this->load->view('templates/scripts', $data);
    }
    
    public function uploadImage($id) {
        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $format = strtolower(explode(".", $_FILES['file']['name'])[1]);
            $fileName = "users_" . $id . "." . $format;
            $targetPath = getcwd() . '/assets/images/users/';
            $targetFile = $targetPath . $fileName ;
            $move_uploaded_file = move_uploaded_file($tempFile, $targetFile);
            if ($move_uploaded_file) {
                $data_upload['profile_avatar'] = $fileName;
                $this->db->where('id', $id);
                $this->db->update('users', $data_upload);
                $this->session->set_tempdata('user_update', TRUE, 30);
            }
        }
        redirect('/users/edit/' . $id);
    }
    
    public function deleteUsers() {
        $input_post = $this->input->post();
        $i = 0;
        if (!empty($input_post["deleteByID"])) {
            $this->Users_model->deleteById($input_post["deleteByID"]);
            $i++;
        } elseif(!empty($input_post["deleteByIds"])) {
            if(!empty($input_post["checkbox_users"])) {
                foreach ($input_post["checkbox_users"] as $key => $value ) {
                    $this->Users_model->deleteById($value);
                    $i++;
                }
            }    
        }
        
        $this->session->set_tempdata('total_users_deletes', $i, 5);
        redirect('/users');
    }

    public function database() {
        $data["all_users"] = $this->Users_model->getAllUsers();
        $data["templates"]["users"]['title'] = "Usuarios";
        $data["templates"]["users"]['content'] = $this->load->view('users/database_table_users', $data, true);
        $data["module"]["database_table"] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav', $data);
        $this->load->view('templates/content', $data);
        $this->load->view('templates/scripts', $data);
    }
}
