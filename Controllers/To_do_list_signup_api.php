<?php
require_once '../config/dataconnect.php';

// Prevent PHP from leaking HTML errors/warnings
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Start Buffer and Session
ob_start(); 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Secure JSON Headers
header('Content-Type: application/json; charset=utf-8');
header("X-Content-Type-Options: nosniff");

try {
    // Force POST Method
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid Method");
    }

    $inputData = json_decode(file_get_contents("php://input"), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Invalid Input Format");
    }

    // --- Extraction and Sanitization (Logic preserved without ? symbols) ---
    
    // Username logic
    $username = '';
    if (isset($inputData['username'])) {
        $username = clean_string($inputData['username']);
    }

    // Email logic
    $email = '';
    if (isset($inputData['email'])) {
        $email = trim($inputData['email']);
    }

    // Password logic
    $password = '';
    if (isset($inputData['password'])) {
        $password = $inputData['password'];
    }

    // Confirm Password logic
    $confirm = '';
    if (isset($inputData['confirmPassword'])) {
        $confirm = $inputData['confirmPassword'];
    }

    // Server-Side Validation
    if (empty($username) || empty($email) || empty($password)) {
        echo json_encode(["success" => false, "message" => "All fields are required."]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "Invalid email address."]);
        exit;
    }

    if (strlen($password) < 8) {
        echo json_encode(["success" => false, "message" => "Password must be at least 8 characters."]);
        exit;
    }

    if ($password !== $confirm) {
        echo json_encode(["success" => false, "message" => "Passwords do not match."]);
        exit;
    }

    // Check for existing User (Using Named Parameters, NO question marks)
    $checkUserStmt = $conn->prepare("
        SELECT to_do_list_user_id 
        FROM to_do_list_user 
        WHERE to_do_list_user_username = :username 
           OR to_do_list_user_email = :email 
        LIMIT 1
    ");
    $checkUserStmt->bindParam(':username', $username, PDO::PARAM_STR);
    $checkUserStmt->bindParam(':email', $email, PDO::PARAM_STR);
    $checkUserStmt->execute();

    if ($checkUserStmt->rowCount() > 0) {
        echo json_encode(["success" => false, "message" => "Username or Email already exists."]);
        exit;
    }

    // 9. Secure Password Hashing
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);

    // 10. Insert (Using Named Parameters, NO question marks)
    $insertUserStmt = $conn->prepare("
        INSERT INTO to_do_list_user 
            (to_do_list_user_username, to_do_list_user_email, to_do_list_user_password) 
        VALUES 
            (:username, :email, :password)
    ");
    
    $insertUserStmt->bindParam(':username', $username, PDO::PARAM_STR);
    $insertUserStmt->bindParam(':email', $email, PDO::PARAM_STR);
    $insertUserStmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

    if ($insertUserStmt->execute()) {
        echo json_encode([
            "success" => true, 
            "message" => "Account created successfully!"
        ]);
    } else {
        throw new Exception("Insert failed");
    }

}  catch (Throwable $e) {
    // Return error in JSON format
    echo json_encode([
        "success" => false, 
        "message" => "DEBUG: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine()
    ]);
}

/**
 * Helper function ensure it exists
 */
if (!function_exists('clean_string')) {
    function clean_string($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }
}

ob_end_flush();