<?php
use App\modeles\ModeleClasse;

if(!empty($_POST) && empty($_GET['id'])) 
{
    // ajouter les taux
    extract($_POST);
    // deb($_POST);
    try {
        ModeleClasse::add('taux', $_POST);
        $success = 'Taux ajouté avec succes !';
        header('location:'.LINK.'taux'); 
    } catch (\Throwable $th) {
        echo $error = $th->getMessage();
        die();
    }
}
else {
    // éditer un taux
    if(!empty($_GET['id'])) : 
        extract($_GET); 
        $explode = explode('-', $id); 
        $ID = $explode[1];
        // deb($ID);
        try {
            if(str_contains($id, 'edit')) : 
                // deb($ID);
                ModeleClasse::update('taux', $_POST, $ID);
                header('location:'.LINK.'taux');
            elseif(str_contains($id, 'delete')) : 
                ModeleClasse::delete($ID, 'taux'); 
                header('location:'.LINK.'taux');
            endif;
        } catch (\Throwable $th) {
            echo $error = $th->getMessage();
            die();
        }
    endif;
    
}

// afficher les taux
try {
    $ListeTaux = ModeleClasse::getall('taux');
} catch (\Throwable $th) {
    echo $error = $th->getMessage();
    die();
}
$compteur = 1;
