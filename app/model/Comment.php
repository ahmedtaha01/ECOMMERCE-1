<?php
namespace PHPMVC\MODELS;
use PHPMVC\LIB\Database;
use PHPMVC\LIB\Paginate;
class Comment extends Paginate{

   private const TABLE_NAME = 'comments';
   public $con;
   public function __construct(){
    $this->con = new Database;
    $this->key = 'comment_id';
   }
   
   private function state($statement){
        if($this->limitStatement != null){
        $statement = $statement . $this->limitStatement;
        $this->limitStatement = null;
        }
        return $statement;
    }

   public function select($condition){
        $statement = "SELECT * FROM ".self::TABLE_NAME." WHERE $condition";
        $this->con->query($this->state($statement));
        return $this->con->resultSet();
    }

    public function select_join($condition){
        $this->con->query("SELECT comm.comment_id,comm.comment_content,comm.comment_date,
                        usee.user_name,usee.user_image ,comm.ite_ID
                        FROM comments as comm JOIN items as it 
                        ON comm.ite_ID = it.item_id 
                        JOIN users as usee ON comm.use_ID = usee.user_id 
                        WHERE $condition");

        return $this->con->resultSet();
    }
    public function select_join_user($condition){
        $statement = "SELECT comm.comment_id,comm.comment_content,comm.comment_date,
                    usee.user_name
                    FROM comments as comm 
                    JOIN users as usee ON comm.use_ID = usee.user_id 
                    WHERE $condition";
        $this->con->query($this->state($statement));

        return $this->con->resultSet();
    }

    public function update($values,$condition){
        $this->con->query('UPDATE '.self::TABLE_NAME.' SET comment_content=:cont WHERE comment_id=:id');
        $this->con->bindValues(':cont',$values);

        $this->con->bindValues(':id',$condition);                            
        return $this->con->execute();
     }

     public function add($values){
        $this->con->query('INSERT INTO '.self::TABLE_NAME.' (comment_content,comment_date,ite_ID,use_ID)
        VALUES (:cont,now(),:tid,:uid)'); 
        $this->con->bindValues(':cont',$values['content']);
        $this->con->bindValues(':tid',$values['itemid']);
        $this->con->bindValues(':uid',$values['userid']);
        return $this->con->execute();
     }

    public function delete($id){
        $this->con->query('DELETE FROM '.self::TABLE_NAME.' WHERE comment_id = :id');
        $this->con->bindValues(':id',$id);
        return $this->con->execute();
    }

    public function findById($id){
        $this->con->query('SELECT * FROM '.self::TABLE_NAME.' WHERE comment_id = :id');
        $this->con->bindValues(':id',$id);
        return $this->con->single();
    }

    public function numrows($condition){
        $this->con->query('SELECT COUNT(comment_id) as num FROM '.self::TABLE_NAME.' WHERE :condition');
        $this->con->bindValues(':condition',$condition);
        $this->con->execute(); 
        return $this->con->single();
    }
 
}

?>