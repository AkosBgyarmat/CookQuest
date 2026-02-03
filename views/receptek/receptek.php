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
   URL PARAMÉTER (ID)
========================= */
$receptId = isset($_GET['id']) ? (int)$_GET['id'] : null;

/* =========================
   ÖSSZES RECEPT LEKÉRDEZÉSE – hierarchikus rendezéssel
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
    ORDER BY kat.Kategoria, alk.Alkategoria, r.Nev
")->fetchAll();

/* =========================
   HIERARCHIKUS CSOPORTOSÍTÁS: fő kategória → alkategória → receptek
========================= */
$receptekHierarchia = [];

foreach ($receptek as $r) {
    $foKat = $r['FoKategoriaNev'] ?? 'Nem kategorizált';
    $alKat = $r['AlkategoriaNev']  ?? 'Egyéb';

    if (!isset($receptekHierarchia[$foKat])) {
        $receptekHierarchia[$foKat] = [];
    }

    if (!isset($receptekHierarchia[$foKat][$alKat])) {
        $receptekHierarchia[$foKat][$alKat] = [];
    }

    $receptekHierarchia[$foKat][$alKat][] = $r;
}

/* =========================
   EGY SPECIFIKUS RECEPT ADATAI
========================= */
$recept = null;
$hozzavalok = [];

if ($receptId) {
    // Recept alapinfók
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

    // Hozzávalók listája
    $stmt = $pdo->prepare("
        SELECT
            h.Elnevezes,
            rh.Mennyiseg,
            m.Elnevezes AS Mertekegyseg
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

    <div class="max-w-7xl mx-auto grid grid-cols-[280px_1fr] gap-8 py-10 px-4">

        <!-- OLDALSÓ SÁV – hierarchikus kategóriák -->
        <aside class="bg-white rounded-2xl shadow-xl p-5 h-[calc(100vh-8rem)] overflow-y-auto sticky top-24">

            <h2 class="text-xl font-bold mb-4 text-[#3F3D56]">
                Receptkönyv
            </h2>

            <input
                type="text"
                placeholder="Keresés..."
                class="w-full mb-4 px-3 py-2 rounded-lg border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#95A792]">

            <?php foreach ($receptekHierarchia as $foKat => $alkategoriak): ?>
                <div class="mb-5">
                    <h3 class="text-base font-bold text-[#4A7043] mb-2 uppercase tracking-wide">
                        <?= htmlspecialchars($foKat) ?>
                    </h3>

                    <?php foreach ($alkategoriak as $alKat => $lista): ?>
                        <div class="mb-3">
                            <h4 class="text-sm font-semibold text-[#6B7B74] mb-1 pl-2 border-l-2 border-[#95A792]/40">
                                <?= htmlspecialchars($alKat) ?>
                            </h4>

                            <ul class="space-y-1 pl-2">
                                <?php foreach ($lista as $r): ?>
                                    <li>
                                        <a href="receptek.php?id=<?= $r['ReceptID'] ?>"
                                           class="block px-3 py-1.5 rounded-lg text-sm transition
                                           <?= ($receptId == $r['ReceptID']) ? 'bg-[#6F837B] text-white' : 'hover:bg-[#95A792]/20 text-gray-700' ?>">
                                            <div class="font-medium"><?= htmlspecialchars($r['Nev']) ?></div>
                                            <div class="text-xs opacity-80"><?= $r['Szint'] ?>. szint · <?= substr($r['ElkeszitesiIdo'], 0, 5) ?></div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

        </aside>

        <!-- FŐ TARTALOM -->
        <section>

            <?php if (!$recept): ?>
                <h1 class="text-4xl font-bold text-white mb-8">Receptkönyv</h1>

                <?php foreach ($receptekHierarchia as $foKat => $alkategoriak): ?>
                    <section class="mb-12">
                        <h2 class="text-2xl font-bold text-white mb-4 border-b border-white/30 pb-2">
                            <?= htmlspecialchars($foKat) ?>
                        </h2>

                        <?php foreach ($alkategoriak as $alKat => $lista): ?>
                            <div class="mb-8">
                                <h3 class="text-xl font-semibold text-[#E7DED0] mb-4 pl-3 border-l-4 border-[#6F837B]">
                                    <?= htmlspecialchars($alKat) ?>
                                </h3>

                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                    <?php foreach ($lista as $r): ?>
                                        <a href="receptek.php?id=<?= $r['ReceptID'] ?>"
                                           class="bg-white rounded-2xl shadow-xl overflow-hidden hover:-translate-y-1 hover:shadow-2xl transition block">
                                            <img src="<?= htmlspecialchars($r['Kep']) ?>" class="w-full h-48 object-cover">

                                            <div class="p-5">
                                                <div class="flex justify-between text-xs text-gray-500 mb-2 font-semibold">
                                                    <span class="text-[#6F837B] uppercase"><?= htmlspecialchars($alKat) ?></span>
                                                    <span>⭐ <?= $r['BegyujthetoPontok'] ?> pont</span>
                                                </div>

                                                <h2 class="text-lg font-bold mb-2 text-gray-800"><?= htmlspecialchars($r['Nev']) ?></h2>

                                                <div class="flex justify-between text-sm text-gray-600">
                                                    <span>⏱ <?= substr($r['ElkeszitesiIdo'], 0, 5) ?></span>
                                                    <span>💰 <?= htmlspecialchars($r['ArkategoriaNev'] ?? 'Nincs') ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </section>
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
                                <span class="px-3 py-1 bg-white/20 rounded-full">⏱ <?= substr($recept['ElkeszitesiIdo'], 0, 5) ?></span>
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
                                        <span class="font-bold"><?= $h['Mennyiseg'] ?> <?= $h['Mertekegyseg'] ?></span>
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
</main>

<?php include "../footer.php"; ?>