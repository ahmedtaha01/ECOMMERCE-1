<?php

namespace PHPMVC\CONTROLLERS;
use PHPMVC\LIB\FileUpload;


abstract class ItemInterface  extends \PHPMVC\LIB\AbstractController{ 
   
    protected $item;
    protected $category;
    protected $user;
   
    protected $success = 'SUCCESS TO DO THIS';
    private $fail = 'FAIL TO DO THIS';

    function __construct($bool = null){
        parent::__construct($bool);
        $this->item = $this->Model('Item');
        $this->category = $this->Model('Category');
        $this->user = $this->Model('User');
    }

    protected function EXIST($id){
        $item = $this->item->findById($id);
        if(!empty($item)){
            return $item;
        } else {
            return False;
        }
        
    }

    protected function insert($values){
        
        $data = [
            'name'          => '',
            'description'   => '',
            'price'         => '',
            'country'       => '',
            'status'        => '',
            'rate'          => '',
            'image'         => '',
            'itemApprove'   => '',
            'user_id'       => '',
            'cat_id'        => '',
        ];

        
        $_SESSION['errors'] = array();

        if(!empty($values['name'])){

            $data['name'] = trim(filter_var($values['name'],FILTER_SANITIZE_STRING));

        } else {
            array_push($_SESSION['errors'],'NAME CAN\'T BE EMPTY');
        }
        
        if(!empty($values['description'])){

            $data['description'] = trim(filter_var($values['description'],FILTER_SANITIZE_STRING));

        } else {
            array_push($_SESSION['errors'],'DESCRIPTION CAN\'T BE EMPTY');
        }

        if(!empty($values['price'])){

            $data['price'] = trim(filter_var($values['price'],FILTER_SANITIZE_STRING));

        } else {
            array_push($_SESSION['errors'],'PRICE CAN\'T BE EMPTY');
        }

        if(!empty($values['country'])){

            $data['country'] = trim(filter_var($values['country'],FILTER_SANITIZE_STRING));

        } else {
            array_push($_SESSION['errors'],'COUNTRY CAN\'T BE EMPTY');
        }

        if(!empty($values['status'])){

            $data['status'] = trim(filter_var($values['status'],FILTER_SANITIZE_STRING));

        } else {
            array_push($_SESSION['errors'],'STATUS CAN\'T BE EMPTY');
        }

        if(!empty($values['rate'])){

            $data['rate'] = trim(filter_var($values['rate'],FILTER_SANITIZE_NUMBER_INT));

        } else {
            array_push($_SESSION['errors'],'RATING CAN\'T BE EMPTY');
        }

        if(isset($values['USER_ID'])){

            $data['user_id'] = $values['USER_ID'];

        } else {
            array_push($_SESSION['errors'],'MUST CHOOSE A USER');
        }

        if(isset($values['CAT_ID'])){

            $data['cat_id'] = $values['CAT_ID'];

        } else {
            array_push($_SESSION['errors'],'MUST CHOOSE A CATEGORY');
        }

        if(isset($_SESSION['admin'])){
            $data['itemApprove'] = 1;
        } else {
            $data['itemApprove'] = 0;
        }

        if($_FILES['FILE']['name'] != ''){
            $allowedtypes = array('png' , 'jpg');
            $file = new FileUpload($_FILES['FILE'] ,UPLOAD_IMG_ITEM ,$allowedtypes);
            if($file->upload()){
                $data['image'] = $file->name();
            } else {
                array_push($_SESSION['errors'],'IMAGE IS NOT IN REQUIRED FORMAT');                
            }
            
        } else {
            array_push($_SESSION['errors'],'MUST CHOOSE AN IMAGE');
        }
        

        if(empty($_SESSION['errors'])){
            $flag = $this->item->insert($data);
            if($flag){
                $_SESSION['success'] = $this->success;
            }
        }
        
    }
}

?>