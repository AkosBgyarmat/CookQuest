document.addEventListener("DOMContentLoaded", function () {

    function getCookie(name) {
        const cookies = document.cookie.split("; ");
        for (let c of cookies) {
            const [key, value] = c.split("=");
            if (key === name) return value;
        }
        return null;
    }

    window.acceptCookies = function () {
        document.cookie = "cookieAccepted=true; path=/; max-age=" + 60 * 60 * 24 * 365 + "; SameSite=Lax";
        document.getElementById("cookieBanner").classList.add("hidden");
    };

     if (!getCookie("cookieAccepted")) {
        document.getElementById("cookieBanner").classList.remove("hidden");
    } 

});


/* TESZTELÉSHEZ */
/* document.addEventListener("DOMContentLoaded", function () {

    const banner = document.getElementById("cookieBanner");

    banner.classList.remove("hidden");

    window.acceptCookies = function () {
        banner.classList.add("hidden");
    };

}); */