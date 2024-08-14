<div class="d-flex vh-100 fle-wrap align-items-center">
    <div class="container">
        <div id="auth">
            <div class="row h-100">
                <div class="col-12">
                    <div id="auth-left">
                        <div class="auth-logo">
                            <!-- <a href="#"><img src="<?= LINK ?>assets/logo/spa.png" class="w-100" alt="Logo"></a> -->
                            <?php if (!empty($success)) : ?>
                                <div class="alert alert-success p-1 fw-bold"><?= $success ?></div>
                            <?php elseif (!empty($error)) : ?>
                                <div class="alert alert-danger p-1 fw-bold"><?= $error ?></div>
                            <?php endif ?>
                            <hr>
                        </div>
                        <form action="" method="POST">
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="text" class="form-control form-control-xl" name="_telephone" placeholder="Telephone">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="password" class="form-control form-control-xl" name="_motDePasse" placeholder="Mot de passe">
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Connexion</button>
                        </form>
                        <div class="text-center mt-5 text-lg fs-4">
                            <p><a class="font-bold" href="tel:+224626370138">Mot de passe oubli&#233; ?</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .container {
        max-width: 600px;
        width: 400px;
    }
</style>