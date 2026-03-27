<!-- Navbar -->
<nav class="flex flex-wrap items-center justify-between p-3 bg-[#EBF4DD] font-bold text-lg">

    <a href="<?= BASE_URL ?>index.php">
        <img src="<?= BASE_URL ?>assets/kepek/Monogram.png" class="w-16"></img>
    </a>

    <div class="flex md:hidden">
        <button id="hamburger">
            <img class="toggle block" src="https://img.icons8.com/fluent-systems-regular/2x/menu-squared-2.png"
                width="40" height="40" />
            <img class="toggle hidden" src="https://img.icons8.com/fluent-systems-regular/2x/close-window.png"
                width="40" height="40" />
        </button>
    </div>

    <div class=" toggle hidden w-full md:w-auto md:flex text-right text-bold mt-5 md:mt-0 md:border-none">
        <a href="<?= BASE_URL ?>index.php" class="block md:inline-block hover:text-[#5A7863] px-3 py-3 md:border-none">Főoldal</a>
        <a href="<?= BASE_URL ?>views/receptek/receptek.php" class="block md:inline-block hover:text-[#5A7863] px-3 py-3 md:border-none">Receptek</a>
        <a href="<?= BASE_URL ?>views/konyhaiEszkozok/konyhaiEszkozok.php" class="block md:inline-block hover:text-[#5A7863] px-3 py-3 md:border-none">Konyhai eszközök</a>
        <?php if (isset($_SESSION["felhasznalo_nev"])): ?>

            <!-- Bejelentkezett állapot -->
            <a href="<?= BASE_URL ?>views/profil/profil.php"
                class="block md:inline-block hover:text-[#5A7863] px-3 py-3 md:border-none">
                Üdv, <?php echo $_SESSION["felhasznalo_nev"]; ?>!
            </a>

        <?php else: ?>

            <!-- Nincs bejelentkezve -->
            <a href="<?= BASE_URL ?>views/autentikacio/autentikacio.php"
                class="block md:inline-block hover:text-[#5A7863] px-3 py-3 md:border-none">
                Bejelentkezés
            </a>

        <?php endif; ?>
    </div>

    <form action="<?= BASE_URL ?>kereses.php" method="GET" class="toggle hidden md:flex relative w-full md:w-64 mt-5 md:mt-0 mr-3">

        <input
            type="text"
            name="q"
            placeholder="Keresés..."
            class="w-full h-10 pl-4 pr-12 rounded-full border border-gray-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#5A7863] focus:border-[#5A7863]" />

        <button type="submit"
            class="absolute right-1 top-1/2 -translate-y-1/2 h-8 w-8 flex items-center justify-center rounded-full bg-[#5A7863] text-white hover:bg-[#3B4953]">

            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>

        </button>
    </form>
</nav>