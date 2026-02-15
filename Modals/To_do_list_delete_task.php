
<!-- DELETE CONFIRM MODAL -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Are you sure you want to delete this task?  
                <strong>This action cannot be undone.</strong>
            </div>

            <div class="modal-footer">
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button class="btn btn-danger">
                    Yes, Delete
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    const addTaskForm = document.getElementById('addTaskForm');
    const successToast = new bootstrap.Toast(document.getElementById('successToast'));

    addTaskForm.addEventListener('submit', function (e) {
        e.preventDefault();
        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('addTaskModal'));
        modal.hide();
        // Show success toast
        successToast.show();
        // Reset form
        addTaskForm.reset();
    });
</script>