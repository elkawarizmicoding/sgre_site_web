<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

class IndexController extends AppController
{
    protected $title_page = 'Admin | Dashboard';
    protected $description_page = 'Dashboard';
    protected $app_page;
    protected $template;
    protected $page_name = "index";
    protected $viewPath;
    protected $theme;

    public function __construct($app_page){
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
        $data_dashboard = $this->System->dataDashboard();
        $this->render($this->app_page.'/index', compact("system_info", "data_dashboard"));
    }
    public function json_settings(){
        $myObj = new \stdClass();
        $myObj->status = true;
        $myObj->data = $this->System->json_settings();
        $path = explode("App/Views", $this->viewPath)[0]."/layout/upload/files/file_admin/";
        $myObj->logo = file_exists($path."logo.png") ? $this->theme."/upload/files/file_admin/logo.png" : false;
        $myObj->favicon = file_exists($path."favicon.png") ? $this->theme."/upload/files/file_admin/favicon.png" : false;
        return json_encode($myObj);
    }
    public function update_settings(){
        $myObj = new \stdClass();
        $myObj->status = $this->System->update_settings($_POST);
        return json_encode($myObj);
    }
    public function add_domain(){
        $myObj = new \stdClass();
        if(!empty($_POST["value_domain"])){
            if (filter_var($_POST["value_domain"], FILTER_VALIDATE_URL)){
                if(!$this->System->checkDomain($_POST["value_domain"])) {
                    unset($_POST["ajax_action"]);
                    $_POST["create_domain_id"] = $_SESSION["system_info"]["info"]->id_system;
                    $_POST["active_domain"] = 0;
                    $_POST["type_domain"] = "admin";
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
    public function delete_domain(){
        $myObj = new \stdClass();
        if($this->System->delete_domain($_POST["id_domain"])) {
            if(unlink("layout/upload/files/" . $_SESSION["system_info"]["info"]->path_system . "/app_".$_POST["id_domain"].".zip")) {
                $myObj->status = true;
                $myObj->page = "?p=admin/index";
            }else{
                $myObj->status = true;
                $myObj->page = "?p=admin/index";
            }
        }else{
            $myObj->status = false;
            $myObj->msg = "Dont Deleted";
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