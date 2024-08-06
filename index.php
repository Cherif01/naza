<?php

use App\Autoloader;

session_start();
include './config/db.php';
include './Autoloader.php';
include './functions/functions.php';

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

        include('./includes/head.php');
        require_once('./views/' . $page . '.view.php');
        include('./includes/footer.php');
    }
} else {
    include('./includes/head.php');
    include('./includes/menu.php');
    require_once('./controllers/error.controller.php');
    require_once('./views/error.view.php');
    include('./includes/footer.php');
}
