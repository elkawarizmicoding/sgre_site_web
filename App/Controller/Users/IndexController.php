<?php
namespace App\Controller\Users;

use App\Controller\AppController;

class IndexController extends AppController
{
    protected $title_page = 'Users | Hicham App';
    protected $description_page = 'Hicham App';
    protected $app_page;
    protected $template;
    protected $page_name = "index";

    public function __construct($app_page)
    {
        parent::__construct();
        $this->app_page = $app_page;
        $this->template = 'default';
        $this->loadModel('System');
    }
    public function index($page = null, $id = false){
        if(!isset($_SESSION["system_info"])){
            $this->redirect("/?p=index");
        }
        $system_info = $_SESSION["system_info"];
        $dashboard = $this->System->dataDashboardUsers($system_info["info"]->id_system);
        $this->render($this->app_page.'/index', compact("system_info", "dashboard"));
    }
    public function getDomain(){
        $myObj = new \stdClass();
        $myObj->status = true;
        $myObj->data = $this->System->getDomain($_SESSION["system_info"]["info"]->id_system);
        return json_encode($myObj);
    }
    public function createLink(){
        $myObj = new \stdClass();
        if($this->valid_input($_POST)) {
            unset($_POST["ajax_action"]);
            $_POST["system_link"] = $_SESSION["system_info"]["info"]->id_system;
            $_POST["date_link"] = date("Y-m-d h:i:s");
            if ($this->System->createLink($_POST)) {
                $myObj->status = true;
            } else {
                $myObj->status = false;
                $myObj->msg = "Error dont created";
            }
        }else{
            $myObj->status = false;
            $myObj->msg = "Check empty input";
        }
        return json_encode($myObj);
    }
    public function addDomain(){
        $myObj = new \stdClass();
        if(!empty($_POST["value_domain"])){
            if(filter_var($_POST["value_domain"], FILTER_VALIDATE_URL)) {
                if(!$this->System->checkDomain($_POST["value_domain"])) {
                    unset($_POST["ajax_action"]);
                    $_POST["create_domain_id"] = $_SESSION["system_info"]["info"]->id_system;
                    $_POST["active_domain"] = 0;
                    $_POST["type_domain"] = "users";
                    $_POST["date_domain"] = date("Y-m-d h:i:s");
                    if ($this->System->addDomain($_POST)) {
                        $myObj->status = $this->readwriteFile([
                            "domain" => $_POST["value_domain"],
                            "code_verify" => $_SESSION["system_info"]["info"]->path_system,
                            "id_domain" => $this->System->getNewDomain($_POST["date_domain"])
                        ]);
                    }
                }else{
                    $myObj->status = false;
                    $myObj->msg = "This domain is exits";
                }
            }else{
                $myObj->status = false;
                $myObj->msg = "This domain is not Url. Put (http://domain.com)";
            }
        }else{
            $myObj->status = false;
            $myObj->msg = "Empty input";
        }
        return json_encode($myObj);
    }
    public function editProfile(){
        $myObj = new \stdClass();
        $myObj->status = false;
        unset($_POST["ajax_action"]);
        if(isset($_POST["old_pass"]) && !empty($_POST["old_pass"])){
            if(password_verify($_POST['old_pass'], $_SESSION["system_info"]["info"]->pass_system)){
                if($_POST["pass_system"] == $_POST["retype_pass"]) {
                    unset($_POST["old_pass"]);
                    unset($_POST["retype_pass"]);
                    $myObj->status = $this->System->editProfile($_SESSION["system_info"]["info"]->id_system, $_POST);
                }else{
                    $myObj->msg = "Password is not egal";
                }
            }else{
                $myObj->status = "Password is incerct";
            }
        }else{
            unset($_POST["old_pass"]);
            unset($_POST["retype_pass"]);
            unset($_POST["pass_system"]);
            $myObj->status = $this->System->editProfile($_SESSION["system_info"]["info"]->id_system, $_POST);
        }
        return json_encode($myObj);
    }
    private function ErrorData(){
        $this->title_page = 'Hicham App | 404 Not Found';
        $this->description_page = 'Hicham App | 404 Not Found';
        $this->app_page = 'error';
        $this->template = 'default';
        $this->render($this->app_page.'/index');
    }

}