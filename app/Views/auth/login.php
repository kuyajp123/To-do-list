<?= $this->extend('layouts/unauth') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center mt-5">
  <a href="<?= site_url('/') ?>" class="text-decoration-none text-dark px-5">Home</a>
  <div class="col-md-6">
    <div class="card shadow">
      <div class="card-body">
        <h4 class="card-title d-flex justify-content-center mb-4">Login to Your Account</h4>

        <form action="<?= site_url('loginUser') ?>" method="post">
          <?= csrf_field() ?>

          <div class="mb-3">
            <label for="">Username</label>
            <div class="form-floating mb-3">
              <input type="text" name="username" id="floatingUsername" class="form-control" placeholder="Username" value="<?= old('username') ?>" required>
              <label for="floatingUsername" class="form-label">@</label>
            </div>
            <?php if (session('errors.username')): ?>
              <small class="text-danger"><?= esc(session('errors.username')) ?></small>
            <?php endif; ?>
          </div>

          <label for="">Password</label>
          <div class="form-floating mb-3">
            <input type="password" name="password" id="floatingPassword" class="form-control" placeholder="Password" required>
            <label for="floatingPassword" class="form-label">Password</label>
            <a style="font-size: 0.8rem;" class="text-decoration-none opacity-75" href="<?= site_url('password-reset') ?>">Forgot your password?</a>
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

          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <p class="mt-3 text-center">
          Don't have an account? <a href="<?= site_url('register') ?>">Register</a>
        </p>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>