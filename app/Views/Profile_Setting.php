<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <form action="<?= base_url('profile/update_image') ?>" method="post" enctype="multipart/form-data">
                            <div class="text-center">
                            
                                <?php if (!empty($user->user_image)): ?>
                                    <?php $imagePath = base_url('assets/img/') . esc($user->user_image); ?>
                                    <img src="<?= $imagePath ?>" class="profile-user-img img-fluid img-circle" alt="User Image">
                                <?php else: ?>
                                    <!-- Jika tidak ada gambar, Anda bisa menampilkan gambar default atau pesan lainnya -->
                                    <img src="<?= base_url('assets/img/default.svg') ?>" class="profile-user-img img-fluid img-circle" alt="Default Image">
                                <?php endif; ?>
                                <br>
                                <input type="file" name="user_image" accept="image/*">
                                <br>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                            <?php if (!empty($user)): ?>
                        </form>
                        <!-- Display user information after the form -->
                        <h3 class="profile-username text-center"><?= ($user->username) ?></h3>
                        <p class="text-muted text-center"><?= ($user->email) ?></p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="float-right">543</a>
                            </li>
                            <!-- Add more user information as needed -->
                        </ul>
                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                    </div>
                    <?php endif ?>
                    <!-- /.card-body -->
                </div>
            </div><!-- /.col-md-3 -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
