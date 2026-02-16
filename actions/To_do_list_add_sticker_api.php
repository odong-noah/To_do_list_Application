<?php
require_once '../config/dataconnect.php'; 

header('Content-Type: application/json');
session_start();

//Auth Check
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Session expired. Please login.']);
    exit;
}

// Get JSON Body
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data || empty($data['title']) || empty($data['date'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid data provided.']);
    exit;
}

try {
    $sql = "INSERT INTO to_do_list_stickywall 
            (to_do_list_user_id, to_do_list_stickywall_date, to_do_list_stickywall_title, to_do_list_stickywall_description) 
            VALUES (:uid, :sdate, :stitle, :sdesc)";
    
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([
        ':uid'    => $_SESSION['user_id'],
        ':sdate'  => $data['date'],
        ':stitle' => $data['title'],
        ':sdesc'  => $data['description']
    ]);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save to database.']);
    }
} catch (Exception $e) {
   
    die("ERROR STK_DB_991HH");
}