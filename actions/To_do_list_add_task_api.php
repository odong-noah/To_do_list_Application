<?php
require_once '../config/dataconnect.php';

// Prevent unexpected token errors
ob_start();
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Set JSON and Security Headers
header('Content-Type: application/json; charset=utf-8');
header("X-Content-Type-Options: nosniff");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    //Authorization Gatekeeper
    if (!isset($_SESSION['user_id'])) {
        throw new Exception("Unauthorized access attempt.");
    }

    $userId = $_SESSION['user_id'];
    $jsonRaw = file_get_contents("php://input");
    $data = json_decode($jsonRaw, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Invalid JSON format.");
    }

    //Extraction and Sanitization (Logic without question mark operators)
    $title = '';
    if (isset($data['task_title'])) {
        $title = clean_string($data['task_title']);
    }

    $cat = '';
    if (isset($data['task_category'])) {
        $cat = clean_string($data['task_category']);
    }

    $desc = '';
    if (isset($data['task_description'])) {
        $desc = clean_string($data['task_description']);
    }

    $due = '';
    if (isset($data['task_due_date'])) {
        $due = $data['task_due_date'];
    }

    //Server-Side Validation
    if (empty($title) || empty($cat) || empty($due)) {
        echo json_encode(["success" => false, "message" => "Please fill in all required fields."]);
        exit;
    }

    //Secure Database Insertion (PDO Named Parameters)
    
    $stmt = $conn->prepare("
        INSERT INTO to_do_list_task 
            (to_do_list_user_id, to_do_list_task_title, to_do_list_task_category, to_do_list_task_description, to_do_list_task_date, to_do_list_task_created_at) 
        VALUES 
            (:uid, :title, :cat, :desc, :due, NOW())
    ");

    // Bind parameters strictly
    $stmt->bindParam(':uid', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':cat', $cat, PDO::PARAM_STR);
    $stmt->bindParam(':desc', $desc, PDO::PARAM_STR);
    $stmt->bindParam(':due', $due, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Task added successfully!"]);
    } else {
        throw new Exception("Database execution failed.");
    }

} catch (Throwable $e) {
    // Log the real error to the server log
    error_log("Add Task Error: " . $e->getMessage());

    // Generic Security Error Response
    echo json_encode([
        "success" => false, 
        "message" => "System Error: JDGHHF6BDHBJAB"
    ]);
}


 // Cleanup helper function
 
if (!function_exists('clean_string')) {
    function clean_string($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }
}

ob_end_flush();