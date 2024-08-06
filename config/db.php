<?php
require_once("./config/config.php");
$dbinfo=TYPE.':host='.HOST.';dbname='.DBNAME;

try {
   $connect=new PDO($dbinfo,DBUSER,DBPASS);
} catch (Exception $e) {
    die($e->getMessage());
}