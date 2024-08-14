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
                    <h3 class="text-uppercase"><?= $page ?> des Op&#233;rations</h3>
                    <p class="text-subtitle text-muted">Bienvenue : <?= $_SESSION['_USER_']['_prenom'] ?></p>
                </div>
                <!-- <div class="col-12 col-md-6 order-md-2 order-first text-end">
                    <div class="me-4">
                        <i title="Utilisateur" class="bi bi-person-plus text-light rounded-circle bg-primary shadow p-2" style="font-size: 25px"></i>
                        <strong> Administrateur</strong>
                    </div>
                </div> -->
            </div>
            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger p-1 fw-bold"><?= $error ?></div>
            <?php endif; ?>
            <hr>
        </div>

        <div class="container container-custom">
            <form method="POST" action="">
                <div class="form-row d-flex align-items-center justify-content-between flex-wrap mb-4 p-3 shadow">
                    <div class="form-group col-12 col-md-4">
                        <div class="me-2">
                            <label for="date1">Date Début</label>
                            <input type="date" id="date1" name="date1" class="form-control p-3 fs-4 fw-bold text-primary" required>
                        </div>
                    </div>
                    <div class="form-group col-12 col-md-4">
                        <div class="me-2">
                            <label for="date2">Date Fin</label>
                            <input type="date" id="date2" name="date2" class="form-control p-3 fs-4 fw-bold text-primary">
                        </div>
                    </div>
                    <div class="form-group col-12 col-md-4">
                        <div class="me-2">
                            <label for="option">Option</label>
                            <select id="option" name="option" required class="form-control p-3 fs-4 fw-bold text-primary">
                                <option selected value="">-- Choisir une op&#233;ration --</option>
                                <?php foreach ($Operation as $data) : ?>
                                    <option value="<?= $data['idOperation'] ?>"><?= $data['libelle'] ?></option>
                                <?php endforeach; ?>
                                <option value="3">Autres Op&#233;rations</option>
                        </div>
                        </select>
                    </div>
                </div>
                <div class="form-group col-12 col-md-4">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </div>
            </form>

        </div>

        <!-- Tableau des Historiques -->
        <div class="card card-custom">
            <div class="card-header card-header-custom">
                <h3 class="card-title-custom">Rapport du <i class="text-primary small"><?= dateFR($_POST['date1']) .' au '.dateFR($_POST['date2']) ?></i></h3>
            </div>
            <div class="card-body card-body-custom">
                <div class="table-responsive">
                    <table class="table table-hover table-custom" id="maTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Type de Transaction</th>
                                <th>Montant (GNF)</th>
                                <th>Expéditeur</th>
                                <th>Bénéficiaire</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reponse as $data) : ?>
                                <tr>
                                    <td><?= $data['id'] ?></td>
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