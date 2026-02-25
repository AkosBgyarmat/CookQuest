<?php 
session_start();
include_once "../head.php"; ?>

<main class="w-full bg-[#90ab8b]">
    <div class="max-w-6xl mx-auto px-4 py-10">

        <!-- Cím -->
        <div class="border-b border-gray-300 text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold mb-5 text-white">
                Adatkezelési tájékoztató
            </h1>
        </div>

        <div class="space-y-10 list-decimal list-inside text-gray-800">

            <!-- 1 -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    Az adatkezelő adatai
                </h2>
                <p>
                    Név: CookQuest <br>
                    Székhely: Oktatási projekt <br>
                    E-mail: info@cookquest.hu
                </p>
                <p class="mt-4">
                    Jelen adatkezelési tájékoztató célja, hogy rögzítse a weboldal használata során alkalmazott adatkezelési elveket.
                    Az adatkezelés a GDPR rendelet előírásainak megfelelően történik.
                </p>
            </div>

            <!-- 2 -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    A kezelt adatok köre
                </h2>
                <ul class="list-disc list-inside space-y-2">
                    <li>Regisztráció esetén: név, e-mail cím, felhasználónév, titkosított jelszó</li>
                    <li>Kapcsolatfelvétel esetén: név, e-mail cím, üzenet tartalma</li>
                    <li>Technikai adatok: IP-cím, böngésző típusa, eszköz típusa, látogatás időpontja</li>
                </ul>
            </div>

            <!-- 3 -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    Az adatkezelés célja
                </h2>
                <ul class="list-disc list-inside space-y-2">
                    <li>A weboldal működésének biztosítása</li>
                    <li>Felhasználói fiók kezelése</li>
                    <li>Kapcsolattartás</li>
                    <li>Szolgáltatás fejlesztése</li>
                    <li>Biztonság fenntartása</li>
                </ul>
            </div>

            <!-- 4 -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    Az adatkezelés jogalapja
                </h2>
                <p>
                    Az adatkezelés jogalapja a felhasználó önkéntes hozzájárulása,
                    szerződés teljesítése (regisztráció esetén),
                    valamint az adatkezelő jogos érdeke.
                </p>
            </div>

            <!-- 5 -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    Az adatok tárolásának időtartama
                </h2>
                <ul class="list-disc list-inside space-y-2">
                    <li>Felhasználói fiók törléséig</li>
                    <li>Kapcsolatfelvétel esetén legfeljebb 1 évig</li>
                    <li>Technikai adatok esetén legfeljebb 6 hónapig</li>
                </ul>
            </div>

            <!-- 6 -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    Adatbiztonság
                </h2>
                <p>
                    Az adatkezelő minden szükséges technikai és szervezési intézkedést megtesz
                    a személyes adatok védelme érdekében.
                    A jelszavak titkosított formában kerülnek tárolásra.
                </p>
            </div>

            <!-- 7 -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    Adattovábbítás
                </h2>
                <p>
                    A személyes adatok harmadik fél részére nem kerülnek átadásra,
                    kivéve jogszabályi kötelezettség vagy hatósági megkeresés esetén.
                </p>
            </div>

            <!-- 8 -->
            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    A felhasználók jogai
                </h2>
                <ul class="list-disc list-inside space-y-2">
                    <li>Tájékoztatáshoz való jog</li>
                    <li>Helyesbítéshez való jog</li>
                    <li>Törléshez való jog</li>
                    <li>Adatkezelés korlátozásához való jog</li>
                    <li>Adathordozhatósághoz való jog</li>
                </ul>
            </div>

            <!-- 9 -->

            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    Süti (Cookie) kezelés
                </h2>
                <p>
                    A weboldal sütiket használ a megfelelő működés és a felhasználói élmény javítása érdekében.
                    A sütik részletes leírása a Cookie Tájékoztatóban található.
                </p>
            </div>


            <!-- 10 -->

            <div class="bg-white p-8 rounded-2xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">
                    Jogorvoslati lehetőség
                </h2>
                <p>
                    Panasz esetén a Nemzeti Adatvédelmi és Információszabadság Hatósághoz (NAIH)
                    lehet fordulni.
                </p>
            </div>
        </div>
    </div>
</main>

<?php include_once "../footer.php"; ?>