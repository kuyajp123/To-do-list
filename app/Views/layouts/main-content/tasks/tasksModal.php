<!-- add task modal -->
<div class="modal" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addTaskModalLabel">Add task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('tasks/save') ?>" method="post">
                    <div class="mb-3">
                        <label for="taskTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="taskDesc" class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>

                    <!-- Task Inputs Container -->
                    <div id="taskInputs" class="d-flex flex-column gap-2">
                        <!-- Required Task 1 -->
                        <input type="text" class="form-control" name="tasks[]" placeholder="Task 1" required>

                        <!-- Additional tasks will be added here -->
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end gap-2 mt-2">
                        <button type="button" class="btn btn-secondary" id="addTaskBtn">Add</button>
                        <button type="button" class="btn d-none" id="removeTaskBtn">Remove</button>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- SINGLE edit task modal placed outside the loop -->
<div class="modal fade" id="edit-task-modal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <form action="<?= base_url('tasks/edit') ?>" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editTaskModalLabel">Edit Task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <input type="hidden" name="task_id" id="edit-task-id">
                    <div class="mb-3">
                        <label for="taskTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="edit-task-title" required>
                    </div>
                    <div class="mb-3">
                        <label for="taskDesc" class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" id="edit-task-desc"></textarea>
                    </div>
                    <label for="taskTodo" class="form-label">Tasks</label>
                    <div class="mb-3 container-fluid w-100 p-0 d-flex flex-column gap-2 p-0" id="edit-modal-task-body">
                        <!-- dynamic tasks go here -->
                    </div>
                    <div class="d-flex flex-column container-fluid w-100 p-0 align-items-center gap-2" id="new-task-container"></div>
                    <input type="hidden" name="removed_tasks" id="removed_tasks">
                    <button type="button" id="add-new-task" class="btn mt-2 btn-secondary w-100 border-0">
                        <i class="bi bi-plus fs-5"></i> Add
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Delete task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this task?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    // add task modal js
    document.addEventListener("DOMContentLoaded", () => {
        const taskContainer = document.querySelector("#taskInputs");
        const addBtn = document.querySelector("#addTaskBtn");
        const removeBtn = document.querySelector("#removeTaskBtn");

        let taskCount = 1;

        addBtn.addEventListener("click", () => {
            taskCount++;

            const newInput = document.createElement("input");
            newInput.type = "text";
            newInput.className = "form-control";
            newInput.name = `tasks[]`;
            newInput.placeholder = `Task ${taskCount}`;
            taskContainer.appendChild(newInput);

            if (taskCount > 1) {
                removeBtn.classList.remove("d-none");
            }
        });

        removeBtn.addEventListener("click", () => {
            if (taskCount > 1) {
                taskContainer.lastElementChild.remove();
                taskCount--;
            }

            if (taskCount === 1) {
                removeBtn.classList.add("d-none");
            }
        });
    });

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

                $(modalBodyId).html(html);
            } else {
                $(modalBodyId).html('<p class="text-danger">No todo tasks found.</p>');
            }

        } catch (error) {
            $(modalBodyId).html('<p class="text-danger">Failed to fetch data.</p>');
        }
    });

    // submit updated to-do task
    function submitUpdatedTask(taskId) {
        const form = document.getElementById(`update-task-form-${taskId}`);
        const formData = new FormData(form);

        fetch('/update-todo-task', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // alert('Task updated successfully!');
                    location.reload(); // optional: refresh to show changes
                } else {
                    alert('Update failed.');
                }
            })
            .catch(error => {
                console.error('Error updating task:', error);
                alert('Something went wrong.');
            });
    }

    // edit task 
    let removedTasks = [];

    // Add new task
    $('#add-new-task').on('click', function() {
        $('#new-task-container').append(`
        <div class="container-fluid w-100 p-0 d-flex align-items-center gap-2 new-task-row">
            <input type="text" class="form-control" name="new_tasks[]" required>
            <button type="button" class="btn btn-danger btn-sm remove-new-task">
                <i class="bi bi-dash"></i>
            </button>
        </div>
    `);
    });

    // Remove new task input
    $(document).on('click', '.remove-new-task', function() {
        $(this).closest('.new-task-row').remove();
        checkIfOnlyOneLeft(); // Optional: ensure at least 1 remains
    });

    // Remove existing task input
    $(document).on('click', '.remove-existing', function() {
        const row = $(this).closest('.todo-row');
        const todoId = row.data('id');

        if ($('.todo-row').length > 1) {
            removedTasks.push(todoId); // Mark for deletion
            row.remove();
        }

        checkIfOnlyOneLeft(); // Hide remove if 1 left
    });

    // Helper: Disable remove button if only one left
    function checkIfOnlyOneLeft() {
        const totalTodos = $('.todo-row').length;
        if (totalTodos === 1) {
            $('.remove-existing').hide();
        } else {
            $('.remove-existing').show();
        }
    }

    // On modal open
    $(document).on('click', '.edit-task-modal', async function() {
        removedTasks = [];
        $('#new-task-container').html('');
        const taskId = $(this).data('task-id');
        const title = $(this).data('task-title');
        const desc = $(this).data('task-desc');

        $('#edit-task-id').val(taskId);
        $('#edit-task-title').val(title);
        $('#edit-task-desc').val(desc);
        $('#removed_tasks').val('');

        const response = await fetch(`/get-todo-task/${taskId}`);
        const res = await response.json();

        let html = '';
        res.task.forEach((todo, index) => {
            const isStriked = todo.is_done == 1 ? 'text-decoration-line-through' : '';
            const hideRemove = res.task.length === 1 ? 'd-none' : '';
            html += `
        <div class="d-flex align-items-center gap-2 todo-row" data-id="${todo.id}">
            <input type="text" class="form-control ${isStriked}" name="to-do-${todo.id}" value="${todo.task_name}" required>
            <button type="button" class="btn btn-danger btn-sm remove-existing ${hideRemove}">
                <i class="bi bi-dash"></i>
            </button>
        </div>`;
        });

        $('#edit-modal-task-body').html(html);
    });

    // On form submit
    $('form').on('submit', function() {
        $('#removed_tasks').val(removedTasks.join(','));

        // Filter out blank new inputs
        $('input[name="new_tasks[]"]').each(function() {
            if ($(this).val().trim() === '') {
                $(this).closest('.new-task-row').remove();
            }
        });
    });

    // delete task
    $('#deleteModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget); // Button that triggered the modal
        const taskId = button.data('task-id'); // Extract info from data-* attributes
        const modal = $(this);
        modal.find('.btn-danger').off('click').on('click', function() {
            $.ajax({
                url: `/tasks/delete/${taskId}`,
                type: 'POST',
                success: function(response) {
                    if (response.success) {
                        location.reload(); // Refresh page on success
                    } else {
                        alert('Failed to delete task.');
                    }
                },
                error: function() {
                    alert('Error deleting task.');
                }
            });
        });
    });
</script>