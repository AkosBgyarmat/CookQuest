<?php include "../layout/header.php"; ?>
<?php include "../layout/oldalmenu.php"; ?>

<main class="flex-1 p-10" ng-controller="felhasznaloController">

    <header class="flex items-center justify-between mb-10">
        <h1 class="text-3xl font-bold mb-8">Felhasználók - {{felhasznalo.length}}</h1>
    </header>

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
<?php include "../layout/footer.php"; ?>
</main>