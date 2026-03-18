<?php include "../layout/header.php"; ?>

<main class="flex-1 lg:ml-64 md:p-2 md:pt-10" ng-controller="felhasznaloController">

    <header class="flex flex-col md:flex-row align-center md:justify-between mb-8 w-full text-center md:text-left">
        <h1 class="text-2xl mt-10 md:text-3xl font-bold">Felhasználók - {{felhasznalo.length}}</h1>
    </header>

    <div class="hidden md:block overflow-x-auto">
        <table class="w-full bg-white shadow rounded">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Vezetéknév</th>
                    <th class="p-3 text-left">Keresztnév</th>
                    <th class="p-3 text-left">Felhasználónév</th>
                    <th class="p-3 text-left">Email cím</th>
                    <th class="p-3 text-left">Jelszó</th>
                    <th class="p-3 text-left">Születési év</th>
                    <th class="p-3 text-left">Ország</th>
                    <th class="p-3 text-left">Regisztráció éve</th>
                    <th class="p-3 text-left">Megszerzett pontok</th>
                    <th class="p-3 text-left">Szerep</th>
                    <th class="p-3 text-left">Művelet</th>
                </tr>
            </thead>

            <tbody>

                <tr class="border-t" ng-repeat="f in felhasznalo track by f.id">
                    <td class="p-2">{{f.id}}</td>
                    <td class="p-3">{{f.Vezeteknev}}</td>
                    <td class="p-3">{{f.Keresztnev}}</td>
                    <td class="p-3">{{f.Felhasznalonev}}</td>
                    <td class="p-3">{{f.Emailcim}}</td>
                    <td class="p-3">********</td>
                    <td class="p-3">{{f.SzuletesiEv}}</td>
                    <td class="p-3">{{f.Orszag}}</td>
                    <td class="p-3">{{f.RegisztracioEve}}</td>
                    <td class="p-3">{{f.MegszerzettPontok}}</td>
                    <td class="p-3">{{f.Szerep}}</td>
                    <td class="p-3 ">

                        <a href="receptek_szerkeszt.php?id=1"
                            class="bg-blue-500 text-white mb-5 mr-2 px-2 py-1 rounded">
                            Szerkeszt
                        </a>

                        <a href="receptek_torol.php?id=1"
                            class="bg-red-500 text-white mb-5 px-2 py-1 rounded">
                            Törlés
                        </a>

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

            <div class="space-x-2">

                <a href="receptek_szerkeszt.php?id=1"
                    class="bg-blue-500 text-white px-2 py-1 rounded">
                    Szerkeszt
                </a>

                <a href="receptek_torol.php?id=1"
                    class="bg-red-500 text-white px-2 py-1  rounded">
                    Törlés
                </a>

            </div>
        </div>
</main>

<?php include "../layout/footer.php"; ?>
</div>
</div>