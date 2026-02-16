
<?php require_once 'config/dataconnect.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To_Do_list | signUp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
   
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/To_do_list_signup.css">
</head>


<body>
<div class="login-wrapper">
    <div class="glass-card">
<div id="formMessageContainer" class="position-fixed top-0 end-0 p-3" style="z-index: 1050;"></div>
        <h3 class="fw-bold text-blue mb-2">SignUp</h3>
        <p class="small mb-4">Create your account to manage your To Do List</p>

        <form id="registerForm" autocomplete="off">
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
                      
                        autocomplete="off"
                        required>
                </div>
            </div>

            <!-- Email -->
            <div class="mb-4 text-start">
                <label for="email">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-envelope-fill" style="color:#f87171;"></i>
                    </span>
                    <input 
                        type="email" 
                        id="email" 
                        class="form-control"
                    
                        autocomplete="off"
                        required>
                </div>
            </div>

            <!-- Password -->
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
                        <i class="bi bi-eye eye-icon"></i>
                    </button>
                </div>
                

            <!-- Confirm Password -->
            <div class="mt-2 text-start">
                <label for="confirmPassword">Confirm Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock-fill icon-lock"></i>
                    </span>
                    <input 
                        type="password" 
                        id="confirmPassword" 
                        class="form-control"
                       
                        autocomplete="new-password"
                        required>
                    <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassBtn">
                        <i class="bi bi-eye eye-icon"></i>
                    </button>
                </div>
            </div>

            <!-- Register Button -->
            <button type="submit" class="btn btn-login  mt-4 w-100 py-3 text-white">
                REGISTER ACCOUNT
            </button>
            <div class="mt-4 small text-center">
                Already have an account? 
                <a href="To_do_list_login.php" class="signup-link fw-bold">Login here</a>
            </div>
        </form>
    </div>
</div>


<!-- Link to external JS -->
<script src="assets/To_do_list_signup.js"></script>

</body>
</html>
