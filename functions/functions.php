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

function __files($type){
   if(isset($_FILES[$type]['name'])){

    
      /* Getting file name */
      $filename = $_FILES[$type]['name'];
   
      /* Location */
      $location = 'uploads/'.$filename;
      $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
      $imageFileType = strtolower($imageFileType);
   
      /* Valid extensions */
      $valid_extensions = array("jpg","jpeg","png", "pdf", "docx");
   
      $response = 0;
      /* Check file extension */
      if(in_array(strtolower($imageFileType), $valid_extensions)) {
         /* Upload file */
         if(move_uploaded_file($_FILES[$type]['tmp_name'],$location)){
            $response = $location;
         }
      }
   
      echo $response;
     return $_FILES[$type]['name'];
   }
   
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
function generateRandomCode($length = 5) {
   return substr(bin2hex(random_bytes($length)), 0, $length);
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
