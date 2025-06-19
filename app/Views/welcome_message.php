<?= $this->extend('layouts/unauth') ?>
<?= $this->section('content') ?>
<?= view('layouts/header') ?>

<style>
    .getstarted {
        border-radius: 100px;
    }

    .sentence p {
        font-size: 1rem;
    }
</style>

<div class="container-fluid row p-0 h-auto">
    <div class="col-md-8 h-100 d-flex align-items-center justify-content-center">
        <div class="conatiner p-0 ">
            <div class="text-center text-primary mt-2">
                <h1>Welcome to to-do list
                    <br>Administartion System!
                </h1>
            </div>
            <div class="text-center">
                <?php if (session()->get('isLoggedIn')): ?>
                    <a href="dashboard"><button class="getstarted btn btn-primary">Get Started</button></a>
                <?php else: ?>
                    <a href="login"><button class="getstarted btn btn-primary px-4">Login</button></a>
                    &nbsp;
                    <a href="register"><button class="getstarted btn btn-outline-secondary px-3">Sign up</button></a>
                <?php endif; ?>
            </div>
            <br>
            <div class="sentence p-5">
                <p class="lead">This is a simple to-do list application built with CodeIgniter 4. It allows users to manage their tasks efficiently.</p>
                <p class="lead">You can create, read, update, and delete tasks, and also manage user accounts.</p>
                <p class="lead">Feel free to explore the application and make the most of its features.</p>
                <p class="lead">To get started, please log in or register a new account.</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 d-flex align-items-center justify-content-center h-100 p-0">
        <div class="d-flex align-items-center justify-content-center h-100">
            <img src="<?= base_url('assets/design/greenNotes.svg') ?>" alt="" width="80%" class="img-fluid">
        </div>
        <!-- <p class="text-center">Manage your tasks efficiently</p> -->
    </div>
</div>

<?= view('layouts/footer') ?>
<?= $this->endSection() ?>