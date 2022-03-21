<?php

namespace PHPMVC\LIB;
require_once "../app/lib/PHPMailer/PHPMailer.php";
require_once "../app/lib/PHPMailer/SMTP.php";
require_once "../app/lib/PHPMailer/Exception.php";
use PHPMailer\PHPMailer\PHPMailer;

class MailUpload
{
    private $mail;

    function __construct($to , $head){
        $this->mail = new PHPMailer();

        $this->mail->isSMTP();
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->SMTPAuth = true;
        $this->mail->Username = "ahmedmohamedtaha2001@gmail.com";    //who
        $this->mail->Password = "NeverSayNever12";
        $this->mail->Port = 465;
        $this->mail->SMTPSecure ='ssl';
        $this->mail->CharSet = 'UTF-8';
        $this->To($to);
        $this->Header($head);
    }

    private function To($email){
        $this->mail->addAddress($email);
    }

    private function Header($content){
        $this->mail->Subject = $content;
    }

    public function Body($content){
        $this->mail->Body = $content;
    }

    public function Upload(){
        if($this->mail->send()){
            return true;
        } else {
            return false;
        }
    }
}