<div id="main">
<header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3 class="text-uppercase"><?=$page?></h3>
                    <p class="text-subtitle text-muted">Bienvenue &#224; vous, Imran CHERIF</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first text-end">
                    <div class="me-4">
                        <i title="Utilisateur" class="bi bi-person-plus text-light rounded-circle bg-primary shadow p-2" style="font-size: 25px"></i>
                        <strong> Administrateur</strong>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    <div class="card container p-4">
    <div class="d-flex justify-content-between">
    <div class=" card shadow col-4 h-25 ">
        <div class="card-header">
                                <div class="d-flex justify-content-between flex-wrap">
                                    <div class="col text-center">
                                        <h4 class="card-title">Information Transfert</h4>
                                    </div>

                                </div>
                                <hr>
        </div>
        <span class="card-body">
            <span><span class="h6">Montant Envoyer: </span> <span> <?=$transfert['_montant']?> <?php if ($transfert['_agenceStart'] == 1):
    echo "CAD";
elseif ($transfert['_agenceStart'] == 2):
    echo "GNF";
endif;
?>  </span></span>
            <hr>
            <span><span class="h6">Taux d'envoie: </span> <span><?=$transfert['_tauxTransfert']?> % </span> </span>
            <hr>
            <span><span class="h6">Net à retirer: </span> <span> <?=$netARetirer?>  <?php if ($transfert['_idAgence'] == 1):
    echo "CAD";
elseif ($transfert['_idAgence'] == 2):
    echo "GNF";
endif;
?> </span> </span>
            <hr>
            <span><span class="h6">status: </span>
                <?php if ($transfert['statut'] == 0):
    echo "<span class=' p-1 border-4  alert-danger'>Rejeter</span>";
elseif ($transfert['statut'] == 2):
    echo "<span class=' p-1 border-4  alert-success'>valider</span>";
elseif ($transfert['statut'] == 1):
    echo "<span class=' p-1 border-4  alert-warning'>en attente</span>";
endif;
?>  </span>
        </span>
    </div>

    <div class="card col-4 shadow" style="height:250px">
    <form action=""  method="post" class="container">
                        <div class="p-2">
                            <h4 class="text-center" >Confirmer un retrait
                            </h4>
                           <hr>
                        </div>
                        <div class="">
                            <div class="formulaire w-100">
                                <div class="input-group mb-3">
                                    <input class="form-control form-control fw-bold w-100" required name="_telephoneBenef" type="text" placeholder="telephone du beneficiaire">
                                </div>

                            </div>
                           <div class="formulaire w-100">
                                <div class="input-group mb-3">
                                    <input class="form-control form-control fw-bold w-100" required name="_codePin" type="password" placeholder="code pin">
                                </div>

                            </div>
                            <?php if ($transfert['statut'] == 1): ?>
                             <button type="submit" class="btn btn-primary fs-4 "><span class=""">Valider</span> <i class="bi bi-check-circle  "></i></button>
                             <?php endif;?>
                             <?php if ($transfert['statut'] == 2): ?>
                             <button type="submit" disabled class="btn btn-primary fs-4 "><span class=""">Valider</span> <i class="bi bi-check-circle  "></i></button>
                             <?php endif;?>


                        </div>
        </form>
        </div>
         </div>
    <div class="d-flex justify-content-between">
    <div class=" card shadow col-4 h-25 ">

            <div class="card-header">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <div class="col text-center">
                                            <h4 class="card-title">Information Expéditeur</h4>
                                        </div>

                                    </div>
                                    <hr>
            </div>
            <span class="card-body">
                <span ><span class="h6">Nom: </span> <span><?=$transfert['_nomExp']?> </span></span>
                <hr>
                <span><span class="h6">Prenom: </span> <span> <?=$transfert['_prenomExp']?></span></span>
                <hr>
                <span><span class="h6">Telephone </span> <span> <?=$transfert['_telephoneExp']?></span> </span>
            </span>
            </div>


    <div class=" card shadow col-4 h-25 ">

            <div class="card-header">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <div class="col text-center">
                                            <h4 class="card-title">Information Recepteur</h4>
                                        </div>

                                    </div>
                                    <hr>
            </div>
            <span class="card-body">
                <span ><span class="h6">Nom: </span> <span> <?=$transfert['_nomBenef']?></span></span>
                <hr>
                <span><span class="h6">Prenom: </span> <span> <?=$transfert['_prenomBenef']?></span></span>
            </span>
            </div>

    </div>
    </div>
    </div>
    </div>

