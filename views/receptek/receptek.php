<?php
session_start();

/* =========================
   ADATBÁZIS KAPCSOLÓDÁS (PDO)
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
   SEGÉDFÜGGVÉNYEK
========================= */
function formatIdo($ido_str)
{
    $parts = explode(':', $ido_str);
    if (count($parts) < 2) return $ido_str;

    $ora = (int)$parts[0];
    $perc = (int)$parts[1];

    if ($ora > 0) return "$ora óra" . ($perc > 0 ? " $perc perc" : "");
    if ($perc > 0) return "$perc perc";

    return "kevesebb mint 1 perc";
}

function formatMennyiseg($mennyiseg)
{
    if (floor($mennyiseg) == $mennyiseg) return (int)$mennyiseg;
    return rtrim(rtrim(number_format($mennyiseg, 2, '.', ''), '0'), '.');
}

/* =========================
   KÉP ÚTVONAL ÖSSZERAKÁS
========================= */
define('APP_BASE_URL', '/CookQuest');
define('RECIPE_IMG_URL', APP_BASE_URL . '/assets/kepek/etelek/');
define('RECIPE_IMG_PLACEHOLDER', 'placeholder.webp');
define('RECIPE_IMG_DIR', rtrim($_SERVER['DOCUMENT_ROOT'], '/\\') . RECIPE_IMG_URL);

function receptKepSrc(?string $dbKep): string
{
    $dbKep = trim((string)$dbKep);

    if ($dbKep === '') {
        return RECIPE_IMG_URL . RECIPE_IMG_PLACEHOLDER;
    }

    // DB-ben néha útvonal + \n -> levágjuk
    $file = trim(basename($dbKep));

    if (!preg_match('/^[a-zA-Z0-9._-]+\.(webp|png|jpg|jpeg)$/i', $file)) {
        return RECIPE_IMG_URL . RECIPE_IMG_PLACEHOLDER;
    }

    if (!is_file(RECIPE_IMG_DIR . $file)) {
        return RECIPE_IMG_URL . RECIPE_IMG_PLACEHOLDER;
    }

    return RECIPE_IMG_URL . rawurlencode($file);
}

/* =========================
   URL PARAMÉTER
========================= */
$receptId = isset($_GET['id']) ? (int)$_GET['id'] : null;

/* =========================
   CSRF TOKEN
========================= */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* =========================
   BEJELENTKEZETT USER ID
   (NÁLAD EZ A KULCS!)
========================= */
$felhasznaloId = (int)($_SESSION['felhasznalo_id'] ?? 0);

/* =========================
   "ELKÉSZÍTETTEM" POST KEZELÉS
   - PRG + status=... (1 féle hibakezelés)
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'elkeszitettem') {

    $postReceptId = (int)($_POST['recept_id'] ?? 0);

    if ($felhasznaloId <= 0) {
        header("Location: receptek.php?id={$postReceptId}&status=login");
        exit;
    }

    if (!hash_equals($_SESSION['csrf_token'], (string)($_POST['csrf_token'] ?? ''))) {
        header("Location: receptek.php?id={$postReceptId}&status=csrf");
        exit;
    }

    if ($postReceptId <= 0) {
        header("Location: receptek.php?status=badreq");
        exit;
    }

    try {
        $pdo->beginTransaction();

        // recept pont
        $st = $pdo->prepare("SELECT BegyujthetoPontok FROM recept WHERE ReceptID = ? LIMIT 1");
        $st->execute([$postReceptId]);
        $pont = (int)$st->fetchColumn();

        if ($pont <= 0) {
            $pdo->rollBack();
            header("Location: receptek.php?id={$postReceptId}&status=nopoint");
            exit;
        }

        // már elkészítette?
        $st = $pdo->prepare("
            SELECT COALESCE(Elkeszitette,0) AS Elkeszitette
            FROM felhasznalo_recept
            WHERE FelhasznaloID = ? AND ReceptID = ?
            LIMIT 1
        ");
        $st->execute([$felhasznaloId, $postReceptId]);
        $row = $st->fetch();

        if ($row && (int)$row['Elkeszitette'] === 1) {
            $pdo->commit();
            header("Location: receptek.php?id={$postReceptId}&status=already");
            exit;
        }

        // insert vagy update
        if (!$row) {
            $st = $pdo->prepare("
                INSERT INTO felhasznalo_recept (FelhasznaloID, ReceptID, Elkeszitette, KedvencReceptek)
                VALUES (?, ?, 1, 0)
            ");
            $st->execute([$felhasznaloId, $postReceptId]);
        } else {
            $st = $pdo->prepare("
                UPDATE felhasznalo_recept
                SET Elkeszitette = 1
                WHERE FelhasznaloID = ? AND ReceptID = ?
            ");
            $st->execute([$felhasznaloId, $postReceptId]);
        }

        // pont jóváírás
        $st = $pdo->prepare("
            UPDATE felhasznalo
            SET MegszerzettPontok = COALESCE(MegszerzettPontok,0) + ?
            WHERE FelhasznaloID = ?
        ");
        $st->execute([$pont, $felhasznaloId]);

        $pdo->commit();

        header("Location: receptek.php?id={$postReceptId}&status=ok");
        exit;

    } catch (PDOException $e) {
        if ($pdo->inTransaction()) $pdo->rollBack();
        header("Location: receptek.php?id={$postReceptId}&status=dberr");
        exit;
    }
}

/* =========================
   AKTUÁLIS PONTOK (felső kijelzéshez)
========================= */
$aktualisPontok = null;
if ($felhasznaloId > 0) {
    $st = $pdo->prepare("SELECT MegszerzettPontok FROM felhasznalo WHERE FelhasznaloID = ?");
    $st->execute([$felhasznaloId]);
    $aktualisPontok = (int)$st->fetchColumn();
}

