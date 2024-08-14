<?php

use App\Autoloader;

session_start();
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

if (empty($_SESSION['_USER_']))
    $page = 'auth';

if (!empty($_POST)) :
    $_POST['createdBy'] = $_SESSION['_USER_']['_idUser'];
    extract($_POST);
endif;

$controllersPages = scandir('controllers');
$viewsPages = scandir('views');
if (in_array($page . '.controller.php', $controllersPages)) {
    if (in_array($page . '.view.php', $viewsPages)) {
        require_once('./controllers/' . $page . '.controller.php');
        if ($page == 'auth') :
            include('./includes/_head.php');
            // include('./includes/_sidebar.php');
            require_once('./views/' . $page . '.view.php');
            include('./includes/_footer.php');
        else :
            // Page
            include('./includes/_head.php');
            include('./includes/_sidebar.php');
            require_once('./views/' . $page . '.view.php');
            include('./includes/_footer.php');
        endif;
    }
} else {
    include('./includes/_head.php');
    include('./includes/_sidebar.php');
    require_once('./controllers/error.controller.php');
    require_once('./views/error.view.php');
    // include('./includes/_footer.php');
}
