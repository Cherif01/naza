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
                    <div class="me-4">
                        <i title="Utilisateur" class="bi bi-person-plus text-light rounded-circle bg-primary shadow p-2" style="font-size: 25px"></i>
                        <strong> Administrateur</strong>
                    </div>
                </div>
            </div>
            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger p-1 fw-bold"><?= $error ?></div>
            <?php endif; ?>
            <hr>
        </div>

        <div class="container">
            <div class="row">
                <!-- Informations du retrait -->
                <div class="col-lg-6 col-md-12 mb-3">
                    <div class="card bg-light-grey">
                        <div class="card-header">
                            <h5>Informations du Retrait</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="row">Montant:</th>
                                        <td><?= $Objet['_montantRetrait'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Code de Retrait:</th>
                                        <td><span id="withdrawal-code" class="text-danger text-uppercase">NASA-<?= $Objet['_codeRetrait'] ?></span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date:</th>
                                        <td>Le <?= $Objet['_createdAt'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Taux du transfert :</th>
                                        <td><?= $Objet['_tauxTransfert'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Taux du jour :</th>
                                        <td><?= $Objet['_tauxJour'] ?></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Formulaire de confirmation -->
                <div class="col-lg-6 col-md-12 mb-3">
                    <div class="card bg-light-grey">
                        <div class="card-header bg-dark-grey text-light">
                            <h5>Confirmation de Retrait</h5>
                        </div>
                        <div class="card-body">
                            <?php if ($Objet['_statutID'] == 1) : ?>
                                <form method="POST" action="">
                                    <div class="mb-3 d-flex">
                                        <div class="col me-2">
                                            <label for="confirm-code" class="form-label">Entrez votre code secret</label>
                                            <input type="password" name="pinCode" class="form-control p-3 fs-5" required id="confirm-code" placeholder="Code Secret">
                                        </div>
                                        <div class="col me-2 text-danger">
                                            <label for="confirm-number" class="form-label">Num&#233;ro du B&#233;neficiaire</label>
                                            <input type="text" name="telephone" class="form-control p-3 fs-5" required id="confirm-number" placeholder="Ex : 12345678">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm-amount" class="form-label">Montant</label>
                                        <input type="number" class="form-control p-3 fs-5" id="confirm-amount" placeholder="<?= $Objet['_montantRetrait'] ?>" readonly>
                                    </div>
                                    <button type="submit" class="btn btn-primary p-3 w-100">Confirmer</button>
                                </form>
                            <?php else : ?>
                                <div class="d-flex justify-content-center flex-wrap align-items-center">
                                    <img src="https://media.tenor.com/RHkNj7kStYkAAAAM/valid%C3%A9-validation.gif" class="w-50" alt="">
                                </div>
                                <hr>
                                <button class="btn btn-outline-secondary w-100  text-center">Transfert d&#233;j&#224; Confirmer...</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Informations de l'expéditeur -->
                <div class="col-lg-6 col-md-12 mb-3">
                    <div class="card bg-light-grey2">
                        <div class="card-header bg-dark-grey text-light">
                            <h5>Informations de l'Expéditeur</h5>
                        </div>
                        <div class="card-body">
                            <!-- <div class="img-responsive d-flex align-items-center justify-content-center">
                                <img src="<?= LINK ?>assets/logo/spa.png" class="w-25 rouded-circle" alt="">
                            </div>
                            <hr> -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="row">Nom:</th>
                                        <td><?= $Objet['_expediteur'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Téléphone:</th>
                                        <td><?= $Objet['_telExpediteur'] ?></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Informations du récepteur -->
                <div class="col-lg-6 col-md-12 mb-3">
                    <div class="card bg-light-grey2">
                        <div class="card-header bg-dark-grey text-light">
                            <h5>Informations du Récepteur</h5>
                        </div>
                        <div class="card-body">
                            <!-- <div class="img-responsive d-flex align-items-center justify-content-center">
                                <img src="<?= LINK ?>assets/logo/spa.png" class="w-25 rouded-circle" alt="">
                            </div>
                            <hr> -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="row">Nom:</th>
                                        <td><?= $Objet['_beneficiaire'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Téléphone:</th>
                                        <td class="text-primary">*** *** <?= substr($Objet['_telBeneficiaire'], -3) ?></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center align-items-center">
                <!-- Reçu de paiement -->
                <div class="col-md-4">
                    <div class="card bg-light-grey" style="height: 400px; border: 2px outset midnightblue;">
                        <div class="card-header bg-dark-grey text-light">
                            <h5>Reçu de Paiement</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="row">Montant Reçu:</th>
                                        <td><?= $Objet['_montantRetrait'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date:</th>
                                        <td><?= $Objet['_createdAt'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Référence:</th>
                                        <td>Nasa-<?= $Objet['_codeRetrait'] ?></td>
                                    </tr>
                                </thead>
                            </table>
                            <button class="btn btn-outline-secondary w-100">Télécharger le Reçu</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Couleurs personnalisées */

    .card {
        border-radius: 12px;
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        margin-bottom: 20px;
    }

    .card-header {
        font-weight: bold;
        text-align: center;
        border-radius: 12px 12px 0 0;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #757575;
    }

    .btn-primary {
        background-color: #007BFF;
        border-color: #007BFF;
        border-radius: 8px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-outline-secondary {
        border-color: #757575;
        color: #757575;
        border-radius: 8px;
    }

    .btn-outline-secondary:hover {
        background-color: #757575;
        color: #ffffff;
    }

    .bg-light-grey {
        height: 400px;
        overflow-y: scroll;
        font-size: 20px;
        font-family: 'Courier New', Courier, monospace;
    }

    .bg-light-grey2 {
        height: 240px;
        overflow-y: scroll;
        font-size: 20px;
        font-family: 'Courier New', Courier, monospace;
    }
</style>