<?php

namespace PHPMVC\LIB ;

class Database
{
    private $dbhostname = DB_HOST_NAME ;
    private $dbname = DB_NAME ;
    private $dbusername = DB_USER_NAME ;
    private $dbpassword = DB_PASSWORD ;

    private $dbhandler ;
    private $error ;
    private $statement;
    // public $limit;

    public function __construct()
    {
        try {
            $this->dbhandler  = new \PDO('mysql://hostname='.$this->dbhostname.';dbname='.$this->dbname, $this->dbusername ,
                $this->dbpassword , array(
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
                    \PDO::ATTR_PERSISTENT =>true,
                ));
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error ;
        }
    }

    public function query($sql){
        // var_dump($this->limit);
        // if($this->limit != null){
        //     $sql = $sql . $this->limit;
        //     $this->limit = null;
        // }
        return $this->statement = $this->dbhandler->prepare($sql);
    }

    // public function limit($offset , $limit , $orderBy){         // for pagination
    //     $this->limit = " ORDER BY $orderBy LIMIT $offset,$limit";   //offset first , limit second
    //     return $this;
    // }

    public function bindValues($parameter,$value,$type = null)
    {
        switch (is_null($type)){
            case is_int($value):
                $type = \PDO::PARAM_INT ;
                break;
            case is_bool($value):
                $type = \PDO::PARAM_BOOL ;
                break;

            case is_null($value):
                $type = \PDO::PARAM_NULL ;
                break;
            default:
                $type = \PDO::PARAM_STR ;
        }
        $this->statement->bindValue($parameter,$value,$type);
    }

    public function execute(){
        return $this->statement->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->statement->fetchall(\PDO::FETCH_OBJ);
    }

    public function single()
    {
        $this->execute();
        return $this->statement->fetch(\PDO::FETCH_OBJ);
    }

    public function rowCount()
    {
        return $this->statement->rowCount();
    }
    public function prepareAndExecute($sql)
    {
        return $this->dbhandler->query($sql);
    }

}
