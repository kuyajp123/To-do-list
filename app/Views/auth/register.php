<?= $this->extend('layouts/unauth') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card shadow">
      <div class="card-body">
        <h4 class="card-title mb-4">Create your Account</h4>

        <form action="<?= site_url('register/save') ?>" method="post">
          <?= csrf_field() ?>

          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <p class="mt-3 text-center">
          Don't have an account? <a href="<?= site_url('login') ?>">Login</a>
        </p>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>