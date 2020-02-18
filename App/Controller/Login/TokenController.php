<?php
namespace App\Controller\Login;

use App\Controller\AppController;

class TokenController extends AppController
{
    protected $title_page = 'Login | Hicham App';
    protected $description_page = 'Hicham App';
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
        $msg_load = '<h2 class="text-center" style="color: #FF0000">Activation was unsuccessful</h2>';
        if($this->System->check_token_system(["token_system" => $_GET["token"], "user_system" => $_GET["user"]]))
            $msg_load = '<h2 class="text-center" style="color: #00FF00">Activation was successful</h2>';
        $this->render($this->app_page.'/login', compact("msg_load"));
    }
    private function ErrorData(){
        $this->title_page = 'Hicham App | 404 Not Found';
        $this->description_page = 'Hicham App | 404 Not Found';
        $this->app_page = 'error';
        $this->template = 'default';
        $this->render($this->app_page.'/index');
    }

}