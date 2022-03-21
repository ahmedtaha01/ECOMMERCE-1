<?php
namespace PHPMVC\CONTROLLERS;


class IndexController extends \PHPMVC\LIB\AbstractController{

    protected $category;
    protected $user;
    function __construct(){
        
        $this->category = $this->Model('Category');
        $this->user = $this->Model("User");
    }

    private function SELECTALL($condition){
        return $this->user->select($condition);
    }


    public function login(){
        if($this->isLoggedIn()){
            if($this->isAdmin()){
                header('location:'.URLROOT.'AdminController/dashboard');
                exit;
            } else {
                header('location:'.URLROOT.'IndexController/home');
                exit;
            }
        }
        else if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = isset($_POST['user'])? $_POST['user'] : '';
            $password = isset($_POST['password'])? $_POST['password']:'';
            $data = $this->user->exists($name,$password);
            if(count($data) > 0){
                if($data[0]->user_regStatus == 0){
                    header('location:'.URLROOT.'IndexController/waiting');
                    exit;    
                } else {
                    $_SESSION['userId'] = $data[0]->user_id;
                    $_SESSION['userName'] = $data[0]->user_name;
                    $_SESSION['userimage'] = $data[0]->user_image;
                    if($data[0]->user_groupId == 1){   
                        $_SESSION['admin'] = $data[0]->user_groupId;
                        header('location:/AdminController/dashboard');
                        exit;
                    } else {
                        header('location:'.URLROOT.'IndexController/home');
                        exit;
                    }   
                } 
            }
        }
        $this->Route('register/login');
    }

    
    public function waiting(){
        $this->Route('register/waiting');
    }

    public function home(){
        $data = $this->category->select('1');
        $this->Route('mainshop/home',$data);
    }
    public function logout(){
        
        session_unset();
        session_destroy();
        header('location:/IndexController/home');
        exit;
    }

    public function insert(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $member = new MemberUserController(true);    //composition
            $member->insert($_POST);
        } 
    }

}


?>