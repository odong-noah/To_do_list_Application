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

// --- Password Toggle ---
if (togglePassBtn && passwordInput && eyeIcon) {
    togglePassBtn.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    });
}

if (toggleConfirmPassBtn && confirmPasswordInput && confirmEyeIcon) {
    toggleConfirmPassBtn.addEventListener('click', function () {
        if (confirmPasswordInput.type === 'password') {
            confirmPasswordInput.type = 'text';
            confirmEyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            confirmPasswordInput.type = 'password';
            confirmEyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    });
}

//Clear form on back button
window.addEventListener('pageshow', function (event) {
    if (event.persisted && registerForm) {
        registerForm.reset();
    }
});

//Form Submit
if (registerForm) {
    registerForm.addEventListener('submit', function (e) {
        e.preventDefault();

        

        if (passwordInput.value.length < 8) {
            showCardMessage('Error!', 'Password must be at least 8 characters long.');
            return;
        }

        if (passwordInput.value !== confirmPasswordInput.value) {
            showCardMessage('Error!', 'Passwords do not match.');
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
                    showCardMessage('Error!', 'System error. Please try again.');
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
                        showCardMessage('Error!', result.message);
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.innerText = 'REGISTER ACCOUNT';
                        }
                    }

                } catch (e) {
                    showCardMessage('Error!', 'ERROR H3J7622HNS');
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
}
