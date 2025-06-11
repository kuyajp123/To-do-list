<?= $this->extend('layouts/unauth') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center mt-5">
    <a href="<?= site_url('/login') ?>" class="text-decoration-none text-dark px-5">Back</a>
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title d-flex justify-content-center mb-4">Reset Your Password</h4>

                <form action="<?= site_url('send-email') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="">Enter Email</label>
                        <div class="form-floating mb-3">
                            <input type="text" name="email" id="floatingEmail" class="form-control" placeholder="Email" value="<?= old('email') ?>" required>
                            <label for="floatingEmail" class="form-label">Email</label>
                        </div>
                        <?php if (session('errors.email')): ?>
                            <small class="text-danger"><?= esc(session('errors.email')) ?></small>
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

                <p class="mt-3 text-center">
                    <a class="text-decoration-none" href="<?= site_url('register') ?>">Create account</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>