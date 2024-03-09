<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?php echo base_url('assets') ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo ($title)  ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php if (!empty($user->user_image)) : ?>
                    <?php $imagePath = base_url('assets/img/') . esc($user->user_image); ?>
                    <img src="<?= $imagePath ?>" class="img-circle elevation-2" alt="User Image">
                <?php else : ?>
                    <!-- Jika tidak ada gambar, Anda bisa menampilkan gambar default atau pesan lainnya -->
                    <img src="<?= base_url('assets/img/default.svg') ?>" class="img-circle elevation-2" alt="Default Image">
                <?php endif; ?>
            </div>

            <div class="info">
                <?php if (logged_in()) : ?>
                    <?php $user = user(); ?>
                    <a href="<?= base_url('profile_setting'); ?>" class="d-block"><?= esc($user->username) ?></a>

                <?php endif; ?>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <<?php if (in_groups('admin')) : ?> <li class="nav-header">Admin Menu</li>
                    <li class="nav-item">
                        <a href="<?= base_url('user_managamen'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                User Mangament
                            </p>
                        </a>
                    <?php endif; ?>

                    <li class="nav-header">User Menu</li>
                    <li class="nav-item">
                        <a href="<?= base_url('/'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('my_profile'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                My Profile
                            </p>
                        </a>
                    </li>

                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('profile_setting'); ?>" class="nav-link">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>
                                Profile Setting
                            </p>
                        </a>
                    </li>
                    <br>
                    <br>
                    <li class="nav-header">Keluar</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" id="logoutButton">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>


                    <!-- Tambahkan SweetAlert2 JS -->
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

                    <script>
                        // Tambahkan event listener untuk tombol logout
                        document.getElementById('logoutButton').addEventListener('click', function(event) {
                            event.preventDefault();

                            // Tampilkan SweetAlert2 konfirmasi
                            Swal.fire({
                                title: 'Konfirmasi Logout',
                                text: 'Apakah Anda yakin ingin logout?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya, Logout!'
                            }).then((result) => {
                                // Jika pengguna mengklik "Ya, Logout!", arahkan ke URL logout
                                if (result.isConfirmed) {
                                    window.location.href = '<?= base_url('logout'); ?>';
                                }
                            });
                        });
                    </script>

            </ul>

            <!-- /.sidebar -->
</aside>