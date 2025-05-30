<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'To-Do App') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5.3.6-dist/css/bootstrap.min.css') ?>">
    <script src="<?= base_url('assets/bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js') ?>"></script>
</head>

<body class="bg-light">

    <div class="container mt-5">
        <a href="<?= site_url('/') ?>" class="text-decoration-none text-dark">Home</a>
        <?= $this->renderSection('content') ?>
    </div>