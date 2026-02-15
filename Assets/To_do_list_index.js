 //Forces the browser to ignore the 'snapshot' and talk to the PHP Auth Guard.

(function () {
    window.onpageshow = function(event) {
        if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
            // Force reload from server
            window.location.reload();
        }
    };
})();

