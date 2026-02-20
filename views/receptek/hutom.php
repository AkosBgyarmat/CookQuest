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
$minMatch = 1;

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
    }
}
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

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 max-h-80 overflow-y-auto border p-4 rounded">

                    <?php foreach ($osszesHozzavalo as $hz): ?>
                        <label class="flex items-center gap-2 cursor-pointer p-2 hover:bg-gray-100 rounded">
                            <input type="checkbox"
                                name="hozzavalok[]"
                                value="<?= $hz["HozzavaloID"] ?>"
                                class="w-4 h-4">
                            <span class="text-sm"><?= htmlspecialchars($hz["Elnevezes"]) ?></span>
                        </label>
                    <?php endforeach; ?>

                </div>

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
                        <h3 class="text-xl font-semibold text-gray-700">
                            Nincs megfelelő recept a kiválasztott hozzávalók alapján.
                        </h3>
                    </div>

                <?php else: ?>

                    <h2 class="text-2xl font-bold text-[#4A7043] mb-6">
                        Talált receptek: <?= count($szurtReceptek) ?>
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                        <?php foreach ($szurtReceptek as $recept): ?>

                            <a href="receptek.php?id=<?= $recept["ReceptID"] ?>"
                                class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:scale-105">

                                <div class="relative h-48">
                                    <img src="<?= htmlspecialchars($recept["Kep"]) ?>"
                                        class="w-full h-full object-cover group-hover:scale-110 transition">

                                    <div class="absolute top-3 right-3 bg-[#6F837B] text-white text-xs px-3 py-1 rounded-full">
                                        <?= $recept["egyezo_db"] ?> egyezés
                                    </div>
                                </div>

                                <div class="p-4">
                                    <h3 class="font-bold text-gray-800 mb-2">
                                        <?= htmlspecialchars($recept["Nev"]) ?>
                                    </h3>

                                    <p class="text-sm text-gray-600">
                                        ⏱ <?= formatIdo($recept["ElkeszitesiIdo"]) ?>
                                    </p>

                                    <p class="text-xs text-gray-500 mt-1">
                                        <?= $recept["Szint"] ?>. szint
                                    </p>
                                </div>

                            </a>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>
</main>

<?php require_once "../footer.php"; ?>