/* =========================
   ÖSSZES RECEPT LEKÉRDEZÉS (lista)
========================= */
$receptek = $pdo->query("
    SELECT 
        r.ReceptID, r.Nev, r.Kep, r.ElkeszitesiIdo, r.BegyujthetoPontok, 
        r.Elkeszitesi_leiras, n.Szint, 
        kat.Kategoria AS FoKategoriaNev, 
        alk.Alkategoria AS AlkategoriaNev, 
        a.Arkategoria AS ArkategoriaNev 
    FROM recept r 
    INNER JOIN nehezsegiszint n ON r.NehezsegiSzintID = n.NehezsegiSzintID 
    LEFT JOIN alkategoria alk ON r.AlkategoriaID = alk.AlkategoriaID 
    LEFT JOIN kategoria kat ON alk.KategoriaID = kat.KategoriaID 
    LEFT JOIN arkategoria a ON r.ArkategoriaID = a.ArkategoriaID 
    ORDER BY n.Szint, r.Nev
")->fetchAll();

/* =========================
   CSOPORTOSÍTÁS SZINTEK SZERINT
========================= */
$receptekSzintekSzerint = [];
foreach ($receptek as $r) {
    $szint = $r['Szint'];
    if (!isset($receptekSzintekSzerint[$szint])) $receptekSzintekSzerint[$szint] = [];
    $receptekSzintekSzerint[$szint][] = $r;
}

/* =========================
   KATEGÓRIÁK A SZŰRŐHÖZ
========================= */
$kategoriaCheckboxok = [];
foreach ($receptek as $r) {
    $foKat = $r['FoKategoriaNev'] ?? 'Nem kategorizált';
    $alKat = $r['AlkategoriaNev'] ?? 'Egyéb';
    if (!isset($kategoriaCheckboxok[$foKat])) $kategoriaCheckboxok[$foKat] = [];
    if (!in_array($alKat, $kategoriaCheckboxok[$foKat], true)) {
        $kategoriaCheckboxok[$foKat][] = $alKat;
    }
}

/* =========================
   KONKRÉT RECEPT + HOZZÁVALÓK
========================= */
$recept = null;
$hozzavalok = [];
$marElkeszitette = false;

if ($receptId) {
    $st = $pdo->prepare("
        SELECT 
            r.*, n.Szint, a.Arkategoria AS ArkategoriaNev, 
            kat.Kategoria AS FoKategoriaNev, alk.Alkategoria AS AlkategoriaNev 
        FROM recept r 
        JOIN nehezsegiszint n ON r.NehezsegiSzintID = n.NehezsegiSzintID 
        LEFT JOIN arkategoria a ON r.ArkategoriaID = a.ArkategoriaID 
        LEFT JOIN alkategoria alk ON r.AlkategoriaID = alk.AlkategoriaID 
        LEFT JOIN kategoria kat ON alk.KategoriaID = kat.KategoriaID 
        WHERE r.ReceptID = ?
    ");
    $st->execute([$receptId]);
    $recept = $st->fetch();

    $st = $pdo->prepare("
        SELECT 
            h.Elnevezes, rh.Mennyiseg, m.Elnevezes AS Mertekegyseg 
        FROM recept_hozzavalo rh 
        JOIN hozzavalo h ON rh.HozzavaloID = h.HozzavaloID 
        JOIN mertekegyseg m ON rh.MertekegysegID = m.MertekegysegID 
        WHERE rh.ReceptID = ?
    ");
    $st->execute([$receptId]);
    $hozzavalok = $st->fetchAll();

    if ($felhasznaloId > 0) {
        $st = $pdo->prepare("
            SELECT COALESCE(Elkeszitette,0)
            FROM felhasznalo_recept
            WHERE FelhasznaloID = ? AND ReceptID = ?
            LIMIT 1
        ");
        $st->execute([$felhasznaloId, $receptId]);
        $marElkeszitette = ((int)$st->fetchColumn() === 1);
    }
}

/* =========================
   KÖZÖS FEJLÉC / LAYOUT
   (Csak most, hogy a POST redirectek biztosan működjenek)
========================= */
include "../head.php";
?>

<main class="min-h-screen bg-gradient-to-br from-[#9FB1A3] to-[#7F8F83]">
    <div class="max-w-7xl mx-auto py-6 px-4">

        <?php if ($aktualisPontok !== null): ?>
            <div class="mb-4 flex justify-end">
                <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur px-4 py-2 rounded-xl shadow">
                    <span class="font-semibold text-gray-700">Pontjaid:</span>
                    <span class="font-bold text-[#4A7043]"><?= (int)$aktualisPontok ?></span>
                </div>
            </div>
        <?php endif; ?>

        <button id="mobilSidebarToggle" type="button" class="lg:hidden fixed top-4 left-4 z-50 bg-white p-3 rounded-full shadow-lg">
            <svg class="w-6 h-6 text-[#4A7043]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <?php if (!$recept): ?>
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row gap-4 mb-4">
                    <button id="szuroGomb" type="button" class="bg-white px-6 py-3 rounded-xl shadow-lg flex items-center gap-2 font-semibold text-[#4A7043] hover:bg-gray-50 transition w-full sm:w-auto">
                        <span>Szűrő</span>
                        <span id="szuroSzamlalo" class="hidden bg-[#6F837B] text-white text-xs px-2 py-1 rounded-full">0</span>
                        <svg id="szuroNyil" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <a href="hutom.php" class="bg-white px-6 py-3 rounded-xl shadow-lg flex items-center gap-2 font-semibold text-[#4A7043] hover:bg-gray-50 transition w-full sm:w-auto justify-center">
                        <span>🧊 Mi van a hűtőmben?</span>
                    </a>
                </div>

                <div id="szuroPanel" class="hidden mt-4 bg-white rounded-2xl shadow-2xl p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="font-bold text-gray-800 flex items-center gap-2">Szűrő</h4>
                        <button id="szuroReset" type="button" class="text-xs text-red-600 hover:text-red-800 font-medium">Szűrők alaphelyzetbe</button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <?php foreach ($kategoriaCheckboxok as $foKat => $alkategoriak): ?>
                            <div class="kategoria-csoport">
                                <div class="flex items-center gap-2 mb-3 pb-2 border-b border-gray-100">
                                    <label class="text-xs font-bold text-gray-800 cursor-pointer uppercase tracking-widest">
                                        <?= htmlspecialchars($foKat) ?>
                                    </label>
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    <?php foreach ($alkategoriak as $alKat): ?>
                                        <label class="inline-block cursor-pointer">
                                            <input type="checkbox" class="kategoriaCheckbox peer sr-only"
                                                data-fokategoria="<?= htmlspecialchars($foKat) ?>"
                                                data-alkategoria="<?= htmlspecialchars($alKat) ?>">
                                            <span class="inline-block px-4 py-2 rounded-xl bg-gray-100 text-gray-600 text-sm font-medium transition peer-checked:bg-[#6F837B] peer-checked:text-white">
                                                <?= htmlspecialchars($alKat) ?>
                                            </span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        <?php endif; ?>

        <div class="flex flex-col lg:flex-row lg:gap-8">

            <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-80 bg-white shadow-2xl transform -translate-x-full lg:translate-x-0 lg:sticky lg:top-6 lg:h-[calc(100vh-1.5rem)] lg:w-[280px] lg:overflow-y-auto transition-transform duration-300 rounded-r-2xl lg:rounded-2xl">
                <div class="p-5">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="text-xl font-bold text-[#3F3D56]">Receptkönyv</h2>
                        <button id="mobilSidebarClose" type="button" class="lg:hidden text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <?php foreach ($receptekSzintekSzerint as $szint => $lista): ?>
                        <div class="mb-4">
                            <button type="button" class="w-full text-left flex items-center justify-between py-2 px-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition szint-sav-cim">
                                <span class="font-semibold text-[#4A7043]">
                                    <?= (int)$szint ?>. szint (<span class="szint-darab" data-szint="<?= (int)$szint ?>"><?= count($lista) ?></span>)
                                </span>
                                <svg class="w-5 h-5 transition-transform sav-nyil" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <ul class="szint-sav-tartalom hidden mt-2 space-y-1 pl-4">
                                <?php foreach ($lista as $r): ?>
                                    <li class="sidebar-recept-item" data-recept-id="<?= (int)$r['ReceptID'] ?>">
                                        <a href="receptek.php?id=<?= (int)$r['ReceptID'] ?>"
                                            class="block px-3 py-1.5 rounded-lg text-sm transition <?= ($receptId == (int)$r['ReceptID']) ? 'bg-[#6F837B] text-white' : 'hover:bg-[#95A792]/20 text-gray-700' ?>">
                                            <div class="font-medium"><?= htmlspecialchars($r['Nev']) ?></div>
                                            <div class="text-xs opacity-80"><?= formatIdo($r['ElkeszitesiIdo']) ?></div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            </aside>

            <section id="receptekTarolo" class="flex-1">

                <?php if (!$recept): ?>

                    <h1 class="text-4xl font-bold text-white mb-8">Receptek</h1>

                    <div id="nincsEredmeny" class="hidden bg-white rounded-2xl shadow-xl p-12 text-center">
                        <div class="text-6xl mb-4">🔍</div>
                        <h3 class="text-xl font-semibold text-gray-700">Nincs ilyen recept...</h3>
                    </div>

                    <?php foreach ($receptekSzintekSzerint as $szint => $lista): ?>
                        <div class="mb-16 szint-blokk" data-szint="<?= (int)$szint ?>">
                            <h2 class="text-3xl font-bold text-white mb-6 border-b border-white/40 pb-3">
                                <?= (int)$szint ?>. szint – <span class="szint-darab-fo" data-szint="<?= (int)$szint ?>"><?= count($lista) ?></span> recept
                            </h2>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                <?php foreach ($lista as $r): ?>
                                    <a href="receptek.php?id=<?= (int)$r['ReceptID'] ?>"
                                        class="recept-kartya bg-white rounded-2xl shadow-xl overflow-hidden hover:-translate-y-1 transition block"
                                        data-recept-id="<?= (int)$r['ReceptID'] ?>"
                                        data-nev="<?= mb_strtolower(htmlspecialchars($r['Nev'])) ?>"
                                        data-fokategoria="<?= htmlspecialchars($r['FoKategoriaNev'] ?? 'Nem kategorizált') ?>"
                                        data-alkategoria="<?= htmlspecialchars($r['AlkategoriaNev'] ?? 'Egyéb') ?>">

                                        <img src="<?= htmlspecialchars(receptKepSrc($r['Kep'])) ?>" class="w-full h-48 object-cover" alt="">

                                        <div class="p-5">
                                            <div class="flex justify-between text-xs text-gray-500 mb-2 font-semibold">
                                                <span class="text-[#6F837B] uppercase"><?= htmlspecialchars($r['AlkategoriaNev'] ?? 'Egyéb') ?></span>
                                                <span>⭐ <?= (int)$r['BegyujthetoPontok'] ?> pont</span>
                                            </div>
                                            <h2 class="text-lg font-bold mb-2 text-gray-800"><?= htmlspecialchars($r['Nev']) ?></h2>
                                            <div class="flex justify-between text-sm text-gray-600">
                                                <span>⏱ <?= formatIdo($r['ElkeszitesiIdo']) ?></span>
                                                <span>💰 <?= htmlspecialchars($r['ArkategoriaNev'] ?? 'Nincs') ?></span>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                <?php else: ?>

                    <a href="receptek.php" class="inline-flex items-center gap-2 mb-6 px-4 py-2 bg-white rounded-lg shadow hover:bg-gray-100 transition font-medium text-[#4A7043]">
                        ← Vissza a receptekhez
                    </a>

                    <?php if (isset($_GET['status'])): ?>
                        <?php if ($_GET['status'] === 'ok'): ?>
                            <div class="mb-4 bg-green-100 text-green-800 px-4 py-3 rounded-xl font-medium">✅ Pont jóváírva!</div>
                        <?php elseif ($_GET['status'] === 'already'): ?>
                            <div class="mb-4 bg-yellow-100 text-yellow-800 px-4 py-3 rounded-xl font-medium">⚠️ Ezt már jóváírtuk.</div>
                        <?php elseif ($_GET['status'] === 'login'): ?>
                            <div class="mb-4 bg-red-100 text-red-800 px-4 py-3 rounded-xl font-medium">❌ Jelentkezz be a pontokért.</div>
                        <?php else: ?>
                            <div class="mb-4 bg-red-100 text-red-800 px-4 py-3 rounded-xl font-medium">❌ Hiba: <?= htmlspecialchars($_GET['status']) ?></div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                        <div class="relative h-80">

                            <img src="<?= htmlspecialchars(receptKepSrc($recept['Kep'] ?? '')) ?>" class="absolute inset-0 w-full h-full object-cover" alt="">
                            <div class="absolute inset-0 bg-black/40"></div>

                            <div class="absolute bottom-6 left-8 text-white">
                                <h1 class="text-4xl font-bold mb-3"><?= htmlspecialchars($recept['Nev']) ?></h1>
                                <div class="flex flex-wrap gap-3 text-sm">
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full">⏱ <?= formatIdo($recept['ElkeszitesiIdo']) ?></span>
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full">⭐ <?= (int)$recept['BegyujthetoPontok'] ?> pont</span>
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full">🏷 <?= htmlspecialchars($recept['AlkategoriaNev'] ?? '') ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="p-8 grid grid-cols-1 lg:grid-cols-[350px_1fr] gap-8">

                            <div class="bg-[#F3F4F1] rounded-2xl p-6 h-fit">
                                <h2 class="text-xl font-bold mb-4 text-[#4A7043] flex items-center gap-2">Hozzávalók</h2>
                                <ul class="space-y-3 text-sm">
                                    <?php foreach ($hozzavalok as $h): ?>
                                        <li class="flex gap-2 items-start">
                                            <span class="font-bold text-[#6F837B] min-w-[30px]"><?= formatMennyiseg($h['Mennyiseg']) ?> <?= htmlspecialchars($h['Mertekegyseg']) ?></span>
                                            <span class="text-gray-700"><?= htmlspecialchars($h['Elnevezes']) ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div>
                                <h2 class="text-xl font-bold mb-6 flex items-center gap-2">Elkészítés menete</h2>
                                <ol class="space-y-6 text-gray-700">
                                    <?php
                                    $lepesek = explode("\n", $recept['Elkeszitesi_leiras'] ?? '');
                                    $i = 1;
                                    foreach ($lepesek as $lepes):
                                        if (trim($lepes) === '') continue;
                                    ?>
                                        <li class="flex gap-4 group">
                                            <span class="w-8 h-8 flex items-center justify-center shrink-0 rounded-full bg-[#6F837B] text-white text-sm font-bold">
                                                <?= $i++ ?>
                                            </span>
                                            <p class="leading-relaxed pt-1"><?= htmlspecialchars($lepes) ?></p>
                                        </li>
                                    <?php endforeach; ?>
                                </ol>

                                <div class="mt-12 flex justify-end">
                                    <?php if ($felhasznaloId <= 0): ?>
                                        <a href="/CookQuest/views/felhasznalo/login.php"
                                           class="bg-[#4A7043] text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:bg-[#3d5c37] transition-all">
                                            Jelentkezz be a pontokért
                                        </a>
                                    <?php else: ?>

                                        <?php if ($marElkeszitette): ?>
                                            <button type="button"
                                                    class="bg-gray-300 text-gray-600 px-8 py-3 rounded-xl font-bold shadow-lg cursor-not-allowed"
                                                    disabled>
                                                Már jóváírva ✅
                                            </button>
                                        <?php else: ?>
                                            <form method="post" action="receptek.php?id=<?= (int)$receptId ?>">
                                                <input type="hidden" name="action" value="elkeszitettem">
                                                <input type="hidden" name="recept_id" value="<?= (int)$receptId ?>">
                                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

                                                <button type="submit"
                                                        class="bg-[#4A7043] text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:bg-[#3d5c37] transition-all transform hover:scale-105">
                                                    Elkészítettem!
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>

                <?php endif; ?>
            </section>
        </div>
    </div>
</main>

<script src="../../assets/js/receptek.js"></script>

<?php include "../footer.php"; ?>