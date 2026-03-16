<?php
require_once __DIR__ . '/ReceptTarolo.php';
require_once __DIR__ . '/FelhasznaloTarolo.php';
require_once __DIR__ . '/FelhasznaloReceptTarolo.php';
require_once __DIR__ . '/../services/SzintezesService.php';

// Ez az osztály fogja össze a receptek oldal teljes működését
// (lista, recept-részletek, "elkészítettem" mentés, szintezés, jogosultságok).
class ReceptekVezerlo
{
    private ReceptTarolo $receptTarolo;
    private FelhasznaloTarolo $felhasznaloTarolo;
    private FelhasznaloReceptTarolo $felhasznaloReceptTarolo;

    public function __construct(private PDO $pdo)
    {
        // Tároló objektumok példányosítása, hogy az adatbázis-műveletek külön helyen legyenek.
        $this->receptTarolo = new ReceptTarolo($pdo);
        $this->felhasznaloTarolo = new FelhasznaloTarolo($pdo);
        $this->felhasznaloReceptTarolo = new FelhasznaloReceptTarolo($pdo);
    }

    // Innen kapja a nezet az alap view valtozokat.
    // A bontas soran ezt a default-adatlogikat a receptek view-bol tettuk at ide.
    private function alapViewData(): array
    {
        return [
            'receptId' => 0,
            'felhasznaloId' => 0,
            'sessionFelhasznaloId' => 0,
            'aktualisPontok' => null,
            'receptekSzintekSzerint' => [],
            'kategoriaCheckboxok' => [],
            'recept' => null,
            'hozzavalok' => [],
            'marElkeszitette' => false,
            'progress' => null,
            'aktualisSzint' => 1,
            'teljesitettSet' => [],
            'detailStatus' => null,
            'szintLepett' => false,
        ];
    }

    // Kinyeri a bejelentkezett felhasználó ID-ját a sessionből.
    // Több kulcsot is ellenőriz, hogy kompatibilis legyen a régebbi session struktúrával is.
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

    // Egységes átirányítás státuszkóddal/query paraméterekkel.
    // A PRG (Post/Redirect/Get) minta miatt a POST után mindig GET oldalra irányít.
    private function atiranyitStatuszal(int $receptId, string $status, array $extra = []): never
    {
        $params = $extra;
        if ($receptId > 0) $params['id'] = $receptId;
        if ($status !== '') $params['status'] = $status;

        $qs = http_build_query($params);
        header("Location: receptek.php" . ($qs ? "?{$qs}" : ""));
        exit;
    }

    // Lekéri egy recept nehézségi szintjét (ha nincs recept, 0-val tér vissza).
    private function getReceptSzint(int $receptId): int
    {
        $st = $this->pdo->prepare("SELECT NehezsegiSzintID FROM recept WHERE ReceptID = :rid");
        $st->execute([':rid' => $receptId]);
        $szint = $st->fetchColumn();
        return $szint !== false ? (int)$szint : 0;
    }

    // A recept-detail visszajelzo uzenet mar nem a view-ban epul fel.
    // A bontas soran a status normalizalast ide mozgattuk.
    private function detailStatusUzenet(?string $status, int $need = 0): ?array
    {
        if ($status === null || $status === '') {
            return null;
        }

        $map = [
            'ok' => ['bg-green-100 text-green-800', '✅ Pont jóváírva!'],
            'already' => ['bg-yellow-100 text-yellow-800', '⚠️ Ezt már jóváírtuk.'],
            'login' => ['bg-red-100 text-red-800', '❌ Jelentkezz be a pontokért.'],
            'csrf' => ['bg-red-100 text-red-800', '❌ CSRF hiba.'],
        ];

        if ($status === 'locked') {
            return ['bg-red-100 text-red-800', '🔒 Zárolt recept. Előbb érd el a(z) ' . $need . '. szintet.'];
        }

        if (isset($map[$status])) {
            return $map[$status];
        }

        return ['bg-red-100 text-red-800', '❌ Hiba: ' . htmlspecialchars($status)];
    }

    // A szintlepes-detektalas is ide kerult a view-bol, hogy a nezet csak kirajzoljon.
    private function szintLepesDetektalasEsSessionFrissites(int $felhasznaloId, int $aktualisSzint): bool
    {
        if ($felhasznaloId <= 0) {
            return false;
        }

        $szintLepett = false;
        if (isset($_GET['status']) && $_GET['status'] === 'ok') {
            $regisztraltSzint = (int)($_SESSION['elozo_szint'] ?? 1);
            if ($aktualisSzint > $regisztraltSzint) {
                $szintLepett = true;
            }
        }

        $_SESSION['elozo_szint'] = $aktualisSzint;
        return $szintLepett;
    }

