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
    <form
        class="w-100"
        action="
    <?php if ($segment === 'dashboard') : ?>
        <?= base_url('dashboard') ?>
    <?php elseif ($segment === 'tasks') : ?>
        <?= base_url('tasks') ?>
    <?php endif; ?>"
        method="get">
        <div class="input-group">
            <input type="text" class="form-control" name="query"
                value="<?= esc($search ?? '') ?>"
                placeholder="Search..." aria-label="Search"
                style="background-color: #F8F8FF;">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </div>
        <?php if (isset($search) && $search): ?>
            <div class="mt-2">
                <span class="text-muted">Search results for: <strong><?= esc($search) ?></strong></span>
                &nbsp;&nbsp; <button class="btn btn-outline-secondary btn-sm" type="button"
                    onclick="window.location.href='<?= base_url($segment) ?>'">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </button>
            </div>
        <?php endif; ?>
    </form>
</div>