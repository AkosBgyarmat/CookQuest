-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2026. Jan 22. 12:44
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `cook`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `alkategoria`
--

CREATE TABLE `alkategoria` (
  `AlkategoriaID` int(11) NOT NULL,
  `KategoriaID` int(11) NOT NULL,
  `Alkategoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `alkategoria`
--

INSERT INTO `alkategoria` (`AlkategoriaID`, `KategoriaID`, `Alkategoria`) VALUES
(1, 1, 'Reggeli'),
(2, 1, 'Desszert');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `elkeszitesimod`
--

CREATE TABLE `elkeszitesimod` (
  `ElkeszitesiModID` int(11) NOT NULL,
  `ElkeszitesiMod` varchar(255) NOT NULL,
  `Hofok` int(11) DEFAULT NULL,
  `Funkcio` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `elkeszitesimod`
--

INSERT INTO `elkeszitesimod` (`ElkeszitesiModID`, `ElkeszitesiMod`, `Hofok`, `Funkcio`) VALUES
(1, 'Serpenyőben sütés', NULL, 'tűzhely'),
(2, 'Nem sütős desszert', NULL, 'nincs'),
(3, 'Kenyérpirító', NULL, 'pirítás');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo`
--

CREATE TABLE `felhasznalo` (
  `FelhasznaloID` int(11) NOT NULL,
  `Vezeteknev` varchar(50) NOT NULL,
  `Keresztnev` varchar(50) NOT NULL,
  `Felhasznalonev` varchar(30) NOT NULL,
  `Emailcim` varchar(254) NOT NULL,
  `Jelszo` varchar(255) NOT NULL,
  `SzuletesiEv` year(4) NOT NULL,
  `Profilkep` varchar(255) DEFAULT NULL,
  `OrszagID` int(11) NOT NULL,
  `RegisztracioEve` year(4) NOT NULL,
  `MegszerzettPontok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo_hozzavalo`
--

CREATE TABLE `felhasznalo_hozzavalo` (
  `FelhasznaloID` int(11) NOT NULL,
  `HozzavaloID` int(11) NOT NULL,
  `Mennyiseg` decimal(6,2) NOT NULL,
  `MertekegysegID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo_recept`
--

CREATE TABLE `felhasznalo_recept` (
  `FelhasznaloID` int(11) NOT NULL,
  `ReceptID` int(11) NOT NULL,
  `Elkeszitette` tinyint(1) DEFAULT 0,
  `KedvencReceptek` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hozzavalo`
--

CREATE TABLE `hozzavalo` (
  `HozzavaloID` int(11) NOT NULL,
  `Elnevezes` varchar(50) NOT NULL,
  `Kep` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `hozzavalo`
--

INSERT INTO `hozzavalo` (`HozzavaloID`, `Elnevezes`, `Kep`) VALUES
(17, 'tojás', NULL),
(18, 'liszt', NULL),
(19, 'tej', NULL),
(20, 'cukor', NULL),
(21, 'olaj', NULL),
(22, 'só', NULL),
(23, 'szóda', NULL),
(24, 'vaj', NULL),
(25, 'lekvár', NULL),
(26, 'joghurt', NULL),
(27, 'gyümölcs', NULL),
(28, 'méz', NULL),
(29, 'zabpehely', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategoria`
--

CREATE TABLE `kategoria` (
  `KategoriaID` int(11) NOT NULL,
  `Kategoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `kategoria`
--

INSERT INTO `kategoria` (`KategoriaID`, `Kategoria`) VALUES
(1, 'Étel');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `mertekegyseg`
--

CREATE TABLE `mertekegyseg` (
  `MertekegysegID` int(11) NOT NULL,
  `Elnevezes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `mertekegyseg`
--

INSERT INTO `mertekegyseg` (`MertekegysegID`, `Elnevezes`) VALUES
(1, 'db'),
(2, 'ml'),
(3, 'g'),
(4, 'ízlés szerint');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `nehezsegiszint`
--

CREATE TABLE `nehezsegiszint` (
  `NehezsegiSzintID` int(11) NOT NULL,
  `Szint` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `nehezsegiszint`
--

INSERT INTO `nehezsegiszint` (`NehezsegiSzintID`, `Szint`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orszag`
--

CREATE TABLE `orszag` (
  `OrszagID` int(11) NOT NULL,
  `Elnevezes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `orszag`
--

INSERT INTO `orszag` (`OrszagID`, `Elnevezes`) VALUES
(1, 'Magyarország');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `recept`
--

CREATE TABLE `recept` (
  `ReceptID` int(11) NOT NULL,
  `Nev` varchar(150) NOT NULL,
  `Kep` varchar(255) DEFAULT NULL,
  `ElkeszitesiIdo` time NOT NULL,
  `NehezsegiSzintID` int(11) NOT NULL,
  `BegyujthetoPontok` int(11) NOT NULL,
  `Adag` int(11) NOT NULL,
  `Elkeszitesi_leiras` text NOT NULL,
  `ElkeszitesiModID` int(11) NOT NULL,
  `Koltseg` int(11) NOT NULL,
  `AlkategoriaID` int(11) NOT NULL,
  `Kaloria` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `recept`
--

INSERT INTO `recept` (`ReceptID`, `Nev`, `Kep`, `ElkeszitesiIdo`, `NehezsegiSzintID`, `BegyujthetoPontok`, `Adag`, `Elkeszitesi_leiras`, `ElkeszitesiModID`, `Koltseg`, `AlkategoriaID`, `Kaloria`) VALUES
(8, 'Tükörtojás', 'images/foods/tukortojas.webp', '00:10:00', 1, 15, 1, 'A tojásokat óvatosan üsd egy kis tálba vagy csészébe egyesével – így ha rossz lenne valamelyik, nem rontja el az egészet.\r\nMelegítsd fel az olajat vagy vajat egy kisebb serpenyőben közepes lángon. Az olaj akkor jó, ha enyhén csillog, de még nem füstöl (ha füstöl, vedd lejjebb a lángot, különben keserű lesz).\r\nHa a zsiradék forró, óvatosan csúsztasd bele a tojásokat a tálból (ne dobd bele nagy magasságból, nehogy szétfröccsenjen a zsiradék).\r\nSüsd addig, amíg a fehérje teljesen kifehéredik és megszilárdul, de a sárgája még lágy marad (kb. 3–4 perc). Ha kemény sárgáját szeretnél, fordítsd át a tojást még 10–15 másodpercre.\r\nSózd, borsozd, és azonnal tálald pirítóssal vagy friss zöldséggel.\r\nÍzesítsd sóval, borssal, és azonnal tálald.\r\n', 1, 180, 1, 180.00),
(9, 'Tojásrántotta', 'images/foods/Rantotta.webp', '00:05:00', 1, 15, 1, 'Verd fel a tojásokat egy tálban villával vagy habverővel, sózd meg enyhén. Ne verd túl habosra, csak keverd össze.\r\nOlvaszd meg a vajat (vagy melegítsd az olajat) egy serpenyőben közepes lángon.\r\nÖntsd bele a tojást. Folyamatosan keverd fakanállal vagy szilikon spatulával körkörös mozdulatokkal, hogy egyenletesen süljön (kb. 2–3 perc).\r\nVedd le a tűzről, amikor már majdnem kész, de még kicsit lágy, krémes az állaga – a maradék hő tovább főzi.\r\nTálald azonnal, mellé félbevágott koktélparadicsommal vagy más friss körettel.\r\n', 1, 200, 1, 210.00),
(10, 'Bundás kenyér', 'images/foods/bundasKenyer.webp', '00:10:00', 1, 15, 1, 'Verd fel a tojásokat egy lapos tányérban vagy tálban, sózd meg enyhén.\r\nMártsd bele a kenyérszeleteket rövid időre (2–3 másodperc oldalanként) – ne áztasd túl, különben szétesik!\r\nHevíts bő olajat egy serpenyőben közepes lángon. Ellenőrizd: ha egy kis tojásos morzsát beledobsz, azonnal pezsegnie kell.\r\nTedd bele a beáztatott kenyereket, süsd mindkét oldalon aranybarnára (oldalanként kb. 2–3 perc).\r\nPapírtörlőre szedd ki, hogy lecsepegjen a felesleges olaj.\r\n', 1, 300, 1, 350.00),
(11, 'Pirítós vajjal vagy lekvárral', 'images/foods/PiritosKenyer.webp', '00:05:00', 1, 15, 1, 'Tedd a kenyereket kenyérpirítóba és pirítsd meg (vagy serpenyőben 1–2 perc oldalanként közepes lángon, vaj nélkül).\r\nAmint kész, kend meg vékonyan vajjal (vagy vastagabban lekvárral).\r\nAzonnal fogyaszd, amíg ropogós.\r\n', 1, 120, 1, 200.00),
(12, 'Gyümölcsös joghurtos pohárkrém', 'images/foods/GyumolcsosPohardesszert.webp', '00:05:00', 1, 10, 1, 'A gyümölcsöt mosd meg, ha szükséges, vágd kisebb darabokra (fagyasztottat hagyd kicsit felengedni).\r\nEgy átlátszó pohárba rétegezd: alul egy kis joghurt, rá gyümölcs, majd ismét joghurt – így szép lesz réteges.\r\nVégül csurgasd rá a mézet.\r\nTedd hűtőbe 10–15 percre, hogy az ízek összeérjenek (de azonnal is fogyasztható).\r\n', 2, 400, 2, 220.00),
(13, 'Zabpelyhes-mézes pohárdesszert', 'images/foods/ZabpelyhesMezesPohardesszert.webp', '00:05:00', 1, 10, 1, 'Egy pohárba rétegezd: alul egy kevés joghurt, rá zabpehely, majd ismét joghurt – összesen 2–3 réteg.\r\nCsurgasd rá a mézet a tetejére.\r\nTedd hűtőbe 5–10 percre (vagy akár 30 percre), hogy a zab kissé megpuhuljon és az ízek összeérjenek.\r\nKeverd át evés előtt, ha krémesebb állagot szeretnél.\r\n', 2, 250, 2, 300.00),
(14, 'Palacsinta', 'images/foods/Palacsinta.webp', '00:05:00', 1, 10, 1, 'Egy nagy tálban verd fel a tojásokat a cukorral/sóval.\r\nAdd hozzá a lisztet, tejet, szódát és olajat. Keverd simára botmixerrel vagy kézi habverővel – a tészta legyen híg palacsinta tészta állagú (kicsit legyen hígabb mint a tejföl). Ha csomós, szűrd át.\r\nHevíts egy palacsintasütőt vagy tapadásmentes serpenyőt közepes lángon, kenj ki vékonyan olajjal (papírtörlővel).\r\nMerj bele egy merőkanál tésztát, döntsd meg a serpenyőt, hogy vékonyan elterüljön.\r\nSüsd kb. 1–1,5 percig, amíg a széle elválik és a teteje már nem folyós – akkor fordítsd meg.\r\nA másik oldalát is süsd 30–60 másodpercig.\r\nA kész palacsintákat tányérra rakd, fedd le, hogy ne száradjanak ki. \r\n\r\nSós verzióhoz, hagyjuk el a cukrot belőle, és mehet bele 2 csipet só.\r\n', 1, 400, 2, 220.00);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `recept_hozzavalo`
--

CREATE TABLE `recept_hozzavalo` (
  `ReceptID` int(11) NOT NULL,
  `HozzavaloID` int(11) NOT NULL,
  `Mennyiseg` decimal(6,2) NOT NULL,
  `MertekegysegID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `recept_hozzavalo`
--

INSERT INTO `recept_hozzavalo` (`ReceptID`, `HozzavaloID`, `Mennyiseg`, `MertekegysegID`) VALUES
(8, 17, 2.00, 1),
(8, 21, 15.00, 2),
(8, 22, 1.00, 4),
(9, 17, 3.00, 1),
(9, 22, 1.00, 4),
(9, 24, 1.00, 3),
(10, 17, 2.00, 1),
(10, 21, 50.00, 2),
(10, 22, 1.00, 4),
(11, 24, 10.00, 3),
(11, 25, 30.00, 3),
(12, 26, 150.00, 3),
(12, 27, 100.00, 3),
(12, 28, 20.00, 3),
(13, 26, 150.00, 3),
(13, 28, 20.00, 3),
(13, 29, 40.00, 3),
(14, 17, 3.00, 1),
(14, 18, 240.00, 3),
(14, 19, 250.00, 2),
(14, 20, 30.00, 3),
(14, 21, 50.00, 2),
(14, 23, 250.00, 2);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `alkategoria`
--
ALTER TABLE `alkategoria`
  ADD PRIMARY KEY (`AlkategoriaID`),
  ADD KEY `KategoriaID` (`KategoriaID`);

--
-- A tábla indexei `elkeszitesimod`
--
ALTER TABLE `elkeszitesimod`
  ADD PRIMARY KEY (`ElkeszitesiModID`);

--
-- A tábla indexei `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD PRIMARY KEY (`FelhasznaloID`),
  ADD KEY `OrszagID` (`OrszagID`);

--
-- A tábla indexei `felhasznalo_hozzavalo`
--
ALTER TABLE `felhasznalo_hozzavalo`
  ADD PRIMARY KEY (`FelhasznaloID`,`HozzavaloID`),
  ADD KEY `HozzavaloID` (`HozzavaloID`),
  ADD KEY `MertekegysegID` (`MertekegysegID`);

--
-- A tábla indexei `felhasznalo_recept`
--
ALTER TABLE `felhasznalo_recept`
  ADD PRIMARY KEY (`FelhasznaloID`,`ReceptID`),
  ADD KEY `ReceptID` (`ReceptID`);

--
-- A tábla indexei `hozzavalo`
--
ALTER TABLE `hozzavalo`
  ADD PRIMARY KEY (`HozzavaloID`);

--
-- A tábla indexei `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`KategoriaID`);

--
-- A tábla indexei `mertekegyseg`
--
ALTER TABLE `mertekegyseg`
  ADD PRIMARY KEY (`MertekegysegID`);

--
-- A tábla indexei `nehezsegiszint`
--
ALTER TABLE `nehezsegiszint`
  ADD PRIMARY KEY (`NehezsegiSzintID`);

--
-- A tábla indexei `orszag`
--
ALTER TABLE `orszag`
  ADD PRIMARY KEY (`OrszagID`);

--
-- A tábla indexei `recept`
--
ALTER TABLE `recept`
  ADD PRIMARY KEY (`ReceptID`),
  ADD KEY `NehezsegiSzintID` (`NehezsegiSzintID`),
  ADD KEY `ElkeszitesiModID` (`ElkeszitesiModID`),
  ADD KEY `AlkategoriaID` (`AlkategoriaID`);

--
-- A tábla indexei `recept_hozzavalo`
--
ALTER TABLE `recept_hozzavalo`
  ADD PRIMARY KEY (`ReceptID`,`HozzavaloID`),
  ADD KEY `HozzavaloID` (`HozzavaloID`),
  ADD KEY `MertekegysegID` (`MertekegysegID`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `alkategoria`
--
ALTER TABLE `alkategoria`
  MODIFY `AlkategoriaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `elkeszitesimod`
--
ALTER TABLE `elkeszitesimod`
  MODIFY `ElkeszitesiModID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `felhasznalo`
--
ALTER TABLE `felhasznalo`
  MODIFY `FelhasznaloID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `hozzavalo`
--
ALTER TABLE `hozzavalo`
  MODIFY `HozzavaloID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT a táblához `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `KategoriaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `mertekegyseg`
--
ALTER TABLE `mertekegyseg`
  MODIFY `MertekegysegID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `nehezsegiszint`
--
ALTER TABLE `nehezsegiszint`
  MODIFY `NehezsegiSzintID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `orszag`
--
ALTER TABLE `orszag`
  MODIFY `OrszagID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `recept`
--
ALTER TABLE `recept`
  MODIFY `ReceptID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `alkategoria`
--
ALTER TABLE `alkategoria`
  ADD CONSTRAINT `alkategoria_ibfk_1` FOREIGN KEY (`KategoriaID`) REFERENCES `kategoria` (`KategoriaID`);

--
-- Megkötések a táblához `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD CONSTRAINT `felhasznalo_ibfk_1` FOREIGN KEY (`OrszagID`) REFERENCES `orszag` (`OrszagID`);

--
-- Megkötések a táblához `felhasznalo_hozzavalo`
--
ALTER TABLE `felhasznalo_hozzavalo`
  ADD CONSTRAINT `felhasznalo_hozzavalo_ibfk_1` FOREIGN KEY (`FelhasznaloID`) REFERENCES `felhasznalo` (`FelhasznaloID`),
  ADD CONSTRAINT `felhasznalo_hozzavalo_ibfk_2` FOREIGN KEY (`HozzavaloID`) REFERENCES `hozzavalo` (`HozzavaloID`),
  ADD CONSTRAINT `felhasznalo_hozzavalo_ibfk_3` FOREIGN KEY (`MertekegysegID`) REFERENCES `mertekegyseg` (`MertekegysegID`);

--
-- Megkötések a táblához `felhasznalo_recept`
--
ALTER TABLE `felhasznalo_recept`
  ADD CONSTRAINT `felhasznalo_recept_ibfk_1` FOREIGN KEY (`FelhasznaloID`) REFERENCES `felhasznalo` (`FelhasznaloID`) ON DELETE CASCADE,
  ADD CONSTRAINT `felhasznalo_recept_ibfk_2` FOREIGN KEY (`ReceptID`) REFERENCES `recept` (`ReceptID`) ON DELETE CASCADE;

--
-- Megkötések a táblához `recept`
--
ALTER TABLE `recept`
  ADD CONSTRAINT `recept_ibfk_1` FOREIGN KEY (`NehezsegiSzintID`) REFERENCES `nehezsegiszint` (`NehezsegiSzintID`),
  ADD CONSTRAINT `recept_ibfk_2` FOREIGN KEY (`ElkeszitesiModID`) REFERENCES `elkeszitesimod` (`ElkeszitesiModID`),
  ADD CONSTRAINT `recept_ibfk_3` FOREIGN KEY (`AlkategoriaID`) REFERENCES `alkategoria` (`AlkategoriaID`);

--
-- Megkötések a táblához `recept_hozzavalo`
--
ALTER TABLE `recept_hozzavalo`
  ADD CONSTRAINT `recept_hozzavalo_ibfk_1` FOREIGN KEY (`ReceptID`) REFERENCES `recept` (`ReceptID`) ON DELETE CASCADE,
  ADD CONSTRAINT `recept_hozzavalo_ibfk_2` FOREIGN KEY (`HozzavaloID`) REFERENCES `hozzavalo` (`HozzavaloID`),
  ADD CONSTRAINT `recept_hozzavalo_ibfk_3` FOREIGN KEY (`MertekegysegID`) REFERENCES `mertekegyseg` (`MertekegysegID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
