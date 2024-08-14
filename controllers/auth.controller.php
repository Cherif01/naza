<?php

use App\modeles\ModeleClasse;

if (!empty($_POST)) :
    $_POST['_motDePasse'] = md5($_POST['_motDePasse']);
    extract($_POST);
    // deb($_POST);

    try {
        $Auth = ModeleClasse::loginUser('users', '_telephone', $_telephone, '_motDePasse', $_motDePasse);
        // deb($Auth['info']);
        if ($Auth['state'] == 1) :
            $PaysUser = ModeleClasse::getoneByname('_idPays', 'listPays', $Auth['info']['_paysID']);
            $DeviseUser = ModeleClasse::getoneByname('_idDevise', 'devise', $PaysUser['_idDevise']);
            $Agence = ModeleClasse::getoneByname('_idUser', 'agence', $Auth['info']['_idUser']);
            // deb($DeviseUser);
            $Objet = [
                '_idUser' => $Auth['info']['_idUser'],
                '_nom' => $Auth['info']['_nom'],
                '_prenom' => $Auth['info']['_prenom'],
                '_telephone' => $Auth['info']['_telephone'],
                '_paysID' => $Auth['info']['_paysID'],
                '_idAgence' => $Agence['_idAgence'],
                '_paysName' => $PaysUser['_pays'],
                '_idDevise' => $PaysUser['_idDevise'],
                '_sigle' => $DeviseUser['_sigle'],
            ];
            $_SESSION['_USER_'] = $Objet;
            // deb($_SESSION);
            // return $success = "connecter avec success";
            header('Location:' . LINK . 'dashboard');
        else :
            return $error = "connexion echouer";
        endif;
    } catch (\Throwable $th) {
        //throw $th;
    }
endif;
