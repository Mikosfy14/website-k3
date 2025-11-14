document.addEventListener("DOMContentLoaded", () => {
    // Toggle sidebar untuk mobile
    const sidebar = document.querySelector(".sidebar");
    const content = document.querySelector(".content");
    if (sidebar) {
        const toggleButton = document.createElement("button");
        toggleButton.className =
            "btn btn-primary d-md-none position-fixed top-0 start-0 m-3 z-3";
        toggleButton.innerHTML =
            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/></svg>';
        document.body.appendChild(toggleButton);

        toggleButton.addEventListener("click", () => {
            sidebar.classList.toggle("active");
            content.classList.toggle("ms-0");
        });
    }

    // Prevent back button after logout
    window.onload = () => {
        if (
            typeof window.performance !== "undefined" &&
            window.performance.navigation.type === 2
        ) {
            window.location.reload();
        }
    };

    // Handle logout form submission
    const logoutForm = document.getElementById("logout-form");
    if (logoutForm) {
        logoutForm.addEventListener("submit", (e) => {
            sessionStorage.setItem("loggedOut", "true");
            sessionStorage.removeItem("lastPage");
        });
    }

    // Detect if user came back after logout
    if (sessionStorage.getItem("loggedOut") === "true") {
        sessionStorage.removeItem("loggedOut");
        window.location.href = "/login"; // Ganti dengan route('login') kalau pakai Blade
    }
});
