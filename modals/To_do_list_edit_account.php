<!--  EDIT ACCOUNT MODAL (The Input Form) -->
<div class="modal fade" id="editAccountModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-person-gear me-2 text-primary"></i>Edit Account Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <form id="editAccountForm" autocomplete="off" method="POST">
                <div class="modal-body pt-3">
                    <!-- ERROR CONTAINER -->
                    <div id="editAccountError" class="mb-3"></div>

                    <!-- Username -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">New Username</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-primary border-end-0"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control border-start-0" name="new_username" placeholder="Leave blank to keep current username">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">New Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-success border-end-0"><i class="bi bi-envelope-fill"></i></span>
                            <input type="email" class="form-control border-start-0" name="new_email">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">New Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-warning border-end-0"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" class="form-control border-start-0" name="new_password" autocomplete="new-password">
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Confirm New Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-danger border-end-0"><i class="bi bi-shield-lock-fill"></i></span>
                            <input type="password" class="form-control border-start-0" name="confirm_password" autocomplete="new-password">
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-toggle="modal" data-bs-target="#cancelEditModal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--  SUCCESS FEEDBACK MODAL (Displays in Center) -->
<div class="modal fade" id="updateSuccessModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content rounded-4 border-0 shadow-lg text-center p-4">
            <div class="modal-body">
                <div class="mb-3">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                </div>
                <h4 class="fw-bold">Success!</h4>
                <p class="text-muted" id="successMsgText">Account updated successfully.</p>
                <button type="button" class="btn btn-success w-100 rounded-3 mt-2" id="successFinalBtn">
                    Okay!
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Javascript logic for the Edit account API-->

<script>
{
    const editForm = document.getElementById('editAccountForm');
    const errorDiv = document.getElementById('editAccountError');
    const successModalEl = document.getElementById('updateSuccessModal');
    const successText = document.getElementById('successMsgText');

    
    const showError = (msg) => {
        errorDiv.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show p-2 small" role="alert">
                <i class="bi bi-exclamation-circle me-1"></i> ${msg}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
    };

    if (editForm) {
        editForm.addEventListener('submit', (e) => {
            e.preventDefault();
            errorDiv.innerHTML = ''; 

            const btn = editForm.querySelector('button[type="submit"]');
            const formData = new FormData(editForm);
            const data = JSON.stringify(Object.fromEntries(formData.entries()));

            // Simple Client Validations
            const payload = Object.fromEntries(formData.entries());
            if (payload.new_password && payload.new_password.length < 8) {
                return showError("Password must be 8+ characters.");
            }
            if (payload.new_password !== payload.confirm_password) {
                return showError("Passwords do not match.");
            }

            //Loading state
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving...';

            // Use Xmlhttprequests 
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "actions/To_do_list_edit_account_api.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    btn.disabled = false;
                    btn.innerHTML = 'Save Changes';

                    if (xhr.status === 200) {
                        try {
                            const result = JSON.parse(xhr.responseText);
                            if (result.success) {
                                //Hide modal and trigger refresh/reload
                                bootstrap.Modal.getInstance(document.getElementById('editAccountModal')).hide();
                                successText.innerText = result.message;
                                const sModal = new bootstrap.Modal(successModalEl);
                                sModal.show();
                            } else {
                                showError(result.message);
                            }
                        } catch (e) {
                            showError("System Error: JDGHHF6BDHBJAB");
                        }
                    } else {
                        showError("System Error: JDGHHF6BDHBJAB");
                    }
                }
            };

            xhr.send(data);
        });
    }

    //Rapid page reload logic
    const refreshPage = () => { window.location.reload(); };
    document.getElementById('successFinalBtn').addEventListener('click', refreshPage);
    successModalEl.addEventListener('hidden.bs.modal', refreshPage);

    document.getElementById('editAccountModal').addEventListener('show.bs.modal', () => {
        if (editForm) editForm.reset();
        errorDiv.innerHTML = '';
    });
}
</script>