<!-- Navbar -->
<nav class="flex flex-wrap items-center justify-between p-3 bg-[#EBF4DD] font-bold text-lg">

    <a href="index.php"><img src="kepek/Monogram.png" class="w-16"></img></a>

    <div class="flex md:hidden">
        <button id="hamburger">
            <img class="toggle block" src="https://img.icons8.com/fluent-systems-regular/2x/menu-squared-2.png"
                width="40" height="40" />
            <img class="toggle hidden" src="https://img.icons8.com/fluent-systems-regular/2x/close-window.png"
                width="40" height="40" />
        </button>
    </div>

    <div class=" toggle hidden w-full md:w-auto md:flex text-right text-bold mt-5 md:mt-0 md:border-none">
        <a href="index.php" class="block md:inline-block hover:text-[#5A7863] px-3 py-3 md:border-none">Főoldal</a>
        <a href="receptek.php" class="block md:inline-block hover:text-[#5A7863] px-3 py-3 md:border-none">Receptek</a>
        <a href="konyhaiEszkozok.php" class="block md:inline-block hover:text-[#5A7863] px-3 py-3 md:border-none">Konyhai eszközök</a>
        <a href="bejelentkezes.php" class="block md:inline-block hover:text-[#5A7863] px-3 py-3 md:border-none">Bejelentkezés</a>
    </div>

    <!-- Kereső -->
    <div class="relative w-64 bg-white rounded-full toggle hidden md:w-auto md:flex text-right text-bold mt-5 md:mt-0 md:border-none ">
        <input
            type="text"
            placeholder="Keresés..."
            class="rounded-full w-64 h-10 h-10 bg-transparent pl-8 py-2  border-2 border-gray-100 shadow-md hover:outline-none focus:ring-[#5A7863] focus:border-[#5A7863]"
            type="text" name="query" id="query" />
        <button type="submit"
            class="absolute inline-flex items-center h-8 px-2 py-2 text-sm text-white transition duration-150 ease-in-out rounded-full outline-none right-3 top-1 bg-[#5A7863] sm:px-6 sm:text-base sm:font-medium hover:bg-[#5A7863] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5A7863]">
            <svg class="-ml-0.5 sm:-ml-1 mr-2 w-4 h-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </button>
    </div>
</nav>