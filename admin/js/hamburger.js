let sidebarOpen = false;

function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");
    const hamburger = document.getElementById("hamburgerBtn");

    sidebarOpen = !sidebarOpen;

    if (sidebarOpen) {
        sidebar.classList.remove("-translate-x-full");
        overlay.classList.remove("hidden");
        hamburger.classList.add("hidden");
    } else {
        sidebar.classList.add("-translate-x-full");
        overlay.classList.add("hidden");
        hamburger.classList.remove("hidden");
    }
}