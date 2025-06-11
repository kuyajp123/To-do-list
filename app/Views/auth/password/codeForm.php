<?= $this->extend('layouts/unauth') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center mt-5">
    <a href="<?= site_url('/login') ?>" class="text-decoration-none text-dark px-5">Login</a>
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title d-flex justify-content-center mb-4">Enter your 6-digit code</h4>
                <p class="mb-4">We have sent a 6-digit code to <?= esc($email) ?>. Please enter it below to reset your password.</p>

                <form action="<?= site_url('password-reset/verify') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="">Code</label>
                        <div class="form-floating mb-3">
                            <input type="text" name="code" id="floatingCode" class="form-control" placeholder="Code" value="<?= old('code') ?>" required>
                            <input type="hidden" name="email" value="<?= esc($email) ?>">
                            <label for="floatingCode" class="form-label">Code</label>
                        </div>
                        <?php if (session('errors.code')): ?>
                            <small class="text-danger"><?= esc(session('errors.code')) ?></small>
                        <?php endif; ?>
                    </div>

                    <?php if (session()->has('errors')) : ?>
                        <div>
                            <ul class="mb-0">
                                <?php foreach (session('errors') as $error) : ?>
                                    <li class="text-danger d-flex justify-content-center mb-3"><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->has('error')) : ?>
                        <div class="text-danger d-flex justify-content-center mb-3">
                            <?= esc(session('error')) ?>
                        </div>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-primary w-100">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>