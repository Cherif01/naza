<?php 
use App\modeles\ModeleClasse;

try {
    $reponse = [];
    $_date1 = date('Y-m-d');
    $_date2 = date('Y-m-d');

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
    trieParDate($reponse, 'createdAt');

    // deb($reponse);
} catch (\Throwable $th) {
    //throw $th;
    return $error = json_encode($th->getMessage());
}