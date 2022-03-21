<?php

namespace PHPMVC\CONTROLLERS;


class VisitorController extends \PHPMVC\LIB\AbstractController{
    protected $item;
    protected $user;
    protected $category;
    protected $comment;
    private $success = 'SUCCESS TO DO THIS';
    
    function __construct(){
        $this->item = $this->Model('Item');
        $this->user = $this->Model('User');
        $this->category = $this->Model('Category');
        $this->comment = $this->Model('Comment');
        if(isset($_GET['num']) && $_GET['num'] != null){
            $this->item->pagenum = $_GET['num'];
        }
    }

    public function show_items_for_ajax(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo json_encode($this->item->select("cat_ID = '{$_POST['id']}'"));
        } else {
            header('location:'.URLROOT.'IndexController/home');
            exit;
        }
    }

    public function show_all_items_for_ajax(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo json_encode($this->item->select("item_approve = 1"));
        } else {
            header('location:'.URLROOT.'IndexController/home');
            exit;
        }
    }

    public function changeLanguage(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_SESSION['english'])){
                unset($_SESSION['english']);
            } else {
                $_SESSION['english'] = 'true';
            } 
        } else {
            header('location:'.URLROOT.'IndexController/home');
            exit;
        }
    }
    
}
?>