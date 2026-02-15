<?php
require_once '../config/dataconnect.php';
// Start buffering to prevent whitespace leaks
ob_start();


ini_set('display_errors', 0); 
error_reporting(E_ALL);

// Set JSON Headers
header('Content-Type: application/json; charset=utf-8');
header("X-Content-Type-Options: nosniff");

// Start Secure Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    //Auth Check: Ensure user is logged in
    if (!isset($_SESSION['user_id'])) {
        throw new Exception("Unauthorized");
    }

    // Request Method Check
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid Method");
    }

    $inputData = json_decode(file_get_contents("php://input"), true);
    if (!$inputData) {
        throw new Exception("Invalid Data");
    }

    $userId = $_SESSION['user_id'];
    
    //Variable Extraction (Avoiding question mark operators)
    $newUsername = '';
    if (isset($inputData['new_username'])) {
        $newUsername = clean_string($inputData['new_username']);
    }

    $newEmail = '';
    if (isset($inputData['new_email'])) {
        $newEmail = trim($inputData['new_email']);
    }

    $newPassword = '';
    if (isset($inputData['new_password'])) {
        $newPassword = $inputData['new_password'];
    }

    $confirmPass = '';
    if (isset($inputData['confirm_password'])) {
        $confirmPass = $inputData['confirm_password'];
    }

    //Basic Validation
    if (empty($newUsername) && empty($newEmail) && empty($newPassword)) {
        echo json_encode(["success" => false, "message" => "No changes were provided."]);
        exit;
    }

    // Dynamic Query Building
    $params = [':id' => $userId];
    $sets = [];

    if (!empty($newUsername)) {
        $sets[] = "to_do_list_user_username = :u";
        $params[':u'] = $newUsername;
    }

    if (!empty($newEmail)) {
        if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["success" => false, "message" => "Invalid email format."]);
            exit;
        }
        $sets[] = "to_do_list_user_email = :e";
        $params[':e'] = $newEmail;
    }

    if (!empty($newPassword)) {
        if (strlen($newPassword) < 8) {
            echo json_encode(["success" => false, "message" => "Password must be at least 8 characters."]);
            exit;
        }
        if ($newPassword !== $confirmPass) {
            echo json_encode(["success" => false, "message" => "Passwords do not match."]);
            exit;
        }
        $sets[] = "to_do_list_user_password = :p";
        $params[':p'] = password_hash($newPassword, PASSWORD_BCRYPT, ["cost" => 12]);
    }

    // Finalize SQL String
    $query = "UPDATE to_do_list_user SET " . implode(', ', $sets) . " WHERE to_do_list_user_id = :id";
    
    $updateStmt = $conn->prepare($query);
    
    if ($updateStmt->execute($params)) {
        // Update session username so the Welcome message updates instantly
        if (!empty($newUsername)) { 
            $_SESSION['username'] = $newUsername; 
        }
        
        echo json_encode([
            "success" => true, 
            "message" => "Account updated successfully!"
        ]);
    } else {
        throw new Exception("Update failed");
    }

} catch (Throwable $e) {
    // Log real error to server logs
    error_log("Edit Account Error: " . $e->getMessage());

    // Send generic security error to user (JDGHHF6BDHBJAB)
    echo json_encode([
        "success" => false, 
        "message" => "System Error: JDGHHF6BDHBJAB"
    ]);
}

//Cleanup function
 
if (!function_exists('clean_string')) {
    function clean_string($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }
}

ob_end_flush();