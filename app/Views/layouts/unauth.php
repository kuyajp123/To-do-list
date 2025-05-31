<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'To-do list') ?></title>
    <?= view('components/bootstrap/bootstrapLink') ?>
    <style>
        body {
            height: 100vh;
            width: 100%;
        }
    </style>
</head>

<body>

    <?= $this->renderSection('content') ?>

</body>

</html>