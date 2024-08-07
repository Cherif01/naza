<?php
use App\modeles\ModeleClasse;

if (!empty($_GET)):

    try {
        $retrait=[];
        $ret = ModeleClasse::getall('retrait');
        foreach($ret as $data):
            $ag=ModeleClasse::getoneByname('_idAgence','agence',$data['_agenceConfirm']);
            $retrait['_idTransfert']=$data['_idTransfert'];
            $retrait['agence']= $ag['_reference'];
            $retrait['statut']=$data['statut'];
            $retrait['_idRetrait']=$data['_idRetrait'];
            array_push($retrait,$data);
        endforeach;
    } catch (\Throwable $th) {
        //throw $th;
    }
    ;
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

if (!empty($_GET['id'])):

    //extraire id et stocker dans une variable $id
    extract($_GET);
    //verrifier si l'id contient le caratere "-"
    if (str_contains($id, '-')):

        //explode nous retourne un array c'est a dir un tableau d'elements
        $explode = explode('-', $id);
        //deb($explode);
        //on prends le deuxieme element (qui est l'id) de $explode pour stocker dans la variable $ID
        $ID = $explode[1];

        //verrifier si l'id contient le mot edit

        if (str_contains($id, 'delete')):

            try {
                $_POST['statut'] = 0;
                $del = ModeleClasse::update('retrait', $_POST, '_idRetrait', $ID);
                header('location:' . LINK . 'liste');
            } catch (\Throwable $th) {
                //throw $th;
                echo $th->getMessage();die();
            }

        endif;
    endif;
endif;
