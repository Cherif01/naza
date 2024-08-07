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
                    <i title="Utilisateur" class="bi bi-person-plus text-danger rounded-circle bg-white shadow p-2"
                        style="font-size: 30px"></i>
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
                                    <h4 class="card-title">Gestion des taux</h4>
                                </div>
                                <div class="col text-end">
                                    <!-- Button trigger for Disabled Backdrop -->
                                    <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
                                        data-bs-backdrop="false" data-bs-target="#backdrop">
                                        <i class="bi bi-plus"></i>
                                        Ajouter un taux
                                    </button>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <!-- table bordered -->
                        <?php if (empty($ListeTaux)): ?>
                            <div class="alert alert-secondary text-center">La liste des taux est vide</div>
                        <?php elseif (!(empty($ListeTaux))): ?>
                            <div class="table-responsive p-4">
                                <table class="table table-hover mb-0" id="maTable">
                                    <thead>
                                        <tr>
                                            <th>N<sup>o</sup></th>
                                            <th>Taux Jour</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ListeTaux as $data): ?>
                                            <tr>
                                                <td class="text-bold-500"><?= $data['id']?></td>
                                                <td><?= $data['tauxJour'] ?></td>
                                                <td>

                                                    <button type="button" class="btn btn-outline-warning "
                                                        data-bs-toggle="modal" data-bs-backdrop="false"
                                                        data-bs-target="#backdrop-<?= $data['id'] ?>">
                                                        <i class="fa fa-edit"></i> 
                                                    </button>
                                                    <a href="<?= LINK ?>taux/delete-<?= $data['id'] ?>" class="btn btn-outline-danger "> <i class="fa fa-trash"></i> </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade text-left" id="backdrop-<?= $data['id'] ?>" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <form action="<?= LINK ?>taux/edit-<?= $data['id'] ?>" method="POST">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel4">Editer le taux
                                                                    <?= $data['id'] ?>
                                                                </h4>
                                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="formulaire w-100">
                                                                    <div class="input-group mb-3">
                                                                        <input class="form-control form-control fw-bold w-100"
                                                                            required name="tauxJour" type="text"
                                                                            value="<?= $data['tauxJour'] ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light-danger"
                                                                    data-bs-dismiss="modal">
                                                                    <!-- <i class="bx bx-x d-block d-sm-none"></i> -->
                                                                    <span class="d-none d-sm-block">Fermer</span>
                                                                </button>
                                                                <button type="submit" class="btn btn-light-success ml-1">
                                                                    <!-- <i class="bx bx-check d-block d-sm-none"></i> -->
                                                                    <span class="">Éditer</span>
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
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- Bordered table end -->
        <!--Disabled Backdrop Modal -->
        <div class="modal fade text-left" id="backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <form action="" method="POST">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel4">Enregistrer un taux
                            </h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="formulaire w-100">
                                <div class="input-group mb-3">
                                    <input class="form-control form-control fw-bold w-100" required name="tauxJour"
                                        type="text" placeholder="Entrer un taux">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Fermer</span>
                            </button>
                            <input type="submit" value="Enregistrer" class="btn btn-light-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>