<?php

use App\modeles\ModeleClasse;

if (isset($_GET['page'])) :
    // deb($_GET);

    // Toutes les agences...
    $TabAgence = [];
    try {
        $List = ModeleClasse::getall('agence');
        foreach ($List as $data) :
            // Pays
            $Pays = ModeleClasse::getoneByname('_idPays', 'listPays', $data['_idPays']);
            // Representant
            $User = ModeleClasse::getoneByname('_idUser', 'users', $data['_idUser']);
            $Objet = [
                'id' => $data['_idAgence'],
                'reference' => $data['_reference'],
                'adresse' => $data['_adresse'],
                'contact' => $data['_contact'],
                'pays' => $Pays['_pays'],
                'idPays' => $data['_idPays'],
                'codePays' => $Pays['_code'],
                'idUtilisateur' => $data['_idUser'],
                'representant' => $User['_prenom'] . ' ' . $User['_nom'],
            ];
            array_push($TabAgence, $Objet);
        endforeach;
        //Tous les utilisateurs
        $TabUtilisateurs = [];

        $utilisateur = ModeleClasse::getall('users');
        foreach($utilisateur as $data):
            $pays = ModeleClasse::getone('_idPays','listPays', $data['_paysID']);
            $Objet =[
                'id'=> $data['_idUser'],
                'nom'=> $data['_nom'],
                'prenom'=> $data['_prenom'],
                'pays'=> $pays['_pays']
            ];
            array_push($TabUtilisateurs,$Objet);
        endforeach;
        
         //Tous les pays
         $TabPays = [];

         $pays = ModeleClasse::getall('listPays');
         foreach($pays as $data):
             $Objet =[
                 'id'=> $data['_idPays'],
                 'pays'=> $data['_pays']
             ];
             array_push($TabPays,$Objet);
         endforeach;
    }catch(\Throwable $th){
        echo  $error = $th->getMessage();
    }
endif;

// Enregistrement
if(!empty($_POST) && empty($_GET['id'])):
    extract($_POST);
    try{
        ModeleClasse::add("agence",$_POST);
        $success = "Enregistrer avec success... !";
        $encodedSuccess = urlencode($success);
        header('location:'.LINK.'agence?success='.$encodedSuccess);
    }catch(\Throwable $th){
        echo $error = $th->getMessage();die();
    }
endif;


if (!empty($_GET['id'])) {
    extract($_GET);
    $explode = explode('-', $id);
    if ($explode[0] == 'del') {
        try {
            ModeleClasse::delete("_idAgence", "agence",$explode[1]);
            $success = "agence supprimé";
            $encodedSuccess = urlencode($success);
            header('Location: ' . LINK . 'agence?success=' . $encodedSuccess);
            exit();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    } else if ($explode[0] == 'edit' && !empty($_POST)) {
        extract($_POST);
        try {
            ModeleClasse::update("agence", $_POST,"_idAgence", $explode[1]);
            $success = "agence modifié";
            $encodedSuccess = urlencode($success);
            header('Location: ' . LINK . 'agence?success=' . $encodedSuccess);
            exit();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }
}