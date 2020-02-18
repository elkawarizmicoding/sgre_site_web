<?php



class api{

    private $bool  = false;
    private $data = null;
    private $error;
    private $full_url;
    private $post;
    public function __construct(){
        $this->full_url = "http://ajosrescdz.com/users/?p=api/index&id_link={{id_link}}&name={{name}}";
    }
    private function curl_call(){
        /*$ch = curl_init($this->full_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->post);
        $data = curl_exec($ch);
        if (curl_errno($ch)) {
            return 'Error:' . curl_error($ch);
        }
        $data = json_decode($data, true);
        if($data["status"]){
            $this->bool = true;
            $this->data = $data["data"];
        }else{
            $this->bool = false;
            $this->error = $data["error"];
        }*/
        $url = str_replace("{{id_link}}", $this->post["id_link"], $this->full_url);
        $url = str_replace("{{name}}", $this->post["name"], $url);
        $data = file_get_contents($url);
        $data = json_decode($data, true);
        if($data["status"]){
            $this->bool = true;
            $this->data = $data["data"];
        }else{
            $this->bool = false;
            $this->error = $data["error"];
        }
    }
    public function data($data){
        $this->post = $data;
        $this->curl_call();
        if($this->bool){
            return true;
        }
        return false;
    }
    public function getData(){
        return $this->data;
    }
    public function getError(){
        return $this->error;
    }
}