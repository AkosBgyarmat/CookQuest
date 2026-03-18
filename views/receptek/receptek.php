<?php

require_once __DIR__ . '/../../api/receptek_bootstrap.php';
require_once __DIR__ . '/../../controller/ReceptekVezerlo.php';
// MVC bontas megjegyzes:
// Ez a fajl mar csak megjelenitest tartalmaz.
// A kovetkezo logika a controllerbe kerult: session azonositas, status uzenet, szintlepes detektalas,
// view alapadatok es pont/szint adat-elokeszites.

$vezerlo = new ReceptekVezerlo($pdo);
$viewData = $vezerlo->kezeles();
if (!is_array($viewData)) {
    $viewData = [];
}

// A template kompatibilitas miatt meghagyjuk a korabban hasznalt valtozoneveket.
$sessionFelhasznaloId = (int)($viewData['sessionFelhasznaloId'] ?? 0);

// extract
extract($viewData, EXTR_OVERWRITE);

// head
include __DIR__ . '/../head.php';
?>

<!-- ===== 7) FŐ TARTALOM ===== -->
<!-- Recept oldali fő konténer -->
<main class="min-h-screen bg-gradient-to-br from-[#9FB1A3] to-[#7F8F83] font-jost">
    <div class="max-w-7xl mx-auto py-6 px-4">

        <!-- Felső figyelmeztetés, ha zárolt receptre érkezett a felhasználó -->
        <?php if (isset($_GET['status']) && $_GET['status'] === 'locked'): ?>
            <div class="mb-4 bg-red-100 text-red-800 px-4 py-3 rounded-xl font-medium">
                🔒 Zárolt recept. Előbb érd el a(z) <?= (int)($_GET['need'] ?? 0) ?>. szintet.
                <?php if ($sessionFelhasznaloId <= 0): ?>
                    <span class="block mt-1">Jelentkezz be, hogy haladni tudj a szintekkel.</span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ($aktualisPontok !== null): ?>
            <!-- Felső pont-kijelzés bejelentkezett felhasználónak -->
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
            <!-- ===== 8) LISTA NÉZET FEJLÉC (SZŰRŐ + HŰTŐ LINK) ===== -->
            <!-- Lista nézet: szűrő gomb + hűtő oldal link -->
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
                        <span>Mi van otthon?</span>
                    </a>
                </div>

                <!-- Szűrőpanel (kategória / alkategória checkboxok) -->
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

            <!-- ===== 9) BAL OLDALI SIDEBAR: RECEPTEK SZINTENKÉNT ===== -->
            <!-- Bal oldali sidebar: receptek szintenként -->
            <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-80 bg-white shadow-2xl transform -translate-x-full lg:translate-x-0 lg:sticky lg:top-6 lg:self-start lg:max-h-[calc(100vh-3rem)] lg:overflow-y-auto lg:w-[280px] transition-transform duration-300 rounded-r-2xl lg:rounded-2xl">
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
                        <?php $szintLocked = ((int)$szint > (int)$aktualisSzint); ?>
                        <div class="mb-4">
                            <button type="button"
                                class="w-full text-left flex items-center justify-between py-2 px-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition szint-sav-cim <?= $szintLocked ? 'opacity-60' : '' ?>">
                                <span class="font-semibold text-[#4A7043]">
                                    <?= (int)$szint ?>. szint <?= $szintLocked ? '🔒' : '' ?>
                                    (<span class="szint-darab" data-szint="<?= (int)$szint ?>"><?= count($lista) ?></span>)
                                </span>
                                <svg class="w-5 h-5 transition-transform sav-nyil" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <ul class="szint-sav-tartalom hidden mt-2 space-y-1 pl-4">
                                <?php foreach ($lista as $r): ?>
                                    <?php $rSzint = (int)($r['Szint'] ?? $r['NehezsegiSzintID'] ?? $szint); ?>
                                    <?php $rLocked = ($rSzint > (int)$aktualisSzint); ?>

                                    <li class="sidebar-recept-item" data-recept-id="<?= (int)$r['ReceptID'] ?>">
                                        <!-- Sidebar elem: nyitott szintnél kattintható, zárt szintnél tiltott -->
                                        <?php if (!$rLocked): ?>
                                            <a href="receptek.php?id=<?= (int)$r['ReceptID'] ?>"
                                                class="block px-3 py-1.5 rounded-lg text-sm transition <?= ($receptId == (int)$r['ReceptID']) ? 'bg-[#6F837B] text-white' : 'hover:bg-[#95A792]/20 text-gray-700' ?>">
                                            <?php else: ?>
                                                <a href="javascript:void(0)"
                                                    onclick="alert('Zárolt recept: Szint <?= $rSzint ?> szükséges.')"
                                                    class="block px-3 py-1.5 rounded-lg text-sm transition text-gray-400 cursor-not-allowed">
                                                <?php endif; ?>
                                                <div class="font-medium"><?= htmlspecialchars($r['Nev']) ?></div>
                                                <div class="text-xs opacity-80"><?= formatIdo((string)$r['ElkeszitesiIdo']) ?></div>
                                                </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            </aside>

            <!-- Fő tartalom: lista nézet vagy részletes recept nézet -->
            <section id="receptekTarolo" class="flex-1">

                <?php if (!$recept): ?>
                    <!-- ===== 10) LISTA NÉZET TARTALOM ===== -->
                    <!-- Receptlista nézet -->

                    <h1 class="text-4xl font-bold text-white mb-4">Receptek</h1>

                    <?php if ($progress): ?>
                        <!-- Progress blokk: aktuális szint és szintteljesítés előrehaladás -->
                        <div class="mb-8 bg-white/80 backdrop-blur px-5 py-4 rounded-2xl shadow-xl">
                            <div class="flex items-center justify-between gap-3">
                                <div class="font-bold text-[#4A7043]">Jelenlegi szint: <?= (int)$progress['aktualisSzint'] ?></div>
                                <div class="text-sm text-gray-700 font-semibold">
                                    <?= (int)$progress['pont'] ?> / <?= (int)$progress['kuszobPont'] ?> pont
                                </div>
                            </div>

                            <?php
                            $pct = 0;
                            if ((int)$progress['kuszobPont'] > 0) {
                                $pct = min(100, (int)round(((int)$progress['pont'] / (int)$progress['kuszobPont']) * 100));
                            }
                            ?>
                            <div class="mt-3 h-2 bg-gray-200 rounded-full">
                                <div class="h-2 rounded-full bg-emerald-500" style="width: <?= $pct ?>%"></div>
                            </div>

                            <div class="mt-3 text-sm text-gray-700">
                                <?php if ((int)$progress['hatravanPont'] > 0): ?>
                                    Még <b><?= (int)$progress['hatravanPont'] ?></b> pont a szint teljesítéséhez.
                                <?php else: ?>
                                    Szint teljesítve — a következő szint feloldva.
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div id="nincsEredmeny" class="hidden bg-white rounded-2xl shadow-xl p-12 text-center">
                        <div class="text-6xl mb-4">🔍</div>
                        <h3 class="text-xl font-semibold text-gray-700">Nincs ilyen recept...</h3>
                    </div>

                    <!-- Receptkártyák szint szerinti csoportosításban -->
                    <?php foreach ($receptekSzintekSzerint as $szint => $lista): ?>
                        <div class="mb-16 szint-blokk" data-szint="<?= (int)$szint ?>">
                            <h2 class="text-3xl font-bold text-white mb-6 border-b border-white/40 pb-3">
                                <?= (int)$szint ?>. szint – <span class="szint-darab-fo" data-szint="<?= (int)$szint ?>"><?= count($lista) ?></span> recept
                            </h2>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                <?php foreach ($lista as $r): ?>
                                    <?php
                                    // Kártya-szintű előkészítés: név kereséshez, lock állapot, elkészítettem állapot.
                                    $nevLower = mb_strtolower((string)$r['Nev']);
                                    $rSzint = (int)($r['Szint'] ?? $r['NehezsegiSzintID'] ?? $szint);
                                    $locked = ($rSzint > (int)$aktualisSzint);
                                    $completed = isset($teljesitettSet[(int)$r['ReceptID']]);
                                    ?>

                                    <?php if (!$locked): ?>
                                        <a href="receptek.php?id=<?= (int)$r['ReceptID'] ?>"
                                            class="recept-kartya bg-white rounded-2xl shadow-xl overflow-hidden hover:-translate-y-1 transition block relative"
                                            <?php else: ?>
                                            <a href="javascript:void(0)"
                                            onclick="alert('Zárolt recept: Szint <?= $rSzint ?> szükséges.')"
                                            class="recept-kartya bg-white rounded-2xl shadow-xl overflow-hidden transition block relative cursor-not-allowed opacity-60"
                                            <?php endif; ?>
                                            data-recept-id="<?= (int)$r['ReceptID'] ?>"
                                            data-nev="<?= htmlspecialchars($nevLower) ?>"
                                            data-fokategoria="<?= htmlspecialchars($r['FoKategoriaNev'] ?? 'Nem kategorizált') ?>"
                                            data-alkategoria="<?= htmlspecialchars($r['AlkategoriaNev'] ?? 'Egyéb') ?>">

                                            <div class="relative">
                                                <img src="<?= htmlspecialchars(receptKepSrc($r['Kep'] ?? '')) ?>" class="w-full h-48 object-cover" alt="">
                                                <?php if ($locked): ?>
                                                    <div class="absolute inset-0 flex items-center justify-center">
                                                        <div class="bg-black/60 text-white px-3 py-2 rounded-lg text-sm font-semibold">
                                                            🔒 Szint <?= $rSzint ?> szükséges
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="p-5">
                                                <div class="flex justify-between text-xs text-gray-500 mb-2 font-semibold">
                                                    <span class="text-[#6F837B] uppercase"><?= htmlspecialchars($r['AlkategoriaNev'] ?? 'Egyéb') ?></span>
                                                    <span>⭐ <?= (int)$r['BegyujthetoPontok'] ?> pont</span>
                                                </div>

                                                <h2 class="text-lg font-bold mb-2 text-gray-800"><?= htmlspecialchars($r['Nev']) ?></h2>

                                                <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-gray-600">
                                                    <span>⏱ <?= formatIdo((string)$r['ElkeszitesiIdo']) ?></span>
                                                    <span>🔥 <?= formatMennyiseg((float)($r['Kaloria'] ?? 0)) ?> kcal</span>
                                                    <span>💰 <?= htmlspecialchars($r['ArkategoriaNev'] ?? 'Nincs') ?></span>
                                                </div>

                                                <?php if ($completed): ?>
                                                    <div class="mt-3 text-sm font-bold text-emerald-700">✓ Elkészítve</div>
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                <?php else: ?>
                    <!-- ===== 11) RÉSZLETES RECEPT NÉZET ===== -->

                    <!-- Részletes recept nézet -->

                    <a href="receptek.php" class="inline-flex items-center gap-2 mb-6 px-4 py-2 bg-white rounded-lg shadow hover:bg-gray-100 transition font-medium text-[#4A7043]">
                        ← Vissza a receptekhez
                    </a>

                    <?php if (is_array($detailStatus)): ?>
                        <!-- Visszajelző üzenet a recepthez kapcsolódó utolsó műveletről -->
                        <div class="mb-4 <?= $detailStatus[0] ?> px-4 py-3 rounded-xl font-medium"><?= $detailStatus[1] ?></div>
                    <?php endif; ?>

                    <!-- Recept fejléc (kép, cím, meta adatok) -->
                    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                        <div class="relative h-80">
                            <img src="<?= htmlspecialchars(receptKepSrc($recept['Kep'] ?? '')) ?>" class="absolute inset-0 w-full h-full object-cover" alt="">
                            <div class="absolute inset-0 bg-black/40"></div>

                            <div class="absolute bottom-6 left-8 text-white">
                                <h1 class="text-4xl font-bold mb-3"><?= htmlspecialchars($recept['Nev'] ?? '') ?></h1>
                                <div class="flex flex-wrap gap-3 text-sm">
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full">⏱ <?= formatIdo((string)($recept['ElkeszitesiIdo'] ?? '')) ?></span>
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full">⭐ <?= (int)($recept['BegyujthetoPontok'] ?? 0) ?> pont</span>
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full">🔥 <?= formatMennyiseg((float)($recept['Kaloria'] ?? 0)) ?> kcal</span>
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full">🏷 <?= htmlspecialchars($recept['AlkategoriaNev'] ?? '') ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="p-8 grid grid-cols-1 lg:grid-cols-[350px_1fr] gap-8">

                            <!-- Hozzávalók blokk -->
                            <div class="bg-[#F3F4F1] rounded-2xl p-6 h-fit">
                                <!-- Hozzávalók lista: kezeli az "ízlés szerint" mértékegységet is -->
                                <h2 class="text-xl font-bold mb-4 text-[#4A7043] flex items-center gap-2">Hozzávalók</h2>
                                <ul class="space-y-3 text-sm">
                                    <?php foreach ($hozzavalok as $h): ?>
                                        <?php
                                        $mertekegyseg = trim((string)($h['Mertekegyseg'] ?? ''));
                                        $mertekegysegLower = function_exists('mb_strtolower')
                                            ? mb_strtolower($mertekegyseg, 'UTF-8')
                                            : strtolower($mertekegyseg);
                                        $izlesSzerint = in_array($mertekegysegLower, ['ízlés szerint', 'izles szerint'], true);
                                        ?>
                                        <li class="flex gap-2 items-start">
                                            <?php if ($izlesSzerint): ?>
                                                <span class="font-bold text-[#6F837B] min-w-[30px]">ízlés szerint</span>
                                                <span class="text-gray-700"><?= htmlspecialchars($h['Elnevezes'] ?? '') ?></span>
                                            <?php else: ?>
                                                <span class="font-bold text-[#6F837B] min-w-[30px]">
                                                    <?= formatMennyiseg($h['Mennyiseg'] ?? 0) ?> <?= htmlspecialchars($mertekegyseg) ?>
                                                </span>
                                                <span class="text-gray-700"><?= htmlspecialchars($h['Elnevezes'] ?? '') ?></span>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div>

                                <!-- Elkészítési lépések + pontjóváírás gomb -->
                                <h2 class="text-xl font-bold mb-6 flex items-center gap-2">Elkészítés menete</h2>
                                <ol class="space-y-6 text-gray-700">
                                    <?php
                                    $lepesek = explode("\n", (string)($recept['Elkeszitesi_leiras'] ?? ''));
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
                                    <!-- Gomblogika: nincs login / már jóváírva / jóváírás beküldése -->
                                    <?php if ($sessionFelhasznaloId <= 0): ?>
                                        <a href="../../views/autentikacio/autentikacio.php"
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
                                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars((string)($_SESSION['csrf_token'] ?? '')) ?>">

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

