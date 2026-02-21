<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set('America/Los_Angeles');

$servername = "localhost";
$dbname     = "to_do_list";
$username   = "root"; 
$password   = "";       

try {
    $conn = new PDO(
        "mysql:host=$servername;dbname=$dbname;charset=utf8",
        $username,
        $password
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log($e->getMessage());
    die("Database connection failed. Please try again later.");
}
// Helper function
function clean_string($string_val) {
    if ($string_val === null) {
        return "";
    }
    return strip_tags(filter_var($string_val, FILTER_SANITIZE_SPECIAL_CHARS));
}
