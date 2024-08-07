<?php

// afficher Transfert

try {
    $TabTranfert = [];
    $req = \App\modeles\ModeleClasse::getall('transfert');
    foreach ($req as  $value) {
        array_push($TabTranfert, $value);
    }
    
} catch (\Throwable $th) {
    echo $error = $th->getMessage();die();
}

// afficher Agence

try {
    $TabAgence = [];
    $req = \App\modeles\ModeleClasse::getall('agence');
    foreach ($req as  $value) {
        array_push($TabAgence, $value);
    }

} catch (\Throwable $th) {
    //throw $th;
}

// afficher client

try {
    $TabClient = [];
    $req = \App\modeles\ModeleClasse::getall('client');
    foreach ($req as  $value) {
        array_push($TabClient, $value);
    }

} catch (\Throwable $th) {
    //throw $th;
}

//ajouter
if(!empty($_POST) && empty($_GET['id'])):
    $imagePath = __files('_pieceIdentite');
    if ($imagePath) {
        $_POST['_pieceIdentite'] = $imagePath;
    }
    extract($_POST);
    var_dump($_POST);
    try {
       
        $_POST["_codeRetrait"] = generateRandomCode();
        // Ajoutez l'article avec le chemin de l'image
        \App\modeles\ModeleClasse::add("transfert", $_POST);
        $success= "transfert effectué avec succès";
        $encodedSuccess = urlencode($success);
        header("location: ".LINK."send-money?success=" . $encodedSuccess);
        exit();
        
    } catch(Throwable $th) {
         $th->getMessage();
    }
endif;

if (!empty($_GET['id'])) {

    extract($_GET);
    try {
        $sup = \App\modeles\ModeleClasse::delete('_idTransfert', 'transfert', $id);
        
        $success= "Suppression effectué avec succès";
        $encodedSuccess = urlencode($success);
        header("location: ".LINK."send-money?success=" . $encodedSuccess);
        exit();
        
    } catch (\Throwable $th) {
        //throw $th;
       $error = $th->getMessage();
    }
}
