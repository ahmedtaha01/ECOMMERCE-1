<?php

namespace PHPMVC\CONTROLLERS;




class AdminItemController extends ItemInterface{
    
    
    function __construct(){
        parent::__construct();

    }



    public function add(){
        $users = $this->user->select('1');
        $categories = $this->category->select('1');
        $data = array(
            'users' => $users,
            'categories' => $categories, 
        );
        $this->Route('item/add',$data);   
    }



    // needs to be modified or not
    public function edit($id){
        $item = $this->item->findById($id);
        $join = $this->item->joinCat_Us_It($item->user_ID,$item->cat_ID);
        $users = $this->user->select('1');
        $categories = $this->category->select('1');
        $data = array(
            'item' => $item,
            'join' => $join,
            'users' => $users,
            'categories' => $categories, 
        );
        $this->Route('item/edit',$data);
    }

    public function update(){
        $data = [
            'name'      => '',
            'description' => '',
            'price'     => '',
            'country'   => '',
            'status'    => '',
            'rate'      => '',
            'user_id'   => '',
            'cat_id'    => '',
        ];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $_SESSION['errors'] = array();
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if(!empty($_POST['name'])){

                $data['name'] = trim(filter_var($_POST['name'],FILTER_SANITIZE_STRING));

            } else {
                array_push($_SESSION['errors'],'NAME CAN\'T BE EMPTY');
            }
            
            if(!empty($_POST['description'])){

                $data['description'] = trim(filter_var($_POST['description'],FILTER_SANITIZE_STRING));

            } else {
                array_push($_SESSION['errors'],'DESCRIPTION CAN\'T BE EMPTY');
            }

            if(!empty($_POST['price'])){

                $data['price'] = trim(filter_var($_POST['price'],FILTER_SANITIZE_STRING));

            } else {
                array_push($_SESSION['errors'],'PRICE CAN\'T BE EMPTY');
            }

            if(!empty($_POST['country'])){

                $data['country'] = trim(filter_var($_POST['country'],FILTER_SANITIZE_STRING));

            } else {
                array_push($_SESSION['errors'],'COUNTRY CAN\'T BE EMPTY');
            }

            if(!empty($_POST['status'])){

                $data['status'] = trim(filter_var($_POST['status'],FILTER_SANITIZE_STRING));

            } else {
                array_push($_SESSION['errors'],'STATUS CAN\'T BE EMPTY');
            }

            if(!empty($_POST['rate'])){

                $data['rate'] = trim(filter_var($_POST['rate'],FILTER_SANITIZE_NUMBER_INT));

            } else {
                array_push($_SESSION['errors'],'RATING CAN\'T BE EMPTY');
            }

            if(isset($_POST['USER_ID'])){

                $data['user_id'] = $_POST['USER_ID'];

            } else {
                array_push($_SESSION['errors'],'MUST CHOOSE A USER');
            }

            if(isset($_POST['CAT_ID'])){

                $data['cat_id'] = $_POST['CAT_ID'];

            } else {
                array_push($_SESSION['errors'],'MUST CHOOSE A CATEGORY');
            }

            var_dump($_POST);

             if(empty($_SESSION['errors'])){
                $flag = $this->item->update($data,$_POST['itemID']);
                
                $_SESSION['success'] = $this->success;
                
            }   
        }
         header('location:'.URLROOT.'AdminController/item');
         exit;
    }

    public function delete($id){
        $delete = $this->EXIST($id);                 
        if($delete){
            if($delete->item_image != NULL){
                unlink(UPLOAD_IMG_ITEM.$delete->item_image);
            }
            $this->item->delete($id);
            $_SESSION['success'] = $this->success;
        } else {
            $_SESSION['fail'] = $this->fail;
        }    
        header('location:'.URLROOT.'AdminController/item');
        exit;
    }

    public function approve($id){

        $flag = $this->item->updateStatus(1,$id);

        if($flag){
            $_SESSION['success'] = $this->success;    
        }
        header('location:'.URLROOT.'AdminController/item');
        exit;
    }

    public function insertItem(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
            $this->insert($_POST);
        }

        header('location:'.URLROOT.'AdminController/item');
        exit;
    }

    ////////////////////////// functions for ajax ////////////////////////////////////

    public function show_items_for_ajax(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo json_encode($this->item->select("cat_ID = '{$_POST['id']}'"));
        }
    }

}

?>