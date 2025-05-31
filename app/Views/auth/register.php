<?= $this->extend('layouts/unauth') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center mt-5">
  <a href="<?= site_url('/') ?>" class="text-decoration-none text-dark px-5">Home</a>
  <div class="col-md-6">
    <div class="card shadow">
      <div class="card-body">
        <h4 class="card-title d-flex justify-content-center mb-4">Create your Account</h4>

        <form action="<?= site_url('register/save') ?>" method="post" enctype="multipart/form-data">
          <?= csrf_field() ?>

          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="<?= old('name') ?>" required>
            <?php if (session('errors.name')): ?>
              <small class="text-danger"><?= esc(session('errors.name')) ?></small>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="<?= old('username') ?>" required>
            <?php if (session('errors.username')): ?>
              <small class="text-danger"><?= esc(session('errors.username')) ?></small>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" class="form-control" value="<?= old('email') ?>" required>
            <?php if (session('errors.email')): ?>
              <small class="text-danger"><?= esc(session('errors.email')) ?></small>
            <?php endif; ?>
          </div>

          <div class="mb-3 d-flex flex-row">
            <div>
              <label for="profile_image" class="form-label">Profile Image</label>
              <input type="file" name="profile_image" class="form-control" accept="image/*">
              <?php if (session('errors.profile_image')): ?>
                <small class="text-danger"><?= esc(session('errors.profile_image')) ?></small>
              <?php endif; ?>
            </div>
            <div id="imagePreview" class="ms-3">
              <img id="previewImage" src="<?= old('profile_image') ? base_url('uploads/' . old('profile_image')) : '' ?>" alt="Profile Image Preview" class="img-thumbnail d-none" style="max-width: 150px; max-height: 150px;">
            </div>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
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

          <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <p class="mt-3 text-center">
          Don't have an account? <a href="<?= site_url('login') ?>">Login</a>
        </p>
      </div>
    </div>
  </div>
</div>

<script>
  document.querySelector('input[name="profile_image"]').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('previewImage');
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        preview.src = e.target.result;
        preview.classList.remove('d-none');
      };
      reader.readAsDataURL(file);
    } else {
      preview.classList.add('d-none');
    }
  });
</script>

<?= $this->endSection() ?>