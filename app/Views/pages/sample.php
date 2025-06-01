<!-- if theres task a content -->
<!-- <div class="content-child container-fluid h-auto w-100">
                    <button class="card text-start" style="max-width: 18rem; padding: 0;">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <span>Task No. 1</span>
                            <div class="dropdown">
                                <i class="bi bi-three-dots" role="button" type="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-pencil-square"></i>&nbsp; Edit</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-trash3-fill text-danger"></i>&nbsp; Delete</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class=" card-body">
                            <h5 class="ellipsis card-title"><b>Dark card title</b></h5>
                            <p class="multiline-ellipsis card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                            <p class="text-center py-2 text-muted">Click to view more</p>
                        </div>
                    </button>

                    <button class="add-card" style="min-height: 200px; background-color: transparent;">
                        <div class="add-card-child card" style="max-width: 18rem;">
                            <div class="card-body text-center d-flex flex-column align-items-center justify-content-center">
                                <h6 class="card-title opacity-50">Create more tasks</h6>
                                <i class="bi bi-plus-lg fs-1 opacity-50"></i>
                            </div>
                        </div>
                    </button>
                </div> -->



<?php
if ($tasks):
    $taskNo = 1;
?>
    <!-- if theres has task content -->
    <div class="content-child container-fluid h-auto w-100">
        <?php
        foreach ($tasks as $task):
            $taskNo++;
        ?>
            <button class="card text-start" style="max-width: 18rem; padding: 0;">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span>Task No. <?= $taskNo ?></span>
                    <div class="dropdown">
                        <i class="bi bi-three-dots" role="button" type="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-pencil-square"></i>&nbsp; Edit</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-trash3-fill text-danger"></i>&nbsp; Delete</a></li>
                        </ul>
                    </div>
                </div>
                <div class=" card-body">
                    <h5 class="ellipsis card-title"><b><?= esc($task['title']) ?></b></h5>
                    <p class="multiline-ellipsis card-text"><?= esc($task['description']) ?></p>
                    <p class="text-center py-2 text-muted">Click to view more</p>
                </div>
            </button>
        <?php endforeach; ?>

        <button class="add-card" style="min-height: 200px; background-color: transparent;">
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