            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-lg-5">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Profile Setting</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="<?= base_url('profile_setting'); ?>" method="post" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" value="<?= $user->username; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <div class="mt-1">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="<?= $user->email; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="fullname">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $user->fullname; ?>">
                                            </div>
                                            <div class="">
                                                <label for="user_image">Foto Profile</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="user_image" name="user_image" onchange="previewImage()">
                                                    <label class="custom-file-label" for="user_image" id="fileLabel">Choose file</label>
                                                </div>
                                                <img id="imagePreview" class="mt-2" style="max-width: 30%; display: none;" alt="Preview Image">
                                            </div>

                                            <script>
                                                function previewImage() {
                                                    var input = document.getElementById('user_image');
                                                    var label = document.getElementById('fileLabel');
                                                    var preview = document.getElementById('imagePreview');
                                                    var file = input.files[0];

                                                    if (file) {
                                                        label.innerHTML = file.name;
                                                        preview.style.display = 'block';

                                                        var reader = new FileReader();
                                                        reader.onload = function(e) {
                                                            preview.src = e.target.result;
                                                        };
                                                        reader.readAsDataURL(file);
                                                    } else {
                                                        label.innerHTML = 'Choose file';
                                                        preview.style.display = 'none';
                                                        preview.src = '';
                                                    }
                                                }
                                            </script>



                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="<?= base_url('/'); ?>" class="btn btn-secondary">Back</a>
                                    </div>

                                </form>
                                <!-- Pastikan Anda telah memasukkan skrip SweetAlert sebelum menggunakan kode ini -->
                                <script>
                                    $(document).ready(function() {
                                        $('form').submit(function(e) {
                                            e.preventDefault();
                                            var form = $(this);
                                            var fullname = $('#fullname').val();
                                            var user_image = $('#user_image').val();

                                            // Validasi input
                                            if (fullname === '' || user_image === '') {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Masih Ada Data Yang Kosong',
                                                    text: 'Silakan lengkapi semua data yang diperlukan'
                                                });
                                                return;
                                            }

                                            // Mengirimkan data jika validasi berhasil
                                            $.ajax({
                                                url: form.attr('action'),
                                                type: form.attr('method'),
                                                data: new FormData(this),
                                                processData: false,
                                                contentType: false,
                                                success: function(response) {
                                                    // Jika respons adalah sukses
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'Success',
                                                        text: 'Profile Berhasil Diperbarui'
                                                    }).then(function() {
                                                        // Redirect ke halaman tertentu jika diperlukan
                                                        window.location.href = '<?= base_url('/profile_setting'); ?>';
                                                    });
                                                },
                                                error: function(xhr, status, error) {
                                                    // Jika respons adalah error
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Error',
                                                        text: 'Failed to update profile' // Atau respons yang sesuai dari server
                                                    });
                                                }
                                            });
                                        });
                                    });
                                </script>





                            </div>



                        </div><!-- /.container-fluid -->
            </section>