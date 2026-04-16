# CookQuest

<div align="center">

## Receptek, keresés, profil és admin egy helyen

![Státusz](https://img.shields.io/badge/st%C3%A1tusz-akt%C3%ADv%20fejleszt%C3%A9s-2ea44f?style=for-the-badge)
![PHP](https://img.shields.io/badge/PHP-8%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6%2B-F7DF1E?style=for-the-badge&logo=javascript&logoColor=111)
![MySQL](https://img.shields.io/badge/MySQL-8%2B-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![XAMPP](https://img.shields.io/badge/XAMPP-aj%C3%A1nlott-FB7A24?style=for-the-badge&logo=xampp&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

[![Skill Icons](https://skillicons.dev/icons?i=php,js,html,css,mysql,bootstrap,git,github,vscode)](https://skillicons.dev)

</div>

## Tartalomjegyzék

- [Projekt áttekintés](#projekt-áttekintés)
- [Fő funkciók](#fő-funkciók)
- [Technológiai stack](#technológiai-stack)
- [Rendszerkövetelmények](#rendszerkövetelmények)
- [Telepítés lépésről lépésre](#telepítés-lépésről-lépésre)
- [Futtatás helyi környezetben](#futtatás-helyi-környezetben)
- [Mappastruktúra](#mappastruktúra)
- [API végpontok áttekintése](#api-végpontok-áttekintése)
- [Admin felület moduljai](#admin-felület-moduljai)
- [Felhasználói folyamatok](#felhasználói-folyamatok)
- [Biztonság és jogosultságok](#biztonság-és-jogosultságok)
- [Fejlesztői útmutató](#fejlesztői-útmutató)
- [Hibakeresés](#hibakeresés)
- [Roadmap](#roadmap)
- [Közreműködés](#közreműködés)
- [Kapcsolat](#kapcsolat)

## Projekt áttekintés

A CookQuest egy többmodulos, PHP alapú webalkalmazás, amelynek célja, hogy:

- receptek böngészését és keresését biztosítsa,
- felhasználói profilkezelést adjon,
- admin oldali tartalomkezelést tegyen lehetővé,
- külön API rétegen keresztül kezelje a fontos műveleteket (pl. bejelentkezés, regisztráció, profil adatok, keresés).

A projekt felépítése vegyes: a szerveroldali logika PHP fájlokban található, a kliens oldali interaktivitás JavaScript kontrollerekkel valósul meg, a felület pedig klasszikus nézetfájlokra és layout elemekre épül.

## Fő funkciók

### Nyilvános funkciók

- receptlista és receptrészletek megjelenítése,
- kategória- és szűrőalapú keresés,
- konyhai eszközök és hozzávaló adatok kezelése,
- kapcsolat oldal.

### Felhasználói funkciók

- regisztráció és bejelentkezés,
- profiladatok lekérése és frissítése,
- profilkép feltöltés,
- személyes recept/interakció folyamatok.

### Admin funkciók

- felhasználó menedzsment,
- recept menedzsment,
- receptkategóriák menedzsment,
- hozzávalók menedzsment,
- konyhai eszközök menedzsment,
- ország és szerepkör jellegű törzsadat kezelés.

## Technológiai stack

### Backend

- PHP
- MySQL
- saját API végpontok a api mappában

### Frontend

- HTML5
- CSS3
- JavaScript (moduláris controller fájlok)
- Bootstrap alapú komponensek

### Fejlesztői eszközök

- Git és GitHub verziókezelés
- VS Code fejlesztői környezet
- XAMPP helyi futtatási környezet (Apache + MySQL)

## Rendszerkövetelmények

- Windows, Linux vagy macOS
- Apache webszerver
- PHP 8+ ajánlott
- MySQL/MariaDB adatbázis
- böngésző (Chrome/Edge/Firefox)

## Telepítés lépésről lépésre

### 1. Projekt klónozása

```bash
git clone <repository-url>
```

### 2. Projekt elhelyezése XAMPP alatt

Másold vagy klónozd a projektet a htdocs mappába:

```text
c:/xampp/htdocs/CookQuest
```

### 3. Apache és MySQL indítása

XAMPP Control Panelben indítsd el:

- Apache
- MySQL

### 4. Adatbázis importálása

1. Nyisd meg a phpMyAdmin felületet.
2. Hozz létre egy új adatbázist (pl. cookquest).
3. Importáld az SQL fájl(oka)t az assets/sql mappából.

### 5. Adatbázis kapcsolat ellenőrzése

Ellenőrizd és szükség esetén módosítsd az adatbázis kapcsolati beállításokat:

- api/adatbazis.php

Ha a projektben több kapcsolati réteg van, akkor ellenőrizd a kapcsolódó konfigurációs fájlokat is.

## Futtatás helyi környezetben

Az alkalmazás alapértelmezett belépési pontja:

```text
http://localhost/CookQuest/
```

Fontos oldalak:

- Főoldal: /index.php
- Keresés: /kereses.php
- Kapcsolat: /kapcsolat.php
- Admin irányítópult: /admin/iranyitopult.php

## Mappastruktúra

Röviden a fontosabb modulok:

- admin/
	- admin felület és almodulok (felhasználó, recept, eszköz, kategória, hozzávaló stb.)
- api/
	- hitelesítés, profil, keresés és recepttel kapcsolatos végpontok
- assets/
	- statikus tartalmak (css, js, képek, sql)
- controller/
	- szerver- és kliensoldali vezérlőfájlok
- services/
	- üzleti logika (pl. szintezés)
- views/
	- újrahasználható nézetek és résznézetek

## API végpontok áttekintése

Az api mappában több, közvetlenül hívható végpont található. Néhány példa:

- api/bejelentkezes.php
- api/regisztracio.php
- api/kijelentkezes.php
- api/profilAdat.php
- api/profilKepFeltoltes.php
- api/kereses.php
- api/felhasznalonevValtoztatas.php
- api/recept_teljesit.php

Javaslat: ha külső kliens is használja ezeket, érdemes egységes JSON válaszsémát és központi hibakezelést bevezetni.

## Admin felület moduljai

Az admin mappa külön almodulokra bontva tartalmazza a kezelőfelületet:

- felhasznaloAdmin
- receptAdmin
- receptKategoriakAdmin
- hozzavalokAdmin
- eszkozAdmin
- eszkozKategoriakAdmin
- orszagAdmin

Minden modulnál megtalálható a lista, létrehozás, módosítás, törlés és visszaállítás jellegű működés.

## Felhasználói folyamatok

Tipikus felhasználói útvonal:

1. Regisztráció
2. Bejelentkezés
3. Profil megtekintése/módosítása
4. Receptek keresése és böngészése
5. Kijelentkezés

## Biztonság és jogosultságok

Ajánlott minimumok éles környezethez:

- szerveroldali input validáció minden POST/GET paraméterre,
- SQL injection elleni védelem prepared statementekkel,
- jelszavak biztonságos hash-elése,
- session kezelés megerősítése,
- jogosultság-ellenőrzés minden admin végpont előtt,
- feltöltött fájlok típus- és méretellenőrzése.

## Fejlesztői útmutató

### Ajánlott branch stratégia

- main: stabil ág
- feat/*: új funkció
- fix/*: hibajavítás

### Commit minta

```text
feat(admin): új recept kategória szűrő hozzáadása
fix(api): profilkép feltöltés MIME ellenőrzés javítása
```

### Kódolási javaslatok

- törekedj moduláris controller logikára,
- kerüld a duplikált SQL lekérdezéseket,
- használd újra a közös layout elemeket,
- API válaszoknál tarts egységes kulcselnevezést.

## Hibakeresés

### Gyakori problémák

1. 500-as hibaoldal
	 - Ellenőrizd a PHP error logot és az include útvonalakat.
2. Adatbázis csatlakozási hiba
	 - Ellenőrizd az api/adatbazis.php hitelesítő adatait.
3. Üres admin lista
	 - Vizsgáld meg, hogy az adott admin controller megfelelően tölti-e be a rekordokat.
4. Session alapú jogosultsági hiba
	 - Ellenőrizd, hogy a session indul-e minden szükséges belépési ponton.

## Roadmap

- egységes API válaszformátum kialakítása,
- központi auth middleware bevezetése,
- automatizált tesztelés (unit + integráció),
- teljesítményoptimalizálás (cache, lekérdezés-optimalizálás),
- dokumentált OpenAPI specifikáció létrehozása.

## Közreműködés

1. Forkold a repót.
2. Hozz létre feature ágat.
3. Készíts értelmes commitokat.
4. Nyiss pull requestet rövid, de pontos leírással.

## Kapcsolat

Ha kérdésed vagy ötleted van a projekttel kapcsolatban:

- nyiss issue-t a repóban,
- vagy vedd fel a kapcsolatot a projekt karbantartójával.

---
