<?php

namespace PHPMVC\CONTROLLERS;

class MemberController extends \PHPMVC\LIB\AbstractController{
    protected $user;
    protected $item;
    protected $comment;
    protected $category;
    
    private $success = 'SUCCESS TO DO THIS';
    
    function __construct(){
        parent::__construct($this->isLoggedIn());
        $this->user = $this->Model('User');
        $this->item = $this->Model('Item');
        $this->comment = $this->Model('Comment');
        $this->category = $this->Model('Category');        
    }

    public function profile(){
        $myitems = $this->item->select("user_ID = {$_SESSION['userId']}"); 
        $data = array(
            'myItems'       => $myitems,
        );
        $this->Route('mainshop/profile',$data);
    }

    public function showInformation(){     //ajax
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $information = $this->user->findById($_SESSION['userId']);
            echo json_encode($information);
        }
    }

    public function addItemPage(){
        $categories = $this->category->select('1');
        $data = array(
            'categories' => $categories, 
        );
        $this->Route('mainshop/addItem',$data);
    }

}

?>