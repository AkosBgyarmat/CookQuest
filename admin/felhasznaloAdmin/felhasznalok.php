<?php include "../layout/header.php"; ?>

<main class="flex-1 lg:ml-64 p-4 md:p-6" ng-controller="felhasznaloController">

    <header class="flex flex-col md:flex-row align-center md:justify-between mb-8 w-full text-center md:text-left">
        <h1 class="text-2xl mt-10 md:text-3xl font-bold">Felhasználók - {{felhasznalo.length}}</h1>
    </header>

    <button ng-click="createFelhasznalo()"
        class="bg-[#C0CEB8] text-black px-4 py-2 rounded mb-5 inline-block m-2">
        + Új felhasználó
    </button>

    <!-- Asztali nézet -->
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full bg-white shadow-lg rounded-xl overflow-hidden">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Felhasználónév</th>
                    <th class="p-3 text-left">Email cím</th>
                    <th class="p-3 text-left">Születési év</th>
                    <th class="p-3 text-left">Törölve</th>
                    <th class="p-3 text-left">Művelet</th>
                </tr>
            </thead>

            <tbody>

                <tr class="border-t" ng-repeat="f in felhasznalo track by f.id">
                    <td class="p-2">{{f.id}}</td>
                    <td class="p-3">{{f.Felhasznalonev}}</td>
                    <td class="p-3">{{f.Emailcim}}</td>
                    <td class="p-3">{{f.SzuletesiEv}}</td>                    
                    <td class="p-3">{{f.Torolve == 0 ? 'Nem' : 'Igen'}}</td>
                    <td class="p-3 ">

                         <button ng-click="editFelhasznalo(f)"
                            class="bg-[#C0CEB8] text-black px-3 py-1 rounded">
                            Szerkeszt
                        </button>

                        <button
                            ng-if="f.Torolve == 0"
                            ng-click="torles(f.id)"
                            class="bg-red-500 text-white mb-5 px-3 py-1 rounded hover:bg-red-600 transition">
                            Törlés
                        </button>

                        <button ng-if="f.Torolve == 1"
                            ng-click="visszaallitas(f.id)"
                            class="bg-green-500 text-white mb-5 px-3 py-1 rounded hover:bg-green-600 transition">
                            Visszaállítás
                        </button>

                    </td>
                </tr>

            </tbody>

        </table>
    </div>

    <div class="md:hidden space-y-3">

        <div class="bg-white m-2 rounded-lg shadow p-4 flex justify-between items-center"
            ng-repeat="f in felhasznalo track by f.id">

            <div>

                <p class="text-sm text-gray-500">
                    ID: {{f.id}}
                </p>

                <p class="text-lg font-semibold">
                    {{f.Vezeteknev}} {{f.Keresztnev}}
                </p>

                <p class="text-sm text-gray-500">
                    {{f.Felhasznalonev}}
                </p>

            </div>

            <div class="flex gap-2 mt-3">

               <button ng-click="editFelhasznalo(f)"
                    class="bg-[#C0CEB8] text-black mb-5 px-3 py-1 rounded hover:bg-red-600 transition">
                    Szerkeszt
                </button>

                <button
                    ng-if="f.Torolve == 0"
                    ng-click="torles(f.id)"
                    class="bg-red-500 text-white mb-5 px-3 py-1 rounded hover:bg-red-600 transition">
                    Törlés
                </button>

                <button ng-if="f.Torolve == 1"
                    ng-click="visszaallitas(f.id)"
                    class="bg-green-500 text-white mb-5 px-3 py-1 rounded hover:bg-red-600 transition">
                    Visszaállítás
                </button>

            </div>

            </div>
        </div>

        <?php include "felhasznaloSzerkesztModal.php"; ?>
        <?php include "../layout/feedbackModal.php"; ?>
</main>

<?php include "../layout/footer.php"; ?>
</div>
</div>