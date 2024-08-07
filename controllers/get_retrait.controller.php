<?php
use App\modeles\ModeleClasse;

if(!empty($_GET['id'])):
    // deb($_GET['id']);
    
    extract($_GET);
    $code = $id;
try {
    $transfert = ModeleClasse::getoneByname('_codeRetrait', 'transfert', $code);
    $netARetirer= $transfert['_montant']*$transfert['_tauxTransfert'];

} catch (\Throwable $th) {
    echo $th->getMessage();
    die();
}
endif;


try {
    $idCurrentUser= 17;
    $currentUser=ModeleClasse::getoneByname('_idUser','users',$idCurrentUser);

} catch (\Throwable $th) {
    //throw $th;
}

if(!empty($_POST)):
    $_POST['_codePin']=md5($_POST['_codePin']);
    extract($_POST);
    // deb($currentUser['_codePin']);
    if ($_POST['_codePin']==$currentUser['_codePin'] && $_POST['_telephoneBenef']==$transfert['_telephoneBenef']) {
        $agence = ModeleClasse::getoneByname('_idUser','agence',$idCurrentUser);
        unset($_POST);
        $_POST['statut']=2;
        ModeleClasse::update('transfert',$_POST,'_idTransfert',$transfert['_idTransfert']);
        unset($_POST);
        $_POST['_idTransfert']=$transfert['_idTransfert'];
        $_POST['_agenceConfirm']=$agence['_idAgence'];
      try {
        ModeleClasse::add('retrait',$_POST);
        $success = "  retrait confirmé avec succès";
            $encodedSuccess = urlencode($success);
            header('location:'.LINK.'retrait?success='.$encodedSuccess);
            exit();
      } catch (\Throwable $th) {
        //throw $th;
      }
    }
    else{
        $success = " telephone ou code pin incorrect ";
        $encodedSuccess = urlencode($success);
        header('location:'.LINK.'get_retrait/'.$code.'?error='.$encodedSuccess);
        exit();
    }
endif;