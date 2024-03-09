<?= $this->extend('Template/Auth'); ?>

<?= $this->section('content'); ?>



<body class="hold-transition login-page">
    <div class="login-box">

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>Login Aplikasi</a>
            </div>
            <div class="card-body">
                <!-- Tampilkan SweetAlert2 untuk pesan sukses atau error -->
                <?php if (session()->getFlashdata('success')) : ?>
                    <script>
                        Swal.fire({
                            title: 'Sukses',
                            text: '<?= session()->getFlashdata('success') ?>',
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        });
                    </script>
                <?php elseif (session()->getFlashdata('error')) : ?>
                    <script>
                        Swal.fire({
                            title: 'Error',
                            text: '<?= session()->getFlashdata('error') ?>',
                            icon: 'error',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        });
                    </script>
                <?php endif; ?>

                <p class="login-box-msg">Selamat datang</p>
                <form action="<?= url_to('login') ?>" method="post">
                    <?= csrf_field() ?>

                    <?php if ($config->validFields === ['email']) : ?>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                    <?php else : ?>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <?php if ($config->allowRemembering) : ?>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                    <label for="remember">
                                        <?= lang('Auth.rememberMe') ?>
                                    </label>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" id="loginButton"><?= lang('Auth.loginAction') ?></button>
                        </div>
                    </div>
                </form>

                <?php if ($config->allowRegistration) : ?>
                    <p class="mb-1">
                        <a href="<?= url_to('register') ?>"><?= lang('Auth.needAnAccount') ?></a>
                    </p>
                <?php endif; ?>

                <?php if ($config->activeResetter) : ?>
                    <p class="mb-0">
                        <a href="<?= url_to('forgot') ?>" class="text-center"><?= lang('Auth.forgotYourPassword') ?></a>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Tambahkan script SweetAlert2 untuk menampilkan pesan sukses -->


</body>
    <?= $this->endSection(); ?>
