<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-bold">User Managamen</h3>
            </div>
            <div class="table-responsive mx-auto mb-4">
                <table id="datauser" class="table table-bordered table-striped datatable">
                    <!-- buatkan button tambah user -->
                    <button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#addUser">
                        <li class="fa fa-plus"></li>
                        Tambah User
                    </button>

                    <thead>
                        <tr>
                            <th class="text-center" width="1%">No</th>
                            <th class="text-center" width="3%">Username</th>
                            <th class="text-center" width="10%">Email</th>
                            <th class="text-center" width="1%">Role</th>
                            <th class="text-center" width="1%">Status</th>
                            <th class="text-center" width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php $i = 1; ?>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $user->username ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= $user->name ?></td>
                                <td>
                                    <?php if ($user->active == 1) : ?>
                                        <span class="badge badge-success">Aktif</span>
                                    <?php else : ?>
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                    <?php endif; ?>
                                <td>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-sm-4 mb-2 mb-sm-0">
                                                <a href="<?= base_url('user_managamen/detail/' . $user->userid); ?>" class="btn btn-info btn-block">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </div>
                                            <div class="col-sm-4 mb-2 mb-sm-0">
                                                <button class="btn btn-warning btn-block" data-toggle="modal" data-target="#editModal<?= $user->userid; ?>">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                            </div>
                                            <div class="col-sm-4">
                                                <button class="btn btn-danger btn-block" onclick="confirmDelete('<?= base_url('user_managamen/delete/' . $user->userid); ?>')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </td>

                            </tr>

                            <!-- Modal for Edit -->
                            <div class="modal fade" id="editModal<?= $user->userid; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $user->userid; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel<?= $user->userid; ?>">Edit User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= base_url('user_managamen/edit/' . $user->userid); ?>" method="post" id="editForm<?= $user->userid; ?>">
                                                <!-- Your form fields go here -->
                                                <label for="newUsername">Username:</label>
                                                <input type="text" name="username" id="newUsername" class="form-control" value="<?= $user->username; ?>">
                                                <label for="newFullname">Nama Lengkap:</label>
                                                <input type="text" name="fullname" id="newFullname" class="form-control" value="<?= $user->fullname; ?>">
                                                <label for="newEmail">Email:</label>
                                                <input type="email" name="email" id="newEmail" class="form-control" value="<?= $user->email; ?>">
                                                <label for="newPassword">Password:</label>
                                                <input type="password" name="password_hash" id="newPassword" class="form-control">

                                                <label for="activ">Status:</label>
                                                <select name="active" id="active" class="form-control">
                                                    <option value="1" <?php if ($user->active == 1) echo 'selected'; ?>>Aktif</option>
                                                    <option value="0" <?php if ($user->active == 0) echo 'selected'; ?>>Tidak Aktif</option>
                                                </select>

                                                <!-- Add other fields as needed -->

                                                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Edit Modal -->
                            <!-- modal tambah user baru -->
                            <div class="modal fade bd-example-modal-lg" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addUserLabel">Tambah User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= base_url('user_managamen/add'); ?>" method="post">
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username">
                                                </div>
                                                <div class="form-group">
                                                    <label for="username">Nama Lengkap</label>
                                                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Masukkan nama lengkap">
                                                </div>
                                                <div class="form-group
                                                <label for=" email">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password_hash" placeholder="Masukkan Password">
                                                </div>
                                                <div class="form-group
                                                <label for=" active">Status</label>
                                                    <select class="form-control" id="active" name="active">
                                                        <option value="1">Aktif</option>
                                                        <option value="0">Tidak Aktif</option>
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal tambah user baru -->
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</section>

<script>
    function confirmDelete(deleteUrl) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = deleteUrl;
            }
        });
    }

    // sweet alert edit user
    <?php foreach ($users as $user) : ?>
        $('#editForm<?= $user->userid; ?>').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan menyimpan perubahan ini!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    <?php endforeach; ?>
</script>

<!-- sweet alert edit success dengan menampilkan nama user yang di edit -->

<?php if (session()->getFlashdata('pesan')) : ?>
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: "<?= session()->getFlashdata('pesan'); ?>",
            icon: 'success'
        });
    </script>
<?php endif; ?>