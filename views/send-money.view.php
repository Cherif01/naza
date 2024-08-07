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
                    <h3 class="text-uppercase"><?= $page ?></h3>
                    <p class="text-subtitle text-muted">Bienvenue &#224; vous, Imran CHERIF</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first text-end">
                    <i title="Utilisateur" class="bi bi-person-plus text-danger rounded-circle bg-white shadow p-2" style="font-size: 30px"></i>
                </div>
            </div>
        </div>
        <!-- Bordered table start -->
        <section class="section">
            <div class="row" id="table-bordered">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class="col text-start">
                                    <h4 class="card-title">Transferer de l'argent</h4>
                                </div>
                                <div class="col text-end">
                                    <!-- Button trigger for Disabled Backdrop -->
                                    <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#backdrop">
                                        Nouveau transfert
                                    </button>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <!-- table bordered -->
                        <div class="table-responsive p-4">
                            <table class="table table-hover mb-0" id="maTable">
                                <thead>
                                    <tr>
                                        <th>Montant</th>
                                        <th>Taux d'envoie</th>
                                        <th>nom expediteur</th>
                                        <th>Telephone expediteur</th>
                                        <th>nom Beneficiaire</th>
                                        <th>Telephone Beneficiaire</th>
                                        <th>Status</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($TabTranfert)) :
                                        foreach ($TabTranfert as $value) :
                                    ?>
                                            <tr>
                                                <td><?= $value["_montant"] ?></td>
                                                <td><?= $value["_tauxTransfert"] ?></td>
                                                <td><?= $value["_nomExp"] ?> <?= $value["_prenomExp"] ?></td>
                                                <td><?= $value["_telephoneExp"] ?></td>
                                                <td><?= $value["_nomBenef"] ?> <?= $value["_prenomBenef"] ?></td>
                                                <td><?= $value["_telephoneBenef"] ?></td>
                                                <td><?php
                                                    if ($value['statut'] == 0) {
                                                        echo '<span class="badge text-bg-danger">rejeté</span>';
                                                    } elseif ($value['statut'] == 1) {
                                                        echo '<span class="badge text-bg-warning">En attente</span>';
                                                    } elseif ($value['statut'] == 2) {
                                                        echo '<span class="badge text-bg-success">Payé</span>';
                                                    }
                                                    ?></td>

                                                <td>

                                                
                                                    <button class="btn btn-danger" 
                                                    <?php
                                                    if ($value['statut'] == 1) {
                                                       echo "disabled title='inof' data-bs-toggle='popover' data-bs-title='Info' data-bs-content='Vous ne pouvez pas supprimer une transaction en attente ' ";
                                                    }
                                                    ?>                                
                                                     onclick="deleteAlert(<?= $value[0] ?>, 'send-money/')" >
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                  
                                                </td>
                                            </tr>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Bordered table end -->
        <!--Disabled Backdrop Modal -->
        <form action="" method="POST">
            <div class="modal fade text-left" id="backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable " role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel4">Effectuer un transfert d'argent
                            </h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="formulaire w-100">
                                <div class=" mb-3 d-flex gap-1 col-6">
                                    <div class="input-group  col-md-3 ">
                                        <input class="form-control form-control fw-bold w-100" required name="_montant" type="text" placeholder="entrez le montant">
                                    </div>
                                    <div class="input-group col-md-3 ">
                                        <input class="form-control form-control fw-bold w-100" required name="_tauxTransfert" type="text" placeholder="Taux transfert ...">
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Frais</span>
                                    <input type="text" class="form-control" disabled aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-text">GNF</span>
                                </div>
                                <div class=" mb-3 d-flex gap-1 col-6">
                                    <div class="input-group col-md-3">
                                        <input class="form-control form-control fw-bold w-100" required name="_nomExp" type="text" placeholder="Nom de l'expediteur">
                                    </div>
                                    <div class="input-group col-md-3">
                                        <input class="form-control form-control fw-bold w-100" required name="_prenomExp" type="text" placeholder="Prenom de l'expediteur">
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input class="form-control form-control fw-bold w-100" required name="_telephoneExp" type="text" placeholder="Telephone de l'expediteur">
                                </div>
                                <div class="input-group mb-3">
                                    <select class="form-select fw-bold" id="" name="_idClient" required>
                                        <option selected>Choisir un client</option>
                                        <?php
                                        if (!empty($TabClient)) :
                                            foreach ($TabClient as $value) :
                                        ?>
                                                <option value="<?= $value["_idClient"] ?>"><?= $value["_nom"] ?> <?= $value["_prenom"] ?></option>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </div>
                                <div class=" mb-3 d-flex gap-1 col-6">

                                    <div class="input-group col-md-3">
                                        <input class="form-control form-control fw-bold w-100" required name="_nomBenef" type="text" placeholder="Nom du Beneficiaire">
                                    </div>
                                    <div class="input-group col-md-3">
                                        <input class="form-control form-control fw-bold w-100" required name="_prenomBenef" type="text" placeholder="prenom du Beneficiaire">
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input class="form-control form-control fw-bold w-100" required name="_telephoneBenef" type="text" placeholder="Telephone du Beneficiaire">
                                </div>
                                <div class="mb-3 border p-2">
                                    <label for="formFile" class="form-label">Piece d'identité</label>
                                    <input class="form-control" type="file" name="_pieceIdentite" id="formFile">
                                </div>

                                <div class="input-group mb-3">
                                    <input class="form-control form-control fw-bold w-100" required name="_agenceStart" type="text" placeholder="Agence de depart ...">
                                </div>

                                <div class="input-group mb-3">
                                    <select class="form-select fw-bold" id="" name="_idAgence" required>
                                        <option selected>Choisir une agence...</option>
                                        <?php
                                        if (!empty($TabAgence)) :
                                            foreach ($TabAgence as $value) :
                                        ?>
                                                <option value="<?= $value["_idAgence"] ?>"><?= $value["_reference"] ?> </option>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <input class="form-control form-control fw-bold w-100" required type="password" placeholder="Entrez votre mot de passe">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Fermer</span>
                            </button>
                            <button type="submit" class="btn btn-light-success ml-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Enregistrer</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>