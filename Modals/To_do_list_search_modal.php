
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!--Search result modal-->
<div class="modal fade" id="searchResultModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-info"><i class="bi bi-search me-2"></i>Search Result</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="searchResultBody">
                </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--Search result Logic-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const searchBtn = document.getElementById('searchBtn');
    const searchInput = document.getElementById('taskSearch');
    const resultBody = document.getElementById('searchResultBody');
    const modalEl = document.getElementById('searchResultModal');

    if (searchBtn && modalEl) {
        const resultModal = new bootstrap.Modal(modalEl);

        const performSearch = function() {
            const keyword = searchInput.value.trim();
            if (keyword === "") return;

            // 1. Immediate Feedback
            resultBody.innerHTML = '<div class="text-center py-4"><div class="spinner-border text-info"></div></div>';
            resultModal.show();

            // 2. Clear the input immediately for new content (House Standard)
            searchInput.value = '';

            // 3. High-performance Network Request
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "actions/To_do_list_search_api.php?q=" + encodeURIComponent(keyword), true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        resultBody.innerHTML = xhr.responseText;
                    } else {
                        resultBody.innerHTML = '<div class="alert alert-danger small m-3">ERROR SRCH_99X</div>';
                    }
                }
            };
            xhr.send();
        };

        // Trigger on Button Click
        searchBtn.addEventListener('click', performSearch);

        // Trigger on Enter Key (Professional UX Upgrade)
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
    }
});
</script>