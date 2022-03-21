<?php
namespace PHPMVC\CONTROLLERS;
use PHPMVC\LIB\MailUpload;

class ForgetpasswordController extends \PHPMVC\LIB\AbstractController{
    protected $user;
  

    function __construct(){
        $this->user = $this->Model('User');
    }

    public function forgetPassword(){
        unset($_SESSION['number']);
        unset($_SESSION['email']);
        $this->Route('register/forgetpassword');
    }
    public function newPassword(){
        if(isset($_SESSION['number'])){
            $this->Route('register/newpassword');
        } else {
            header('location:'.URLROOT.'ForgetpasswordController/forgetPassword');
            exit;
        }
    }

    public function addNumber(){
        if(isset($_SESSION['number'])){
            $this->Route('register/addnumber');
        } else {
            header('location:'.URLROOT.'ForgetpasswordController/forgetPassword');
            exit;
        }
    }

    public function updatePassword(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_SESSION['errors'] = array();
            if(!empty($_POST['email'])){
               
                $validatedEmail = $this->validation($_POST['email']); //validity

                if($validatedEmail){
                    $existedEmail = $this->exist($validatedEmail); //exist
                    if($existedEmail){
                        if($this->upload($existedEmail)){         //upload message
                            header('location:'.URLROOT.'ForgetpasswordController/addnumber');
                            exit;
                        }
                    } 
                }
            } else {
                array_push($_SESSION['errors'],'EMAIL CAN\'T BE EMPTY');
                header('location:'.URLROOT.'ForgetpasswordController/forgetPassword');
                exit;
            }
        }
        header('location:'.URLROOT.'ForgetpasswordController/forgetPassword');
        exit;
    }

    private function validation($email){
        // sanitize email
   
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
   
        // validate email

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
           array_push($_SESSION['errors'],'EMAIL IS NOT VALID');
       }
       if(empty($_SESSION['errors'])){
           return $email;
       } else {
           return false;
       }
    }

   private function exist($email){
       $allEmails = $this->user->selectEmail('1'); //in_array doesn't work with multidimensional array
       $found = false;
       foreach($allEmails as $oneemail){
           if($email == $oneemail->user_email){
               $found = true;
               break;
           }
       }
       if(!$found){
           array_push($_SESSION['errors'],'EMAIL DOESN\'T EXIST');
       }
       if(empty($_SESSION['errors'])){
           return $email;
       } else {
           return false;
       }
    }

    private function upload($existedEmail){
        $mail = new MailUpload($existedEmail , 'hello');
        $_SESSION['number'] = rand(500000,599999);
        $mail->Body('your number is : '. $_SESSION['number']);
        if($mail->Upload()){
            $_SESSION['email'] = $existedEmail;
            return true;
        }
        return false;
    }

    public function checkNumber(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_SESSION['errors'] = array();
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if($_POST['num'] == $_SESSION['number']){
                header('location:'.URLROOT.'ForgetpasswordController/newPassword');
                exit;
            } else {
                array_push($_SESSION['errors'] , 'NUMBER IS WRONG ,TRY AGAIN');
                header('location:'.URLROOT.'ForgetpasswordController/addNumber');
                exit;
            }
        }
        header('location:'.URLROOT.'IndexController/login');
        exit;
    }

    public function changePassword(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $user = $this->user->select("user_email = '{$_SESSION['email']}'");  //no check here 
            $this->user->updatepassword(sha1($_POST['password']) , $user[0]->user_id);//we aleady checked hehehe
            unset($_SESSION['number']);
            unset($_SESSION['email']);
            $_SESSION['success'] ='PASSWORD HAS BEEN UPDATED';
            header('location:'.URLROOT.'IndexController/login');
            exit;
        }
        header('location:'.URLROOT.'ForgetpasswordController/forgetPassword');
        exit;
    }

    

    

}

?>