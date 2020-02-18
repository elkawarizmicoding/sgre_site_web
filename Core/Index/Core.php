<?php


class Core{
    private $pageLoad;
    private $page;
    private $id_check = false;

    public function __construct(){
        define('ROOT', str_replace("/Core", "", dirname(__DIR__)));
        include(ROOT.'/App/App.php');
        App::$path = $_SERVER["SERVER_PORT"] == "80" ? 'http://'. $_SERVER['SERVER_NAME'] : 'https://'. $_SERVER['SERVER_NAME'];
        App::load();
        $this->pageLoad = 'index';
        if(isset($_FILES["ajax_upload"])){
            $myObj = new stdClass();
            $Upload = '\App\Controller\UploadController';
            $file_name = '';
            switch($_POST["action_path"]){
                case "logo":
                    $file_name = ROOT.'/layout/upload/logo.png';
                    break;
                case "favicon":
                    $file_name = ROOT.'/layout/upload/favicon.png';
                    break;
                case "profile":
                    $file_name = ROOT.'/layout/upload/profile.png';
                    break;
            }
            $Upload = new $Upload($_FILES["ajax_upload"], $file_name);
            if($Upload->uploader()){
                $myObj->status = true;
            }else{
                $myObj->status = false;
                $myObj->msg = $Upload->error();
            }
            echo json_encode($myObj);
            return;
        }
        if(isset($_POST['ajax_action'])){
            $request = explode(".", $_POST['ajax_action']);
            $controller = '\App\Controller\\' . ucfirst($request[0]) . '\\' . ucfirst($request[1]) . 'Controller';
            $action = $request[2];
            $controller = new $controller($this->pageLoad);
            echo $controller->$action();
            return;
        }
        if(isset($_GET['p'])){
            $p = $_GET['p'] == 'index' ? 'login/index' : $_GET['p'];
        }else{
            $p = 'login/index';
        }
        $p = explode('/', rtrim($p, '/'));
        $action = 'index';
        if(isset($_GET['p']) && (isset($p[1]) && $p[1] != 'index')){
            if($p[0] == 'index'){
                $p[0] = 'index';
            }else{
                $this->pageLoad = $p[0];
            }
            if(intval($p[1]) != 0){
                $this->id_check = true;
                $this->page = intval($p[1]);
            }else{
                $this->id_check = false;
                $this->page = $p[1];
            }
        }
        if(isset($p[0])){
            $this->pageLoad = $p[0];
        }
        $controllerName = "index";
        if(isset($p[1])){
            $controllerName = $p[1];
        }
        App::getInstance()->cur_page = strtolower($controllerName);
        $controller = '\App\Controller\\' . ucfirst($this->pageLoad) . '\\' . ucfirst($controllerName) . 'Controller';
        if(!file_exists(ROOT . '/' . str_replace('\\', '/', $controller) . '.php')){
            $this->Error();
            return;
        }
        $controller = new $controller($this->pageLoad);
        if(!method_exists($controller,$action)){
            $this->Error();
            return;
        }
        $controller->$action($this->page, $this->id_check);
    }
    private function Error(){
        $controller = '\App\Controller\Error\ErrorController';
        $action = 'home';
        $this->pageLoad = 'error';
        $controller = new $controller($this->pageLoad);
        $controller->$action();
    }
}