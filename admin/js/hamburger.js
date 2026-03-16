function toggleSidebar() {

    const sidebar = document.getElementById("sidebar");
    const button = document.getElementById("hamburgerBtn");

    sidebar.classList.toggle("-translate-x-full");

    if (sidebar.classList.contains("-translate-x-full")) {
        button.style.display = "block";
    } else {
        button.style.display = "none";
    }

}