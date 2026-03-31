<?php include "layout/header.php";
//var_dump($_SESSION);
?>
<?php require_once "lekerdezes/statisztika.php"; ?>

<main class="flex-1 lg:ml-64 p-6">

    <header class="flex flex-col md:flex-row align-center md:justify-between mb-8 w-full text-center md:text-left">
        <h1 class="text-2xl mt-10 md:text-3xl font-bold">Irányítópult</h1>
    </header>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        <!-- Receptek -->
        <div class="bg-white  rounded-xl shadow-md p-6 flex items-center justify-between border-l-4 border-[#5A7863] hover:shadow-lg transition"
            ng-controller="receptController">
            <div>
                <p class="text-gray-500 text-sm">Receptek</p>
                <h2 class="text-3xl font-bold">{{recept.length}}</h2>
            </div>

            <div class="text-3xl border bg-[#5A7863]/40 text-green-600 w-12 h-12 flex items-center justify-center rounded-full">
                🍳
            </div>
        </div>

        <!-- Hozzavalók -->
        <div class="bg-white  rounded-xl shadow-md p-6 flex items-center justify-between border-l-4 border-[#90AB8B] hover:shadow-lg transition"
            ng-controller="hozzavaloController">
            <div>
                <p class="text-gray-500 text-sm">Hozzávalók</p>
                <h2 class="text-3xl font-bold">{{hozzavalo.length}}</h2>
            </div>

            <div class="text-3xl border bg-[#90AB8B]/40 text-orange-600 w-12 h-12 flex items-center justify-center rounded-full">
                🧂
            </div>
        </div>

        <!-- Eszközök -->
        <div class="bg-white  rounded-xl shadow-md p-6 flex items-center justify-between border-l-4 border-[#C0CEB8] hover:shadow-lg transition"
            ng-controller="eszkozController">
            <div>
                <p class="text-gray-500 text-sm">Konyhai eszközök</p>
                <h2 class="text-3xl font-bold">{{eszkoz.length}}</h2>
            </div>

            <div class="text-3xl border bg-[#C0CEB8]/40 text-orange-600 w-12 h-12 flex items-center justify-center rounded-full">
                🔪
            </div>
        </div>

        <div class="bg-white  rounded-xl shadow-md p-6 flex items-center justify-between border-l-4 border-[#90AB8B] hover:shadow-lg transition"
            ng-controller="receptKategoriaController">
            <div>
                <p class="text-gray-500 text-sm">Recept kategóriák</p>
                <h2 class="text-3xl font-bold">{{receptKategoria.length}}</h2>
            </div>

            <div class="text-3xl border bg-[#90AB8B]/40 text-orange-600 w-12 h-12 flex items-center justify-center rounded-full">
                📂
            </div>
        </div>

        <!-- Kategóriák -->
        <div class="bg-white  rounded-xl shadow-md p-6 flex items-center justify-between border-l-4 border-[#90AB8B] hover:shadow-lg transition"
            ng-controller="eszkozKategoriaController">
            <div>
                <p class="text-gray-500 text-sm">Eszköz kategóriák</p>
                <h2 class="text-3xl font-bold">{{eszkozKategoria.length}}</h2>
            </div>

            <div class="text-3xl border bg-[#90AB8B]/40 text-orange-600 w-12 h-12 flex items-center justify-center rounded-full">
                📂
            </div>
        </div>

        <!-- Felhasználók -->
        <div class="bg-white  rounded-xl shadow-md p-6 flex items-center justify-between border-l-4 border-[#5A7863] hover:shadow-lg transition"
            ng-controller="felhasznaloController">
            <div>
                <p class="text-gray-500 text-sm">Felhasználók</p>
                <h2 class="text-3xl font-bold">{{felhasznalo.length}}</h2>
            </div>

            <div class="text-3xl border bg-[#5A7863]/40 text-blue-600 w-12 h-12 flex items-center justify-center rounded-full">
                👤
            </div>
        </div>

        <!-- Országok -->
        <div class="bg-white  rounded-xl shadow-md p-6 flex items-center justify-between border-l-4 border-[#C0CEB8] hover:shadow-lg transition"
            ng-controller="orszagController">
            <div>
                <p class="text-gray-500 text-sm">Országok</p>
                <h2 class="text-3xl font-bold">{{orszagok.length}}</h2>
            </div>

            <div class="text-3xl border bg-[#C0CEB8]/40 text-green-600 w-12 h-12 flex items-center justify-center rounded-full">
                🌍
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8 ">

        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold mb-4">Rendszer információ</h3>

            <ul class="space-y-2 text-gray-600 text-sm">
                <li>Utolsó frissítés: <?php echo date('Y-m-d H:i:s'); ?></li>
            </ul>
        </div>


        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold mb-4">Gyors műveletek</h3>

            <div class="flex flex-wrap gap-3">

                <a href="/CookQuest/admin/receptAdmin/receptek.php?openNew=1"
                    class="bg-[#5A7863] hover:bg-[#3B4953] text-white px-4 py-2 rounded-lg text-sm transition">
                    + Új recept
                </a>

                <a href="/CookQuest/admin/hozzavalokAdmin/hozzavalok.php?openNew=1"
                    class="bg-[#90AB8B] hover:bg-[#7D9A8A] text-black px-4 py-2 rounded-lg text-sm transition">
                    + Új hozzávaló
                </a>

                <a href="/CookQuest/admin/eszkozAdmin/ujeszkoz.php"
                    class="bg-[#C0CEB8] hover:bg-[#AAB8A9] text-black px-4 py-2 rounded-lg text-sm transition">
                    + Új eszköz
                </a>

                <a href="/CookQuest/admin/eszkozAdmin/ujeszkozkategoria.php"
                    class="bg-[#5A7863] hover:bg-[#3B4953] text-white px-4 py-2 rounded-lg text-sm transition">
                    + Új eszköz kategória
                </a>

                <a href="/CookQuest/admin/receptAdmin/ujreceptkategoria.php"
                    class="bg-[#C0CEB8] hover:bg-[#AAB8A9] text-black px-4 py-2 rounded-lg text-sm transition">
                    + Új recept kategória 
                </a>

                <a href="/CookQuest/admin/orszagAdmin/ujorszag.php"
                    class="bg-[#90AB8B] hover:bg-[#7D9A8A] text-black px-4 py-2 rounded-lg text-sm transition">
                    + Új ország
                </a>

                <a href="/CookQuest/admin/felhasznaloAdmin/felhasznalok.php"
                    class="bg-[#5A7863] hover:bg-[#3B4953] text-white px-4 py-2 rounded-lg text-sm transition">
                    Felhasználók
                </a>

            </div>
        </div>

    </div>

</main>

<?php include "layout/footer.php"; ?>

</div>
</div>