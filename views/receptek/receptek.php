<?php 
session_start();

include "../head.php";
/* ========================= ADATBÁZIS KAPCSOLÓDÁS ========================= */
$pdo = new PDO("mysql:host=localhost;dbname=cookquest;charset=utf8mb4", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

/* ========================= Segédfüggvények ========================= */
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

/* ========================= URL PARAMÉTER (ID) ========================= */
$receptId = isset($_GET['id']) ? (int)$_GET['id'] : null;

/* ========================= ÖSSZES RECEPT LEKÉRDEZÉSE ========================= */
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

/* ========================= RECEPTEK CSOPORTOSÍTÁSA SZINTEK SZERINT ========================= */
$receptekSzintekSzerint = [];
foreach ($receptek as $r) {
    $szint = $r['Szint'];
    if (!isset($receptekSzintekSzerint[$szint])) {
        $receptekSzintekSzerint[$szint] = [];
    }
    $receptekSzintekSzerint[$szint][] = $r;
}

/* ========================= KATEGÓRIÁK GYŰJTÉSE A SZŰRŐHÖZ ========================= */
$kategoriaCheckboxok = [];
foreach ($receptek as $r) {
    $foKat = $r['FoKategoriaNev'] ?? 'Nem kategorizált';
    $alKat = $r['AlkategoriaNev'] ?? 'Egyéb';
    if (!isset($kategoriaCheckboxok[$foKat])) {
        $kategoriaCheckboxok[$foKat] = [];
    }
    if (!in_array($alKat, $kategoriaCheckboxok[$foKat])) {
        $kategoriaCheckboxok[$foKat][] = $alKat;
    }
}

/* ========================= EGY RECEPT ADATAI ========================= */
$recept = null;
$hozzavalok = [];
if ($receptId) {
    $stmt = $pdo->prepare("
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
    $stmt->execute([$receptId]);
    $recept = $stmt->fetch();

    $stmt = $pdo->prepare("
        SELECT 
            h.Elnevezes, rh.Mennyiseg, m.Elnevezes AS Mertekegyseg 
        FROM recept_hozzavalo rh 
        JOIN hozzavalo h ON rh.HozzavaloID = h.HozzavaloID 
        JOIN mertekegyseg m ON rh.MertekegysegID = m.MertekegysegID 
        WHERE rh.ReceptID = ?
    ");
    $stmt->execute([$receptId]);
    $hozzavalok = $stmt->fetchAll();
}
?>

<style>
    /* Tag alapú szűrő stílusa */
    .kat-tag-label {
        cursor: pointer;
        display: inline-block;
    }

    .kat-tag-input {
        display: none;
    }

    .kat-tag-text {
        display: inline-block;
        padding: 0.5rem 1rem;
        background-color: #f3f4f6;
        /* Világosszürke */
        color: #4b5563;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .kat-tag-input:checked+.kat-tag-text {
        background-color: #6F837B;
        /* Az eredeti kódodból vett zöldes szín */
        color: white;
    }
</style>

<main class="min-h-screen bg-gradient-to-br from-[#9FB1A3] to-[#7F8F83]">
    <div class="max-w-7xl mx-auto py-6 px-4">

        <button id="mobilSidebarToggle" class="lg:hidden fixed top-4 left-4 z-50 bg-white p-3 rounded-full shadow-lg">
            <svg class="w-6 h-6 text-[#4A7043]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <?php if (!$recept): ?>
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row gap-4 mb-4">
                    <button id="szuroGomb" class="bg-white px-6 py-3 rounded-xl shadow-lg flex items-center gap-2 font-semibold text-[#4A7043] hover:bg-gray-50 transition w-full sm:w-auto">
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
                        <h4 class="font-bold text-gray-800 flex items-center gap-2">
                            Szűrő
                        </h4>
                        <button id="szuroReset" class="text-xs text-red-600 hover:text-red-800 font-medium">Szűrők alaphelyzetbe</button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <?php foreach ($kategoriaCheckboxok as $foKat => $alkategoriak): ?>
                            <div class="kategoria-csoport">
                                <div class="flex items-center gap-2 mb-3 pb-2 border-b border-gray-100">
                                    <label for="foKat_<?= htmlspecialchars($foKat) ?>" class="text-xs font-bold text-gray-800 cursor-pointer uppercase tracking-widest">
                                        <?= htmlspecialchars($foKat) ?>
                                    </label>
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    <?php foreach ($alkategoriak as $alKat): ?>
                                        <label class="kat-tag-label">
                                            <input type="checkbox" class="kategoriaCheckbox kat-tag-input" data-fokategoria="<?= htmlspecialchars($foKat) ?>" data-alkategoria="<?= htmlspecialchars($alKat) ?>">
                                            <span class="kat-tag-text"><?= htmlspecialchars($alKat) ?></span>
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
                        <button id="mobilSidebarClose" class="lg:hidden text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <?php foreach ($receptekSzintekSzerint as $szint => $lista): ?>
                        <div class="mb-4">
                            <button class="w-full text-left flex items-center justify-between py-2 px-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition szint-sav-cim">
                                <span class="font-semibold text-[#4A7043]"><?= $szint ?>. szint (<span class="szint-darab" data-szint="<?= $szint ?>"><?= count($lista) ?></span>)</span>
                                <svg class="w-5 h-5 transition-transform sav-nyil" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <ul class="szint-sav-tartalom hidden mt-2 space-y-1 pl-4">
                                <?php foreach ($lista as $r): ?>
                                    <li class="sidebar-recept-item" data-recept-id="<?= $r['ReceptID'] ?>">
                                        <a href="receptek.php?id=<?= $r['ReceptID'] ?>" class="block px-3 py-1.5 rounded-lg text-sm transition <?= ($receptId == $r['ReceptID']) ? 'bg-[#6F837B] text-white' : 'hover:bg-[#95A792]/20 text-gray-700' ?>">
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
                        <div class="mb-16 szint-blokk" data-szint="<?= $szint ?>">
                            <h2 class="text-3xl font-bold text-white mb-6 border-b border-white/40 pb-3">
                                <?= $szint ?>. szint – <span class="szint-darab-fo" data-szint="<?= $szint ?>"><?= count($lista) ?></span> recept
                            </h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                <?php foreach ($lista as $r): ?>
                                    <a href="receptek.php?id=<?= $r['ReceptID'] ?>"
                                        class="recept-kartya bg-white rounded-2xl shadow-xl overflow-hidden hover:-translate-y-1 transition block"
                                        data-recept-id="<?= $r['ReceptID'] ?>"
                                        data-nev="<?= mb_strtolower(htmlspecialchars($r['Nev'])) ?>"
                                        data-fokategoria="<?= htmlspecialchars($r['FoKategoriaNev'] ?? 'Nem kategorizált') ?>"
                                        data-alkategoria="<?= htmlspecialchars($r['AlkategoriaNev'] ?? 'Egyéb') ?>">
                                        <img src="<?= htmlspecialchars($r['Kep']) ?>" class="w-full h-48 object-cover">
                                        <div class="p-5">
                                            <div class="flex justify-between text-xs text-gray-500 mb-2 font-semibold">
                                                <span class="text-[#6F837B] uppercase"><?= htmlspecialchars($r['AlkategoriaNev'] ?? 'Egyéb') ?></span>
                                                <span>⭐ <?= $r['BegyujthetoPontok'] ?> pont</span>
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

                    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                        <div class="relative h-80">
                            <img src="<?= htmlspecialchars($recept['Kep']) ?>" class="absolute inset-0 w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40"></div>
                            <div class="absolute bottom-6 left-8 text-white">
                                <h1 class="text-4xl font-bold mb-3"><?= htmlspecialchars($recept['Nev']) ?></h1>
                                <div class="flex flex-wrap gap-3 text-sm">
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full">⏱ <?= formatIdo($recept['ElkeszitesiIdo']) ?></span>
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full">⭐ <?= $recept['BegyujthetoPontok'] ?> pont</span>
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full">🏷 <?= htmlspecialchars($recept['AlkategoriaNev']) ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="p-8 grid grid-cols-1 lg:grid-cols-[350px_1fr] gap-8">
                            <div class="bg-[#F3F4F1] rounded-2xl p-6 h-fit">
                                <h2 class="text-xl font-bold mb-4 text-[#4A7043] flex items-center gap-2">Hozzávalók</h2>
                                <ul class="space-y-3 text-sm">
                                    <?php foreach ($hozzavalok as $h): ?>
                                        <li class="flex gap-2 items-start ">
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
                                    $lepesek = explode("\n", $recept['Elkeszitesi_leiras']);
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
                                    <button class="bg-[#4A7043] text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:bg-[#3d5c37] transition-all transform hover:scale-105">
                                        Elkészítettem!
                                    </button>
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