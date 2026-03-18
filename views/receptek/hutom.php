<?php
require_once __DIR__ . '/../../api/receptek_bootstrap.php';
require_once __DIR__ . '/../../controller/HutoVezerlo.php';

// MVC bontas megjegyzes:
// Ez a fajl mar csak megjelenitest vegez.
// A kovetkezo logika a HutoVezerlo-ben van: alap view adatok, POST feldolgozas,
// hozzavalo-ID tisztitas, szurt receptek es recept-hozzavalo lista elokeszitese.

$vezerlo = new HutoVezerlo($pdo);
$viewData = $vezerlo->kezeles();
if (!is_array($viewData)) {
    $viewData = [];
}

extract($viewData, EXTR_OVERWRITE);

include __DIR__ . '/../head.php';
?>

<!-- =========================
     FŐ OLDAL / LAYOUT
     - Gradient háttér + központi konténer
========================= -->
<main class="min-h-screen bg-gradient-to-br from-[#9FB1A3] to-[#7F8F83]">
    <div class="max-w-7xl mx-auto py-6 px-4">

        <!-- =========================
             NAVIGÁCIÓ: vissza a receptekhez
        ========================= -->
        <a href="receptek.php"
           class="inline-flex items-center gap-2 mb-6 px-4 py-2 bg-white rounded-lg shadow hover:bg-gray-100 transition font-medium text-[#4A7043]">
            ← Vissza a receptekhez
        </a>

        <!-- =========================
             KERESŐ ŰRLAP
             - hozzávalók kiválasztása
             - minMatch beállítás
             - submit: találatok listázása
        ========================= -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 mb-8">
            <h1 class="text-4xl font-bold text-[#4A7043] mb-6">Mi található meg otthon?</h1>

            <form method="POST" action="">

                <!-- Keresőmező + számláló + "összes törlése" -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 mb-4">
                    <div class="relative flex-1 w-full">
                        <input type="text" id="hozzavaloKereses" placeholder="Hozzávaló keresése..."
                               class="w-full h-10 rounded-lg bg-transparent ring-2 ring-gray-300 px-4 pr-10 focus:ring-[#5A7863] focus:outline-none">
                        <svg class="absolute right-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="text-sm font-medium text-gray-600">
                            Kiválasztva: <span id="kivalasztottSzamlalo" class="font-bold text-[#4A7043]">0</span>
                        </span>
                        <button type="button" id="mindTorles"
                                class="text-xs text-red-600 hover:text-red-800 font-medium whitespace-nowrap">
                            Összes törlése
                        </button>
                    </div>
                </div>

                <!-- Minimum egyezés -->
                <div class="flex items-center gap-2 mb-4">
                    <label for="minMatch" class="text-sm font-medium text-gray-600">Minimum egyező hozzávaló:</label>
                    <select name="minMatch" id="minMatch"
                            class="h-9 rounded-lg ring-2 ring-gray-300 px-3 text-sm focus:ring-[#5A7863] focus:outline-none">
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <option value="<?= $i ?>" <?= $minMatch === $i ? 'selected' : '' ?>><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <!-- Hozzávaló lista -->
                <div id="hozzavaloLista"
                     class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 max-h-80 overflow-y-auto border p-4 rounded">

                    <?php foreach ($osszesHozzavalo as $hz): ?>
                        <label class="hozzavalo-label flex items-center gap-2 cursor-pointer p-2 hover:bg-gray-100 rounded transition"
                               data-nev="<?= mb_strtolower(htmlspecialchars($hz["Elnevezes"])) ?>">
                            <input type="checkbox"
                                   name="hozzavalok[]"
                                   value="<?= $hz["HozzavaloID"] ?>"
                                   class="hozzavalo-checkbox w-4 h-4 accent-[#5A7863]"
                                   <?= isset($kivalasztottSet[$hz["HozzavaloID"]]) ? 'checked' : '' ?>>
                            <span class="text-sm"><?= htmlspecialchars($hz["Elnevezes"]) ?></span>
                        </label>
                    <?php endforeach; ?>

                </div>

                <p id="nincsHozzavalo" class="hidden text-center text-gray-500 text-sm py-4">Nincs találat a keresésre.</p>

                <button type="submit"
                        class="mt-6 bg-[#6F837B] text-white font-bold py-3 px-8 rounded-lg hover:bg-[#5a6b64] transition">
                    Receptek keresése
                </button>

            </form>
        </div>

        <!-- =========================
             TALÁLATOK BLOKK (CSAK POST UTÁN)
        ========================= -->
        <?php if ($keresesTortent): ?>

            <div class="bg-white rounded-3xl shadow-2xl p-8">

                <?php if (empty($szurtReceptek)): ?>

                    <!-- Nincs találat -->
                    <div class="text-center py-12">
                        <div class="text-6xl mb-4">
                            <img src="<?= APP_BASE_URL ?>/assets/kepek/szomoruszakacshuto.png"
                                 alt="szomorú szakács"
                                 class="mx-auto w-24 h-24">
                        </div>
                        <h3 class="text-xl font-semibold text-gray-700">
                            Nincs megfelelő recept a kiválasztott hozzávalók alapján.
                        </h3>
                        <p class="text-gray-500 mt-2">
                            Próbálj több hozzávalót kiválasztani, vagy csökkentsd a minimum egyezés értékét.
                        </p>
                    </div>

                <?php else: ?>

                    <!-- Van találat -->
                    <h2 class="text-2xl font-bold text-[#4A7043] mb-6">
                        Talált receptek: <?= count($szurtReceptek) ?>
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                        <?php foreach ($szurtReceptek as $recept):
                            // Megvan/hiányzik listák összeállítása
                            $receptOsszesHz = $receptHozzavalok[$recept['ReceptID']] ?? [];
                            $megvanHozzavalok = [];
                            $hianyzoHozzavalok = [];

                            foreach ($receptOsszesHz as $hz) {
                                if (isset($kivalasztottSet[$hz['HozzavaloID']])) {
                                    $megvanHozzavalok[] = $hz['Elnevezes'];
                                } else {
                                    $hianyzoHozzavalok[] = $hz['Elnevezes'];
                                }
                            }

                            // Akkor tekintjuk teljesnek, ha a recepthez van hozzavalo lista,
                            // es abbol semmi nem hianyzik a kivalasztott (otthon levo) elemekhez kepest.
                            $mindenHozzavaloMegvan = !empty($receptOsszesHz) && empty($hianyzoHozzavalok);
                        ?>

                            <!-- Receptkártya -->
                            <a href="receptek.php?id=<?= (int)$recept["ReceptID"] ?>"
                               class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:scale-105">

                                <!-- Kép (PHP állítja elő a teljes útvonalat) -->
                                <div class="relative h-48">
                                    <img
                                        src="<?= htmlspecialchars(receptKepSrc($recept['Kep'] ?? '')) ?>"
                                        alt=""
                                        class="w-full h-full object-cover group-hover:scale-110 transition"
                                    >

                                    <?php if ($mindenHozzavaloMegvan): ?>
                                        <div class="absolute top-3 left-3 bg-emerald-600/95 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                                            ✓ Minden hozzávaló megvan
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Kártya tartalom -->
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-800 mb-2">
                                        <?= htmlspecialchars($recept["Nev"]) ?>
                                    </h3>

                                    <div class="flex justify-between text-sm text-gray-600 mb-3">
                                        <span>⏱ <?= formatIdo($recept["ElkeszitesiIdo"]) ?></span>
                                        <span><?= (int)$recept["Szint"] ?>. szint</span>
                                    </div>

                                    <?php if ($mindenHozzavaloMegvan): ?>
                                        <div class="mb-3 text-sm font-semibold text-emerald-700">
                                            Otthon minden hozzávaló rendelkezésre áll ehhez a recepthez.
                                        </div>
                                    <?php endif; ?>

                                    <!-- Megvan -->
                                    <?php if (!empty($megvanHozzavalok)): ?>
                                        <div class="mb-2">
                                            <p class="text-xs font-semibold text-green-700 mb-1">✓ Megvan:</p>
                                            <div class="flex flex-wrap gap-1">
                                                <?php foreach ($megvanHozzavalok as $nev): ?>
                                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full">
                                                        <?= htmlspecialchars($nev) ?>
                                                    </span>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Hiányzik -->
                                    <?php if (!empty($hianyzoHozzavalok)): ?>
                                        <div>
                                            <p class="text-xs font-semibold text-red-600 mb-1">✗ Hiányzik:</p>
                                            <div class="flex flex-wrap gap-1">
                                                <?php foreach ($hianyzoHozzavalok as $nev): ?>
                                                    <span class="text-xs bg-red-50 text-red-800 px-2 py-0.5 rounded-full">
                                                        <?= htmlspecialchars($nev) ?>
                                                    </span>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </a>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>
</main>

<!--hutom.js: kereső (filter), számláló frissítés, összes törlése -->
<script src="../../assets/js/hutom.js"></script>

<?php require_once "../footer.php"; ?>