<?php
include "../head.php";

/* =========================
   ADATBÁZIS KAPCSOLÓDÁS
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
   Segédfüggvények
========================= */
function formatIdo($ido_str) {
    $parts = explode(':', $ido_str);
    if (count($parts) < 2) return $ido_str;
    $ora = (int)$parts[0];
    $perc = (int)$parts[1];
    if ($ora > 0) return "$ora óra" . ($perc > 0 ? " $perc perc" : "");
    if ($perc > 0) return "$perc perc";
    return "kevesebb mint 1 perc";
}

function formatMennyiseg($mennyiseg) {
    if (floor($mennyiseg) == $mennyiseg) return (int)$mennyiseg;
    return rtrim(rtrim(number_format($mennyiseg, 2, '.', ''), '0'), '.');
}

/* =========================
   URL PARAMÉTER (ID)
========================= */
$receptId = isset($_GET['id']) ? (int)$_GET['id'] : null;

/* =========================
   ÖSSZES RECEPT LEKÉRDEZÉSE
========================= */
$receptek = $pdo->query("
    SELECT 
        r.ReceptID,
        r.Nev,
        r.Kep,
        r.ElkeszitesiIdo,
        r.BegyujthetoPontok,
        r.Elkeszitesi_leiras,
        n.Szint,
        kat.Kategoria      AS FoKategoriaNev,
        alk.Alkategoria    AS AlkategoriaNev,
        a.Arkategoria      AS ArkategoriaNev
    FROM recept r
    INNER JOIN nehezsegiszint     n   ON r.NehezsegiSzintID   = n.NehezsegiSzintID
    LEFT  JOIN alkategoria        alk ON r.AlkategoriaID      = alk.AlkategoriaID
    LEFT  JOIN kategoria          kat ON alk.KategoriaID      = kat.KategoriaID
    LEFT  JOIN arkategoria        a   ON r.ArkategoriaID      = a.ArkategoriaID
    ORDER BY n.Szint, r.Nev
")->fetchAll();

/* =========================
   RECEPTEK CSOPORTOSÍTÁSA SZINTEK SZERINT
========================= */
$receptekSzintekSzerint = [];
foreach ($receptek as $r) {
    $szint = $r['Szint'];
    if (!isset($receptekSzintekSzerint[$szint])) {
        $receptekSzintekSzerint[$szint] = [];
    }
    $receptekSzintekSzerint[$szint][] = $r;
}

/* =========================
   KATEGÓRIÁK GYŰJTÉSE A SZŰRŐHÖZ
========================= */
$kategoriaCheckboxok = [];
foreach ($receptek as $r) {
    $foKat = $r['FoKategoriaNev'] ?? 'Nem kategorizált';
    $alKat = $r['AlkategoriaNev']  ?? 'Egyéb';

    if (!isset($kategoriaCheckboxok[$foKat])) {
        $kategoriaCheckboxok[$foKat] = [];
    }

    if (!in_array($alKat, $kategoriaCheckboxok[$foKat])) {
        $kategoriaCheckboxok[$foKat][] = $alKat;
    }
}

/* =========================
   EGY RECEPT ADATAI
========================= */
$recept = null;
$hozzavalok = [];

if ($receptId) {
    $stmt = $pdo->prepare("
        SELECT r.*, n.Szint, a.Arkategoria AS ArkategoriaNev, 
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
        SELECT h.Elnevezes, rh.Mennyiseg, m.Elnevezes AS Mertekegyseg
        FROM recept_hozzavalo rh
        JOIN hozzavalo h ON rh.HozzavaloID = h.HozzavaloID
        JOIN mertekegyseg m ON rh.MertekegysegID = m.MertekegysegID
        WHERE rh.ReceptID = ?
    ");
    $stmt->execute([$receptId]);
    $hozzavalok = $stmt->fetchAll();
}
?>

<main class="min-h-screen bg-gradient-to-br from-[#9FB1A3] to-[#7F8F83]">

    <div class="max-w-7xl mx-auto py-6 px-4">

        <!-- Mobil hamburger menü gomb (csak kis képernyőn) -->
        <button id="mobilSidebarToggle" class="lg:hidden fixed top-4 left-4 z-50 bg-white p-3 rounded-full shadow-lg">
            <svg class="w-6 h-6 text-[#4A7043]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- SZŰRŐ PANEL -->
        <?php if (!$recept): ?>
            <div class="mb-8">
                <button id="szuroGomb" class="bg-white px-6 py-3 rounded-xl shadow-lg flex items-center gap-2 font-semibold text-[#4A7043] hover:bg-gray-50 transition w-full sm:w-auto">
                    <span>🧭 Szűrők</span>
                    <svg id="szuroNyil" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div id="szuroPanel" class="hidden mt-4 bg-white rounded-2xl shadow-2xl p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Keresés név alapján</label>
                            <input id="keresInput" type="text" placeholder="Pl. leves, süti, carbonara..." class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#95A792]">
                        </div>

                        <div class="max-h-96 overflow-y-auto">
                            <h4 class="font-semibold text-[#4A7043] mb-3">Kategóriák</h4>
                            <?php foreach ($kategoriaCheckboxok as $foKat => $alkategoriak): ?>
                                <div class="mb-4">
                                    <h5 class="text-sm font-medium text-gray-800 mb-2"><?= htmlspecialchars($foKat) ?></h5>
                                    <?php foreach ($alkategoriak as $alKat): ?>
                                        <label class="flex items-center gap-2 mb-1 pl-4">
                                            <input type="checkbox" class="kategoriaCheckbox" 
                                                   data-fokategoria="<?= htmlspecialchars($foKat) ?>" 
                                                   data-alkategoria="<?= htmlspecialchars($alKat) ?>">
                                            <span class="text-sm text-gray-700"><?= htmlspecialchars($alKat) ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button id="szuroReset" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-900">Mindent mutat</button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="flex flex-col lg:flex-row lg:gap-8">

            <!-- BALOLDALI SÁV – mobilban overlayként kinyílik -->
            <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-80 bg-white shadow-2xl transform -translate-x-full lg:translate-x-0 lg:static lg:inset-auto lg:w-[280px] lg:h-[calc(100vh-8rem)] lg:overflow-y-auto lg:sticky lg:top-24 transition-transform duration-300">
                <div class="p-5">
                    <div class="flex items-center justify-between mb-5 lg:hidden">
                        <h2 class="text-xl font-bold text-[#3F3D56]">Receptkönyv</h2>
                        <button id="mobilSidebarClose" class="text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <input type="text" id="oldalsoKereso" placeholder="Keresés..." class="w-full mb-6 px-3 py-2 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#95A792]">

                    <?php foreach ($receptekSzintekSzerint as $szint => $lista): ?>
                        <div class="mb-4">
                            <button class="w-full text-left flex items-center justify-between py-2 px-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition szint-sav-cim" type="button">
                                <span class="font-semibold text-[#4A7043]"><?= $szint ?>. szint (<?= count($lista) ?>)</span>
                                <svg class="w-5 h-5 transition-transform sav-nyil" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <ul class="szint-sav-tartalom hidden mt-2 space-y-1 pl-4">
                                <?php foreach ($lista as $r): ?>
                                    <li>
                                        <a href="receptek.php?id=<?= $r['ReceptID'] ?>"
                                           class="block px-3 py-1.5 rounded-lg text-sm transition <?= ($receptId == $r['ReceptID']) ? 'bg-[#6F837B] text-white' : 'hover:bg-[#95A792]/20 text-gray-700' ?>">
                                            <div class="font-medium"><?= htmlspecialchars($r['Nev']) ?></div>
                                            <div class="text-xs opacity-80">
                                                <?= formatIdo($r['ElkeszitesiIdo']) ?> · <?= htmlspecialchars($r['AlkategoriaNev'] ?? 'Egyéb') ?>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            </aside>

            <!-- FŐ TARTALOM -->
            <section id="receptekTarolo" class="flex-1">

                <?php if (!$recept): ?>
                    <h1 class="text-4xl font-bold text-white mb-8">Receptkönyv</h1>

                    <?php foreach ($receptekSzintekSzerint as $szint => $lista): ?>
                        <div class="mb-16 szint-blokk" data-szint="<?= $szint ?>">
                            <h2 class="text-3xl font-bold text-white mb-6 border-b border-white/40 pb-3">
                                <?= $szint ?>. szint – <?= count($lista) ?> recept
                            </h2>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                <?php foreach ($lista as $r): ?>
                                    <a href="receptek.php?id=<?= $r['ReceptID'] ?>"
                                       class="recept-kartya bg-white rounded-2xl shadow-xl overflow-hidden hover:-translate-y-1 hover:shadow-2xl transition block"
                                       data-nev="<?= strtolower(htmlspecialchars($r['Nev'])) ?>"
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
                    <a href="receptek.php" class="inline-flex items-center gap-2 mb-6 px-4 py-2 bg-white rounded-lg shadow hover:bg-gray-100 transition">
                        ← Vissza a receptekhez
                    </a>

                    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                        <div class="relative h-80">
                            <img src="<?= htmlspecialchars($recept['Kep']) ?>" class="absolute inset-0 w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/30"></div>
                            <div class="absolute bottom-6 left-8 text-white">
                                <div class="text-sm uppercase font-bold tracking-widest bg-[#6F837B] inline-block px-3 py-1 rounded mb-2">
                                    <?= htmlspecialchars($recept['FoKategoriaNev'] ?? 'Recept') ?>
                                </div>
                                <h1 class="text-4xl font-bold mb-3"><?= htmlspecialchars($recept['Nev']) ?></h1>
                                <div class="flex flex-wrap gap-3 text-sm">
                                    <span class="px-3 py-1 bg-white/20 rounded-full">⏱ <?= formatIdo($recept['ElkeszitesiIdo']) ?></span>
                                    <span class="px-3 py-1 bg-white/20 rounded-full">⭐ <?= $recept['BegyujthetoPontok'] ?> pont</span>
                                    <span class="px-3 py-1 bg-white/20 rounded-full"><?= $recept['Szint'] ?>. szint</span>
                                    <span class="px-3 py-1 bg-white/20 rounded-full">💰 <?= htmlspecialchars($recept['ArkategoriaNev'] ?? 'Nincs megadva') ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="p-8 grid grid-cols-1 lg:grid-cols-[350px_1fr] gap-8">
                            <div class="bg-[#E7DED0] rounded-2xl p-6">
                                <h2 class="text-xl font-bold mb-4 text-[#4A4A4A]">Hozzávalók</h2>
                                <ul class="space-y-2 text-sm">
                                    <?php foreach ($hozzavalok as $h): ?>
                                        <li class="flex gap-2 items-center">
                                            <span class="font-bold"><?= formatMennyiseg($h['Mennyiseg']) ?> <?= htmlspecialchars($h['Mertekegyseg']) ?></span>
                                            <?= htmlspecialchars($h['Elnevezes']) ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div>
                                <h2 class="text-xl font-bold mb-4 flex items-center gap-2">📄 Elkészítés</h2>
                                <ol class="space-y-4 text-gray-700">
                                    <?php
                                    $lepesek = explode("\n", $recept['Elkeszitesi_leiras']);
                                    $i = 1;
                                    foreach ($lepesek as $lepes):
                                        if (trim($lepes) === '') continue;
                                    ?>
                                        <li class="flex gap-4">
                                            <span class="w-8 h-8 flex items-center justify-center shrink-0 rounded-full bg-[#6F837B] text-white text-sm font-bold">
                                                <?= $i++ ?>
                                            </span>
                                            <p><?= htmlspecialchars($lepes) ?></p>
                                        </li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </section>
        </div>
    </div>
</main>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Szűrő panel ki/be
    const szuroGomb = document.getElementById('szuroGomb');
    const szuroPanel = document.getElementById('szuroPanel');
    const szuroNyil = document.getElementById('szuroNyil');

    if (szuroGomb) {
        szuroGomb.addEventListener('click', () => {
            szuroPanel.classList.toggle('hidden');
            szuroNyil.classList.toggle('rotate-180');
        });
    }

    // Baloldali accordion
    document.querySelectorAll('.szint-sav-cim').forEach(cim => {
        cim.addEventListener('click', () => {
            const tartalom = cim.nextElementSibling;
            const nyil = cim.querySelector('.sav-nyil');
            tartalom.classList.toggle('hidden');
            nyil.classList.toggle('rotate-180');
        });
    });

    // Mobil sidebar ki/be
    const mobilSidebarToggle = document.getElementById('mobilSidebarToggle');
    const mobilSidebarClose = document.getElementById('mobilSidebarClose');
    const sidebar = document.getElementById('sidebar');

    if (mobilSidebarToggle) {
        mobilSidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    }

    if (mobilSidebarClose) {
        mobilSidebarClose.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
        });
    }

    // Szűrő logika – csak kategóriák + keresés
    const keresInput = document.getElementById('keresInput');
    const oldalsoKereso = document.getElementById('oldalsoKereso');
    const kategoriaCheckboxok = document.querySelectorAll('.kategoriaCheckbox');
    const resetGomb = document.getElementById('szuroReset');

    function szur() {
        const keresSzoveg = (keresInput?.value || oldalsoKereso?.value || '').toLowerCase().trim();

        const kivalasztottFoKatk = new Set();
        const kivalasztottAlKatk = new Set();
        kategoriaCheckboxok.forEach(cb => {
            if (cb.checked) {
                kivalasztottFoKatk.add(cb.dataset.fokategoria);
                kivalasztottAlKatk.add(cb.dataset.alkategoria);
            }
        });

        document.querySelectorAll('.szint-blokk').forEach(blokk => {
            let vanLathatoRecept = false;

            blokk.querySelectorAll('.recept-kartya').forEach(kartya => {
                const nev = kartya.dataset.nev;
                const foKat = kartya.dataset.fokategoria;
                const alKat = kartya.dataset.alkategoria;

                const nevLatszik = nev.includes(keresSzoveg);
                const katLatszik = (kivalasztottFoKatk.size === 0 && kivalasztottAlKatk.size === 0) ||
                                   kivalasztottFoKatk.has(foKat) ||
                                   kivalasztottAlKatk.has(alKat);

                kartya.style.display = (nevLatszik && katLatszik) ? 'block' : 'none';

                if (nevLatszik && katLatszik) vanLathatoRecept = true;
            });

            blokk.style.display = vanLathatoRecept ? 'block' : 'none';
        });
    }

    if (keresInput) keresInput.addEventListener('input', szur);
    if (oldalsoKereso) oldalsoKereso.addEventListener('input', szur);
    kategoriaCheckboxok.forEach(cb => cb.addEventListener('change', szur));
    if (resetGomb) {
        resetGomb.addEventListener('click', () => {
            kategoriaCheckboxok.forEach(cb => cb.checked = false);
            if (keresInput) keresInput.value = '';
            if (oldalsoKereso) oldalsoKereso.value = '';
            szur();
        });
    }

    szur();
});
</script>

<?php include "../footer.php"; ?>