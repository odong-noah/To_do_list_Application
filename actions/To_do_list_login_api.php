<?php
require_once '../config/dataconnect.php';

ini_set('display_errors', 0);
error_reporting(E_ALL);

//  Set Secure JSON Headers
header('Content-Type: application/json; charset=utf-8');
header("X-Content-Type-Options: nosniff");


// Secure Session Management
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_use_only_cookies' => true,
        'cookie_samesite' => 'Strict'
    ]);
}

try {
    // Force POST Method
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid Method");
    }

    // Decode JSON Input
    $jsonInput = file_get_contents('php://input');
    $loginData = json_decode($jsonInput, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Invalid Input");
    }


    $rawUsername = isset($loginData['username']) ? trim($loginData['username']) : '';
    $rawPassword = isset($loginData['password']) ? $loginData['password'] : '';

    //  Input Validation
    if (empty($rawUsername) || empty($rawPassword)) {
        echo json_encode(["success" => false, "message" => "Required fields missing."]);
        exit;
    }


    // Prepared Statement (Prevents SQL Injection)
    $getUserStmt = $conn->prepare("
        SELECT to_do_list_user_id, to_do_list_user_username, to_do_list_user_password 
        FROM to_do_list_user
        WHERE to_do_list_user_username = :username 
        LIMIT 1
    ");

    $getUserStmt->bindParam(':username', $rawUsername, PDO::PARAM_STR); 
    $getUserStmt->execute();
    $userRecord = $getUserStmt->fetch(PDO::FETCH_ASSOC);


    //  Password Verification
    if ($userRecord && password_verify($rawPassword, $userRecord['to_do_list_user_password'])) {
        

        // Regenerate ID to prevent session hijacking
        session_regenerate_id(true);

        $_SESSION['user_id'] = $userRecord['to_do_list_user_id'];
        $_SESSION['username'] = $userRecord['to_do_list_user_username'];
       
        echo json_encode([
            "success" => true, 
            "redirect" => "index.php"
        ]);
    } else {

        // Generic failure message (Prevents account discovery)
        echo json_encode([
            "success" => false, 
            "message" => "Invalid username or password."
        ]);
    }
} catch (Throwable $e) { 

    //  GENERIC ERROR HANDLING 
    error_log("Security Error: " . $e->getMessage());
    echo json_encode([
        "success" => false, 
        "message" => "System Error: JDGHHF6BDHBJAB"
    ]);
    die();
}

if (!function_exists('clean_string')) {
    function clean_string($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }
}