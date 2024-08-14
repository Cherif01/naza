<?php

use App\modeles\ModeleClasse;

/**
 * Recuperer ?
 * 1 : Listes des transactions (Depot et Retrait)
 * 2 : Autres Operation (Entrer, Sortie, Depenses)
 * 3 : Solde Actuelle
 * 4 : Benefice...
 */
$_Sigle = $_SESSION['_USER_']['_sigle'];
//  deb($_SESSION);
if (!empty($_GET)) {
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
            if ($data['_idType'] != 1 && $data['_idType'] != 2)
                array_push($Operation, $Objet);
        endforeach;
        // deb($retrait);
    } catch (\Throwable $th) {
        return $error = $th->getMessage();
    }

    $Depot = 0;
    $Retrait = 0;
    $_Solde = 0;
    $Transactions = [];
    try {
        // Depot
        $TransfertArgent = ModeleClasse::getAllByName('createdBy', 'transfert', $_SESSION['_USER_']['_idUser']);
        foreach ($TransfertArgent as $data) :
            $Depot += $data['_montant'];
            // Ajout des donnees de depot (transfert)
            $Objet = [
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
            array_push($Transactions, $Objet);
        endforeach;
        // Retrait
        $RetraitArgent = ModeleClasse::getAllByName('modifyBy', 'transfert', $_SESSION['_USER_']['_idUser']);
        foreach ($RetraitArgent as $data) :
            // Si l'idDevise de la session = 1, alors :
            if ($_SESSION['_USER_']['_idDevise'] == 1) :
                $Retrait -= $data['_montant'] * $data['_tauxTransfert'];
            else :
                $montant3_ = (($data['_montant']  * 3) / 100);
                $Retrait -= (($data['_montant']  - $montant3_) / $data['_tauxTransfert']);
            endif;
            // Ajout des donnees de retrait (transfert)
            $Objet = [
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
            array_push($Transactions, $Objet);
        endforeach;


        $Encaissement = 0;
        $Decaissement = 0;
        $Charge = 0;
        // Operation
        $Operation_ = ModeleClasse::getAllByName('createdBy', 'operation', $_SESSION['_USER_']['_idUser']);
        foreach ($Operation_ as $data) :
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
            array_push($Transactions, $Objet);
            if ($data['_idType'] == 3) : // Encaissement
                $_Solde += $data['_montant'];
                $Encaissement += $data['_montant'];
            elseif ($data['_idType'] == 4) : // Sortie et depense
                $_Solde -= $data['_montant'];
                $Decaissement += $data['_montant'];
            elseif ($data['_idType'] == 5) : // Sortie et depense
                $_Solde -= $data['_montant'];
                $Charge += $data['_montant'];
            endif;

        endforeach;
        trieParDate($Transactions, 'createdAt');
        // Somme
        $_Solde += $Depot + $Retrait;

        // Autres Operation sur la caisse

    } catch (\Throwable $th) {
        //throw $th;
    }
}



// ENVOIE
if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    extract($_POST);
    // deb($_POST);
    if ($_idType != 3 && $_montant > $_Solde)
        return $error = "Solde faible pour cette operation...";
    try {
        ModeleClasse::add('operation', $_POST);
        header('Location:' . LINK . 'comptabilite');
    } catch (\Throwable $th) {
        //throw $th;
    }
endif;
