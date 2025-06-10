<?php $session = session(); ?>
<header style="background-color: #F8F8FF;" class="header">
        <nav style="background-color: #F8F8FF;" class="navbar">
                <div class="px-4">
                        <a class="navbar-brand" href="#">
                                <img src="/assets/brand/logo.png" alt="Bootstrap" width="60" height="60">
                        </a>
                </div>
                <?php if ($session->get('isLoggedIn')):
                ?>
                        <div class="px-3">
                                <button class="btn rounded-circle">
                                        <i class="bi bi-bell-fill"></i>
                                </button>
                                <div class="btn-group dropstart">
                                        <button class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <?php $sql = "SELECT image FROM users WHERE id = ?";
                                                $db = \Config\Database::connect();
                                                $query = $db->query($sql, [$session->get('user_id')]);
                                                $user = $query->getRow();
                                                if ($user && $user->image): ?>
                                                        <img src="<?= base_url('uploads/profile_images/' . esc($user->image)) ?>" class="img-thumbnail rounded-circle" alt="Test Image" style="width: 45px; height: 45px; object-fit: cover;">
                                                <?php else: ?>
                                                        <i class="bi bi-person-circle fs-3"></i>
                                                <?php endif; ?>
                                                &nbsp;&nbsp;
                                                <?= esc($session->get('username')) ?>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-light">
                                                <li><a class="dropdown-item container" href="<?= site_url('profile') ?>">
                                                                Account
                                                                <i class="bi bi-chevron-right"></i>
                                                        </a></li>

                                                <?php
                                                $uri = service('uri');
                                                $segment = $uri->getSegment(1);
                                                if ($segment === 'dashboard' || $segment === 'tasks' || $segment === 'notes' || $segment === 'schedules'):
                                                ?>
                                                        <li><a class="dropdown-item container" href="<?= site_url('/') ?>">
                                                                        Home
                                                                        <i class="bi bi-chevron-right"></i>
                                                                </a></li>
                                                <?php else: ?>
                                                        <li><a class="dropdown-item container" href="<?= site_url('/dashboard') ?>" class="text-decoration-none text-dark px-5">
                                                                        Dashboard
                                                                        <i class="bi bi-chevron-right"></i>
                                                                </a></li>
                                                <?php endif; ?>
                                                <li><a class="dropdown-item container" href="#">
                                                                Settings
                                                                <i class="bi bi-chevron-right"></i>
                                                        </a></li>
                                                <li><a class="dropdown-item container" href="<?= site_url('/logout') ?>">
                                                                Logout
                                                                <i class="bi bi-chevron-right"></i>
                                                        </a></li>
                                        </ul>
                                </div>
                        <?php else:
                        ?>
                                <div class="px-3">
                                        <a href="<?= site_url('/login') ?>" class="text-decoration-none text-dark">Login</a>
                                        &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                                        <a href="<?= site_url('/register') ?>" class="text-decoration-none text-dark">Register</a>
                                </div>
                        <?php endif;
                        ?>
                        </div>
        </nav>
</header>