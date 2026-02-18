
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


<!--logic for the search task model-->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Shared Modal Elements
    const resultBody = document.getElementById('searchResultBody');
    const modalEl = document.getElementById('searchResultModal');
    
    // Search Area 1 (Original)
    const searchBtn1 = document.getElementById('searchBtn');
    const searchInput1 = document.getElementById('taskSearch');

    // Search Area 2 (New - e.g., in a Navbar or Sidebar)
    const searchBtn2 = document.getElementById('searchBtn2'); 
    const searchInput2 = document.getElementById('taskSearch2');

    if (modalEl) {
        const resultModal = new bootstrap.Modal(modalEl);

        // Core Search Function: Takes the specific input element as an argument
        const performSearch = function(inputElement) {
            if (!inputElement) return;
            
            const keyword = inputElement.value.trim();
            if (keyword === "") return;

            // 1. Immediate Feedback
            resultBody.innerHTML = '<div class="text-center py-4"><div class="spinner-border text-info"></div></div>';
            resultModal.show();

            // 2. Clear the specific input used
            inputElement.value = '';

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

        // --- LISTENERS FOR SEARCH AREA 1 ---
        if (searchBtn1 && searchInput1) {
            searchBtn1.addEventListener('click', () => performSearch(searchInput1));
            searchInput1.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') performSearch(searchInput1);
            });
        }

        // --- LISTENERS FOR SEARCH AREA 2 ---
        if (searchBtn2 && searchInput2) {
            searchBtn2.addEventListener('click', () => performSearch(searchInput2));
            searchInput2.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') performSearch(searchInput2);
            });
        }
    }
});
</script>