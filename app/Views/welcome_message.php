<?= $this->extend('layouts/unauth') ?>
<?= $this->section('content') ?>
<?= view('layouts/header') ?>

<div class="text-center">
    <h1 class="text-center text-primary">Welcome to <br>To-do list Administration System!</h1>
    <p class="text-center">Ano maganda ilagay dito?</p>
</div>

<?= view('layouts/footer') ?>
<?= $this->endSection() ?>