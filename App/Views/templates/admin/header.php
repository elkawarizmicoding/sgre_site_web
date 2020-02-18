<?php
$input_html = "<input type='hidden' value='disabled' id='isAction'>";
$img_profile = $theme."img/photo-users.jpg";
if(file_exists(str_replace("App/Views/templates", "layout/upload/files/".$variables["system_info"]["info"]->path_system."/profile.png", dirname(__DIR__)))){
    $input_html = "<input type='hidden' value='undisabled' id='isAction'>";
    $img_profile = $theme."upload/files/".$variables["system_info"]["info"]->path_system."/profile.png";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1, user-scalable=yes">
    <title><?= $title_page; ?></title>
    <meta name="description" content="<?= $description_page; ?>">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?= $theme . $logoIcon; ?>" type="image/png">
    <!-- Favicons
            <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
            <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
            <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">-->
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?= $theme; ?>css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= $theme; ?>css/bootstrap-select.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= $theme; ?>css/icofont.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $theme; ?>css/google.css">
    <link rel="stylesheet" type="text/css" href="<?= $theme; ?>css/google2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $theme; ?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= $theme; ?>css/responsive.css">
    <link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
    <script src="<?= $theme; ?>js/html5shiv.min.js"></script>
    <script src="<?= $theme; ?>js/respond.min.js"></script>
    <style>
        .path {stroke-dasharray: 0 !important;}
    </style>
    <![endif]-->
    <script src="<?= $theme; ?>js/jquery.min.js"></script>
    <script src="<?= $theme; ?>js/jquery.marquee.min.js"></script>
    <script src="<?= $theme; ?>js/bootstrap.min.js"></script>
    <script src="<?= $theme; ?>js/bootstrap-select.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/numeric/1.2.6/numeric.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="<?= $theme; ?>ckeditor/ckeditor.js"></script>
    <script src="<?= $theme; ?>ckfinder/ckfinder.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
</head>
<body>
    <nav class="tab-nav">
        <div class="tab-nav-cn">
            <label class="switch">
                <input type="checkbox" checked>
                <span class="slider"></span>
            </label>
            <div class="logo">
                <div class="tab-logo">
                    <span>logo</span>
                </div>
            </div>
            <label class="menu">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>
        <div class="tab-nav-lt">
            <label class="switch">
                <input type="checkbox" checked>
                <span class="slider"></span>
            </label>
            <div class="logo">
                <div class="tab-logo">
                    <span class="logo-page">
                        <img src="<?= $theme . $logoPage ?>">
                    </span>
                </div>
            </div>
        </div>
        <div class="tab-nav-rg">
            <div class="tab-netif">
                <span></span>
                <div class="pin">
                    <i class="icofont-notification"></i>
                </div>
            </div>
            <div class="dropdown">
                <div class="tab-profil dropdown-toggle" type="button" data-toggle="dropdown">
                    <div class="pin">
                        <img src="<?= $img_profile ?>">
                    </div>
                    <span><?= $variables["system_info"]["info"]->user_system ?></span>
                </div>
                <ul class="dropdown-menu">
                    <li class="drop-header">
                        <div class="drop-back">
                            <img src="<?= $theme; ?>img/back0.jpg">
                        </div>
                        <div class="drop-cover-back"></div>
                        <div class="drop-photo-pr">
                            <img src="<?= $img_profile ?>">
                        </div>
                        <div class="drop-text">
                            <span><?= $variables["system_info"]["info"]->fname_system ?></span>
                        </div>
                    </li>
                    <li class="drop-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <div id="profile" class="drop-tab clR text-center">
                                    <span class="icon"><i class="icofont-user-suited"></i></span>
                                    <span class="text">Profile</span>
                                    <?= $input_html ?>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div id="logout" class="drop-tab clB text-center">
                                    <span class="icon"><i class="icofont-logout"></i></span>
                                    <span class="text">Logout</span>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!--<div class="tab-logout">
                <div class="pin"></div>
            </div>-->
        </div>
    </nav>
    <div class="tab-aside">
        <ul>
            <li class="item <?php if($page_name == "index") echo "active"; ?>" data-url="?p=admin/index">
                <span class="pin"></span>
                <div class="tab-button">
                    <span class="icon-btn"><i class="icofont-home"></i></span>
                    <span class="title-btn">Dashboard</span>
                </div>
            </li>
            <li class="item <?php if($page_name == "packages") echo "active"; ?>" data-url="?p=admin/packages">
                <input type="hidden" value="package">
                <span class="pin"></span>
                <div class="tab-button">
                    <span class="icon-btn"><i class="icofont-package"></i></span>
                    <span class="title-btn">Manage Package</span>
                </div>
            </li>
            <li class="item <?php if($page_name == "users") echo "active"; ?>" data-url="?p=admin/users">
                <span class="pin"></span>
                <div class="tab-button">
                    <span class="icon-btn"><i class="icofont-user"></i></span>
                    <span class="title-btn">Manage users</span>
                </div>
            </li>
            <li class="item <?php if($page_name == "about") echo "active"; ?>" data-url="?p=admin/about">
                <span class="pin"></span>
                <div class="tab-button">
                    <span class="icon-btn"><i class="icofont-edit-alt"></i></span>
                    <span class="title-btn">About Page</span>
                </div>
            </li>
            <li class="item" data-url="modal" data-modal="settings">
                <span class="pin"></span>
                <div class="tab-button">
                    <span class="icon-btn"><i class="icofont-ui-settings"></i></span>
                    <span class="title-btn">Settings</span>
                </div>
            </li>
        </ul>
    </div>
    <div class="tab-panel-cover"></div>

