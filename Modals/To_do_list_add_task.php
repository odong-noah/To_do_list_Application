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
    const toastEl = document.getElementById('successToast');
    const toastMsg = document.getElementById('toastMessage');

    // Initialize Toast safely
    let toastBootstrap = null;
    if (toastEl) {
        toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastEl);
    }

    if (addTaskForm) {
        addTaskForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            addTaskError.innerHTML = ''; 

            const formData = new FormData(addTaskForm);
            const data = Object.fromEntries(formData.entries());

            try {
                // 1. Set Loading State
                addTaskSubmitBtn.disabled = true;
                addTaskSubmitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving...';

                const response = await fetch('Controllers/To_do_list_add_task_api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });

                const rawText = await response.text();
                
                try {
                    const result = JSON.parse(rawText);

                    if (result.success) {
                        // 2. Hide the Input Modal immediately
                        const modalInstance = bootstrap.Modal.getInstance(document.getElementById('addTaskModal'));
                        if (modalInstance) modalInstance.hide();

                        // 3. Show the Success Notification
                        if (toastMsg) toastMsg.innerText = result.message;
                        if (toastBootstrap) toastBootstrap.show();

                        // 4. Clear the form fields
                        addTaskForm.reset();

                        // 5. TRIGGER RELOAD: Wait 1.5 seconds so they can read the toast
                        setTimeout(() => {
                            // This explicitly reloads index.php
                            window.location.href = "index.php"; 
                        }, 1500);

                    } else {
                        // Handle server-side validation errors (e.g. missing fields)
                        addTaskSubmitBtn.disabled = false;
                        addTaskSubmitBtn.innerHTML = 'Save Task';
                        addTaskError.innerHTML = `<div class="alert alert-danger p-2 small">${result.message}</div>`;
                    }
                } catch (jsonErr) {
                    console.error("Server Error:", rawText);
                    throw new Error("Invalid Server Response");
                }

            } catch (err) {
                // Handle crashes or network failures
                addTaskSubmitBtn.disabled = false;
                addTaskSubmitBtn.innerHTML = 'Save Task';
                addTaskError.innerHTML = `<div class="alert alert-danger p-2 small">System Error: JDGHHF6BDHBJAB</div>`;
            }
        });
    }

    // Reset error messages when modal is opened for a fresh start
    document.getElementById('addTaskModal').addEventListener('show.bs.modal', () => {
        addTaskError.innerHTML = '';
        addTaskSubmitBtn.disabled = false;
        addTaskSubmitBtn.innerHTML = 'Save Task';
    });
}
</script>