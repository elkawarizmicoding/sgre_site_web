<?php

class Core
{
    private $language;

    public function __construct($language = "ar")
    {
        $this->language = $language;
        define('ROOT',dirname(__DIR__));
        include(ROOT . '/App/App.php');
        App::$path = $_SERVER["SERVER_PORT"] == "80" ? 'http://' . $_SERVER['SERVER_NAME'] : 'https://' . $_SERVER['SERVER_NAME'];
        App::load();
        $p = 'error';
        $pageLoad = $p;
        $controller = '\App\Controller\Error\ErrorController';
        $action = 'index';
        $controller = new $controller($language, $pageLoad);
        $controller->$action();
    }
}



$Error = new Core();
