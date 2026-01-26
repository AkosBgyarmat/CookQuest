<?php
include "head.php";

/*  ADATBÁZIS  */
$pdo = new PDO(
    "mysql:host=localhost;dbname=cook;charset=utf8mb4",
    "root",
    "",
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);

/*  ID  */
$receptId = isset($_GET['id']) ? (int)$_GET['id'] : null;

/*  ÖSSZES RECEPT (SIDEBAR + GRID)  */
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

/*  EGY RECEPT  */
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

<main class="min-h-screen bg-gradient-to-br from-[#95A792] to-[#7a8d78] py-8 px-4">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-4 gap-6">

        <!--  SIDEBAR  -->
        <aside class="bg-white rounded-2xl shadow-lg p-6 lg:col-span-1 h-fit lg:sticky lg:top-6">
            <div class="flex items-center gap-2 mb-6">
                <svg class="w-6 h-6 text-[#596C68]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <h2 class="font-bold text-xl text-[#403F48]">Receptkönyv</h2>
            </div>

            <div class="mb-4">
                <input type="text" id="searchRecipes" placeholder="Keresés a receptek között..."
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#596C68] focus:border-transparent text-sm">
            </div>

            <div class="h-[calc(100vh-280px)] lg:max-h-[600px] overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-[#596C68] scrollbar-track-gray-200">
                <?php foreach ($receptek as $r): ?>
                    <a
                        href="receptek.php?id=<?= $r['ReceptID'] ?>"
                        class="recipe-item block px-4 py-3 rounded-lg transition-all duration-200
                        <?= ($receptId == $r['ReceptID'])
                            ? 'bg-[#596C68] text-white shadow-md'
                            : 'hover:bg-[#E3D9CA] text-[#403F48] hover:shadow-sm' ?>"
                        data-name="<?= strtolower(htmlspecialchars($r['Nev'])) ?>">
                        <div class="font-semibold text-sm"><?= htmlspecialchars($r['Nev']) ?></div>
                        <div class="text-xs mt-1 <?= ($receptId == $r['ReceptID']) ? 'text-white/80' : 'text-gray-500' ?>">
                            <?= $r['Szint'] ?>. szint • <?php
                                                        $ido = $r['ElkeszitesiIdo']; // TIME
                                                        list($ora, $perc) = explode(':', $ido);

                                                        $osszPerc = ((int)$ora * 60) + (int)$perc;
                                                        ?>
                            <span><?= $osszPerc ?> perc</span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </aside>

        <!--  TARTALOM  -->
        <section class="lg:col-span-3">

            <?php if (!$receptId): ?>
                <!--  RECEPT GRID  -->
                <div class="mb-8">
                    <h1 class="text-4xl font-bold text-white mb-2 drop-shadow-lg">Fedezd fel és tanuld meg a receptjeinket!</h1>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    <?php foreach ($receptek as $r): ?>
                        <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden group transform hover:-translate-y-1">
                            <div class="relative overflow-hidden">
                                <img src="<?= htmlspecialchars($r['Kep']) ?>"
                                    class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300"
                                    alt="<?= htmlspecialchars($r['Nev']) ?>">
                                <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg">
                                    <span class="text-sm text-[#596C68] font-bold">⭐ <?= $r['BegyujthetoPontok'] ?></span>
                                </div>
                            </div>

                            <div class="p-5">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-xs font-semibold px-3 py-1 bg-[#E3D9CA] text-[#596C68] rounded-full">
                                        <?= $r['Szint'] ?>. SZINT
                                    </span>
                                </div>

                                <h3 class="font-bold text-xl mt-2 text-[#403F48] group-hover:text-[#596C68] transition-colors line-clamp-2 min-h-[3.5rem]">
                                    <?= htmlspecialchars($r['Nev']) ?>
                                </h3>

                                <div class="mt-4 flex items-center gap-4 text-sm text-gray-600">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span><?php
                                                $ido = $r['ElkeszitesiIdo']; // TIME
                                                list($ora, $perc) = explode(':', $ido);

                                                $osszPerc = ((int)$ora * 60) + (int)$perc;
                                                ?>
                                            <span><?= $osszPerc ?> perc</span>
                                    </div>
                                </div>

                                <a href="receptek.php?id=<?= $r['ReceptID'] ?>"
                                    class="mt-4 block text-center w-full py-2.5 bg-[#596C68] text-white font-semibold rounded-lg hover:bg-[#4a5a56] transition-colors shadow-sm">
                                    Recept megtekintése
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php else: ?>
                <!--  RECEPT RÉSZLET  -->
                <a href="receptek.php"
                    class="inline-flex items-center gap-2 mb-6 px-4 py-2 bg-white/90 backdrop-blur-sm text-[#596C68] font-semibold rounded-lg hover:bg-white transition-all shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Vissza a receptekhez
                </a>

                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                    <div class="relative">
                        <img src="<?= htmlspecialchars($recept['Kep']) ?>"
                            class="w-full h-80 object-cover"
                            alt="<?= htmlspecialchars($recept['Nev']) ?>">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                            <h1 class="text-4xl md:text-5xl font-bold mb-3 drop-shadow-lg">
                                <?= htmlspecialchars($recept['Nev']) ?>
                            </h1>
                            <div class="flex flex-wrap items-center gap-4 text-lg">
                                <div class="flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                    <?php
                                    $ido = $r['ElkeszitesiIdo']; // TIME
                                    list($ora, $perc) = explode(':', $ido);

                                    $osszPerc = ((int)$ora * 60) + (int)$perc;
                                    ?>
                                    <span><?= $osszPerc ?> perc</span>

                                </div>
                                <div class="flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                                    <span>⭐</span>
                                    <span><?= $recept['BegyujthetoPontok'] ?> pont</span>
                                </div>
                                <div class="flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                                    <span><?= $recept['Szint'] ?>. szint</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 md:p-10">
                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <div class="bg-gradient-to-br from-[#E3D9CA] to-[#d4c5b5] p-6 md:p-8 rounded-2xl shadow-lg">
                                    <div class="flex items-center gap-3 mb-6">
                                        <svg class="w-7 h-7 text-[#596C68]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                        <h2 class="text-2xl font-bold text-[#403F48]">Hozzávalók</h2>
                                    </div>
                                    <ul class="space-y-3">
                                        <?php foreach ($hozzavalok as $h): ?>
                                            <li class="flex items-start gap-3 text-[#403F48]">
                                                <svg class="w-5 h-5 text-[#596C68] mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>

                                                <span>
                                                    <span class="font-semibold"><?= rtrim(rtrim($h['Mennyiseg'], '0'), '.') ?>
                                                        <?= $h['Mertekegyseg'] ?></span>
                                                    <?= htmlspecialchars($h['Elnevezes']) ?>
                                                </span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>

                            <div>
                                <div class="flex items-center gap-3 mb-6">
                                    <svg class="w-7 h-7 text-[#596C68]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <h2 class="text-2xl font-bold text-[#403F48]">Elkészítés</h2>
                                </div>

                                <ol class="space-y-6 relative">
                                    <?php
                                    $sorok = preg_split("/\r\n|\n|\r/", $recept['Elkeszitesi_leiras']);
                                    $i = 1;
                                    foreach ($sorok as $sor):
                                        $sor = trim($sor);
                                        if ($sor === '') continue;
                                    ?>
                                        <li class="relative flex gap-4">
                                            <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-[#596C68] to-[#4a5a56] text-white rounded-full flex items-center justify-center text-base font-bold shadow-lg">
                                                <?= $i++ ?>
                                            </div>
                                            <div class="flex-1 pt-1.5 leading-relaxed text-[#403F48]">
                                                <?= htmlspecialchars($sor) ?>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                        </div>

                        <div class="mt-10 pt-8 border-t border-gray-200">
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <button class="px-8 py-3 bg-[#596C68] text-white font-semibold rounded-lg hover:bg-[#4a5a56] transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    Kedvencekhez adás
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </section>
    </div>
</main>

<script>
    // Search functionality
    document.getElementById('searchRecipes')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const recipeItems = document.querySelectorAll('.recipe-item');

        recipeItems.forEach(item => {
            const recipeName = item.getAttribute('data-name');
            if (recipeName.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>

<?php include "footer.php"; ?>