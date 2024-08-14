<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="col-12 col-md-6">
                <h3 class="text-uppercase"><?= $page ?></h3>
            </div>
        </div>
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger p-1 fw-bold"><?= $error ?></div>
        <?php endif; ?>
        <hr>
        <!-- Bordered table start -->
        <section class="section d-n" id="list-transfert">
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
                                    <button type="button" id="blueBtn" class="btn btn-outline-primary ms-2">
                                        <i class="bi bi-cash"></i> | Placer un transfert
                                    </button>
                                    <button type="button" id="redBtn" class="btn btn-outline-danger ms-2">
                                        <i class="bi bi-reply"></i> | Voir la liste
                                    </button>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <!-- table bordered -->
                        <div id="myTable">
                            <div class="table-responsive p-4">
                                <table class="table table-hover mb-0" id="maTable">
                                    <thead>
                                        <tr>
                                            <th>Code retrait</th>
                                            <th>B&#233;neficiaire</th>
                                            <th>ZONE</th>
                                            <th>Retrait Possible</th>
                                            <th>Status</th>
                                            <th class="text-center">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($TabTranfert as $data) : ?>
                                            <tr>
                                                <td class="text-uppercase">NAZA-<?= $data['_codeRetrait'] ?></td>
                                                <td><?= $data['_beneficiaire'] ?></td>
                                                <td><?= $data['_zone'] ?></td>
                                                <td><?= $data['_montantRetrait'] ?></td>
                                                <td><span class="badge bg-<?= $data['_statutColor'] ?>"><?= $data['_statut'] ?></span></td>
                                                <td class="text-center">
                                                    <?php if ($data['_statutID'] == 1) : ?>
                                                        <a href="#" onclick="deleteAlert(<?= $data['id'] ?>, 'send-money/del-')" class="btn btn-outline-danger"><span class="bi bi-trash"></span></a>
                                                    <?php else : ?>
                                                        <span class="bi bi-check text-success"></span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <!-- AJOUTER UN NOUVEAU TRANSFERT -->
                        <div class="container mb-5">
                            <div class="form-card p-4" id="form-transfert">
                                <h2 class="text-primary">Formulaire d'ajout <span class="fw-bold text-danger"> (<?= $_SESSION['_USER_']['_sigle'] ?>)</span></h2>
                                <hr>
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-3">
                                                <div class="input-group">
                                                    <input class="form-control fs-4 p-3" hidden placeholder="0.00" name="_montant" type="number" id="_mt">
                                                    <input class="form-control fs-4 p-3" required type="text" id="form-montant" placeholder="Entrez le montant">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 mb-3">
                                                <div class="input-group">
                                                    <?php if ($_SESSION['_USER_']['_paysID'] == 1) : ?>
                                                        <input class="form-control fs-4 p-3" onkeyup="calcReceptionGNF()" name="_tauxTransfert" required type="text" id="form-taux" placeholder="Taux transfert ...">
                                                    <?php elseif ($_SESSION['_USER_']['_paysID'] == 2) : ?>
                                                        <input class="form-control fs-4 p-3" onkeyup="calcReceptionCAD()" name="_tauxTransfert" required type="text" id="form-taux" placeholder="Taux transfert ...">
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <div class="input-group">
                                                    <input type="text" id="reception" class="form-control fs-4 p-3" disabled placeholder="RETRAIT POSSIBLE">
                                                    <!-- <h5 id="reception"></h5> -->
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <input class="form-control fs-4 p-3" required name="_Expediteur" type="text" placeholder="Nom de l'expéditeur">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <input class="form-control fs-4 p-3" required name="_telephoneExp" type="text" placeholder="Téléphone de l'expéditeur">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <input class="form-control fs-4 p-3" required name="_Beneficiaire" type="text" placeholder="Nom du bénéficiaire">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <input class="form-control fs-4 p-3" required name="_telephoneBenef" type="text" placeholder="Téléphone du bénéficiaire">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <div class="input-group">
                                                    <input class="form-control fs-4 p-3" hidden value="<?= $_SESSION['_USER_']['_idAgence'] ?>" required name="_agenceSourceID" type="text" placeholder="Agence de départ ...">
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <select class="form-select fs-4 p-3" name="_agenceDestinationID" required>
                                                    <option selected>Agence d'envoie</option>
                                                    <?php if (!empty($TabAgence)) :
                                                        foreach ($TabAgence as $value) : ?>
                                                            <option value="<?= $value["_idAgence"] ?>"><?= $value["_reference"] ?> </option>
                                                    <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <div class="input-group">
                                                    <input class="form-control fs-4 p-3" required type="password" placeholder="Code pin">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-light-success ml-1">
                                                <i class="bi bi-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Envoyer le transfert</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- Bordered table end -->