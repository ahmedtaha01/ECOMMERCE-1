<?php

namespace PHPMVC\CONTROLLERS;

class AdminCommentController extends CommentInterface{
    
    
    private $success = 'SUCCESS TO DO THIS';
    
    function __construct(){
        parent::__construct();
    }

    public function showC($id){
        $item = $this->show($id);
        $data = array(
            'item'  =>$item,
        );
        $this->Route('admin/comments',$data);
    }



    public function deleteByAjax(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->comment->delete($_POST['id']);
        }
    }

    public function updateByAjax(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->comment->update($_POST['content'] , $_POST['id']);
        }
    }

    public function delete($id){
        $delete = $this->EXIST($id);
        $item_id = $delete->ite_ID;     
        if($delete){
            $this->comment->delete($id);
            $_SESSION['success'] = $this->success;
        } else {
            $_SESSION['fail'] = $this->fail;
        }    
        header('location:'.URLROOT.'CommentController/show/'.$item_id);
        exit;

    }
   

}
?>