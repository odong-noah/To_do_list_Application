<?php
require_once '../config/dataconnect.php';

if (!isset($_SESSION['user_id'])) {
    die("ERROR AUTH_SRCH_44");
}

$uid = $_SESSION['user_id'];
$search = isset($_GET['q']) ? clean_string($_GET['q']) : '';

try {
    $query = "SELECT * FROM to_do_list_task WHERE to_do_list_user_id = :uid";
    if ($search !== '') {
        $query .= " AND to_do_list_task_title LIKE :search";
    }
    $query .= " ORDER BY to_do_list_task_date ASC";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':uid', $uid);
    if ($search !== '') {
        $term = "%$search%";
        $stmt->bindParam(':search', $term);
    }
    $stmt->execute();
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($tasks)) {
        echo "<div class='text-center py-5'><i class='bi bi-clipboard-x text-muted opacity-50' style='font-size: 3rem;'></i><h6 class='text-muted mt-3'>No matches found</h6></div>";
    } else {
        foreach ($tasks as $task) {
            echo "
            <div class=\"list-group-item border-0 shadow-sm rounded-4 mb-3 p-3 bg-white text-start\">
                <div class=\"d-flex justify-content-between align-items-center\">
                    <div class=\"d-flex align-items-center\">
                        <input class=\"form-check-input me-3 border-primary\" type=\"checkbox\">
                        <span class=\"fw-bold text-dark\">" . htmlspecialchars($task['to_do_list_task_title']) . "</span>
                    </div>
                    <i class=\"bi bi-chevron-down text-muted cursor-pointer\" 
                       data-bs-toggle=\"collapse\" 
                       data-bs-target=\"#search_details_" . $task['to_do_list_task_id'] . "\"></i>
                </div>
                <div id=\"search_details_" . $task['to_do_list_task_id'] . "\" class=\"collapse mt-3 ps-4 border-start border-2 border-info\">
                    <p class=\"small text-muted mb-2\">" . htmlspecialchars($task['to_do_list_task_description']) . "</p>
                    <p class=\"badge bg-light text-primary border mb-0\">Due: " . $task['to_do_list_task_date'] . "</p>
                </div>
            </div>";
        }
    }
} catch (Exception $e) {
    die("ERROR SRCH_DB_771");
}