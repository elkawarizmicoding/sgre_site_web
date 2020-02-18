<?php

namespace Core\Controller;


use App;

class Controller
{
    protected $viewPath;
    protected $template;
    protected $theme;
    protected $title_page;
    protected $app_page;
    protected $description_page;
    protected $logoIcon;
    protected $page_name;


    public function __construct()
    {
        $this->viewPath = ROOT.'/App/Views/';
        $this->theme    = App::$path.'/layout/';
        foreach ($_POST as $key => $value) {
            if(!is_array($_POST[$key])){
                $_POST[$key] = htmlentities($value);
                return;
            }
            $_POST[$key] = $value;
        }
        $this->domain_path = App::$path;
    }
    protected function loadModel($model_name){
        $this->$model_name = \App::getInstance()->getModel($model_name);
    }
    protected function render($view, $variables = []){
        $title_page = $this->title_page;
        $description_page = $this->description_page;
        $logoIcon = 'upload/favicon.png';
        $logoPage = 'upload/logo.png';
        $theme = $this->theme;
        $page_name = $this->page_name;
        ob_start();
        extract($variables);
        include($this->viewPath . $view.'.php');
        $content = ob_get_clean();
        include($this->viewPath. 'templates/'.$this->app_page.'/'.$this->template.'.php');
    }
    protected function redirect($location){
        header('location: '. App::$path.$location);
    }
    protected function redirect_time($location, $sec){
        header("Refresh: $sec; url=".App::$path.$location);
    }
}