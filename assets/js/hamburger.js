const hamburger = document.querySelector("#hamburger");
hamburger.addEventListener("click", function(){
    const navToggle = document.querySelectorAll(".toggle");
    for (let i = 0; i < navToggle.length; i++) {
        navToggle.item(i).classList.toggle("hidden");
    }
});