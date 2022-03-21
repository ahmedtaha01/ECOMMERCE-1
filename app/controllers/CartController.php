<?php

namespace PHPMVC\CONTROLLERS;

class CartController extends \PHPMVC\LIB\AbstractController{
    protected $item;

    
    private $success = 'ADDED TO CART';
    function __construct(){
        parent::__construct($this->isLoggedIn());
        $this->item = $this->Model('Item');
    }

    public function cart(){
        $this->route('mainshop/cart');
    }

    public function addToCart(){            // called by ajax
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $item = $this->item->select('item_id ='.$_POST['id']);
            if(isset($_SESSION['cart'])){
                if(!$this->checkExist($item[0])){
                    array_push($_SESSION['cart'] , $item[0]);
                    echo 'ADDED TO CART SUCCESSFULLY';
                } else {
                    echo 'ALREADY IN CART';
                }
            } else {
                $_SESSION['cart'] = array();
                array_push($_SESSION['cart'] , $item[0]);
                echo 'ADDED TO CART SUCCESSFULLY';
            }
        }

    }

    private function checkExist($item){         //existence of item in cart
        foreach($_SESSION['cart'] as $it){
            if($it->item_id == $item->item_id){
                return true;
            }
        }
        return false;
    }

    public function delete($id){
        
        foreach($_SESSION['cart'] as $it){
            if($it->item_id == $id){
                $num = array_search($it, $_SESSION['cart']);          // new function hooooray
                unset($_SESSION['cart'][$num]);
                if(count($_SESSION['cart']) == 0){
                    unset($_SESSION['cart']);
                }
            }
        }
        header('location:'.URLROOT.'CartController/cart');
        exit;
    }

}

?>