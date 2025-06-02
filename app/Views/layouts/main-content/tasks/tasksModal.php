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

    // view to-do task modal js
    function openModal(event, modalId) {
        const dropdown = event.target.closest('#more');
        if (dropdown) return; // If click is inside dropdown, cancel modal open

        const modal = document.querySelector(modalId);
        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();
    }

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
</script>