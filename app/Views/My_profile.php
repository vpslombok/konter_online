            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?= base_url('/assets/img/' . $user->user_image); ?>" class="img-fluid rounded-start" alt="<?= $user->username; ?>">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <h5 class="card-title text-bold"><?= $user->username; ?></h5>
                                        </li>
                                        <?php if ($user->fullname) : ?>
                                            <li class="list-group-item"><?= $user->fullname; ?></li>
                                        <?php endif; ?>
                                        <li class="list-group-item"><?= $user->email; ?></li>
                                        <li class="list-group-item"><?= isset($user->created_at) ? $user->created_at : 'Not Available'; ?></li>
                                        <li class="list-group-item">
                                            <?php if ($user->active == 1) : ?>
                                                Aktif
                                            <?php else : ?>
                                                Belum Aktif
                                            <?php endif; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <small>
                                                <a href="<?= base_url('dashboard'); ?>">&laquo; Kembali</a>
                                            </small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
            </section>