<?php
namespace PHPMVC\LIB;

class AbstractController
{

    protected $_controller  ;
    protected $_action ;
    protected $_params = array() ;

    function __construct($bool = null){  //for the validation
        if($bool != null){
            if(!$bool){
                header('location:'.URLROOT.'IndexController/login');   //log in or not
                exit; 
            }
        } else {
            if($this->isLoggedIn()){
                if(!$this->isAdmin()){
                    header('location:'.URLROOT.'IndexController/home');   // check for admin
                    exit;
                }
            } else {
                $_SESSION['errors'] = array();
                array_push($_SESSION['errors'],"YOU ARE NOT LOGGED IN");
                header('location:'.URLROOT.'IndexController/home');   // check for log in or not
                exit;
            }
        }
        
    }

    public function setcontroller($controllername)
    {
        $this->_controller = $controllername ;
    }

    public function setaction($actionname)
    {
        $this->_action = $actionname ;
    }

    public function setparams($params)
    {
        $this->_params = $params;
    }


    public function Model($modelname)
    {
        require_once APP_PATH.DS."model".DS.$modelname.".php";
        $modelname = "PHPMVC\MODELS\\" . $modelname;
        return new $modelname();
    }

    public function Route($view,$data = array()){
        if (file_exists(VIEW_PATH.DS.$view.".php")){
            require_once VIEW_PATH.DS.$view.".php";
        }else {
            require_once APP_PATH.DS."view".DS."notfound".DS."notfound.php";
        }
    }

    //Check If user is logged ...
    public function isLoggedIn() {
        if (isset($_SESSION['userId'])) {
            return true;
        } else {
            return false;
        }
    }

    //check if is admin

    public function isAdmin()
    {
        if (isset($_SESSION['admin'])){
            return true;
        }
        return false;
    }

    public function notfound(){
        $this->Route('notfound/notfound');
    }
}
