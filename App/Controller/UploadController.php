<?php

namespace App\Controller;

class UploadController{

    private $file;
    private $ext;
    private $path;
    private $msg;

    public function __construct($file, $path){
        $this->file = $file;
        $this->path = $path;
    }
    private function uploaderFin(){
        $FILES    = $this->file;
        if(!move_uploaded_file($FILES['tmp_name'], $this->path)){
            return false;
        }else{
            return true;
        }
    }
    public function uploader($sts = false){
        $FILES = $this->file;
        if (!isset($FILES['error']) || is_array($FILES['error'])){
            $this->msg = 'Invalid parameters';
            return false;
        }
        switch ($FILES['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                $this->msg = 'No file sent';
                return false;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $this->msg = 'Exceeded filesize limit';
                return false;
            default:
                $this->msg = 'Unknown errors';
                return false;
        }
        if ($FILES['size'] > 12000000) {
            $this->msg = 'Exceeded filesize limit';
            return false;
        }
        $exe = array(
            'jpg'  => 'image/jpeg',
            'png'  => 'image/png',
            'gif'  => 'image/gif'
        );
        if(false === $ext = array_search($FILES['type'], $exe, true)){
            $this->msg = 'Invalid file format';
            return false;
        }
        $this->ext  = $ext;
        if($sts){
            $this->ext = "png";
        }
        if(!$this->uploaderFin()){
            $this->msg = 'Failed to move uploaded file';
            return false;
        }
        return true;
    }
    public function error(){
        return $this->msg;
    }
}