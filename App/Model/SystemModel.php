<?php
namespace App\Model;

use Core\Database;
use Core\Model\Model;
use mysql_xdevapi\Exception;

class SystemModel extends Model
{
    protected $table = 'system';
    /* ============================ Begin System Action =========================================== */
    public function login_system($data){
        $code_status = 404; //Error not exist user
        $system = $this->query('SELECT * FROM system WHERE user_system = ? OR mail_system = ?', [$data['user_system'], $data['user_system']], true);
        if($system){
            if(password_verify($data['pass_system'], $system->pass_system)){
                if($this->query("SELECT active_system FROM system WHERE id_system = ?", [$system->id_system], true)->active_system != 0){
                    $this->update(["id_system" => $system->id_system], ["ldate_system" => date("Y-m-d H:i:s")]);
                    $_SESSION["system_info"] = $this->getInfo($system->id_system);
                    setcookie("system_id", $system->id_system, time() + 3600, '/');
                    $code_status = 200;//Successfully OK
                }else{
                    $code_status = 402;//Error account is deactivated
                }
            }else {
                $code_status = 403;//Error password is incorrect
            }
        }
        return $code_status;
    }
    public function register_system($data){
        $code_status = 404; //Error exist user
        if(!$this->query('SELECT * FROM system WHERE user_system = ?', [$data["user_system"]], true)){
            if(!$this->query('SELECT * FROM system WHERE email_system = ?', [$data["mail_system"]],    true)){
                $data["type_system"] = "2";
                $data["pass_system"] = password_hash($data["pass_system"], PASSWORD_DEFAULT, ['cost' => 11]);
                $data["cdate_system"] = date("Y-m-d H:i:s");
                $data["sdate_system"] = date("Y-m-d H:i:s");
                if($this->create($data)){
                    $code_status = 200;
                }else{
                    $code_status = 402; //Error recording
                }
            }else {
                $code_status = 403; //Error exist email
            }
        }
        return $code_status;
    }
    public function check_token_system($data){
        if($this->query("SELECT * FROM system WHERE user_system = ? AND  token_system = ?", [$data["user_system"], $data["token_system"]], true)){
            return $this->query("UPDATE system SET token_system = ? WHERE user_system = ?", [null, $data["user_system"]], true);
        }
        return false;
    }
    public function change_password($data){
        if($this->query("SELECT * FROM system WHERE user_system = ?", [$data["user"]], true)){
            return $this->query("UPDATE system SET pass_system = ? WHERE user_system = ?", [password_hash($data["pass"], PASSWORD_DEFAULT, ['cost' => 11]), $data["user"]], true);
        }
        return false;
    }
    private function getInfo($id_user){
        $data = $this->query("SELECT * FROM system WHERE id_system = ?", [$id_user], true);
        return ["info" => $data];
    }
    public function editProfile($id, $data){
        if($this->update(["id_system" => $id], $data)){
            $_SESSION["system_info"] = $this->getInfo($id);
            return true;
        }
        return false;
    }
    public function getUserByEmail($email){
        return $this->query("SELECT user_system FROM system WHERE email_system = ?", [$email], true)->user_system;
    }
    /* ============================ End System Action =========================================== */
    /* ============================ Begin System Tools =========================================== */

    /* ============================ End System Tools =========================================== */
}