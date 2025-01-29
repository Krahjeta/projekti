const menuIcon = document.getElementById("menu-icon");
const navbar = document.querySelector(".navbar");

menuIcon.addEventListener("click", () => {
    navbar.classList.toggle("active");
});

document.addEventListener("DOMContentLoaded", () => {
    const modals = document.querySelectorAll(".modal");
    const closeButtons = document.querySelectorAll(".close");
    const openButtons = document.querySelectorAll(".header-btn a");

    openButtons.forEach((button) => {
        button.addEventListener("click", (event) => {
            event.preventDefault();
            const modal = document.querySelector(button.classList.contains("sign-up") ? "#signUpModal" : "#signInModal");
            modal.classList.add("active");  // Add 'active' class instead of using 'display: flex'
        });
    });

    closeButtons.forEach((button) => {
        button.addEventListener("click", () => {
            button.closest(".modal").classList.remove("active");  // Remove 'active' class to close modal
        });
    });

    window.addEventListener("click", (event) => {
        modals.forEach((modal) => {
            if (event.target === modal) {
                modal.classList.remove("active");  // Remove 'active' class to close modal
            }
        });

        if (!navbar.contains(event.target) && event.target !== menuIcon) {
            navbar.classList.remove("active");
        }
    });
});
