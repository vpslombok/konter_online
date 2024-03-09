<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
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
                                <a href="<?= base_url('user_managamen/detail/' . $user->userid); ?>" class="btn btn-info">Detail</a>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $user->userid; ?>">Edit</button>
                                <button class="btn btn-danger" onclick="confirmDelete('<?= base_url('user_managamen/delete/' . $user->userid); ?>')">Delete</button>
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
                                        <!-- Form for Edit goes here -->
                                        <!-- Example: -->
                                        <form action="<?= base_url('user_managamen/edit/' . $user->userid); ?>" method="post" id="editForm<?= $user->userid; ?>">
                                            <!-- Your form fields go here -->
                                            <label for="newUsername">New Username:</label>
                                            <input type="text" name="newUsername" id="newUsername" class="form-control" value="<?= $user->username; ?>">
                                            <label for="newEmail">New Email:</label>
                                            <input type="email" name="newEmail" id="newEmail" class="form-control" value="<?= $user->email; ?>">
                                            <label for="newPassword">New Password:</label>
                                            <input type="password" name="newPassword" id="newPassword" class="form-control">
                                            
                                            <!-- Add other fields as needed -->

                                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Edit Modal -->
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

    // SweetAlert for Edit
    <?php foreach ($users as $user) : ?>
        $('#editForm<?= $user->userid; ?>').submit(function (e) {
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
