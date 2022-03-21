<?php
namespace PHPMVC\MODELS;
use PHPMVC\LIB\Database;
use PHPMVC\LIB\Paginate;

class Category extends Paginate{

   private const TABLE_NAME = 'categories';
   public $con;
   public function __construct(){
    $this->con = new Database;
    $this->key = 'category_order';
   } 

   private function state($statement){
      if($this->limitStatement != null){
         $statement = $statement . $this->limitStatement;
         $this->limitStatement = null;
      }
      return $statement;
   }

   public function insert($values){
      $this->con->query('INSERT INTO '.self::TABLE_NAME.' (category_name,category_description,
                        category_order,category_visibility,category_allowComment,category_allowAds)
      VALUES (:name,:desc,:ord,:vis,:comm,:ads)'); 
      $this->con->bindValues(':name',$values['name']);
      $this->con->bindValues(':desc',$values['description']);
      $this->con->bindValues(':ord',$values['ordering']);
      $this->con->bindValues(':vis',$values['visibility']);
      $this->con->bindValues(':comm',$values['comment']);
      $this->con->bindValues(':ads',$values['ads']);
      return $this->con->execute();
    
   }

   public function number(){    //for pagination
      $this->con->query('SELECT COUNT(category_id) as num FROM '.self::TABLE_NAME);
      $this->con->execute(); 
      return $this->con->single();
   }

   public function select($condition){
      $statement = "SELECT * FROM ".self::TABLE_NAME." WHERE $condition";
      $this->con->query($this->state($statement));
      return $this->con->resultSet();
   }

   public function findById($id){
      $this->con->query('SELECT * FROM '.self::TABLE_NAME.' WHERE category_id = :id');
      $this->con->bindValues(':id',$id);
      return $this->con->single();
   }

   public function update($values,$condition){
      $this->con->query('UPDATE '.self::TABLE_NAME.' SET category_name=:name,category_description=:desc,category_order=:ord
                        ,category_visibility=:visb,category_allowComment=:comm,category_allowAds=:ads WHERE category_id=:id');
      $this->con->bindValues(':name',$values['name']);
      $this->con->bindValues(':desc',$values['description']);
      $this->con->bindValues(':ord',$values['ordering']);
      $this->con->bindValues(':visb',$values['visibility']);
      $this->con->bindValues(':ads',$values['ads']);
      $this->con->bindValues(':comm',$values['comment']);
      $this->con->bindValues(':id',$condition);                            
      return $this->con->execute();
   }

   public function delete($id){
      $this->con->query('DELETE FROM '.self::TABLE_NAME.' WHERE category_id = :id');
      $this->con->bindValues(':id',$id);
      return $this->con->execute();
   }
 
}

?>