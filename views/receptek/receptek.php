<?php
include "../head.php";

/* ADATBÁZIS */
$pdo = new PDO(
    "mysql:host=localhost;dbname=cookquest;charset=utf8mb4",
    "root",
    "",
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);

/* ID */
$receptId = isset($_GET['id']) ? (int)$_GET['id'] : null;

/* ÖSSZES RECEPT */
$receptek = $pdo->query("
    SELECT
        r.ReceptID,
        r.Nev,
        r.Kep,
        r.ElkeszitesiIdo,
        r.BegyujthetoPontok,
        r.Koltseg,
        n.Szint
    FROM Recept r
    JOIN NehezsegiSzint n ON r.NehezsegiSzintID = n.NehezsegiSzintID
    ORDER BY n.Szint, r.Nev
")->fetchAll();

/* RECEPTEK SZINTEK SZERINT */
$receptekSzintenkent = [];
foreach ($receptek as $r) {
    $receptekSzintenkent[$r['Szint']][] = $r;
}

/* EGY RECEPT */
$recept = null;
$hozzavalok = [];

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

<main class="min-h-screen bg-gradient-to-br from-[#95A792] to-[#7a8d78]">

    <div class="max-w-7xl mx-auto grid grid-cols-[260px_1fr] gap-8 py-8 px-4">

        <!-- ===== SIDEBAR ===== -->
        <aside class="bg-white rounded-2xl shadow-xl p-5 h-[calc(100vh-6rem)] overflow-y-auto sticky top-24">

            <h2 class="text-xl font-bold mb-4 text-[#403F48]">
                Receptek szintek szerint
            </h2>

            <?php foreach ($receptekSzintenkent as $szint => $lista): ?>
                <div class="mb-4">
                    <h3 class="font-semibold text-[#596C68] mb-2">
                        <?= $szint ?>. szint
                    </h3>
                    <ul class="space-y-1 text-sm">
                        <?php foreach ($lista as $r): ?>
                            <li>
                                <a
                                    href="receptek.php?id=<?= $r['ReceptID'] ?>"
                                    class="block px-2 py-1 rounded hover:bg-[#95A792]/20 transition"
                                >
                                    <?= htmlspecialchars($r['Nev']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>

        </aside>

        <!-- ===== TARTALOM ===== -->
        <section>

            <?php if (!$recept): ?>

                <!-- LISTA NÉZET -->
                <h1 class="text-4xl font-bold text-white mb-8">
                    Receptek
                </h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($receptek as $r): ?>
                        <a
                            href="receptek.php?id=<?= $r['ReceptID'] ?>"
                            class="bg-white rounded-2xl shadow-xl overflow-hidden hover:-translate-y-1 transition block"
                        >
                            <img
                                src="<?= htmlspecialchars($r['Kep']) ?>"
                                class="w-full h-48 object-cover"
                                alt="<?= htmlspecialchars($r['Nev']) ?>"
                            >

                            <div class="p-5">
                                <div class="flex justify-between text-sm text-gray-500 mb-2">
                                    <span><?= $r['Szint'] ?>. szint</span>
                                    <span>⭐ <?= $r['BegyujthetoPontok'] ?></span>
                                </div>

                                <h2 class="text-xl font-semibold mb-2">
                                    <?= htmlspecialchars($r['Nev']) ?>
                                </h2>

                                <div class="text-sm text-gray-600 flex gap-4">
                                    <span>⏱️ <?= substr($r['ElkeszitesiIdo'], 0, 5) ?></span>
                                    <span>💰 <?= number_format($r['Koltseg'], 0, ',', ' ') ?> Ft</span>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>

            <?php else: ?>

                <!-- RÉSZLETEZŐ NÉZET -->
                <a
                    href="receptek.php"
                    class="inline-block mb-6 px-4 py-2 bg-white rounded-lg shadow hover:bg-gray-100 transition"
                >
                    ← Vissza
                </a>

                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                    <img
                        src="<?= htmlspecialchars($recept['Kep']) ?>"
                        class="w-full h-80 object-cover"
                        alt="<?= htmlspecialchars($recept['Nev']) ?>"
                    >

                    <div class="p-8">
                        <h1 class="text-4xl font-bold mb-4">
                            <?= htmlspecialchars($recept['Nev']) ?>
                        </h1>

                        <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-6">
                            <span>⏱️ <?= substr($recept['ElkeszitesiIdo'], 0, 5) ?></span>
                            <span>⭐ <?= $recept['BegyujthetoPontok'] ?> pont</span>
                            <span><?= $recept['Szint'] ?>. szint</span>
                            <span>💰 <?= number_format($recept['Koltseg'], 0, ',', ' ') ?> Ft</span>
                        </div>

                        <h2 class="text-2xl font-bold mb-2">Hozzávalók</h2>
                        <ul class="list-disc list-inside mb-6 text-gray-700">
                            <?php foreach ($hozzavalok as $h): ?>
                                <li>
                                    <?= $h['Mennyiseg'] ?> <?= $h['Mertekegyseg'] ?> <?= htmlspecialchars($h['Elnevezes']) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <h2 class="text-2xl font-bold mb-2">Elkészítés</h2>
                        <p class="whitespace-pre-line text-gray-700">
                            <?= nl2br(htmlspecialchars($recept['Elkeszitesi_leiras'])) ?>
                        </p>
                    </div>
                </div>

            <?php endif; ?>

        </section>
    </div>
</main>

<?php include "../footer.php"; ?>