    // A vezérlő fő metódusa:
    // - feldolgozza a kérés(eke)t
    // - validálja a jogosultságot / szintezést
    // - előkészíti a nézethez szükséges összes adatot
    public function kezeles(): array
    {
        $viewData = $this->alapViewData();

        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $receptId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $felhasznaloId = $this->getSessionFelhasznaloId();
        $viewData['sessionFelhasznaloId'] = $felhasznaloId;

        $szintezes = new SzintezesService($this->pdo);

        // Szintezés adatok (list UI-hoz is)
        $progress = null;
        $aktualisSzint = 1;
        $teljesitettSet = [];

        if ($felhasznaloId > 0) {
            $progress = $szintezes->getProgress($felhasznaloId);
            $aktualisSzint = (int)$progress['aktualisSzint'];
            $teljesitettSet = $szintezes->getTeljesitettReceptIdSet($felhasznaloId);
        }

        $viewData['detailStatus'] = $this->detailStatusUzenet($_GET['status'] ?? null, (int)($_GET['need'] ?? 0));

        // POST: Elkészítettem (PRG)
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'elkeszitettem') {

            $postReceptId = (int)($_POST['recept_id'] ?? 0);

            // Bejelentkezés kötelező az elkészítés rögzítéséhez.
            if ($felhasznaloId <= 0) {
                $this->atiranyitStatuszal($postReceptId, 'login');
            }

            // CSRF védelem: csak érvényes tokennel engedjük a műveletet.
            $sessionCsrf = (string)($_SESSION['csrf_token'] ?? '');
            $postCsrf = (string)($_POST['csrf_token'] ?? '');
            if ($sessionCsrf === '' || !hash_equals($sessionCsrf, $postCsrf)) {
                $this->atiranyitStatuszal($postReceptId, 'csrf');
            }

            if ($postReceptId <= 0) {
                $this->atiranyitStatuszal(0, 'badreq');
            }

            // Szintzár ellenőrzése itt is kötelező (ne lehessen API/POST kerülővel átugrani).
            $receptSzint = $this->getReceptSzint($postReceptId);
            if ($receptSzint <= 0) {
                $this->atiranyitStatuszal($postReceptId, 'norecept');
            }
            if ($receptSzint > $aktualisSzint) {
                $this->atiranyitStatuszal($postReceptId, 'locked', ['need' => $receptSzint]);
            }

            try {
                // Tranzakció: pont és elkészítés egyszerre, konzisztensen mentődjön.
                $this->pdo->beginTransaction();

                $pont = $this->receptTarolo->pont($postReceptId);
                if ($pont <= 0) {
                    $this->pdo->rollBack();
                    $this->atiranyitStatuszal($postReceptId, 'nopoint');
                }

                // Ha már korábban elkészítette, ne írjuk újra a pontokat.
                if ($this->felhasznaloReceptTarolo->elkeszitette($felhasznaloId, $postReceptId)) {
                    $this->pdo->commit();
                    $this->atiranyitStatuszal($postReceptId, 'already');
                }

                // Elkészítés rögzítése + pont jóváírás.
                $this->felhasznaloReceptTarolo->elkeszitetteBeallit($felhasznaloId, $postReceptId);
                $this->felhasznaloTarolo->pontHozzaad($felhasznaloId, $pont);

                $this->pdo->commit();
                $this->atiranyitStatuszal($postReceptId, 'ok');
            } catch (PDOException $e) {
                // Hiba esetén visszagörgetés, hogy ne maradjon félkész állapot az adatbázisban.
                if ($this->pdo->inTransaction()) $this->pdo->rollBack();
                $this->atiranyitStatuszal($postReceptId, 'dberr');
            }
        }

        // Aktuális pontok
        $aktualisPontok = null;
        if ($felhasznaloId > 0) {
            $aktualisPontok = $this->felhasznaloTarolo->pontok($felhasznaloId);
        }

        // Lista + csoportosítás
        $receptek = $this->receptTarolo->osszesLista();

        $receptekSzintekSzerint = [];
        foreach ($receptek as $r) {
            // A listát szintenként csoportosítjuk a könnyebb UI megjelenítéshez.
            $szint = (int)$r['Szint'];
            $receptekSzintekSzerint[$szint] ??= [];
            $receptekSzintekSzerint[$szint][] = $r;
        }

        // Szűrőhöz kategóriák
        $kategoriaCheckboxok = [];
        foreach ($receptek as $r) {
            // Szűrő-adatszerkezet építése: fő kategória -> alkategóriák.
            $foKat = $r['FoKategoriaNev'] ?? 'Nem kategorizált';
            $alKat = $r['AlkategoriaNev'] ?? 'Egyéb';
            $kategoriaCheckboxok[$foKat] ??= [];
            if (!in_array($alKat, $kategoriaCheckboxok[$foKat], true)) {
                $kategoriaCheckboxok[$foKat][] = $alKat;
            }
        }

        // Konkrét recept oldal
        $recept = null;
        $hozzavalok = [];
        $marElkeszitette = false;

        if ($receptId > 0) {
            $recept = $this->receptTarolo->egy($receptId);
            if ($recept) {

                // Detail oldalon is szintzár: URL paraméterrel se lehessen zárolt receptet megnyitni.
                $detailSzint = (int)($recept['NehezsegiSzintID'] ?? $recept['Szint'] ?? 1);
                if ($detailSzint > $aktualisSzint) {
                    $this->atiranyitStatuszal(0, 'locked', ['need' => $detailSzint]);
                }

                $hozzavalok = $this->receptTarolo->hozzavalok($receptId);

                if ($felhasznaloId > 0) {
                    $marElkeszitette = $this->felhasznaloReceptTarolo->elkeszitette($felhasznaloId, $receptId);
                }
            }
        }

        $szintLepett = $this->szintLepesDetektalasEsSessionFrissites($felhasznaloId, $aktualisSzint);

        // A nézet számára minden szükséges adatot egy tömbben adunk vissza.
        $viewData = array_merge($viewData, compact(
            'receptId',
            'felhasznaloId',
            'aktualisPontok',
            'receptekSzintekSzerint',
            'kategoriaCheckboxok',
            'recept',
            'hozzavalok',
            'marElkeszitette',
            'progress',
            'aktualisSzint',
            'teljesitettSet',
            'szintLepett'
        ));

        return $viewData;
    }
}
