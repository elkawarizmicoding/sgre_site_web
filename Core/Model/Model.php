<?php

namespace Core\Model;

use Core\Database;

class Model
{
    protected $db;
    protected $table;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function all(){
        return $this->query("SELECT * FROM ".$this->table);
    }

    public function max(){
        $rs = $this->query("SELECT max(id) as maxid FROM ".$this->table);
        return intval($rs[0]->maxid);
    }

    public function extract($key, $value){
        $records = $this->all();
        $arr = [];
        foreach($records as $row){
            $arr[$row->$key] = $row->$value;
        }
        return $arr;
    }

    public function create($fields){
        $sql_pairs = [];
        $attributes = [];
        foreach ($fields as $k => $v) {
            $sql_pairs[] = "$k = ?";
            $attributes[] = $v;
        }
        $sql_parts = implode(', ', $sql_pairs);

        return $this->query("INSERT INTO {$this->table} SET $sql_parts ", $attributes);
    }

    public function update($id, $fields){
        $sql_pairs = [];
        $attributes = [];
        $where_pairs = [];
        foreach ($fields as $k => $v) {
            $sql_pairs[] = "$k = ?";
            $attributes[] = $v;
        }
        $sql_parts = implode(', ', $sql_pairs);
        foreach ($id as $k => $v){
            $attributes[] = $v;
            $where_pairs[] = "$k = ?";
        }
        $where = implode(' AND ', $where_pairs);
        return $this->query("UPDATE {$this->table} SET $sql_parts WHERE $where", $attributes);
    }
    
    public function delete($id){
        $attributes = [];
        $where_pairs = [];
        foreach ($id as $k => $v){
            $attributes[] = $v;
            $where_pairs[] = "$k = ?";
        }
        $where = implode(' AND ', $where_pairs);
        return $this->query("DELETE FROM {$this->table} WHERE $where", $attributes, true);
    }

    public function find($id){
        $attributes = [];
        $where_pairs = [];
        foreach ($id as $k => $v){
            $attributes[] = $v;
            $where_pairs[] = "$k = ?";
        }
        $where = implode(' AND ', $where_pairs);
        return $this->query("SELECT * FROM {$this->table} WHERE $where", $attributes, true);
    }

    public function query($statement, $attributes = null, $one = false){
        if($attributes){
            return $this->db->prepare(
                $statement,
                $attributes,
                $one,
                str_replace('Model', 'Entity', get_class($this))
            );
        }else{
            return $this->db->query(
                $statement,
                $one,
                str_replace('Model', 'Entity', get_class($this))
            );
        }
    }

    public function path_system($val){
        $prg_spl = preg_split('//', md5($val), -1, PREG_SPLIT_NO_EMPTY);
        $userName = array();
        for ($i = 0; $i < 14; $i++){
            $userName[] = $prg_spl[$i];
        }

        return implode($userName);
    }

    public function ip_client_system(){
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        return $_SERVER['REMOTE_ADDR'];
    }
}