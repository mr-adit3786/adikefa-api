<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Kelompok10 extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function login_post()
    {
        $username = $this->post('username'); 
        $password = $this->post('password');

        $login_process = $this->db->get_where('tbl_admin', array("username" => $username, "password" => $password))->num_rows();
      
        if($login_process>0){
            $create_token = md5(uniqid(rand(), true));
            $json_response = array(
                "status" => true,
                "message" => "Login berhasil",
                "data" =>[
                    "username" => $username,
                    "token" => $create_token
                ]
                );
        }else{ 
            $json_response=array(
                "status" => false,
                "message" => "Login gagal",
                "data" => null
            );
        }

        $this->response($json_response, RestController::HTTP_OK);
    }

    public function about_get(){

        $data_about = $this->db->get('tbl_about')->result();

        if($data_about){
            $json_response = array(
                "success" => true,
                "message" => "data about berhasil diambil",
                "data" => $data_about
            );

        }else{
            $json_response = array(
                "success" => false,
                "message" => "Data gagal diambil",
                "data" => null
            );
        }

        $this->response($json_response, RestController::HTTP_OK);
    }


  // API BUAT DATABASE
    public function contact_post(){
        $name = $this->post('name');
        $email = $this->post('email');
        $phone = $this->post('phone');
        $message = $this->post('message');

        $data_insert = array(
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "message" => $message
        );

        $insert = $this->db->insert('tbl_contact', $data_insert);

        if($insert){
            $json_response = array(
                "success" => true,
                "message" => "Data berhasil di simpan",
                "data" => $data_insert
            );
        }else{
             $json_response = array(
                "success" => false,
                "message" => "Data gagal di simpan",
                "data" => null
            );
        }

        $this->response($json_response, RestController::HTTP_OK);
    }




  // API BUAT DASBOARD ABOUT
    public function about_put(){
        $content = $this->put('content');
        $id = $this->put('id');

        $data_insert = array(
            "content" => $content,
        );

        $this->db->update('tbl_about', $data_insert);
        $insert = $this->db->where('id', $id);  

        if($insert){
            $json_response = array(
                "success" => true,
                "message" => "Data berhasil di simpan",
                "data" => $data_insert
            );
        }else{
             $json_response = array(
                "success" => false,
                "message" => "Data gagal di simpan",
                "data" => null
            );
        }

        $this->response($json_response, RestController::HTTP_OK);
    }

    // API UNTUK CONTACT
        public function contact_get(){

        $data_contact = $this->db->get('tbl_contact')->result();

        if($data_contact){
            $json_response = array(
                "success" => true,
                "message" => "data contact berhasil diambil",
                "data" => $data_contact
            );

        }else{
            $json_response = array(
                "success" => false,
                "message" => "Data gagal diambil",
                "data" => null
            );
        }

        $this->response($json_response, RestController::HTTP_OK);
    }
}