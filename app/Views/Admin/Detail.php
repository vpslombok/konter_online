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
                                        <li class="list-group-item"> 
                                        <span class="badge badge-<?= ($user->name == 'admin') ? 'success' : 'warning'; ?>"><?= $user->name; ?></span>
                                        </li>
                                        <li class="list-group-item">
                                            <small>
                                                <a href="<?= base_url('user_managamen');?>">&laquo; Back</a>
                                            </small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
            </section>