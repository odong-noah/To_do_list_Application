<?php require_once 'config/dataconnect.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To_Do_list | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/To_do_list_login.css">
</head>




<body>
<div class="login-wrapper">
    <div class="glass-card">
    <div id="formMessageContainer"></div>
    <h3 class="fw-bold text-blue mb-2">Login</h3>
        <p class="small mb-4">Login to access your To Do List</p>

        <form id="loginForm" autocomplete="off">

            <!-- Username -->
            <div class="mb-4 text-start">
                <label for="username">Username</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-person-fill icon-user"></i>
                    </span>
                    <input 
                        type="text" 
                        id="username" 
                        class="form-control"
                        autocomplete="new-username"
                        required>
                </div>
            </div>

            <!-- Password with Eye Toggle -->
            <div class="mb-4 text-start">
                <label for="password">Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock-fill icon-lock"></i>
                    </span>
                    <input 
                        type="password" 
                        id="password" 
                        class="form-control"
                        autocomplete="new-password"
                        required>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassBtn">
                        <i class="bi bi-eye" id="eyeIcon" style="color: #facc15;" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-login w-100 py-3 text-white">
                Login
            </button>

            <div class="mt-4 small">
                
                Don’t have an account?
                <a href="To_do_list_signup.php" class="signup-link fw-bold">Create account</a>
            </div>

        </form>
     
    </div>
</div>

<script src="assets/js/To_do_list_login.js"></script>

</body>
</html>
