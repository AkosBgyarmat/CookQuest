<?php include "../head.php";

session_start();
if (!isset($_SESSION["felhasznalo_id"])) {
    header("Location: ../autentikacio/autentikacio.php");
    exit;
}
?>

<main class="w-full bg-[#90ab8b]" ng-controller="profilController">
    <div class="max-w-6xl mx-auto px-4 py-10 ">

        <!-- Cím -->
        <div class="border-b border-gray-300 text-center mb-5">
            <h1 class="text-3xl md:text-4xl font-bold mb-5 text-white">
                Fiók beállítások
            </h1>
        </div>


        <!-- Felső rész -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Személyes adatok -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-6 text-gray-700">
                    Személyes adatok
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Vezetéknév</label>
                        <input type="text" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Keresztnév</label>
                        <input type="text" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm text-gray-600 mb-1">Email</label>
                        <input type="email" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Ország</label>
                        <select class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option>Magyarország</option>
                            <option>Németország</option>
                            <option>Ausztria</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Regisztráció éve</label>
                        <input type="number" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm text-gray-600 mb-1">Születési év</label>
                        <input type="number" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                </div>
            </div>

            <!-- Profilkép -->
            <div class="bg-white p-8 rounded-2xl shadow-md flex flex-col items-center justify-center">
                <h2 class="text-xl font-semibold mb-6 text-gray-700">
                    Profilkép
                </h2>

                <div class="w-40 h-40 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden mb-6">
                    <span class="text-gray-500 text-sm">Nincs kép</span>
                </div>

                <input type="file" class="block w-full text-sm text-gray-600
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-xl file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-500 file:text-white
                    hover:file:bg-blue-600">
            </div>

        </div>

        <!-- Jelszó rész -->
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

        <!-- Mentés gomb -->
        <div class="mt-10">
            <button class="w-[50%] bg-blue-600 text-white py-4 rounded-2xl text-lg font-semibold hover:bg-blue-700 transition duration-200 shadow-md">
                Mentés
            </button>
        </div>

        <form action="../../api/kilepes.php" method="post">
            <button type="submit"
                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                Kilépés
            </button>
        </form>

    </div>
</main>


<?php include "../footer.php"; ?>