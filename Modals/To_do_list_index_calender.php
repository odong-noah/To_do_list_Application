 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- ================= CALENDAR MODAL ================= -->

<div class="modal fade" id="calendarModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">

            <!-- Modal Header -->
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-calendar-event me-2 text-primary"></i>
                    Select a Date
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body px-4">
                <label class="form-label text-muted">Choose date</label>
                <input type="date" class="form-control form-control-lg" id="calendarDate">
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer border-0 px-4">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-primary" id="confirmDate">
                    Confirm Date
                </button>
            </div>

        </div>
    </div>
</div>



<!-- logic of calender-->
 <script>
    document.getElementById('confirmDate').addEventListener('click', () => {
        const selectedDate = document.getElementById('calendarDate').value;

        if (!selectedDate) {
            alert('Please select a date');
            return;
        }
        console.log('Selected date:', selectedDate);

        // Close modal
        const modal = bootstrap.Modal.getInstance(
            document.getElementById('calendarModal')
        );
        modal.hide();
    });
</script>