<?php

use App\modeles\ModeleClasse;

// deb($_SESSION['_USER_']);

if (!empty($_GET['id'])) :
    extract($_GET);
    try {
        $value = ModeleClasse::getoneByname('_codeRetrait', 'transfert', $id);
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
            '_createdAt' => dateFR($value['created_at']),
            '_codeRetrait' => $value['_codeRetrait'],
            '_zone' => $Destination['_reference'],
            '_expediteur' => $value['_Expediteur'],
            '_telExpediteur' => $value['_telephoneExp'],
            '_beneficiaire' => $value['_Beneficiaire'],
            '_telBeneficiaire' => $value['_telephoneBenef'],
            '_tauxTransfert' => number_format($value['_tauxTransfert'], 0, '.', ' ') . ' $',
            '_tauxJour' => number_format($value['_tauxJour'], 0, '.', ' ') . ' $',
            '_montantRetrait' => montantRetrait($value['_montant'], $value['_tauxTransfert'], $_SESSION['_USER_']['_idDevise']),
            '_statut' => convertStatut($value['statutTransfert']),
            '_statutID' => $value['statutTransfert'],
            '_statutColor' => $StatutColor
        ];
        // deb($Objet);
    } catch (\Throwable $th) {
        return $error = $th->getMessage();
    }
endif;


if (!empty($_POST)) :
    unset($_POST['createdBy']);
    $_POST['pinCode'] = md5($_POST['pinCode']);
    $_POST['modifyBy'] = $_SESSION['_USER_']['_idUser'];
    extract($_POST);
    // deb($_POST);
    try {
        // Verifier l'utilisateur
        $User = ModeleClasse::getoneByname('_codePin', 'users', $pinCode);
        if (!empty($User)) :
            $VerifTransfert = ModeleClasse::getoneByname('_telephoneBenef', 'transfert', $telephone);
            if (!empty($VerifTransfert)) :
                unset($_POST['pinCode']);
                unset($_POST['telephone']);
                $_POST['statutTransfert'] = 2;
                $_POST['_idTransfert'] = $VerifTransfert['_idTransfert'];
                extract($_POST);
                ModeleClasse::update('transfert', $_POST, '_idTransfert', $_idTransfert);
                // deb($_POST);
                header('Location:' . LINK . 'retrait');
            else :
                return $error = "Numero du Beneficiaire incorrect !";
            endif;
        else :
            return $error = "Votre code-secret est incorrect !";
        endif;
    } catch (\Throwable $th) {
        return $error = $th->getMessage();
    }
endif;
