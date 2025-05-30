<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome to To-do list</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <?= view('components/bootstrap/bootstrapLink') ?>
    <!-- STYLES -->
</head>

<body>

    <?= view('layouts/header') ?>

    <div class="text-center border h-100 text-primary">
        <h1 class="text-center">Welcome to <br>To-do list Administration System!</h1>
        <p class="text-center text-dark">Ano maganda ilagay dito?</p>
    </div>

    <?= view('layouts/footer') ?>
</body>

</html>