<?php 
session_start();
include_once "../head.php"; ?>

<main class="w-full bg-[#90ab8b]">
    <div class="max-w-6xl mx-auto px-4 py-10">

        <!-- Cím -->
        <div class="border-b border-gray-300 text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold mb-5 text-white">
                Süti (Cookie) Tájékoztató
            </h1>
            <p class="text-white text-sm mb-5">
                Hatályos: 2026. január 1.
            </p>
        </div>

        <div class="space-y-10 text-gray-800">

            <!-- 1 -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    1. Az adatkezelő adatai
                </h2>
                <p>
                    Az adatkezelő: CookQuest (oktatási célú webalkalmazás)<br>
                    Székhely: Magyarország<br>
                    E-mail: info@cookquest.hu<br>
                </p>
            </div>

            <!-- 2 -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    2. A sütik fogalma
                </h2>
                <p>
                    A süti (cookie) egy olyan kis adatcsomag, amelyet a weboldal a felhasználó 
                    eszközén tárol. A sütik célja a weboldal működésének biztosítása, 
                    a felhasználói élmény javítása, valamint bizonyos funkciók fenntartása.
                </p>
            </div>

            <!-- 3 -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    3. Jogszabályi háttér
                </h2>
                <p>
                    A süti kezelés az alábbi jogszabályok alapján történik:
                </p>
                <ul class="list-disc list-inside mt-3 space-y-2">
                    <li>Az Európai Parlament és Tanács (EU) 2016/679 rendelete (GDPR)</li>
                    <li>2003. évi C. törvény az elektronikus hírközlésről</li>
                    <li>2011. évi CXII. törvény az információs önrendelkezési jogról</li>
                </ul>
            </div>

            <!-- 4 -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    4. A kezelt sütik típusai
                </h2>
                <ul class="list-disc list-inside space-y-2">
                    <li>
                        <strong>Munkamenet sütik (Session cookie):</strong> 
                        A weboldal biztonságos működéséhez szükségesek, 
                        például bejelentkezési állapot fenntartására.
                    </li>
                    <li>
                        <strong>Funkcionális sütik:</strong> 
                        A felhasználói beállítások rögzítésére szolgálnak 
                        (pl. süti elfogadás).
                    </li>
                </ul>
            </div>

            <!-- 5 -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    5. A sütik célja
                </h2>
                <p>
                    A sütik célja:
                </p>
                <ul class="list-disc list-inside mt-3 space-y-2">
                    <li>A weboldal alapvető működésének biztosítása</li>
                    <li>A felhasználói munkamenet fenntartása</li>
                    <li>A rendszer biztonságának növelése</li>
                    <li>A felhasználói élmény javítása</li>
                </ul>
            </div>

            <!-- 6 -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    6. A sütik élettartama
                </h2>
                <p>
                    A munkamenet sütik a böngésző bezárásáig maradnak aktívak.
                    A funkcionális sütik – például a süti elfogadás rögzítése –
                    legfeljebb 1 évig kerülnek tárolásra a felhasználó eszközén.
                </p>
            </div>

            <!-- 7 -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    7. Harmadik fél által elhelyezett sütik
                </h2>
                <p>
                    A CookQuest jelenleg nem alkalmaz marketing, analitikai 
                    vagy harmadik fél által elhelyezett követési sütiket.
                </p>
            </div>

            <!-- 8 -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    8. A sütik kezelése és törlése
                </h2>
                <p>
                    A felhasználó böngészője beállításaiban lehetősége van 
                    a sütik törlésére, letiltására vagy kezelésére.
                    A sütik letiltása esetén azonban előfordulhat, hogy 
                    a weboldal bizonyos funkciói nem működnek megfelelően.
                </p>
            </div>

            <!-- 9 -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    9. Kapcsolat és jogorvoslat
                </h2>
                <p>
                    A felhasználó adatkezeléssel kapcsolatos kérdéseivel 
                    az adatkezelőhöz fordulhat a fenti elérhetőségen.
                    Jogorvoslatért a Nemzeti Adatvédelmi és Információszabadság Hatósághoz (NAIH) fordulhat.
                </p>
            </div>

        </div>

    </div>
</main>

<?php include_once "../footer.php"; ?>