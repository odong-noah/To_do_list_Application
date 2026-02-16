<!--  ADD TASK MODAL -->
<div class="modal fade" id="addTaskModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-plus-circle me-2 text-primary"></i>New Task
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addTaskForm" autocomplete="off">
                <div class="modal-body">
                    <!-- Error Container -->
                    <div id="addTaskError" class="mb-3"></div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Task Title (Max 255)</label>
                        <input type="text" name="task_title" class="form-control" maxlength="255" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Category</label>
                        <select name="task_category" class="form-select" required>
                            <option value="">Select category</option>
                            <option value="Work">Work</option>
                            <option value="Personal">Personal</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Description (Max 255)</label>
                        <textarea name="task_description" class="form-control" rows="3" maxlength="255" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Due Date</label>
                        <input type="date" name="task_due_date" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4" id="addTaskSubmitBtn">Save Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SUCCESS TOAST -->
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1060;">
    <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="bi bi-check-circle-fill me-2"></i>
                <span id="toastMessage">Task saved successfully</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>



<script>
{
    const addTaskForm = document.getElementById('addTaskForm');
    const addTaskError = document.getElementById('addTaskError');
    const addTaskSubmitBtn = document.getElementById('addTaskSubmitBtn');

    if (addTaskForm) {
        addTaskForm.addEventListener('submit', (e) => {
            e.preventDefault();
            addTaskError.innerHTML = ''; 

            // Loading state
            addTaskSubmitBtn.disabled = true;
            addTaskSubmitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving...';

            const formData = new FormData(addTaskForm);
            const data = JSON.stringify(Object.fromEntries(formData.entries()));

            // Use Xmlhttprequests 
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "actions/To_do_list_add_task_api.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        try {
                            const result = JSON.parse(xhr.responseText);

                            if (result.success) {
                                // High performance response/reload
                                window.location.href = "index.php"; 
                            } else {
                                addTaskSubmitBtn.disabled = false;
                                addTaskSubmitBtn.innerHTML = 'Save Task';
                                addTaskError.innerHTML = `<div class="alert alert-danger p-2 small">${result.message}</div>`;
                            }
                        } catch (e) {
                            //Traceable Error String
                            addTaskError.innerHTML = `<div class="alert alert-danger p-2 small">System Error: JDGHHF6BDHBJAB</div>`;
                        }
                    } else {
                        addTaskSubmitBtn.disabled = false;
                        addTaskSubmitBtn.innerHTML = 'Save Task';
                        addTaskError.innerHTML = `<div class="alert alert-danger p-2 small">System Error: JDGHHF6BDHBJAB</div>`;
                    }
                }
            };

            xhr.send(data);
        });
    }
}
</script>