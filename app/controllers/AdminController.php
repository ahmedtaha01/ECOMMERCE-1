<?php
namespace PHPMVC\CONTROLLERS;


class AdminController extends \PHPMVC\LIB\AbstractController{
    private $user;
    private $category;
    private $item;
    private $comment;
    private $fail = 'FAIL TO DO THIS';

    private $numberOfItems;
    private $numberOfNeededItems;
    private $numberOfCategories;
    private $numberOfUsers;

    function __construct(){
        parent::__construct();
        $this->user = $this->Model('User');
        $this->category = $this->Model('Category');
        $this->item = $this->Model('Item');
        $this->comment = $this->Model('Comment');
        if(isset($_GET['num']) && $_GET['num'] != null){
            $this->item->pagenum = $_GET['num'];
            $this->category->pagenum = $_GET['num'];
            $this->user->pagenum = $_GET['num'];
        }
        $this->numberOfItems = $this->item->numrows('1');
        $this->numberOfNeededItems = $this->item->numrows('item_approve = 0');
        $this->numberOfCategories = $this->category->number();
        $this->numberOfUsers = $this->user->number();
    }

    private function EXIST($id){
        $user = $this->user->findById($id);
        if(!empty($user)){
            return $user;
        } else {
            return False;
        }
        
    }

    public function dashboard(){
        
        $numOfUsers =  $this->user->numrows('1');
        $numOfPending =  $this->user->numrows("0");
        $latestUsers = $this->user->paginate(4)->select('1');
        $numOfItems = $this->item->numrows('1');
        $latestItems = $this->item->select('item_approve = 1 LIMIT 4');
        $numOfComments = $this->comment->numrows('1');
        $latestComments = $this->comment->paginate(4)->select_join_user('1');
        $data = array(
            'numofusers' => $numOfUsers->num,
            'numofpending' => $numOfPending->num,
            'latestusers' => $latestUsers,
            'numofitems' => $numOfItems,
            'latestitems' => $latestItems,
            'numofcomments' =>$numOfComments,
            'latestcomments' =>$latestComments,
        );
        $this->Route('admin/dashboard',$data);        
    }


    public function member(){
        $users = $this->user->paginate(3)->select("1");
        
        $data = array(
            'users' =>$users,
            'num' => $this->numberOfUsers,
            'limit' => $this->user->limit,
        );
        $this->Route('user/members',$data);   
    }

    public function item(){
        
        $items = $this->item->paginate(4)->select('item_approve = 1');
        $pendingitems = $this->item->numofneededapprove('0');
        $data = array(
            'items' =>$items,
            'pendingitems' => $pendingitems,
            'num' => $this->numberOfItems,
            'limit' => $this->item->limit,
        );
        
        $this->Route('admin/items',$data);   
    }

    public function itemApprove(){
        $items = $this->item->paginate(4)->select('item_approve = 0');
        $data = array(
            'items' =>$items,
            'num' => $this->numberOfNeededItems,
            'limit' => $this->item->limit,
        );
        $this->Route('admin/item_approve',$data);   
    }
   
    public function category($order ='DESC'){
        if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['order'])){
            $categories = $this->category->orderBy("category_order {$_GET['order']}")->paginate(2)->select('1');
        }else {
            $categories = $this->category->orderBy()->paginate(2)->select('1');
        }
        $data = array(
            'categories' =>$categories,
            'num' => $this->numberOfCategories,
            'limit' => $this->category->limit,
        );
        $this->Route('admin/categories',$data);
    }
    
}


?>