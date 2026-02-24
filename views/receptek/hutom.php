<?php
/* =========================
   KÖZÖS FEJLÉC / LAYOUT BETÖLTÉSE
   - Tartalmazhat: HTML head, navigáció, Tailwind importok, közös stílusok
   - Itt érdemes központosítani a shared elemeket
========================= */
require_once "../head.php";

/* =========================
   ADATBÁZIS KAPCSOLÓDÁS
   - PDO használata: hibakezelés, biztonságos lekérdezések (prepared statement)
   - utf8mb4: ékezetek / speciális karakterek támogatása
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
   SEGÉDFÜGGVÉNYEK (FORMÁZÁS)
   - formatIdo(): "HH:MM:SS" / "HH:MM" -> "x óra y perc"
   - UI szempont: rövidebb, emberi formátum
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
   KÉP ÚTVONAL KEZELÉS (DB-ben csak FÁJLNÉV)
   CÉL:
   - A DB "Kep" mezőbe ideálisan csak fájlnév kerül: pl. "BundasKenyer.webp"
   - A teljes URL-t a PHP állítja elő: /CookQuest/assets/kepek/etelek/ + fájlnév

   MIÉRT JÓ EZ?
   - DB-ben nincs hardcode-olt útvonal (könnyebb karbantartás)
   - Biztonságosabb: nem lehet útvonal-traverzálással trükközni
   - Ha hiányzik a kép: placeholder-t adunk vissza, nem törött képet
========================= */
define('APP_BASE_URL', '/CookQuest'); // projekt gyökér URL (XAMPP alatt: /CookQuest)
define('RECIPE_IMG_URL', APP_BASE_URL . '/assets/kepek/etelek/'); // recept képek URL mappája
define('RECIPE_IMG_PLACEHOLDER', 'placeholder.webp'); // fallback kép

// Fizikai mappa (is_file ellenőrzéshez) -> document_root + URL útvonal
define('RECIPE_IMG_DIR', rtrim($_SERVER['DOCUMENT_ROOT'], '/\\') . RECIPE_IMG_URL);

/**
 * receptKepSrc():
 * - Be: DB-ből jövő Kep mező (fájlnév vagy akár régi útvonal)
 * - Ki: egy biztonságos, létező kép URL vagy placeholder
 *
 * Védelmi lépések:
 * - basename(): ha a DB-ben még régi útvonal van, levágja a könyvtárakat
 * - whitelist regex: csak normális fájlnév + képkiterjesztés engedett
 * - is_file(): ha nincs fájl, placeholder-t adunk
 * - rawurlencode(): URL-ben biztonságos kódolás
 */
function receptKepSrc(?string $dbKep): string
{
    $dbKep = trim((string)$dbKep);

    // Üres érték -> placeholder
    if ($dbKep === '') {
        return RECIPE_IMG_URL . RECIPE_IMG_PLACEHOLDER;
    }

    // Útvonal -> csak fájlnév
    $file = basename($dbKep);

    // Whitelist: nincs ../, nincs szóköz, csak engedélyezett kiterjesztések
    if (!preg_match('/^[a-zA-Z0-9._-]+\.(webp|png|jpg|jpeg)$/i', $file)) {
        return RECIPE_IMG_URL . RECIPE_IMG_PLACEHOLDER;
    }

    // Ha fizikailag nincs meg, placeholder
    if (!is_file(RECIPE_IMG_DIR . $file)) {
        return RECIPE_IMG_URL . RECIPE_IMG_PLACEHOLDER;
    }

    // OK -> kép URL
    return RECIPE_IMG_URL . rawurlencode($file);
}

/* =========================
   ÖSSZES HOZZÁVALÓ LEKÉRDEZÉSE
   - A checkbox lista feltöltéséhez
   - ABC sorrend: gyorsabb használhatóság + keresés
========================= */
$osszesHozzavalo = $pdo->query("
    SELECT HozzavaloID, Elnevezes 
    FROM hozzavalo
    ORDER BY Elnevezes
")->fetchAll();

/* =========================
   SZŰRÉS ÁLLAPOT / POST KEZELÉS
   - $kivalasztott: a user által bepipált hozzávalók (ID-k)
   - $minMatch: minimum egyező hozzávaló receptenként
   - $szurtReceptek: találatok listája
   - $receptHozzavalok: találatokhoz extra részletezéshez (megvan/hiányzik)
========================= */
$szurtReceptek = [];
$kivalasztott = [];
$minMatch = isset($_POST["minMatch"]) ? max(1, (int)$_POST["minMatch"]) : 3;

// ReceptID -> hozzávalók listája (részletezéshez)
$receptHozzavalok = [];

/* =========================
   POST: RECEPT KERESÉS HOZZÁVALÓK ALAPJÁN
   Logika:
   1) Kiválasztott hozzávaló ID-k alapján lekérdezzük azokat a recepteket,
      ahol a recept_hozzavalo táblában legalább $minMatch egyezés van.
   2) Minden talált recepthez lekérjük az összes hozzávalóját, hogy UI-ban
      megmutathassuk: mi van meg / mi hiányzik.
========================= */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $kivalasztott = $_POST["hozzavalok"] ?? [];

    if (!empty($kivalasztott)) {

        // Dinamikus IN (...) helyőrzők
        $placeholders = implode(",", array_fill(0, count($kivalasztott), "?"));

        // 1) Találatok (egyező hozzávalók száma)
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

        // Paraméterek: hozzávaló ID-k + végén minMatch
        $params = $kivalasztott;
        $params[] = $minMatch;

        $stmt->execute($params);
        $szurtReceptek = $stmt->fetchAll();

        // 2) Részletezéshez: összes hozzávaló minden talált recepthez
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

/* =========================
   GYORS KERESÉSHEZ SET
   - array_flip(): O(1) lookup, hogy egy hozzávaló ki van-e választva
========================= */
$kivalasztottSet = array_flip($kivalasztott);
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
            <h1 class="text-4xl font-bold text-[#4A7043] mb-6">Mi van a hűtőmben?</h1>

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
        <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>

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

<!-- =========================
     KLIENSOLDALI JS
     - hutom.js: kereső (filter), számláló frissítés, összes törlése
     - A képutakhoz NEM kell JS, azt PHP már előállítja
========================= -->
<script src="../../assets/js/hutom.js"></script>

<?php require_once "../footer.php"; ?>