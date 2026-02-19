-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2026. Feb 18. 11:06
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `cookquest`
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
(1, 1, 'sültek'),
(2, 1, 'pörkölt'),
(3, 1, 'raguk'),
(4, 1, 'főzelék'),
(5, 2, 'krém leves'),
(6, 2, 'húsos leves'),
(7, 3, 'sütemény'),
(8, 3, 'pohárkrém'),
(9, 4, 'tojásos reggeli'),
(10, 5, 'zöldség köret'),
(11, 2, 'zöldség leves'),
(12, 2, 'tojás leves');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `arkategoria`
--

CREATE TABLE `arkategoria` (
  `ArkategoriaID` int(11) NOT NULL,
  `Arkategoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `arkategoria`
--

INSERT INTO `arkategoria` (`ArkategoriaID`, `Arkategoria`) VALUES
(1, 'olcsó'),
(2, 'megfizethető'),
(3, 'drága');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `besorolas`
--

CREATE TABLE `besorolas` (
  `BesorolasID` int(11) NOT NULL,
  `Elnevezes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `besorolas`
--

INSERT INTO `besorolas` (`BesorolasID`, `Elnevezes`) VALUES
(1, 'Evőeszköz'),
(2, 'Szedőkanál'),
(3, 'Szűrő'),
(4, 'Keverőeszköz'),
(5, 'Adagoló'),
(6, 'Tálalóeszköz'),
(7, 'Merítőeszköz'),
(8, 'Vágóeszköz'),
(9, 'Desszert evőeszköz'),
(10, 'Speciális evőeszköz'),
(11, 'Kellék'),
(12, 'Konyhai kisgép'),
(13, 'Konyhai nagygép'),
(14, 'Edény');

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
(3, 'Kenyérpirító', NULL, 'pirítás'),
(4, 'Főzés', NULL, 'tűzhely'),
(5, 'Lassú főzés', NULL, 'tűzhely'),
(6, 'Alsó-felső sütés', 180, 'sütő'),
(7, 'Mikrohullámú sütés', NULL, 'mikrohullámú sütő'),
(8, 'Olajban sütés', NULL, 'tűzhely');

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
  `Profilkep` varchar(255) NOT NULL,
  `OrszagID` int(11) NOT NULL,
  `RegisztracioEve` year(4) NOT NULL,
  `MegszerzettPontok` int(11) NOT NULL,
  `SzerepID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `felhasznalo`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo_hozzavalo`
--

CREATE TABLE `felhasznalo_hozzavalo` (
  `FelhasznaloID` int(11) NOT NULL,
  `HozzavaloID` int(11) NOT NULL,
  `Mennyiseg` decimal(10,2) NOT NULL,
  `MertekegysegID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Hűtő';

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo_recept`
--

CREATE TABLE `felhasznalo_recept` (
  `FelhasznaloID` int(11) NOT NULL,
  `ReceptID` int(11) NOT NULL,
  `Elkeszitette` tinyint(1) DEFAULT NULL,
  `KedvencReceptek` tinyint(1) DEFAULT NULL
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
(29, 'zabpehely', NULL),
(30, 'kenyér', NULL),
(31, 'sárgarépa', NULL),
(32, 'fehérrépa', NULL),
(33, 'karalábé', NULL),
(34, 'zellergumó', NULL),
(35, 'vöröshagyma', NULL),
(36, 'petrezselyem', NULL),
(37, 'babérlevél', NULL),
(38, 'egész bors', NULL),
(39, 'víz', NULL),
(40, 'őrölt kömény', NULL),
(41, 'pirospaprika', NULL),
(42, 'ecet', NULL),
(43, 'sertés karajcsont', NULL),
(44, 'csigatészta', NULL),
(45, 'paradicsomlé', NULL),
(46, 'sűrített paradicsom', NULL),
(47, 'betűtészta', NULL),
(48, 'darált háztartási keksz', NULL),
(49, 'habtejszín', NULL),
(50, 'porcukor', NULL),
(51, 'vaníliás cukor', NULL),
(52, 'kakaópor', NULL),
(53, 'mascarpone', NULL),
(54, 'babapiskóta', NULL),
(55, 'kávé', NULL),
(56, 'rum / aroma', NULL),
(57, 'brokkoli', NULL),
(58, 'burgonya', NULL),
(59, 'főzőtejszín', NULL),
(60, 'sütőtök', NULL),
(61, 'bacon', NULL),
(62, 'levesgyöngy', NULL),
(63, 'csirkemell', NULL),
(64, 'rizs', NULL),
(65, 'bors', NULL),
(66, 'sertéskaraj', NULL),
(67, 'zsemlemorzsa', NULL),
(68, 'étolaj', NULL),
(69, 'spagetti', NULL),
(70, 'paradicsomszósz', NULL),
(71, 'főtt sonka', NULL),
(72, 'trappista sajt', NULL),
(94, 'gomba', NULL),
(95, 'száraztészta', NULL),
(96, 'karfiol', NULL),
(97, 'sütőpor', NULL),
(98, 'csokicsepp', NULL),
(99, 'kolbász', NULL),
(100, 'tejföl', NULL),
(101, 'darált hús', NULL),
(102, 'fokhagyma', NULL),
(103, 'vaníliás pudingpor', NULL),
(104, 'alma', NULL),
(105, 'őrölt fahéj', NULL),
(107, 'marhahús', NULL),
(108, 'sertészsír', NULL),
(109, 'zöldpaprika', NULL),
(110, 'paradicsom', NULL),
(111, 'csirkecomb', NULL),
(112, 'reszelt sajt', NULL),
(113, 'sonka', NULL),
(114, 'zöldség (paprika vagy hagyma)', NULL),
(116, 'étcsokoládé', NULL),
(117, 'egész csirke', NULL),
(118, 'metélőhagyma', NULL),
(119, 'Zöldborsó', NULL),
(120, 'lazacfilé', NULL),
(121, 'citrom', NULL),
(122, 'sertésszűz', NULL),
(123, 'cukkini', NULL),
(124, 'kaliforniai paprika', NULL),
(125, 'padlizsán', NULL),
(126, 'olívaolaj', NULL),
(127, 'vanília aroma', NULL),
(128, 'vörösbor', NULL),
(129, 'csiperkegomba', NULL),
(130, 'darált sertéshús', NULL),
(131, 'fejes káposzta', NULL),
(132, 'savanyú káposzta', NULL),
(133, 'kacsacomb', NULL),
(134, 'kacsamell', NULL),
(135, 'citromhéj', NULL),
(136, 'bélszín', NULL),
(137, 'marhapofa', NULL),
(138, 'mandulaliszt', NULL),
(139, 'instant kávé', NULL),
(140, 'mustár', NULL);

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
(1, 'főétel'),
(2, 'leves'),
(3, 'desszert'),
(4, 'reggeli'),
(5, 'köret');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `konyhaifelszereles`
--

CREATE TABLE `konyhaifelszereles` (
  `KonyhaiFelszerelesID` int(11) NOT NULL,
  `Nev` varchar(100) NOT NULL,
  `Kep` varchar(255) DEFAULT NULL,
  `BesorolasID` int(11) NOT NULL,
  `Leiras` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `konyhaifelszereles`
--

INSERT INTO `konyhaifelszereles` (`KonyhaiFelszerelesID`, `Nev`, `Kep`, `BesorolasID`, `Leiras`) VALUES
(1, 'Teáskanál', '../../assets/kepek/konyhaiEszkoz/teaskanal.jpg', 1, 'A teáskanál egy kis méretű evőeszköz, amelyet leggyakrabban tea, kávé vagy más italok keverésére, illetve cukor, méz adagolására használunk. Emellett alkalmas kisebb mennyiségű ételek fogyasztására és a konyhában mértékegységként is funkcionál (1 teáskanál ≈ 5 ml). Általában rozsdamentes acélból készül, de létezik műanyagból vagy porcelánból készült változata is. Kompakt mérete miatt kényelmes, praktikus, minden háztartás alapdarabja.'),
(2, 'Evőkanál', '../../assets/kepek/konyhaiEszkoz/evokanal.jpg', 1, 'Az evőkanál egy nagyobb méretű evőeszköz, amelyet levesek, főzelékek és egyéb ételek fogyasztására használunk. A konyhában mérésre és adagolásra is alkalmas (1 evőkanál ≈ 15 ml). Leggyakrabban rozsdamentes acélból készül, de létezik műanyagból, fából vagy szilikonból készült változata is. Formája kényelmes fogást biztosít, ezért a mindennapi étkezések alapdarabja.'),
(3, 'Pizzaszósz kanál', '../../assets/kepek/konyhaiEszkoz/pizzaszosz_kanal.jpg', 2, 'A pizzaszósz kanál egy kifejezetten pizza készítéshez használt konyhai eszköz, amely a paradicsomszósz egyenletes eloszlását szolgálja a pizzatészta felületén. Feje általában lapos, enyhén mélyített vagy kör alakú, így segít a szószt középről kifelé spirálisan elkenni. Leggyakrabban rozsdamentes acélból vagy műanyagból készül, nyelének kialakítása stabil fogást biztosít.'),
(4, 'Spagettikanál', '../../assets/kepek/konyhaiEszkoz/spagettikanal.jpg', 2, 'A spagetti kanál főtt spagetti és egyéb hosszú tészták szedésére, adagolására szolgál. Jellegzetes fogazott, karmokra emlékeztető pereme segít a tészta megfogásában, miközben a felesleges folyadék lecsöpög. Közepén gyakran található egy lyuk, amely adagolásra is szolgál. Megkönnyíti a tálalást anélkül, hogy a tészta összetörne.'),
(5, 'Hableszedő kanál', '../../assets/kepek/konyhaiEszkoz/hableszedo_kanal.jpg', 3, 'A hableszedő kanál főzés közben a levesek, húslevek vagy főzelékek tetején képződő hab eltávolítására szolgál. Általában lyukacsos vagy rácsos fejű, így a folyadék visszafolyik, a hab viszont fennmarad rajta. Hosszú nyelének köszönhetően biztonságosan használható forró ételeknél is.'),
(6, 'Fakanál', '../../assets/kepek/konyhaiEszkoz/fakanal.jpg', 4, 'A fakanál hagyományos konyhai eszköz, amelyet keverésre, forgatásra és adagolásra használnak főzés közben. Leggyakrabban fából készül, ezért nem karcolja az edényeket és nem vezeti a hőt. Különösen alkalmas levesek, főzelékek, szószok és pörköltek keverésére.'),
(7, 'Szilikonos spatula', '../../assets/kepek/konyhaiEszkoz/szilikonos_spatula.jpg', 4, 'A szilikon spatula korszerű konyhai eszköz, amelyet keverésre, kaparásra és kenésre használnak. Rugalmas feje lehetővé teszi, hogy az edény faláról maradék nélkül összegyűjtse az ételt vagy tésztát. Hőálló, nem karcolja az edényeket.'),
(8, 'Koktélkanál', '../../assets/kepek/konyhaiEszkoz/koktelkanal.jpg', 1, 'A koktélkanál egy hosszú nyelű keverőkanál, amelyet koktélok és italok összekeverésére használnak, főként magas poharakban. Hosszú, vékony nyele lehetővé teszi, hogy az ital aljáig leérjen, csavart kialakítása segíti az egyenletes keverést.'),
(9, 'Fagylaltos kanál', '../../assets/kepek/konyhaiEszkoz/fagylaltos_kanal.jpg', 5, 'A fagylaltos kanál speciálisan kialakított eszköz fagylalt adagolására és szervírozására. Feje félgömb alakú, így könnyen formáz szép, kerek adagokat. Gyakran hővezető fémből készül, amely megkönnyíti a kemény fagylalt kiszedését.'),
(10, 'Tálalókanál', '../../assets/kepek/konyhaiEszkoz/talalokanal.jpg', 6, 'A tálalókanál nagy, erős kanál, amelyet főételek, köretek vagy saláták adagolására használnak. Segítségével a tálalás gyors, egyszerű és esztétikus.'),
(11, 'Kézi habverő', '../../assets/kepek/konyhaiEszkoz/kezi_habvero.jpg', 4, 'A kézi habverő tojásfehérje, tejszín vagy különböző keverékek felverésére, habosítására szolgál. Fém drótfeje segít a levegő bekeverésében, így a keverék könnyű és egyenletes lesz.'),
(12, 'Merőkanál', '../../assets/kepek/konyhaiEszkoz/merokanal.jpg', 7, 'A merőkanál nagy, mély kanál, amelyet levesek, főzelékek, szószok és egyéb folyékony ételek adagolására használnak. Hosszú nyele miatt biztonságosan elérhető vele a mély edények alja.'),
(13, 'Kenőkés', '../../assets/kepek/konyhaiEszkoz/kenokes.jpg', 1, 'A kenőkés egy kis, lapos és széles pengéjű konyhai eszköz, amelyet vaj, margarin, krémek, dzsemek vagy egyéb kenhető anyagok szendvicsre vagy kenyérre való felvitelére használnak. Általában rozsdamentes acélból készül, de léteznek műanyag vagy szilikon változatai is. Kialakítása biztonságos, nem vág.'),
(14, 'Séfkés', '../../assets/kepek/konyhaiEszkoz/sefkes.jpg', 8, 'A séfkés egy nagy, sokoldalú konyhai kés, amelyet zöldségek, húsok, halak és egyéb alapanyagok szeletelésére, aprítására használnak. Széles, enyhén ívelt pengéje lehetővé teszi a hajlított mozdulatokkal történő vágást. A konyhai munka egyik legfontosabb alapdarabja.'),
(15, 'Hámozó', '../../assets/kepek/konyhaiEszkoz/hamozo.jpg', 8, 'A hámozó egy kisebb, kézi konyhai eszköz, amelyet zöldségek és gyümölcsök héjának eltávolítására használnak. Éles pengéje precíz munkát tesz lehetővé, miközben kevés hulladék keletkezik. Gyors, biztonságos és praktikus.'),
(16, 'Kenyérvágó kés', '../../assets/kepek/konyhaiEszkoz/kenyervago_kes.jpg', 8, 'A kenyérvágó kés hosszú, fogazott pengéjű kés, amely könnyedén átvágja a ropogós kenyérhéjat anélkül, hogy a belsejét összenyomná. Ideális friss és pirított kenyerek szeletelésére.'),
(17, 'Csontozókés', '../../assets/kepek/konyhaiEszkoz/csontozokes.jpg', 8, 'A csontozókés vékony, hegyes és rugalmas pengéjű kés, amely húsok csontjáról való leválasztására szolgál. Kialakítása lehetővé teszi a precíz vágást, minimális húsvesteséggel.'),
(18, 'Filézőkés', '../../assets/kepek/konyhaiEszkoz/filezokes.jpg', 8, 'A filézőkés hosszú és hajlékony pengéjű kés, amelyet halak és húsok filézésére használnak. Segítségével a csontok és a bőr pontosan elválaszthatók a hústól.'),
(19, 'Desszertkés', '../../assets/kepek/konyhaiEszkoz/desszertkes.jpg', 9, 'A desszertkés kisebb méretű kés, amelyet sütemények, torták és egyéb desszertek fogyasztására vagy szeletelésére használnak. Könnyű kezelhetősége elegáns étkezést biztosít.'),
(20, 'Sajtkés', '../../assets/kepek/konyhaiEszkoz/sajtkes.jpg', 10, 'A sajtkés speciálisan kialakított kés különféle sajtok vágására és tálalására. Pengéje gyakran lyukacsos vagy recézett, hogy a sajt ne ragadjon rá.'),
(21, 'Henteskés', '../../assets/kepek/konyhaiEszkoz/henteskes.jpg', 8, 'A henteskés egy nagy, masszív kés, amelyet nyers húsok feldolgozására, darabolására és szeletelésére használnak. Erős pengéje a vastag húsrészekkel is megbirkózik.'),
(22, 'Pizzavágó', '../../assets/kepek/konyhaiEszkoz/pizzavago.jpg', 8, 'A pizzavágó kör alakú pengével rendelkező konyhai eszköz, amelyet pizza és más lapos ételek szeletelésére használnak. Gyors, pontos vágást tesz lehetővé.'),
(23, 'Evővilla', '../../assets/kepek/konyhaiEszkoz/evovilla.jpg', 1, 'Az evővilla egy hagyományos evőeszköz, amelyet főként húsok, zöldségek, tészták és egyéb ételek fogyasztására használnak. Hosszú nyele kényelmes fogást biztosít, míg a három vagy négy villaág segít az étel biztonságos megragadásában. Leggyakrabban rozsdamentes acélból készül, és a mindennapi étkezések alapvető eszköze.'),
(24, 'Desszert villa', '../../assets/kepek/konyhaiEszkoz/desszert_villa.jpg', 9, 'A desszertvilla kisebb méretű evőeszköz, amelyet sütemények, torták és egyéb desszertek fogyasztására használnak. Rövidebb és vékonyabb fogai lehetővé teszik a finom falatok precíz és elegáns elfogyasztását. Ünnepi és mindennapi alkalmakon egyaránt használatos.'),
(25, 'Húsvilla', '../../assets/kepek/konyhaiEszkoz/husvilla.jpg', 6, 'A húsvilla hosszú, erős villa, amelyet sültek, nagyobb húsdarabok forgatására, megtartására és szeletelésére használnak. Két vagy több hosszú villaága stabil tartást biztosít, miközben a hús biztonságosan kezelhető főzés és tálalás során.'),
(26, 'Vágódeszka', '../../assets/kepek/konyhaiEszkoz/vagodeszka.jpg', 11, 'A vágódeszka egy lapos, stabil felület, amelyet zöldségek, húsok, gyümölcsök és egyéb élelmiszerek szeletelésére használnak. Megóvja a kések élét és biztonságos munkafelületet biztosít.'),
(27, 'Sütőkesztyű', '../../assets/kepek/konyhaiEszkoz/sutokesztyu.jpg', 11, 'A sütőkesztyű vastag, hőálló kesztyű, amely megvédi a kezet a forró edények és tepsik okozta sérülésektől.'),
(28, 'Konyharuha', '../../assets/kepek/konyhaiEszkoz/konyharuha.jpg', 11, 'A konyharuha nedvszívó textil, amelyet edények törlésére, szárítására és a munkafelület tisztán tartására használnak.'),
(29, 'Kötény', '../../assets/kepek/konyhaiEszkoz/koteny.jpg', 11, 'A kötény védőruházati kiegészítő, amely főzés közben megóvja a ruhát a szennyeződésektől és fröccsenésektől.'),
(30, 'Tálalógyűrű', '../../assets/kepek/konyhaiEszkoz/talalogyuru.jpg', 11, 'A tálalógyűrű kör alakú forma, amely segít az ételek esztétikus, formázott tálalásában.'),
(31, 'Késélező', '../../assets/kepek/konyhaiEszkoz/keselezo.jpg', 11, 'A késélező a kések élének karbantartására szolgál, biztosítva a könnyű és biztonságos vágást.'),
(32, 'Konyhai mérleg', '../../assets/kepek/konyhaiEszkoz/konyhai_merleg.jpg', 11, 'A konyhai mérleg az alapanyagok pontos mérésére szolgál főzés és sütés során.'),
(33, 'Szita', '../../assets/kepek/konyhaiEszkoz/szita.jpg', 11, 'A szita liszt, porcukor és egyéb alapanyagok szitálására vagy folyadékok szűrésére használható.'),
(34, 'Reszelő', '../../assets/kepek/konyhaiEszkoz/reszelo.jpg', 11, 'A reszelő sajtok, zöldségek és gyümölcsök aprítására szolgáló konyhai eszköz.'),
(35, 'Habzsák', '../../assets/kepek/konyhaiEszkoz/habzsak.jpg', 11, 'A habzsák krémek, habok és díszítő anyagok pontos adagolására és formázására használható.'),
(36, 'Nokedliszaggató', '../../assets/kepek/konyhaiEszkoz/nokedliszaggato.jpg', 11, 'A nokedliszaggató a tészta gyors és egyenletes szaggatására szolgál.'),
(37, 'Maghőmérő', '../../assets/kepek/konyhaiEszkoz/maghomero.jpg', 11, 'A maghőmérő az ételek belső hőmérsékletének mérésére szolgál, biztosítva a megfelelő átsülést.'),
(38, 'Muffin sütőforma', '../../assets/kepek/konyhaiEszkoz/muffin_sutoforma.jpg', 11, 'A muffin sütőforma segít a muffinok és kis sütemények egyenletes sütésében.'),
(39, 'Muffin papír', '../../assets/kepek/konyhaiEszkoz/muffin_papir.jpg', 11, 'A muffin papír megakadályozza a tészta letapadását, és esztétikus tálalást biztosít.'),
(40, 'Sütőpapír', '../../assets/kepek/konyhaiEszkoz/sutopapir.jpg', 11, 'A sütőpapír megakadályozza az ételek letapadását és megkönnyíti a tisztítást.'),
(41, 'Piteforma', '../../assets/kepek/konyhaiEszkoz/piteforma.jpg', 11, 'A piteforma piték és sütemények sütésére szolgáló kör alakú forma.'),
(42, 'Tésztaszűrő', '../../assets/kepek/konyhaiEszkoz/tesztaszuro.jpg', 11, 'A tésztaszűrő főtt tészták és egyéb ételek leszűrésére szolgál.'),
(43, 'Nyújtólap', '../../assets/kepek/konyhaiEszkoz/nyujtolap.jpg', 11, 'A nyújtólap sima felületet biztosít a tészta kinyújtásához.'),
(44, 'Nyújtófa', '../../assets/kepek/konyhaiEszkoz/nyujtofa.jpg', 11, 'A nyújtófa henger alakú eszköz tészta egyenletes kinyújtásához.'),
(45, 'Sütőrács', '../../assets/kepek/konyhaiEszkoz/sutoracs.jpg', 11, 'A sütőrács biztosítja az ételek egyenletes szellőzését sütés és hűtés során.'),
(46, 'Ecset', '../../assets/kepek/konyhaiEszkoz/ecset.jpg', 11, 'A konyhai ecset vaj, tojás vagy olaj felvitelére szolgál.'),
(47, 'Húsfogó csipesz', '../../assets/kepek/konyhaiEszkoz/husfogo_csipesz.jpg', 11, 'A húsfogó csipesz segít az ételek biztonságos forgatásában és emelésében.'),
(48, 'Tortaforma', '../../assets/kepek/konyhaiEszkoz/tortaforma.jpg', 11, 'A tortaforma torták és sütemények sütésére szolgál.'),
(49, 'Vákuumtasak', '../../assets/kepek/konyhaiEszkoz/vakuumtasak.jpg', 11, 'A vákuumtasak ételek frissen tartására és sous-vide főzéshez használható.'),
(50, 'Tálca', '../../assets/kepek/konyhaiEszkoz/talca.jpg', 11, 'A tálca ételek és italok szállítására és tálalására szolgál.'),
(51, 'Párolóbetét', '../../assets/kepek/konyhaiEszkoz/parolobetet.jpg', 11, 'A párolóbetét lehetővé teszi az ételek gőzben történő elkészítését.'),
(52, 'Klopfoló', '../../assets/kepek/konyhaiEszkoz/klopfolo.jpg', 11, 'A klopfoló húsok puhítására és egyenletes vastagságúra lapítására szolgál.'),
(53, 'Robotgép', '../../assets/kepek/konyhaiEszkoz/robotgep.jpg', 12, 'A robotgép egy elektromos konyhai eszköz, amelyet tészta dagasztására, krémek habosítására, zöldségek aprítására és egyéb konyhai műveletekre használnak. Különböző cserélhető fejeinek köszönhetően sokoldalúan használható, és jelentősen megkönnyíti a nagyobb mennyiségű alapanyag feldolgozását.'),
(54, 'Elektromos habverő', '../../assets/kepek/konyhaiEszkoz/elektromos_habvero.jpg', 12, 'Az elektromos habverő tojások, krémek, tejszín és tészták gyors és egyenletes felverésére szolgáló konyhai kisgép. Forgó fém fejei segítségével időt és energiát takarít meg a kézi keveréshez képest.'),
(55, 'Botmixer', '../../assets/kepek/konyhaiEszkoz/botmixer.jpg', 12, 'A botmixer kézben tartható elektromos eszköz, amelyet levesek, szószok, krémek és turmixok pépesítésére használnak közvetlenül az edényben. Gyors, praktikus és könnyen tisztítható.'),
(56, 'Turmixgép', '../../assets/kepek/konyhaiEszkoz/turmixgep.jpg', 12, 'A turmixgép gyümölcsök, zöldségek, italok és levesek pépesítésére alkalmas elektromos eszköz. Erős motorja és éles pengéi sima, homogén állagot biztosítanak.'),
(57, 'Vízforraló', '../../assets/kepek/konyhaiEszkoz/vizforralo.jpg', 12, 'A vízforraló elektromos eszköz víz gyors felforralására teák, kávék és instant ételek készítéséhez. Beépített automatikus kikapcsolással rendelkezik a biztonságos használat érdekében.'),
(58, 'Szendvicssütő', '../../assets/kepek/konyhaiEszkoz/szendvicssuto.jpg', 12, 'A szendvicssütő elektromos konyhai kisgép, amely melegszendvicsek és toastok gyors elkészítésére szolgál. Tapadásmentes felülete biztosítja az egyenletes sütést.'),
(59, 'Airfryer', '../../assets/kepek/konyhaiEszkoz/airfryer.jpg', 12, 'Az airfryer forró levegő keringetésével működő konyhai kisgép, amely minimális olaj felhasználásával teszi lehetővé az ételek ropogósra sütését.'),
(60, 'Szeletelőgép', '../../assets/kepek/konyhaiEszkoz/szeletelogep.jpg', 12, 'A szeletelőgép húsok, sajtok és zöldségek egyenletes, vékony szeletekre vágására szolgáló konyhai eszköz, amely precíz és esztétikus eredményt biztosít.'),
(61, 'Mikrohullámú sütő', '../../assets/kepek/konyhaiEszkoz/mikrohullamu_suto.jpg', 13, 'A mikrohullámú sütő elektromos konyhai nagygép, amelyet ételek gyors melegítésére, főzésére vagy kiolvasztására használnak. Mikrohullámok segítségével működik, így az étel rövid idő alatt egyenletesen felmelegszik. A modern konyhák alapvető eszköze.'),
(62, 'Gáztűzhely', '../../assets/kepek/konyhaiEszkoz/gaztuzhely.jpg', 13, 'A gáztűzhely nyílt lánggal működő főzőberendezés, amely pontos és azonnali hőszabályozást tesz lehetővé. Főzéshez, sütéshez és pároláshoz egyaránt használható.'),
(63, 'Indukciós főzőlap', '../../assets/kepek/konyhaiEszkoz/indukcios_fozolap.jpg', 13, 'Az indukciós főzőlap elektromos főzőeszköz, amely közvetlenül az edény alját melegíti. Gyors, energiatakarékos és biztonságos megoldást kínál a modern konyhákban.'),
(64, 'Sous-vide gép', '../../assets/kepek/konyhaiEszkoz/sous_vide_gep.jpg', 13, 'A sous-vide gép vákuumtasakban történő, alacsony hőmérsékletű főzéshez használt eszköz. Pontos hőmérséklet-szabályozása lehetővé teszi a profi minőségű ételek elkészítését.'),
(65, 'Fazék', '../../assets/kepek/konyhaiEszkoz/fazek.jpg', 14, 'A fazék mély, hőálló edény, amelyet levesek, főzelékek és tészták főzésére használnak. Fedővel együtt biztosítja az egyenletes hőeloszlást.'),
(66, 'Lábas', '../../assets/kepek/konyhaiEszkoz/labas.jpg', 14, 'A lábas közepes méretű edény, amelyet szószok, krémek és kisebb adagok főzésére használnak. Fedővel együtt segít a hő megtartásában.'),
(67, 'Nyeles lábas', '../../assets/kepek/konyhaiEszkoz/nyeles_labas.jpg', 14, 'A nyeles lábas hosszú nyéllel ellátott edény, amely megkönnyíti a főzést és az öntést. Különösen alkalmas szószok és levesek készítésére.'),
(68, 'Bogrács', '../../assets/kepek/konyhaiEszkoz/bogracs.jpg', 14, 'A bogrács vastag falú fém edény, amelyet szabadtéri főzéshez, például gulyás és pörkölt készítéséhez használnak. A hagyományos magyar konyha fontos eszköze.'),
(69, 'Fedő', '../../assets/kepek/konyhaiEszkoz/fedo.jpg', 14, 'A fedő az edények tetejére helyezhető eszköz, amely segít a hő és a gőz megtartásában, gyorsítva a főzési folyamatot.'),
(70, 'Serpenyő', '../../assets/kepek/konyhaiEszkoz/serpenyo.jpg', 14, 'A serpenyő lapos edény, amelyet húsok, zöldségek és tojásételek gyors sütésére és pirítására használnak.'),
(71, 'Keverőtál', '../../assets/kepek/konyhaiEszkoz/keverotal.jpg', 14, 'A keverőtál mély edény, amelyet tészták, krémek és saláták összekeverésére használnak. Praktikus és sokoldalú konyhai eszköz.'),
(72, 'Tepsi', '../../assets/kepek/konyhaiEszkoz/tepsi.jpg', 14, 'A tepsi lapos sütőedény, amelyet sütemények, pizzák és egyéb ételek sütésére használnak a sütőben.'),
(73, 'Hőálló tál', '../../assets/kepek/konyhaiEszkoz/hoallo_tal.jpg', 14, 'A hőálló tál magas hőmérsékletnek ellenálló edény, amely sütőben és mikrohullámú sütőben is használható.'),
(74, 'Jénai', '../../assets/kepek/konyhaiEszkoz/jenai.jpg', 14, 'A jénai hőálló üvegedény, amely lehetővé teszi az ételek elkészítésének vizuális ellenőrzését sütés közben.'),
(75, 'Öntöttvas edény', '../../assets/kepek/konyhaiEszkoz/ontottvas_edeny.jpg', 14, 'Az öntöttvas edény kiváló hőtartó képességgel rendelkező edény, amely ideális lassú főzéshez és sütéshez.');

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
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

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
(1, 'Magyarország'),
(3, 'Franciaország'),
(4, 'Olaszország'),
(5, 'Spanyolország'),
(6, 'Egyesült Királyság'),
(7, 'Egyesült Államok'),
(8, 'Kanada'),
(9, 'Kína'),
(10, 'Japán'),
(11, 'Dél-Korea'),
(12, 'India'),
(13, 'Ausztrália'),
(14, 'Oroszország'),
(15, 'Brazília'),
(16, 'Mexikó'),
(17, 'Hollandia'),
(18, 'Belgium'),
(19, 'Svájc'),
(20, 'Ausztria'),
(21, 'Lengyelország'),
(22, 'Csehország'),
(23, 'Szlovákia'),
(24, 'Románia'),
(25, 'Svédország');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `recept`
--

CREATE TABLE `recept` (
  `ReceptID` int(11) NOT NULL,
  `Nev` varchar(150) NOT NULL,
  `Kep` varchar(255) NOT NULL,
  `ElkeszitesiIdo` time NOT NULL,
  `NehezsegiSzintID` int(11) NOT NULL,
  `BegyujthetoPontok` int(11) NOT NULL,
  `Adag` int(11) NOT NULL,
  `Elkeszitesi_leiras` text NOT NULL,
  `ElkeszitesiModID` int(11) NOT NULL,
  `ArkategoriaID` int(11) NOT NULL,
  `AlkategoriaID` int(11) DEFAULT NULL,
  `Kaloria` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `recept`
--

INSERT INTO `recept` (`ReceptID`, `Nev`, `Kep`, `ElkeszitesiIdo`, `NehezsegiSzintID`, `BegyujthetoPontok`, `Adag`, `Elkeszitesi_leiras`, `ElkeszitesiModID`, `ArkategoriaID`, `AlkategoriaID`, `Kaloria`) VALUES
(8, 'Tükörtojás', '/assets/kepek/etelek/TukorTojas.webp\n', '00:10:00', 1, 15, 1, 'A tojásokat óvatosan üsd egy kis tálba vagy csészébe egyesével – így ha rossz lenne valamelyik, nem rontja el az egészet.\r\nMelegítsd fel az olajat vagy vajat egy kisebb serpenyőben közepes lángon. Az olaj akkor jó, ha enyhén csillog, de még nem füstöl (ha füstöl, vedd lejjebb a lángot, különben keserű lesz).\r\nHa a zsiradék forró, óvatosan csúsztasd bele a tojásokat a tálból (ne dobd bele nagy magasságból, nehogy szétfröccsenjen a zsiradék).\r\nSüsd addig, amíg a fehérje teljesen kifehéredik és megszilárdul, de a sárgája még lágy marad (kb. 3–4 perc). Ha kemény sárgáját szeretnél, fordítsd át a tojást még 10–15 másodpercre.\r\nSózd, borsozd, és azonnal tálald pirítóssal vagy friss zöldséggel.\r\nÍzesítsd sóval, borssal, és azonnal tálald.\r\n', 1, 1, 9, 180.00),
(9, 'Tojásrántotta', '../../assets/kepek/etelek/Rantotta.webp', '00:05:00', 1, 15, 1, 'Verd fel a tojásokat egy tálban villával vagy habverővel, sózd meg enyhén. Ne verd túl habosra, csak keverd össze.\r\nOlvaszd meg a vajat (vagy melegítsd az olajat) egy serpenyőben közepes lángon.\r\nÖntsd bele a tojást. Folyamatosan keverd fakanállal vagy szilikon spatulával körkörös mozdulatokkal, hogy egyenletesen süljön (kb. 2–3 perc).\r\nVedd le a tűzről, amikor már majdnem kész, de még kicsit lágy, krémes az állaga – a maradék hő tovább főzi.\r\nTálald azonnal, mellé félbevágott koktélparadicsommal vagy más friss körettel.\r\n', 1, 1, 9, 210.00),
(10, 'Bundás kenyér', '../../assets/kepek/etelek/bundasKenyer.webp\r\n', '00:10:00', 1, 15, 1, 'Verd fel a tojásokat egy lapos tányérban vagy tálban, sózd meg enyhén.\r\nMártsd bele a kenyérszeleteket rövid időre (2–3 másodperc oldalanként) – ne áztasd túl, különben szétesik!\r\nHevíts bő olajat egy serpenyőben közepes lángon. Ellenőrizd: ha egy kis tojásos morzsát beledobsz, azonnal pezsegnie kell.\r\nTedd bele a beáztatott kenyereket, süsd mindkét oldalon aranybarnára (oldalanként kb. 2–3 perc).\r\nPapírtörlőre szedd ki, hogy lecsepegjen a felesleges olaj.\r\n', 1, 1, 9, 350.00),
(11, 'Pirítós vajjal vagy lekvárral', '../../assets/kepek/etelek/PiritosKenyer.webp\r\n', '00:05:00', 1, 15, 1, 'Tedd a kenyereket kenyérpirítóba és pirítsd meg (vagy serpenyőben 1–2 perc oldalanként közepes lángon, vaj nélkül).\r\nAmint kész, kend meg vékonyan vajjal (vagy vastagabban lekvárral).\r\nAzonnal fogyaszd, amíg ropogós.\r\n', 1, 1, 9, 200.00),
(12, 'Gyümölcsös joghurtos pohárkrém', '../../assets/kepek/etelek/GyumolcsosPohardesszert.webp', '00:05:00', 1, 10, 1, 'A gyümölcsöt mosd meg, ha szükséges, vágd kisebb darabokra (fagyasztottat hagyd kicsit felengedni).\r\nEgy átlátszó pohárba rétegezd: alul egy kis joghurt, rá gyümölcs, majd ismét joghurt – így szép lesz réteges.\r\nVégül csurgasd rá a mézet.\r\nTedd hűtőbe 10–15 percre, hogy az ízek összeérjenek (de azonnal is fogyasztható).\r\n', 2, 1, 8, 220.00),
(13, 'Zabpelyhes-mézes pohárdesszert', '../../assets/kepek/etelek/ZabpelyhesMezesPohardesszert.webp', '00:05:00', 1, 10, 1, 'Egy pohárba rétegezd: alul egy kevés joghurt, rá zabpehely, majd ismét joghurt – összesen 2–3 réteg.\r\nCsurgasd rá a mézet a tetejére.\r\nTedd hűtőbe 5–10 percre (vagy akár 30 percre), hogy a zab kissé megpuhuljon és az ízek összeérjenek.\r\nKeverd át evés előtt, ha krémesebb állagot szeretnél.\r\n', 2, 1, 8, 300.00),
(14, 'Palacsinta', '../../assets/kepek/etelek/Palacsinta.webp', '00:05:00', 1, 10, 1, 'Egy nagy tálban verd fel a tojásokat a cukorral/sóval.\r\nAdd hozzá a lisztet, tejet, szódát és olajat. Keverd simára botmixerrel vagy kézi habverővel – a tészta legyen híg palacsinta tészta állagú (kicsit legyen hígabb mint a tejföl). Ha csomós, szűrd át.\r\nHevíts egy palacsintasütőt vagy tapadásmentes serpenyőt közepes lángon, kenj ki vékonyan olajjal (papírtörlővel).\r\nMerj bele egy merőkanál tésztát, döntsd meg a serpenyőt, hogy vékonyan elterüljön.\r\nSüsd kb. 1–1,5 percig, amíg a széle elválik és a teteje már nem folyós – akkor fordítsd meg.\r\nA másik oldalát is süsd 30–60 másodpercig.\r\nA kész palacsintákat tányérra rakd, fedd le, hogy ne száradjanak ki. \r\n\r\nSós verzióhoz, hagyjuk el a cukrot belőle, és mehet bele 2 csipet só.\r\n', 1, 1, 7, 220.00),
(15, 'Zöldségleves', '../../assets/kepek/etelek/ZoldsegLeves.webp', '01:00:00', 2, 15, 4, 'A zöldségeket (sárgarépa, fehérrépa, karalábé, zeller, hagyma) tisztítsd meg és vágd egyforma méretűre (kb. 1–2 cm-es kockákra vagy karikákra), hogy egyszerre puhuljanak. A hagymát hagyd egészben vagy félbe vágva.\r\nEgy nagyobb lábasban melegítsd fel az olajat közepes lángon (ne füstöljön!).\r\nTedd bele a hagymát és a keményebb gyökérzöldségeket (répa, zeller, fehérrépa). Párold 8–12 percig, időnként megkeverve, amíg a hagyma üveges lesz és a zöldségek enyhén megpuhulnak – ez nagyon fontos lépés, mert itt mélyülnek az ízek.\r\nÖntsd fel kb. 3 liter hideg vízzel (hideg víz = tisztább leves).\r\nAdd hozzá a petrezselyem szárát (csokorba kötve, hogy könnyű legyen később kivenni), a babérleveleket, egész borsot és sót ízlés szerint, ha van tea tojásod, akkor abba tedd bele a borsot, így nem fog zavarni evés közben.\r\nForrald fel, majd vedd vissza a lángot alacsonyra, hogy csak gyöngyözzön (ne forrjon nagyon). Fedő nélkül vagy félig fedve főzd kb. 20–25 percig.\r\nAmikor a gyökérzöldségek már majdnem puhák (villával könnyen átszúrhatók), a karalábét.\r\nFőzd tovább még 10–15 percig, amíg minden zöldség tökéletesen puha, de nem esik szét.\r\nVedd ki a petrezselyem szárát, babérlevelet és hagymát (ha egészben hagytad).\r\nSzórd meg friss aprított petrezselyemmel, kóstold meg, szükség szerint utánízesítsd, és forrón tálald.\r\n', 4, 1, 6, 100.00),
(16, 'Tojásleves', '../../assets/kepek/etelek/Tojasleves.webp', '00:25:00', 2, 15, 4, 'Egy lábasban melegítsd fel az olajat közepes lángon.\r\nSzórd bele a lisztet, és folyamatos keverés mellett pirítsd 2–3 percig, amíg világosbarna, dióillatú rántás lesz (ne sötétedjen meg, különben keserű!).\r\nVedd le a tűzről, szórj bele a pirospaprikát, gyorsan keverd el (így nem ég le), majd azonnal öntsd fel kb. 1,5 liter hideg vízzel kis adagokban, közben folyamatosan keverd, hogy ne legyen csomós.\r\nTedd vissza a tűzre, add hozzá a babérlevelet, őrölt köményt, sót és borsot.\r\nForrald fel, majd alacsony lángon főzd 10–12 percig, hogy a rántás íze kioldódjon.\r\nKözben verd fel 2 tojást egy tálban villával. Amikor a leves gyöngyözik, vékony sugárban öntsd bele a felvert tojást, közben folyamatosan keverd – így csíkok lesznek belőle (nem gombócok).\r\nA maradék 4 tojást óvatosan, egyesével üsd bele a levesbe (közvetlenül a felszínre). Fedő nélkül főzd még 3–4 percig, amíg a tojások kifehérednek, de a sárgája lágy marad.\r\nVégül ízesítsd ecettel (kezdj 1 ek-kel, kóstold, mert savasabb lesz tőle).\r\nTálald forrón, a benne főtt tojásokkal együtt.\r\n', 4, 1, 6, 120.00),
(17, 'Egyszerű húsleves alap', '../../assets/kepek/etelek/Husleves.webp', '02:30:00', 2, 15, 5, 'A sertés karajcsontot mosd át hideg vízben, tedd egy nagy fazékba.\r\nÖntsd fel hideg vízzel (kb. 2–2,5 liter, hogy ellepje), és közepes lángon melegítsd.\r\nAmint felforr és hab keletkezik a tetején, vedd le a lángot alacsonyra, és egy szűrővel folyamatosan szedd le a habot – ez nagyon fontos a tiszta, arany színű leveshez (kb. 5-10 percig szedjed).\r\nAmikor már alig jön hab, add hozzá a megtisztított, nagyobb darabokra vágott zöldségeket (sárgarépa, fehérrépa, zeller, karalábé, egész hagyma), sót és egész borsot, itt is használj tea tojást, hogy elkerüld a kiszedett levesben a bors darabokat.\r\nForrald fel újra, majd vedd vissza a legkisebb lángra (csak gyöngyözzön), fedővel félig letakarva főzd nagyon lassan 2–2,5 órán át. Időnként ellenőrizd, ha elfőtte a levét, pótolj forró vizet (hideget ne, mert zavaros lesz).\r\nAmikor a hús már omlós és a zöldségek teljesen puhák, szűrd le a levest egy finom szűrőn vagy tiszta konyharuhán keresztül.\r\nA húst és zöldségeket tedd vissza a levesbe, vagy külön tálald.\r\nA tésztát (csigatészta) külön sós vízben főzd ki a csomagolás szerint, majd öntsd a forró levesbe tálaláskor.', 5, 1, 6, 180.00),
(18, 'Paradicsomleves betűtésztával', '../../assets/kepek/etelek/ParadicsomLeves.webp\n', '00:30:00', 2, 15, 4, 'Egy lábasban melegítsd fel az olajat, szórj bele lisztet, és kevergetve pirítsd 2–3 percig világos rántássá (világosbarna, dióillatú – ne sötétedjen!).\r\nVedd le a tűzről, öntsd hozzá a paradicsomlevet és a vizet folyamatos keverés mellett (így nem csomósodik).\r\nTedd vissza a tűzre.\r\nTedd bele az egészben hagyott vöröshagymát (ízesít, de később kiveszed).\r\nÍzesítsd cukorral (kiegyenlíti a savasságot), sóval és sűrített paradicsommal.\r\nForrald fel, majd alacsony lángon főzd 15–20 percig, időnként megkeverve.\r\nKözben főzd ki a betűtésztát külön sós vízben a csomagoláson írt idő szerint, majd szűrd le.\r\nVedd ki a hagymát a levesből, keverd bele a kifőtt tésztát.\r\nKóstold meg, szükség szerint utánízesítsd, és forrón tálald.', 4, 1, 6, 130.00),
(19, 'Kekszes–tejszínes pohárkrém', '../../assets/kepek/etelek/KekszesPoharKrem.webp', '01:00:00', 2, 10, 2, 'A darált kekszet keverd össze az olvasztott vajjal és porcukorral – legyen nedves, morzsás állagú (mint morzsa tészta).\r\nA hideg habtejszínt verd kemény habbá a porcukorral és vaníliás cukorral (elektromos habverővel közepes sebességen 2–4 perc – ha túlvered, vaj lesz). Ha mascarpone van, keverd bele simára.\r\nA kakaóport keverd el egy kis kekszmorzsával, hogy ne legyen csomós.\r\nPoharakba rétegezd: alul kekszmorzsa, rá tejszínhab, majd kakaós morzsa – ismételj 2–3 réteget.\r\nA tetejét díszítsd kekszmorzsával vagy kakaóporral.\r\nHűtsd legalább 2–3 órát (vagy akár egy éjszakát), hogy összeérjenek az ízek és megszilárduljon.', 2, 2, 8, 400.00),
(20, 'Tiramisu', '../../assets/kepek/etelek/Tiramisu.webp', '00:25:00', 2, 20, 6, 'Készítsd el a kávét (erős, cukor nélkül), hagyd teljesen kihűlni. Ha rumot használsz, keverd bele most.\r\nA tojássárgákat keverd habosra a porcukorral és vaníliás cukorral (kézi vagy elektromos habverővel 3–4 perc).\r\nAdd hozzá a mascarponét, keverd simára.\r\nA tojásfehérjéket verd kemény habbá (tisztán, zsírmentesen – ha fejjel lefelé fordítod a tálat, nem folyik ki). Óvatosan, alulról felfelé forgatva keverd a mascarponés krémhez.\r\nA babapiskótákat gyorsan (1–2 másodperc) mártsd a kávéba (ne áztasd túl, különben szétázik).\r\nEgy tál aljára rakj egy réteg kávéba mártott piskótát, kend rá a krém felét.\r\nIsmételj: újabb réteg piskóta + maradék krém.\r\nSimítsd el a tetejét, szórd meg vastagon kakaóporral szitán keresztül.\r\nHűtsd legalább 4–6 órát (legjobb egy éjszaka), hogy összeérjen és szeletelhető legyen.', 2, 2, 8, 460.00),
(21, 'Brokkolikrémleves', '../../assets/kepek/etelek/BrokkoliKremLeves.webp', '00:45:00', 3, 20, 2, 'A brokkolit szedd rózsáira (a vastag, fás szárakat vágd le és dobd ki, vagy ha nagyon fiatal brokkoli, vékonyan szeleteld fel és használd fel).\r\nA burgonyát hámozd meg és vágd közepes kockákra (kb. 2 cm-es darabokra).\r\nTedd a brokkolit és a burgonyát egy lábasba, öntsd fel annyi enyhén sós vízzel, hogy ellepje (kb. 8–10 dl).\r\nForrald fel, majd alacsony-közepes lángon főzd puhára kb. 10–12 percig (a burgonya és a brokkoli vége legyen villával könnyen átszúrható, de ne essen szét).\r\nSzűrd le a főzőlevet egy tálba (ne öntsd ki – kb. 2–3 dl-t tarts meg félre).\r\nA zöldségeket tedd turmixgépbe vagy botmixerrel dolgozd simára a lábasban. Ha túl sűrű, fokozatosan adj hozzá a félretett főzőléből, amíg krémes, de nem túl híg állagot kapsz.\r\nFontos biztonsági lépés: Ha forró a leves, vedd le a turmixgép fedeléről a kis központi dugót (vagy hagyd résnyire nyitva a fedelet), hogy a gőz távozhasson – különben felrobbanthatja a fedelet és megéget!\r\nTedd vissza a krémet a lábasba, öntsd hozzá a főzőtejszínt, keverd el jól.\r\nLassú tűzön melegítsd össze 1–2 percig (ne forrald túl, mert kicsapódhat a tejszín).\r\nSózd ízlés szerint (a brokkoli már sós főzővízből jött).\r\nKözben a kenyeret kockázd fel, pirítsd ropogósra kevés olajon vagy vajon egy serpenyőben.\r\nTálald forrón, a tetejére szórva a pirított kenyérkockákat.', 4, 1, 5, 110.00),
(22, 'Sütőtökkrémleves', '../../assets/kepek/etelek/SutotokKremLeves.webp', '00:50:00', 3, 20, 2, 'A sütőtököt pucold meg, magozd ki, vágd közepes darabokra (kb. 3–4 cm-es).\r\nTedd sütőpapírral bélelt tepsibe, sózd enyhén, és süsd előmelegített sütőben 180 °C-on kb. 25–35 percig, amíg teljesen puha és karamellizálódik a széle (villával könnyen átszúrható).\r\nKözben a hagymát finomra aprítsd, és pirítsd meg kevés olajon egy lábasban közepes lángon üvegesre (kb. 5–6 perc).\r\nAdd hozzá a sült tökdarabokat a hagymához, öntsd fel kb. 4–5 dl vízzel (vagy amennyi ellepi).\r\nForrald fel, majd alacsony lángon főzd 5–8 percig, hogy az ízek összeérjenek.\r\nTurmixold simára botmixerrel vagy turmixgépben (ugyanaz a biztonsági figyelmeztetés: gőz miatt résnyire nyitott fedél!).\r\nÖntsd hozzá a főzőtejszínt, keverd el, sózd ízlés szerint.\r\nLassú tűzön melegítsd össze 1–2 percig (ne forrald).\r\nKözben a bacont vágd csíkokra vagy kockára, pirítsd ropogósra serpenyőben (zsírjára sütve).\r\nTálald a levest forrón, a tetejére szórva a pirított bacont.', 4, 1, 5, 150.00),
(23, 'Paradicsomkrémleves', '../../assets/kepek/etelek/ParadicsomKremLeves.webp', '00:15:00', 3, 20, 2, 'Öntsd a paradicsomlevet egy lábasba, melegítsd közepes lángon gyöngyözésig (ne forrald vadul).\r\nÍzesítsd sóval és cukorral (a cukor kiegyenlíti a paradicsom savasságát – kezdj 1 ek cukorral, kóstold).\r\nÖntsd hozzá a főzőtejszínt, keverd el jól.\r\nMelegítsd tovább alacsony lángon 3–5 percig, amíg összeforrósodik és krémes lesz (ne forrald túl, mert kicsapódhat a tejszín).\r\nKóstold meg, szükség szerint utánízesítsd.\r\nForrón tálald (opcionális: pirított kenyérkockával vagy bazsalikomlevéllel).', 4, 1, 5, 120.00),
(24, 'Zellerkrémleves', '../../assets/kepek/etelek/ZellerKremLeves.webp', '00:45:00', 3, 20, 2, 'A zellergumót és a burgonyát hámozd meg, vágd közepes kockákra (kb. 2 cm).\r\nTedd egy lábasba, öntsd fel enyhén sós vízzel (kb. 8–10 dl, hogy ellepje).\r\nForrald fel, majd alacsony-közepes lángon főzd puhára kb. 12–15 percig (a zeller és burgonya legyen teljesen puha).\r\nSzűrd le a főzőlevet egy tálba, tarts meg kb. 2–3 dl-t félre.\r\nA zöldségeket turmixold simára a félretett főzőlével (gőz miatt résnyire nyitott fedél!).\r\nÖntsd hozzá a főzőtejszínt, keverd simára.\r\nSózd ízlés szerint, lassú tűzön melegítsd össze 1–2 percig.\r\nTálald forrón, a tetejére szórva levesgyöngyöt (vagy pirított kenyérkockát).', 4, 1, 5, 100.00),
(25, 'Alap piskóta', '../../assets/kepek/etelek/Piskota.webp', '00:25:00', 3, 15, 12, 'Melegítsd elő a sütőt 180 °C-ra (alsó-felső sütés, légkeverés esetén 160–170 °C).\r\nA tojásokat óvatosan válaszd szét: a fehérjébe egyáltalán ne kerüljön sárgája, mert akkor nem lesz kemény hab (használj 3 tálat: egyik a fehérjéknek, egyik a sárgáknak, egyik a töréshez).\r\nA tojásfehérjéket verd kemény habbá elektromos habverővel (kezd alacsony sebességgel, majd emeld közepesre). Ellenőrizd: ha fejjel lefelé fordítod a tálat, a hab nem folyik ki.\r\nA tojássárgákat keverd habosra a cukorral (3–4 percig, világos sárga, krémes állag).\r\nÓvatosan forgasd a hab felét a sárgás masszába (alulról felfelé, ne keverd túl erősen, hogy ne essen össze a hab).\r\nSzitáld hozzá a lisztet (fontos a szitálás, hogy ne legyen csomós), és finoman forgasd bele.\r\nÖntsd a masszát sütőpapírral bélelt tepsibe (kb. 30×40 cm, vagy tortaforma). Egyenletesen simítsd el.\r\nSüsd 180 °C-on 10–12 percig (tűpróba: ha tisztán jön ki a fogpiszkáló, kész).\r\nVedd ki, hagyd hűlni a tepsiben 5 percig, majd borítsd ki rácsra.', 6, 1, 7, 160.00),
(26, 'Piskótatekercs', '../../assets/kepek/etelek/Piskotatekercs.webp', '00:30:00', 3, 15, 12, 'Melegítsd elő a sütőt 180 °C-ra (alsó-felső).\r\nUgyanaz a tojásszétválasztás és habverés, mint az alap piskótánál (lásd fent).\r\nA masszát öntsd sütőpapírral bélelt tepsibe, egyenletesen simítsd el vékonyra (kb. 1 cm vastag réteg).\r\nSüsd 10–12 percig, amíg a teteje aranybarna és ruganyos (ne süsd túl, különben törni fog tekercseléskor).\r\nAmíg sül, készíts elő egy tiszta konyharuhát, szórj rá kevés porcukrot (hogy ne ragadjon rá a piskóta).\r\nAmint kiveszed a sütőből, azonnal borítsd ki a forró piskótát a porcukros ruhára, húzd le óvatosan a sütőpapírt.\r\nTekerd fel szorosan a konyharuhával együtt (ez tartja formában hűlés közben).\r\nHagyd teljesen kihűlni (kb. 30–40 perc).\r\nÓvatosan tekerd ki, kend meg vékonyan lekvárral (ne legyen túl vastag, különben kifolyik).\r\nTekerd vissza szorosan (ruha nélkül), csomagold fóliába, és tedd hűtőbe 1 órára, hogy szeletelhető legyen.', 6, 1, 7, 180.00),
(27, 'Sült csirkemell rizzsel', '../../assets/kepek/etelek/CsirkeRizs.webp', '00:30:00', 4, 20, 1, 'A csirkemellet mosd meg hideg vízben, majd papírtörlővel alaposan töröld szárazra (ez nagyon fontos, hogy ne engedjen levet sütés közben és szép kérget kapjon).\r\nVágd egyenletes vastagságú szeletekre vagy csíkokra (kb. 1–1,5 cm vastag), hogy egyszerre süljön át.\r\nSózd és borsozd mindkét oldalát.\r\nEgy serpenyőben hevíts fel 1 ek olajat közepes lángon (az olaj akkor jó, ha enyhén csillog).\r\nTedd bele a csirkeszeleteket egy rétegben (ne zsúfold túl, mert akkor párolódik, nem sül). Süsd oldalanként 4–5 percig, amíg aranybarna kérget kap és a belseje már nem rózsaszín (belső hőmérséklet kb. 75 °C). Ne süsd túl, mert kiszárad!\r\nKözben a rizst mérd ki: 200 g rizshez 400 ml vizet. Egy lábasban pirítsd a rizst 1–2 percig kevés olajon (üveges lesz), sózd, öntsd fel vízzel, forrald fel, majd alacsony lángon fedő alatt főzd 12–15 percig, amíg a víz teljesen felszívódik. Hagyd pihenni 5 percet fedő alatt.\r\nA brokkolit szedd rózsáira, tedd forrásban lévő sós vízbe, főzd 5–7 percig (roppanós maradjon). Szűrd le.\r\nTálald a csirkét a rizzsel és brokkolival együtt.', 1, 2, 1, 500.00),
(30, 'Milánói sertésborda', '../../assets/kepek/etelek/MilanoiSertesborda.webp', '00:40:00', 4, 20, 1, 'Rántott sertésborda\r\nA sertésszeletet klopfolóval óvatosan klopfold ki, hogy egyenletes vastagságú legyen.\r\nSózd és borsozd meg mindkét oldalát.\r\nKészíts elő három tányért:\r\naz egyikbe lisztet,a másikba felvert tojást,a harmadikba zsemlemorzsát.\r\nA hússzeletet panírozd liszt → tojás → zsemlemorzsa sorrendben.\r\nÜgyelj arra, hogy mindenhol egyenletesen fedje a panír.\r\nEgy serpenyőben hevíts bő olajat közepes lángon.\r\n(Az olaj akkor jó, ha a belepottyantott morzsa azonnal pezseg.)\r\nSüsd ki a húst oldalanként kb. 4–5 perc alatt, amíg szép aranybarna nem lesz.\r\nSzedd ki papírtörlőre, hogy a felesleges olaj lecsepegjen.\r\nMilánói tészta:\r\nEgy nagyobb lábasban forralj vizet, sózd meg.\r\nFőzd meg benne a spagettit a csomagoláson feltüntetett idő szerint (általában 8–10 perc).\r\nSzűrd le a tésztát.\r\nEgy kisebb edényben melegítsd fel a paradicsomszószt.\r\nAdd hozzá a csíkokra vágott sonkát, és keverd össze.\r\nA tányérba tedd bele a tésztát, tedd rá a szószt, illetve a tetejére a rántott húst. Majd tálald.', 1, 3, 1, 850.00),
(31, 'Tejszínes-gombás csirkemell', '../../assets/kepek/etelek/TejszinesGombasCsirkemell.webp', '00:35:00', 4, 20, 2, 'A csirkemellet mosd meg, töröld szárazra, majd kockázd fel egyforma méretű darabokra, hogy egyenletesen süljenek.\r\nA gombát tisztítsd meg (szükség esetén mosd meg gyorsan), majd szeleteld fel.\r\nEgy serpenyőben hevítsd fel az olajat közepes lángon.\r\nAdd hozzá a csirkemellet, és süsd addig, amíg minden oldala kifehéredik és enyhén megpirul.\r\nTedd hozzá a felszeletelt gombát.\r\nPárold 4–5 percig, amíg a gomba levet enged, majd összeesik és a leve nagy része elpárolog.\r\nÖntsd hozzá a főzőtejszínt, keverd össze.\r\nSózd és borsozd ízlés szerint.\r\nAlacsonyabb lángon főzd tovább kb. 8–10 percig, amíg a szósz besűrűsödik.\r\nKözben egy lábasban forralj vizet, sózd meg.\r\nFőzd ki benne a tésztát a csomagoláson feltüntetett idő szerint.\r\nSzűrd le a tésztát.\r\nKeverd össze a tésztát és a szószt és tálald. \r\n', 1, 2, 1, 420.00),
(32, 'Párolt zöldségek', '../../assets/kepek/etelek/ParoltZoldseg.webp', '00:15:00', 4, 20, 2, 'A zöldségeket alaposan mosd meg.\r\nTisztítsd meg és vágd egyforma méretű darabokra.\r\nEgy lábas aljába önts kevés vizet, forrald fel.\r\nHelyezz rá párolóbetétet vagy szűrőt, tedd bele a zöldségeket.\r\nFedd le és párold 10–12 percig, amíg puhák, de még roppanósak.\r\nHa nincs párolóbetét, kevés vízzel fedő alatt is párolhatók.\r\nSzűrd le, sózd ízlés szerint, és azonnal tálald.', 4, 1, 10, 80.00),
(33, 'Muffin', '../../assets/kepek/etelek/Muffin.webp', '00:40:00', 4, 15, 12, 'Melegítsd elő a sütőt 180 °C-ra (alsó–felső sütés).\r\nKészíts elő egy muffin sütőformát, béleld ki muffin papírokkal.\r\nEgy tálban keverd össze a száraz hozzávalókat: liszt, cukor, sütőpor.\r\nAdd hozzá a tojásokat, a tejet és az olajat.\r\nKeverd simára -állagra egy tejföl sűrűségű masszát kell kapnod-, majd forgasd bele a csokicseppet vagy gyümölcsöt.\r\nA masszát kanalazd a formákba ¾ magasságig.\r\nSüsd 10-15 percig, tűpróbával ellenőrizd(ha száraz a fogpiszkáló amit beleszúrsz akkor jó  a sütemény, ha még ráragad a tészta, akkor tedd vissza egy-két percre).', 6, 1, 7, 150.00),
(34, 'Csokis bögrés süti', '../../assets/kepek/etelek/CsokisBogresSuti.webp', '00:05:00', 4, 15, 1, 'Egy nagy bögrében keverd össze a lisztet, cukrot, kakaóport és sütőport.\r\nAdd hozzá a tejet, olajat és a tojást, majd keverd csomómentesre.\r\nTedd mikrohullámú sütőbe 700–900 W teljesítményen 1 perc 20–40 másodpercre.\r\nA teteje legyen szilárd, a közepe enyhén lágy.\r\nHagyd állni 1–2 percig, majd melegen fogyaszd.', 7, 1, 7, 300.00),
(35, 'Rántott hús krumplipürével', '../../assets/kepek/etelek/RantottHusKrumpliPurevel.webp', '00:45:00', 5, 25, 2, 'A hússzeleteket klopfold ki egyenletes vastagságúra, majd enyhén sózd.\r\nPanírozd lisztbe, felvert tojásba, majd zsemlemorzsába.\r\nBő olajban süsd aranybarnára oldalanként 4–5 perc alatt.\r\nA burgonyát hámozd meg, darabold fel, majd sós vízben főzd puhára.\r\nSzűrd le, törd össze, add hozzá a vajat és a meleg tejet.\r\nSózd ízlés szerint, keverd krémesre.\r\nTálald a frissen sült rántott hússal.', 8, 3, 1, 750.00),
(36, 'Rakott krumpli', '../../assets/kepek/etelek/RakottKrumpli.webp', '00:50:00', 5, 25, 4, 'A hagymát pucold meg és vágd apró kockára.\r\nEgy kevés zsiradékon dinszteld meg, amíg kissé összeesik.\r\nA burgonyát hámozd meg, majd mosd meg.\r\nEnyhén sós vízben főzd teljesen puhára – akkor jó, ha villával könnyen átszúrható.\r\nA tojásokat tedd egy lábasba, öntsd fel vízzel, majd a forrástól számítva főzd 10–12 percig, hogy kemény tojás legyen.\r\nA főzés után öntsd le a forró vizet, majd hideg vízzel hűtsd le, így könnyebb megpucolni.\r\nA kolbászt szeleteld fel.\r\nEgy kivajazott tepsiben kezdd el a rétegezést: alul a dinsztelt hagyma, majd krumpli → kolbász → tojás → tejföl.\r\nFolytasd a rétegezést, amíg az alapanyagok el nem fogynak.\r\nA tetejére mindig tejföl kerüljön.\r\nSüsd előmelegített sütőben 180 °C-on kb. 30 percig, amíg a teteje szépen megpirul.', 6, 3, 3, 600.00),
(37, 'Bolognai spagetti', '../../assets/kepek/etelek/BolognaiSpagetti.webp', '00:35:00', 5, 25, 3, 'A hagymát pucold meg és  vágd apróra, majd pirítsd üvegesre kevés olajon.\r\nAdd hozzá a darált húst, pirítsd addig amíg kifehéredik.\r\nNyomd bele a fokhagymát, figyelj arra, hogy a fokhagyma nehogy leégjen, mert akkor keserű íze lesz a ragunak.\r\nÖntsd hozzá a paradicsomszószt, sózd, borsozd, ha egy kicsit édesebben szeretnéd akkor tehetsz bele egy kevés ketchupot. \r\nFőzd 15–20 percig, amíg besűrűsödik.\r\nA spagettihez forralj egy nagy lábasban vizet. \r\nAdj hozzá olajat és jól sózd meg a vizet.\r\nHa a víz felforrt, tedd bele a tésztát, és főzd 10-12 percig.\r\nHa a tészta megfőtt, szűrd le, mosd át folyó hideg vízzel, és tedd egy olajon edénybe. \r\nA szószt és a tésztát keverd össze, és tálald. \r\n', 4, 3, 3, 650.00),
(38, 'Zöldborsófőzelék fasírttal', '../../assets/kepek/etelek/BorsoFozelekFasirttal.webp', '00:35:00', 5, 25, 2, 'Zöldborsófőzelék:\r\nA zöldborsót tedd fel főzni annyi enyhén sós vízben, amennyi éppen ellepi.\r\n Főzd puhára közepes lángon kb. 10–12 perc alatt. \r\nA lisztet keverd el egy kevés tejjel csomómentesre, majd add hozzá a maradék tejet.\r\n Ha mégis csomós lenne, egy finom lyukú szűrőn szűrd át.\r\n Folyamatos keverés mellett öntsd a borsóhoz.\r\n Főzd tovább, amíg a főzelék besűrűsödik.\r\n Sózd ízlés szerint.\r\nFasírt elkészítése:\r\nA zsemlét vagy kenyeret áztasd be a vízbe, majd alaposan nyomkodd ki.\r\n A hagymát és a fokhagymát reszeld vagy vágd nagyon apróra.\r\n Egy tálban keverd össze a darált húst, tojást, beáztatott zsemlét, hagymát, fokhagymát és a fűszereket.\r\n Adj hozzá zsemlemorzsát, hogy jól formázható masszát kapj.\r\n Vizes kézzel formázz 4 közepes méretű fasírtot.\r\n Forrósíts olajat, és süsd ki a fasírtokat közepes lángon, oldalanként 3–4 perc alatt, aranybarnára.\r\n Szedd ki papírtörlőre, hogy a felesleges olaj lecsepegjen.\r\nMajd tálald az ételt. \r\n', 4, 2, 4, 550.00),
(39, 'Pudingos-habos pohárdesszert', '../../assets/kepek/etelek/PudingosHabosPohar.webp', '00:15:00', 5, 20, 2, 'Főzd meg a pudingot a leírása alapján a tejjel és cukorral, majd hűtsd langyosra.\r\nA habtejszínt verd kemény habbá.\r\nKezd el rétegezni pohárban: puding → babapiskóta → tejszínhab.\r\nFolytasd, amíg az alapanyagok elfogynak.\r\nHűtsd legalább 1–2 órát, hogy összeálljon.\r\n', 2, 1, 8, 300.00),
(40, 'Almás pite', '../../assets/kepek/etelek/AlmasPite.webp', '01:00:00', 5, 20, 6, 'Az almákat hámozd meg, reszeld le, majd keverd össze a cukorral és a fahéjjal.\r\n Ízlés szerint az almát enyhén meg is párolhatod, majd hagyd kihűlni.\r\nAz omlós tésztához a lisztet, sütőport, sót és porcukrot keverd össze, majd morzsold el a hideg vajjal.\r\n Add hozzá a tojást, és gyors mozdulatokkal gyúrj belőle sima tésztát. \r\nTedd a hűtőbe egy órára, hogy összeálljon a tészta.\r\nOszd két részre a tésztát.\r\nA egyik tésztarészt nyújtsd ki akkorára, hogy befedje a tepsi alját, és helyezd bele. \r\nSzórd meg vékonyan darált háztartási keksszel, majd terítsd rá az almás tölteléket. \r\nA másik tésztarészt nyújtsd ki, fedd be vele az almát.\r\nVillával szurkáld meg a tetejét, hogy sütés közben a gőz távozni tudjon, így a pite nem púposodik fel.\r\nSüsd előmelegített sütőben 180°C-on 30–35 percig, amíg aranybarnára sül.\r\nKihűlés után porcukorral meghintve tálald.\r\n', 6, 2, 7, 260.00),
(41, 'Marhapörkölt nokedlivel', '../../assets/kepek/etelek/MarhaporkoltNokedli.webp', '02:30:00', 6, 25, 4, 'A vöröshagymát hámozd meg és vágd nagyon apróra.\r\nEgy vastag aljú lábasban hevítsd fel az olajat vagy zsírt közepes lángon.\r\nAdd hozzá a hagymát, és pirítsd üvegesre.\r\nA marhahúst mosd meg, töröld szárazra, majd kockázd fel.\r\nAdd a húst a hagymához, és pirítsd addig, amíg kifehéredik.\r\nVedd le az edényt a tűzről, majd szórd meg a pirospaprikával.\r\nAzonnal önts alá kb. 1–1,5 liter vizet, majd keverd el.\r\nSózd meg ízlés szerint, fedd le, és lassú tűzön főzd kb. 2 órán át.\r\nIdőnként ellenőrizd, ha elfő a leve, pótold kevés vízzel.\r\nA pörkölt akkor kész, ha a hús omlós és a szaft sűrű.\r\n\r\nNokedli:\r\nEgy tálban keverd össze a lisztet és a sót.\r\nAdd hozzá a tojásokat, majd fokozatosan a vizet.\r\nKeverd sűrű, ragacsos tésztává.\r\nForrásban lévő sós vízbe szaggasd a tésztát.\r\nAmikor feljönnek a víz tetejére, szűrd le, és tálalhatod.', 4, 3, 2, 680.00),
(42, 'Csirkepaprikás galuskával', '../../assets/kepek/etelek/CsirkepaprikasGaluska.webp', '01:00:00', 6, 25, 4, 'Csirkepaprikás elkészítése:\r\nA hagymát hámozd meg, vágd finomra, majd egy nagyobb lábasban kevés olajon pirítsd üvegesre. \r\nAdd hozzá a csirkedarabokat, és pirítsd át minden oldalukon, amíg kifehérednek.\r\n Vedd le az edényt a tűzről, szórd meg pirospaprikával, keverd el, majd azonnal önts alá kevés vizet, hogy a paprika ne égjen meg.\r\n Sózd (és borsozd), majd fedő alatt, közepes lángon főzd 40–50 percig, amíg a csirke teljesen megpuhul és szaftos lesz.\r\nA tejfölt egy tálban keverd simára.\r\n Egy merőkanállal vegyél ki a forró szaftból, és fokozatosan keverd a tejfölhöz, hogy kiegyenlítődjenek a hőmérsékletek.\r\n A tejfölös keveréket öntsd vissza a paprikáshoz, majd alacsony lángon melegítsd össze.\r\n Ne forrald, mert a tejföl kicsapódhat.\r\nGaluska elkészítése:\r\nA lisztet tedd egy tálba, add hozzá a sót.\r\n Üsd bele a tojásokat, majd fokozatosan add hozzá a vizet.\r\n Keverd sűrű, de szaggatható állagú tésztává.\r\n Egy nagy lábasban forralj sós vizet, majd galuskaszaggatóval vagy kanállal szaggasd bele a tésztát.\r\n Főzd addig, amíg a galuskák feljönnek a víz felszínére (kb. 2–3 perc).\r\n Szűrd le, majd azonnal tálald.\r\n', 4, 3, 2, 700.00),
(43, 'Hortobágyi húsos palacsinta', '../../assets/kepek/etelek/HortobagyiPalacsinta.webp', '01:00:00', 6, 25, 4, 'Palacsinták sütése\r\nA palacsintatészta hozzávalóit keverd össze egy tálban sima, folyékony, de nem vízszerű masszává.\r\n Egy serpenyőt vékonyan kenj ki olajjal, majd melegítsd fel közepes lángon.\r\n Merőkanállal önts tésztát a serpenyőbe, és süsd a palacsintákat oldalanként 1–1,5 percig.\r\n A kész palacsintákat tedd félre.\r\n\r\nHúsos töltelék\r\nA vöröshagymát hámozd meg, majd vágd nagyon apróra.\r\n Egy serpenyőben hevíts kevés olajat közepes lángon, majd pirítsd üvegesre a hagymát.\r\n Add hozzá a darált húst, és fakanállal morzsold szét.\r\n Sózd, borsozd, majd pirítsd addig, amíg a hús kifehéredik és szaftos lesz.\r\n Húzd le a tűzről, szórd meg a pirospaprikával, keverd el, majd öntsd fel kb. 1 dl vízzel.\r\n Kis lángon főzd tovább, amíg a töltelék szaftos, de nem túl folyós.\r\n Szűrd le a húsos ragut, a szaftot tedd félre – ez lesz az öntet alapja.\r\n\r\nTejfölös öntet\r\nA félretett húsos szaftot hagyd langyosra hűlni.\r\n Egy tálban keverd simára a tejfölt, majd fokozatosan add hozzá a szaftot, hogy az öntet ne csapódjon ki.\r\n\r\nPalacsinták töltése\r\nA palacsintákat terítsd ki.\r\n Kanalazz a közepükre a húsos töltelékből.\r\n Hajtsd be az oldalsó széleket, majd tekerd fel szorosan.\r\n\r\nSütés\r\nA megtöltött palacsintákat helyezd egy kivajazott tűzálló tálba egymás mellé.\r\n Öntsd le őket a tejfölös öntettel.\r\n Előmelegített sütőben, 180°C-on süsd 10–15 percig, amíg a teteje enyhén megpirul.\r\n', 6, 3, 3, 650.00),
(44, 'Tokány zöldségekkel', '../../assets/kepek/etelek/TokanyZoldseggel.webp', '00:45:00', 6, 25, 3, 'A vöröshagymát hámozd meg, majd vágd finomra.\r\nA paprikát mosd meg, magozd ki, és vágd csíkokra.\r\nA paradicsomot mosd meg, majd aprítsd fel (héja maradhat rajta).\r\nEgy serpenyőben vagy lábasban hevítsd fel az olajat közepes lángon.\r\nAdd hozzá a hagymát, és pirítsd üvegesre.\r\n (Akkor jó, ha puha és világos, nem barnul.)\r\nTedd hozzá a csíkokra vágott húst.\r\nPirítsd addig, amíg kifehéredik és levet enged.\r\nAdd hozzá a felaprított paprikát és paradicsomot.\r\nSózd és borsozd ízlés szerint, majd keverd át alaposan.\r\nFedd le az edényt, és kis lángon párold 35–40 percig, amíg a hús teljesen megpuhul.\r\nHa szükséges, adj hozzá 1–2 evőkanál vizet, de a tokány nem leveses, csak enyhén szaftos.\r\nAkkor kész, ha a hús villával könnyen átszúrható, a szaft pedig sűrű és ízes.\r\n', 1, 3, 3, 620.00),
(45, 'Linzerkarikák', '../../assets/kepek/etelek/LinzerKarika.webp', '01:00:00', 6, 20, 20, 'A vajat vedd ki a hűtőből közvetlenül felhasználás előtt, majd kockázd fel.\r\nEgy tálban keverd össze a lisztet, porcukrot és a sót.\r\nAdd hozzá a hideg vajat, és gyors mozdulatokkal morzsold el a lisztes keverékben.\r\nNe gyúrd hosszan, mert a tészta melegedni kezd és nem lesz omlós.\r\nAmikor a tészta összeáll, formázz belőle gombócot.\r\nCsomagold folpackba, majd pihentesd a hűtőben 30 percig.\r\n (Ez segít, hogy a tészta nyújtáskor ne repedezzen.)\r\nMelegítsd elő a sütőt 180°C-ra (alsó–felső sütés).\r\nA pihentetett tésztát lisztezett felületen kb. 3–4 mm vastagra nyújtsd ki\r\nSzaggass belőle karikákat.\r\nA kiszaggatott korongok felének a közepét egy kisebb szaggatóval vagy kupakkal lyukaszd ki.\r\nA korongokat helyezd sütőpapírral bélelt tepsire.\r\nSüsd 180°C-on kb. 8–10 percig.\r\n Akkor jó, ha világos marad, csak az alja kezd enyhén pirulni\r\nHa megsült, hagyd kihűlni őket\r\nHa kihűltek, akkor kenj meg egy teljes karikát lekvárral, és egy lyukas közepűvel tapaszd őssze.\r\n', 6, 1, 7, 110.00),
(46, 'Mézes puszedli', '../../assets/kepek/etelek/MezesPuszedli.webp', '00:40:00', 6, 20, 18, 'Elkészítés\r\nMézes tészta\r\nA vajat olvaszd fel, majd hagyd langyosra hűlni.\r\nA mézet enyhén langyosítsd meg, ne legyen forró.\r\n Egy nagy tálban keverd össze a mézet, a porcukrot és az olvasztott vajat.\r\n Add hozzá a tojássárgájákat, és keverd simára.\r\nEgy külön tálban keverd össze a lisztet, a szódabikarbónát és a fűszereket.\r\nA száraz keveréket adagokban add a mézes masszához.\r\nÖntsd hozzá a tejet, majd dolgozd össze enyhén lágy, jól formázható tésztává.\r\nFormázás és sütés\r\nMelegítsd elő a sütőt 180°C-ra (alsó–felső sütés).\r\nA tésztából diónyi golyókat formázz.\r\nHelyezd sütőpapírral bélelt tepsire, egymástól távolabb.\r\nSüsd 10–12 percig, amíg a tetejük kissé megreped, de világos színűek maradnak.\r\nVedd ki, és hagyd teljesen kihűlni.\r\n\r\nMáz készítése\r\nA tojásfehérjéket tedd egy tálba.\r\nAdd hozzá a porcukrot, majd kézi vagy elektromos habverővel keverd sűrű, fényes, sima mázzá.\r\nA kihűlt puszedlik tetejére kanalazd vagy csurgasd rá a mázat.\r\nHagyd állni, amíg a máz teljesen megszárad.\r\n', 6, 1, 7, 90.00),
(47, 'Gulyásleves', '../../assets/kepek/etelek/GulyasLeves.webp', '01:45:00', 7, 30, 5, 'A vöröshagymát finomra aprítsd, majd egy vastag aljú lábasban hevíts fel kevés olajat közepes lángon.\r\nAdd hozzá a hagymát, és pirítsd üvegesre.\r\nAdd hozzá a kockázott marhahúst, és pirítsd addig, amíg kifehéredik és levet enged.\r\nVedd le a lábast a tűzről, add hozzá az őrölt pirospaprikát, keverd el, majd azonnal önts alá kevés vizet (kb. 1–2 dl), hogy a paprika ne égjen meg.\r\nSózd és borsozd ízlés szerint, fedd le, majd kis lángon párold 40–50 percig, időnként ellenőrizve.\r\nHa elfő a leve, mindig csak kevés vizet pótolj.\r\nAdd hozzá a felkockázott sárgarépát és fehérrépát, majd öntsd fel kb. 1,5 liter vízzel.\r\nFőzd tovább 20 percig, amíg a zöldségek félig megpuhulnak.\r\nAdd hozzá a felkockázott burgonyát, és főzd addig, amíg minden alapanyag teljesen megpuhul.\r\nKóstold meg, szükség szerint sózd, majd forrón tálald friss kenyérrel.\r\n', 4, 2, 6, 420.00),
(48, 'Brassói aprópecsenye', '../../assets/kepek/etelek/BrassoiApropecsenye.webp', '01:00:00', 7, 30, 3, 'A sertéshúst mosd meg, töröld szárazra, majd kockákra vágd fel.\r\nEgy serpenyőben hevíts kevés olajat közepes lángon.\r\nAdd hozzá a húst, és pirítsd addig, amíg kifehéredik és enyhén megpirul.\r\nSózd és borsozd ízlés szerint, majd fedd le, és kis lángon párold 25–30 percig, amíg a hús teljesen megpuhul.\r\nHa szükséges, adj hozzá 1–2 evőkanál vizet, de ne legyen szaftos.\r\nKözben a krumplit hámozd meg, mosd meg, majd kockázd fel.\r\nEgy másik serpenyőben vagy lábasban hevíts bő olajat.\r\nSüsd ki benne a krumplit aranybarnára, majd szedd ki papírtörlőre, hogy a felesleges olaj lecsepegjen.\r\nAmikor a hús puha, add hozzá a zúzott fokhagymát, és keverd át.\r\n A fokhagymát mindig a végén add hozzá, hogy ne égjen meg és ne legyen keserű.\r\nAdd hozzá a sült krumplit, majd óvatosan forgasd össze a hússal.\r\nKóstold meg, szükség szerint sózd még.\r\n', 1, 3, 1, 750.00),
(49, 'Töltött csirkecomb', '../../assets/kepek/etelek/ToltottCsirkeComb.webp', '01:00:00', 7, 30, 2, 'A comb bőrét óvatosan emeld fel, hogy zsebet képezz.\r\nSózd, borsozd kívül-belül.\r\nA tölteléket keverd össze (sajt + sonka + zöldség).\r\nTöltsd a bőr alá.\r\nTedd tepsibe és süsd 180°C-on 40–50 percig.\r\nAddig süsd amíg a  bőre szép ropogós nem lesz.\r\n', 6, 3, 1, 680.00),
(50, 'Hagymás rostélyos', '../../assets/kepek/etelek/HagymasRostelyos.webp', '00:40:00', 7, 30, 2, 'A húst sózd, borsozd.\r\nSerpenyőben forró olajon süsd át mindkét oldalát (közepes átsütés: 3–4 perc oldalanként).\r\nA hagymát karikázd fel.\r\nUgyanabban a serpenyőben lassan karamellizáld aranybarnára.\r\nA hagymakarikákat szépen, lassú túzön folyamatos keverés mellett karamellizáljuk meg\r\nA húst tálald a hagymával a tetején.\r\n', 1, 3, 1, 720.00),
(53, 'Képviselőfánk', '../../assets/kepek/etelek/KepviseloFank.webp', '01:30:00', 7, 25, 12, 'A vizet és vajat forrald fel.\r\nAdd hozzá a lisztet egyszerre és keverd, míg elválik az edény falától.\r\nHagyd hűlni, majd egyesével keverd hozzá a tojásokat.\r\nNyomózsák segítségével formázz kis halmokat sütőpapírra.\r\nSüsd 230°C-on 5 percig, majd 200°C-on további 10-15 percig.\r\nA kihűlt fánkokat töltsd meg vaníliakrémmel és tejszínhabbal.\r\n', 6, 3, 7, 220.00),
(54, 'Profiterol', '../../assets/kepek/etelek/Profiterol.webp', '01:00:00', 7, 25, 4, 'Égetett tészta elkészítése:\r\nA vizet, a vajat és a sót egy lábasban forrald fel.\r\nVedd le a tűzről, add hozzá egyszerre a lisztet, majd gyors mozdulatokkal keverd csomómentesre.\r\nTedd vissza a tűzre, és keverd addig, amíg a tészta elválik az edény falától.\r\nHagyd langyosra hűlni, majd egyenként keverd bele a tojásokat.\r\nA kész tésztát habzsákba töltsd, és sütőpapírral bélelt tepsire nyomj kis golyókat.\r\nSüsd 200°C-on 20–25 percig. Sütés közben ne nyisd ki a sütőt, mert a fánkok összeesnek.\r\nHagyd teljesen kihűlni.\r\n\r\n\r\n\r\nVaníliás pudingos krém:\r\nA pudingport keverd el kevés tejjel és a cukorral.\r\nA maradék tejet forrald fel, majd főzd bele a pudingot sűrűre.\r\nHagyd teljesen kihűlni.\r\nA habtejszínt verd kemény habbá, majd óvatosan forgasd bele a kihűlt pudingba.\r\nA fánkok alját vágd meg, és töltsd meg a krémmel.\r\n\r\nCsokoládéöntet elkészítése:\r\nA tejszínt melegítsd fel egy kis lábasban, de ne forrald.\r\nAdd hozzá az apróra tört étcsokoládét, és keverd simára.\r\nKeverd bele a vajat, amíg fényes, selymes öntetet kapsz.\r\nÍzlés szerint adj hozzá cukrot.\r\nLangyosan öntsd a megtöltött profiterolokra.\r\n', 6, 3, 7, 450.00),
(56, 'Egészben sült csirke', '../../assets/kepek/etelek/EgeszbenSultCsirke.webp', '01:30:00', 8, 30, 4, 'A csirkét tisztítsd meg, papírtörlővel töröld szárazra.\r\nA külsejét és belsejét dörzsöld be sóval és borssal.\r\nMajd a bőre alá tegyél a vajas masszából\r\nvagyis keverd el a vajat a metélőhagymával és a snidlinggel\r\nKend be olajjal, hogy sütés közben szép aranybarna legyen.\r\nHelyezd tepsibe vagy sütőrácsra.\r\nSüsd 180°C-on kb. 75–90 percig, amíg a bőre ropogós, a húsa pedig teljesen átsült.\r\nHa van maghőmérőd, mérd meg a csirkecomb hőmérsékletét, akkor jó, ha 80-85fok körül van. \r\nPihentesd 10 percig szeletelés előtt, majd tálald.\r\n', 6, 3, 1, 520.00),
(57, 'Lazac sütőben citrommal', '../../assets/kepek/etelek/LazacSutobenCitrommal.webp', '00:20:00', 8, 30, 2, 'A lazacot papírtörlővel töröld szárazra.\r\nSózd, borsozd, majd helyezz rá néhány vékony citromkarikát.\r\nTedd sütőpapírral bélelt tepsibe.\r\nSüsd 180°C-on 12–15 percig (a lazac ne száradjon ki, közepe maradjon szaftos).\r\nAzonnal tálald friss salátával vagy párolt zöldséggel.\r\n', 6, 3, 1, 450.00),
(58, 'Sertésszűz baconbe tekerve', '../../assets/kepek/etelek/SertesszuzBaconbeTekerve.webp', '00:45:00', 8, 30, 2, 'A sertésszüzet sózd és borsozd (óvatosan, mert a bacon is sós).\r\nFektesd ki a baconcsíkokat, és helyezd rá a húst.\r\nTekerd fel szorosan, hogy mindenhol fedje a bacon.\r\nSüsd 180°C-on 20–25 percig, amíg a bacon megpirul.\r\nPihentesd 5 percig, majd szeleteld és tálald.\r\n', 6, 3, 1, 670.00),
(59, 'Grillezett zöldségek', '../../assets/kepek/etelek/GrillezettZoldségek.webp', '00:20:00', 8, 30, 2, '1. A zöldségeket karikázd vagy hosszában szeleteld fel.\r\n2. Kend meg mindkét oldalukat olajjal.\r\n3. Sózd meg enyhén.\r\n4. Grillen vagy grillserpenyőben süsd meg mindkét oldalát aranybarnára.\r\nAzonnal tálald.', 1, 1, 10, 180.00),
(60, 'Egyszerű tortalap vajkrémmel', '../../assets/kepek/etelek/PiskotaVajKremmel.webp', '01:00:00', 8, 25, 8, '1. A tojásokat szétválasztod: a fehérjét kemény habbá vered, a sárgáját a cukorral habosra kevered.\r\n2. Óvatosan összeforgatod, majd beleszitálod a lisztet.\r\n3. Öntsd sütőpapírral bélelt tortaformába.\r\n4. Süsd 180°C-on 20–25 percig.\r\n5. A vajkrémet a vaj és porcukor habosításával készíted el.\r\nHa a tortalap kihűlt, töltsd meg és vond be vajkrémmel.', 6, 2, 7, 350.00),
(61, 'Gyümölcsös piskótatorta', '../../assets/kepek/etelek/GyumolcsosTorta.webp', '00:45:00', 8, 25, 8, 'Piskóta lap:\r\n1. A tojásokat szétválasztod: a fehérjét kemény habbá vered, a sárgáját a cukorral habosra kevered.\r\n2. Óvatosan összeforgatod, majd beleszitálod a lisztet.\r\n3. Öntsd sütőpapírral bélelt tortaformába.\r\n4. Süsd 180°C-on 20–25 percig.\r\n\r\nTöltelék:\r\n1. Verd keményre a hideg tejszínt.\r\n2. A gyümölcsöt aprítsd fel.\r\n3. A piskótát vágd két vagy három lapra.\r\n4. Kend meg tejszínhabbal, szórj rá gyümölcsöt.\r\n5. Rakd össze a rétegeket.\r\n6. A tetejét is díszítheted gyümölcsökkel és tejszínhabbal.', 6, 2, 7, 320.00),
(62, 'Vörösboros marharagu', '../../assets/kepek/etelek/VorosborosMarhaRagu.webp', '02:30:00', 9, 35, 4, '1. A marhahúst vágd nagyobb kockákra, sózd, borsozd.\r\n2. Forró lábasban kevés olajon pirítsd körbe, míg kérget kap.\r\n3. Add hozzá a felaprított zöldségeket (répa, hagyma, zeller, gomba), és pirítsd további 3–4 percig.\r\n4. Öntsd fel a vörösborral, majd főzd közepes lángon 2–3 percig, hogy az alkohol elpárologjon.\r\n5. Önts hozzá kevés vizet vagy alaplevet, csak annyit, hogy éppen ellepje.\r\n6. Fedd le, és lassú tűzön főzd 2 órán át, időnként kevergetve.\r\n7. Akkor kész, ha a hús teljesen omlós és a szaft sűrű.\r\n8. Tálald burgonyapürével, rizzsel vagy friss kenyérrel.', 5, 3, 3, 620.00),
(63, 'Töltött káposzta', '../../assets/kepek/etelek/Toltottkaposzta.webp', '02:00:00', 9, 35, 6, '1. A darált húst keverd össze a rizzsel, sózd és borsozd, majd adj hozzá 1 teáskanál pirospaprikát. Ízlés szerint rakhatsz bele paradicsom levet is.\r\n2. A káposztát helyzed forrásban lévő vízbe, és ahogy kezd puhulni a káposzta levele, szépen egyesével le tudod szedni a torzsájáról. Majd töltsd meg a húsos keverékkel, és hajtsd fel a széleit.\r\n3. Egy nagy lábas aljára tegyél savanyúkáposztát, de fontos, hogy mielőtt felhasználód, kóstold meg, hogy nem-e túl savanyú. Ha nagyon savanyú, akkor folyó vízzel mosd át!\r\n4. Helyezd rá a töltelékeket szorosan egymás mellé.\r\n5. Fedd le újabb savanyú káposztával.\r\n6. Önts rá vizet, amennyi éppen ellepi, majd lassú tűzön főzd 1,5–2 órán át.\r\n7. Akkor kész, amikor a rizs teljesen megpuhult és a töltelékek összeálltak.\r\nTejföllel tálalható.', 5, 3, 3, 700.00),
(64, 'Ropogós kacsacomb és kacsamell', '../../assets/kepek/etelek/SultKacsa.webp', '01:20:00', 9, 35, 2, 'Kacsacomb:\r\n1. A combokat sózd és borsozd be.\r\n2. Helyezd tepsibe, fedd le alufóliával.\r\n3. Süsd 160°C-on 60 percig, míg omlós nem lesz.\r\n4. Ha szeretnéd ropogósra, a végén fólia nélkül süsd további 10 percig.\r\n\r\nKacsamell:\r\n1. A bőrös oldalát irdald be, ügyelve, hogy a húsba ne vágj bele.\r\n2. Sózd, borsozd.\r\n3. Forró serpenyőben, bőrrel lefelé süsd 5–6 percig, míg aranybarna nem lesz.\r\n4. Fordítsd meg, majd további 2 percig sütöd a másik oldalát.\r\n5. Pihentesd 5 percig, majd szeleteld.', 6, 3, 1, 820.00),
(65, 'Sajttal-sonkával töltött csirkemell bundában', '../../assets/kepek/etelek/SajttalToltottCsirkeMell.webp', '00:35:00', 9, 35, 2, '1. A csirkemellbe vágj mély zsebet, vigyázva, hogy ne lyukadjon ki.\r\n2. Sózd és borsozd meg.\r\n3. Töltsd meg sajttal.\r\n4. Panírozd liszt–tojás–zsemlemorzsa sorrendben.\r\n5. Bő, forró olajban süsd aranybarnára.\r\n6. Papírtörlőn csepegtesd le, majd tálald.', 8, 3, 1, 650.00),
(66, 'Csokoládé mousse', '../../assets/kepek/etelek/CsokiMousse.webp', '00:20:00', 9, 30, 4, '1. A csokoládét vízgőz felett olvaszd fel.\r\n2. A tojássárgákat keverd a meleg csokoládéhoz.\r\n3. A tejszínt verd lágy habbá.\r\n4. Forgasd óvatosan a csokihoz, hogy habos, könnyű krémet kapj.\r\n5. Töltsd poharakba, majd hűtsd legalább 2–3 órát.\r\n6. Tálaláskor díszítheted gyümölccsel vagy csokiforgáccsal.', 2, 2, 8, 380.00),
(67, 'Tarte au citron', '../../assets/kepek/etelek/TarteAuCitron.webp', '00:40:00', 9, 30, 8, '1. Az omlós tésztához a lisztet, sütőport, sót és porcukrot keverd össze, majd morzsold el a hideg vajjal.\r\n2. Add hozzá a tojást, és gyors mozdulatokkal gyúrj belőle sima tésztát.\r\n3. Tedd a hűtőbe egy órára, hogy összeálljon a tészta.\r\n4. A tésztát nyújtsd ki és helyezd piteformába.\r\n5. Szurkáld meg villával.\r\n6. Süsd elő 180°C-on 10 percig.\r\n7. Keverd ki a citromkrémet.\r\n8. Öntsd a tésztára, majd süsd további 10 percig, amíg a krém megszilárdul.\r\n9. Hűtve szeleteld.', 6, 2, 7, 300.00),
(68, 'Wellington bélszín', '../../assets/kepek/etelek/WellingtonBelszin.webp', '01:45:00', 10, 35, 4, '1. A bélszínt sózd és borsozd meg, majd forró serpenyőben minden oldalát pirítsd kérgesre (1–1 perc oldalanként).\r\n2. Kend meg a húst mustárral, majd tedd félre hűlni.\r\n3. A gombát aprítsd finomra, és száraz serpenyőben pirítsd le, amíg a nedvessége elpárolog.\r\n4. A baconszeleteket fektesd egymás mellé fóliára, kend rájuk a gombát, majd helyezd rá a húst és tekerd fel szorosan.\r\n   Fontos, hogy a fóliát ne tekerd bele!\r\n5. A leveles tésztát nyújtsd ki, csomagold bele a baconos húst, és zárd le a széleket.\r\n6. Kend le tojással.\r\n7. Süsd 200°C-on 25–30 percig, amíg aranybarna nem lesz.\r\n8. Szeletelés előtt pihentesd 10 percig.', 6, 3, 1, 720.00),
(69, 'Sous-vide csirkemell', '../../assets/kepek/etelek/SousVideCsirke.webp', '01:10:00', 10, 35, 2, '1. A csirkemellet sózd és borsozd meg, majd tedd vákuum tasakba az olajjal együtt.\r\n2. Sous-vide gépben 63°C-on főzd pontosan 60 percig.\r\n3. Ha kész, vedd ki és forró serpenyőben mindkét oldalát pirítsd meg 1 percig, hogy kérget kapjon.\r\n4. Pihentesd 2–3 percig, majd szeletelve tálald.\r\n5. Köretként püré, saláta vagy grillezett zöldség ajánlott.\r\n\r\nAlternatív elkészítés sous-vide gép nélkül:\r\n- A csirkemellet sózd és borsozd meg.\r\n- Egy serpenyőben hevíts fel 1 evőkanál olívaolajat közepes lángon.\r\n- Tedd bele a csirkemellet, és mindkét oldalát pirítsd meg 1–1 percig, hogy kérget kapjon.\r\n- Önts alá 1–1,5 dl vizet, majd fedd le szorosan illeszkedő fedővel.\r\n- Vedd vissza a lángot alacsonyra, és párold 12–15 percig, amíg a csirkemell teljesen átsül.\r\n- A végén vedd le a fedőt, és nagyobb lángon 30–60 másodpercig süsd, hogy a felszíne újra kissé pirult legyen.\r\n- Pihentesd 2–3 percig, majd szeletelve tálald.', 5, 1, 1, 240.00),
(70, 'Vörösboros marhapofa pürével', '../../assets/kepek/etelek/VorosborosMarhaPofaKrumpliPurevel.webp', '03:20:00', 10, 35, 2, '1. A marhapofát sózd és borsozd, majd forró serpenyőben minden oldalát pirítsd le.\r\n2. Add hozzá a megtisztított, felaprított hagymát, répát és zellert, és pirítsd együtt pár percig.\r\n3. Öntsd rá a vörösbort és az alaplevet.\r\n4. Fedd le, és kis lángon főzd 2,5–3 órán át, míg a hús teljesen omlós lesz.\r\n5. Közben készítsd el a pürét: a burgonyát főzd puhára, törd össze, dolgozd bele a vajat és a meleg tejet.\r\n6. A megpuhult pofát vedd ki, szeleteld vagy tépd szálakra, majd tálald a pürével és a sűrű szafttal.', 5, 3, 3, 780.00),
(71, 'Házi gnocchi', '../../assets/kepek/etelek/Gnocchi.webp', '00:45:00', 10, 35, 4, '1. A burgonyát főzd meg, törd össze, majd hűtsd langyosra.\r\n2. Keverd hozzá a tojást és a sót.\r\n3. Fokozatosan add hozzá a lisztet, míg lágy, formázható tésztát nem kapsz.\r\n4. Oszd több részre, sodord hengerekké és vágd 2 cm-es darabokra.\r\n5. A darabokat villa hátával húzd picit meg, hogy mintás legyen.\r\n6. Lobogó, sós vízben főzd 2–3 percig, amíg feljönnek a víz tetejére.\r\n7. Lehet vajon pirítva, zsályával tálalni, de paradicsomszósszal is tökéletes.', 4, 1, 3, 280.00),
(72, 'Macaron', '../../assets/kepek/etelek/Macaron.webp', '01:00:00', 10, 30, 15, '1. A mandulalisztet és porcukrot szitáld össze.\r\n2. A tojásfehérjét verd habosra, majd fokozatosan add hozzá a kristálycukrot, amíg fényes habot kapsz.\r\n3. Keverd bele óvatosan a mandulás keveréket.\r\n4. Színezd ételfestékkel, ha szeretnéd.\r\n5. Nyomózsákkal nyomj kis korongokat sütőpapírra.\r\n6. Hagyd száradni szobahőmérsékleten 30–40 percig, míg a teteje bőrös nem lesz.\r\n7. Süsd 150°C-on 12–14 percig.\r\n8. Közben a vajat, porcukrot és tejet keverd krémmé.\r\n9. A kihűlt macaronokat töltsd meg és ragaszd össze.', 6, 2, 7, 110.00),
(73, 'Opera szelet', '../../assets/kepek/etelek/OperaSzelet.webp', '03:15:00', 10, 30, 8, '1. Piskóta:\r\n   A tojásokat a porcukorral és mandulaliszttel habosítsd. A tojásfehérjét a kristálycukorral verd kemény habbá, majd óvatosan forgasd a masszába. Add hozzá az olvasztott vajat.\r\n   Sütőpapíros tepsiben, vékony rétegben süsd 180°C-on 8–10 percig. Hűtsd ki, majd vágd három egyforma lapra.\r\n2. Kávés szirup:\r\n   A vizet a cukorral és kávéval forrald fel, majd hűtsd le.\r\n3. Kávés vajkrém:\r\n   A cukrot és vizet főzd 118°C-ig (cukorszirup). A tojássárgákat verd habosra, majd lassan csorgasd hozzá a forró szirupot. Hűlés után keverd hozzá a puha vajat és a kávét.\r\n4. Ganache:\r\n   A tejszínt melegítsd fel, add hozzá az aprított csokoládét, majd keverd simára.\r\n5. Összeállítás:\r\n   Piskóta → kávés szirup → vajkrém → Piskóta → kávés szirup → ganache → Piskóta → kávés szirup → vajkrém\r\n6. Máz:\r\n   Olvaszd fel a csokoládét az olajjal, majd simítsd a sütemény tetejére.\r\n7. Pihentetés:\r\n   Hűtőben pihentesd legalább 2 órát, majd éles késsel szeleteld.', 6, 3, 7, 480.00);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `recept_hozzavalo`
--

CREATE TABLE `recept_hozzavalo` (
  `ReceptID` int(11) NOT NULL,
  `HozzavaloID` int(11) NOT NULL,
  `Mennyiseg` decimal(10,2) NOT NULL,
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
(10, 30, 2.00, 1),
(11, 24, 10.00, 3),
(11, 25, 30.00, 3),
(11, 30, 2.00, 1),
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
(14, 23, 250.00, 2),
(15, 21, 45.00, 2),
(15, 22, 1.00, 4),
(15, 31, 300.00, 3),
(15, 32, 200.00, 3),
(15, 33, 250.00, 3),
(15, 34, 200.00, 3),
(15, 35, 150.00, 3),
(15, 36, 30.00, 3),
(15, 37, 2.00, 1),
(15, 38, 5.00, 3),
(15, 39, 3000.00, 2),
(16, 17, 6.00, 1),
(16, 18, 30.00, 3),
(16, 21, 30.00, 2),
(16, 22, 1.00, 4),
(16, 37, 2.00, 1),
(16, 39, 1500.00, 2),
(16, 40, 2.00, 3),
(16, 41, 5.00, 3),
(16, 42, 15.00, 2),
(17, 22, 15.00, 3),
(17, 31, 300.00, 3),
(17, 32, 200.00, 3),
(17, 33, 300.00, 3),
(17, 34, 300.00, 3),
(17, 35, 150.00, 3),
(17, 38, 5.00, 3),
(17, 39, 2300.00, 2),
(17, 43, 500.00, 3),
(17, 44, 250.00, 3),
(18, 18, 30.00, 3),
(18, 20, 45.00, 3),
(18, 21, 45.00, 2),
(18, 22, 5.00, 3),
(18, 35, 150.00, 3),
(18, 39, 300.00, 2),
(18, 45, 800.00, 2),
(18, 46, 20.00, 3),
(18, 47, 200.00, 3),
(19, 22, 1.00, 3),
(19, 24, 100.00, 3),
(19, 48, 200.00, 3),
(19, 49, 400.00, 2),
(19, 50, 30.00, 3),
(19, 51, 8.00, 3),
(19, 52, 20.00, 3),
(19, 53, 100.00, 3),
(20, 17, 3.00, 1),
(20, 50, 50.00, 3),
(20, 51, 8.00, 3),
(20, 52, 10.00, 3),
(20, 53, 500.00, 3),
(20, 54, 225.00, 3),
(20, 55, 200.00, 2),
(20, 56, 30.00, 2),
(21, 22, 1.00, 4),
(21, 30, 40.00, 3),
(21, 57, 400.00, 3),
(21, 58, 200.00, 3),
(21, 59, 100.00, 2),
(22, 22, 1.00, 4),
(22, 35, 150.00, 3),
(22, 59, 100.00, 2),
(22, 60, 600.00, 3),
(22, 61, 40.00, 3),
(23, 20, 12.00, 3),
(23, 22, 1.00, 4),
(23, 45, 700.00, 2),
(23, 59, 100.00, 2),
(24, 22, 1.00, 4),
(24, 34, 300.00, 3),
(24, 58, 200.00, 3),
(24, 59, 100.00, 2),
(24, 62, 30.00, 3),
(25, 17, 6.00, 1),
(25, 18, 150.00, 3),
(25, 20, 150.00, 3),
(26, 17, 6.00, 1),
(26, 18, 150.00, 3),
(26, 20, 150.00, 3),
(26, 25, 200.00, 3),
(27, 21, 15.00, 2),
(27, 22, 1.00, 4),
(27, 57, 200.00, 3),
(27, 63, 250.00, 3),
(27, 64, 200.00, 3),
(27, 65, 1.00, 4),
(30, 17, 1.00, 1),
(30, 18, 30.00, 3),
(30, 22, 1.00, 4),
(30, 65, 1.00, 4),
(30, 66, 140.00, 3),
(30, 67, 40.00, 3),
(30, 68, 250.00, 2),
(30, 69, 120.00, 3),
(30, 70, 100.00, 2),
(30, 71, 30.00, 3),
(30, 72, 25.00, 3),
(31, 21, 15.00, 2),
(31, 22, 1.00, 4),
(31, 59, 100.00, 2),
(31, 63, 300.00, 3),
(31, 65, 1.00, 4),
(31, 94, 200.00, 3),
(31, 95, 150.00, 3),
(32, 22, 1.00, 4),
(32, 31, 200.00, 3),
(32, 39, 200.00, 2),
(32, 57, 200.00, 3),
(32, 96, 200.00, 3),
(33, 17, 2.00, 1),
(33, 18, 300.00, 3),
(33, 19, 200.00, 2),
(33, 20, 150.00, 3),
(33, 21, 100.00, 2),
(33, 97, 18.00, 3),
(33, 98, 150.00, 3),
(34, 17, 1.00, 1),
(34, 18, 60.00, 3),
(34, 19, 30.00, 2),
(34, 20, 45.00, 3),
(34, 21, 30.00, 2),
(34, 52, 20.00, 3),
(34, 97, 1.00, 3),
(35, 17, 2.00, 1),
(35, 18, 50.00, 3),
(35, 19, 100.00, 2),
(35, 22, 8.00, 3),
(35, 24, 40.00, 3),
(35, 58, 650.00, 3),
(35, 66, 300.00, 3),
(35, 67, 90.00, 3),
(35, 68, 1000.00, 2),
(36, 17, 4.00, 1),
(36, 22, 5.00, 3),
(36, 35, 100.00, 3),
(36, 58, 900.00, 3),
(36, 99, 100.00, 3),
(37, 22, 1.00, 4),
(37, 35, 150.00, 3),
(37, 65, 1.00, 4),
(37, 69, 250.00, 3),
(37, 70, 400.00, 2),
(37, 101, 400.00, 3),
(37, 102, 10.00, 3),
(38, 17, 1.00, 1),
(38, 18, 30.00, 3),
(38, 19, 300.00, 2),
(38, 22, 5.00, 3),
(38, 30, 50.00, 3),
(38, 35, 80.00, 3),
(38, 39, 200.00, 2),
(38, 41, 2.00, 3),
(38, 67, 30.00, 3),
(38, 68, 400.00, 2),
(38, 101, 250.00, 3),
(38, 102, 5.00, 3),
(38, 119, 500.00, 3),
(39, 19, 500.00, 2),
(39, 20, 30.00, 3),
(39, 49, 200.00, 2),
(39, 54, 80.00, 3),
(39, 103, 40.00, 3),
(40, 17, 1.00, 1),
(40, 18, 300.00, 3),
(40, 20, 40.00, 3),
(40, 22, 1.00, 3),
(40, 24, 150.00, 3),
(40, 48, 20.00, 3),
(40, 50, 100.00, 3),
(40, 97, 6.00, 3),
(40, 104, 850.00, 3),
(40, 105, 3.00, 3),
(41, 17, 2.00, 1),
(41, 18, 300.00, 3),
(41, 21, 30.00, 2),
(41, 22, 8.00, 3),
(41, 35, 300.00, 3),
(41, 39, 1400.00, 2),
(41, 41, 15.00, 3),
(41, 107, 600.00, 3),
(41, 108, 30.00, 3),
(42, 17, 2.00, 1),
(42, 18, 300.00, 3),
(42, 22, 11.00, 3),
(42, 35, 250.00, 3),
(42, 39, 350.00, 2),
(42, 41, 30.00, 3),
(42, 63, 1100.00, 3),
(42, 65, 2.00, 3),
(42, 68, 30.00, 2),
(42, 100, 300.00, 3),
(43, 17, 2.00, 1),
(43, 18, 240.00, 3),
(43, 19, 250.00, 2),
(43, 20, 30.00, 3),
(43, 21, 65.00, 2),
(43, 22, 6.00, 3),
(43, 23, 250.00, 2),
(43, 35, 150.00, 3),
(43, 39, 200.00, 2),
(43, 41, 5.00, 3),
(43, 65, 2.00, 3),
(43, 100, 100.00, 3),
(43, 101, 250.00, 3),
(44, 21, 20.00, 2),
(44, 22, 5.00, 3),
(44, 35, 150.00, 3),
(44, 39, 30.00, 2),
(44, 65, 2.00, 3),
(44, 66, 500.00, 3),
(44, 108, 150.00, 3),
(44, 110, 150.00, 3),
(44, 124, 120.00, 3),
(45, 18, 250.00, 3),
(45, 22, 1.00, 3),
(45, 24, 150.00, 3),
(45, 25, 120.00, 3),
(45, 50, 100.00, 3),
(46, 17, 4.00, 1),
(46, 18, 700.00, 3),
(46, 19, 150.00, 2),
(46, 24, 100.00, 3),
(46, 28, 200.00, 3),
(46, 50, 450.00, 3),
(46, 94, 8.00, 3),
(46, 95, 2.00, 3),
(46, 105, 5.00, 3),
(47, 21, 20.00, 2),
(47, 22, 1.00, 4),
(47, 31, 200.00, 3),
(47, 32, 150.00, 3),
(47, 35, 150.00, 3),
(47, 39, 1700.00, 2),
(47, 41, 15.00, 3),
(47, 58, 300.00, 3),
(47, 65, 1.00, 4),
(47, 101, 400.00, 3),
(48, 21, 50.00, 2),
(48, 22, 1.00, 4),
(48, 58, 600.00, 3),
(48, 65, 1.00, 4),
(48, 66, 500.00, 3),
(48, 102, 10.00, 3),
(49, 22, 1.00, 4),
(49, 65, 1.00, 4),
(49, 107, 2.00, 1),
(49, 108, 120.00, 3),
(49, 109, 80.00, 3),
(49, 110, 50.00, 3),
(50, 21, 20.00, 2),
(50, 22, 1.00, 4),
(50, 35, 300.00, 3),
(50, 65, 1.00, 4),
(50, 107, 300.00, 3),
(53, 17, 4.00, 1),
(53, 18, 120.00, 3),
(53, 19, 400.00, 2),
(53, 24, 100.00, 3),
(53, 39, 200.00, 2),
(53, 49, 200.00, 2),
(53, 103, 40.00, 3),
(54, 17, 4.00, 1),
(54, 18, 150.00, 3),
(54, 19, 400.00, 2),
(54, 20, 30.00, 3),
(54, 22, 1.00, 3),
(54, 24, 100.00, 3),
(54, 39, 250.00, 2),
(54, 49, 300.00, 2),
(54, 103, 40.00, 3),
(54, 116, 100.00, 3),
(56, 21, 20.00, 2),
(56, 22, 15.00, 3),
(56, 24, 250.00, 3),
(56, 65, 10.00, 3),
(56, 117, 1.00, 4),
(56, 118, 20.00, 3),
(57, 22, 5.00, 3),
(57, 65, 2.00, 3),
(57, 120, 300.00, 3),
(57, 121, 60.00, 3),
(58, 22, 5.00, 3),
(58, 61, 180.00, 3),
(58, 65, 2.00, 3),
(58, 122, 400.00, 3),
(59, 22, 1.00, 4),
(59, 123, 300.00, 3),
(59, 124, 200.00, 3),
(59, 125, 250.00, 3),
(59, 126, 15.00, 2),
(60, 17, 6.00, 1),
(60, 18, 120.00, 3),
(60, 20, 120.00, 3),
(60, 24, 200.00, 3),
(60, 50, 150.00, 3),
(60, 127, 5.00, 2),
(61, 17, 6.00, 1),
(61, 18, 120.00, 3),
(61, 20, 120.00, 3),
(61, 27, 250.00, 3),
(61, 49, 300.00, 2),
(62, 22, 1.00, 4),
(62, 31, 100.00, 3),
(62, 34, 100.00, 3),
(62, 35, 150.00, 3),
(62, 39, 500.00, 2),
(62, 65, 1.00, 4),
(62, 68, 20.00, 2),
(62, 107, 600.00, 3),
(62, 128, 100.00, 2),
(62, 129, 200.00, 3),
(63, 22, 1.00, 4),
(63, 39, 1500.00, 2),
(63, 41, 5.00, 3),
(63, 64, 100.00, 3),
(63, 65, 1.00, 4),
(63, 130, 500.00, 3),
(63, 131, 1200.00, 3),
(63, 132, 600.00, 3),
(64, 22, 1.00, 4),
(64, 65, 1.00, 4),
(64, 133, 700.00, 3),
(64, 134, 600.00, 3),
(65, 17, 2.00, 1),
(65, 18, 50.00, 3),
(65, 22, 1.00, 4),
(65, 63, 400.00, 3),
(65, 65, 1.00, 4),
(65, 67, 80.00, 3),
(65, 68, 300.00, 2),
(65, 71, 40.00, 3),
(65, 72, 60.00, 3),
(66, 17, 3.00, 1),
(66, 20, 90.00, 3),
(66, 22, 1.00, 3),
(66, 49, 250.00, 2),
(66, 116, 300.00, 3),
(67, 17, 5.00, 1),
(67, 18, 300.00, 3),
(67, 22, 1.00, 3),
(67, 24, 400.00, 3),
(67, 50, 340.00, 3),
(67, 97, 8.00, 3),
(67, 121, 275.00, 2),
(67, 135, 20.00, 3),
(68, 17, 1.00, 1),
(68, 18, 275.00, 3),
(68, 22, 1.00, 4),
(68, 61, 180.00, 3),
(68, 65, 1.00, 4),
(68, 68, 15.00, 2),
(68, 129, 200.00, 3),
(68, 136, 500.00, 3),
(68, 140, 15.00, 3),
(69, 22, 3.00, 3),
(69, 63, 300.00, 3),
(69, 65, 1.00, 3),
(69, 126, 15.00, 2),
(70, 19, 100.00, 2),
(70, 22, 1.00, 4),
(70, 24, 30.00, 3),
(70, 31, 100.00, 3),
(70, 34, 80.00, 3),
(70, 35, 150.00, 3),
(70, 39, 200.00, 2),
(70, 58, 500.00, 3),
(70, 65, 1.00, 4),
(70, 68, 30.00, 2),
(70, 128, 200.00, 2),
(70, 137, 600.00, 3),
(71, 17, 1.00, 1),
(71, 18, 150.00, 3),
(71, 22, 5.00, 3),
(71, 58, 500.00, 3),
(72, 17, 90.00, 3),
(72, 19, 15.00, 2),
(72, 20, 50.00, 3),
(72, 24, 100.00, 3),
(72, 50, 200.00, 3),
(72, 127, 2.00, 2),
(72, 138, 100.00, 3),
(73, 17, 6.00, 1),
(73, 20, 80.00, 3),
(73, 24, 180.00, 3),
(73, 39, 130.00, 2),
(73, 49, 100.00, 2),
(73, 50, 150.00, 3),
(73, 68, 30.00, 2),
(73, 116, 200.00, 3),
(73, 138, 100.00, 3),
(73, 139, 5.00, 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `recept_konyhaifelszereles`
--

CREATE TABLE `recept_konyhaifelszereles` (
  `ReceptID` int(11) NOT NULL,
  `KonyhaiFelszerelesID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szerep`
--

CREATE TABLE `szerep` (
  `SzerepID` int(11) NOT NULL,
  `Szerep` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `szerep`
--

INSERT INTO `szerep` (`SzerepID`, `Szerep`) VALUES
(1, 'Adminisztrátor'),
(2, 'Felhasználó');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `alkategoria`
--
ALTER TABLE `alkategoria`
  ADD PRIMARY KEY (`AlkategoriaID`),
  ADD KEY `fk_alkategoria_kategoria` (`KategoriaID`);

--
-- A tábla indexei `arkategoria`
--
ALTER TABLE `arkategoria`
  ADD PRIMARY KEY (`ArkategoriaID`);

--
-- A tábla indexei `besorolas`
--
ALTER TABLE `besorolas`
  ADD PRIMARY KEY (`BesorolasID`);

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
  ADD UNIQUE KEY `Emailcim` (`Emailcim`),
  ADD UNIQUE KEY `Felhasznalonev` (`Felhasznalonev`),
  ADD KEY `OrszagID` (`OrszagID`),
  ADD KEY `SzerepID` (`SzerepID`);

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
-- A tábla indexei `konyhaifelszereles`
--
ALTER TABLE `konyhaifelszereles`
  ADD PRIMARY KEY (`KonyhaiFelszerelesID`),
  ADD KEY `BesorolasID` (`BesorolasID`);

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
  ADD KEY `AlkategoriaID` (`AlkategoriaID`),
  ADD KEY `fk_recept_arkategoria` (`ArkategoriaID`);

--
-- A tábla indexei `recept_hozzavalo`
--
ALTER TABLE `recept_hozzavalo`
  ADD PRIMARY KEY (`ReceptID`,`HozzavaloID`),
  ADD KEY `HozzavaloID` (`HozzavaloID`),
  ADD KEY `MertekegysegID` (`MertekegysegID`);

--
-- A tábla indexei `recept_konyhaifelszereles`
--
ALTER TABLE `recept_konyhaifelszereles`
  ADD PRIMARY KEY (`ReceptID`,`KonyhaiFelszerelesID`),
  ADD KEY `KonyhaiFelszerelesID` (`KonyhaiFelszerelesID`);

--
-- A tábla indexei `szerep`
--
ALTER TABLE `szerep`
  ADD PRIMARY KEY (`SzerepID`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `alkategoria`
--
ALTER TABLE `alkategoria`
  MODIFY `AlkategoriaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `arkategoria`
--
ALTER TABLE `arkategoria`
  MODIFY `ArkategoriaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `besorolas`
--
ALTER TABLE `besorolas`
  MODIFY `BesorolasID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT a táblához `elkeszitesimod`
--
ALTER TABLE `elkeszitesimod`
  MODIFY `ElkeszitesiModID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `felhasznalo`
--
ALTER TABLE `felhasznalo`
  MODIFY `FelhasznaloID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT a táblához `hozzavalo`
--
ALTER TABLE `hozzavalo`
  MODIFY `HozzavaloID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT a táblához `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `KategoriaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `konyhaifelszereles`
--
ALTER TABLE `konyhaifelszereles`
  MODIFY `KonyhaiFelszerelesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT a táblához `mertekegyseg`
--
ALTER TABLE `mertekegyseg`
  MODIFY `MertekegysegID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `nehezsegiszint`
--
ALTER TABLE `nehezsegiszint`
  MODIFY `NehezsegiSzintID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `orszag`
--
ALTER TABLE `orszag`
  MODIFY `OrszagID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT a táblához `recept`
--
ALTER TABLE `recept`
  MODIFY `ReceptID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT a táblához `szerep`
--
ALTER TABLE `szerep`
  MODIFY `SzerepID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `alkategoria`
--
ALTER TABLE `alkategoria`
  ADD CONSTRAINT `alkategoria_ibfk_1` FOREIGN KEY (`KategoriaID`) REFERENCES `kategoria` (`KategoriaID`),
  ADD CONSTRAINT `fk_alkategoria_kategoria` FOREIGN KEY (`KategoriaID`) REFERENCES `kategoria` (`KategoriaID`);

--
-- Megkötések a táblához `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD CONSTRAINT `felhasznalo_ibfk_1` FOREIGN KEY (`OrszagID`) REFERENCES `orszag` (`OrszagID`),
  ADD CONSTRAINT `felhasznalo_ibfk_2` FOREIGN KEY (`SzerepID`) REFERENCES `szerep` (`SzerepID`);

--
-- Megkötések a táblához `felhasznalo_hozzavalo`
--
ALTER TABLE `felhasznalo_hozzavalo`
  ADD CONSTRAINT `felhasznalo_hozzavalo_ibfk_1` FOREIGN KEY (`FelhasznaloID`) REFERENCES `felhasznalo` (`FelhasznaloID`) ON DELETE CASCADE,
  ADD CONSTRAINT `felhasznalo_hozzavalo_ibfk_2` FOREIGN KEY (`HozzavaloID`) REFERENCES `hozzavalo` (`HozzavaloID`) ON DELETE CASCADE;

--
-- Megkötések a táblához `felhasznalo_recept`
--
ALTER TABLE `felhasznalo_recept`
  ADD CONSTRAINT `felhasznalo_recept_ibfk_1` FOREIGN KEY (`FelhasznaloID`) REFERENCES `felhasznalo` (`FelhasznaloID`) ON DELETE CASCADE,
  ADD CONSTRAINT `felhasznalo_recept_ibfk_2` FOREIGN KEY (`ReceptID`) REFERENCES `recept` (`ReceptID`) ON DELETE CASCADE;

--
-- Megkötések a táblához `konyhaifelszereles`
--
ALTER TABLE `konyhaifelszereles`
  ADD CONSTRAINT `konyhaifelszereles_ibfk_1` FOREIGN KEY (`BesorolasID`) REFERENCES `besorolas` (`BesorolasID`);

--
-- Megkötések a táblához `recept`
--
ALTER TABLE `recept`
  ADD CONSTRAINT `fk_recept_arkategoria` FOREIGN KEY (`ArkategoriaID`) REFERENCES `arkategoria` (`ArkategoriaID`),
  ADD CONSTRAINT `recept_ibfk_1` FOREIGN KEY (`NehezsegiSzintID`) REFERENCES `nehezsegiszint` (`NehezsegiSzintID`),
  ADD CONSTRAINT `recept_ibfk_2` FOREIGN KEY (`ElkeszitesiModID`) REFERENCES `elkeszitesimod` (`ElkeszitesiModID`),
  ADD CONSTRAINT `recept_ibfk_3` FOREIGN KEY (`AlkategoriaID`) REFERENCES `alkategoria` (`AlkategoriaID`);

--
-- Megkötések a táblához `recept_hozzavalo`
--
ALTER TABLE `recept_hozzavalo`
  ADD CONSTRAINT `recept_hozzavalo_ibfk_1` FOREIGN KEY (`ReceptID`) REFERENCES `recept` (`ReceptID`) ON DELETE CASCADE,
  ADD CONSTRAINT `recept_hozzavalo_ibfk_2` FOREIGN KEY (`HozzavaloID`) REFERENCES `hozzavalo` (`HozzavaloID`) ON DELETE CASCADE,
  ADD CONSTRAINT `recept_hozzavalo_ibfk_3` FOREIGN KEY (`MertekegysegID`) REFERENCES `mertekegyseg` (`MertekegysegID`);

--
-- Megkötések a táblához `recept_konyhaifelszereles`
--
ALTER TABLE `recept_konyhaifelszereles`
  ADD CONSTRAINT `recept_konyhaifelszereles_ibfk_1` FOREIGN KEY (`ReceptID`) REFERENCES `recept` (`ReceptID`) ON DELETE CASCADE,
  ADD CONSTRAINT `recept_konyhaifelszereles_ibfk_2` FOREIGN KEY (`KonyhaiFelszerelesID`) REFERENCES `konyhaifelszereles` (`KonyhaiFelszerelesID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
