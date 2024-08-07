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
                'codePays' => $Pays['_code'],
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
                'prenom'=> $data['prenom'],
                'pays'=> $pays['_pays']
            ];
            array_push($TabUtilisateurs,$Objet);
        endforeach;
    }catch(\Throwable $th){
        return $error = $th->getMessage();die();
    }
endif;


// Enregistrement
if(!empty($_POST)):
    extract($_POST);
    try{
        
    }catch(\Throwable $th){

    }
endif;