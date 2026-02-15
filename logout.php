<?php
session_start();
// Clear all session variables
$_SESSION = [];
// Destroy the session on the server
if (session_id() != "" || isset($_COOKIE[session_name()])) {
    session_destroy();
}
//Destroy the session cookie in the browser
if (ini_get("session.use_cookies")) {
    $p = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $p["path"],
        $p["domain"],
        $p["secure"],
        $p["httponly"]
    );
}
//Send the user back to the login page
header("Location: To_do_list_login.php");
exit();