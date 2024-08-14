<?php

use App\modeles\ModeleClasse;

if (!empty($_GET)) :

    try {
        $Operation = [];
        $req = ModeleClasse::getAllByName('statut', 'typeOperation', 1);
        foreach ($req as $data) :
            // deb($data);
            $ag = ModeleClasse::getoneByname('_idAgence', 'agence', $_SESSION['_USER_']['_idUser']);
            $Objet = [
                'idOperation' => $data['_idType'],
                'libelle' => $data['_libelle'],
                'commentaire' => $data['_commentaire'],
                'statut' => ($data['statut'])
            ];
            if ($data['_idType'] == 1 || $data['_idType'] == 2)
                array_push($Operation, $Objet);
        endforeach;
        // deb($retrait);
    } catch (\Throwable $th) {
        echo $th->getMessage();
        die();
    }
endif;


// Calcul
$postdata = file_get_contents("php://input");
if (!empty($_POST)) {
    // Secure
    foreach ($_POST as $key => $value) {
        $_POST[$key] = str_secure($_POST[$key]);
    }
    // Extraire les donnees qui sont vides...
    foreach ($_POST as $key => $value) {
        if ($_POST[$key] == '')
            unset($_POST[$key]);
    }
    extract($_POST);
    if (!isset($_POST['date2']))
        $_POST['date2'] = $_POST['date1'];

    if (!isset($_POST['option']))
        return $error = "Choisis une option precise...";
    // deb($_POST);
    // Tout
    try {
        $reponse = [];

        $_d1 = date_create($_POST['date1']);
        $_date1 = date_format($_d1, 'Y-m-d');
        $_d2 = date_create($_POST['date2']);
        $_date2 = date_format($_d2, 'Y-m-d');


        switch ($option):
            case 1:
                // List des transferts
                $Envoie = ModeleClasse::getAllByName('createdBy', 'transfert', $_SESSION['_USER_']['_idUser']);
                // Filtre    
                foreach ($Envoie as $data) :
                    $dateConvert = date_create($data['createdAt']);
                    $dateDB = date_format($dateConvert, 'Y-m-d');
                    // Vérifier si la date du transfert est entre $_date1 et $_date2
                    if ($dateDB >= $_date1 && $dateDB <= $_date2) :
                        $ObjetTransfert = [
                            'id' => $data['_idTransfert'],
                            'createdAt' => $data['createdAt'],
                            'type' => 'Envoie d\'argent',
                            'montant' => number_format($data['_montant'], 2, '.', ' '),
                            'expediteur' => $data['_Expediteur'],
                            'telExp' => $data['_telephoneExp'],
                            'beneficiaire' => $data['_Beneficiaire'],
                            'telBenef' => $data['_telephoneBenef'],
                            'color' => 'text-primary',
                        ];
                        array_push($reponse, $ObjetTransfert);
                    endif;
                endforeach;
                break;

            case 2:
                $Retrait_ = ModeleClasse::getAllByName('modifyBy', 'transfert', $_SESSION['_USER_']['_idUser']);
                // Retrait    
                foreach ($Retrait_ as $data) :
                    $dateConvert = date_create($data['createdAt']);
                    $dateDB = date_format($dateConvert, 'Y-m-d');
                    // Vérifier si la date du transfert est entre $_date1 et $_date2
                    if ($dateDB >= $_date1 && $dateDB <= $_date2) :
                        // Si l'idDevise de la session = 1, alors :
                        if ($_SESSION['_USER_']['_idDevise'] == 1) :
                            $Retrait -= $data['_montant'] * $data['_tauxTransfert'];
                        else :
                            $montant3_ = (($data['_montant']  * 3) / 100);
                            $Retrait -= (($data['_montant']  - $montant3_) / $data['_tauxTransfert']);
                        endif;
                        // Ajout des donnees de retrait (transfert)
                        $ObjetTransfert = [
                            'id' => $data['_idTransfert'],
                            'createdAt' => $data['createdAt'],
                            'type' => 'Retrait d\'argent',
                            'montant' => number_format(-$Retrait, 2, '.', ' '),
                            'expediteur' => $data['_Expediteur'],
                            'telExp' => $data['_telephoneExp'],
                            'beneficiaire' => $data['_Beneficiaire'],
                            'telBenef' => $data['_telephoneBenef'],
                            'color' => 'text-danger',
                        ];
                        array_push($reponse, $ObjetTransfert);
                    endif;
                endforeach;
                break;
            case 3:
                // Operation
                $Operation_ = ModeleClasse::getAllByName('createdBy', 'operation', $_SESSION['_USER_']['_idUser']);
                foreach ($Operation_ as $data) :
                    $dateConvert = date_create($data['createdAt']);
                    $dateDB = date_format($dateConvert, 'Y-m-d');
                    // Vérifier si la date du transfert est entre $_date1 et $_date2
                    if ($dateDB >= $_date1 && $dateDB <= $_date2) :
                        // Ajout des donnees de retrait (transfert)
                        $Objet = [
                            'id' => $data['_idOperation'],
                            'createdAt' => $data['createdAt'],
                            'type' => TypeOperation($data['_idType']),
                            'montant' => number_format($data['_montant'], 2, '.', ' '),
                            'expediteur' => $data['_motif'],
                            'telExp' => null,
                            'beneficiaire' => $data['_sousCouvert'],
                            'telBenef' => null,
                            'color' => 'text-secondary',
                        ];
                        array_push($reponse, $Objet);
                    endif;
                endforeach;

                break;
            default:
                return $error = "Aucune option envoyer";
        endswitch;

        // deb($reponse);
    } catch (\Throwable $th) {
        //throw $th;
        return $error = json_encode($th->getMessage());
    }
}
