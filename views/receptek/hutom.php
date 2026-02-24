<?php

require_once "../head.php";

/* =========================
   ADATBÁZIS
========================= */
$pdo = new PDO(
    "mysql:host=localhost;dbname=cookquest;charset=utf8mb4",
    "root",
    "",
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);

/* =========================
   SEGÉDFÜGGVÉNY
========================= */
function formatIdo($ido)
{
    $parts = explode(':', $ido);
    if (count($parts) < 2) return $ido;

    $ora = (int)$parts[0];
    $perc = (int)$parts[1];

    if ($ora > 0) return $ora . " óra" . ($perc > 0 ? " $perc perc" : "");
    if ($perc > 0) return "$perc perc";

    return "kevesebb mint 1 perc";
}

/* =========================
   ÖSSZES HOZZÁVALÓ
========================= */
$osszesHozzavalo = $pdo->query("
    SELECT HozzavaloID, Elnevezes 
    FROM hozzavalo
    ORDER BY Elnevezes
")->fetchAll();

/* =========================
   SZŰRÉS
========================= */
$szurtReceptek = [];
$kivalasztott = [];
$minMatch = isset($_POST["minMatch"]) ? max(1, (int)$_POST["minMatch"]) : 3;

// Recept hozzávalók tárolása az egyezés részletezéséhez
$receptHozzavalok = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $kivalasztott = $_POST["hozzavalok"] ?? [];

    if (!empty($kivalasztott)) {

        $placeholders = implode(",", array_fill(0, count($kivalasztott), "?"));

        $sql = "
            SELECT 
                r.ReceptID,
                r.Nev,
                TRIM(r.Kep) AS Kep,
                r.ElkeszitesiIdo,
                n.Szint,
                COUNT(DISTINCT rh.HozzavaloID) AS egyezo_db
            FROM recept r
            JOIN recept_hozzavalo rh ON r.ReceptID = rh.ReceptID
            JOIN nehezsegiszint n ON r.NehezsegiSzintID = n.NehezsegiSzintID
            WHERE rh.HozzavaloID IN ($placeholders)
            GROUP BY r.ReceptID
            HAVING egyezo_db >= ?
            ORDER BY egyezo_db DESC
        ";

        $stmt = $pdo->prepare($sql);

        $params = $kivalasztott;
        $params[] = $minMatch;

        $stmt->execute($params);
        $szurtReceptek = $stmt->fetchAll();

        // Minden talált recepthez lekérdezzük az összes hozzávalóját
        if (!empty($szurtReceptek)) {
            $receptIdk = array_column($szurtReceptek, 'ReceptID');
            $phReceptek = implode(",", array_fill(0, count($receptIdk), "?"));

            $stmtHz = $pdo->prepare("
                SELECT rh.ReceptID, h.HozzavaloID, h.Elnevezes
                FROM recept_hozzavalo rh
                JOIN hozzavalo h ON rh.HozzavaloID = h.HozzavaloID
                WHERE rh.ReceptID IN ($phReceptek)
                ORDER BY h.Elnevezes
            ");
            $stmtHz->execute($receptIdk);

            foreach ($stmtHz->fetchAll() as $sor) {
                $receptHozzavalok[$sor['ReceptID']][] = $sor;
            }
        }
    }
}

// Kiválasztott hozzávalók set-je a gyors kereséshez
$kivalasztottSet = array_flip($kivalasztott);
?>

<main class="min-h-screen bg-gradient-to-br from-[#9FB1A3] to-[#7F8F83]">
    <div class="max-w-7xl mx-auto py-6 px-4">

        <a href="receptek.php"
            class="inline-flex items-center gap-2 mb-6 px-4 py-2 bg-white rounded-lg shadow hover:bg-gray-100 transition font-medium text-[#4A7043]">
            ← Vissza a receptekhez
        </a>

        <div class="bg-white rounded-3xl shadow-2xl p-8 mb-8">
            <h1 class="text-4xl font-bold text-[#4A7043] mb-6">Mi van a hűtőmben?</h1>

            <form method="POST" action="">

                <!-- Keresőmező + számláló + törlés -->
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

                <!-- Minimum egyezés beállítás -->
                <div class="flex items-center gap-2 mb-4">
                    <label for="minMatch" class="text-sm font-medium text-gray-600">Minimum egyező hozzávaló:</label>
                    <select name="minMatch" id="minMatch" class="h-9 rounded-lg ring-2 ring-gray-300 px-3 text-sm focus:ring-[#5A7863] focus:outline-none">
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <option value="<?= $i ?>" <?= $minMatch === $i ? 'selected' : '' ?>><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <!-- Hozzávaló lista -->
                <div id="hozzavaloLista" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 max-h-80 overflow-y-auto border p-4 rounded">

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

        <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>

            <div class="bg-white rounded-3xl shadow-2xl p-8">

                <?php if (empty($szurtReceptek)): ?>

                    <div class="text-center py-12">
                        <div class="text-6xl mb-4">
                            <img src="../../assets/kepek/szomoruszakacshuto.png" alt="szomorú szakács" class="mx-auto w-24 h-24">
                        </div>
                        <h3 class="text-xl font-semibold text-gray-700">
                            Nincs megfelelő recept a kiválasztott hozzávalók alapján.
                        </h3>
                        <p class="text-gray-500 mt-2">Próbálj több hozzávalót kiválasztani, vagy csökkentsd a minimum egyezés értékét.</p>
                    </div>

                <?php else: ?>

                    <h2 class="text-2xl font-bold text-[#4A7043] mb-6">
                        Talált receptek: <?= count($szurtReceptek) ?>
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                        <?php foreach ($szurtReceptek as $recept):
                            // Egyezés részletezése
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
                            $osszesDb = count($receptOsszesHz);
                            $egyezoDb = (int)$recept['egyezo_db'];
                            $szazalek = $osszesDb > 0 ? round(($egyezoDb / $osszesDb) * 100) : 0;
                        ?>

                            <a href="receptek.php?id=<?= $recept["ReceptID"] ?>"
                                class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:scale-105">

                                <div class="relative h-48">
                                    <img src="<?= htmlspecialchars($recept["Kep"]) ?>"
                                        class="w-full h-full object-cover group-hover:scale-110 transition">

                                    
                                </div>                             

                                <div class="p-4">
                                    <h3 class="font-bold text-gray-800 mb-2">
                                        <?= htmlspecialchars($recept["Nev"]) ?>
                                    </h3>

                                    <div class="flex justify-between text-sm text-gray-600 mb-3">
                                        <span>⏱ <?= formatIdo($recept["ElkeszitesiIdo"]) ?></span>
                                        <span><?= $recept["Szint"] ?>. szint</span>
                                    </div>

                                    <!-- Megvan / hiányzik részletezés -->
                                    <?php if (!empty($megvanHozzavalok)): ?>
                                        <div class="mb-2">
                                            <p class="text-xs font-semibold text-green-700 mb-1">✓ Megvan:</p>
                                            <div class="flex flex-wrap gap-1">
                                                <?php foreach ($megvanHozzavalok as $nev): ?>
                                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full"><?= htmlspecialchars($nev) ?></span>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($hianyzoHozzavalok)): ?>
                                        <div>
                                            <p class="text-xs font-semibold text-red-600 mb-1">✗ Hiányzik:</p>
                                            <div class="flex flex-wrap gap-1">
                                                <?php foreach ($hianyzoHozzavalok as $nev): ?>
                                                    <span class="text-xs bg-red-50 text-red-800 px-2 py-0.5 rounded-full"><?= htmlspecialchars($nev) ?></span>
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

<script src="../../assets/js/hutom.js"></script>


<?php require_once "../footer.php"; ?>