<!-- ===== 12) KONFETTI SZINTLÉPÉS ANIMÁCIÓ ===== -->
<?php if ($szintLepett): ?>
    <script>
        (function() {
            // Canvas létrehozása a konfetti részecskékhez
            const canvas = document.createElement('canvas');
            canvas.id = 'konfettiCanvas';
            Object.assign(canvas.style, {
                position: 'fixed',
                top: 0,
                left: 0,
                width: '100%',
                height: '100%',
                pointerEvents: 'none',
                zIndex: 9999
            });
            document.body.appendChild(canvas);

            const ctx = canvas.getContext('2d');
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;

            // Szintlépés értesítő banner
            const banner = document.createElement('div');
            banner.innerHTML = `
        <div style="font-size:2.2rem;font-weight:900;letter-spacing:-1px;">🎉 Szint elérve!</div>
        <div style="font-size:1.1rem;margin-top:6px;opacity:.85;"><?= (int)$aktualisSzint ?>. szint feloldva — gratulálunk!</div>
    `;
            Object.assign(banner.style, {
                position: 'fixed',
                top: '50%',
                left: '50%',
                transform: 'translate(-50%,-50%) scale(0)',
                background: 'linear-gradient(135deg,#4A7043,#6F837B)',
                color: '#fff',
                padding: '32px 48px',
                borderRadius: '24px',
                boxShadow: '0 24px 80px rgba(0,0,0,.35)',
                zIndex: 10000,
                textAlign: 'center',
                transition: 'transform .45s cubic-bezier(.175,.885,.32,1.275)',
                fontFamily: 'system-ui,sans-serif'
            });
            document.body.appendChild(banner);

            // Banner megjelenítése rövid késéssel (animáció)
            setTimeout(() => banner.style.transform = 'translate(-50%,-50%) scale(1)', 80);

            // Banner eltüntetése 4 másodperc után
            setTimeout(() => {
                banner.style.transition = 'opacity .5s ease';
                banner.style.opacity = '0';
                setTimeout(() => banner.remove(), 500);
            }, 4000);

            // Konfetti részecskék inicializálása
            const COLORS = ['#4A7043', '#6F837B', '#95A792', '#FFD166', '#EF476F', '#ffffff', '#06D6A0', '#118AB2', '#FFC8DD', '#CAFFBF'];
            const SHAPES = ['rect', 'circle', 'triangle'];
            const COUNT = 200;

            const pieces = Array.from({
                length: COUNT
            }, () => ({
                x: Math.random() * canvas.width,
                y: -20 - Math.random() * 400,
                r: 6 + Math.random() * 10,
                color: COLORS[Math.floor(Math.random() * COLORS.length)],
                shape: SHAPES[Math.floor(Math.random() * SHAPES.length)],
                vx: (Math.random() - .5) * 4,
                vy: 2 + Math.random() * 5,
                spin: (Math.random() - .5) * .25,
                angle: Math.random() * Math.PI * 2,
                opacity: 1,
                wobble: Math.random() * Math.PI * 2,
                wobbleSpeed: .05 + Math.random() * .05,
            }));

            let frame, start = null;
            const DURATION = 5500;

            function drawPiece(p) {
                ctx.save();
                ctx.globalAlpha = p.opacity;
                ctx.fillStyle = p.color;
                ctx.translate(p.x, p.y);
                ctx.rotate(p.angle);

                if (p.shape === 'rect') {
                    ctx.fillRect(-p.r / 2, -p.r / 3, p.r, p.r / 1.5);
                } else if (p.shape === 'circle') {
                    ctx.beginPath();
                    ctx.arc(0, 0, p.r / 2, 0, Math.PI * 2);
                    ctx.fill();
                } else {
                    // Háromszög
                    ctx.beginPath();
                    ctx.moveTo(0, -p.r / 2);
                    ctx.lineTo(p.r / 2, p.r / 2);
                    ctx.lineTo(-p.r / 2, p.r / 2);
                    ctx.closePath();
                    ctx.fill();
                }

                ctx.restore();
            }

            function tick(ts) {
                if (!start) start = ts;
                const elapsed = ts - start;
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                pieces.forEach(p => {
                    p.wobble += p.wobbleSpeed;
                    p.x += p.vx + Math.sin(p.wobble) * 1.5;
                    p.y += p.vy;
                    p.angle += p.spin;

                    // Fokozatos elhalványulás az animáció vége felé
                    if (elapsed > DURATION * .6) {
                        p.opacity = Math.max(0, p.opacity - .01);
                    }

                    drawPiece(p);
                });

                if (elapsed < DURATION + 800) {
                    frame = requestAnimationFrame(tick);
                } else {
                    canvas.remove();
                }
            }

            frame = requestAnimationFrame(tick);

            // Canvas újraméretezés ablak átméretezésekor
            window.addEventListener('resize', () => {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
            });
        })();
    </script>
<?php endif; ?>

<!-- ===== 13) OLDALSPECIFIKUS JS (SZŰRÉS, SIDEBAR, KÁRTYA MEGJELENÍTÉS) ===== -->
<script src="../../assets/js/receptek.js"></script>
<?php include __DIR__ . '/../footer.php'; ?>