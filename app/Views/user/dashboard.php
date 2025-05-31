<?= $this->extend('layouts/unauth') ?>
<?= $this->section('content') ?>
<style>
    .layout {
        display: grid;
        grid-template-rows: 70px 1fr;
        height: 100vh;
    }

    .body {
        display: grid;
        grid-template-columns: 250px 1fr;
    }

    .main-content {
        display: grid;
        grid-template-rows: 20% 1fr;
        height: 100%;
    }

    .search-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20%;
        flex-direction: row;
        border: 1px solid violet;
        padding: 20px;
    }

    .content {
        border: 1px solid violet;
        padding: 20px;
    }
</style>

<div class="layout">
    <div class="header">
        <?= view('layouts/header') ?>
    </div>

    <div class="body">
        <div class="sidebar">
            <?= view('layouts/sideBar') ?>
        </div>
        <div class="main-content">
            <div class="search-header">
                <?= view('layouts/main-content/search') ?>
            </div>
            <div class="content">

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>