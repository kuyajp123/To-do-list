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
        padding: 20px;
    }

    .content {
        padding: 20px;
        max-height: 70vh;
        overflow-y: scroll;
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
                <div class="table-responsive rounded h-auto w-100"
                    <?php if (!empty($activities)) : ?>
                    style="border: 2px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <?php else : ?>
                    >
                <?php endif; ?>
                
                <!-- if theres no content -->
                <?php
                if (empty($activities)) : ?>
                    <div class="container-fluid h-100 w-100 p-0 d-flex flex-column justify-content-center align-items-center gap-3">
                        <div class="d-flex flex-column justify-content-center align-items-center text-center gap-3">
                            <img src="<?= base_url('assets/empty-state/no_activities.svg') ?>" alt="My Icon" width="150">
                            <div class="d-flex flex-column justify-content-center align-items-center text-center text-muted">
                                <span><b>No Activities found</b></span>
                                <span>All activities will appear here</span>
                            </div>
                        </div>
                        <button class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                            <i class="bi bi-plus-lg"></i>
                            Add Task
                        </button>
                    </div>

                    <!-- if theres a content -->
                <?php else : ?>
                    <table class="table table-borderless rounded">
                        <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Created at</th>
                            <th></th>
                        </tr>
                        <tbody>
                            <?php
                            foreach ($activities as $activity) : ?>
                                <tr>
                                    <th scope="row">
                                        <?php if (esc($activity['type']) === 'task') : ?>
                                            <span class="badge bg-warning-subtle text-dark">Task</span>
                                        <?php else : ?>
                                            <span class="badge bg-info-subtle text-dark">Event</span>
                                        <?php endif; ?>
                                    </th>
                                    <td><?= esc($activity['title']) ?></td>
                                    <td><?= esc($activity['description'] ?? 'N/A') ?></td>
                                    <td><?= date('F j, Y', strtotime(esc($activity['created_at']))) ?></td>
                                    <td><i class="bi bi-three-dots-vertical"></i></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>