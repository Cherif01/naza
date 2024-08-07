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
                                    <h4 class="card-title">Gestion des agences</h4>
                                </div>
                                <div class="col text-end">
                                    <!-- Button trigger for Disabled Backdrop -->
                                    <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#backdrop">
                                        Ajouter une agence
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
                                        <th>N<sup>o</sup></th>
                                        <th>Agence</th>
                                        <th>Gestionnaire</th>
                                        <th>Contact</th>
                                        <th>Adresse</th>
                                        <th>Pays</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($TabAgence as $agence) : ?>
                                        <tr class="text-center">
                                            <td class="text-bold-500"> <?= $agence['id'] ?> </td>
                                            <td><?= $agence['reference'] ?></td>
                                            <td class="text-bold-500"><?= $agence['representant'] ?></td>
                                            <td><?= $agence['contact'] ?></td>
                                            <td><?= $agence['adresse'] ?></td>
                                            <td><?= $agence['pays'] ?></td>
                                            <td class="">
                                                <span class="btn" onclick="deleteAlert(<?= $agence['id'] ?>, 'agence/del-')">
                                                    <i class="fas fa-trash-alt fs-4 text-danger"></i>
                                                </span>
                                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editAgenceModal-<?= $agence['id'] ?>">
                                                    <i class="fas fa-edit fs-4 text-warning"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- editModal -->

                                        <div class="modal fade text-left" id="editAgenceModal-<?= $agence['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <form action="<?=LINK?>agence/edit-<?=$agence['id']?>" method="POST">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel4">Modification de l'agence
                                                            </h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="formulaire w-100">
                                                                <div class="input-group mb-3">
                                                                    <input class="form-control form-control fw-bold w-100" required name="_reference" type="text" placeholder="Nom de l'agence" value="<?= $agence['reference'] ?>">
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <input class="form-control form-control fw-bold w-100" required name="_adresse" type="text" placeholder="Adresse de l'agence" value="<?= $agence['adresse'] ?>">
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-select fw-bold" id="" name="_idPays" required>
                                                                        <option selected>Choisir un pays...</option>
                                                                        <?php foreach ($TabPays as $pays) : ?>
                                                                            <option value="<?= $pays['id'] ?>" <?= $pays['id'] == $agence['idPays'] ? 'selected' : '' ?> > <?= $pays['pays'] ?> </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <input class="form-control form-control fw-bold w-100" required name="_contact" type="number" placeholder="Numero de contact" value="<?= $agence['contact'] ?>">
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-select fw-bold" id="" name="_idUser" required>
                                                                        <option selected>- Gestionnaire de cette agence -</option>
                                                                        <?php foreach ($TabUtilisateurs as $utilisateur) : ?>
                                                                            <option value="<?= $utilisateur['id'] ?>"  <?= $utilisateur['id'] == $agence['idUtilisateur'] ? 'selected' : '' ?> > <?= $utilisateur['nom'] . ' ' . $utilisateur['prenom'] . '-' . $utilisateur['pays'] ?> </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
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
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Bordered table end -->
        <!--Disabled Backdrop Modal -->
        <div class="modal fade text-left" id="backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <form action="" method="POST">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel4">Enregistrer une nouvelle agence
                            </h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="formulaire w-100">
                                <div class="input-group mb-3">
                                    <input class="form-control form-control fw-bold w-100" required name="_reference" type="text" placeholder="Nom de l'agence">
                                </div>
                                <div class="input-group mb-3">
                                    <input class="form-control form-control fw-bold w-100" required name="_adresse" type="text" placeholder="Adresse de l'agence">
                                </div>
                                <div class="input-group mb-3">
                                    <select class="form-select fw-bold" id="" name="_idPays" required>
                                        <option selected>Choisir un pays...</option>
                                        <?php foreach ($TabPays as $pays) : ?>
                                            <option value="<?= $pays['id'] ?>"> <?= $pays['pays'] ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <input class="form-control form-control fw-bold w-100" required name="_contact" type="number" placeholder="Numero de contact">
                                </div>
                                <div class="input-group mb-3">
                                    <select class="form-select fw-bold" id="" name="_idUser" required>
                                        <option selected>- Gestionnaire de cette agence -</option>
                                        <?php foreach ($TabUtilisateurs as $utilisateur) : ?>
                                            <option value="<?= $utilisateur['id'] ?>"> <?= $utilisateur['nom'] . ' ' . $utilisateur['prenom'] . '-' . $utilisateur['pays'] ?> </option>
                                        <?php endforeach; ?>
                                    </select>
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
                    </form>
                </div>
            </div>
        </div>
    </div>