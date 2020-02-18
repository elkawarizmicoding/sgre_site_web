<?php
namespace App\Controller\Login;

use App\Controller\AppController;

class LogoutController extends AppController
{

    public function __construct($app_page)
    {
        parent::__construct();
    }

    public function index($page = null, $id = false)
    {
        $this->exit_system();
        $this->redirect("/?p=index");
    }
}