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

    .rowData,
    .rowData:hover {
        background-color: rgb(233, 233, 233);
        color: rgb(107, 107, 107);
        transition: background 0.2s, color 0.2s;
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
                    </div>

                    <!-- content here -->
                <?php else : ?>
                    <table class="table table-borderless table-light rounded w-100 h-100 table-hover">
                        <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Title</th>
                            <th scope="col">Created at</th>
                        </tr>
                        <tbody class="w-100 h-100">
                            <?php
                            foreach ($activities as $activity) : ?>
                                <?php if (esc($activity['type']) === 'task') : ?>
                                    <tr data-task-id="<?= esc($activity['id']) ?>"
                                        class="modal-body-data"
                                        style="cursor: pointer;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#todo-<?= esc($activity['id']) ?>">
                                    <?php else : ?>
                                    <tr data-event-id="<?= esc($activity['id']) ?>"
                                        style="cursor: pointer;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#event-<?= esc($activity['id']) ?>">
                                    <?php endif; ?>
                                    <th scope="row">
                                        <?php if (esc($activity['type']) === 'task') : ?>
                                            <span class="badge bg-warning-subtle text-dark">Task</span>
                                        <?php else : ?>
                                            <span class="badge bg-info-subtle text-dark">Event</span>
                                        <?php endif; ?>
                                    </th>
                                    <td><?= esc($activity['title']) ?></td>
                                    <td><?= date('F j, Y', strtotime(esc($activity['created_at']))) ?></td>
                                    </tr>

                                    <!-- view to-do tasks modal -->
                                    <div class="modal" id="todo-<?= esc($activity['id']) ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                        <span class="badge bg-warning-subtle text-dark">Task</span>
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5 class="card-title"><b><?= esc($activity['title']) ?></b></h5> <br>
                                                    <?php
                                                    if ($activity['description']) {
                                                        echo "<p class='card-text'>" . esc($activity['description']) . "</p> <br>";
                                                    }
                                                    ?>
                                                    <div class="container-fluid" id="modal-body-<?= esc($activity['id']) ?>">

                                                    </div>
                                                </div>
                                                <div class="modal-footer">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- view to-do event modal -->
                                    <div class="modal" id="event-<?= esc($activity['id']) ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                        <span class="badge bg-info-subtle text-dark">Event</span>
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body h-100 w-100">
                                                    <h5 class="card-title"><b><?= esc($activity['title']) ?></b></h5>
                                                    <span style="font-size:smaller;">Scheduled on <?= date('F j, Y', strtotime(esc($activity['created_at']))) ?></span>
                                                    <br>
                                                    <br>
                                                    <?php
                                                    $startDate = date('F j, Y', strtotime(esc($activity['start'])));
                                                    $endDate = date('F j, Y', strtotime(esc($activity['end'])));

                                                    $dateNow = date('F j, Y');

                                                    if ($startDate === $endDate) : ?>
                                                        <div class="container-fluid p-0 h-auto w-100 d-flex gap-4">
                                                            <div class="d-flex flex-column align-items-center gap-1">
                                                                <div class="text-primary">
                                                                    <?= date('F', strtotime(esc($activity['start']))); ?>
                                                                </div>
                                                                <div class="d-flex align-items-center justify-content-center border bg-primary text-light" style="border-radius: 100px; height: 5em; width: 2em;">
                                                                    <?= date('j', strtotime(esc($activity['start']))); ?>
                                                                </div>
                                                                <div class="h-100 border border-primary"></div>
                                                            </div>
                                                            <div class="container border rounded">
                                                                <div class="d-flex align-items-end justify-content-between">
                                                                    <p class="d-flex pt-3"><b><?= date('h:i a', strtotime(esc($activity['start']))); ?> - <?= date('h:i a', strtotime(esc($activity['end']))); ?></b></p>
                                                                    <p><?= date('Y', strtotime(esc($activity['start']))); ?></p>
                                                                </div>
                                                                <div>
                                                                    <p><?= date('l', strtotime(esc($activity['start']))); ?></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php else : ?>
                                                        <!-- start -->
                                                        <div class="container-fluid p-0 h-auto w-100 d-flex gap-4">
                                                            <div class="d-flex flex-column align-items-center gap-1">
                                                                <div class="text-primary">
                                                                    <?= date('F', strtotime(esc($activity['start']))); ?>
                                                                </div>
                                                                <div class="d-flex align-items-center justify-content-center border bg-primary text-light" style="border-radius: 100px; height: 5em; width: 2em;">
                                                                    <?= date('j', strtotime(esc($activity['start']))); ?>
                                                                </div>
                                                                <div class="h-100 border border-primary"></div>
                                                            </div>
                                                            <div class="container border rounded">
                                                                <div class="d-flex align-items-end justify-content-between">
                                                                    <p class="d-flex pt-3"><b><?= date('h:i a', strtotime(esc($activity['start']))); ?></b></p>
                                                                    <p><?= date('Y', strtotime(esc($activity['start']))); ?></p>
                                                                </div>
                                                                <div>
                                                                    <p><?= date('l', strtotime(esc($activity['start']))); ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <!-- end -->
                                                        <div class="container-fluid p-0 h-auto w-100 d-flex gap-4">
                                                            <div class="d-flex flex-column align-items-center gap-1">
                                                                <div class="text-primary">
                                                                    <?= date('F', strtotime(esc($activity['end']))); ?>
                                                                </div>
                                                                <div class="d-flex align-items-center justify-content-center border bg-primary text-light" style="border-radius: 100px; height: 5em; width: 2em;">
                                                                    <?= date('j', strtotime(esc($activity['end']))); ?>
                                                                </div>
                                                                <div class="h-100 border border-primary"></div>
                                                            </div>
                                                            <div class="container border rounded">
                                                                <div class="d-flex align-items-end justify-content-between">
                                                                    <p class="d-flex pt-3"><b><?= date('h:i a', strtotime(esc($activity['end']))); ?></b></p>
                                                                    <p><?= date('Y', strtotime(esc($activity['end']))); ?></p>
                                                                </div>
                                                                <div>
                                                                    <p><?= date('l', strtotime(esc($activity['end']))); ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/main-content/tasks/tasksModal') ?>
<?= $this->endSection() ?>