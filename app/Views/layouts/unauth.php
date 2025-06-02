<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'To-do list') ?></title>
    <?= view('components/bootstrap/bootstrapLink') ?>
    <link rel="stylesheet" href="<?= base_url('global.css') ?>">
    <script src="<?= base_url('assets/js/jquery-3.7.1.min.js') ?>"></script>
</head>

<body>

    <?= $this->renderSection('content') ?>

</body>

</html>