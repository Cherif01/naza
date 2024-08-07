<?php

use App\Autoloader;

include './config/db.php';
include './Autoloader.php';
include './functions/functions.php';

$success = "";
$error = "";

Autoloader::register();
if (!empty($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'dashboard';
}

$controllersPages = scandir('controllers');
$viewsPages = scandir('views');
if (in_array($page . '.controller.php', $controllersPages)) {
    if (in_array($page . '.view.php', $viewsPages)) {
        require_once('./controllers/' . $page . '.controller.php');
        // Page
        include('./includes/_head.php');
        include('./includes/_sidebar.php');
        require_once('./views/' . $page . '.view.php');
        include('./includes/_footer.php');
    }
} else {
    include('./includes/_head.php');
        include('./includes/_sidebar.php');
    require_once('./controllers/error.controller.php');
    require_once('./views/error.view.php');
    // include('./includes/_footer.php');
}


