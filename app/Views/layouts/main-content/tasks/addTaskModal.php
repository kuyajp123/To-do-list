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
    // taskHandler.js
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
</script>