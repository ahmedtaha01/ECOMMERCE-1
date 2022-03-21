<?php

namespace PHPMVC\CONTROLLERS;
use PHPMVC\LIB\FileUpload;

class AdminUserController extends UserInterface{

    function __construct(){

        parent::__construct();

    }

    public function conformation($id){

        $flag = $this->user->updateStatus(1,$id);

        if($flag){
            $_SESSION['success'] = $this->success;    
        }
        header('location:'.URLROOT.'AdminUserController/pending');
        exit;
    }

    public function add(){
        $this->Route('user/add');
    }


    public function edit($id){
        
        $user = $this->EXIST($id);
        if($user){
            $this->Route('user/edit',$user);
        } else {
            $_SESSION['fail'] = 'Failed to Make This';
            $this->Route('/admin/dashboard');
        } 
    }

    public function updateUser($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $user = $this->EXIST($id); 
            if($user){
                // sanitize data
                $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $this->update($user , $_POST);
            }
        }
        
        header('location:'.URLROOT.'AdminUserController/edit/'.$id);
        exit;
    }

    public function insert(){
        $data = array(
            'userName'  => '',
            'password'  => '',
            'email'     => '',
            'fullName'  => '',
            'image'     =>'', 
            'date'      => '',
            'regStatus' =>'',
        );

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
                
        
            $data['userName']   = trim($_POST['username']);
            $data['password']   = trim($_POST['password']);      // sha1() makes an empty string --> full string
            $data['email']      = trim($_POST['E-mail']);
            $data['fullName']   = trim($_POST['fullname']);
            $data['date']       = date('Y-m-d');
    
            //validation
            $_SESSION['errors'] = array();
    
            if(!empty($data['userName'])){
                $allUsers = $this->SELECTALL(1);
                foreach($allUsers as $user){
                    if($user->user_name == $data['userName']){
                        array_push($_SESSION['errors'],'NAME ALREADY TAKEN CHOOSE ANOTHER ONE');
                        break;
                    }
                }
            } else {
                array_push($_SESSION['errors'],'NAME CAN\'T BE EMPTY');
            }
            
            if(!empty($data['email'])){
                // sanitize email
    
                $data['email'] = filter_var($data['email'],FILTER_SANITIZE_EMAIL);
    
                // validate email
    
                if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
                    array_push($_SESSION['errors'],'EMAIL IS NOT VALID');
                }
    
            } else {
                array_push($_SESSION['errors'],'EMAIL CAN\'T BE EMPTY');
            }
    
    
            if(!empty($data['fullName'])){
                $match = '/^[A-Z]/i';
                if(!preg_match($match,$data['fullName'])){
                    array_push($_SESSION['errors'],'ONLY ALPHAPATICAL CHARACTER ARE REQUIRED');    
                }
            } else {
                array_push($_SESSION['errors'],'FULL NAME CAN\'T BE EMPTY');
            }
    
            if(empty($data['password'])){
                array_push($_SESSION['errors'],'PASSWORD CAN\'T BE EMPTY');
            } else {
                $data['password'] = sha1($data['password']);
            }
    
            
            $data['regStatus'] = 1;
            
            if($_FILES['FILE']['name'] != ''){
                $allowedtypes = array('png' , 'jpg');
                $file = new FileUpload($_FILES['FILE'] ,UPLOAD_IMG_USER, $allowedtypes);
                $file->upload();
                $data['image'] = $file->name();
            } else {
                array_push($_SESSION['errors'],'MUST CHOOSE AN IMAGE');
            }
    
            if(empty($_SESSION['errors'])){
                
                $flag = $this->user->insert($data);
                if($flag){
                    $_SESSION['success'] = $this->success;
                }
            }

            header('location:'.URLROOT.'AdminController/member');
            exit;    
            
        }

    }

    public function delete($id){
        $delete = $this->EXIST($id);                 // if member exist
        if($delete){
            if($delete->user_image != NULL){
                unlink(UPLOAD_IMG_USER.$delete->user_image);
            }
            $this->user->delete($id);
            $_SESSION['success'] = $this->success;
        } else {
            $_SESSION['fail'] = $this->fail;
        }    
        header('location:'.URLROOT.'AdminController/member');
        exit;
    }

    public function pending(){
        $users = $this->SELECTALL("user_regStatus = '0'");
        $this->Route('user/pending',$users);
    }

}

?>