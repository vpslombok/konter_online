<?= $this->extend('Template/Auth'); ?>

<?= $this->section('content'); ?>


<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><?=lang('Auth.forgotPassword')?></a>
            </div>
            <div class="card-body">
                <?= view('Myth\Auth\Views\_message_block') ?>
                <p class="login-box-msg"><?=lang('Auth.enterEmailForInstructions')?></p>
                <form action="<?= url_to('forgot') ?>" method="post">
                        <?= csrf_field() ?>

                    <div class="input-group mb-3">
                    <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                                   name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block"><?=lang('Auth.sendInstructions')?></button>
                        </div>

                    </div>
                </form>
                <p class="mt-3 mb-1">
                <p><?=lang('Auth.alreadyRegistered')?> <a href="<?= url_to('login') ?>"><?=lang('Auth.signIn')?></a></p>
                </p>
            </div>

        </div>
    </div>

    <?= $this->endSection(); ?>