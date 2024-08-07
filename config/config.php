<?php
define("LOCALHOST",$_SERVER['SERVER_NAME']);
define("URL",substr($_SERVER['PHP_SELF'],0,-9));
define("LINK",(($_SERVER['SERVER_PORT']==443)?'https':'http').'://'.LOCALHOST.URL);

#CONSTANTES LIEES A LA BASE DE DONNEE
define("HOST","localhost");
define("TYPE","mysql");
define("DBNAME","transfert");
define("DBUSER","root");
define("DBPASS","rmdn");
