<?php
namespace App\Controller\Login;

use App\Controller\AppController;

    class IndexController extends AppController
{
    protected $title_page = 'Login | SGRE App';
    protected $description_page = 'SGRE App';
    protected $app_page;
    protected $template;

    public function __construct($app_page)
    {
        parent::__construct();
        $this->app_page = $app_page;
        $this->template = 'default';
        $this->loadModel('System');
    }

    public function index($page = null, $id = false){
        if(isset($_SESSION["system_info"])){
            $this->redirect("/?p=".$_SESSION["system_info"]["info"]->type_system."/index");
        }
        $this->render($this->app_page.'/index');
    }

    public function getInfo(){
        $myObj = new \stdClass();
        $myObj->status = true;
        $myObj->data = $_SESSION["system_info"];
        return json_encode($myObj);
    }

    private function ErrorData(){
        $this->title_page = 'SGRE App | 404 Not Found';
        $this->description_page = 'SGRE App | 404 Not Found';
        $this->app_page = 'error';
        $this->template = 'default';
        $this->render($this->app_page.'/index');
    }

}