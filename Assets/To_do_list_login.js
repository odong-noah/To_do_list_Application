// --- Element References ---
const loginForm = document.getElementById('loginForm');
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');
const formMessageContainer = document.getElementById('formMessageContainer');

// --- Function to show messages ---
function showMessage(message, type = 'danger') {
    formMessageContainer.innerHTML = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
}


window.addEventListener('pageshow', (event) => {
    // If the page is loaded from cache (back button), clear everything
    if (event.persisted || window.performance && window.performance.navigation.type === 2) {
        loginForm.reset();
        formMessageContainer.innerHTML = '';
    }
});

// --- Password Eye Toggle ---
const toggleBtn = document.getElementById('togglePassBtn');
const eyeIcon = document.getElementById('eyeIcon');

toggleBtn.addEventListener('click', () => {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
    }
});

loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const loginData = {
        username: usernameInput.value.trim(),
        password: passwordInput.value
    };

    try {
        const response = await fetch('Controllers/To_do_list_login_api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(loginData)
        });

        const rawText = await response.text();
        
        try {
            const result = JSON.parse(rawText);
            
            if (result.success) {
               
                showMessage("Login successful!", "success");

                loginForm.reset();

                //  Wait 1 second, then clear notification and redirect
                setTimeout(() => {
                    formMessageContainer.innerHTML = ''; // Make notification disappear
                    window.location.href = result.redirect;
                }, 1000);

            } else {
                showMessage(result.message, "danger");
                passwordInput.value = ''; // Clear password on failed attempt for security
            }
        } catch (jsonErr) {
            console.error("Server sent non-JSON response:", rawText);
            showMessage("System Error: JDGHHF6BDHBJAB", "danger");
        }

    } catch (error) {
        console.error("Network Error:", error);
        showMessage("Connection failed. Please try again.", "danger");
    }
});

    // 1. Prevent the user from clicking 'Forward' back into the dashboard
    window.history.pushState(null, null, window.location.href);
    window.onpopstate = function () {
        window.history.go(1);
    };