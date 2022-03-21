<?php

namespace PHPMVC\LIB;
    // any page uou need paginate in it 
    // you should send with 'data' : limit , number of items
class Paginate
{
    public $pagenum;       //current page
    public $offset;        //
    public $limit;         //number of items per page
    public $limitStatement; // the added statement
    public $key;            // to order by it
    
    public function offset(){
        if($this->pagenum == null){
          return $this->offset = 0;
        } else {
          return $this->offset = ($this->pagenum * $this->limit) - $this->limit; 
        }
    }

    public function paginate($limit){         // for pagination
      $this->limit = $limit;

      $this->limitStatement =$this->limitStatement . " LIMIT {$this->offset()},$limit";   //offset first , limit second
      return $this;
    }

    public function orderBy($order = null){
      if($order != null){
        $this->limitStatement = " ORDER BY $order";
      } else {
        $this->limitStatement = " ORDER BY $this->key";
      }
      return $this;
    }

}    