<?php

namespace PHPMVC\CONTROLLERS;


class MemberItemController extends ItemInterface{


    function __construct(){
        parent::__construct($this->isLoggedIn());

    }

    public function insertItem(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $this->insert($_POST);
        }

        header('location:'.URLROOT.'MemberController/addItemPage');
        exit;
    }

}

?>