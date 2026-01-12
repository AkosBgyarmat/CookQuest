<!-- Navbar -->
<nav class="flex flex-wrap items-center justify-between p-3 bg-[#e8e8e5]">
        <div class="text-xl">Bappa Flour mill</div>
        <div class="flex md:hidden">
            <button id="hamburger">
                <img class="toggle block" src="https://img.icons8.com/fluent-systems-regular/2x/menu-squared-2.png"
                    width="40" height="40" />
                <img class="toggle hidden" src="https://img.icons8.com/fluent-systems-regular/2x/close-window.png"
                    width="40" height="40" />
            </button>
        </div>
        <div class=" toggle hidden w-full md:w-auto md:flex text-right text-bold mt-5 md:mt-0 md:border-none">
            <a href="index.php" class="block md:inline-block hover:text-blue-500 px-3 py-3 md:border-none">Home
            </a>
            <a href="receptek.php" class="block md:inline-block hover:text-blue-500 px-3 py-3 md:border-none">Receptek
            </a>
            <a href="konyhaiEszkozok.php" class="block md:inline-block hover:text-blue-500 px-3 py-3 md:border-none">Konyhai eszközök
            </a>
            <a href="bejelentkezes.php" class="block md:inline-block hover:text-blue-500 px-3 py-3 md:border-none">Bejelentkezés
            </a>
            <a href="#contactUs" class="block md:inline-block hover:text-blue-500 px-3 py-3 md:border-none">Visit Us
            </a>
        </div>

        <!-- Kereső -->
        <div class="relative w-full max-w-xl mx-auto bg-white rounded-full  
        toggle hidden w-full 
        md:w-auto md:flex text-right text-bold mt-5 md:mt-0 md:border-none ">
            <input placeholder="e.g. Blog"
                class="rounded-full w-full h-10 bg-transparent py-2 pl-8 pr-32 outline-none border-2 border-gray-100 shadow-md hover:outline-none focus:ring-teal-200 focus:border-teal-200"
                type="text" name="query" id="query">
            
            <button type="submit"
                class="absolute inline-flex items-center h-8 px-4 py-2 text-sm text-white transition duration-150 ease-in-out rounded-full outline-none right-3 top-1 bg-teal-600 sm:px-6 sm:text-base sm:font-medium hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                <svg class="-ml-0.5 sm:-ml-1 mr-2 w-4 h-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Search
            </button>
        </div>

    </nav>