//Element References
var registerForm = document.getElementById('registerForm');
var usernameInput = document.getElementById('username');
var emailInput = document.getElementById('email');
var passwordInput = document.getElementById('password');
var confirmPasswordInput = document.getElementById('confirmPassword');
var togglePassBtn = document.getElementById('togglePassBtn');
var toggleConfirmPassBtn = document.getElementById('toggleConfirmPassBtn');
var formMessageContainer = document.getElementById('formMessageContainer');
var eyeIcon = togglePassBtn ? togglePassBtn.querySelector('i') : null;
var confirmEyeIcon = toggleConfirmPassBtn ? toggleConfirmPassBtn.querySelector('i') : null;

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

//Show Message 
function showCardMessage(title, message, type) {
    if (!formMessageContainer) return;
    type = type || 'danger';
    var alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-' + type + ' alert-dismissible fade show shadow-sm';
    alertDiv.setAttribute('role', 'alert');

    alertDiv.innerHTML =
        '<strong>' + title + '</strong> ' + message +
        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';

    formMessageContainer.appendChild(alertDiv);

    setTimeout(function () {
        if (alertDiv && alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 5000);
}

// --- Password Toggle (combined) ---
function setupPasswordToggle(toggleBtn, inputField, eyeIcon) {
    if (!toggleBtn || !inputField || !eyeIcon) return;

    toggleBtn.addEventListener('click', function () {
        if (inputField.type === 'password') {
            inputField.type = 'text';
            eyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            inputField.type = 'password';
            eyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    });
}

// Apply to both password fields
setupPasswordToggle(togglePassBtn, passwordInput, eyeIcon);
setupPasswordToggle(toggleConfirmPassBtn, confirmPasswordInput, confirmEyeIcon);

// --- Clear form on back button ---
window.addEventListener('pageshow', function (event) {
    if (event.persisted && registerForm) {
        registerForm.reset();
    }
});


//Form Submit
registerForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const email = emailInput.value.trim();
    const password = passwordInput.value;
 
 // --- Email validation ---
if (!isValidEmail(email)) {
        showCardMessage('Failed!', 'Please enter a valid email address.');
        return;
}
   
    // Regex patterns evaluated now
    const hasLetter = /[A-Za-z]/.test(password);
    const hasNumber = /\d/.test(password);
    const hasSpecial = /[\W_]/.test(password);

    if (password.length < 8 || !hasLetter || !hasNumber || !hasSpecial) {
        showCardMessage(
            'Failed!',
            'Password must be at least 8 characters and include letters, numbers, and special characters.'
        );
        return;
    }

    if (passwordInput.value !== confirmPasswordInput.value) {
        showCardMessage('Failed!', 'Passwords do not match.');
        return;
    }

        var submitBtn = registerForm.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Processing...';
        }

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'actions/To_do_list_signup_api.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {

                if (xhr.status !== 200) {
                    showCardMessage('Failed!', 'System error. Please try again.');
                    if (submitBtn) submitBtn.disabled = false;
                    return;
                }

                try {
                    var result = JSON.parse(xhr.responseText);

                    if (result.success) {
                        showCardMessage('Success!', result.message, 'success');
                        registerForm.reset();

                        setTimeout(function () {
                            window.location.replace('index.php');
                        }, 1000);

                    } else {
                        showCardMessage('Failed!', result.message);
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.innerText = 'REGISTER ACCOUNT';
                        }
                    }

                } catch (e) {
                    showCardMessage('Failed!', 'ERROR H3J7622HNS');
                    if (submitBtn) submitBtn.disabled = false;
                }
            }
        };

        xhr.send(JSON.stringify({
            username: usernameInput.value.trim(),
            email: emailInput.value.trim(),
            password: passwordInput.value,
            confirmPassword: confirmPasswordInput.value
        }));
});
