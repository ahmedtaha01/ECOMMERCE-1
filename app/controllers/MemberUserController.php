<?php

namespace PHPMVC\CONTROLLERS;


class MemberUserController extends UserInterface{


    function __construct(){

        parent::__construct($this->isLoggedIn()); 
        
    }

    public function edit(){
        
        $user = $this->EXIST($_SESSION['userId']);
        if($user){
            $this->Route('mainshop/edituser',$user);
        } else {
            $_SESSION['fail'] = 'Failed to Make This';
            header('location:'.URLROOT.'IndexController/home');
            exit;
        } 
    }

    public function updateUser(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $user = $this->EXIST($_SESSION['userId']); 
            if($user){
                // sanitize data
                $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $this->update($user , $_POST);
            }
        }
        
        header('location:'.URLROOT.'MemberUserController/edit');
        exit;
    }



    
}

?>