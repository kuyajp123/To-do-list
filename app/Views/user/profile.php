<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello <?= esc(session()->get('username')) ?>!</title>
    <?= view('components/bootstrap/bootstrapLink') ?>
</head>

<body>
    <?= view('layouts/header') ?>
    <div class="container mt-5">
        <h1 class="text-center">User Profile</h1>
        <div class="card">
            <div class="card-body">
                <p class="card-text">Username: <?= esc(session()->get('username')) ?> </p>
            </div>
        </div>
    </div>
    <?= view('layouts/footer') ?>
</body>

</html>