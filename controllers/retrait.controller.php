<?php

use App\modeles\ModeleClasse;

if (!empty($_GET)) :

    try {
        $retrait = [];
        $ret = ModeleClasse::getall('retrait');
        foreach ($ret as $data) :
            $ag = ModeleClasse::getoneByname('_idAgence', 'agence', $data['_agenceConfirm']);
            $Objet = [
                '_idTransfert' => $data['_idTransfert'],
                'agence' => $ag['_reference'],
                'statut' => $data['statut'],
                '_idRetrait' => $data['_idRetrait']
            ];
            array_push($retrait, $Objet);
        endforeach;
    } catch (\Throwable $th) {
        echo $th->getMessage();
        die();
    }
endif;

if (!empty($_POST)) {
    extract($_POST);
    $code = $_POST['_codeRetrait'];
    try {
        $transfert = ModeleClasse::getoneByname('_codeRetrait', 'transfert', $code);
        if ($transfert) {
            header('location:' . LINK . 'get_retrait/' . $code);
        } else {
            $erro = " Ce code n'existe pas";
            $encodederro = urlencode($erro);
            header('location:' . LINK . 'retrait?error=' . $encodederro);
            exit();
        }
    } catch (\Throwable $th) {
    }
}

if (!empty($_GET['id'])) :

    //extraire id et stocker dans une variable $id
    extract($_GET);
    //verrifier si l'id contient le caratere "-"
    if (str_contains($id, '-')) :

        //explode nous retourne un array c'est a dir un tableau d'elements
        $explode = explode('-', $id);
        //deb($explode);
        //on prends le deuxieme element (qui est l'id) de $explode pour stocker dans la variable $ID
        $ID = $explode[1];

        //verrifier si l'id contient le mot edit

        if (str_contains($id, 'delete')) :

            try {
              
                ModeleClasse::delete( '_idRetrait','retrait', $ID);
                $success = " Retrait supprimé avec succès";
                $encodedsuccess = urlencode($success);
                header('location:' . LINK . 'retrait?success=' . $encodederro);
                exit();
            } catch (\Throwable $th) {
                //throw $th;
                echo $th->getMessage();
                die();
            }

        endif;
    endif;
endif;
