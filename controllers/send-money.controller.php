<?php

// afficher Transfert

// deb($_SESSION);

use App\modeles\ModeleClasse;

try {
    $TabTranfert = [];
    $req = ModeleClasse::getAllByName('_agenceSourceID', 'transfert', $_SESSION['_USER_']['_idAgence']);
    foreach ($req as  $value) {
        // Destination
        $Destination = ModeleClasse::getoneByname('_idAgence', 'agence', $value['_agenceDestinationID']);
        if ($value['statutTransfert'] == 1)
            $StatutColor = 'warning';
        elseif ($value['statutTransfert'] == 2)
            $StatutColor = 'success';
        elseif ($value['statutTransfert'] == 3)
            $StatutColor = 'danger';
        else
            $StatutColor = 'info';

        $Objet = [
            'id' => $value['_idTransfert'],
            '_codeRetrait' => $value['_codeRetrait'],
            '_zone' => $Destination['_reference'],
            '_beneficiaire' => $value['_Beneficiaire'],
            '_montantRetrait' => montantRetrait2($value['_montant'], $value['_tauxTransfert'], $_SESSION['_USER_']['_idDevise']),
            '_statut' => convertStatut($value['statutTransfert']),
            '_statutID' => $value['statutTransfert'],
            '_statutColor' => $StatutColor
        ];
        array_push($TabTranfert, $Objet);
        // deb($TabTranfert);
    }
} catch (\Throwable $th) {
    echo $error = $th->getMessage();
    die();
}

// afficher Agence

try {
    $TabAgence = [];
    $req = ModeleClasse::getall('agence');
    foreach ($req as  $value) {
        if ($value['_idUser'] != $_SESSION['_USER_']['_idUser'])
            array_push($TabAgence, $value);
    }
} catch (\Throwable $th) {
    //throw $th;
}


if (!empty($_GET['id'])) {
    extract($_GET);
    $explode = explode('-', $id);
    if ($explode[0] == 'del') {
        try {
            ModeleClasse::delete("_idTransfert", "transfert", $explode[1]);
            $success = "utilisateur supprimé";
            $encodedSuccess = urlencode($success);
            header('Location: ' . LINK . 'send-money');
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }
}


//ajouter
if (!empty($_POST)) :
    $TauxJour = ModeleClasse::getOneDesc('taux');
    $_POST['_tauxJour'] = $TauxJour['tauxJour'];
    try {
        $_POST["_codeRetrait"] = generateRandomCode();
        extract($_POST);
        // deb($_POST);
        ModeleClasse::add("transfert", $_POST);
        $success = "transfert effectué avec succès";
        $encodedSuccess = urlencode($success);
        header("location: " . LINK . "send-money?success=" . $encodedSuccess);
    } catch (Throwable $th) {
        return $error = $th->getMessage();
    }
endif;

// Suppressio
if (!empty($_GET['id'])) {
    extract($_GET);
    try {
        $sup = ModeleClasse::delete('_idTransfert', 'transfert', $id);
        $success = "Suppression effectué avec succès";
        $encodedSuccess = urlencode($success);
        header("location: " . LINK . "send-money?success=" . $encodedSuccess);
        exit();
    } catch (\Throwable $th) {
        //throw $th;
        $error = $th->getMessage();
    }
}
