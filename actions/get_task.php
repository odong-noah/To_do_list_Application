<?php
require_once 'config/dataconnect.php'; 
$userTasks = [];
 

// 2. Check if the connection exists
if (isset($conn) && isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    try {
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
    } catch (Exception $e) {
        
        die("ERROR TSK_FETCH_8829");
    }
}

// Calculate dynamic counts
$workCount = count(array_filter($userTasks, function($t) {
    return strtolower($t['to_do_list_task_category']) === 'work';
}));

$personalCount = count(array_filter($userTasks, function($t) {
    return strtolower($t['to_do_list_task_category']) === 'personal';
}));
?>