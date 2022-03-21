<?php

namespace PHPMVC\CONTROLLERS;


class MemberCommentController extends CommentInterface{

    function __construct(){
        
        parent::__construct($this->isLoggedIn());
    }

    public function showC($id){

        $data = $this->show($id);
        if($data){
            $this->Route('mainshop/item-comment',$data);
        } else {
            header('location:'.URLROOT.'IndexController/home');
            exit;
        }
        
    }

    public function showComment(){ // ajax for the profile page
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $comments = $this->comment->select('use_ID = '.$_SESSION['userId']);
            echo json_encode($comments);
        }
    }

    public function addComment(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->add($_POST);
        }
        header('location:'.URLROOT.'MemberCommentController/showC/'.$_POST['itemid']);
        exit;
    }


}

?>