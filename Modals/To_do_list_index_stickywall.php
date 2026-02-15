<?php
$userStickers = [];
if (isset($conn) && isset($_SESSION['user_id'])) {
    $stmt = $conn->prepare("SELECT 
        to_do_list_stickywall_title AS title, 
        to_do_list_stickywall_description AS description, 
        to_do_list_stickywall_date AS date 
        FROM to_do_list_stickywall 
        WHERE to_do_list_user_id = :uid 
        ORDER BY to_do_list_stickywall_created_at DESC");
    $stmt->execute([':uid' => $_SESSION['user_id']]);
    $userStickers = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!-- Add sticker modal -->
<div class="modal fade" id="stickyWallModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4 shadow border-0">

            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-stickies text-warning me-2"></i>Sticky Wall
                </h5>
                <div class="ms-auto me-2">
                    <button class="btn btn-warning btn-sm rounded-pill px-3 fw-bold shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#newStickerForm">
                        <i class="bi bi-plus-lg me-1"></i> Add Sticker
                    </button>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="collapse px-4 pt-3" id="newStickerForm">
                <div class="card border-warning bg-light-subtle shadow-sm rounded-3">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3 small">Create New Sticky Note</h6>
                        <form id="stickerPostForm">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <input type="text" id="stickerTitle" class="form-control form-control-sm" placeholder="Title" maxlength="255" required>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" id="stickerDesc" class="form-control form-control-sm" placeholder="Description" maxlength="255" required>
                                </div>
                                <div class="col-md-3 d-flex gap-2">
                                    <input type="date" id="stickerDate" class="form-control form-control-sm" required>
                                    <button type="submit" class="btn btn-warning btn-sm px-3 shadow-sm" id="stickerSubmitBtn">Post</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="px-4 py-3 border-bottom mb-3">
                <label class="form-label text-muted small fw-bold">Search by date</label>
                <input type="date" class="form-control form-control-sm" style="max-width: 200px;">
            </div>

            <div class="modal-body px-4 pt-0">
                <div class="row g-3" id="stickyNotesContainer">
                    <?php if (empty($userStickers)) { ?>
                        <div class="col-12 text-center py-5" id="emptyStickerState">
                            <i class="bi bi-emoji-expressionless text-muted opacity-50" style="font-size: 3rem;"></i>
                            <h5 class="text-muted mt-3">No stickers present</h5>
                            <p class="small text-muted">Click "Add Sticker" to start!</p>
                        </div>
                    <?php } else { 
                        foreach ($userStickers as $sticker) { ?>
                            <div class="col-md-4">
                                <div class="card h-100 border-0 shadow-sm rounded-4" style="background-color: #fff9c4;">
                                    <div class="card-body">
                                        <h6 class="fw-bold"><?php echo htmlspecialchars($sticker['title']); ?></h6>
                                        <p class="small mb-2 text-muted"><?php echo htmlspecialchars($sticker['description']); ?></p>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <span class="badge bg-white text-dark border-0 small shadow-sm py-1">
                                                <i class="bi bi-calendar-event me-1"></i><?php echo $sticker['date']; ?>
                                            </span>
                                            <button class="btn btn-link btn-sm text-danger p-0"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } 
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
{
    const stickerForm = document.getElementById('stickerPostForm');
    const submitBtn = document.getElementById('stickerSubmitBtn');

    // Helper function to sanitize input (Prevent XSS)
    const escapeHTML = (str) => {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    };

    if (stickerForm) {
        stickerForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const payload = {
                title: document.getElementById('stickerTitle').value.trim(),
                description: document.getElementById('stickerDesc').value.trim(),
                date: document.getElementById('stickerDate').value
            };

            try {
                submitBtn.disabled = true;
                submitBtn.innerText = '...';

                const response = await fetch('Controllers/To_do_list_add_sticker_api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                // Safety check: get raw text first
                const rawText = await response.text();
                
                try {
                    const data = JSON.parse(rawText);

                    if (data.success) {
                        const emptyState = document.getElementById('emptyStickerState');
                        if (emptyState) emptyState.remove();

                        // Create the new sticker HTML safely
                        const stickerHtml = `
                            <div class="col-md-4">
                                <div class="card h-100 border-0 shadow-sm rounded-4" style="background-color: #fff9c4; animation: fadeIn 0.5s;">
                                    <div class="card-body">
                                        <h6 class="fw-bold">${escapeHTML(payload.title)}</h6>
                                        <p class="small mb-2 text-muted">${escapeHTML(payload.description)}</p>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <span class="badge bg-white text-dark border-0 small shadow-sm py-1">
                                                <i class="bi bi-calendar-event me-1"></i>${payload.date}
                                            </span>
                                            <button class="btn btn-link btn-sm text-danger p-0"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>`;

                        document.getElementById('stickyNotesContainer').insertAdjacentHTML('afterbegin', stickerHtml);
                        
                        stickerForm.reset();
                        
                        // Close collapse
                        const collapseEl = document.getElementById('newStickerForm');
                        const bsCollapse = bootstrap.Collapse.getOrCreateInstance(collapseEl);
                        bsCollapse.hide();

                    } else {
                        alert(data.message);
                    }
                } catch (jsonErr) {
                    console.error("API Error Response:", rawText);
                    alert("System Error: JDGHHF6BDHBJAB");
                }
            } catch (err) {
                console.error("Network Error:", err);
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerText = 'Post';
            }
        });
    }
}
</script>