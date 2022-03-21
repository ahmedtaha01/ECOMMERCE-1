<?php

namespace PHPMVC\CONTROLLERS;
use PHPMVC\LIB\FileUpload;


class UserInterface extends \PHPMVC\LIB\AbstractController{
    protected $user;
    protected $category;

    protected $success = 'SUCCESS TO DO THIS';
    protected $fail = 'FAIL TO DO THIS';

    function __construct($bool = null){
        parent::__construct($bool);
        $this->user = $this->Model('User');
        $this->category = $this->Model('Category');
    }

    protected function SELECTALL($condition){
        return $this->user->select($condition);
    }
    protected function EXIST($id){
        $user = $this->user->findById($id);
        if(!empty($user)){
            return $user;
        } else {
            return False;
        }
    }

    protected function update($user , $values){
        $data = array(
            'userName'  => '',
            'password'  => '',
            'email'     => '',
            'image'     => '', 
            'fullName'  => '',
        );

        $data['userName']   = trim($values['username']);
        $data['password']   = empty($values['newpassword']) ?trim($values['oldpassword']):sha1($values['newpassword']);      // sha1() makes an empty string --> full string
        $data['email']      = trim($values['E-mail']);
        $data['fullName']   = trim($values['fullname']);


        //validation
        $_SESSION['errors'] = array();

        if(!empty($data['userName'])){    // check if not empty
            if($data['userName'] != $user->user_name){    // check if name changed
                $allUsers = $this->SELECTALL(1);
                foreach($allUsers as $userr){
                    if($userr->user_name == $data['userName']){
                        array_push($_SESSION['errors'],'NAME ALREADY TAKEN CHOOSE ANOTHER ONE');
                        break;
                    }
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

        if($_FILES['FILE']['name'] != ''){
            if($user->user_image != null){
                unlink(UPLOAD_IMG_USER.$user->user_image);
            }
            $allowedtypes = array('png' , 'jpg');
            $file = new FileUpload($_FILES['FILE'] ,UPLOAD_IMG_USER ,$allowedtypes);
            $file->upload();
            $data['image'] = $file->name();
        } else {
            $data['image'] = $_SESSION['userimage'];
        }

        if(empty($_SESSION['errors'])){

            $flag = $this->user->update($data,$user->user_id);

            if($flag){
                $_SESSION['success'] = $this->success;
                if($user->user_id == $_SESSION['userId']){
                    $_SESSION['userName'] = $data['userName'];
                    if(isset($file)){   // if user changed image
                        $_SESSION['userimage'] = $file->name();
                    }
                }
            }
        }

        
        

    }



}


?>