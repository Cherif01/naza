<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading">
        <div class="page-title">
            <div class="d-flex align-items-center flex-wrap justify-content-between">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3 class="text-uppercase"><?= $page ?></h3>
                    <p class="text-subtitle text-muted">Bienvenue : <?= $_SESSION['_USER_']['_prenom'] ?></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first text-end">
                    <div class="me-4">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#backdrop">Nouvelle Op&#233;ration</button>
                    </div>
                </div>
            </div>
            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger p-1 fw-bold"><?= $error ?></div>
            <?php endif; ?>
            <hr>
        </div>

        <div class="container container-custom">
            <!-- Section Caisse -->
            <div class="card card-custom mb-5">
                <div class="card-header card-header-custom">
                    <h3 class="card-title-custom">Caisse</h3>
                </div>
                <div class="card-body card-body-custom">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="info-box">
                                <h5>Solde Total</h5>
                                <h2 class="<?= ($_Solde >= 0) ? 'text-success' : 'text-danger' ?>"><?= number_format($_Solde, 2, '.', ' ') ?> | <?= $_Sigle ?> </h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box">
                                <h5>Total Dépôts</h5>
                                <h2 class="text-primary"><?= number_format($Depot, 2, '.', ' ') ?> | <?= $_Sigle ?> </h2>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-box">
                                <h5>Total Retraits</h5>
                                <h2 class="text-danger"><?= number_format((-$Retrait), 2, '.', ' ') ?> | <?= $_Sigle ?> </h2>
                            </div>
                        </div>
                        <!-- ENCAISSEMENT -->
                        <div class="col-md-4">
                            <div class="info-box">
                                <h5>Encaissement</h5>
                                <h2 class="text-secondary"><?= number_format(($Encaissement), 2, '.', ' ') ?> | <?= $_Sigle ?> </h2>
                            </div>
                        </div>
                        <!-- Decaissement -->
                        <div class="col-md-4">
                            <div class="info-box">
                                <h5>Decaissment</h5>
                                <h2 class="text-warning"><?= number_format(($Decaissement), 2, '.', ' ') ?> | <?= $_Sigle ?> </h2>
                            </div>
                        </div>
                        <!-- Charges -->
                        <div class="col-md-4">
                            <div class="info-box">
                                <h5>Toutes les Charges</h5>
                                <h2 class="text-secondary"><?= number_format(($Charge), 2, '.', ' ') ?> | <?= $_Sigle ?> </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tableau des Historiques -->
            <div class="card card-custom">
                <div class="card-header card-header-custom">
                    <h3 class="card-title-custom">Historique des Transactions</h3>
                </div>
                <div class="card-body card-body-custom">
                    <div class="table-responsive">
                        <table class="table table-hover table-custom" id="maTable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type de Transaction</th>
                                    <th>Montant (GNF)</th>
                                    <th>Expéditeur</th>
                                    <th>Bénéficiaire</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($Transactions as $data) : ?>
                                    <tr>
                                        <td><?= $data['createdAt'] ?></td>
                                        <td class="<?= $data['color'] ?>"><?= $data['type'] ?></td>
                                        <td><?= $data['montant'] ?></td>
                                        <td><?= $data['expediteur'] ?> <br> <span class="text-primary"><?= number_format($data['telExp'], 0, '.', ' ') ?></span> </td>
                                        <td><?= $data['beneficiaire'] ?> <br> <span class="text-primary"><?= number_format($data['telBenef'], 0, '.', ' ') ?></span> </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!--Disabled Backdrop Modal -->
<div class="modal fade text-left" id="backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel4">Nouvelle Op&#233;ration
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="formulaire w-100">
                        <div class="form-group mb-3">
                            <!-- <label for="option">Option</label> -->
                            <select id="option" name="_idType" required class="form-select border border-primary p-3 fs-5">
                                <option selected value="">Toutes les op&#233;rations</option>
                                <?php foreach ($Operation as $data) : ?>
                                    <option value="<?= $data['idOperation'] ?>"><?= $data['libelle'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <input class="form-control border border-primary p-3 form-control fw-bold w-100 fs-5" required name="_montant" type="number" placeholder="Montant ">
                        </div>
                        <div class="input-group mb-3">
                            <input class="form-control border border-primary p-3 form-control fw-bold w-100 fs-5" required name="_sousCouvert" type="text" placeholder="Sous/Couvert">
                        </div>
                        <div class="input-group mb-3">
                            <input class="form-control border border-primary p-3 form-control fw-bold w-100 fs-5" required name="_motif" type="text" placeholder="Motif">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Fermer</span>
                    </button>
                    <button type="submit" class="btn btn-success ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Ajouter</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<style>
    body {
        background-color: #f7f8fa;
        font-family: Arial, sans-serif;
    }

    .card-custom {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: white;
        transition: transform 0.2s ease-in-out;
    }

    .card-custom:hover {
        transform: translateY(-5px);
    }

    .card-header-custom {
        background-color: #ffffff;
        border-bottom: 2px solid #eaeaea;
        border-radius: 10px 10px 0 0;
    }

    .card-title-custom {
        font-size: 1.5rem;
        color: #333333;
        font-weight: bold;
        margin-bottom: 0;
    }

    .card-body-custom {
        padding: 20px;
    }

    .info-box {
        text-align: center;
        padding: 20px;
        border-radius: 10px;
        background-color: #f1f3f5;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .info-box h5 {
        font-size: 1rem;
        color: #555555;
        margin-bottom: 10px;
    }

    .info-box h2 {
        font-size: 2rem;
        color: #333333;
    }

    .table-custom {
        margin-top: 30px;
        overflow-x: auto;
        /* Pour le défilement horizontal sur mobile */
        -webkit-overflow-scrolling: touch;
    }

    .table thead th {
        background-color: #f1f3f5;
        color: #555555;
        font-weight: bold;
    }

    .table tbody tr {
        transition: background-color 0.2s ease-in-out;
    }

    .table tbody tr:hover {
        background-color: #f1f3f5;
    }

    .container-custom {
        margin-top: 50px;
    }

    @media (max-width: 768px) {
        .card-title-custom {
            font-size: 1.2rem;
        }

        .info-box h5 {
            font-size: 0.9rem;
        }

        .info-box h2 {
            font-size: 1.5rem;
        }

        .table-custom {
            font-size: 0.875rem;
            /* Réduction de la taille de la police sur mobile */
        }
    }

    @media (max-width: 576px) {
        .card-title-custom {
            font-size: 1rem;
        }

        .info-box h5 {
            font-size: 0.8rem;
        }

        .info-box h2 {
            font-size: 1.2rem;
        }

        .table-custom {
            font-size: 0.75rem;
            /* Réduction supplémentaire de la taille de la police sur petits écrans */
        }
    }
</style>