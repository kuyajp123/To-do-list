<?= $this->extend('layouts/unauth') ?>
<?= $this->section('content') ?>
<?= view('layouts/header') ?>

<div class="text-center border text-primary">
    <h1 class="text-center">Welcome to <br>To-do list Administration System!</h1>
    <p class="text-center text-dark">Ano maganda ilagay dito?</p>
</div>

<?= view('layouts/footer') ?>
<?= $this->endSection() ?>