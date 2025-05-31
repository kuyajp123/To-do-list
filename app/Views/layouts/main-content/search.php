<div>
    <span class="fs-3">
        <?php
        $uri = service('uri');
        $segment = $uri->getSegment(1);
        echo ucfirst($segment ? $segment : 'Home');
        ?>
    </span>
    <span class="">Hello, <?= session()->get('username') ?></span>
</div>

<div class="search w-100 d-flex justify-content-center align-items-center">
    <form class="w-100" action="<?= base_url('search') ?>" method="get">
        <div class="input-group">
            <input type="text" class="form-control" name="query" placeholder="Search..." aria-label="Search" style="background-color: #F8F8FF;">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </div>
    </form>

</div>