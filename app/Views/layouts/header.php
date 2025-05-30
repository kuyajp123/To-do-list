<?php $session = session(); ?>
<header class="container-fluid d-flex justify-content-end align-items-center p-3">
        <?php if ($session->get('isLoggedIn')): ?>
                <span class="me-3">Hello, <?= esc($session->get('username')) ?></span>
                <a href="<?= site_url('/profile') ?>" class="text-decoration-none text-dark">Profile</a>
                &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                <a href="<?= site_url('/logout') ?>" class="text-decoration-none text-dark">Logout</a>

        <?php else: ?>
                <a href="<?= site_url('/login') ?>" class="text-decoration-none text-dark">Login</a>
                &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                <a href="<?= site_url('/register') ?>" class="text-decoration-none text-dark">Register</a>
        <?php endif; ?>
</header>