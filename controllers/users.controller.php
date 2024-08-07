<?php

use App\modeles\ModeleClasse;

if (isset($_GET['page'])) :
    // deb($_GET);

    // Tous les utilisateur...
    $TabUsers = [];
    try {
        $List = ModeleClasse::getall('users');
        foreach ($List as $data) :
            // Pays
            $Pays = ModeleClasse::getoneByname('_idPays', 'listPays', $data['_paysID']);
            $Objet = [
                'id' => $data['_idUser'],
                'nom' => $data['_nom'],
                'prenom' => $data['_prenom'],
                'telephone' => $data['_telephone'],
                'pays' => $Pays['_pays'],
                'idPays'=>$data['_paysID']
            ];
            array_push($TabUsers, $Objet);
        endforeach;

        //Tous les pays
        $TabPays = [];
        $pays = ModeleClasse::getall('listPays');
        foreach ($pays as $data) :
            $Objet = [
                'id' => $data['_idPays'],
                'pays' => $data['_pays']
            ];
            array_push($TabPays, $Objet);
        endforeach;
    } catch (\Throwable $th) {
        return $error = $th->getMessage();
    }
endif;


// Enregistrement
if (!empty($_POST) && empty($_GET['id'])) :
    $_POST['_motDePasse'] = md5("1234");
    $_POST['_codePin'] = md5("1234");
    extract($_POST);
    // deb($_POST);
    try {
        $add = ModeleClasse::add('users', $_POST);
        // deb($add);
        if ($add == 1) :
            $success = "Enregistrer avec success... !";
            $encodedSuccess = urlencode($success);
            header('location:' . LINK . 'users?success=' . $encodedSuccess);
        else :
            $error = "Erreur lors de l'enregistrement...";
            $encodedError = urlencode($error);
            header('location:' . LINK . 'users?error=' . $encodedError);
        endif;
    } catch (\Throwable $th) {
        //throw $th;
        return $error = $th->getMessage();
    }
endif;

if (!empty($_GET['id'])) {
    extract($_GET);
    $explode = explode('-', $id);
    if ($explode[0] == 'del') {
        try {
            ModeleClasse::delete("_idUser", "users", $explode[1]);
            $success = "utilisateur supprimé";
            $encodedSuccess = urlencode($success);
            header('Location: ' . LINK . 'users?success=' . $encodedSuccess);
            exit();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    } else if ($explode[0] == 'edit' && !empty($_POST)) {
        extract($_POST);
        try {
            ModeleClasse::update("users", $_POST, "_idUser", $explode[1]);
            $success = "utilisateur modifié";
            $encodedSuccess = urlencode($success);
            header('Location: ' . LINK . 'users?success=' . $encodedSuccess);
            exit();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }
}
