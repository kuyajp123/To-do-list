<!-- view to-do task modal -->
<div class="modal" id="todo-<?= esc($task['id']) ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Task No. <?= $taskNo ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitUpdatedTask(<?= esc($task['id']) ?>)">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    // view to-do task data
    $('.modal-body-data').on('click', async function() {
        const taskId = $(this).data('task-id');
        const modalBodyId = `#modal-body-${taskId}`;

        $(modalBodyId).html(`
        <div class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    `);

        try {
            const response = await fetch(`/get-todo-task/${taskId}`);
            const res = await response.json();

            if (res.task && res.task.length > 0) {
                let html = ``;

                res.task.forEach((todo, index) => {
                    const isChecked = todo.is_done == 1 ? 'checked' : '';
                    const isStriked = todo.is_done == 1 ? 'text-decoration-line-through' : '';
                    html += `
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                            id="task-${taskId}-${index}"
                            name="tasks[]"
                            value="${todo.id}" ${isChecked}>
                        <label class="form-check-label ${isStriked}" for="task-${taskId}-${index}">
                            ${todo.task_name}
                        </label>
                    </div>
                `;
                });

                localStorage.setItem(`task No. ${taskId}`, JSON.stringify(res.task));
                console.log(localStorage.getItem(`task No. ${taskId}`));
                $(modalBodyId).html(html);
            } else {
                $(modalBodyId).html('<p class="text-danger">No todo tasks found.</p>');
            }

        } catch (error) {
            $(modalBodyId).html('<p class="text-danger">Failed to fetch data.</p>');
        }
    });

    // edit task 
    let removedTasks = [];

    $(document).on('click', '.edit-task-modal', async function() {
        removedTasks = []; // reset on every open

        const taskId = $(this).data('task-id');
        const modalBodyId = `#edit-modal-task-body`;
        $('#removed_tasks').val('');

        $(modalBodyId).html(`<div class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>`);

        const response = await fetch(`/get-todo-task/${taskId}`);
        const res = await response.json();

        let html = '';
        res.task.forEach((todo) => {
            const isStriked = todo.is_done == 1 ? 'text-decoration-line-through' : '';
            html += `
            <div class="d-flex align-items-center gap-2 todo-row" data-id="${todo.id}">
                <input type="text" class="form-control ${isStriked}" name="to-do-${todo.id}" value="${todo.task_name}" required>
                <button type="button" class="btn btn-danger btn-sm remove-existing"><i class="bi bi-dash"></i></button>
            </div>`;
        });

        $(modalBodyId).html(html);
    });

    // Remove existing task
    $(document).on('click', '.remove-existing', function() {
        const row = $(this).closest('.todo-row');
        const id = row.data('id');
        removedTasks.push(id);
        $('#removed_tasks').val(removedTasks.join(','));
        row.remove();
    });

    // Add new task
    $('#add-new-task').on('click', function() {
        const newInput = `
        <div class="container-fluid w-100 p-0 d-flex align-items-center gap-2">
            <input type="text" class="form-control" name="new_to_do[]" required>
            <button type="button" class="btn btn-danger btn-sm remove-new"><i class="bi bi-dash"></i></button>
        </div>`;
        $('#new-task-container').append(newInput);
    });

    // Remove newly added task
    $(document).on('click', '.remove-new', function() {
        $(this).closest('div').remove();
    });
</script>