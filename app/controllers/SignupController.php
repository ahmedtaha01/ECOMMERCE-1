<?php

namespace PHPMVC\CONTROLLERS;


class SignupController extends \PHPMVC\LIB\AbstractController{

    private $user;
    private $success = "SUCCESS TO DO THIS";
    function __construct(){

        $this->user = $this->Model('User');
    }

    
    public function signup(){
        $this->Route('register/signup');
    }

    private function SELECTALL($condition){
        return $this->user->select($condition);
    }

    public function insert(){

        $data = array(
            'userName'  => '',
            'password'  => '',
            'email'     => '',
            'fullName'  => '',
            'date'      => '',
            'image'     => '',
            'regStatus' =>'',
        );

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

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

            $data['regStatus'] = 0;
            
            $data['image'] = null;
            if(empty($_SESSION['errors'])){
                
                $flag = $this->user->insert($data);
                if($flag){
                    $_SESSION['success'] = $this->success;
                }
            }

            header('location:'.URLROOT.'IndexController/login');
            exit;
        }
    }
}

?>