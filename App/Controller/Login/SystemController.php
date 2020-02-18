<?php
namespace App\Controller\Login;

use App\Controller\AppController;

class SystemController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('System');
    }
    public function login(){
        $myObj = new \stdClass();
        $_POST["screen_system"] = null;
        $_POST["ip_system"] = null;//$_POST["ip_system"] = $this->ip_client();
        switch ($this->System->login_system($_POST)){
            case 404:
                $myObj->status = false;
                $myObj->subject = "This user not exist in system";
                break;
            case 403:
                $myObj->status = false;
                $myObj->subject = "Password is incorrect";
                break;
            case 402:
                $myObj->status = false;
                $myObj->subject = "Account is deactivated";
                break;
            case 201:
                $myObj->status = "check";
                $myObj->subject = "Successfully login, but the system wants to validate the account";
                break;
            case 200:
                $myObj->status  = true;
                $myObj->subject = "Welcome back, wait ...";
                break;
            default:
                $myObj->status = false;
                $myObj->subject = "Error in system";
        }
        return json_encode($myObj);
    }
    public function register(){
        $myObj = new \stdClass();
        if($this->valid_input($_POST)) {
            unset($_POST["ajax_action"]);
            $token = $this->token_system();
            $_POST["token_system"] = $token;
            $_POST["type_expiration_system"] = $_POST["type_expiration_system"] == "unlimited" ? 0 : 1;
            switch ($this->System->register_system($_POST)) {
                case 404:
                    $myObj->status = false;
                    $myObj->subject = "this user exist in system";
                    break;
                case 403:
                    $myObj->status = false;
                    $myObj->subject = "this email exist in system";
                    break;
                case 402:
                    $myObj->status = false;
                    $myObj->subject = "Error recording";
                    break;
                case 200:
                    if ($this->mail_sender([
                        "to" => $_POST["email_system"],
                        "subject" => "Hicham App | Successfully register",
                        "from_name" => "Hicham App",
                        "from_mail" => "admin@" . $_SERVER['SERVER_NAME'],
                        "type_mail" => "token",
                        "content_mail" => $token,
                        "username" => $_POST["user_system"]
                    ])) {
                        $TARGET = explode("App/Views", $this->viewPath)[0] . "layout/upload/files/" . $_SESSION["path_system"];
                        if (!is_dir($TARGET)) {
                            if (!mkdir($TARGET, 0777, true)) {
                                $myObj->status = false;
                                $myObj->subject = "Error not making folder";
                            }
                        }
                        $myObj->status = true;
                        $myObj->subject = "Successfully register, Check Your Email";
                        $this->exit_system();
                    }
                    break;
                default:
                    $myObj->status = false;
                    $myObj->subject = "Error in system";
            }
        }else{
            $myObj->status = false;
            $myObj->subject = "Empty input";
        }
        return json_encode($myObj);
    }
    public function valid(){
        $myObj = new \stdClass();
        $myObj->status = $this->System->check_token_system($_POST);
    }
    public function forgot(){
        $myObj = new \stdClass();
        /*$myObj->status = true;
        $myObj->subject = "Check your email";*/
        $data = [
            "email_system" => $_POST["email_system"],
            "code_system"  => $this->rand_code_system()
        ];
        $myObj->status = false;
        if($this->System->set_code_rest($data)){
            if($this->mail_sender([
                    "to" => $_POST["email_system"],
                    "subject" => "Hicham App | Forgot Password",
                    "from_name" => "Hicham App",
                    "from_mail" => "admin@" . $_SERVER['SERVER_NAME'],
                    "type_mail" => "code",
                    "content_mail" => $data["code_system"],
                    "username" => $this->System->getUserByEmail($_POST["email_system"])])){
                $myObj->status = true;
                $myObj->subject = "Check your email";
            }
        }
        return json_encode($myObj);
    }
    public function rest(){
        $myObj = new \stdClass();
        if(isset($_POST["pass_system"])){
            if($_POST["pass_system"] != $_POST["cpass_system"]){
                $myObj->status = false;
                $myObj->msg = "Password does not match";
            }else{
                if(!$this->System->change_password(["user" => $_SESSION["user_system"], "pass" => $_POST["pass_system"]])){
                    $myObj->status = false;
                    $myObj->msg = "username is not exits";
                }else{
                    $myObj->status = true;
                }
            }
        }
        return json_encode($myObj);
    }
    public function editUsers(){
        $myObj = new \stdClass();
        if(isset($_POST["pass_system"]) && !empty($_POST["pass_system"]))
            $_POST["pass_system"] = password_hash($_POST["pass_system"], PASSWORD_DEFAULT, ['cost' => 11]);
        else
            unset($_POST["pass_system"]);
        if($this->valid_input($_POST)) {
            $_POST["type_expiration_system"] = $_POST["type_expiration_system"] == "unlimited" ? 0 : 1;
            $myObj->status = true;
            $myObj->data = $this->System->editUser($_POST);
        }else{
            $myObj->status = false;
            $myObj->msg = "Empty input";
        }
        return json_encode($myObj);
    }
    public function change_pass(){
        $myObj = new \stdClass();
        if($_POST["pass_system"] == $_POST["cpass_system"]) {
            unset($_POST["cpass_system"]);
            $myObj->status = $this->System->change_pass_system($_POST);
        }else{
            $myObj->status = false;
            $myObj->subject = "password is not egal";
        }
        return json_encode($myObj);
    }
}