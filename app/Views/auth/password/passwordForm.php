<?= $this->extend('layouts/unauth') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center mt-5">
  <div class="col-md-6">
    <div class="card shadow">
      <div class="card-body">
        <h4 class="card-title d-flex justify-content-center mb-4">Set New Password</h4>
        <p>Please enter your new password for <?= esc($username) ?></p>

        <form action="<?= site_url('password-reset/save-new-password') ?>" method="post">

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
            <input type="hidden" name="email" value="<?= esc($email) ?>">
            <?php if (session('errors.password')): ?>
              <small class="text-danger"><?= esc(session('errors.password')) ?></small>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Confirm password</label>
            <input type="password" name="confirm_password" class="form-control" required>
            <?php if (session('errors.confirm_password')): ?>
              <small class="text-danger"><?= esc(session('errors.confirm_password')) ?></small>
            <?php endif; ?>
          </div>

          <button type="submit" class="btn btn-primary w-100">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>