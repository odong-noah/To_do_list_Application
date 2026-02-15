<?php
/**
 * Controllers/To_do_list_get_tasks_api.php
 */

// 1. Initialize the array immediately
$userTasks = []; 

// 2. Check if the connection exists
if (isset($conn) && isset($_SESSION['user_id'])) {
    
    $userId = $_SESSION['user_id'];

    try {
        // We use the exact names from your screenshot
        $stmt = $conn->prepare("
            SELECT 
                to_do_list_task_id, 
                to_do_list_task_title, 
                to_do_list_task_category, 
                to_do_list_task_description, 
                to_do_list_task_date
            FROM to_do_list_task 
            WHERE to_do_list_user_id = :uid 
            ORDER BY to_do_list_task_date ASC
        ");

        $stmt->bindParam(':uid', $userId, PDO::PARAM_INT);
        $stmt->execute();
        
        $userTasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        // If this prints, the table name 'to_do_list_task' is wrong in your DB
        error_log("Database Error: " . $e->getMessage());
    }
}