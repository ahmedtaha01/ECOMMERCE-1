<?php

namespace PHPMVC\CONTROLLERS;


class CategoryController extends \PHPMVC\LIB\AbstractController{
    protected $category;
    private $success = 'SUCCESS TO DO THIS';
    
    function __construct(){
        parent::__construct();
        $this->category = $this->Model('Category');
    }

    private function EXIST($id){
        $category = $this->category->findById($id);
        if(!empty($category)){
            return $category;
        } else {
            return False;
        }
        
    }

    public function add(){
        $this->Route('categories/add');
    }
    public function insert(){
        $data = [
            'name' => '',
            'description' => '',
            'ordering' => '',
            'visibility' => '',
            'comment' => '',
            'ads' => '',
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

            if(!empty($_POST['ordering'])){

                $data['ordering'] = trim(filter_var($_POST['ordering'],FILTER_SANITIZE_NUMBER_INT));

            } else {
                array_push($_SESSION['errors'],'ORDERING CAN\'T BE EMPTY');
            }

            
            if(isset($_POST['visibility'])){
               $data['visibility'] = 1;
            } else {
               $data['visibility'] = 0;   
            }

            if(isset($_POST['comment'])){
                $data['comment'] = 1;
            } else {
                $data['comment'] = 0;   
            }

             if(isset($_POST['ads'])){
                $data['ads'] = 1;
            } else {
                $data['ads'] = 0;   
            }
            
            if(empty($_SESSION['errors'])){
                $flag = $this->category->insert($data);
                
                    $_SESSION['success'] = $this->success;
                
            }   
        }
        header('location:'.URLROOT.'AdminController/category');
        exit;
    }

    public function edit($id){
        $data = $this->category->findById($id);
        $this->Route('categories/edit',$data);
    }

    public function delete($id){
        $delete = $this->EXIST($id);                 
        if($delete){
            $this->category->delete($id);
            $_SESSION['success'] = $this->success;
        } else {
            $_SESSION['fail'] = $this->fail;
        }    
        header('location:'.URLROOT.'AdminController/category');
        exit;
    }

    public function update(){
        $data = [
            'name' => '',
            'description' => '',
            'ordering' => '',
            'visibility' => '',
            'comment' => '',
            'ads' => '',
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

            if(!empty($_POST['ordering'])){

                $data['ordering'] = trim(filter_var($_POST['ordering'],FILTER_SANITIZE_NUMBER_INT));

            } else {
                array_push($_SESSION['errors'],'ORDERING CAN\'T BE EMPTY');
            }


            if(isset($_POST['visibility'])){
                $data['visibility'] = 1;
            } else {
                $data['visibility'] = 0;
            }
            if(isset($_POST['ads'])){
                $data['ads'] = 1;
            } else {
                $data['ads'] = 0;
            }
            if(isset($_POST['comment'])){
                $data['comment'] = 1;
            } else {
                $data['comment'] = 0;
            }

            if(empty($_SESSION['errors'])){
                $flag = $this->category->update($data,$_POST['id']);
                
                $_SESSION['success'] = $this->success;
                
            }  
        }

        header('location:'.URLROOT.'AdminController/category');
        exit;
    }

}
?>