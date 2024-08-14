<?php

function testReq_LOGIN()
{
   if (!empty($_SESSION['error'])) : ?>
      <div class="text-danger text-center fw-bold shadow shadow-lg p-2">
         <?= $_SESSION['error'] ?>
      </div>
   <?php unset($_SESSION['error']);
      echo '<meta http-equiv="refresh" content="2" >';
   endif;
   if (!empty($_SESSION['success'])) : ?>
      <h2 class="fs-4 text-success"><?= $_SESSION['success'] ?></h2>

   <?php unset($_SESSION['success']);
      header('Location: ' . LINK . 'accueil');
   endif;
}

function __files($type)
{
   if (isset($_FILES[$type]['name'])) {


      /* Getting file name */
      $filename = $_FILES[$type]['name'];

      /* Location */
      $location = 'uploads/' . $filename;
      $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
      $imageFileType = strtolower($imageFileType);

      /* Valid extensions */
      $valid_extensions = array("jpg", "jpeg", "png", "pdf", "docx");

      $response = 0;
      /* Check file extension */
      if (in_array(strtolower($imageFileType), $valid_extensions)) {
         /* Upload file */
         if (move_uploaded_file($_FILES[$type]['tmp_name'], $location)) {
            $response = $location;
         }
      }

      echo $response;
      return $_FILES[$type]['name'];
   }
}



function alertMsg()
{
   if (!empty($_SESSION['error'])) : ?>
      <div class="text-danger text-center fw-bold shadow shadow-lg p-2">
         <?= $_SESSION['error'] ?>
      </div>
   <?php
   endif;
   if (!empty($_SESSION['success'])) : ?>
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

function is_connected()
{
   if (empty($_SESSION['role'])) {
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
   if (!empty($_POST)) {
      if (empty($fild)) {
         echo "*";
      }
   }
}

function viderchamp()
{

   foreach ($_POST as $key => $value) {
      global $$key;
      $$key = null;
   }
}
function generateRandomCode($length = 5)
{
   return substr(bin2hex(random_bytes($length)), 0, $length);
}


function inputred($fild)
{
   if (!empty($_POST)) {
      if (empty($field)) {
         echo "is-invalid";
      }
   }
}



function format2Chart($data)
{
   $tab = explode('.', $data);
   if (empty($tab[1])) :
      $tab[1] = "00";
   endif;
   return $tab[0] . '.' . substr($tab[1], 0, 2);
}

function obtenirDateHeureActuelles()
{
   // Définir le fuseau horaire GMT+00
   $timezone = new DateTimeZone('GMT');

   // Créer une nouvelle instance de DateTime avec le fuseau horaire défini
   $date = new DateTime('now', $timezone);

   // Formater la date selon votre besoin
   $date_format = $date->format('d/m/Y');

   // Afficher la date
   return $date_format;
}


function HeuredateFR($votre_date)
{
   // Définir le fuseau horaire GMT+00
   $timezone = new DateTimeZone('GMT');

   // Créer une nouvelle instance de DateTime avec le fuseau horaire défini
   $date = new DateTime($votre_date, $timezone);
   //  $date = $votre_date;

   // Formater la date selon votre besoin
   // $date_format = $date->format('d-m-Y');
   $date_format = $date->format('H:i:s - d/m/Y');

   // Afficher la date
   return $date_format;
}
function dateFR($votre_date)
{
   // Définir le fuseau horaire GMT+00
   $timezone = new DateTimeZone('GMT');

   // Créer une nouvelle instance de DateTime avec le fuseau horaire défini
   $date = new DateTime($votre_date, $timezone);
   //  $date = $votre_date;

   // Formater la date selon votre besoin
   // $date_format = $date->format('d-m-Y');
   $date_format = $date->format('d/m/Y');

   // Afficher la date
   return $date_format;
}

// function codeGenerate($length)
// {
//    return substr(uniqid(random_int(1000, 9999)), 0, 4) . date('is') . substr(uniqid(time()), -2).date("mY");
// }

function codeGenerate($longueur)
{

   $prefixe = "NASA";
   $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $codeAleatoire = '';

   for ($i = 0; $i < $longueur - 4; $i++) { // Ajuster la longueur de la partie aléatoire
      $codeAleatoire .= $caracteres[rand(0, strlen($caracteres) - 1)];
   }

   $datePart = date("dm");

   $codeTransfert = $prefixe . $codeAleatoire . $datePart;

   return $codeTransfert;
}


function montantRetrait($montantDepot, $Taux, $DevisePaiement)
{
   // NB : DevisePaiement = la devise de celui qui a payer
   $result = 0;
   if ($DevisePaiement == 1) : // (SESSION = GUINEA) => SOURCE = CANADA
      $result = ($montantDepot * $Taux);
   elseif ($DevisePaiement == 2) : // Session = CANADA => SOURCE = GUINEA
      // calcul du 3%
      $montant3_ = (($montantDepot * 3) / 100);
      $result = (($montantDepot - $montant3_) / $Taux);
   else :
   endif;
   return number_format($result, 2, '.', ' ') . ' | ' . convertDevise($DevisePaiement);
}

function montantRetrait2($montantDepot, $Taux, $DevisePaiement)
{
   $result = 0;
   if ($DevisePaiement == 1) : // Taux du jour (GUINEA -> CA)
      // calcul du 3%
      $montant3_ = (($montantDepot * 3) / 100);
      $Total = (($montantDepot - $montant3_) / $Taux);
      $result = floatval($Total);
   elseif ($DevisePaiement == 2) : // 3% dans le dollar canadien (CA -> GUINEA) 
      $result = ($montantDepot * $Taux);
   else :
   endif;
   return $result;
}

function str_secure($str)
{
   return $str = htmlspecialchars(htmlentities($str));
}

function formatNumber1($Number)
{
   return number_format($Number, 0, '.', ' ');
}
function formatNumber2($Number)
{
   return number_format($Number, 2, '.', ' ');
}


// Devise
// ici c'est pour prendre le contraire de ce qui a ete envoyer pour trouver la vrai valeur
function DeviseRecursive($DeviseID)
{
   switch ($DeviseID):
      case 1:
         return ' CAD';
      case 2:
         return ' GNF';
      default:
         return ' Inconnus';
   endswitch;
}

function convertDevise($DeviseID)
{
   switch ($DeviseID):
      case 1:
         return ' GNF';
      case 2:
         return ' CAD';
      default:
         return ' Inconnus';
   endswitch;
}
function TypeOperation($OperationID)
{
   switch ($OperationID):
      case 3:
         return ' Encaissement';
      case 4:
         return ' Decaissement';
      case 5:
         return ' Depense';
      default:
         return ' Inconnus';
   endswitch;
}

function convertStatut($StatutID)
{
   switch ($StatutID):
      case 1:
         return ' En attente';
      case 2:
         return ' Valider';
      case 3:
         return ' Compromis';
      default:
         return ' Inconnus';
   endswitch;
}

function convertNombre($value)
{
   // Récupérer la valeur de l'entrée
   $currency = $value;

   // Supprimer tous les espaces (séparateurs de milliers)
   $currency = preg_replace('/\s+/', '', $currency);

   // Remplacer la virgule par un point pour conversion en float
   $currency = str_replace('', '.', $currency);

   // Convertir en float
   return $amount = ($currency);
}


function trieParDate(&$Tab, $key)
{
   // Fonction de comparaison pour trier par une clé donnée
   usort($Tab, function ($a, $b) use ($key) {
      $dateA = strtotime($a[$key]);
      $dateB = strtotime($b[$key]);
      return $dateB <=> $dateA;
   });
}
