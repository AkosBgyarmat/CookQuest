<?php

require_once __DIR__ . '/HutoTarolo.php';
require_once __DIR__ . '/../services/SzintezesService.php';

// HutoVezerlo:
// A hutom oldal vezérlője, ami a kérés feldolgozását és a view adatok előkészítését végzi.
class HutoVezerlo
{
    private HutoTarolo $hutoTarolo;

    public function __construct(private PDO $pdo)
    {
        // A tároló réteg végzi az adatbázis műveleteket.
        $this->hutoTarolo = new HutoTarolo($pdo);
    }

    private function alapViewData(): array
    {
        // A view alapértelmezett változói, hogy mindig stabil szerkezetet kapjon a nézet.
        return [
            'osszesHozzavalo' => [],
            'szurtReceptek' => [],
            'kivalasztott' => [],
            'kivalasztottSet' => [],
            'minMatch' => 3,
            'receptHozzavalok' => [],
            'keresesTortent' => false,
            'sessionFelhasznaloId' => 0,
            'aktualisSzint' => 1,
        ];
    }

    // Kinyeri a bejelentkezett felhasználó ID-ját a sessionből.
    private function getSessionFelhasznaloId(): int
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        return (int)($_SESSION['felhasznalo_id']
            ?? $_SESSION['FelhasznaloID']
            ?? ($_SESSION['user']['FelhasznaloID'] ?? 0)
        );
    }

    private function tisztitottHozzavaloIdk(array $hozzavaloIdk): array
    {
        // Csak pozitív egész ID-k maradnak meg, duplikációk nélkül.
        $eredmeny = [];
        foreach ($hozzavaloIdk as $id) {
            $szam = (int)$id;
            if ($szam > 0) {
                $eredmeny[] = $szam;
            }
        }

        return array_values(array_unique($eredmeny));
    }

    public function kezeles(): array
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        // 1) Alap view adatok + összes hozzávaló lekérése a checkbox listához.
        $viewData = $this->alapViewData();
        $viewData['osszesHozzavalo'] = $this->hutoTarolo->osszesHozzavalo();

        $felhasznaloId = $this->getSessionFelhasznaloId();
        $viewData['sessionFelhasznaloId'] = $felhasznaloId;

        if ($felhasznaloId > 0) {
            $szintezes = new SzintezesService($this->pdo);
            $progress = $szintezes->getProgress($felhasznaloId);
            $viewData['aktualisSzint'] = (int)($progress['aktualisSzint'] ?? 1);
        }

        // 2) POST állapot és a minimum egyezés beolvasása.
        $viewData['keresesTortent'] = ($_SERVER['REQUEST_METHOD'] === 'POST');
        $viewData['minMatch'] = isset($_POST['minMatch']) ? max(1, (int)$_POST['minMatch']) : 3;

        // Ha még nincs keresés, csak az alapnézetet adjuk vissza.
        if (!$viewData['keresesTortent']) {
            return $viewData;
        }

        // 3) Kiválasztott hozzávaló ID-k tisztítása és set építése gyors ellenőrzéshez.
        $viewData['kivalasztott'] = $this->tisztitottHozzavaloIdk($_POST['hozzavalok'] ?? []);
        $viewData['kivalasztottSet'] = array_flip($viewData['kivalasztott']);

        // Ha POST volt, de nincs kiválasztott hozzávaló, üres találati listával térünk vissza.
        if (empty($viewData['kivalasztott'])) {
            return $viewData;
        }

        // 4) Találati receptek lekérése a minimum egyezés alapján.
        $viewData['szurtReceptek'] = $this->hutoTarolo->szurtReceptek($viewData['kivalasztott'], $viewData['minMatch']);

        // 5) A találati receptekhez betöltjük az összes hozzávalót (megvan/hiányzik jelöléshez a view-ban).
        if (!empty($viewData['szurtReceptek'])) {
            $receptIdk = array_map(
                static fn(array $recept): int => (int)$recept['ReceptID'],
                $viewData['szurtReceptek']
            );
            $viewData['receptHozzavalok'] = $this->hutoTarolo->receptHozzavalokByReceptek($receptIdk);
        }

        // 6) A view számára minden előkészített adat visszaadása.
        return $viewData;
    }
}
