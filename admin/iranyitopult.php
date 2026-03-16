<?php include "layout/header.php";
//var_dump($_SESSION);
?>
<?php require_once "lekerdezes/statisztika.php"; ?>

<main class="flex-1 md:p-2 md:pt-10 max-w-7xl mx-auto w-full">

    <header class="flex flex-col md:flex-row align-center md:justify-between mb-8 w-full text-center md:text-left">
        <h1 class="text-2xl mt-10 md:text-3xl font-bold">Irányítópult</h1>
    </header>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-2">

        <!-- Receptek -->
        <div class="bg-white m-2 rounded-xl shadow-md p-6 flex items-center justify-between border-l-4 border-green-500 hover:shadow-lg transition"
            ng-controller="receptController">
            <div>
                <p class="text-gray-500 text-sm">Receptek</p>
                <h2 class="text-3xl font-bold">{{recept.length}}</h2>
            </div>

            <div class="text-3xl bg-green-100 text-green-600 w-12 h-12 flex items-center justify-center rounded-full">
                🍳
            </div>
        </div>

        <!-- Hozzavalók -->
        <div class="bg-white m-2 rounded-xl shadow-md p-6 flex items-center justify-between border-l-4 border-purple-500 hover:shadow-lg transition"
            ng-controller="hozzavaloController">
            <div>
                <p class="text-gray-500 text-sm">Hozzávalók</p>
                <h2 class="text-3xl font-bold">{{hozzavalo.length}}</h2>
            </div>

            <div class="text-3xl bg-orange-100 text-orange-600 w-12 h-12 flex items-center justify-center rounded-full">
                🧂
            </div>
        </div>

        <!-- Eszközök -->
        <div class="bg-white m-2 rounded-xl shadow-md p-6 flex items-center justify-between border-l-4 border-orange-500 hover:shadow-lg transition"
            ng-controller="eszkozController">
            <div>
                <p class="text-gray-500 text-sm">Konyhai eszközök</p>
                <h2 class="text-3xl font-bold">{{eszkozok.length}}</h2>
            </div>

            <div class="text-3xl bg-orange-100 text-orange-600 w-12 h-12 flex items-center justify-center rounded-full">
                🔪
            </div>
        </div>

        <!-- Kategóriák -->
        <div class="bg-white m-2 rounded-xl shadow-md p-6 flex items-center justify-between border-l-4 border-orange-500 hover:shadow-lg transition"
            ng-controller="kategoriaController">
            <div>
                <p class="text-gray-500 text-sm">Kategóriák</p>
                <h2 class="text-3xl font-bold">{{eszkozKategoria.length + receptKategoria.length}}</h2>
            </div>

            <div class="text-3xl bg-orange-100 text-orange-600 w-12 h-12 flex items-center justify-center rounded-full">
                📂
            </div>
        </div>

        <!-- Felhasználók -->
        <div class="bg-white m-2 rounded-xl shadow-md p-6 flex items-center justify-between border-l-4 border-blue-500 hover:shadow-lg transition"
            ng-controller="felhasznaloController">
            <div>
                <p class="text-gray-500 text-sm">Felhasználók</p>
                <h2 class="text-3xl font-bold">{{felhasznalo.length}}</h2>
            </div>

            <div class="text-3xl bg-blue-100 text-blue-600 w-12 h-12 flex items-center justify-center rounded-full">
                👤
            </div>
        </div>

        <!-- Országok -->
        <div class="bg-white m-2 rounded-xl shadow-md p-6 flex items-center justify-between border-l-4 border-green-500 hover:shadow-lg transition"
            ng-controller="orszagController">
            <div>
                <p class="text-gray-500 text-sm">Országok</p>
                <h2 class="text-3xl font-bold">{{orszagok.length}}</h2>
            </div>

            <div class="text-3xl bg-green-100 text-green-600 w-12 h-12 flex items-center justify-center rounded-full">
                🌍
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold mb-4">Rendszer információ</h3>

            <ul class="space-y-2 text-gray-600 text-sm">
                <li>📅 Utolsó frissítés: <?php echo date('Y-m-d H:i:s'); ?></li>
            </ul>
        </div>


        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-semibold mb-4">Gyors műveletek</h3>

            <div class="flex flex-wrap gap-3">

                <a href="/CookQuest/admin/receptAdmin/ujrecept.php"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm transition">
                    + Új recept
                </a>

                <a href="/CookQuest/admin/eszkozAdmin/ujeszkoz.php"
                    class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm transition">
                    + Új eszköz
                </a>

                <a href="/CookQuest/admin/felhasznaloAdmin/felhasznalok.php"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition">
                    Felhasználók
                </a>

            </div>
        </div>

    </div>

</main>

<?php include "layout/footer.php"; ?>

</div>
</div>