<?php include "../layout/header.php"; ?>
<?php include "../layout/oldalmenu.php"; ?>

<div class="flex-1 p-10">

    <h1 class="text-3xl font-bold mb-6">Receptek kezelése</h1>

    <a href="receptekUj.php"
        class="bg-green-600 text-white px-4 py-2 rounded mb-5 inline-block">
        + Új recept
    </a>

    <table class="w-full bg-white shadow rounded">

        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 text-left">ID</th>
                <th class="p-3 text-left">Név</th>
                <th class="p-3 text-left">Kategória</th>
                <th class="p-3 text-left">Művelet</th>
            </tr>
        </thead>

        <tbody>

            <tr class="border-t">
                <td class="p-3">1</td>
                <td class="p-3">Pizza</td>
                <td class="p-3">Főétel</td>

                <td class="p-3 space-x-2">

                    <a href="receptek_szerkeszt.php?id=1"
                        class="bg-blue-500 text-white px-3 py-1 rounded">
                        Szerkeszt
                    </a>

                    <a href="receptek_torol.php?id=1"
                        class="bg-red-500 text-white px-3 py-1 rounded">
                        Törlés
                    </a>

                </td>
            </tr>

        </tbody>

    </table>

</div>

<?php include "../layout/footer.php"; ?>