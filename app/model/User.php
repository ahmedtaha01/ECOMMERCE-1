<?php
namespace PHPMVC\MODELS;
use PHPMVC\LIB\Database;
use PHPMVC\LIB\Paginate;
class User extends Paginate{

   private const TABLE_NAME = 'users';
   public $con;
   private $statement;
   public function __construct(){
      $this->con = new Database;
      $this->key = 'user_id';
   } 

   private function state($statement){
      if($this->limitStatement != null){
         $statement = $statement . $this->limitStatement;
         $this->limitStatement = null;
      }
      return $statement;
   }

   public function exists($name,$password){
    $this->con->query("SELECT * FROM users WHERE user_name = :name AND user_password = :password");
    $this->con->bindValues(':name',$name);
    $this->con->bindValues(':password',sha1($password));
    return $this->con->resultSet();
   }

   //updated
   public function findById($id){
      $this->con->query('SELECT * FROM '.self::TABLE_NAME.' WHERE user_id = :id');
      $this->con->bindValues(':id',$id);
      return $this->con->single();
   }

   public function select($condition){
      $statement = "SELECT * FROM ".self::TABLE_NAME." WHERE $condition";
      $this->con->query($this->state($statement));
      return $this->con->resultSet();
      
   }

   public function selectEmail($condition){
      $this->con->query("SELECT user_email FROM ".self::TABLE_NAME." WHERE $condition");
      return $this->con->resultSet();
   }

   //updated
   public function update($values,$condition){
      $this->con->query('UPDATE '.self::TABLE_NAME.' SET user_name=:name,user_password=:pass,user_email=:email
                                                   ,user_fullName=:full,user_image=:img WHERE user_id=:id');
      $this->con->bindValues(':name',$values['userName']);
      $this->con->bindValues(':pass',$values['password']);
      $this->con->bindValues(':email',$values['email']);
      $this->con->bindValues(':full',$values['fullName']);
      $this->con->bindValues(':img',$values['image']);
      $this->con->bindValues(':id',$condition);                            
      return $this->con->execute();
   }

   public function updateStatus($values,$condition){
      $this->con->query('UPDATE '.self::TABLE_NAME.' SET user_regStatus=:state WHERE user_id=:id');
      $this->con->bindValues(':state',$values);
     
      $this->con->bindValues(':id',$condition);                            
      return $this->con->execute();
   }

   //updated
   public function insert($values){
      $this->con->query('INSERT INTO '.self::TABLE_NAME.' (user_name,user_password,user_email,user_fullName,user_image,user_date,user_regStatus)
                                                          VALUES (:name,:pass,:email,:full,:img,:date,:reg)'); 
      $this->con->bindValues(':name',$values['userName']);
      $this->con->bindValues(':pass',$values['password']);
      $this->con->bindValues(':email',$values['email']);
      $this->con->bindValues(':full',$values['fullName']);
      $this->con->bindValues(':img',$values['image']);
      $this->con->bindValues(':date',$values['date']);
      $this->con->bindValues(':reg',$values['regStatus']);
      return $this->con->execute();
      
   }

   //updated
   public function delete($id){
      $this->con->query('DELETE FROM '.self::TABLE_NAME.' WHERE user_id = :id');
      $this->con->bindValues(':id',$id);
      return $this->con->execute();
   }
   //updated
   public function numrows($condition){
      $this->con->query('SELECT COUNT(user_id) as num FROM '.self::TABLE_NAME.' WHERE user_regStatus=:condition');
      $this->con->bindValues(':condition',$condition);
      $this->con->execute(); 
      return $this->con->single();
   }

   public function number(){    //for pagination
      $this->con->query('SELECT COUNT(user_id) as num FROM '.self::TABLE_NAME);
      $this->con->execute(); 
      return $this->con->single();
   }

   public function updatepassword($values , $condition){
      $this->con->query('UPDATE '.self::TABLE_NAME.' SET user_password=:pass WHERE user_id=:id');
      $this->con->bindValues(':pass',$values);
     
      $this->con->bindValues(':id',$condition);                            
      return $this->con->execute();
   }
}

?>