//Element References
var loginForm = document.getElementById('loginForm');
var usernameInput = document.getElementById('username');
var passwordInput = document.getElementById('password');
var formMessageContainer = document.getElementById('formMessageContainer');

//Show Message 
function showMessage(message, type) {
    type = type || 'danger';

    formMessageContainer.innerHTML =
        '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
            message +
            '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
        '</div>';
}

//Clear form on back button cache 
window.addEventListener('pageshow', function (event) {
    if (event.persisted) {
        loginForm.reset();
        formMessageContainer.innerHTML = '';
    }
});

// Password Eye Toggle
var toggleBtn = document.getElementById('togglePassBtn');
var eyeIcon = document.getElementById('eyeIcon');

toggleBtn.addEventListener('click', function () {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
    }
});

//Form Submit
loginForm.addEventListener('submit', function (e) {
    e.preventDefault();

    var username = usernameInput.value.trim();
    var password = passwordInput.value;

    // Basic integrity validation
    if (username === '' || password === '') {
        showMessage('All fields are required.');
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'actions/To_do_list_login_api.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {

            if (xhr.status !== 200) {
                showMessage('System Error. Please try again.');
                return;
            }

            try {
                var result = JSON.parse(xhr.responseText);

                if (result.success) {
                    showMessage('Login successful!', 'success');
                    loginForm.reset();

                    setTimeout(function () {
                        formMessageContainer.innerHTML = '';
                        window.location.href = result.redirect;
                    }, 1000);

                } else {
                    showMessage(result.message);
                    passwordInput.value = '';
                }

            } catch (e) {
                // Error code must originate from server
                showMessage('ERROR H3J7622HNS');
            }
        }
    };

    xhr.send(JSON.stringify({
        username: username,
        password: password
    }));
});

//Prevent forward/back dashboard access (client-side assist only)
window.history.pushState(null, null, window.location.href);
window.onpopstate = function () {
    window.history.go(1);
};
