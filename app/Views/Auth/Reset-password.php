<?= $this->extend('Template/Auth'); ?>

<?= $this->section('content'); ?>


<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><?= lang('Auth.resetYourPassword') ?></a>
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

                <p class="login-box-msg"><?= lang('Auth.enterCodeEmailPassword') ?></p>
                <form action="<?= url_to('reset-password') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>" name="token" placeholder="<?= lang('Auth.token') ?>" value="<?= old('token', $token ?? '') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="pasword baru" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="ulang password baru" name="pass_confirm">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">

                            </div>
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">proses</button>
                        </div>

                    </div>
                </form>
                <div class="social-auth-links text-center">
                </div>
                <a href="<?= url_to('login') ?>" class="text-center">Kembali Ke Halaman Login</a>
            </div>

        </div>
    </div>
    <?= $this->endSection(); ?>