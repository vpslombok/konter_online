<?= $this->extend('Template/Auth'); ?>

<?= $this->section('content'); ?>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href=""><?= lang('Auth.register') ?></a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
            <?= view('Myth\Auth\Views\_message_block') ?>
                <p class="login-box-msg">Silahkan Isi Form Di Bawah Ini</p>
                <form action="<?= url_to('register') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.username') ?>" name="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.email') ?>" name="email" id="emailHelp">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off" name="pass_confirm">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.register') ?></button>
                        </div>

                    </div>
                </form>
                <div class="social-auth-links text-center">
                    <p>- atau -</p>

                </div>
                <p><?= lang('Auth.alreadyRegistered') ?> <a href="<?= url_to('login') ?>"><?= lang('Auth.signIn') ?></a></p>
            </div>

        </div>
    </div>

    <?= $this->endSection(); ?>