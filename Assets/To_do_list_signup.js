
// Element References with Safety Checks
const registerForm = document.getElementById('registerForm');
const usernameInput = document.getElementById('username');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirmPassword');
const togglePassBtn = document.getElementById('togglePassBtn');
const toggleConfirmPassBtn = document.getElementById('toggleConfirmPassBtn');
const formMessageContainer = document.getElementById('formMessageContainer');

// Only try to find icons if the buttons exist
const eyeIcon = togglePassBtn ? togglePassBtn.querySelector('i') : null;
const confirmEyeIcon = toggleConfirmPassBtn ? toggleConfirmPassBtn.querySelector('i') : null;

//Function to show Bootstrap alert card 
function showCardMessage(title, message, type = 'danger') {
    if (!formMessageContainer) return;

    const alertDiv = document.createElement('div');
    alertDiv.classList.add('alert', `alert-${type}`, 'alert-dismissible', 'fade', 'show', 'shadow-sm');
    alertDiv.setAttribute('role', 'alert');

    alertDiv.innerHTML = `
        <strong>${title}</strong> ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

    formMessageContainer.appendChild(alertDiv);

    // Auto-dismiss after 5 seconds
    setTimeout(() => {
        if (alertDiv && alertDiv.parentNode) {
            alertDiv.classList.remove('show');
            alertDiv.classList.add('hide');
            // Wait for Bootstrap transition before removing
            setTimeout(() => alertDiv.remove(), 500);
        }
    }, 5000);
}

//Password eye toggle logic (with null checks)
if (togglePassBtn && passwordInput && eyeIcon) {
    togglePassBtn.addEventListener('click', () => {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        eyeIcon.classList.replace(isPassword ? 'bi-eye' : 'bi-eye-slash', isPassword ? 'bi-eye-slash' : 'bi-eye');
    });
}

if (toggleConfirmPassBtn && confirmPasswordInput && confirmEyeIcon) {
    toggleConfirmPassBtn.addEventListener('click', () => {
        const isPassword = confirmPasswordInput.type === 'password';
        confirmPasswordInput.type = isPassword ? 'text' : 'password';
        confirmEyeIcon.classList.replace(isPassword ? 'bi-eye' : 'bi-eye-slash', isPassword ? 'bi-eye-slash' : 'bi-eye');
    });
}

// --- 4. Back Arrow Protection: Clear form on page show ---
window.addEventListener('pageshow', (event) => {
    if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
        if (registerForm) registerForm.reset();
    }
});

// --- 5. Form submission ---
if (registerForm) {
    registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const submitBtn = registerForm.querySelector('button[type="submit"]');

        // --- Frontend validation ---
        if (passwordInput.value.length < 8) {
            showCardMessage('Error!', 'Password must be at least 8 characters long.', 'danger');
            passwordInput.focus();
            return;
        }

        if (passwordInput.value !== confirmPasswordInput.value) {
            showCardMessage('Error!', 'Passwords do not match!', 'danger');
            confirmPasswordInput.focus();
            return;
        }

        // Prevent Double Submission 
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';
        }

        const formData = {
            username: usernameInput.value.trim(),
            email: emailInput.value.trim(),
            password: passwordInput.value,
            confirmPassword: confirmPasswordInput.value,
        };

        try {
            const response = await fetch('Controllers/To_do_list_signup_api.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(formData)
            });

            // Get raw text first to handle hidden PHP errors
            const rawText = await response.text();
            
            try {
                const result = JSON.parse(rawText);

                if (result.success) {
                    showCardMessage('Success!', result.message, 'success');
                    registerForm.reset();
                    // Small delay before redirecting
                    setTimeout(() => window.location.replace('index.php'), 1000);
                } else {
                    showCardMessage('Error!', result.message, 'danger');
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerText = 'REGISTER ACCOUNT';
                    }
                }
            } catch (jsonErr) {
                console.error("Server sent non-JSON response:", rawText);
                showCardMessage('Error!', 'Server configuration error. Please try again.', 'danger');
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerText = 'REGISTER ACCOUNT';
                }
            }

        } catch (error) {
            console.error('Network Error:', error);
            showCardMessage('Error!', 'Connection failed. Please check your internet.', 'danger');
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerText = 'REGISTER ACCOUNT';
            }
        }
    });
}