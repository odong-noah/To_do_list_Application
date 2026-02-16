
<!-- LOGOUT CONFIRM MODAL-->

<div class="modal fade" id="logoutConfirmModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg">

            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold text-danger">
                    <i class="bi bi-box-arrow-right me-2"></i>Confirm Logout
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <i class="bi bi-question-circle-fill text-warning fs-1"></i>
                </div>
                <p class="fs-5 mb-1">Are you sure you want to logout?</p>
                <small class="text-muted">You will need to log in again to continue.</small>
            </div>

            <div class="modal-footer border-0 justify-content-center gap-3 pb-4">
                <button class="btn btn-outline-secondary px-4"
                        data-bs-dismiss="modal">
                    No
                </button>
                <button class="btn btn-danger px-4" id="confirmLogout">
                    Yes
                </button>
            </div>

        </div>
    </div>
</div>



<!--javascript logic for the Logout modal-->
<script>
{
    const confirmBtn = document.getElementById('confirmLogout');
    
    if (confirmBtn) {
        confirmBtn.addEventListener('click', function () {
            //Hide modal using Bootstrap instance
            const modalElement = document.getElementById('logoutConfirmModal');
            const modal = bootstrap.Modal.getInstance(modalElement);
            if (modal) { modal.hide(); }

            //Use Xmlhttprequest for actions 
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "logout.php", true);
            
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    // Fast redirect/reload once session is destroyed
                    window.location.replace("To_do_list_login.php");
                }
            };
            
            xhr.send();

           
        });
    }
}
</script>
