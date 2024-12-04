const menuIcon = document.getElementById("menu-icon");
const navbar = document.querySelector(".navbar");

menuIcon.addEventListener("click", () => {
    navbar.classList.toggle("active");
});

window.addEventListener("click", (event) => {
    if (!navbar.contains(event.target) && event.target !== menuIcon) {
        navbar.classList.remove("active");
    }
});
document.addEventListener("DOMContentLoaded", () => {
    const modals = document.querySelectorAll(".modal");
    const closeButtons = document.querySelectorAll(".close");
    const openButtons = document.querySelectorAll(".header-btn a");

    openButtons.forEach((button) => {
        button.addEventListener("click", (event) => {
            event.preventDefault();
            const modal = document.querySelector(button.classList.contains("sign-up") ? "#signUpModal" : "#signInModal");
            modal.style.display = "flex";
        });
    });

    closeButtons.forEach((button) => {
        button.addEventListener("click", () => {
            button.closest(".modal").style.display = "none";
        });
    });

    window.addEventListener("click", (event) => {
        modals.forEach((modal) => {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    });
});