-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2026. Ápr 12. 19:50
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
-- Adatbázis: `cookquest`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `alkategoria`
--

CREATE TABLE `alkategoria` (
  `AlkategoriaID` int(11) NOT NULL,
  `KategoriaID` int(11) NOT NULL,
  `Alkategoria` varchar(255) NOT NULL,
  `Torolve` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `alkategoria`
--

INSERT INTO `alkategoria` (`AlkategoriaID`, `KategoriaID`, `Alkategoria`, `Torolve`) VALUES
(1, 1, 'sültek', 0),
(2, 1, 'pörkölt', 0),
(3, 1, 'raguk', 0),
(4, 1, 'főzelék', 0),
(5, 2, 'krém leves', 0),
(6, 2, 'húsos leves', 0),
(7, 3, 'sütemény', 0),
(8, 3, 'pohárkrém', 0),
(9, 4, 'tojásos reggeli', 0),
(10, 5, 'zöldség köret', 0),
(11, 2, 'zöldség leves', 0),
(12, 2, 'tojás leves', 0);

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
  `Elnevezes` varchar(255) NOT NULL,
  `Torolve` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `besorolas`
--

INSERT INTO `besorolas` (`BesorolasID`, `Elnevezes`, `Torolve`) VALUES
(1, 'Evőeszköz', 0),
(2, 'Szedőkanál', 0),
(3, 'Szűrő', 0),
(4, 'Keverőeszköz', 0),
(5, 'Adagoló', 0),
(6, 'Tálalóeszköz', 0),
(7, 'Merítőeszköz', 0),
(8, 'Vágóeszköz', 0),
(9, 'Desszert evőeszköz', 0),
(10, 'Speciális evőeszköz', 0),
(11, 'Kellék', 0),
(12, 'Konyhai kisgép', 0),
(13, 'Konyhai nagygép', 0),
(14, 'Edény', 0);

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
  `SzerepID` int(11) DEFAULT NULL,
  `Torolve` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `felhasznalo`
--

INSERT INTO `felhasznalo` (`FelhasznaloID`, `Vezeteknev`, `Keresztnev`, `Felhasznalonev`, `Emailcim`, `Jelszo`, `SzuletesiEv`, `Profilkep`, `OrszagID`, `RegisztracioEve`, `MegszerzettPontok`, `SzerepID`, `Torolve`) VALUES
(1, 'asd', 'asd', 'TejbeTök', 'asd@gmail.com', '$2y$10$rUJz1e8yZomrGIhFktthse9hhGcrQo.jNdVDlEjAYxPy/uspJfeYa', '1999', '', 20, '2026', 1400, 1, 0),
(2, 'dsa', 'asd', 'dsaasd', 'dsa@gmail.com', '$2y$10$xl4bnDRU8s3clbYd1MihY.edbheglWECLIk0lwC61dUD8P3RQ3HB2', '2000', '', 15, '2026', 0, 2, 0),
(3, 'alma', 'fa', 'almafa', 'almafa@gmail.com', '$2y$10$x7f.uVLgnh0Ab2KfhGk/g.4YZMlKb/2PBcjcg3U9.GFGWG7VbedUq', '2000', '', 15, '2026', 65, 2, 0),
(4, 'zwvd', 'dubw', 'vdzuavwd', 'asdawd@gmail.com', '$2y$10$mYXBogvBPi68GQLFidlnx.amyariOS1Qff8AYzSL8SCXvTGpv0CK.', '2000', '', 1, '2026', 15, 2, 0),
(5, 'töltött', 'káposzta', 'kapi', 'kapi@gmail.com', '$2y$10$tvVApkfAQKIYOjrJLTh/pO6blVdvtSqtpJdX5M46jliK/DZ9/w3hK', '2000', '', 17, '2026', 25, 2, 0),
(6, 'Keresztúri', 'Hanna', 'Kerhanna', 'kerhanna05@gmail.com', '$2y$10$9duKM/SEYlqcOLdJ0crxDe3gQ5tJsmwpSxCVaSfCS1ZA15qMtks0S', '2005', '', 1, '2026', 35, 1, 0),
(7, 'Busai', 'Danika', 'Danimani', 'dani@gmail.com', '$2y$10$JwniWfFRt9V3Ke1W36Vzne6.6IY4HB26puLBgD5RBN/x1SI77ll46', '2004', '', 18, '2026', 290, 2, 0),
(8, 'Hús', 'Villa', 'Villacska', 'villacska@gmail.com', '$2y$10$qUkki6wQWPQPYJ4wJE6JR.uIj/143kL6tIWRJRMlOsZrDlbWx3R.W', '2005', '', 9, '2026', 105, 2, 0),
(9, 'Bódis', 'Boglárka', 'bogibodis6@gmail.com', 'bogibodis6@gmail.com', '$2y$10$t4N4YlVnPjA2QV/ymhgiQ.MTt/cK94i5ZTNo5A00AW/Jnks4hWJVW', '2005', 'assets/kepek/profilKepek/user_13_1772522527.png', 1, '2026', 15, 2, 0),
(10, 'dfg', 'dfg', 'dfg', 'dfg@gmail.com', '$2y$10$TpMPfAdrbDGmfCtAdXsU/uAI0dzAB1aeCceD.rIngrpAOAeLk.sFu', '2004', '', 17, '2026', 80, 2, 0),
(11, 'qwert', 'qwert', 'qwert2005', 'qwert@gmail.com', '$2y$10$Gf3xGNOP0iBUjx7e69e/suKWLwU37kU.OxyEZpnVJf9Ba4oEoFSBu', '1967', '', 21, '2026', 0, 2, 0),
(12, 'Bíró', 'Benjámin', 'Jogász', 'benjamin.biro.bgy@gmail.com', '$2y$10$pYp8IOrWgGXVsaKNMe.h5uVSbaGkLKEU6/HGz/fYz8HgQwVC0Xq1e', '2005', 'assets/kepek/profilKepek/user_19_1773040494.jpg', 1, '2026', 400, 2, 0),
(13, 'Visegrádi', 'Tamás', 'Tomika2005', 'tomi@gmail.com', '$2y$10$dfnsEAlaIg2UoVe1C2u89.k3JWS7DxZqhJoZ5qxXmmnetZ8PB8HaG', '2005', '', 13, '2026', 15, 2, 0),
(14, 'Hornyák', 'Ákos', 'HornyákÁkos', 'hornyakakos@gmail.com', '$2y$10$gr3.9Sr2T4Vfe6V6rHIy8eeyZEtHqdLSR/FWoYjkevmwBjhGF7YXi', '2020', '', 18, '2026', 0, 2, 0),
(15, 'boss', 'boss', 'boss', 'padarzsolti@gmail.com', '$2y$10$MpMHoiLw6JkgZA4.vtHtD.z8ioRL.pDmQYpTd/kf7orZU/jEssq8q', '0000', 'assets/kepek/profilKepek/user_22_1773903759.png', 1, '2026', 80, 2, 0),
(16, 'wdwf', 'fawfaw', 'fgf', 'fg@gmail.com', '$2y$10$lFOtqPPeiRBRuSgMsth94eapR5j3vV1UbBlxpSIBtmSuCuMfirDvq', '0000', '', 15, '2026', 0, 2, 0),
(17, 'cer', 'uza', 'ceruta', 'ceruza@gmail.com', '$2y$10$zQtjqCXfjwgI6T27rTWYje6giZYpno99Mw0d/Hzi.HJ1f2X3W1sXK', '2003', '', 20, '2026', 95, 2, 0);

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

--
-- A tábla adatainak kiíratása `felhasznalo_recept`
--

INSERT INTO `felhasznalo_recept` (`FelhasznaloID`, `ReceptID`, `Elkeszitette`, `KedvencReceptek`) VALUES
(1, 1, 1, 0),
(1, 2, 1, 0),
(1, 3, 1, 0),
(1, 4, 1, 0),
(1, 5, 1, 0),
(1, 6, 1, 0),
(1, 7, 1, 0),
(1, 8, 1, 0),
(1, 9, 1, 0),
(1, 10, 1, 0),
(1, 11, 1, 0),
(1, 12, 1, 0),
(1, 13, 1, 0),
(1, 14, 1, 0),
(1, 15, 1, 0),
(1, 16, 1, 0),
(1, 17, 1, 0),
(1, 18, 1, 0),
(1, 19, 1, 0),
(1, 20, 1, 0),
(1, 21, 1, 0),
(1, 22, 1, 0),
(1, 23, 1, 0),
(1, 24, 1, 0),
(1, 25, 1, 0),
(1, 26, 1, 0),
(1, 27, 1, 0),
(1, 28, 1, 0),
(1, 29, 1, 0),
(1, 30, 1, 0),
(1, 32, 1, 0),
(1, 33, 1, 0),
(1, 34, 1, 0),
(1, 35, 1, 0),
(1, 36, 1, 0),
(1, 37, 1, 0),
(1, 38, 1, 0),
(1, 39, 1, 0),
(1, 40, 1, 0),
(1, 41, 1, 0),
(1, 42, 1, 0),
(1, 43, 1, 0),
(1, 44, 1, 0),
(1, 45, 1, 0),
(1, 46, 1, 0),
(1, 47, 1, 0),
(1, 48, 1, 0),
(1, 49, 1, 0),
(1, 50, 1, 0),
(1, 51, 1, 0),
(1, 52, 1, 0),
(1, 53, 1, 0),
(1, 54, 1, 0),
(1, 55, 1, 0),
(1, 56, 1, 0),
(1, 57, 1, 0),
(1, 58, 1, 0),
(1, 59, 1, 0),
(1, 60, 1, 0),
(1, 61, 1, 0),
(3, 2, 1, 0),
(3, 3, 1, 0),
(3, 57, 1, 0),
(4, 3, 1, 0),
(5, 3, 1, 0),
(5, 5, 1, 0),
(6, 3, 1, 0),
(6, 5, 1, 0),
(6, 12, 1, 0),
(7, 1, 1, 0),
(7, 2, 1, 0),
(7, 3, 1, 0),
(7, 4, 1, 0),
(7, 5, 1, 0),
(7, 6, 1, 0),
(7, 7, 1, 0),
(7, 8, 1, 0),
(7, 9, 1, 0),
(7, 10, 1, 0),
(7, 11, 1, 0),
(7, 12, 1, 0),
(7, 13, 1, 0),
(7, 14, 1, 0),
(7, 15, 1, 0),
(7, 16, 1, 0),
(7, 17, 1, 0),
(7, 18, 1, 0),
(7, 19, 1, 0),
(8, 1, 1, 0),
(8, 2, 1, 0),
(8, 3, 1, 0),
(8, 4, 1, 0),
(8, 5, 1, 0),
(8, 6, 1, 0),
(8, 7, 1, 0),
(8, 10, 1, 0),
(9, 3, 1, 0),
(10, 1, 1, 0),
(10, 2, 1, 0),
(10, 3, 1, 0),
(10, 4, 1, 0),
(10, 6, 1, 0),
(10, 7, 1, 0),
(12, 1, 1, 0),
(12, 2, 1, 0),
(12, 3, 1, 0),
(12, 4, 1, 0),
(12, 5, 1, 0),
(12, 6, 1, 0),
(12, 7, 1, 0),
(12, 8, 1, 0),
(12, 9, 1, 0),
(12, 10, 1, 0),
(12, 11, 1, 0),
(12, 12, 1, 0),
(12, 13, 1, 0),
(12, 14, 1, 0),
(12, 15, 1, 0),
(12, 16, 1, 0),
(12, 17, 1, 0),
(12, 18, 1, 0),
(12, 19, 1, 0),
(12, 20, 1, 0),
(12, 21, 1, 0),
(12, 22, 1, 0),
(12, 23, 1, 0),
(12, 24, 1, 0),
(12, 25, 1, 0),
(13, 3, 1, 0),
(15, 1, 1, 0),
(15, 2, 1, 0),
(15, 3, 1, 0),
(15, 4, 1, 0),
(15, 5, 1, 0),
(15, 7, 1, 0),
(17, 1, 1, 0),
(17, 2, 1, 0),
(17, 3, 1, 0),
(17, 4, 1, 0),
(17, 5, 1, 0),
(17, 7, 1, 0),
(17, 64, 1, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hozzavalo`
--

CREATE TABLE `hozzavalo` (
  `HozzavaloID` int(11) NOT NULL,
  `Elnevezes` varchar(50) NOT NULL,
  `Kep` varchar(255) DEFAULT NULL,
  `Torolve` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `hozzavalo`
--

INSERT INTO `hozzavalo` (`HozzavaloID`, `Elnevezes`, `Kep`, `Torolve`) VALUES
(1, 'tojás', NULL, 0),
(2, 'liszt', NULL, 0),
(3, 'tej', NULL, 0),
(4, 'cukor', NULL, 0),
(5, 'olaj', NULL, 0),
(6, 'só', NULL, 0),
(7, 'szóda', NULL, 0),
(8, 'vaj', NULL, 0),
(9, 'lekvár', NULL, 0),
(10, 'joghurt', NULL, 0),
(11, 'gyümölcs', NULL, 0),
(12, 'méz', NULL, 0),
(13, 'zabpehely', NULL, 0),
(14, 'kenyér', NULL, 0),
(15, 'sárgarépa', NULL, 0),
(16, 'fehérrépa', NULL, 0),
(17, 'karalábé', NULL, 0),
(18, 'zellergumó', NULL, 0),
(19, 'vöröshagyma', NULL, 0),
(20, 'petrezselyem', NULL, 0),
(21, 'babérlevél', NULL, 0),
(22, 'egész bors', NULL, 0),
(23, 'víz', NULL, 0),
(24, 'őrölt kömény', NULL, 0),
(25, 'pirospaprika', NULL, 0),
(26, 'ecet', NULL, 0),
(27, 'sertés karajcsont', NULL, 0),
(28, 'csigatészta', NULL, 0),
(29, 'paradicsomlé', NULL, 0),
(30, 'sűrített paradicsom', NULL, 0),
(31, 'betűtészta', NULL, 0),
(32, 'darált háztartási keksz', NULL, 0),
(33, 'habtejszín', NULL, 0),
(34, 'porcukor', NULL, 0),
(35, 'vaníliás cukor', NULL, 0),
(36, 'kakaópor', NULL, 0),
(37, 'mascarpone', NULL, 0),
(38, 'babapiskóta', NULL, 0),
(39, 'kávé', NULL, 0),
(40, 'rum / aroma', NULL, 0),
(41, 'brokkoli', NULL, 0),
(42, 'burgonya', NULL, 0),
(43, 'főzőtejszín', NULL, 0),
(44, 'sütőtök', NULL, 0),
(45, 'bacon', NULL, 0),
(46, 'levesgyöngy', NULL, 0),
(47, 'csirkemell', NULL, 0),
(48, 'rizs', NULL, 0),
(49, 'bors', NULL, 0),
(50, 'sertéskaraj', NULL, 0),
(51, 'zsemlemorzsa', NULL, 0),
(52, 'étolaj', NULL, 0),
(53, 'spagetti', NULL, 0),
(54, 'paradicsomszósz', NULL, 0),
(55, 'főtt sonka', NULL, 0),
(56, 'trappista sajt', NULL, 0),
(57, 'gomba', NULL, 0),
(58, 'száraztészta', NULL, 0),
(59, 'karfiol', NULL, 0),
(60, 'sütőpor', NULL, 0),
(61, 'csokicsepp', NULL, 0),
(62, 'kolbász', NULL, 0),
(63, 'tejföl', NULL, 0),
(64, 'darált hús', NULL, 0),
(65, 'fokhagyma', NULL, 0),
(66, 'vaníliás pudingpor', NULL, 0),
(67, 'alma', NULL, 0),
(68, 'őrölt fahéj', NULL, 0),
(69, 'marhahús', NULL, 0),
(70, 'sertészsír', NULL, 0),
(71, 'zöldpaprika', NULL, 0),
(72, 'paradicsom', NULL, 0),
(73, 'csirkecomb', NULL, 0),
(74, 'reszelt sajt', NULL, 0),
(75, 'sonka', NULL, 0),
(76, 'zöldség (paprika vagy hagyma)', NULL, 0),
(77, 'étcsokoládé', NULL, 0),
(78, 'egész csirke', NULL, 0),
(79, 'metélőhagyma', NULL, 0),
(80, 'Zöldborsó', NULL, 0),
(81, 'lazacfilé', NULL, 0),
(82, 'citrom', NULL, 0),
(83, 'sertésszűz', NULL, 0),
(84, 'cukkini', NULL, 0),
(85, 'kaliforniai paprika', NULL, 0),
(86, 'padlizsán', NULL, 0),
(87, 'olívaolaj', NULL, 0),
(88, 'vanília aroma', NULL, 0),
(89, 'vörösbor', NULL, 0),
(90, 'csiperkegomba', NULL, 0),
(91, 'darált sertéshús', NULL, 0),
(92, 'fejes káposzta', NULL, 0),
(93, 'savanyú káposzta', NULL, 0),
(94, 'kacsacomb', NULL, 0),
(95, 'kacsamell', NULL, 0),
(96, 'citromhéj', NULL, 0),
(97, 'bélszín', NULL, 0),
(98, 'marhapofa', NULL, 0),
(99, 'mandulaliszt', NULL, 0),
(100, 'instant kávé', NULL, 0),
(101, 'mustár', NULL, 0),
(102, 'Kelkáposzta', NULL, 0),
(103, 'banán', NULL, 0),
(104, 'Nádcukor', NULL, 0),
(105, 'leveles tészta', NULL, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategoria`
--

CREATE TABLE `kategoria` (
  `KategoriaID` int(11) NOT NULL,
  `Kategoria` varchar(255) NOT NULL,
  `Torolve` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `kategoria`
--

INSERT INTO `kategoria` (`KategoriaID`, `Kategoria`, `Torolve`) VALUES
(1, 'főétel', 0),
(2, 'leves', 0),
(3, 'desszert', 0),
(4, 'reggeli', 0),
(5, 'köret', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `konyhaifelszereles`
--

CREATE TABLE `konyhaifelszereles` (
  `KonyhaiFelszerelesID` int(11) NOT NULL,
  `Nev` varchar(100) NOT NULL,
  `Kep` varchar(255) DEFAULT NULL,
  `BesorolasID` int(11) NOT NULL,
  `Leiras` text NOT NULL,
  `Torolve` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `konyhaifelszereles`
--

INSERT INTO `konyhaifelszereles` (`KonyhaiFelszerelesID`, `Nev`, `Kep`, `BesorolasID`, `Leiras`, `Torolve`) VALUES
(1, 'Teáskanál', 'teaskanal.jpg', 1, 'A teáskanál egy kis méretű evőeszköz, amelyet leggyakrabban tea, kávé vagy más italok keverésére, illetve cukor, méz adagolására használunk. Emellett alkalmas kisebb mennyiségű ételek fogyasztására és a konyhában mértékegységként is funkcionál (1 teáskanál ≈ 5 ml). Általában rozsdamentes acélból készül, de létezik műanyagból vagy porcelánból készült változata is. Kompakt mérete miatt kényelmes, praktikus, minden háztartás alapdarabja.', 0),
(2, 'Evőkanál', 'evokanal.jpg', 1, 'Az evőkanál egy nagyobb méretű evőeszköz, amelyet levesek, főzelékek és egyéb ételek fogyasztására használunk. A konyhában mérésre és adagolásra is alkalmas (1 evőkanál ≈ 15 ml). Leggyakrabban rozsdamentes acélból készül, de létezik műanyagból, fából vagy szilikonból készült változata is. Formája kényelmes fogást biztosít, ezért a mindennapi étkezések alapdarabja.', 0),
(3, 'Pizzaszósz kanál', 'pizzaszosz_kanal.jpg', 2, 'A pizzaszósz kanál egy kifejezetten pizza készítéshez használt konyhai eszköz, amely a paradicsomszósz egyenletes eloszlását szolgálja a pizzatészta felületén. Feje általában lapos, enyhén mélyített vagy kör alakú, így segít a szószt középről kifelé spirálisan elkenni. Leggyakrabban rozsdamentes acélból vagy műanyagból készül, nyelének kialakítása stabil fogást biztosít.', 0),
(4, 'Spagettikanál', 'spagettikanal.jpg', 2, 'A spagetti kanál főtt spagetti és egyéb hosszú tészták szedésére, adagolására szolgál. Jellegzetes fogazott, karmokra emlékeztető pereme segít a tészta megfogásában, miközben a felesleges folyadék lecsöpög. Közepén gyakran található egy lyuk, amely adagolásra is szolgál. Megkönnyíti a tálalást anélkül, hogy a tészta összetörne.', 0),
(5, 'Hableszedő kanál', 'hableszedo_kanal.jpg', 3, 'A hableszedő kanál főzés közben a levesek, húslevek vagy főzelékek tetején képződő hab eltávolítására szolgál. Általában lyukacsos vagy rácsos fejű, így a folyadék visszafolyik, a hab viszont fennmarad rajta. Hosszú nyelének köszönhetően biztonságosan használható forró ételeknél is.', 0),
(6, 'Fakanál', 'fakanal.jpg', 4, 'A fakanál hagyományos konyhai eszköz, amelyet keverésre, forgatásra és adagolásra használnak főzés közben. Leggyakrabban fából készül, ezért nem karcolja az edényeket és nem vezeti a hőt. Különösen alkalmas levesek, főzelékek, szószok és pörköltek keverésére.', 0),
(7, 'Szilikonos spatula', 'szilikonos_spatula.jpg', 4, 'A szilikon spatula korszerű konyhai eszköz, amelyet keverésre, kaparásra és kenésre használnak. Rugalmas feje lehetővé teszi, hogy az edény faláról maradék nélkül összegyűjtse az ételt vagy tésztát. Hőálló, nem karcolja az edényeket.', 0),
(8, 'Koktélkanál', 'koktelkanal.jpg', 1, 'A koktélkanál egy hosszú nyelű keverőkanál, amelyet koktélok és italok összekeverésére használnak, főként magas poharakban. Hosszú, vékony nyele lehetővé teszi, hogy az ital aljáig leérjen, csavart kialakítása segíti az egyenletes keverést.', 0),
(9, 'Fagylaltos kanál', 'fagylaltos_kanal.jpg', 5, 'A fagylaltos kanál speciálisan kialakított eszköz fagylalt adagolására és szervírozására. Feje félgömb alakú, így könnyen formáz szép, kerek adagokat. Gyakran hővezető fémből készül, amely megkönnyíti a kemény fagylalt kiszedését.', 0),
(10, 'Tálalókanál', 'talalokanal.jpg', 6, 'A tálalókanál nagy, erős kanál, amelyet főételek, köretek vagy saláták adagolására használnak. Segítségével a tálalás gyors, egyszerű és esztétikus.', 0),
(11, 'Kézi habverő', 'kezi_habvero.jpg', 4, 'A kézi habverő tojásfehérje, tejszín vagy különböző keverékek felverésére, habosítására szolgál. Fém drótfeje segít a levegő bekeverésében, így a keverék könnyű és egyenletes lesz.', 0),
(12, 'Merőkanál', 'merokanal.jpg', 7, 'A merőkanál nagy, mély kanál, amelyet levesek, főzelékek, szószok és egyéb folyékony ételek adagolására használnak. Hosszú nyele miatt biztonságosan elérhető vele a mély edények alja.', 0),
(13, 'Kenőkés', 'kenokes.jpg', 1, 'A kenőkés egy kis, lapos és széles pengéjű konyhai eszköz, amelyet vaj, margarin, krémek, dzsemek vagy egyéb kenhető anyagok szendvicsre vagy kenyérre való felvitelére használnak. Általában rozsdamentes acélból készül, de léteznek műanyag vagy szilikon változatai is. Kialakítása biztonságos, nem vág.', 0),
(14, 'Séfkés', 'sefkes.jpg', 8, 'A séfkés egy nagy, sokoldalú konyhai kés, amelyet zöldségek, húsok, halak és egyéb alapanyagok szeletelésére, aprítására használnak. Széles, enyhén ívelt pengéje lehetővé teszi a hajlított mozdulatokkal történő vágást. A konyhai munka egyik legfontosabb alapdarabja.', 0),
(15, 'Hámozó', 'hamozo.jpg', 8, 'A hámozó egy kisebb, kézi konyhai eszköz, amelyet zöldségek és gyümölcsök héjának eltávolítására használnak. Éles pengéje precíz munkát tesz lehetővé, miközben kevés hulladék keletkezik. Gyors, biztonságos és praktikus.', 0),
(16, 'Kenyérvágó kés', 'kenyervago_kes.jpg', 8, 'A kenyérvágó kés hosszú, fogazott pengéjű kés, amely könnyedén átvágja a ropogós kenyérhéjat anélkül, hogy a belsejét összenyomná. Ideális friss és pirított kenyerek szeletelésére.', 0),
(17, 'Csontozókés', 'csontozokes.jpg', 8, 'A csontozókés vékony, hegyes és rugalmas pengéjű kés, amely húsok csontjáról való leválasztására szolgál. Kialakítása lehetővé teszi a precíz vágást, minimális húsvesteséggel.', 0),
(18, 'Filézőkés', 'filezokes.jpg', 8, 'A filézőkés hosszú és hajlékony pengéjű kés, amelyet halak és húsok filézésére használnak. Segítségével a csontok és a bőr pontosan elválaszthatók a hústól.', 0),
(19, 'Desszertkés', 'desszertkes.jpg', 9, 'A desszertkés kisebb méretű kés, amelyet sütemények, torták és egyéb desszertek fogyasztására vagy szeletelésére használnak. Könnyű kezelhetősége elegáns étkezést biztosít.', 0),
(20, 'Sajtkés', 'sajtkes.jpg', 10, 'A sajtkés speciálisan kialakított kés különféle sajtok vágására és tálalására. Pengéje gyakran lyukacsos vagy recézett, hogy a sajt ne ragadjon rá.', 0),
(21, 'Henteskés', 'henteskes.jpg', 8, 'A henteskés egy nagy, masszív kés, amelyet nyers húsok feldolgozására, darabolására és szeletelésére használnak. Erős pengéje a vastag húsrészekkel is megbirkózik.', 0),
(22, 'Pizzavágó', 'pizzavago.jpg', 8, 'A pizzavágó kör alakú pengével rendelkező konyhai eszköz, amelyet pizza és más lapos ételek szeletelésére használnak. Gyors, pontos vágást tesz lehetővé.', 0),
(23, 'Evővilla', 'evovilla.jpg', 1, 'Az evővilla egy hagyományos evőeszköz, amelyet főként húsok, zöldségek, tészták és egyéb ételek fogyasztására használnak. Hosszú nyele kényelmes fogást biztosít, míg a három vagy négy villaág segít az étel biztonságos megragadásában. Leggyakrabban rozsdamentes acélból készül, és a mindennapi étkezések alapvető eszköze.', 0),
(24, 'Desszert villa', 'desszert_villa.jpg', 9, 'A desszertvilla kisebb méretű evőeszköz, amelyet sütemények, torták és egyéb desszertek fogyasztására használnak. Rövidebb és vékonyabb fogai lehetővé teszik a finom falatok precíz és elegáns elfogyasztását. Ünnepi és mindennapi alkalmakon egyaránt használatos.', 0),
(25, 'Húsvilla', 'husvilla.jpg', 6, 'A húsvilla hosszú, erős villa, amelyet sültek, nagyobb húsdarabok forgatására, megtartására és szeletelésére használnak. Két vagy több hosszú villaága stabil tartást biztosít, miközben a hús biztonságosan kezelhető főzés és tálalás során.', 0),
(26, 'Vágódeszka', 'vagodeszka.jpg', 11, 'A vágódeszka egy lapos, stabil felület, amelyet zöldségek, húsok, gyümölcsök és egyéb élelmiszerek szeletelésére használnak. Megóvja a kések élét és biztonságos munkafelületet biztosít.', 0),
(27, 'Sütőkesztyű', 'sutokesztyu.jpg', 11, 'A sütőkesztyű vastag, hőálló kesztyű, amely megvédi a kezet a forró edények és tepsik okozta sérülésektől.', 0),
(28, 'Konyharuha', 'konyharuha.jpg', 11, 'A konyharuha nedvszívó textil, amelyet edények törlésére, szárítására és a munkafelület tisztán tartására használnak.', 0),
(29, 'Kötény', 'koteny.jpg', 11, 'A kötény védőruházati kiegészítő, amely főzés közben megóvja a ruhát a szennyeződésektől és fröccsenésektől.', 0),
(30, 'Tálalógyűrű', 'talalogyuru.jpg', 11, 'A tálalógyűrű kör alakú forma, amely segít az ételek esztétikus, formázott tálalásában.', 0),
(31, 'Késélező', 'keselezo.jpg', 11, 'A késélező a kések élének karbantartására szolgál, biztosítva a könnyű és biztonságos vágást.', 0),
(32, 'Konyhai mérleg', 'konyhai_merleg.jpg', 11, 'A konyhai mérleg az alapanyagok pontos mérésére szolgál főzés és sütés során.', 0),
(33, 'Szita', 'szita.jpg', 11, 'A szita liszt, porcukor és egyéb alapanyagok szitálására vagy folyadékok szűrésére használható.', 0),
(34, 'Reszelő', 'reszelo.jpg', 11, 'A reszelő sajtok, zöldségek és gyümölcsök aprítására szolgáló konyhai eszköz.', 0),
(35, 'Habzsák', 'habzsak.jpg', 11, 'A habzsák krémek, habok és díszítő anyagok pontos adagolására és formázására használható.', 0),
(36, 'Nokedliszaggató', 'nokedliszaggato.jpg', 11, 'A nokedliszaggató a tészta gyors és egyenletes szaggatására szolgál.', 0),
(37, 'Maghőmérő', 'maghomero.jpg', 11, 'A maghőmérő az ételek belső hőmérsékletének mérésére szolgál, biztosítva a megfelelő átsülést.', 0),
(38, 'Muffin sütőforma', 'muffin_sutoforma.jpg', 11, 'A muffin sütőforma segít a muffinok és kis sütemények egyenletes sütésében.', 0),
(39, 'Muffin papír', 'muffin_papir.jpg', 11, 'A muffin papír megakadályozza a tészta letapadását, és esztétikus tálalást biztosít.', 0),
(40, 'Sütőpapír', 'sutopapir.jpg', 11, 'A sütőpapír megakadályozza az ételek letapadását és megkönnyíti a tisztítást.', 0),
(41, 'Piteforma', 'piteforma.jpg', 11, 'A piteforma piték és sütemények sütésére szolgáló kör alakú forma.', 0),
(42, 'Tésztaszűrő', 'tesztaszuro.jpg', 11, 'A tésztaszűrő főtt tészták és egyéb ételek leszűrésére szolgál.', 0),
(43, 'Nyújtólap', 'nyujtolap.jpg', 11, 'A nyújtólap sima felületet biztosít a tészta kinyújtásához.', 0),
(44, 'Nyújtófa', 'nyujtofa.jpg', 11, 'A nyújtófa henger alakú eszköz tészta egyenletes kinyújtásához.', 0),
(45, 'Sütőrács', 'sutoracs.jpg', 11, 'A sütőrács biztosítja az ételek egyenletes szellőzését sütés és hűtés során.', 0),
(46, 'Ecset', 'ecset.jpg', 11, 'A konyhai ecset vaj, tojás vagy olaj felvitelére szolgál.', 0),
(47, 'Húsfogó csipesz', 'husfogo_csipesz.jpg', 11, 'A húsfogó csipesz segít az ételek biztonságos forgatásában és emelésében.', 0),
(48, 'Tortaforma', 'tortaforma.jpg', 11, 'A tortaforma torták és sütemények sütésére szolgál.', 0),
(49, 'Vákuumtasak', 'vakuumtasak.jpg', 11, 'A vákuumtasak ételek frissen tartására és sous-vide főzéshez használható.', 0),
(50, 'Tálca', 'talca.jpg', 11, 'A tálca ételek és italok szállítására és tálalására szolgál.', 0),
(51, 'Párolóbetét', 'parolobetet.jpg', 11, 'A párolóbetét lehetővé teszi az ételek gőzben történő elkészítését.', 0),
(52, 'Klopfoló', 'klopfolo.jpg', 11, 'A klopfoló húsok puhítására és egyenletes vastagságúra lapítására szolgál.', 0),
(53, 'Robotgép', 'robotgep.jpg', 12, 'A robotgép egy elektromos konyhai eszköz, amelyet tészta dagasztására, krémek habosítására, zöldségek aprítására és egyéb konyhai műveletekre használnak. Különböző cserélhető fejeinek köszönhetően sokoldalúan használható, és jelentősen megkönnyíti a nagyobb mennyiségű alapanyag feldolgozását.', 0),
(54, 'Elektromos habverő', 'elektromos_habvero.jpg', 12, 'Az elektromos habverő tojások, krémek, tejszín és tészták gyors és egyenletes felverésére szolgáló konyhai kisgép. Forgó fém fejei segítségével időt és energiát takarít meg a kézi keveréshez képest.', 0),
(55, 'Botmixer', 'botmixer.jpg', 12, 'A botmixer kézben tartható elektromos eszköz, amelyet levesek, szószok, krémek és turmixok pépesítésére használnak közvetlenül az edényben. Gyors, praktikus és könnyen tisztítható.', 0),
(56, 'Turmixgép', 'turmixgep.jpg', 12, 'A turmixgép gyümölcsök, zöldségek, italok és levesek pépesítésére alkalmas elektromos eszköz. Erős motorja és éles pengéi sima, homogén állagot biztosítanak.', 0),
(57, 'Vízforraló', 'vizforralo.jpg', 12, 'A vízforraló elektromos eszköz víz gyors felforralására teák, kávék és instant ételek készítéséhez. Beépített automatikus kikapcsolással rendelkezik a biztonságos használat érdekében.', 0),
(58, 'Szendvicssütő', 'szendvicssuto.jpg', 12, 'A szendvicssütő elektromos konyhai kisgép, amely melegszendvicsek és toastok gyors elkészítésére szolgál. Tapadásmentes felülete biztosítja az egyenletes sütést.', 0),
(59, 'Airfryer', 'airfryer.jpg', 12, 'Az airfryer forró levegő keringetésével működő konyhai kisgép, amely minimális olaj felhasználásával teszi lehetővé az ételek ropogósra sütését.', 0),
(60, 'Szeletelőgép', 'szeletelogep.jpg', 12, 'A szeletelőgép húsok, sajtok és zöldségek egyenletes, vékony szeletekre vágására szolgáló konyhai eszköz, amely precíz és esztétikus eredményt biztosít.', 0),
(61, 'Mikrohullámú sütő', 'mikrohullamu_suto.jpg', 13, 'A mikrohullámú sütő elektromos konyhai nagygép, amelyet ételek gyors melegítésére, főzésére vagy kiolvasztására használnak. Mikrohullámok segítségével működik, így az étel rövid idő alatt egyenletesen felmelegszik. A modern konyhák alapvető eszköze.', 0),
(62, 'Gáztűzhely', 'gaztuzhely.jpg', 13, 'A gáztűzhely nyílt lánggal működő főzőberendezés, amely pontos és azonnali hőszabályozást tesz lehetővé. Főzéshez, sütéshez és pároláshoz egyaránt használható.', 0),
(63, 'Indukciós főzőlap', 'indukcios_fozolap.jpg', 13, 'Az indukciós főzőlap elektromos főzőeszköz, amely közvetlenül az edény alját melegíti. Gyors, energiatakarékos és biztonságos megoldást kínál a modern konyhákban.', 0),
(64, 'Sous-vide gép', 'sous_vide_gep.jpg', 13, 'A sous-vide gép vákuumtasakban történő, alacsony hőmérsékletű főzéshez használt eszköz. Pontos hőmérséklet-szabályozása lehetővé teszi a profi minőségű ételek elkészítését.', 0),
(65, 'Fazék', 'fazek.jpg', 14, 'A fazék mély, hőálló edény, amelyet levesek, főzelékek és tészták főzésére használnak. Fedővel együtt biztosítja az egyenletes hőeloszlást.', 0),
(66, 'Lábas', 'labas.jpg', 14, 'A lábas közepes méretű edény, amelyet szószok, krémek és kisebb adagok főzésére használnak. Fedővel együtt segít a hő megtartásában.', 0),
(67, 'Nyeles lábas', 'nyeles_labas.jpg', 14, 'A nyeles lábas hosszú nyéllel ellátott edény, amely megkönnyíti a főzést és az öntést. Különösen alkalmas szószok és levesek készítésére.', 0),
(68, 'Bogrács', 'bogracs.jpg', 14, 'A bogrács vastag falú fém edény, amelyet szabadtéri főzéshez, például gulyás és pörkölt készítéséhez használnak. A hagyományos magyar konyha fontos eszköze.', 0),
(69, 'Fedő', 'fedo.jpg', 14, 'A fedő az edények tetejére helyezhető eszköz, amely segít a hő és a gőz megtartásában, gyorsítva a főzési folyamatot.', 0),
(70, 'Serpenyő', 'serpenyo.jpg', 14, 'A serpenyő lapos edény, amelyet húsok, zöldségek és tojásételek gyors sütésére és pirítására használnak.', 0),
(71, 'Keverőtál', 'keverotal.jpg', 14, 'A keverőtál mély edény, amelyet tészták, krémek és saláták összekeverésére használnak. Praktikus és sokoldalú konyhai eszköz.', 0),
(72, 'Tepsi', 'tepsi.jpg', 14, 'A tepsi lapos sütőedény, amelyet sütemények, pizzák és egyéb ételek sütésére használnak a sütőben.', 0),
(73, 'Hőálló tál', 'hoallo_tal.jpg', 14, 'A hőálló tál magas hőmérsékletnek ellenálló edény, amely sütőben és mikrohullámú sütőben is használható.', 0),
(74, 'Jénai', 'jenai.jpg', 14, 'A jénai hőálló üvegedény, amely lehetővé teszi az ételek elkészítésének vizuális ellenőrzését sütés közben.', 0),
(75, 'Öntöttvas edény', 'ontottvas_edeny.jpg', 14, 'Az öntöttvas edény kiváló hőtartó képességgel rendelkező edény, amely ideális lassú főzéshez és sütéshez.', 0),
(76, 'Citromfacsaró', '', 11, 'Citromfacsaró', 1),
(77, 'Spakli', '', 11, 'Spakli', 1);

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
  `Elnevezes` varchar(255) NOT NULL,
  `Torolve` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `orszag`
--

INSERT INTO `orszag` (`OrszagID`, `Elnevezes`, `Torolve`) VALUES
(1, 'Magyarország', 0),
(2, 'Franciaország', 0),
(3, 'Olaszország', 0),
(4, 'Spanyolország', 0),
(5, 'Egyesült Királyság', 0),
(6, 'Egyesült Államok', 0),
(7, 'Kanada', 0),
(8, 'Kína', 0),
(9, 'Japán', 0),
(10, 'Dél-Korea', 0),
(11, 'India', 0),
(12, 'Ausztrália', 0),
(13, 'Oroszország', 0),
(14, 'Brazília', 0),
(15, 'Mexikó', 0),
(16, 'Hollandia', 0),
(17, 'Belgium', 0),
(18, 'Svájc', 0),
(19, 'Ausztria', 0),
(20, 'Lengyelország', 0),
(21, 'Csehország', 0),
(22, 'Szlovákia', 0),
(23, 'Románia', 0),
(24, 'Svédország', 0);

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
  `Kaloria` decimal(6,2) NOT NULL,
  `Torolve` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `recept`
--

INSERT INTO `recept` (`ReceptID`, `Nev`, `Kep`, `ElkeszitesiIdo`, `NehezsegiSzintID`, `BegyujthetoPontok`, `Adag`, `Elkeszitesi_leiras`, `ElkeszitesiModID`, `ArkategoriaID`, `AlkategoriaID`, `Kaloria`, `Torolve`) VALUES
(1, 'Tükörtojás', 'TukorTojas.webp', '22:10:00', 1, 15, 1, 'A tojásokat óvatosan üsd egy kis tálba vagy csészébe egyesével – így ha rossz lenne valamelyik, nem rontja el az egészet.\r\nMelegítsd fel az olajat vagy vajat egy kisebb serpenyőben közepes lángon. Az olaj akkor jó, ha enyhén csillog, de még nem füstöl (ha füstöl, vedd lejjebb a lángot, különben keserű lesz).\r\nHa a zsiradék forró, óvatosan csúsztasd bele a tojásokat a tálból (ne dobd bele nagy magasságból, nehogy szétfröccsenjen a zsiradék).\r\nSüsd addig, amíg a fehérje teljesen kifehéredik és megszilárdul, de a sárgája még lágy marad (kb. 3–4 perc). Ha kemény sárgáját szeretnél, fordítsd át a tojást még 10–15 másodpercre.\r\nSózd, borsozd, és azonnal tálald pirítóssal vagy friss zöldséggel.\r\nÍzesítsd sóval, borssal, és azonnal tálald.\r\n', 1, 1, 9, 180.00, 0),
(2, 'Tojásrántotta', 'Rantotta.webp', '00:05:00', 1, 15, 1, 'Verd fel a tojásokat egy tálban villával vagy habverővel, sózd meg enyhén. Ne verd túl habosra, csak keverd össze.\r\nOlvaszd meg a vajat (vagy melegítsd az olajat) egy serpenyőben közepes lángon.\r\nÖntsd bele a tojást. Folyamatosan keverd fakanállal vagy szilikon spatulával körkörös mozdulatokkal, hogy egyenletesen süljön (kb. 2–3 perc).\r\nVedd le a tűzről, amikor már majdnem kész, de még kicsit lágy, krémes az állaga – a maradék hő tovább főzi.\r\nTálald azonnal, mellé félbevágott koktélparadicsommal vagy más friss körettel.\r\n', 1, 1, 9, 210.00, 0),
(3, 'Bundás kenyér', 'bundasKenyer.webp\r\n', '00:10:00', 1, 15, 1, 'Verd fel a tojásokat egy lapos tányérban vagy tálban, sózd meg enyhén.\r\nMártsd bele a kenyérszeleteket rövid időre (2–3 másodperc oldalanként) – ne áztasd túl, különben szétesik!\r\nHevíts bő olajat egy serpenyőben közepes lángon. Ellenőrizd: ha egy kis tojásos morzsát beledobsz, azonnal pezsegnie kell.\r\nTedd bele a beáztatott kenyereket, süsd mindkét oldalon aranybarnára (oldalanként kb. 2–3 perc).\r\nPapírtörlőre szedd ki, hogy lecsepegjen a felesleges olaj.\r\n', 1, 1, 9, 350.00, 0),
(4, 'Pirítós vajjal vagy lekvárral', 'PiritosKenyer.webp\r\n', '00:05:00', 1, 15, 1, 'Tedd a kenyereket kenyérpirítóba és pirítsd meg (vagy serpenyőben 1–2 perc oldalanként közepes lángon, vaj nélkül).\r\nAmint kész, kend meg vékonyan vajjal (vagy vastagabban lekvárral).\r\nAzonnal fogyaszd, amíg ropogós.\r\n', 1, 1, 9, 200.00, 0),
(5, 'Gyümölcsös joghurtos pohárkrém', 'GyumolcsosPohardesszert.webp', '00:05:00', 1, 10, 1, 'A gyümölcsöt mosd meg, ha szükséges, vágd kisebb darabokra (fagyasztottat hagyd kicsit felengedni).\r\nEgy átlátszó pohárba rétegezd: alul egy kis joghurt, rá gyümölcs, majd ismét joghurt – így szép lesz réteges.\r\nVégül csurgasd rá a mézet.\r\nTedd hűtőbe 10–15 percre, hogy az ízek összeérjenek (de azonnal is fogyasztható).\r\n', 2, 1, 8, 220.00, 0),
(6, 'Zabpelyhes-mézes pohárdesszert', 'ZabpelyhesMezesPohardesszert.webp', '00:05:00', 1, 10, 1, 'Egy pohárba rétegezd: alul egy kevés joghurt, rá zabpehely, majd ismét joghurt – összesen 2–3 réteg.\r\nCsurgasd rá a mézet a tetejére.\r\nTedd hűtőbe 5–10 percre (vagy akár 30 percre), hogy a zab kissé megpuhuljon és az ízek összeérjenek.\r\nKeverd át evés előtt, ha krémesebb állagot szeretnél.\r\n', 2, 1, 8, 300.00, 0),
(7, 'Palacsinta', 'Palacsinta.webp', '00:05:00', 1, 10, 1, 'Egy nagy tálban verd fel a tojásokat a cukorral és a csipet sóval.\r\nAdd hozzá a lisztet, tejet, szódát és olajat. Keverd simára botmixerrel vagy kézi habverővel – a tészta legyen híg palacsinta tészta állagú (kicsit legyen hígabb mint a tejföl). Ha csomós, szűrd át.\r\nHevíts egy palacsintasütőt vagy tapadásmentes serpenyőt közepes lángon, kend  ki vékonyan olajjal (papírtörlővel).\r\nMerj bele egy merőkanál tésztát, döntsd meg a serpenyőt, hogy vékonyan elterüljön.\r\nSüsd kb. 1–1,5 percig, amíg a széle elválik és a teteje már nem folyós – akkor fordítsd meg.\r\nA másik oldalát is süsd 30–60 másodpercig.\r\nA kész palacsintákat tányérra rakd, fedd le, hogy ne száradjanak ki. \r\n\r\nSós verzióhoz, hagyjuk el a cukrot belőle, és mehet bele 2 csipet só.\r\n', 1, 1, 7, 220.00, 0),
(8, 'Zöldségleves', 'ZoldsegLeves.webp', '01:00:00', 2, 15, 4, 'A zöldségeket (sárgarépa, fehérrépa, karalábé, zeller, hagyma) tisztítsd meg és vágd egyforma méretűre (kb. 1–2 cm-es kockákra vagy karikákra), hogy egyszerre puhuljanak. A hagymát hagyd egészben vagy félbe vágva.\r\nEgy nagyobb lábasban melegítsd fel az olajat közepes lángon (ne füstöljön!).\r\nTedd bele a hagymát és a keményebb gyökérzöldségeket (répa, zeller, fehérrépa). Párold 8–12 percig, időnként megkeverve, amíg a hagyma üveges lesz és a zöldségek enyhén megpuhulnak – ez nagyon fontos lépés, mert itt mélyülnek az ízek.\r\nÖntsd fel kb. 3 liter hideg vízzel (hideg víz = tisztább leves).\r\nAdd hozzá a petrezselyem szárát (csokorba kötve, hogy könnyű legyen később kivenni), a babérleveleket, egész borsot és sót ízlés szerint, ha van tea tojásod, akkor abba tedd bele a borsot, így nem fog zavarni evés közben.\r\nForrald fel, majd vedd vissza a lángot alacsonyra, hogy csak gyöngyözzön (ne forrjon nagyon). Fedő nélkül vagy félig fedve főzd kb. 20–25 percig.\r\nAmikor a gyökérzöldségek már majdnem puhák (villával könnyen átszúrhatók), a karalábét.\r\nFőzd tovább még 10–15 percig, amíg minden zöldség tökéletesen puha, de nem esik szét.\r\nVedd ki a petrezselyem szárát, babérlevelet és hagymát (ha egészben hagytad).\r\nSzórd meg friss aprított petrezselyemmel, kóstold meg, szükség szerint utánízesítsd, és forrón tálald.\r\n', 4, 1, 6, 100.00, 0),
(9, 'Tojásleves', 'Tojasleves.webp', '00:25:00', 2, 15, 4, 'Egy lábasban melegítsd fel az olajat közepes lángon.\r\nSzórd bele a lisztet, és folyamatos keverés mellett pirítsd 2–3 percig, amíg világosbarna, dióillatú rántás lesz (ne sötétedjen meg, különben keserű!).\r\nVedd le a tűzről, szórj bele a pirospaprikát, gyorsan keverd el (így nem ég le), majd azonnal öntsd fel kb. 1,5 liter hideg vízzel kis adagokban, közben folyamatosan keverd, hogy ne legyen csomós.\r\nTedd vissza a tűzre, add hozzá a babérlevelet, őrölt köményt, sót és borsot.\r\nForrald fel, majd alacsony lángon főzd 10–12 percig, hogy a rántás íze kioldódjon.\r\nKözben verd fel 2 tojást egy tálban villával. Amikor a leves gyöngyözik, vékony sugárban öntsd bele a felvert tojást, közben folyamatosan keverd – így csíkok lesznek belőle (nem gombócok).\r\nA maradék 4 tojást óvatosan, egyesével üsd bele a levesbe (közvetlenül a felszínre). Fedő nélkül főzd még 3–4 percig, amíg a tojások kifehérednek, de a sárgája lágy marad.\r\nVégül ízesítsd ecettel (kezdj 1 ek-kel, kóstold, mert savasabb lesz tőle).\r\nTálald forrón, a benne főtt tojásokkal együtt.\r\n', 4, 1, 6, 120.00, 0),
(10, 'Egyszerű húsleves alap', 'Husleves.webp', '02:30:00', 2, 15, 5, 'A sertés karajcsontot mosd át hideg vízben, tedd egy nagy fazékba.\r\nÖntsd fel hideg vízzel (kb. 2–2,5 liter, hogy ellepje), és közepes lángon melegítsd.\r\nAmint felforr és hab keletkezik a tetején, vedd le a lángot alacsonyra, és egy szűrővel folyamatosan szedd le a habot – ez nagyon fontos a tiszta, arany színű leveshez (kb. 5-10 percig szedjed).\r\nAmikor már alig jön hab, add hozzá a megtisztított, nagyobb darabokra vágott zöldségeket (sárgarépa, fehérrépa, zeller, karalábé, egész hagyma), sót és egész borsot, itt is használj tea tojást, hogy elkerüld a kiszedett levesben a bors darabokat.\r\nForrald fel újra, majd vedd vissza a legkisebb lángra (csak gyöngyözzön), fedővel félig letakarva főzd nagyon lassan 2–2,5 órán át. Időnként ellenőrizd, ha elfőtte a levét, pótolj forró vizet (hideget ne, mert zavaros lesz).\r\nAmikor a hús már omlós és a zöldségek teljesen puhák, szűrd le a levest egy finom szűrőn vagy tiszta konyharuhán keresztül.\r\nA húst és zöldségeket tedd vissza a levesbe, vagy külön tálald.\r\nA tésztát (csigatészta) külön sós vízben főzd ki a csomagolás szerint, majd öntsd a forró levesbe tálaláskor.', 5, 1, 6, 180.00, 0),
(11, 'Paradicsomleves betűtésztával', 'ParadicsomLeves.webp\n', '00:30:00', 2, 15, 4, 'Egy lábasban melegítsd fel az olajat, szórj bele lisztet, és kevergetve pirítsd 2–3 percig világos rántássá (világosbarna, dióillatú – ne sötétedjen!).\r\nVedd le a tűzről, öntsd hozzá a paradicsomlevet és a vizet folyamatos keverés mellett (így nem csomósodik).\r\nTedd vissza a tűzre.\r\nTedd bele az egészben hagyott vöröshagymát (ízesít, de később kiveszed).\r\nÍzesítsd cukorral (kiegyenlíti a savasságot), sóval és sűrített paradicsommal.\r\nForrald fel, majd alacsony lángon főzd 15–20 percig, időnként megkeverve.\r\nKözben főzd ki a betűtésztát külön sós vízben a csomagoláson írt idő szerint, majd szűrd le.\r\nVedd ki a hagymát a levesből, keverd bele a kifőtt tésztát.\r\nKóstold meg, szükség szerint utánízesítsd, és forrón tálald.', 4, 1, 6, 130.00, 0),
(12, 'Kekszes–tejszínes pohárkrém', 'KekszesPoharKrem.webp', '01:00:00', 2, 10, 2, 'A darált kekszet keverd össze az olvasztott vajjal és porcukorral – legyen nedves, morzsás állagú (mint morzsa tészta).\r\nA hideg habtejszínt verd kemény habbá a porcukorral és vaníliás cukorral (elektromos habverővel közepes sebességen 2–4 perc – ha túlvered, vaj lesz). Ha mascarpone van, keverd bele simára.\r\nA kakaóport keverd el egy kis kekszmorzsával, hogy ne legyen csomós.\r\nPoharakba rétegezd: alul kekszmorzsa, rá tejszínhab, majd kakaós morzsa – ismételj 2–3 réteget.\r\nA tetejét díszítsd kekszmorzsával vagy kakaóporral.\r\nHűtsd legalább 2–3 órát (vagy akár egy éjszakát), hogy összeérjenek az ízek és megszilárduljon.', 2, 2, 8, 400.00, 0),
(13, 'Tiramisu', 'Tiramisu.webp', '00:25:00', 2, 20, 6, 'Készítsd el a kávét (erős, cukor nélkül), hagyd teljesen kihűlni. Ha rumot használsz, keverd bele most.\r\nA tojássárgákat keverd habosra a porcukorral és vaníliás cukorral (kézi vagy elektromos habverővel 3–4 perc).\r\nAdd hozzá a mascarponét, keverd simára.\r\nA tojásfehérjéket verd kemény habbá (tisztán, zsírmentesen – ha fejjel lefelé fordítod a tálat, nem folyik ki). Óvatosan, alulról felfelé forgatva keverd a mascarponés krémhez.\r\nA babapiskótákat gyorsan (1–2 másodperc) mártsd a kávéba (ne áztasd túl, különben szétázik).\r\nEgy tál aljára rakj egy réteg kávéba mártott piskótát, kend rá a krém felét.\r\nIsmételj: újabb réteg piskóta + maradék krém.\r\nSimítsd el a tetejét, szórd meg vastagon kakaóporral szitán keresztül.\r\nHűtsd legalább 4–6 órát (legjobb egy éjszaka), hogy összeérjen és szeletelhető legyen.', 2, 2, 8, 460.00, 0),
(14, 'Brokkolikrémleves', 'BrokkoliKremLeves.webp', '00:45:00', 3, 20, 2, 'A brokkolit szedd rózsáira (a vastag, fás szárakat vágd le és dobd ki, vagy ha nagyon fiatal brokkoli, vékonyan szeleteld fel és használd fel).\r\nA burgonyát hámozd meg és vágd közepes kockákra (kb. 2 cm-es darabokra).\r\nTedd a brokkolit és a burgonyát egy lábasba, öntsd fel annyi enyhén sós vízzel, hogy ellepje (kb. 8–10 dl).\r\nForrald fel, majd alacsony-közepes lángon főzd puhára kb. 10–12 percig (a burgonya és a brokkoli vége legyen villával könnyen átszúrható, de ne essen szét).\r\nSzűrd le a főzőlevet egy tálba (ne öntsd ki – kb. 2–3 dl-t tarts meg félre).\r\nA zöldségeket tedd turmixgépbe vagy botmixerrel dolgozd simára a lábasban. Ha túl sűrű, fokozatosan adj hozzá a félretett főzőléből, amíg krémes, de nem túl híg állagot kapsz.\r\nFontos biztonsági lépés: Ha forró a leves, vedd le a turmixgép fedeléről a kis központi dugót (vagy hagyd résnyire nyitva a fedelet), hogy a gőz távozhasson – különben felrobbanthatja a fedelet és megéget!\r\nTedd vissza a krémet a lábasba, öntsd hozzá a főzőtejszínt, keverd el jól.\r\nLassú tűzön melegítsd össze 1–2 percig (ne forrald túl, mert kicsapódhat a tejszín).\r\nSózd ízlés szerint (a brokkoli már sós főzővízből jött).\r\nKözben a kenyeret kockázd fel, pirítsd ropogósra kevés olajon vagy vajon egy serpenyőben.\r\nTálald forrón, a tetejére szórva a pirított kenyérkockákat.', 4, 1, 5, 110.00, 0),
(15, 'Sütőtökkrémleves', 'SutotokKremLeves.webp', '00:50:00', 3, 20, 2, 'A sütőtököt pucold meg, magozd ki, vágd közepes darabokra (kb. 3–4 cm-es).\r\nTedd sütőpapírral bélelt tepsibe, sózd enyhén, és süsd előmelegített sütőben 180 °C-on kb. 25–35 percig, amíg teljesen puha és karamellizálódik a széle (villával könnyen átszúrható).\r\nKözben a hagymát finomra aprítsd, és pirítsd meg kevés olajon egy lábasban közepes lángon üvegesre (kb. 5–6 perc).\r\nAdd hozzá a sült tökdarabokat a hagymához, öntsd fel kb. 4–5 dl vízzel (vagy amennyi ellepi).\r\nForrald fel, majd alacsony lángon főzd 5–8 percig, hogy az ízek összeérjenek.\r\nTurmixold simára botmixerrel vagy turmixgépben (ugyanaz a biztonsági figyelmeztetés: gőz miatt résnyire nyitott fedél!).\r\nÖntsd hozzá a főzőtejszínt, keverd el, sózd ízlés szerint.\r\nLassú tűzön melegítsd össze 1–2 percig (ne forrald).\r\nKözben a bacont vágd csíkokra vagy kockára, pirítsd ropogósra serpenyőben (zsírjára sütve).\r\nTálald a levest forrón, a tetejére szórva a pirított bacont.', 4, 1, 5, 150.00, 0),
(16, 'Paradicsomkrémleves', 'ParadicsomKremLeves.webp', '00:15:00', 3, 20, 2, 'Öntsd a paradicsomlevet egy lábasba, melegítsd közepes lángon gyöngyözésig (ne forrald vadul).\r\nÍzesítsd sóval és cukorral (a cukor kiegyenlíti a paradicsom savasságát – kezdj 1 ek cukorral, kóstold).\r\nÖntsd hozzá a főzőtejszínt, keverd el jól.\r\nMelegítsd tovább alacsony lángon 3–5 percig, amíg összeforrósodik és krémes lesz (ne forrald túl, mert kicsapódhat a tejszín).\r\nKóstold meg, szükség szerint utánízesítsd.\r\nForrón tálald (opcionális: pirított kenyérkockával vagy bazsalikomlevéllel).', 4, 1, 5, 120.00, 0),
(17, 'Zellerkrémleves', 'ZellerKremLeves.webp', '00:45:00', 3, 20, 2, 'A zellergumót és a burgonyát hámozd meg, vágd közepes kockákra (kb. 2 cm).\r\nTedd egy lábasba, öntsd fel enyhén sós vízzel (kb. 8–10 dl, hogy ellepje).\r\nForrald fel, majd alacsony-közepes lángon főzd puhára kb. 12–15 percig (a zeller és burgonya legyen teljesen puha).\r\nSzűrd le a főzőlevet egy tálba, tarts meg kb. 2–3 dl-t félre.\r\nA zöldségeket turmixold simára a félretett főzőlével (gőz miatt résnyire nyitott fedél!).\r\nÖntsd hozzá a főzőtejszínt, keverd simára.\r\nSózd ízlés szerint, lassú tűzön melegítsd össze 1–2 percig.\r\nTálald forrón, a tetejére szórva levesgyöngyöt (vagy pirított kenyérkockát).', 4, 1, 5, 100.00, 0),
(18, 'Alap piskóta', 'Piskota.webp', '00:25:00', 3, 15, 12, 'Melegítsd elő a sütőt 180 °C-ra (alsó-felső sütés, légkeverés esetén 160–170 °C).\r\nA tojásokat óvatosan válaszd szét: a fehérjébe egyáltalán ne kerüljön sárgája, mert akkor nem lesz kemény hab (használj 3 tálat: egyik a fehérjéknek, egyik a sárgáknak, egyik a töréshez).\r\nA tojásfehérjéket verd kemény habbá elektromos habverővel (kezd alacsony sebességgel, majd emeld közepesre). Ellenőrizd: ha fejjel lefelé fordítod a tálat, a hab nem folyik ki.\r\nA tojássárgákat keverd habosra a cukorral (3–4 percig, világos sárga, krémes állag).\r\nÓvatosan forgasd a hab felét a sárgás masszába (alulról felfelé, ne keverd túl erősen, hogy ne essen össze a hab).\r\nSzitáld hozzá a lisztet (fontos a szitálás, hogy ne legyen csomós), és finoman forgasd bele.\r\nÖntsd a masszát sütőpapírral bélelt tepsibe (kb. 30×40 cm, vagy tortaforma). Egyenletesen simítsd el.\r\nSüsd 180 °C-on 10–12 percig (tűpróba: ha tisztán jön ki a fogpiszkáló, kész).\r\nVedd ki, hagyd hűlni a tepsiben 5 percig, majd borítsd ki rácsra.', 6, 1, 7, 160.00, 0),
(19, 'Piskótatekercs', 'Piskotatekercs.webp', '00:30:00', 3, 15, 12, 'Melegítsd elő a sütőt 180 °C-ra (alsó-felső).\r\nUgyanaz a tojásszétválasztás és habverés, mint az alap piskótánál (lásd fent).\r\nA masszát öntsd sütőpapírral bélelt tepsibe, egyenletesen simítsd el vékonyra (kb. 1 cm vastag réteg).\r\nSüsd 10–12 percig, amíg a teteje aranybarna és ruganyos (ne süsd túl, különben törni fog tekercseléskor).\r\nAmíg sül, készíts elő egy tiszta konyharuhát, szórj rá kevés porcukrot (hogy ne ragadjon rá a piskóta).\r\nAmint kiveszed a sütőből, azonnal borítsd ki a forró piskótát a porcukros ruhára, húzd le óvatosan a sütőpapírt.\r\nTekerd fel szorosan a konyharuhával együtt (ez tartja formában hűlés közben).\r\nHagyd teljesen kihűlni (kb. 30–40 perc).\r\nÓvatosan tekerd ki, kend meg vékonyan lekvárral (ne legyen túl vastag, különben kifolyik).\r\nTekerd vissza szorosan (ruha nélkül), csomagold fóliába, és tedd hűtőbe 1 órára, hogy szeletelhető legyen.', 6, 1, 7, 180.00, 0),
(20, 'Sült csirkemell rizzsel', 'CsirkeRizs.webp', '00:30:00', 4, 20, 1, 'A csirkemellet mosd meg hideg vízben, majd papírtörlővel alaposan töröld szárazra (ez nagyon fontos, hogy ne engedjen levet sütés közben és szép kérget kapjon).\r\nVágd egyenletes vastagságú szeletekre vagy csíkokra (kb. 1–1,5 cm vastag), hogy egyszerre süljön át.\r\nSózd és borsozd mindkét oldalát.\r\nEgy serpenyőben hevíts fel 1 ek olajat közepes lángon (az olaj akkor jó, ha enyhén csillog).\r\nTedd bele a csirkeszeleteket egy rétegben (ne zsúfold túl, mert akkor párolódik, nem sül). Süsd oldalanként 4–5 percig, amíg aranybarna kérget kap és a belseje már nem rózsaszín (belső hőmérséklet kb. 75 °C). Ne süsd túl, mert kiszárad!\r\nKözben a rizst mérd ki: 200 g rizshez 400 ml vizet. Egy lábasban pirítsd a rizst 1–2 percig kevés olajon (üveges lesz), sózd, öntsd fel vízzel, forrald fel, majd alacsony lángon fedő alatt főzd 12–15 percig, amíg a víz teljesen felszívódik. Hagyd pihenni 5 percet fedő alatt.\r\nA brokkolit szedd rózsáira, tedd forrásban lévő sós vízbe, főzd 5–7 percig (roppanós maradjon). Szűrd le.\r\nTálald a csirkét a rizzsel és brokkolival együtt.', 1, 2, 1, 500.00, 0),
(21, 'Milánói sertésborda', 'MilanoiSertesborda.webp', '00:40:00', 4, 20, 1, 'Rántott sertésborda\r\nA sertésszeletet klopfolóval óvatosan klopfold ki, hogy egyenletes vastagságú legyen.\r\nSózd és borsozd meg mindkét oldalát.\r\nKészíts elő három tányért:\r\naz egyikbe lisztet,a másikba felvert tojást,a harmadikba zsemlemorzsát.\r\nA hússzeletet panírozd liszt → tojás → zsemlemorzsa sorrendben.\r\nÜgyelj arra, hogy mindenhol egyenletesen fedje a panír.\r\nEgy serpenyőben hevíts bő olajat közepes lángon.\r\n(Az olaj akkor jó, ha a belepottyantott morzsa azonnal pezseg.)\r\nSüsd ki a húst oldalanként kb. 4–5 perc alatt, amíg szép aranybarna nem lesz.\r\nSzedd ki papírtörlőre, hogy a felesleges olaj lecsepegjen.\r\nMilánói tészta:\r\nEgy nagyobb lábasban forralj vizet, sózd meg.\r\nFőzd meg benne a spagettit a csomagoláson feltüntetett idő szerint (általában 8–10 perc).\r\nSzűrd le a tésztát.\r\nEgy kisebb edényben melegítsd fel a paradicsomszószt.\r\nAdd hozzá a csíkokra vágott sonkát, és keverd össze.\r\nA tányérba tedd bele a tésztát, tedd rá a szószt, illetve a tetejére a rántott húst. Majd tálald.', 1, 3, 1, 850.00, 0),
(22, 'Tejszínes-gombás csirkemell', 'TejszinesGombasCsirkemell.webp', '00:35:00', 4, 20, 2, 'A csirkemellet mosd meg, töröld szárazra, majd kockázd fel egyforma méretű darabokra, hogy egyenletesen süljenek.\r\nA gombát tisztítsd meg (szükség esetén mosd meg gyorsan), majd szeleteld fel.\r\nEgy serpenyőben hevítsd fel az olajat közepes lángon.\r\nAdd hozzá a csirkemellet, és süsd addig, amíg minden oldala kifehéredik és enyhén megpirul.\r\nTedd hozzá a felszeletelt gombát.\r\nPárold 4–5 percig, amíg a gomba levet enged, majd összeesik és a leve nagy része elpárolog.\r\nÖntsd hozzá a főzőtejszínt, keverd össze.\r\nSózd és borsozd ízlés szerint.\r\nAlacsonyabb lángon főzd tovább kb. 8–10 percig, amíg a szósz besűrűsödik.\r\nKözben egy lábasban forralj vizet, sózd meg.\r\nFőzd ki benne a tésztát a csomagoláson feltüntetett idő szerint.\r\nSzűrd le a tésztát.\r\nKeverd össze a tésztát és a szószt és tálald. \r\n', 1, 2, 1, 420.00, 0),
(23, 'Párolt zöldségek', 'ParoltZoldseg.webp', '00:15:00', 4, 20, 2, 'A zöldségeket alaposan mosd meg.\r\nTisztítsd meg és vágd egyforma méretű darabokra.\r\nEgy lábas aljába önts kevés vizet, forrald fel.\r\nHelyezz rá párolóbetétet vagy szűrőt, tedd bele a zöldségeket.\r\nFedd le és párold 10–12 percig, amíg puhák, de még roppanósak.\r\nHa nincs párolóbetét, kevés vízzel fedő alatt is párolhatók.\r\nSzűrd le, sózd ízlés szerint, és azonnal tálald.', 4, 1, 10, 80.00, 0),
(24, 'Muffin', 'Muffin.webp', '00:40:00', 4, 15, 12, 'Melegítsd elő a sütőt 180 °C-ra (alsó–felső sütés).\r\nKészíts elő egy muffin sütőformát, béleld ki muffin papírokkal.\r\nEgy tálban keverd össze a száraz hozzávalókat: liszt, cukor, sütőpor.\r\nAdd hozzá a tojásokat, a tejet és az olajat.\r\nKeverd simára -állagra egy tejföl sűrűségű masszát kell kapnod-, majd forgasd bele a csokicseppet vagy gyümölcsöt.\r\nA masszát kanalazd a formákba ¾ magasságig.\r\nSüsd 10-15 percig, tűpróbával ellenőrizd(ha száraz a fogpiszkáló amit beleszúrsz akkor jó  a sütemény, ha még ráragad a tészta, akkor tedd vissza egy-két percre).', 6, 1, 7, 150.00, 0),
(25, 'Csokis bögrés süti', 'CsokisBogresSuti.webp', '00:05:00', 4, 15, 1, 'Egy nagy bögrében keverd össze a lisztet, cukrot, kakaóport és sütőport.\r\nAdd hozzá a tejet, olajat és a tojást, majd keverd csomómentesre.\r\nTedd mikrohullámú sütőbe 700–900 W teljesítményen 1 perc 20–40 másodpercre.\r\nA teteje legyen szilárd, a közepe enyhén lágy.\r\nHagyd állni 1–2 percig, majd melegen fogyaszd.', 7, 1, 7, 300.00, 0),
(26, 'Rántott hús krumplipürével', 'RantottHusKrumpliPurevel.webp', '00:45:00', 5, 25, 2, 'A hússzeleteket klopfold ki egyenletes vastagságúra, majd enyhén sózd.\r\nPanírozd lisztbe, felvert tojásba, majd zsemlemorzsába.\r\nBő olajban süsd aranybarnára oldalanként 4–5 perc alatt.\r\nA burgonyát hámozd meg, darabold fel, majd sós vízben főzd puhára.\r\nSzűrd le, törd össze, add hozzá a vajat és a meleg tejet.\r\nSózd ízlés szerint, keverd krémesre.\r\nTálald a frissen sült rántott hússal.', 8, 3, 1, 750.00, 0),
(27, 'Rakott krumpli', 'RakottKrumpli.webp', '00:50:00', 5, 25, 4, 'A hagymát pucold meg és vágd apró kockára.\r\nEgy kevés zsiradékon dinszteld meg, amíg kissé összeesik.\r\nA burgonyát hámozd meg, majd mosd meg.\r\nEnyhén sós vízben főzd teljesen puhára – akkor jó, ha villával könnyen átszúrható.\r\nA tojásokat tedd egy lábasba, öntsd fel vízzel, majd a forrástól számítva főzd 10–12 percig, hogy kemény tojás legyen.\r\nA főzés után öntsd le a forró vizet, majd hideg vízzel hűtsd le, így könnyebb megpucolni.\r\nA kolbászt szeleteld fel.\r\nEgy kivajazott tepsiben kezdd el a rétegezést: alul a dinsztelt hagyma, majd krumpli → kolbász → tojás → tejföl.\r\nFolytasd a rétegezést, amíg az alapanyagok el nem fogynak.\r\nA tetejére mindig tejföl kerüljön.\r\nSüsd előmelegített sütőben 180 °C-on kb. 30 percig, amíg a teteje szépen megpirul.', 6, 3, 3, 600.00, 0),
(28, 'Bolognai spagetti', 'BolognaiSpagetti.webp', '00:35:00', 5, 25, 3, 'A hagymát pucold meg és  vágd apróra, majd pirítsd üvegesre kevés olajon.\r\nAdd hozzá a darált húst, pirítsd addig amíg kifehéredik.\r\nNyomd bele a fokhagymát, figyelj arra, hogy a fokhagyma nehogy leégjen, mert akkor keserű íze lesz a ragunak.\r\nÖntsd hozzá a paradicsomszószt, sózd, borsozd, ha egy kicsit édesebben szeretnéd akkor tehetsz bele egy kevés ketchupot. \r\nFőzd 15–20 percig, amíg besűrűsödik.\r\nA spagettihez forralj egy nagy lábasban vizet. \r\nAdj hozzá olajat és jól sózd meg a vizet.\r\nHa a víz felforrt, tedd bele a tésztát, és főzd 10-12 percig.\r\nHa a tészta megfőtt, szűrd le, mosd át folyó hideg vízzel, és tedd egy olajon edénybe. \r\nA szószt és a tésztát keverd össze, és tálald. \r\n', 4, 3, 3, 650.00, 0),
(29, 'Zöldborsófőzelék fasírttal', 'BorsoFozelekFasirttal.webp', '00:35:00', 5, 25, 2, 'Zöldborsófőzelék:\nA zöldborsót tedd fel főzni annyi enyhén sós vízben, amennyi éppen ellepi.\n Főzd puhára közepes lángon kb. 10–12 perc alatt. \nA lisztet keverd el egy kevés tejjel csomómentesre, majd add hozzá a maradék tejet.\n Ha mégis csomós lenne, egy finom lyukú szűrőn szűrd át.\n Folyamatos keverés mellett öntsd a borsóhoz.\n Főzd tovább, amíg a főzelék besűrűsödik.\n Sózd ízlés szerint.\nFasírt elkészítése:\nA zsemlét vagy kenyeret áztasd be a vízbe, majd alaposan nyomkodd ki.\n A hagymát és a fokhagymát reszeld vagy vágd nagyon apróra.\n Egy tálban keverd össze a darált húst, tojást, beáztatott zsemlét, hagymát, fokhagymát és a fűszereket.\n Adj hozzá zsemlemorzsát, hogy jól formázható masszát kapj.\n Vizes kézzel formázz 4 közepes méretű fasírtot.\n Forrósíts olajat, és süsd ki a fasírtokat közepes lángon, oldalanként 3–4 perc alatt, aranybarnára.\n Szedd ki papírtörlőre, hogy a felesleges olaj lecsepegjen.\nMajd tálald az ételt. \n', 4, 2, 4, 550.00, 0),
(30, 'Pudingos-habos pohárdesszert', 'PudingosHabosPohar.webp', '00:15:00', 5, 20, 2, 'Főzd meg a pudingot a leírása alapján a tejjel és cukorral, majd hűtsd langyosra.\r\nA habtejszínt verd kemény habbá.\r\nKezd el rétegezni pohárban: puding → babapiskóta → tejszínhab.\r\nFolytasd, amíg az alapanyagok elfogynak.\r\nHűtsd legalább 1–2 órát, hogy összeálljon.\r\n', 2, 1, 8, 300.00, 0),
(31, 'Almás pite', 'AlmasPite.webp', '01:00:00', 5, 20, 6, 'Az almákat hámozd meg, reszeld le, majd keverd össze a cukorral és a fahéjjal.\r\n Ízlés szerint az almát enyhén meg is párolhatod, majd hagyd kihűlni.\r\nAz omlós tésztához a lisztet, sütőport, sót és porcukrot keverd össze, majd morzsold el a hideg vajjal.\r\n Add hozzá a tojást, és gyors mozdulatokkal gyúrj belőle sima tésztát. \r\nTedd a hűtőbe egy órára, hogy összeálljon a tészta.\r\nOszd két részre a tésztát.\r\nA egyik tésztarészt nyújtsd ki akkorára, hogy befedje a tepsi alját, és helyezd bele. \r\nSzórd meg vékonyan darált háztartási keksszel, majd terítsd rá az almás tölteléket. \r\nA másik tésztarészt nyújtsd ki, fedd be vele az almát.\r\nVillával szurkáld meg a tetejét, hogy sütés közben a gőz távozni tudjon, így a pite nem púposodik fel.\r\nSüsd előmelegített sütőben 180°C-on 30–35 percig, amíg aranybarnára sül.\r\nKihűlés után porcukorral meghintve tálald.\r\n', 6, 2, 7, 260.00, 0),
(32, 'Marhapörkölt nokedlivel', 'MarhaporkoltNokedli.webp', '02:30:00', 6, 25, 4, 'A marhapörkölt elkészítéséhez a vöröshagymát hámozd meg és vágd nagyon apróra, majd egy vastag aljú lábasban hevítsd fel az olajat közepes lángon, és pirítsd rajta üvegesre a hagymát. \r\nA marhahúst mosd meg, töröld szárazra, kockázd fel, majd add a hagymához, és pirítsd addig, amíg a hús minden oldala kifehéredik. \r\nEkkor vedd le az edényt a tűzről, szórd meg a pirospaprikával, majd azonnal önts alá vizet és alaposan keverd el. \r\nSózd meg ízlés szerint, fedd le, és lassú tűzön főzd körülbelül két órán át, időnként ellenőrizve, hogy ha elfő a leve, pótold azt kevés vízzel; az étel akkor kész, ha a hús omlós, a szaft pedig sűrűvé válik.\r\nKözben készítsd el a nokedlit: egy tálban keverd össze a lisztet és a sót, add hozzá a tojásokat, majd fokozatosan adagold hozzá a vizet, amíg sűrű és ragacsos tésztát kapsz. \r\nA masszát szaggasd forrásban lévő sós vízbe, és amint a galuskák feljönnek a víz tetejére, szűrd le őket, majd a szaftos pörkölttel együtt forrón tálalhatod.', 4, 3, 2, 680.00, 0),
(33, 'Csirkepaprikás galuskával', 'CsirkepaprikasGaluska.webp', '01:00:00', 6, 25, 4, 'A hagymát először hámozd meg és vágd finomra, majd egy nagyobb lábasban, kevés olajon pirítsd üvegesre.\r\nEzután add hozzá a csirkedarabokat, és pirítsd át őket minden oldalukon, amíg szépen kifehérednek. \r\nEkkor vedd le az edényt a tűzről, szórd meg a húst pirospaprikával, alaposan keverd el, majd azonnal önts alá egy kevés vizet, hogy a paprika ne égjen meg. \r\nSózd, igény szerint borsozd meg, majd fedő alatt, közepes lángon főzd 40–50 percig, amíg a csirke teljesen megpuhul és szaftos lesz.\r\n\r\nMíg a hús fő, készítsd el a galuskát: a lisztet tedd egy tálba, add hozzá a sót, üsd bele a tojásokat, majd fokozatosan adagolva a vizet keverd sűrű, de szaggatható állagú tésztává. \r\nEgy nagy lábasban forralj sós vizet, és galuskaszaggatóval vagy kanállal szaggasd bele a tésztát; főzd addig, amíg a galuskák feljönnek a víz felszínére, ami körülbelül 2–3 percet vesz igénybe, majd szűrd le őket.\r\n\r\nVégül a tejfölt egy tálban keverd simára, és egy merőkanállal vegyél ki a forró szaftból, amit fokozatosan keverj a tejfölhöz a hőmérsékletek kiegyenlítése érdekében. \r\nEzt a tejfölös keveréket öntsd vissza a paprikáshoz, alacsony lángon melegítsd össze, de ügyelj rá, hogy már ne forrald, mert a tejföl kicsapódhat. A kész ételt a frissen kifőzött galuskával tálald.', 4, 3, 2, 700.00, 0),
(34, 'Hortobágyi húsos palacsinta', 'HortobagyiPalacsinta.webp', '01:00:00', 6, 25, 4, 'A palacsinták elkészítéséhez a tojást, a tejet, az olajat, a szódát, a vizet, a lisztet, és 1 gramm sót keverd össze egy tálban sima, folyékony, de nem vízszerű masszává. \r\nEgy serpenyőt vékonyan kenj ki olajjal, melegítsd fel közepes lángon, majd merőkanállal önts bele tésztát, és süsd a palacsintákat oldalanként 1–1,5 percig, a kész lapokat pedig tedd félre. A húsos töltelékhez a vöröshagymát hámozd meg és vágd nagyon apróra, majd egy serpenyőben, kevés olajon pirítsd üvegesre. Add hozzá a darált húst, fakanállal morzsold szét, ízesítsd maradék sóval és borssal, majd pirítsd addig, amíg a hús kifehéredik és szaftos lesz. \r\nHúzd le a tűzről, szórd meg a pirospaprikával, keverd el, önts fel egy kevés vízzel, és kis lángon főzd tovább, amíg a töltelék szaftos marad, de nem túl folyós. \r\nSzűrd le a húsos ragut, a szaftot pedig tedd félre az öntethez. \r\nA tejfölös öntethez a félretett szaftot hagyd langyosra hűlni, egy tálban keverd simára a tejfölt, majd fokozatosan add hozzá a szaftot, hogy ne csapódjon ki. \r\nA palacsintákat terítsd ki, kanalazz a közepükre a húsos töltelékből, hajtsd be az oldalsó széleket, és tekerd fel őket szorosan. \r\nVégül a megtöltött palacsintákat helyezd egy kivajazott tűzálló tálba, öntsd le a tejfölös mártással, és előmelegített sütőben, 180°C-on süsd 10–15 percig, amíg a teteje enyhén megpirul.', 6, 3, 3, 650.00, 0),
(35, 'Tokány zöldségekkel', 'TokanyZoldseggel.webp', '00:45:00', 6, 25, 3, 'A vöröshagymát hámozd meg és vágd finomra, a kaliforniai paprikát mosd meg, magozd ki és szeleteld fel csíkokra, a paradicsomot pedig aprítsd fel kisebb darabokra. \r\nEgy serpenyőben vagy lábasban hevítsd fel az olajat közepes lángon, majd add hozzá a hagymát és pirítsd üvegesre. Fontos, hogy a hagyma puha és világos maradjon, ne barnuljon meg.\r\nEzt követően tedd a serpenyőbe a felcsíkozott sertéskarajt, és pirítsd addig, amíg a hús minden oldala kifehéredik és levet enged. \r\nEkkor add hozzá a felaprított paprikát és paradicsomot, majd ízlés szerint sózd és borsozd meg az ételt. \r\nAlaposan keverd össze, fedd le az edényt, és kis lángon párold körülbelül 35–40 percig.\r\nAkkor készültél el, ha a hús teljesen megpuhult és villával könnyen átszúrható. \r\nÜgyelj rá, hogy a tokány ne legyen leveses, maradjon enyhén szaftos; ha a párolás során elfogyna alóla a folyadék, csak minimális (1–2 evőkanál) vizet pótolj. \r\nA végeredmény akkor tökéletes, ha a szaft sűrű és ízes.', 1, 3, 3, 620.00, 0),
(36, 'Linzerkarikák', 'LinzerKarika.webp', '01:00:00', 6, 20, 20, 'Az omlós tészta elkészítéséhez a vajat közvetlenül a felhasználás előtt vedd ki a hűtőből, és kockázd fel. \r\nEgy tálban alaposan keverd össze a lisztet, a porcukrot és a sót, majd add hozzá a hideg vajkockákat, és gyors mozdulatokkal morzsold el a lisztes keverékben. \r\nÜgyelj rá, hogy ne gyúrd hosszan, mert ha a tészta a kezed melegétől felmelegszik, elveszíti omlósságát.\r\nAmikor a tészta összeállt, formázz belőle gombócot, csomagold fóliába, majd pihentesd a hűtőben 30 percig, hogy nyújtáskor ne repedezzen meg.\r\nA pihentetés után melegítsd elő a sütőt 180°C-ra, alsó–felső sütési módban. A tésztát lisztezett felületen nyújtsd ki körülbelül 3–4 mm vastagságúra, majd szaggass belőle karikákat.\r\nA kiszaggatott korongok felének a közepét egy kisebb szaggatóval vagy kupakkal lyukaszd ki, majd a formákat helyezd sütőpapírral bélelt tepsire. Süsd a linzereket 180°C-on körülbelül 8–10 percig; akkor tekinthetők késznek, ha a tészta világos marad, és csak az alja kezd el enyhén pirulni. \r\nMiután kivetted a sütőből, hagyd a korongokat teljesen kihűlni. \r\nVégezetül egy teljes karikát kenj meg alaposan lekvárral, és egy lyukas közepű párjával tapaszd össze őket.', 6, 1, 7, 110.00, 0),
(37, 'Mézes puszedli', 'MezesPuszedli.webp', '00:40:00', 6, 20, 18, 'Olvaszd fel a vajat, majd hagyd langyosra hűlni. A mézet szintén enyhén langyosítsd meg, ügyelve arra, hogy ne legyen forró. \r\nEgy nagy keverőtálban alaposan dolgozd össze a mézet, a porcukrot és az olvasztott vajat, majd add hozzá a tojássárgájákat és keverd a masszát teljesen simára. \r\nEgy külön tálban vegyítsd el a száraz alapanyagokat: a lisztet, a szódabikarbónát és a mézeskalács fűszerkeveréket. \r\nEzt a száraz keveréket adagokban szitáld a mézes masszához, végül öntsd hozzá a tejet is. Az egészet dolgozd össze egy enyhén lágy, de jól formázható tésztává.\r\nFormázás és sütés:\r\nMelegítsd elő a sütőt 180°C-ra (alsó–felső sütési módban). A tésztából formázz nagyjából diónyi méretű golyókat, majd helyezd őket egy sütőpapírral bélelt tepsire, egymástól távolabb, mert sütés közben nőni fognak.\r\nSüsd a puszedliket 10–12 percig. Akkor jók, ha a tetejük kissé megrepedezik, de a színük még világos marad. \r\nA sütőből kivéve várd meg, amíg teljesen kihűlnek.\r\nMáz készítése:\r\nA tojásfehérjéket tedd egy tiszta tálba, és add hozzá a porcukrot. Kézi vagy elektromos habverő segítségével verj belőle sűrű, fényes és sima mázat. \r\nA már teljesen kihűlt puszedlik tetejére kanalazd vagy csurgasd rá a cukormázat, majd hagyd őket állni, amíg a bevonat teljesen meg nem szárad és meg nem szilárdul.', 6, 1, 7, 90.00, 0),
(38, 'Gulyásleves', 'GulyasLeves.webp', '01:45:00', 7, 30, 5, 'A vöröshagymát finomra aprítsd, majd egy vastag aljú lábasban hevíts fel kevés olajat közepes lángon.\r\nAdd hozzá a hagymát, és pirítsd üvegesre.\r\nAdd hozzá a kockázott marhahúst, és pirítsd addig, amíg kifehéredik és levet enged.\r\nVedd le a lábast a tűzről, add hozzá az őrölt pirospaprikát, keverd el, majd azonnal önts alá kevés vizet (kb. 1–2 dl), hogy a paprika ne égjen meg.\r\nSózd és borsozd ízlés szerint, fedd le, majd kis lángon párold 40–50 percig, időnként ellenőrizve.\r\nHa elfő a leve, mindig csak kevés vizet pótolj.\r\nAdd hozzá a felkockázott sárgarépát és fehérrépát, majd öntsd fel kb. 1,5 liter vízzel.\r\nFőzd tovább 20 percig, amíg a zöldségek félig megpuhulnak.\r\nAdd hozzá a felkockázott burgonyát, és főzd addig, amíg minden alapanyag teljesen megpuhul.\r\nKóstold meg, szükség szerint sózd, majd forrón tálald friss kenyérrel.\r\n', 4, 2, 6, 420.00, 0),
(39, 'Brassói aprópecsenye', 'BrassoiApropecsenye.webp', '01:00:00', 7, 30, 3, 'A sertéshúst alaposan mosd meg, töröld szárazra, majd vágd egyenletes, kisebb kockákra. \r\nEgy serpenyőben hevíts kevés olajat közepes lángon, majd add hozzá a húskockákat. \r\nPirítsd addig, amíg a hús minden oldala kifehéredik és enyhe pörzsréteg (szín) képződik rajta. \r\nÍzlés szerint sózd és borsozd meg, majd fedd le az edényt, és kis lángon párold körülbelül 25–30 percig. \r\nÜgyelj rá, hogy a hús ne legyen szaftos; ha a párolás során elfogyna a saját leve, csak minimális vizet pótolj, hogy a hús teljesen megpuhuljon.\r\nMíg a hús puhul, a burgonyát hámozd meg, mosd meg és kockázd fel a hússal megegyező méretűre. \r\nEgy másik edényben hevíts bő olajat, és süsd ki benne a krumplit aranybarnára és ropogósra. \r\nSzedd ki papírtörlőre, hogy a felesleges zsiradék lecsepegjen.\r\nAmikor a hús már teljesen megpuhult, add hozzá a zúzott fokhagymát, és gyorsan keverd át a pecsenyelével. \r\nFontos, hogy a fokhagymát a legvégén add hozzá, mert ha megég, keserűvé teszi az ételt. \r\nVégezetül borítsd a sült krumplit a hús mellé, óvatosan forgasd össze, és ha szükséges, adj hozzá még egy kevés sót. Azonnal, frissen tálald.', 1, 3, 1, 750.00, 0),
(40, 'Töltött csirkecomb', 'ToltottCsirkeComb.webp', '01:00:00', 7, 30, 2, 'A csirkecombokat alaposan tisztítsd meg, majd a bőrét az ujjaddal óvatosan válaszd el a hústól úgy, hogy egy tágas zsebet képezz, de vigyázz, ne szakítsd ki. \r\nA húst kívül-belül, valamint a bőr alatt is dörzsöld be ízlés szerint sóval és borssal.\r\nA töltelékhez a sonkát és a zöldpaprikát vágd apró kockákra, majd egy tálban forgasd össze a reszelt sajttal. \r\nAz így kapott masszát egyenletesen töltsd be a csirkecombok bőre alá készített zsebekbe. \r\nHa szükséges, a nyílást egy fogvájóval rögzítheted, hogy a töltelék sütés közben ne folyjon ki.\r\nHelyezd a megtöltött combokat egy enyhén kiolajozott tepsibe. Told a 180°C-ra előmelegített sütőbe, és süsd 40–50 percig. Akkor készültél el, ha a hús teljesen átsült, a csirke bőre pedig aranybarnára és ropogósra pirult.\r\n', 6, 3, 1, 680.00, 0),
(41, 'Hagymás rostélyos', 'HagymasRostelyos.webp', '00:40:00', 7, 30, 2, 'A húst sózd, borsozd.\r\nSerpenyőben forró olajon süsd át mindkét oldalát (közepes átsütés: 3–4 perc oldalanként).\r\nA hagymát karikázd fel.\r\nUgyanabban a serpenyőben lassan karamellizáld aranybarnára.\r\nA hagymakarikákat szépen, lassú túzön folyamatos keverés mellett karamellizáljuk meg\r\nA húst tálald a hagymával a tetején.\r\n', 1, 3, 1, 720.00, 0),
(42, 'Képviselőfánk', 'KepviseloFank.webp', '01:30:00', 7, 25, 12, 'Egy lábasban forrald fel a vizet a vajjal és egy csipet sóval. \r\nAmikor már lobog, egyszerre öntsd hozzá a lisztet, és folyamatos, gyors kevergetés mellett főzd addig, amíg a tészta összeáll egy gombóccá, és elválik az edény falától. \r\nVedd le a tűzről, és hagyd pár percig hűlni. \r\nEzután egyenként add hozzá a tojásokat, minden egyes tojás után alaposan keverd el a masszát, amíg fényes és sima nem lesz.\r\nA tésztát töltsd habzsákba, és sütőpapírral bélelt tepsire formázz belőle közepes méretű halmokat, hagyva köztük elég helyet a növekedéshez. Helyezd a tepsit 230°C-ra előmelegített sütőbe, és süsd 5 percig. \r\nEkkor mérsékeld a hőt 200°C-ra, és süsd további 10-15 percig, amíg a fánkok aranybarnák és könnyűek lesznek. \r\nFontos: A sütés első 10 percében ne nyisd ki a sütő ajtaját, mert a tészta összeeshet!\r\nA vaníliás pudingporból és a tejből készíts sűrű krémet, majd hagyd teljesen kihűlni. \r\nA habtejszínt verd kemény habbá. \r\nA kihűlt fánkok tetejét vágd le, az aljukba tölts a vaníliakrémből, nyomj rá egy réteg tejszínhabot, majd helyezd vissza a tészta tetejét. \r\nTálalás előtt porcukorral is meghintheted.\r\n', 6, 3, 7, 220.00, 0),
(43, 'Profiterol', 'Profiterol.webp', '01:00:00', 7, 25, 4, 'Egy közepes méretű lábasban forrald fel a vizet a vajjal és egy csipet sóval. Amikor a víz már lobog és a vaj teljesen felolvadt, vedd le az edényt a tűzről, és egyszerre öntsd bele az összes lisztet. \r\nEgy fakanállal gyors és határozott mozdulatokkal keverd csomómentesre.\r\nTedd vissza az edényt a tűzre, és folyamatosan kevergetve „pörköld” a tésztát 1-2 percig, amíg az teljesen összeáll egy gombóccá, fényessé válik, és elválik az edény falától.\r\nVedd le a tűzről, és hagyd a masszát langyosra hűlni. \r\nEzután egyenként add hozzá a tojásokat: minden egyes tojás után alaposan dolgozd el a tésztát (kézzel vagy gépi habverővel), és csak akkor add hozzá a következőt, ha az előzőt már teljesen felvette. \r\nA cél egy sima, fényes és sűrű krém állagú tészta, ami lassan válik le a kanálról.\r\nA tésztát töltsd habzsákba, és egy sütőpapírral bélelt tepsire nyomj belőle apró, nagyjából diónyi méretű golyókat. Ügyelj rá, hogy hagyj köztük elég helyet, mert sütés közben jelentősen megnőnek.\r\nHelyezd a tepsit 200°C-ra előmelegített sütőbe. \r\nSüsd a fánkokat 15–20 percig, amíg aranybarnák és könnyűek nem lesznek.\r\nKritikus szabály: A sütés első 10 percében tilos kinyitni a sütő ajtaját, különben a tészta belsejében lévő gőz kiszökik, és a fánkok azonnal összeesnek! \r\nHa megsültek, vedd ki, és hagyd őket teljesen kihűlni.\r\nMíg a tészta hűl, készítsd el a tölteléket. A pudingport keverd el 100 ml hideg tejjel és a cukorral. \r\nA maradék tejet forrald fel, majd folyamatos kevergetés mellett öntsd hozzá a pudingos alapot, és főzd sűrűre. Fedd le folpackkal (közvetlenül a krém felszínén, hogy ne bőrösödjön meg), és hagyd teljesen kihűlni.\r\nA habtejszínt verd kemény habbá. \r\nA kihűlt, sűrű pudingot keverd át, majd óvatos mozdulatokkal forgasd bele a tejszínhabot, hogy egy könnyű, légies krémet kapj. \r\nA kihűlt fánkok alján ejts egy pici vágást, és habzsák segítségével töltsd meg őket a krémmel.\r\nA tejszínt melegítsd fel egy kis lábasban (ne forrald!), majd törd bele az étcsokoládét. Kevergesd, amíg a csoki teljesen felolvad és a máz egyneművé válik. \r\nA megtöltött kis fánkokat halmozd egy gúlába egy tálon, majd bőségesen csorgasd le őket a langyos csokoládéöntettel.', 6, 3, 7, 450.00, 0),
(44, 'Egészben sült csirke', 'EgeszbenSultCsirke.webp', '01:30:00', 8, 30, 4, 'Első lépésként a konyhakész egész csirkét alaposan tisztítsd meg, majd papírtörlővel töröld teljesen szárazra – a száraz bőr a titka a ropogósságnak.\r\nA csirke külsejét és a belsejét is alaposan dörzsöld be sóval és borssal. Készítsd el a fűszervajat: a szobahőmérsékletű vajat keverd el az apróra vágott metélőhagymával\r\n(snidlinggel).\r\nA csirke mellénél óvatosan nyúlj a bőr alá az ujjaddal, képezz egy-egy zsebet a két oldalon, és egyenletesen töltsd be alájuk a fűszeres vajmasszát.\r\nA maradék vajat eloszlathatod a comboknál is. Végezetül vékonyan kend át a csirke külsejét olajjal, hogy a sütés során egyenletesen aranybarna színt kapjon.\r\nHelyezd a csirkét egy tepsibe vagy sütőrácsra. Told 180°C-ra előmelegített sütőbe, és süsd körülbelül 75–90 percig. A sült akkor tökéletes, ha a bőre mindenhol ropogós, a hús pedig teljesen átsült. \r\nHa rendelkezel maghőmérővel, ellenőrizd a csirkecomb legvastagabb részét: az étel akkor készült el, ha a belső hőmérséklet elérte a 80-85°C-ot.\r\nSzeletelés előtt hagyd a csirkét pihenni legalább 10 percig, hogy a nedvesség visszarendeződjön a rostok közé, így a hús szaftos marad.', 6, 3, 1, 520.00, 0),
(45, 'Lazac sütőben citrommal', 'LazacSutobenCitrommal.webp', '00:20:00', 8, 30, 2, 'A lazacot papírtörlővel töröld szárazra.\r\nSózd, borsozd, majd helyezz rá néhány vékony citromkarikát.\r\nTedd sütőpapírral bélelt tepsibe.\r\nSüsd 180°C-on 12–15 percig (a lazac ne száradjon ki, közepe maradjon szaftos).\r\nAzonnal tálald friss salátával vagy párolt zöldséggel.\r\n', 6, 3, 1, 450.00, 0),
(46, 'Sertésszűz baconbe tekerve', 'SertesszuzBaconbeTekerve.webp', '00:45:00', 8, 30, 2, 'A sertésszüzet tisztítsd meg a hártyáktól, majd töröld szárazra. Szórd meg egy kevés sóval és frissen őrölt borssal, de ügyelj a mennyiségre, mivel a bacon önmagában is jelentős mennyiségű sót tartalmaz. \r\nEgy vágódeszkán fektesd egymás mellé a baconcsíkokat úgy, hogy enyhén fedjék egymást, majd helyezd rájuk a húst.\r\nSzorosan tekerd fel a szüzet a szalonnacsíkokba, hogy a bacon mindenhol teljesen befedje a húst. \r\nHa szükséges, a végeit hústűvel vagy fogvájóval rögzítheted.\r\nHelyezd a betekert húst egy tepsibe vagy tűzálló tálba. \r\n180°C-ra előmelegített sütőben süsd 20–25 percig, amíg a bacon minden oldala pirosra és ropogósra nem sül. \r\nÜgyelj rá, hogy ne süsd túl, mert a sertésszűz akkor a legfinomabb, ha szaftos marad. \r\nMiután kivetted a sütőből, hagyd a húst 5 percig pihenni – ez kritikus lépés, hogy a nedvesség visszarendeződjön a rostok közé. \r\nCsak a pihentetés után szeleteld fel és tálald.\r\n', 6, 3, 1, 670.00, 0),
(47, 'Grillezett zöldségek', 'GrillezettZoldsegek.webp', '00:20:00', 8, 30, 2, 'Készítsd elő a zöldségeket: a cukkinit és a padlizsánt alaposan mosd meg, majd tetszés szerint karikázd fel vagy vágd hosszanti szeletekre. \r\nA kaliforniai paprikát magozd ki, és vágd nagyobb darabokra vagy széles csíkokra. \r\nEgy konyhai ecset segítségével a szeletek mindkét oldalát vékonyan kend meg olívaolajjal, majd ízlés szerint szórd meg őket egy kevés sóval.\r\nHevíts fel egy grillserpenyőt vagy készítsd elő a kerti grillt közepesen magas hőmérsékletre. \r\nHelyezd el a zöldségszeleteket a forró felületen, és süsd őket oldalanként körülbelül 3–5 percig. \r\nAkkor készültek el, ha a zöldségek már megpuhultak, és mindkét oldalukon láthatóvá válnak az étvágygerjesztő, sötétebb grillezési csíkok. \r\nÜgyelj rá, hogy ne süsd túl őket, maradjanak enyhén ropogósak. Azonnal, forrón tálald.', 1, 1, 10, 180.00, 0),
(48, 'Egyszerű tortalap vajkrémmel', 'PiskotaVajKremmel.webp', '01:00:00', 8, 25, 8, 'Első lépésként válaszd szét a tojásokat. A tojásfehérjékből verj kemény, stabil habot. \r\nEgy másik tálban a tojássárgájákat a kristálycukorral keverd fehéredésig és habosra, majd add hozzá a vanília aromát is. \r\nA felvert fehérjehabot óvatos mozdulatokkal, hogy a levegő ne törjön össze benne, forgasd hozzá a cukros sárgájához. \r\nVégezetül szitáld bele a lisztet, és lazán dolgozd el a masszát.\r\nA tésztát öntsd egy sütőpapírral bélelt tortaformába, és egyengesd el a tetejét.\r\nHelyezd 180°C-ra előmelegített sütőbe, és süsd 20–25 percig. \r\nA sütési idő vége felé végezz tűpróbát!\r\nHa a piskóta megsült, vedd ki a sütőből, és hagyd a formában pár percig, majd rácson hagyd teljesen kihűlni.\r\nMíg a piskóta hűl, készítsd el a krémet. A szobahőmérsékletű, puha vajat a porcukorral verd fehéredésig és nagyon habosra egy elektromos habverő segítségével, és tedd bele az aromát.\r\nAmikor a tortalap már teljesen kihűlt, vágd ketté (vagy tetszőleges rétegekre), töltsd meg a vajkrémmel, majd a maradék krémet használd fel a torta külső bevonására és díszítésére.', 6, 2, 7, 350.00, 0),
(49, 'Gyümölcsös piskótatorta', 'GyumolcsosTorta.webp', '00:45:00', 8, 25, 8, 'Első lépésként válaszd szét a tojásokat.\r\nA fehérjékből verj kemény és stabil habot. \r\nEgy másik tálban a tojássárgájákat a cukorral keverd fehéredésig és sűrűn habosra. \r\nA felvert fehérjehabot óvatos, alulról felfelé irányuló mozdulatokkal forgasd hozzá a sárgájához, ügyelve rá, hogy a hab ne törjön össze. \r\nVégezetül szitáld bele a lisztet, és lazán dolgozd el a masszát. \r\nA tésztát öntsd egy sütőpapírral bélelt tortaformába, és 180°C-ra előmelegített sütőben süsd 20–25 percig. \r\nHa kész, hagyd teljesen kihűlni.\r\nA jól lehűtött habtejszínt verd kemény habbá. \r\nA gyümölcsöket mosd meg, ha szükséges, hámozd meg és aprítsd fel kisebb darabokra. \r\nA kihűlt piskótát vízszintesen vágd két vagy három egyenlő lapra. \r\nAz alsó lapot kend meg egy réteg tejszínhabbal, szórj rá bőven a gyümölcsökből, majd helyezd rá a következő piskótalapot. \r\nIsmételd meg a folyamatot a rétegekkel. Végezetül a torta tetejét és oldalát is vond be a maradék tejszínhabbal, majd díszítsd ízlésesen a megmaradt gyümölcsdarabokkal.', 6, 2, 7, 320.00, 0),
(50, 'Vörösboros marharagu', 'VorosborosMarhaRagu.webp', '02:30:00', 9, 35, 4, 'A marhahúst (érdemes lábszárat vagy lapockát választani) tisztítsd meg az inaktól, majd vágd nagyjából 3-4 centiméteres kockákra. \r\nSzórd meg alaposan sóval és frissen őrölt borssal. \r\nEgy vastag falú lábasban hevítsd fel az étolajat, és magas hőmérsékleten pirítsd körbe a húskockákat. \r\nFontos, hogy ne zsúfold túl az edényt; inkább több részletben süsd ki, hogy a hús ne levet eresszen, hanem barna pörzsréteget kapjon.\r\nAmikor a hús körben megpirult, add hozzá a felaprított vöröshagymát, a felkockázott sárgarépát és zellergumót, valamint a szeletelt csiperkegombát.\r\nPirítsd a zöldségeket a hússal együtt 3–4 percig, amíg elkezdenek illatozni.\r\nEzután öntsd fel a vörösborral, és közepes lángon forrald 2–3 percig. \r\nEz segít abban, hogy a bor alkoholos nyerssége elpárologjon, de a gazdag aromája megmaradjon.\r\nÖnts a raguhoz annyi vizet (vagy marha alaplevet), amennyi éppen csak ellepi a hozzávalókat. \r\nFedd le a lábast, és a legalacsonyabb lángon, éppen csak gyöngyözve főzd körülbelül 2–2,5 órán keresztül.\r\nIdőnként keverd meg, és ha szükséges, pótold az elpárolgott folyadékot. \r\nA ragu akkor tökéletes, ha a hús villával érintve is omlik, a szaft pedig a zöldségektől és a kioldódott kollagéntől sűrű és bársonyos lesz.', 5, 3, 3, 620.00, 0),
(51, 'Töltött káposzta', 'Toltottkaposzta.webp', '02:00:00', 9, 35, 6, 'Egy tálban alaposan dolgozd össze a darált sertéshúst a rizzsel, ízesítsd sóval, borssal és pirospaprikával. \r\n(Aki szereti a szaftosabb állagot, egy kevés paradicsomlevet is adhat a masszához). \r\nA fejes káposzta torzsáját vágd ki, majd az egész fejet helyezd forrásban lévő vízbe. \r\nAhogy a külső levelek elkezdenek puhulni, egy csipesz vagy villa segítségével egyesével válaszd le őket. A levelek vastag főerét faragd le, majd halmozz a közepükre a húsos töltelékből, és szorosan tekercseld fel őket, a végeit pedig gyűrd be, hogy főzés közben ne nyíljanak szét.\r\nA savanyú káposztát kóstold meg: ha túl intenzívnek találod, hideg folyó víz alatt mosd át. \r\nEgy nagy, vastag falú lábas aljára terítsd el a savanyú káposzta felét. Erre helyezd rá szorosan egymás mellé a megtöltött káposztatekercseket. \r\nA maradék savanyú káposztát oszlasd el a tetejükön, majd öntsd fel annyi vízzel, amennyi éppen ellepi az egészet. \r\nFedő alatt, lassú tűzön (gyöngyözve) főzd 1,5–2 órán át. \r\nAz étel akkor készül el, amikor a rizs a töltelékek belsejében teljesen megpuhult, és a káposztalevelek is omlósak.', 5, 3, 3, 700.00, 0);
INSERT INTO `recept` (`ReceptID`, `Nev`, `Kep`, `ElkeszitesiIdo`, `NehezsegiSzintID`, `BegyujthetoPontok`, `Adag`, `Elkeszitesi_leiras`, `ElkeszitesiModID`, `ArkategoriaID`, `AlkategoriaID`, `Kaloria`, `Torolve`) VALUES
(52, 'Ropogós kacsacomb és kacsamell', 'SultKacsa.webp', '01:20:00', 9, 35, 2, 'A kacsacombokat alaposan tisztítsd meg, a felesleges tollmaradványokat távolítsd el, majd dörzsöld be őket bőségesen sóval és frissen őrölt borssal. \r\nHelyezd a combokat egy tepsibe, önts alájuk egy kevés vizet, és szorosan fedd le az edényt alufóliával. \r\nTedd 160°C-ra előmelegített sütőbe, és párold őket körülbelül 60 percig, amíg a hús teljesen omlóssá nem válik. \r\nAz utolsó fázisban vedd le a fóliát, emeld a hőmérsékletet, és süsd további 10-15 percig, amíg a bőr pirosra és ropogósra nem pirul.\r\nA kacsamellek bőrét éles késsel irdald be (vágd be négyzethálósan), ügyelve arra, hogy csak a zsiradékot vágd át, a húsba ne érjen bele a penge. \r\nSózd és borsozd a húst minden oldalán. Egy hideg serpenyőbe fektesd bele a melleket bőrrel lefelé, majd kezdd el hevíteni. \r\nÍgy a zsír szépen kisül a bőr alól, és az aranybarnára pirul körülbelül 5–6 perc alatt. \r\nFordítsd meg a húst, és süsd a másik oldalát további 2 percig, hogy belül szaftos és rozé maradjon.\r\nSzeletelés előtt a kacsamellet mindenképpen pihentesd deszkán legalább 5 percig, hogy a rostok ellazuljanak és a nedvesség megmaradjon a húsban. \r\nMajd tálald.', 6, 3, 1, 820.00, 0),
(53, 'Sajttal-sonkával töltött csirkemell bundában', 'SajttalToltottCsirkeMell.webp', '00:35:00', 9, 35, 2, 'A csirkemellet tisztítsd meg, majd vágd két nagyobb szeletre. \r\nEgy éles késsel vágj mély zsebet a szeletek oldalába, ügyelve arra, hogy a hús ne lyukadjon ki sehol, különben a sajt kifolyik sütés közben. \r\nA húst kívül-belül sózd és borsozd meg ízlés szerint. \r\nA sajt- és sonkaszeleteket hajtsd össze, és szorosan töltsd be a zsebekbe.\r\nHa szükséges, a nyílást fogvájóval rögzítheted a biztonság kedvéért.\r\nKészíts elő három tálat a panírozáshoz: az elsőbe tegyél lisztet, a másodikba a felvert, enyhén sózott tojásokat, a harmadikba pedig a zsemlemorzsát. \r\nA töltött melleket forgasd meg alaposan a lisztben, mártasd a tojásba, végül nyomkodd rájuk a zsemlemorzsát. \r\nEgy serpenyőben hevítsd fel az étolajat – akkor elég forró, ha egy csipet morzsát beleszórva az azonnal pezsegni kezd. \r\nKözepes lángon süsd a húsok mindkét oldalát aranybarnára (oldalanként kb. 6–8 perc), hogy a hús belül is átsüljön.\r\nA kész szeleteket papírtörlőn csepegtesd le, majd forrón tálald.', 8, 3, 1, 650.00, 0),
(54, 'Csokoládé mousse', 'CsokiMousse.webp', '00:20:00', 9, 30, 4, 'Első lépésként törd apró darabokra az étcsokoládét, és vízgőz felett, folyamatos kevergetés mellett olvaszd fel, majd vedd le a tűzről és hagyd pár percig hűlni (ne legyen forró, de maradjon folyékony). \r\nA tojásokat válaszd szét, és a sárgájákat egyenként, gyors mozdulatokkal keverd hozzá a meleg csokoládéhoz.A csipet sót is ekkor adhatod hozzá, hogy kiemelje a csokoládé mély ízét.\r\nA jól behűtött habtejszínt egy külön tálban verd lágy habbá a cukorral.\r\nÜgyelj rá, hogy ne verd túl keményre, maradjon krémes az állaga. \r\nA tejszínhabot két-három részletben, óvatos, alulról felfelé irányuló mozdulatokkal forgasd hozzá a csokoládés masszához. \r\nFontos, hogy ne keverd túl, mert a cél a levegős, habos textúra megőrzése.\r\nA kész krémet adagold csinos desszertes poharakba vagy tálkákba. \r\nHelyezd őket a hűtőbe legalább 2–3 órára, hogy a mousse kellően megdermedjen és az ízek összeérjenek. \r\nTálalás előtt közvetlenül díszítheted friss bogyós gyümölcsökkel (például málnával vagy eperrel), egy kevés extra tejszínhabbal vagy finomra reszelt csokoládéforgáccsal.', 2, 2, 8, 380.00, 0),
(55, 'Tarte au citron', 'TarteAuCitron.webp', '00:40:00', 9, 30, 8, 'Egy tálban keverd össze a lisztet, a sütőport, a sót és 100 g porcukrot. \r\nAdd hozzá a hideg, felkockázott vajat, és gyors mozdulatokkal morzsold el a lisztes keverékkel (ügyelj rá, hogy a kezed melegétől ne olvadjon meg a vaj).\r\nAdj hozzá egy tojást, és gyúrj belőle sima tésztát.\r\nFormázz belőle korongot, csomagold fóliába, és pihentesd a hűtőben legalább egy órát. \r\nEz a lépés elengedhetetlen ahhoz, hogy a tészta ne ugorjon össze sütés közben.\r\nA pihentetett tésztát enyhén lisztezett felületen nyújtsd ki, majd óvatosan fektesd egy piteformába. \r\nVágd le a felesleges széleket, az alját pedig szurkáld meg villával, hogy a gőz távozhasson. \r\nHelyezd 180°C-ra előmelegített sütőbe, és süsd elő 10 percig, amíg halvány aranyszínt kap.\r\nKeverd össze a frissen facsart citromlevet, a reszelt citromhéjat, a maradék porcukrot és a tojásokat, amíg egynemű masszát kapsz. \r\nAz elősütött tésztaformába öntsd bele a citromos keveréket, majd tedd vissza a sütőbe további 15-20 percre, amíg a krém szépen megszilárdul. \r\nA kész pitét hagyd teljesen kihűlni, mielőtt felszeletelnéd, hogy a krém állaga tökéletes legyen.', 6, 2, 7, 300.00, 0),
(56, 'Wellington bélszín', 'WellingtonBelszin.webp', '01:45:00', 10, 35, 4, 'A bélszínt tisztítsd meg az inaktól, majd alaposan sózd és borsozd meg. \r\nEgy füstölésig hevített serpenyőben, kevés olajon hirtelen süss kérget a hús minden oldalára (kb. 1-1 perc), hogy a szaftok belül maradjanak. \r\nMég melegen kend át vékonyan mustárral, majd hagyd teljesen kihűlni. \r\nKözben a gombát aprítsd szinte krémesre, és egy száraz serpenyőben addig pirítsd, amíg az összes nedvesség elpárolog belőle – ez kritikus lépés, hogy a tészta ne ázzon el később.\r\nEgy darab folpackra fektesd le egymás mellé a baconszeleteket úgy, hogy enyhén fedjék egymást. \r\nTerítsd el rajtuk egyenletesen a kihűlt gombapépet, majd helyezd a közepére a húst. \r\nA fólia segítségével szorosan tekerd fel az egészet, és a végeit megtekerve formázz belőle egy feszes hengert. \r\nTedd a hűtőbe 15-20 percre, hogy megtartsa a formáját. \r\nEzután a kinyújtott leveles tésztába csomagold bele a kicsomagolt hústekercset, a széleket gondosan zárd le, és kend le a felületét felvert tojással.\r\nHelyezd a tekercset egy tepsire. 200°C-ra előmelegített sütőben süsd 25–30 percig, amíg a tészta gyönyörű aranybarna nem lesz. \r\nEzzel a sütési idővel a hús belül tökéletes \"medium\" marad. Szeletelés előtt várj legalább 10 percet, hogy a hús rostjai ellazuljanak és a szaftok egyenletesen eloszoljanak a szeletekben.', 6, 3, 1, 720.00, 0),
(57, 'Sous-vide csirkemell', 'SousVideCsirke.webp', '01:10:00', 10, 35, 2, 'A csirkemellet tisztítsd meg, töröld szárazra, majd dörzsöld be sóval és borssal. \r\nHelyezd a húst egy vákuumtasakba az olívaolajjal együtt, majd vákuumozd le. \r\nHelyezd a tasakot a 65°C-os vízfürdőbe, és hagyd benne pontosan 60 percig. \r\nEz az alacsony, állandó hőmérséklet garantálja, hogy a hús szerkezete tökéletes legyen. \r\nMiután lejárt az idő, vedd ki a húst a tasakból, töröld szárazra a felületét, és egy füstölésig hevített serpenyőben mindkét oldalát pirítsd meg gyorsan (oldalanként kb. 1 perc), hogy szép aranybarna kérget kapjon.\r\nHagyományos elkészítés (Sous-vide gép nélkül):\r\nHa nem rendelkezel speciális géppel, a párolásos módszerrel is hasonlóan puha eredményt érhetsz el. \r\nA fűszerezett csirkemellet egy forró serpenyőben, kevés olajon hirtelen pirítsd elő 1-1 perc alatt. \r\nÖnts alá körülbelül 1–1,5 dl vizet, majd azonnal fedd le egy szorosan illeszkedő fedővel. \r\nAlacsony lángon párold 12–15 percig. \r\nA végén vedd le a fedőt, és magasabb lángon süsd le a maradék vizet, hogy a csirke felülete újra visszapiruljon.\r\nBármelyik módszert is választod, szeletelés előtt hagyd a húst 2–3 percig pihenni. Így a nedvesség nem távozik belőle azonnal a vágás mentén, és a hús szaftos marad a tálalásig.', 5, 1, 1, 240.00, 0),
(58, 'Vörösboros marhapofa pürével', 'VorosborosMarhaPofaKrumpliPurevel.webp', '03:20:00', 10, 35, 2, 'A marhapofát tisztítsd meg az inaktól (vagy kérd a hentest, hogy konyhakészen adja), majd töröld szárazra. \r\nAlaposan sózd és borsozd meg minden oldalán. \r\nEgy nehéz falú lábasban vagy serpenyőben hevítsd fel az étolajat, és magas hőmérsékleten süss kérget a hús minden oldalára. Ez a lépés elengedhetetlen a pörzsanyagok kialakulásához, amelyek a mártás alapízét adják majd.\r\nMiután a hús visszapirult, add hozzá a finomra vágott vöröshagymát, a felkockázott sárgarépát és a zellergumót. \r\nPirítsd a zöldségeket a hússal együtt néhány percig, amíg elkezdenek karamellizálódni.\r\nÖntsd fel a vörösborral és a vízzel (vagy alaplével), fedd le szorosan, és a legkisebb lángon főzd 2,5–3 órán keresztül. \r\nA hús akkor kész, ha a villa ellenállás nélkül hatol bele, és szinte magától szálaira omlik.\r\nMíg a hús párolódik, a burgonyát tisztítsd meg, kockázd fel, és sós vízben főzd teljesen puhára. Szűrd le, majd törd át krumplinyomón. \r\nDolgozd bele a vajat és fokozatosan a meleg tejet, amíg krémes, selymes állagot nem kapsz. \r\nA kész marhapofát emeld ki a szaftból, szeleteld fel vagy tépd nagyobb darabokra, majd kanalazd mellé a gazdag, sűrű zöldséges mártást és a burgonyapürét.', 5, 3, 3, 780.00, 0),
(59, 'Házi gnocchi', 'Gnocchi.webp', '00:45:00', 10, 35, 4, 'A burgonyát héjában főzd meg sós vízben, majd még melegen hámozd meg és törd át krumplinyomón. \r\nTerítsd szét egy felületen, és várd meg, amíg langyosra hűl (a gőz távozása fontos, hogy ne legyen túl vizes a tészta). \r\nAdd hozzá a tojást és a sót, majd kezdd el hozzáadni a lisztet. \r\nGyors mozdulatokkal gyúrj belőle lágy, de már nem ragadós, jól formázható tésztát. \r\nÜgyelj rá, hogy ne dolgozd ki túlságosan, mert a gnocchi gumiszerűvé válhat!\r\nA tésztát oszd több kisebb részre, és lisztezett felületen sodorj belőlük nagyjából ujjnyi vastagságú hengereket.\r\nEgy éles késsel vágd fel a hengereket 2 cm-es darabokra. \r\nA jellegzetes mintázathoz egy villa hátán görgesd végig a kis darabokat – ezek a barázdák segítenek majd abban, hogy a szósz jobban megtapadjon a gombócokon.\r\nEgy nagy lábasban forralj vizet bőséges sóval. \r\nAmikor a víz lobog, óvatosan tedd bele a gnocchikat. \r\nA főzési idő nagyon rövid: amint a gombócok feljönnek a víz felszínére (kb. 2–3 perc), szűrőkanállal azonnal emeld ki őket.', 4, 1, 3, 280.00, 0),
(60, 'Macaron', 'Macaron.webp', '01:00:00', 10, 30, 15, 'Kezdésként a mandulalisztet és a porcukrot szitáld össze egy tálba, hogy teljesen csomómentes és finom szemcséjű legyen. \r\nA tojásfehérjéket (érdemes szobahőmérsékletű, pihentetett tojást használni) verd habosra, majd fokozatosan adagold hozzá a kristálycukrot, amíg kemény és fényes habot nem kapsz. \r\nEkkor óvatos, de határozott mozdulatokkal forgasd bele a mandulás-cukros keveréket. \r\nItt dől el a macaron sorsa: a masszának \"szalagszerűen\" kell lefolynia a spatuláról. \r\nHa szeretnél színes süteményeket, az ételfestéket ebben a fázisban add hozzá.\r\nTöltsd a masszát sima csöves nyomózsákba, és nyomj apró, egyforma korongokat sütőpapírral vagy szilikonlappal bélelt tepsire. \r\nA tepsi alját ütögesd meg párszor az asztallaphoz, hogy a légbuborékok távozzanak. \r\nEzután jön a legfontosabb lépés: hagyd pihenni a korongokat 30–40 percig. \r\nAkkor jó, ha a tetejük már nem ragad, hanem \"bőrös\" tapintású. Süsd 150°C-on 12–14 percig. \r\nHa jól dolgoztál, a macaronoknak szép \"talpa\" lesz.\r\nMíg a héjak hűlnek, készítsd el a tölteléket: a puha vajat keverd ki a porcukorral, a tejjel és a vanília aromával, amíg sima krémet kapsz. \r\nA teljesen kihűlt macaronokat válogasd párba, majd egy-egy pötty krémmel ragaszd őket össze.', 6, 2, 7, 110.00, 0),
(61, 'Opera szelet', 'OperaSzelet.webp', '03:15:00', 10, 30, 8, 'Kezdésként a tojásokat a porcukorral és a mandulaliszttel verd fehéredésig és sűrűn habosra. Egy külön tálban a tojásfehérjékből a kristálycukorral készíts kemény, fényes habot. \r\nA két masszát óvatos mozdulatokkal forgasd össze, végül csorgasd hozzá az olvasztott vajat. \r\nA tésztát simítsd el vékonyan egy sütőpapírral bélelt nagy tepsiben, és 180°C-on süsd aranybarnára 8–10 perc alatt. \r\nMiután kihűlt, vágd három egyenlő téglalapra.\r\nA sziruphoz forrald össze a vizet a cukorral és az instant kávéval, majd hagyd teljesen kihűlni. \r\nA kávés vajkrémhez készíts cukorszirupot: a vizet és a cukrot főzd 118°C-ig. A tojássárgájákat verd habosra, és folyamatos keverés mellett lassan csorgasd hozzá a forró szirupot.\r\nAmikor a massza visszahűlt, dolgozd bele a puha vajat és egy kevés tömény kávét.\r\nA ganache-hoz a forró tejszínben olvaszd fel az aprított étcsokoládét, és keverd fényesre.\r\nHelyezd le az első piskótalapot, alaposan kend le a kávés sziruppal, majd oszd el rajta a kávés vajkrém felét.\r\nErre jön a második lap, amit szintén szirupozz meg, majd simítsd rá a csokoládé ganache-t. \r\nFedd le az utolsó piskótával, ezt is itasd át sziruppal, és zárd le a maradék vajkrémmel. \r\nA sütemény tetejére öntsd rá az olajjal fényesített olvasztott csokoládét.\r\nA kész süteményt tedd hűtőbe legalább 2 órára (de legjobb egy egész éjszakára), hogy a rétegek megdermedjenek és az ízek összeérjenek. \r\nSzeletelés előtt mártsd forró vízbe a kést, hogy szép, éles széleket kapj.', 6, 3, 7, 480.00, 0),
(62, 'Banánkenyér', '', '00:15:00', 1, 15, 4, 'A banánokat összenyomjuk, majd hozzáadjuk a többit és sütőbe tesszük.', 6, 1, 7, 350.00, 1),
(63, 'Banankenyer', '', '00:15:00', 1, 15, 4, 'gvdfg', 6, 1, 7, 5.00, 1),
(64, 'Bananos valami', '', '00:15:00', 1, 15, 15, 'fgayrafd', 6, 1, 7, 200.00, 1);

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
(1, 1, 2.00, 1),
(1, 5, 10.00, 2),
(1, 6, 1.00, 4),
(2, 1, 3.00, 1),
(2, 6, 1.00, 4),
(2, 8, 4.00, 3),
(3, 1, 2.00, 1),
(3, 5, 50.00, 2),
(3, 6, 1.00, 4),
(3, 14, 2.00, 1),
(4, 8, 10.00, 3),
(4, 9, 30.00, 3),
(4, 14, 2.00, 1),
(5, 10, 150.00, 3),
(5, 11, 100.00, 3),
(5, 12, 20.00, 3),
(6, 10, 150.00, 3),
(6, 12, 20.00, 3),
(6, 13, 40.00, 3),
(7, 1, 3.00, 1),
(7, 2, 240.00, 3),
(7, 3, 250.00, 2),
(7, 4, 30.00, 3),
(7, 5, 50.00, 2),
(7, 6, 1.00, 4),
(7, 7, 250.00, 2),
(8, 5, 45.00, 2),
(8, 6, 1.00, 4),
(8, 15, 300.00, 3),
(8, 16, 200.00, 3),
(8, 17, 250.00, 3),
(8, 18, 200.00, 3),
(8, 19, 150.00, 3),
(8, 20, 30.00, 3),
(8, 21, 2.00, 1),
(8, 22, 5.00, 3),
(8, 23, 3000.00, 2),
(9, 1, 6.00, 1),
(9, 2, 30.00, 3),
(9, 5, 30.00, 2),
(9, 6, 1.00, 4),
(9, 21, 2.00, 1),
(9, 23, 1500.00, 2),
(9, 24, 2.00, 3),
(9, 25, 5.00, 3),
(9, 26, 15.00, 2),
(10, 6, 15.00, 3),
(10, 15, 300.00, 3),
(10, 16, 200.00, 3),
(10, 17, 300.00, 3),
(10, 18, 300.00, 3),
(10, 19, 150.00, 3),
(10, 22, 5.00, 3),
(10, 23, 2300.00, 2),
(10, 27, 500.00, 3),
(10, 28, 250.00, 3),
(11, 2, 30.00, 3),
(11, 4, 45.00, 3),
(11, 5, 45.00, 2),
(11, 6, 5.00, 3),
(11, 19, 150.00, 3),
(11, 23, 300.00, 2),
(11, 29, 800.00, 2),
(11, 30, 20.00, 3),
(11, 31, 200.00, 3),
(12, 6, 1.00, 3),
(12, 8, 100.00, 3),
(12, 32, 200.00, 3),
(12, 33, 400.00, 2),
(12, 34, 30.00, 3),
(12, 35, 8.00, 3),
(12, 36, 20.00, 3),
(12, 37, 100.00, 3),
(13, 1, 3.00, 1),
(13, 34, 50.00, 3),
(13, 35, 8.00, 3),
(13, 36, 10.00, 3),
(13, 37, 500.00, 3),
(13, 38, 225.00, 3),
(13, 39, 200.00, 2),
(13, 40, 30.00, 2),
(14, 6, 1.00, 4),
(14, 14, 40.00, 3),
(14, 41, 400.00, 3),
(14, 42, 200.00, 3),
(14, 43, 100.00, 2),
(15, 6, 1.00, 4),
(15, 19, 150.00, 3),
(15, 43, 100.00, 2),
(15, 44, 600.00, 3),
(15, 45, 40.00, 3),
(16, 4, 12.00, 3),
(16, 6, 1.00, 4),
(16, 29, 700.00, 2),
(16, 43, 100.00, 2),
(17, 6, 1.00, 4),
(17, 18, 300.00, 3),
(17, 42, 200.00, 3),
(17, 43, 100.00, 2),
(17, 46, 30.00, 3),
(18, 1, 6.00, 1),
(18, 2, 150.00, 3),
(18, 4, 150.00, 3),
(19, 1, 6.00, 1),
(19, 2, 150.00, 3),
(19, 4, 150.00, 3),
(19, 9, 200.00, 3),
(20, 5, 15.00, 2),
(20, 6, 1.00, 4),
(20, 41, 200.00, 3),
(20, 47, 250.00, 3),
(20, 48, 200.00, 3),
(20, 49, 1.00, 4),
(21, 1, 1.00, 1),
(21, 2, 30.00, 3),
(21, 6, 1.00, 4),
(21, 49, 1.00, 4),
(21, 50, 140.00, 3),
(21, 51, 40.00, 3),
(21, 52, 250.00, 2),
(21, 53, 120.00, 3),
(21, 54, 100.00, 2),
(21, 55, 30.00, 3),
(21, 56, 25.00, 3),
(22, 5, 15.00, 2),
(22, 6, 1.00, 4),
(22, 43, 100.00, 2),
(22, 47, 300.00, 3),
(22, 49, 1.00, 4),
(22, 57, 200.00, 3),
(22, 58, 150.00, 3),
(23, 6, 1.00, 4),
(23, 15, 200.00, 3),
(23, 23, 200.00, 2),
(23, 41, 200.00, 3),
(23, 59, 200.00, 3),
(24, 1, 2.00, 1),
(24, 2, 300.00, 3),
(24, 3, 200.00, 2),
(24, 4, 150.00, 3),
(24, 5, 100.00, 2),
(24, 60, 18.00, 3),
(24, 61, 150.00, 3),
(25, 1, 1.00, 1),
(25, 2, 60.00, 3),
(25, 3, 30.00, 2),
(25, 4, 45.00, 3),
(25, 5, 30.00, 2),
(25, 36, 20.00, 3),
(25, 60, 1.00, 3),
(26, 1, 2.00, 1),
(26, 2, 50.00, 3),
(26, 3, 100.00, 2),
(26, 6, 8.00, 3),
(26, 8, 40.00, 3),
(26, 42, 650.00, 3),
(26, 50, 300.00, 3),
(26, 51, 90.00, 3),
(26, 52, 1000.00, 2),
(27, 1, 4.00, 1),
(27, 6, 5.00, 3),
(27, 19, 100.00, 3),
(27, 42, 900.00, 3),
(27, 62, 100.00, 3),
(28, 6, 1.00, 4),
(28, 19, 150.00, 3),
(28, 49, 1.00, 4),
(28, 53, 250.00, 3),
(28, 54, 400.00, 2),
(28, 64, 400.00, 3),
(28, 65, 10.00, 3),
(29, 1, 1.00, 1),
(29, 2, 30.00, 3),
(29, 3, 300.00, 2),
(29, 6, 5.00, 3),
(29, 14, 50.00, 3),
(29, 19, 80.00, 3),
(29, 23, 200.00, 2),
(29, 25, 2.00, 3),
(29, 51, 30.00, 3),
(29, 52, 400.00, 2),
(29, 64, 250.00, 3),
(29, 65, 5.00, 3),
(29, 80, 500.00, 3),
(30, 3, 500.00, 2),
(30, 4, 30.00, 3),
(30, 33, 200.00, 2),
(30, 38, 80.00, 3),
(30, 66, 40.00, 3),
(31, 1, 1.00, 1),
(31, 2, 300.00, 3),
(31, 4, 40.00, 3),
(31, 6, 1.00, 3),
(31, 8, 150.00, 3),
(31, 32, 20.00, 3),
(31, 34, 100.00, 3),
(31, 60, 6.00, 3),
(31, 67, 850.00, 3),
(31, 68, 3.00, 3),
(32, 1, 2.00, 1),
(32, 2, 300.00, 3),
(32, 5, 30.00, 2),
(32, 6, 8.00, 3),
(32, 19, 300.00, 3),
(32, 23, 1400.00, 2),
(32, 25, 15.00, 3),
(32, 69, 600.00, 3),
(33, 1, 2.00, 1),
(33, 2, 300.00, 3),
(33, 6, 11.00, 3),
(33, 19, 250.00, 3),
(33, 23, 350.00, 2),
(33, 25, 30.00, 3),
(33, 47, 1100.00, 3),
(33, 49, 2.00, 3),
(33, 52, 30.00, 2),
(33, 63, 300.00, 3),
(34, 1, 2.00, 1),
(34, 2, 240.00, 3),
(34, 3, 250.00, 2),
(34, 5, 65.00, 2),
(34, 6, 6.00, 3),
(34, 7, 250.00, 2),
(34, 19, 150.00, 3),
(34, 23, 200.00, 2),
(34, 25, 5.00, 3),
(34, 49, 2.00, 3),
(34, 63, 100.00, 3),
(34, 64, 250.00, 3),
(35, 5, 20.00, 2),
(35, 6, 5.00, 3),
(35, 19, 150.00, 3),
(35, 23, 30.00, 2),
(35, 49, 2.00, 3),
(35, 50, 500.00, 3),
(35, 70, 150.00, 3),
(35, 72, 150.00, 3),
(35, 85, 120.00, 3),
(36, 2, 250.00, 3),
(36, 6, 1.00, 3),
(36, 8, 150.00, 3),
(36, 9, 120.00, 3),
(36, 34, 100.00, 3),
(37, 1, 4.00, 1),
(37, 2, 700.00, 3),
(37, 3, 150.00, 2),
(37, 8, 100.00, 3),
(37, 12, 200.00, 3),
(37, 34, 450.00, 3),
(37, 68, 5.00, 3),
(38, 5, 20.00, 2),
(38, 6, 1.00, 4),
(38, 15, 200.00, 3),
(38, 16, 150.00, 3),
(38, 19, 150.00, 3),
(38, 23, 1700.00, 2),
(38, 25, 15.00, 3),
(38, 42, 300.00, 3),
(38, 49, 1.00, 4),
(38, 69, 400.00, 3),
(39, 5, 50.00, 2),
(39, 6, 1.00, 4),
(39, 42, 600.00, 3),
(39, 49, 1.00, 4),
(39, 50, 500.00, 3),
(39, 65, 10.00, 3),
(40, 6, 1.00, 4),
(40, 49, 1.00, 4),
(40, 71, 80.00, 3),
(40, 73, 2.00, 1),
(40, 74, 50.00, 3),
(40, 75, 50.00, 3),
(41, 5, 20.00, 2),
(41, 6, 1.00, 4),
(41, 19, 300.00, 3),
(41, 49, 1.00, 4),
(41, 69, 300.00, 3),
(42, 1, 4.00, 1),
(42, 2, 120.00, 3),
(42, 3, 400.00, 2),
(42, 8, 100.00, 3),
(42, 23, 200.00, 2),
(42, 33, 200.00, 2),
(42, 66, 40.00, 3),
(43, 1, 4.00, 1),
(43, 2, 150.00, 3),
(43, 3, 400.00, 2),
(43, 4, 30.00, 3),
(43, 6, 1.00, 3),
(43, 8, 100.00, 3),
(43, 23, 250.00, 2),
(43, 33, 300.00, 2),
(43, 66, 40.00, 3),
(43, 77, 100.00, 3),
(44, 5, 20.00, 2),
(44, 6, 15.00, 3),
(44, 8, 250.00, 3),
(44, 49, 10.00, 3),
(44, 78, 1.00, 4),
(44, 79, 20.00, 3),
(45, 6, 5.00, 3),
(45, 49, 2.00, 3),
(45, 81, 300.00, 3),
(45, 82, 60.00, 3),
(46, 6, 5.00, 3),
(46, 45, 180.00, 3),
(46, 49, 2.00, 3),
(46, 83, 400.00, 3),
(47, 6, 1.00, 4),
(47, 84, 300.00, 3),
(47, 85, 200.00, 3),
(47, 86, 250.00, 3),
(47, 87, 15.00, 2),
(48, 1, 6.00, 1),
(48, 2, 120.00, 3),
(48, 4, 120.00, 3),
(48, 8, 200.00, 3),
(48, 34, 150.00, 3),
(48, 88, 5.00, 2),
(49, 1, 6.00, 1),
(49, 2, 120.00, 3),
(49, 4, 120.00, 3),
(49, 11, 250.00, 3),
(49, 33, 300.00, 2),
(50, 6, 1.00, 4),
(50, 15, 100.00, 3),
(50, 18, 100.00, 3),
(50, 19, 150.00, 3),
(50, 23, 500.00, 2),
(50, 49, 1.00, 4),
(50, 52, 20.00, 2),
(50, 69, 600.00, 3),
(50, 89, 100.00, 2),
(50, 90, 200.00, 3),
(51, 6, 1.00, 4),
(51, 23, 1500.00, 2),
(51, 25, 5.00, 3),
(51, 48, 100.00, 3),
(51, 49, 1.00, 4),
(51, 91, 500.00, 3),
(51, 92, 1200.00, 3),
(51, 93, 600.00, 3),
(52, 6, 1.00, 4),
(52, 49, 1.00, 4),
(52, 94, 700.00, 3),
(52, 95, 600.00, 3),
(53, 1, 2.00, 1),
(53, 2, 50.00, 3),
(53, 6, 1.00, 4),
(53, 47, 400.00, 3),
(53, 49, 1.00, 4),
(53, 51, 80.00, 3),
(53, 52, 300.00, 2),
(53, 55, 40.00, 3),
(53, 56, 60.00, 3),
(54, 1, 3.00, 1),
(54, 4, 90.00, 3),
(54, 6, 1.00, 3),
(54, 33, 250.00, 2),
(54, 77, 300.00, 3),
(55, 1, 5.00, 1),
(55, 2, 300.00, 3),
(55, 6, 1.00, 3),
(55, 8, 400.00, 3),
(55, 34, 340.00, 3),
(55, 60, 8.00, 3),
(55, 82, 275.00, 2),
(55, 96, 20.00, 3),
(56, 1, 1.00, 1),
(56, 6, 1.00, 4),
(56, 45, 180.00, 3),
(56, 49, 1.00, 4),
(56, 52, 15.00, 2),
(56, 90, 200.00, 3),
(56, 97, 500.00, 3),
(56, 101, 15.00, 3),
(56, 105, 275.00, 3),
(57, 6, 3.00, 3),
(57, 47, 300.00, 3),
(57, 49, 1.00, 3),
(57, 87, 15.00, 2),
(58, 3, 100.00, 2),
(58, 6, 1.00, 4),
(58, 8, 30.00, 3),
(58, 15, 100.00, 3),
(58, 18, 80.00, 3),
(58, 19, 150.00, 3),
(58, 23, 200.00, 2),
(58, 42, 500.00, 3),
(58, 49, 1.00, 4),
(58, 52, 30.00, 2),
(58, 89, 200.00, 2),
(58, 98, 600.00, 3),
(59, 1, 1.00, 1),
(59, 2, 150.00, 3),
(59, 6, 5.00, 3),
(59, 42, 500.00, 3),
(60, 1, 90.00, 3),
(60, 3, 15.00, 2),
(60, 4, 50.00, 3),
(60, 8, 100.00, 3),
(60, 34, 200.00, 3),
(60, 88, 2.00, 2),
(60, 99, 100.00, 3),
(61, 1, 6.00, 1),
(61, 4, 80.00, 3),
(61, 8, 180.00, 3),
(61, 23, 130.00, 2),
(61, 33, 100.00, 2),
(61, 34, 150.00, 3),
(61, 52, 30.00, 2),
(61, 77, 200.00, 3),
(61, 99, 100.00, 3),
(61, 100, 5.00, 3),
(62, 4, 150.00, 3),
(63, 4, 100.00, 3),
(64, 4, 100.00, 3);

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
  MODIFY `FelhasznaloID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT a táblához `hozzavalo`
--
ALTER TABLE `hozzavalo`
  MODIFY `HozzavaloID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT a táblához `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `KategoriaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `konyhaifelszereles`
--
ALTER TABLE `konyhaifelszereles`
  MODIFY `KonyhaiFelszerelesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

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
  MODIFY `OrszagID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT a táblához `recept`
--
ALTER TABLE `recept`
  MODIFY `ReceptID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

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
