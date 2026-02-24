<?php
session_start();

if (!isset($_SESSION["felhasznalo_id"])) {
    header("Location: /CookQuest/views/autentikacio/autentikacio.php");
    exit;
}

include "../head.php";
?>

<main class="w-full bg-[#90ab8b]" ng-controller="profilController">
    <div class="max-w-6xl mx-auto px-4 py-10 ">

        <!-- Cím -->
        <div class="border-b border-gray-300 text-center mb-5">
            <h1 class="text-3xl md:text-4xl font-bold mb-5 text-white">
                Fiók beállítások
            </h1>
        </div>


        <!-- Személyes adatok -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Személyes adatok -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-6 text-gray-700">
                    Személyes adatok
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Vezetéknév</label>
                        <input
                            type="text"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            ng-model="user.Vezeteknev" disabled>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Keresztnév</label>
                        <input
                            type="text"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            ng-model="user.Keresztnev" disabled>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm text-gray-600 mb-1">Email</label>
                        <input
                            type="email"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            ng-model="user.Emailcim" disabled>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Ország</label>
                        <input
                            type="text"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            ng-model="user.OrszagNev" disabled>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Regisztráció éve</label>
                        <input
                            type="text"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            ng-model="user.RegisztracioEve" disabled>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Születési év</label>
                        <input
                            type="text"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            ng-model="user.SzuletesiEv" disabled>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Megszerzett pontok</label>
                        <input
                            type="text"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            ng-model="user.MegszerzettPontok" disabled>
                    </div>

                </div>
            </div>

            <!-- Profilkép -->
            <div class="bg-white p-8 rounded-2xl shadow-md flex flex-col">

                <!-- Cím bal felső sarok -->
                <h2 class="text-xl font-semibold text-gray-700 mb-6">
                    Profilkép
                </h2>

                <!-- Kép rész középen -->
                <div class="flex flex-col items-center">

                    <div class="w-40 h-40 rounded-full bg-gray-200 overflow-hidden flex items-center justify-center mb-6">

                        <!-- Ha van profilkép -->
                        <img ng-if="user.Profilkep"
                            ng-src="/CookQuest/{{ user.Profilkep }}"
                            class="w-full h-full object-cover">

                        <!-- Ha nincs -->
                        <span ng-if="!user.Profilkep"
                            class="text-gray-500 text-sm">
                            Nincs kép
                        </span>

                    </div>

                    <!-- Fájl feltöltés -->
                    <label class="cursor-pointer bg-blue-600 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition shadow-md">
                        Kép kiválasztása
                        <input type="file"
                            accept="image/*"
                            class="hidden"
                            onchange="angular.element(this).scope().uploadProfileImage(this.files)">
                    </label>

                    <div class="mt-2">
                        <span class="text-gray-500 italic text-[small]">A képfeltöltés után, oldalfrissítés szükséges!</span>
                    </div>

                </div>

            </div>

        </div>

        <!-- Jelszó modositas rész -->
        <div class="bg-white p-8 rounded-2xl shadow-md mt-10">
            <h2 class="text-xl font-semibold mb-6 text-gray-700">
                Jelszó módosítása
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Jelenlegi jelszó</label>
                    <input type="password" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Új jelszó</label>
                    <input type="password" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Új jelszó megerősítése</label>
                    <input type="password" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

            </div>
        </div>

        <!-- Felhasznalonev modosítas rész -->
        <div class="bg-white p-8 rounded-2xl shadow-md mt-10">
            <h2 class="text-xl font-semibold mb-6 text-gray-700">
                Felhasználó módosítása
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Jelenlegi felhasználónév</label>
                    <input type="text"
                        ng-model="user.Felhasznalonev"
                        disabled
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Új felhasználónév</label>
                    <input type="text" ng-model="user.newUsername" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Új felhasználónév megerősítése</label>
                    <input type="text" ng-model="user.confirmNewUsername" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

            </div>
        </div>

        <!-- Gombok -->
        <div class="mt-10 flex flex-col md:flex-row gap-6">

            <!-- Mentés gomb -->
            <button
                class="flex-1 bg-blue-600 text-white py-4 rounded-2xl text-lg font-semibold hover:bg-blue-700 transition duration-200 shadow-md">
                Mentés
            </button>

            <!-- Kilépés gomb -->
            <button
                ng-click="openLogoutModal()"
                class="flex-1 bg-red-600 text-white py-4 rounded-2xl text-lg font-semibold hover:bg-red-700 transition duration-200 shadow-md">
                Kilépés
            </button>

        </div>


        <?php include "../autentikacio/kijelentkezesModal.php"; ?>

    </div>
</main>


<?php include "../footer.php"; ?>