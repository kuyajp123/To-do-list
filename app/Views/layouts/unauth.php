<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $uri = service('uri');
    $title = $uri->getSegment(1);
    $title === '' ? $title = 'To-do list' : $title;
    ?>
    <title><?= esc(ucfirst($title) ?? 'To-do list') ?></title>
    <?= view('components/bootstrap/bootstrapLink') ?>
    <link rel="stylesheet" href="<?= base_url('global.css') ?>">
    <script src="<?= base_url('assets/js/jquery-3.7.1.min.js') ?>"></script>
    <?= view('components/fullcalendar/fullcalendar') ?>
</head>

<body>

    <?= $this->renderSection('content') ?>

</body>

</html>