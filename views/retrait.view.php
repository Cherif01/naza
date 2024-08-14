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
            <hr>
        </div>
        <!-- Bordered table start -->
        <section class="section">
            <div class="row" id="table-bordered">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class="col text-start">
                                    <h4 class="card-title">Ajouter un retrais</h4>
                                </div>
                                <div class="col text-end">
                                    <!-- Button trigger for Disabled Backdrop -->
                                    <button type="button" class="btn btn-primary block" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#backdrop">
                                        Tracker un code de retrait
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
                                        <th>Code</th>
                                        <th>Agence de confirmation</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0;
                                    foreach ($retrait as $data) : ?>
                                        <tr>
                                            <td class="text-bold-500"><?= ++$i ?></td>
                                            <td class="text-bold-500"><?= $data['_codeRetrait'] ?></td>
                                            <td><?= $data['agence'] ?></td>
                                            <td><span class="badge bg-success"><?= $data['statut'] ?></span></td>
                                        </tr>
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
                    <form action="" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel4">Effectuer un retrait
                            </h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="formulaire w-100">
                                <div class="input-group mb-3">
                                    <input class="form-control p-3 form-control fw-bold w-100" required name="_codeRetrait" type="text" placeholder="Entrer le code svp !">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Fermer</span>
                            </button>
                            <button type="submit" class="btn btn-outline-success ml-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Tracker</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>