<?php

namespace App\Controller;


use Core\Controller\Controller;
use ZipArchive;
use Browser;


class AppController extends  Controller
{
    protected $viewPath;
    protected $template;
    protected $app_page;
    protected $theme;
    protected $title_action;

    public function __construct(){
        parent::__construct();
    }
    public function valid_input($data){
        if(empty($data)) return false;
        if(is_array($data)) {
            $data_f = [];
            foreach ($data as $key => $val) {
                if(empty($val)) return false;
                $val = trim($val);
                $val = stripslashes($val);
                $val = htmlspecialchars($val);
                $data_f[$key] = $val;
            }
            return $data_f;
        }else{
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    }
    public function valid_array($data){
        if(is_array($data)){
            return true;
        }
        return false;
    }
    public function valid_object($data){
        if(is_object($data)){
            return true;
        }
        return false;
    }
    public function token_system(){
        return bin2hex(openssl_random_pseudo_bytes(16));
    }
    public function path_system($val){
        $prg_spl = preg_split('//', md5($val), -1, PREG_SPLIT_NO_EMPTY);
        $userName = array();
        for ($i = 0; $i < 14; $i++){
            $userName[] = $prg_spl[$i];
        }

        return implode($userName);
    }
    public function rand_code_system(){
        return rand(367858, 62569) . "-" . rand(167858, 32569) . "-" . rand(767858, 92569);
    }
    public function ip_client(){
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        return $_SERVER['REMOTE_ADDR'];
    }
    public function mail_sender($data){
        require_once (explode("App/Views", $this->viewPath)[0]."/Core/Api_vendor/html_dom/simple_html_dom.php");
        $to           = $data["to"];
        $subject      = $data["subject"];
        $from_name    = $data["from_name"];
        $from_mail    = $data["from_mail"];
        $type_mail    = $data["type_mail"];
        $content_mail = $data["content_mail"];
        $username     = $data["username"];
        $file = $this->viewPath . "mail/message.php";
        $html = str_get_html(file_get_contents($file, true));
        switch($type_mail){
            case "code":
                $url_msg_mail = "http://". $_SERVER["SERVER_NAME"] ."/users/?p=login/rest&user=". $username ."&rest_code=". $content_mail;
                break;
            case "token":
                $url_msg_mail = "http://". $_SERVER["SERVER_NAME"] ."/users/?p=login/token&user=". $username ."&token=". $content_mail;
                break;
            default:
                $url_msg_mail = false;
        }
        if(!$url_msg_mail) return false;
        $html->find('span[id=token]', 0)->innertext = $url_msg_mail;
        $message = $html;
        $encoding = "utf-8";
        $subject_preferences = array(
            "input-charset" => $encoding,
            "output-charset" => $encoding,
            "line-length" => 76,
            "line-break-chars" => "\r\n"
        );
        $header = "Content-type: text/html; charset=".$encoding." \r\n";
        $header .= "From: ".$from_name." <".$from_mail."> \r\n";
        $header .= "MIME-Version: 1.0 \r\n";
        $header .= "Content-Transfer-Encoding: 8bit \r\n";
        $header .= "Date: ".date("r (T)")." \r\n";
        $header .= iconv_mime_encode("Subject", $subject, $subject_preferences);

        return mail($to,$subject,$message,$header);
    }
    public function check_url($url){
        return (strpos($url, 'http') || strpos($url, 'https')) ? $url : "http://".$url;
    }
    public function readwriteFile($data){
        $file = file_get_contents(explode("App/Views", $this->viewPath)[0]."/Core/work_files/index_mark.php", true);
        $file = str_replace("{{domain.com}}", $data["domain"], $file);
        $file_index = str_replace("{{code_verify}}", $data["code_verify"], $file);
        if(!file_put_contents(explode("App/Views", $this->viewPath)[0]."/layout/upload/files/" . $data["code_verify"] . "/index.php", $file_index))
            return false;
        $path_dir = explode("App/Views", $this->viewPath)[0] . "/layout/upload/files/" . $data["code_verify"] . "/";
        $zip_created = explode("App/Views", $this->viewPath)[0] . "/layout/upload/files/" . $data["code_verify"] . "/app_" . $data["id_domain"] . ".zip";
        $zip = new \ZipArchive();
        if ($zip->open($zip_created, ZipArchive::CREATE)) {
            $dir = opendir($path_dir);
            while ($file = readdir($dir)) {
                if (is_file($path_dir . $file)) {
                    if(strpos($file, ".php")){
                        $zip->addFile($path_dir . $file, $file);
                    }
                }
            }
            $zip->close();
            unlink(explode("App/Views", $this->viewPath)[0] . "/layout/upload/files/" . $data["code_verify"] . "/index.php");
            return true;
        }
        return false;
    }
    public function detect_analytics($id_link, $userAgent, $ip){
        require_once explode("App/Views", $this->viewPath)[0].'/Core/Api_vendor/browser/vendor/autoload.php';
        $browser = new Browser($userAgent);
        $api_ip = json_decode(file_get_contents("http://ip-api.com/json/$ip?fields=status,country"));
        $device = 'PC';
        if($browser->isMobile() || $browser->isTablet())  $device = 'MOBILE';
        if($browser->isRobot()) $device = 'ROBOT';
        if($browser->isAol())  $device = 'AOL';
        if($browser->isFacebook()) $device = 'FB';
        return [
            "link_analytics"   => $id_link,
            "pla_analytics"    => $browser->getPlatform(),
            "device_analytics" => $device,
            "bro_analytics"    => $browser->getBrowser(),
            "cou_analytics"    => $api_ip->status == "fail" ? "Unknown" : $api_ip->country,
            "ip_analytics"     => $ip,
            "date_analytics"   => date("Y-m-d"),
            "sdate_analytics"  => date("Y-m-d H:i:s")
        ];
    }
    public function exit_system(){
        session_unset();
        session_destroy();
        $_SESSION = [];
    }
}