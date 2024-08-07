<?php
use App\modeles\ModeleClasse;

if (!empty($_GET)):
   
        try {
            ModeleClasse::getall('retrait');
        } catch (\Throwable $th) {
            //throw $th;
        }
    ;
endif;

if (!empty($_POST)) {
   extract($_POST);
  $code=$_POST['_codeRetrait'];
  header('location:'.LINK.'get_retrait/'.$code);
}