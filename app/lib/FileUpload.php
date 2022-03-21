<?php

namespace PHPMVC\LIB ;

class FileUpload
{
    private $fileName;
    private $fileTmp;
    private $fileSize;
    private $fileError;
    private $fileType;
    private $fileExt;
    private $path;
    private $allowedTypes = array('png' , 'jpg');   //add to it

    function __construct($FILE, $path , $allowedTypes = null){
        $this->fileName = $FILE['name'];
        $this->fileTmp = $FILE['tmp_name'];
        $this->fileSize = $FILE['size'];
        $this->fileError = $FILE['error'];
        $this->fileType = $FILE['type'];
        $this->path = $path;
        if($allowedTypes != null){
            $this->allowedTypes = $allowedTypes;
        }
        $var = explode('.',$this->fileName);
        $this->fileExt = strtolower(end($var));
        $this->fileName = $var[0].'.'.$this->fileExt;
    }

    public function upload($name = NULL ,$size = NULL){
        
        if($name != NULL){
            $this->changeName($name);
        }
        $folder = $this->createPAth();
        
        if(in_array($this->fileExt , $this->allowedTypes)){
            if($this->checkError()){
                if($size == NULL){
                    move_uploaded_file($this->fileTmp , $folder);
                } else {
                    if($this->checkSize($size)){
                        move_uploaded_file($this->fileTmp , $folder);
                    } else {
                        return false;
                    }
                }
            } else {
                return false;            
            }
        } else {
            return false;
        }

    }

    private function changeName($name){
        return $this->fileName = $name .'.'.$this->fileExt;
    }

    private function createPath(){
        return $this->path . $this->fileName;
    }

    private function checkError(){
        if($this->fileError == 0){
            return true;
        } else {
            return false;
        }
    }

    private function checkType($type){
        if(in_array($type , $this->allowedTypes)){
            return true;
        } else {
            return false;
        }
    }

    private function checkSize($size){
        if($this->fileSize < $size){
            return true;
        } else {
            return false;
        }
    }

    public function size(){
        return $this->fileSize;
    }
    public function name(){
        return $this->fileName;
    }
    public function error(){
        return $this->fileError;
    }
    public function tmp(){
        return $this->fileTmp;
    }
    public function type(){
        return $this->fileTYpe;
    }
}