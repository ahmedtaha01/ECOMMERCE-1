<?php

namespace PHPMVC\CONTROLLERS;


abstract class CommentInterface  extends \PHPMVC\LIB\AbstractController{ 
    protected $comment;
    protected $item;   
    private $success = 'SUCCESS TO DO THIS';

    
    function __construct($bool = null){
        parent::__construct($bool);
        $this->comment = $this->Model('Comment');
        $this->item = $this->Model('Item');
    }

    protected function EXIST($id){
        $comment = $this->comment->findById($id);
        if(!empty($comment)){
            return $comment;
        } else {
            return False;
        }
    }

    protected function show($id){
        $item = $this->item->findById($id);
        return $item;
    }

    protected function add($values){
        $data = array(
            'content'   => '',
            'userid'    => '',
            'itemid'    => ''
        );
       
        $_SESSION['errors'] = array();
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if(!empty($values['content'])){
            $data['content'] = $values['content'];
        } else {
            array_push($_SESSION['errors'] , 'COMMENT MUST\'t BE EMPTY');
        }

        $data['userid'] = $values['userid'];
        $data['itemid'] = $values['itemid'];

        if(empty($_SESSION['errors'])){
            $flag = $this->comment->add($data);
            if($flag){
                $_SESSION['success'] = $this->success;
            }
        }
        
    }

    public function showByAjax(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $comments = $this->comment->select_join('ite_ID = '.$_POST['id']);
            echo json_encode($comments);
        }
    }

   
}

?>