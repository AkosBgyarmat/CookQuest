<<<<<<< HEAD
<?php
include "head.php";

/* ====== ADATBÁZIS ====== */
$pdo = new PDO(
    "mysql:host=localhost;dbname=cook;charset=utf8mb4",
    "root",
    "",
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);

/* ====== ID ====== */
$receptId = isset($_GET['id']) ? (int)$_GET['id'] : null;

/* ====== ÖSSZES RECEPT (SIDEBAR + GRID) ====== */
$receptek = $pdo->query("
    SELECT
        r.ReceptID,
        r.Nev,
        r.Kep,
        r.ElkeszitesiIdo,
        r.BegyujthetoPontok,
        n.Szint
    FROM Recept r
    JOIN NehezsegiSzint n ON r.NehezsegiSzintID = n.NehezsegiSzintID
    ORDER BY r.Nev
")->fetchAll();

/* ====== EGY RECEPT ====== */
if ($receptId) {
    $stmt = $pdo->prepare("
        SELECT r.*, n.Szint
        FROM Recept r
        JOIN NehezsegiSzint n ON r.NehezsegiSzintID = n.NehezsegiSzintID
        WHERE r.ReceptID = ?
    ");
    $stmt->execute([$receptId]);
    $recept = $stmt->fetch();

    $stmt = $pdo->prepare("
        SELECT h.Elnevezes, rh.Mennyiseg, m.Elnevezes AS Mertekegyseg
        FROM Recept_Hozzavalo rh
        JOIN Hozzavalo h ON rh.HozzavaloID = h.HozzavaloID
        JOIN Mertekegyseg m ON rh.MertekegysegID = m.MertekegysegID
        WHERE rh.ReceptID = ?
    ");
    $stmt->execute([$receptId]);
    $hozzavalok = $stmt->fetchAll();
}
?>

<main class="min-h-screen bg-[#95A792] py-8">
<div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-4 gap-6">

    <!-- ====== SIDEBAR ====== -->
    <aside class="bg-[#E3D9CA] rounded-xl p-4 lg:col-span-1 h-fit sticky top-6">
        <h2 class="font-bold text-lg text-[#403F48] mb-4">Receptek</h2>
        <ul class="space-y-1">
            <?php foreach ($receptek as $r): ?>
                <li>
                    <a
                        href="receptek.php?id=<?= $r['ReceptID'] ?>"
                        class="block px-3 py-2 rounded
                        <?= ($receptId == $r['ReceptID'])
                            ? 'bg-[#596C68] text-white font-semibold'
                            : 'hover:bg-[#596C68]/20 text-[#403F48]' ?>">
                        <?= htmlspecialchars($r['Nev']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <!-- ====== TARTALOM ====== -->
    <section class="lg:col-span-3">

    <?php if (!$receptId): ?>
        <!-- ====== RECEPT GRID ====== -->
        <h1 class="text-3xl font-bold text-white mb-6">Receptek</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
            <?php foreach ($receptek as $r): ?>
                <div class="bg-white rounded-xl shadow hover:shadow-xl transition overflow-hidden">
                    <img src="<?= htmlspecialchars($r['Kep']) ?>"
                         class="w-full h-40 object-cover">

                    <div class="p-4">
                        <span class="text-sm text-[#596C68] font-semibold">
                            <?= $r['Szint'] ?>. szint
                        </span>

                        <h3 class="font-bold text-lg mt-1 text-[#403F48]">
                            <?= htmlspecialchars($r['Nev']) ?>
                        </h3>

                        <p class="text-sm text-gray-600 mt-1">
                            ⏱ <?= substr($r['ElkeszitesiIdo'],0,5) ?> perc
                        </p>

                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-sm">⭐ <?= $r['BegyujthetoPontok'] ?> pont</span>

                            <a href="receptek.php?id=<?= $r['ReceptID'] ?>"
                               class="text-[#596C68] font-semibold hover:underline">
                                Megnézem →
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else: ?>
        <!-- ====== RECEPT RÉSZLET ====== -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <img src="<?= htmlspecialchars($recept['Kep']) ?>"
                 class="w-full h-64 object-cover">

            <div class="p-8">
                <h1 class="text-3xl font-bold text-[#403F48] mb-2">
                    <?= htmlspecialchars($recept['Nev']) ?>
                </h1>

                <p class="text-gray-600 mb-6">
                    ⏱ <?= substr($recept['ElkeszitesiIdo'],0,5) ?> perc • ⭐ <?= $recept['BegyujthetoPontok'] ?> pont
                </p>

                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-[#E3D9CA] p-6 rounded-xl">
                        <h2 class="text-xl font-bold mb-4">Hozzávalók</h2>
                        <ul class="space-y-2">
                            <?php foreach ($hozzavalok as $h): ?>
                                <li>
                                    <?= $h['Mennyiseg'] ?> <?= $h['Mertekegyseg'] ?>
                                    <?= htmlspecialchars($h['Elnevezes']) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                   <div>
    <h2 class="text-xl font-bold mb-4">Elkészítés</h2>    

    <ol class="space-y-4 pl-12 md:pl-14 list-none relative">
        <?php
        $sorok = preg_split("/\r\n|\n|\r/", $recept['Elkeszitesi_leiras']);
        $i = 1;
        foreach ($sorok as $sor):
            $sor = trim($sor);
            if ($sor === '') continue;
        ?>
            <li class="relative min-h-[2rem] ">
                <div class="absolute left-0 -top-0.5 w-8 h-8 bg-[#596C68] text-white rounded-full flex items-center justify-center text-sm font-medium shrink-0">
                    <?= $i++ ?>
                </div>
                <div class="ml-1 leading-relaxed text-[#403F48]">
                    <?= htmlspecialchars($sor) ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ol>
</div>
                </div>

                <a
                    href="receptek.php"
                    class="inline-block mt-8 px-6 py-3 bg-[#596C68] text-white font-semibold rounded-lg hover:bg-[#596C68]/80 transition-colors">
                    ← Vissza a receptekhez
                </a>
            </div>
        </div>
    <?php endif; ?>

    </section>
</div>
</main>

<?php include "footer.php"; ?>
=======

