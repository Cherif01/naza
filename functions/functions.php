<?php

function testReq_LOGIN()
{
   if(!empty($_SESSION['error'])) : ?>
         <div class="text-danger text-center fw-bold shadow shadow-lg p-2">
            <?= $_SESSION['error'] ?>
         </div>
         <?php unset($_SESSION['error']);
         echo '<meta http-equiv="refresh" content="2" >';  
   endif; 
   if(!empty($_SESSION['success'])) : ?>
         <h2 class="fs-4 text-success"><?= $_SESSION['success'] ?></h2>

         <?php unset($_SESSION['success']);
            header('Location: '.LINK.'accueil');
   endif;
}

function alertMsg()
{
   if(!empty($_SESSION['error'])) : ?>
         <div class="text-danger text-center fw-bold shadow shadow-lg p-2">
            <?= $_SESSION['error'] ?>
         </div>
   <?php          
      endif; 
      if(!empty($_SESSION['success'])) : ?>
         <div class="fs-5 text-success"><?= $_SESSION['success'] ?></div>
         <?php //unset($_SESSION['success']);
   endif;
}



function deb($post)
{
   echo "<pre>";
   print_r($post);
   echo "</pre>";
   die();
}

function is_connected(){
   if(empty($_SESSION['role'])){
      header("location:connexion");
   }
}


function checkallfields($tab = [])
{
   if (!empty($_POST)) {
      $result = [];
      foreach ($_POST as $name => $v) {
         if (empty($v)) {
            if (in_array($name, $tab)) {
            } else {
               array_push($result, $name);
            }
         }
      }
      return $result;
   }
}


function errorclasse($filed)
{
   if (!empty($_POST)) {
      if (empty($filed)) {
         echo "is-invalid";
      } else {
         echo "";
      }
   }
}

function VideChamps($post)
{
   if (!empty($post)) {
      extract($post);
      foreach ($post as $key => $value) {
         unset($$key);
      }
   }
}


function errormessage($filed)
{
   if (!empty($_POST)) {
      if (empty($filed)) {
         echo "Veuillez remplir ce champ";
      } else {
         echo "";
      }
   }
}

function fieldempty($fild)
{
    if(!empty($_POST))
    {
      if(empty($fild))
    {
        echo"*";
    }
    }
}

function viderchamp(){
    
    foreach($_POST as $key=>$value)
    {
        global $$key;
        $$key = null;   
    }
}

function inputred($fild)
{
   if(!empty($_POST))
   {
    if(empty($field))
    {
        echo"is-invalid";
    }
   }
}
