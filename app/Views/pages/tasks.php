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

    .content-child {
        padding: 0;
        min-height: 100%;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    .card {
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
    }

    .add-card {
        cursor: pointer;
        box-shadow: none;
        border: dotted 2px rgb(184, 184, 184);
        padding: 0;
        border-radius: 10px;
    }

    .add-card-child {
        background-color: #F8F8FF;
        cursor: pointer;
        box-shadow: none;
        border: none;
        padding: 0;
    }

    .ellipsis {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .multiline-ellipsis {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
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
            <div class="content h-100 w-100">

                <?php
                if ($tasks):
                    $taskNo = 0;
                ?>
                    <!-- if theres has task content -->
                    <div class="content-child container-fluid h-auto w-100">
                        <?php
                        foreach ($tasks as $task):
                            $taskNo++;
                        ?>
                            <div
                                class="card text-start"
                                style="max-width: 18rem; padding: 0;">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <span>Task No. <?= $taskNo ?></span>
                                    <div id="more" class="dropdown">
                                        <i class="bi bi-three-dots"
                                            role="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                        </i>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a
                                                    class="dropdown-item edit-task-btn"
                                                    role="button">
                                                    <i class="bi bi-pencil-square"></i>&nbsp; Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="bi bi-trash3-fill text-danger"></i>&nbsp; Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div
                                    class="card-body modal-body-data"
                                    data-task-id="<?= esc($task['id']) ?>"
                                    style="cursor: pointer;"
                                    onclick="openModal(event, '#todo-<?= esc($task['id']) ?>')"
                                    data-bs-toggle="modal"
                                    data-bs-target="#todo-<?= esc($task['id']) ?>">
                                    <h5 class="ellipsis card-title"><b><?= esc($task['title']) ?></b></h5>
                                    <p class="multiline-ellipsis card-text"><?= esc($task['description']) ?></p>
                                    <p class="text-center py-2 text-muted">Click to view more</p>
                                </div>
                            </div>

                            <!-- view to-do task modal -->
                            <div class="modal" id="todo-<?= esc($task['id']) ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Task No. <?= $taskNo ?></h1>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="card-title"><b><?= esc($task['title']) ?></b></h5> <br>
                                            <?php
                                            if ($task['description']) {
                                                echo "<p class='card-text'>" . esc($task['description']) . "</p> <br>";
                                            }
                                            ?>
                                            <form id="update-task-form-<?= esc($task['id']) ?>" method="post" action="<?= base_url('update-todo-task') ?>">
                                                <input type="hidden" name="task_id" value="<?= esc($task['id']) ?>">
                                                <div class="container-fluid" id="modal-body-<?= esc($task['id']) ?>">

                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" onclick="submitUpdatedTask(<?= esc($task['id']) ?>)">Save changes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <button class="add-card" style="min-height: 200px; background-color: transparent;" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                            <div class="add-card-child card" style="max-width: 18rem;">
                                <div class="card-body text-center d-flex flex-column align-items-center justify-content-center">
                                    <h6 class="card-title opacity-50">Create more tasks</h6>
                                    <i class="bi bi-plus-lg fs-1 opacity-50"></i>
                                </div>
                            </div>
                        </button>
                    </div>
                <?php else: ?>

                    <!-- if theres no task content -->
                    <div class="container-fluid h-100 w-100 p-0 d-flex flex-column justify-content-center align-items-center gap-3">
                        <div class="d-flex flex-column justify-content-center align-items-center text-center gap-3">
                            <img src="<?= base_url('assets/empty-state/no_task.svg') ?>" alt="My Icon" width="150">
                            <div class="d-flex flex-column justify-content-center align-items-center text-center text-muted">
                                <span><b>No Task Yet</b></span>
                                <span>it seems there are no task added yet</span>
                            </div>
                        </div>
                        <button class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                            <i class="bi bi-plus-lg"></i>
                            Add Task
                        </button>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
</div>
</div>

<?= view('layouts/main-content/tasks/tasksModal') ?>
<?= $this->endSection() ?>