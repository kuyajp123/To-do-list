<div class="border">
    <span class="fs-3">
        <?php
        $currentRoute = service('router')->controllerName();
        if (strpos(strtolower($currentRoute), 'dashboard') !== false) {
            echo 'Dashboard';
        } elseif (strpos(strtolower($currentRoute), 'task') !== false) {
            echo 'Task';
        } elseif (strpos(strtolower($currentRoute), 'task') !== false) {
            echo 'Task';
        } elseif (strpos(strtolower($currentRoute), 'note') !== false) {
            echo 'Note';
        } elseif (strpos(strtolower($currentRoute), 'schedule') !== false) {
            echo 'Schedule';
        } else {
            echo 'Home';
        }
        ?>
    </span>
    <span class="">Hello, <?= session()->get('username') ?></span>
</div>

<div class="search w-100 d-flex justify-content-center align-items-center">
    <form class="w-100" action="<?= base_url('search') ?>" method="get">
        <div class="input-group">
            <input type="text" class="form-control" name="query" placeholder="Search..." aria-label="Search">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </div>
    </form>

</div>