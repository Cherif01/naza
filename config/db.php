<?php
require_once("./config/config.php");
$dbinfo=TYPE.':host='.HOST.';dbname='.DBNAME;

try {
    $connect=new PDO($dbinfo,DBUSER,DBPASS);
    $connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die($e->getMessage());
}