<?php
namespace PHPMVC\MODELS;
use PHPMVC\LIB\Database;
use PHPMVC\LIB\Paginate;
class Item extends Paginate{

   private const TABLE_NAME = 'items';
   public $con;
   public function __construct(){
      $this->con = new Database;
      $this->key = 'item_id';
   } 
   private function state($statement){
      if($this->limitStatement != null){
         $statement = $statement . $this->limitStatement;
         $this->limitStatement = null;
      }
      return $statement;
   }

   public function insert($values){
      $this->con->query('INSERT INTO '.self::TABLE_NAME.' (item_name,item_description,
      item_price,item_addDate,item_country,item_image,item_status,item_rate,item_approve,user_ID,cat_ID)
      VALUES (:name,:desc,:pri,now(),:coun,:img,:sta,:rate,:it_ap,:uid,:cid)'); 
      $this->con->bindValues(':name',$values['name']);
      $this->con->bindValues(':desc',$values['description']);
      $this->con->bindValues(':pri',$values['price']);
      $this->con->bindValues(':coun',$values['country']);
      $this->con->bindValues(':img',$values['image']);
      $this->con->bindValues(':sta',$values['status']);
      $this->con->bindValues(':rate',$values['rate']);
      $this->con->bindValues(':it_ap',$values['itemApprove']);
      $this->con->bindValues(':uid',$values['user_id']);
      $this->con->bindValues(':cid',$values['cat_id']);
      return $this->con->execute();
    
   }

   public function update($values,$condition){
      $this->con->query('UPDATE '.self::TABLE_NAME.' SET item_name=:name,item_description=:desc,
      item_price=:pri,item_country=:coun,item_status=:sta,item_rate=:rate,user_ID=:uid,cat_ID=:cid
      WHERE item_id=:iid '); 
      $this->con->bindValues(':name',$values['name']);
      $this->con->bindValues(':desc',$values['description']);
      $this->con->bindValues(':pri',$values['price']);
      $this->con->bindValues(':coun',$values['country']);
      $this->con->bindValues(':sta',$values['status']);
      $this->con->bindValues(':rate',$values['rate']);
      $this->con->bindValues(':uid',$values['user_id']);
      $this->con->bindValues(':cid',$values['cat_id']);
      $this->con->bindValues(':iid',$condition);
      return $this->con->execute();
      
      
   }

   public function select($condition){
      $statement = "SELECT * FROM ".self::TABLE_NAME." WHERE $condition";
      $this->con->query($this->state($statement));
      return $this->con->resultSet();
   }

   public function numrows($condition){
      $this->con->query('SELECT COUNT(item_id) as num FROM '.self::TABLE_NAME.' WHERE :condition');
      $this->con->bindValues(':condition',$condition);
      $this->con->execute(); 
      return $this->con->single();
   }

   public function numofneededapprove($condition){
      $this->con->query('SELECT COUNT(item_id) as num FROM '.self::TABLE_NAME.' WHERE item_approve = :cond');
      $this->con->bindValues(':cond',$condition);
      $this->con->execute(); 
      return $this->con->single();
   }

   public function findById($id){
      $this->con->query('SELECT * FROM '.self::TABLE_NAME.' WHERE item_id = :id');
      $this->con->bindValues(':id',$id);
      return $this->con->single();
   }

   public function joinCat_Us_It($userid,$catid){
      $this->con->query("SELECT us.user_id,cat.category_id,cat.category_name ,us.user_name 
      FROM categories as cat JOIN items as it ON cat.category_id = it.cat_ID 
      JOIN users as us ON us.user_id = it.user_ID 
      WHERE us.user_id =:userID AND cat.category_id=:catID");
      $this->con->bindValues('userID',$userid);
      $this->con->bindValues('catID',$catid);
      return $this->con->resultSet();
   }

   public function delete($id){
      $this->con->query('DELETE FROM '.self::TABLE_NAME.' WHERE item_id = :id');
      $this->con->bindValues(':id',$id);
      return $this->con->execute();
   }

   public function updateStatus($values,$condition){
      $this->con->query('UPDATE '.self::TABLE_NAME.' SET item_approve=:state WHERE item_id=:id');
      $this->con->bindValues(':state',$values);
     
      $this->con->bindValues(':id',$condition);                            
      return $this->con->execute();
   }

}

?>