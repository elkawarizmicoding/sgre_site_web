<?php
namespace App\Controller\Login;

use App\Controller\AppController;

class RestController extends AppController
{
    protected $title_page = 'Login | Hicham App';
    protected $description_page = 'Hicham App';
    protected $app_page;
    protected $template;

    public function __construct($app_page)
    {
        parent::__construct();
        $this->app_page = 'login';
        $this->template = 'default';
        $this->loadModel('System');
    }
    public function index($page = null, $id = false){
        $isRest = false;
        if($this->System->check_code_system(["code_system" => $_GET["rest_code"], "user_system" => $_GET["user"]])) {
            $isRest = true;
            $_SESSION["user_system"] = $_GET["user"];
        }
        $this->render($this->app_page.'/index', compact("isRest"));
    }
    private function ErrorData(){
        $this->title_page = 'Hicham App | 404 Not Found';
        $this->description_page = 'Hicham App | 404 Not Found';
        $this->app_page = 'error';
        $this->template = 'default';
        $this->render($this->app_page.'/index');
    }

}