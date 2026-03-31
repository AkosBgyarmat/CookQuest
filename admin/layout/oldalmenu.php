<aside id="sidebar"
    class="fixed top-0 left-0 h-screen w-64 bg-[#C0CEB8] text-black p-5
transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-40 overflow-y-auto">

    <header class="flex items-center justify-between">

        <h2 class="hidden md:block text-2xl font-bold mb-6">
            CookQuest<br><span class="uppercase italic">Admin</span> 
        </h2>

        <button onclick="toggleSidebar()" class="lg:hidden absolute top-6 right-4 text-xl border bg-[#5A7863] p-2 w-10 h-10 rounded-full text-white hover:bg-[#3B4953] transition duration-300">
            ✖
        </button>

    </header>

    <ul class="space-y-3">

        <li>
            <a href="/CookQuest/admin/iranyitopult.php"
                class="flex items-center gap-3 hover:bg-[#759277] hover:text-white p-2 rounded">
                <span class="sm:text-center sm:w-100">Irányítópult
            </a>
        </li>

        <li>
            <a href="/CookQuest/admin/statisztika/statisztika.php"
                class="flex items-center gap-3 hover:bg-[#759277] hover:text-white p-2 rounded">
                <span class="sm:text-center sm:w-100">Statisztika
            </a>
        </li>

        <hr>

        <li>
            <a href="/CookQuest/admin/receptAdmin/receptek.php"
                class="flex items-center gap-3 hover:bg-[#759277] hover:text-white p-2 rounded">
                <span>Receptek
            </a>
        </li>

        <li>
            <a href="/CookQuest/admin/hozzavalokAdmin/hozzavalok.php"
                class="flex items-center gap-3 hover:bg-[#759277] hover:text-white p-2 rounded">
                Hozzávalók
            </a>
        </li>

        <li>
            <a href="/CookQuest/admin/kategoriakAdmin/receptKategoriakAdmin/receptKategoriak.php"
                class="flex items-center gap-3 hover:bg-[#759277] hover:text-white p-2 rounded">
                Recept kategóriák
            </a>
        </li>

        <hr>

        <li>
            <a href="/CookQuest/admin/eszkozAdmin/eszkozok.php"
                class="flex items-center gap-3 hover:bg-[#759277] hover:text-white p-2 rounded">
                Eszközök
            </a>
        </li>

        <li>
            <a href="/CookQuest/admin/kategoriakAdmin/eszkozKategoriakAdmin/eszkozKategoriak.php"
                class="flex items-center gap-3 hover:bg-[#759277] hover:text-white p-2 rounded">
                Eszköz kategóriák
            </a>
        </li>

        <hr>

        <li>
            <a href="/CookQuest/admin/felhasznaloAdmin/felhasznalok.php"
                class="flex items-center gap-3 hover:bg-[#759277] hover:text-white p-2 rounded">
                Felhasználók
            </a>
        </li>

        <hr>

        <li>
            <a href="/CookQuest/admin/orszagAdmin/orszagok.php"
                class="flex items-center gap-3 hover:bg-[#759277] hover:text-white p-2 rounded">
                Országok
            </a>
        </li>

        <li>
            <a href="/CookQuest/admin/kijelentkezesAdmin/kijelentkezes.php"
                class="flex items-center gap-3 bg-red-600 text-white p-2 rounded hover:bg-white hover:text-red-600 transition duration-300">
                Kijelentkezés
            </a>
        </li>

        <li>
            <a href="/CookQuest/views/profil/profil.php"
                class="flex items-center gap-3 bg-[#5A7863] text-white p-2 rounded hover:bg-white hover:text-[#5A7863] transition duration-300">
                Vissza a profilomra
            </a>
        </li>

    </ul>

</aside>

<div class="flex flex-col flex-1">