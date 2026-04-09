<?php
declare(strict_types=1);

final class SzintezesService
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    /**
     * Szintszabályok DB-ből:
     * - maxPont = SUM(BegyujthetoPontok)
     * - kuszobPont = SUM(...) - MIN(...)
     */
    public function getSzintSzabalyok(): array
    {
        $sql = "
            SELECT
                NehezsegiSzintID AS szint,
                COUNT(*) AS receptDb,
                SUM(BegyujthetoPontok) AS maxPont,
                MIN(BegyujthetoPontok) AS minReceptPont,
                (SUM(BegyujthetoPontok) - MIN(BegyujthetoPontok)) AS kuszobPont
            FROM recept
            WHERE IFNULL(Torolve, 0) = 0
            GROUP BY NehezsegiSzintID
            ORDER BY NehezsegiSzintID
        ";

        $rows = $this->pdo->query($sql)->fetchAll();
        $out = [];

        foreach ($rows as $r) {
            $szint = (int)$r['szint'];
            $out[$szint] = [
                'receptDb'      => (int)$r['receptDb'],
                'maxPont'       => (int)$r['maxPont'],
                'minReceptPont' => (int)$r['minReceptPont'],
                'kuszobPont'    => (int)$r['kuszobPont'],
            ];
        }

        return $out;
    }

    /**
     * Felhasználó pontjai szintenként (csak Elkeszitette=1).
     * DISTINCT: védi a pontszámítást, ha valamiért duplikált rekord lenne.
     */
    public function getFelhasznaloPontSzintenkent(int $felhasznaloId): array
    {
        $sql = "
            SELECT
                r.NehezsegiSzintID AS szint,
                SUM(r.BegyujthetoPontok) AS pont
            FROM (
                SELECT DISTINCT ReceptID
                FROM felhasznalo_recept
                WHERE FelhasznaloID = :uid AND Elkeszitette = 1
            ) t
            INNER JOIN recept r ON r.ReceptID = t.ReceptID
            WHERE IFNULL(r.Torolve, 0) = 0
            GROUP BY r.NehezsegiSzintID
            ORDER BY r.NehezsegiSzintID
        ";

        $st = $this->pdo->prepare($sql);
        $st->execute([':uid' => $felhasznaloId]);

        $out = [];
        foreach ($st->fetchAll() as $row) {
            $out[(int)$row['szint']] = (int)$row['pont'];
        }

        return $out;
    }

    /**
     * Aktuális szint:
     * - az első olyan szint, ahol pont < küszöb
     * - ha minden kész, a max szintet adja vissza
     */
    public function getAktualisSzint(int $felhasznaloId): int
    {
        $szabalyok = $this->getSzintSzabalyok();
        if (!$szabalyok) return 1;

        $pontok = $this->getFelhasznaloPontSzintenkent($felhasznaloId);
        $szintek = array_map('intval', array_keys($szabalyok));
        sort($szintek, SORT_NUMERIC);

        foreach ($szintek as $szint) {
            $kuszob = (int)($szabalyok[$szint]['kuszobPont'] ?? PHP_INT_MAX);
            $pont = $pontok[$szint] ?? 0;

            if ($pont < $kuszob) return $szint;
        }

        return (int)max($szintek);
    }

    /**
     * UI-hoz progress az aktuális szintre.
     */
    public function getProgress(int $felhasznaloId): array
    {
        $szabalyok = $this->getSzintSzabalyok();
        $pontok = $this->getFelhasznaloPontSzintenkent($felhasznaloId);

        $aktualis = $this->getAktualisSzint($felhasznaloId);
        $rule = $szabalyok[$aktualis] ?? ['kuszobPont' => 0, 'maxPont' => 0, 'receptDb' => 0];

        $pont = $pontok[$aktualis] ?? 0;
        $kuszob = (int)$rule['kuszobPont'];
        $hatravan = max(0, $kuszob - (int)$pont);

        return [
            'aktualisSzint' => $aktualis,
            'pont'          => (int)$pont,
            'kuszobPont'    => $kuszob,
            'maxPont'       => (int)$rule['maxPont'],
            'receptDb'      => (int)$rule['receptDb'],
            'hatravanPont'  => $hatravan,
            'kesz'          => ($kuszob > 0 ? (int)$pont >= $kuszob : false),
        ];
    }

    /**
     * Teljesített receptek ID-set (kártyán pipa, gomb tiltás).
     */
    public function getTeljesitettReceptIdSet(int $felhasznaloId): array
    {
        $sql = "SELECT ReceptID FROM felhasznalo_recept WHERE FelhasznaloID = :uid AND Elkeszitette = 1";
        $st = $this->pdo->prepare($sql);
        $st->execute([':uid' => $felhasznaloId]);

        $set = [];
        foreach ($st->fetchAll() as $r) {
            $set[(int)$r['ReceptID']] = true;
        }
        return $set;
    }

    /**
     * Recept zárolt-e (szint szerint).
     */
    public function isReceptZarolt(int $felhasznaloId, int $receptSzintId): bool
    {
        return $receptSzintId > $this->getAktualisSzint($felhasznaloId);
    }

    /**
     * Összpont újraszámítás és cache frissítés a felhasznalo.MegszerzettPontok mezőbe.
     * (Séma módosítás nélkül, csak UPDATE.)
     */
    public function syncOsszPontCache(int $felhasznaloId): int
    {
        $sql = "
            SELECT COALESCE(SUM(r.BegyujthetoPontok), 0) AS ossz
            FROM (
                SELECT DISTINCT ReceptID
                FROM felhasznalo_recept
                WHERE FelhasznaloID = :uid AND Elkeszitette = 1
            ) t
            INNER JOIN recept r ON r.ReceptID = t.ReceptID
            WHERE IFNULL(r.Torolve, 0) = 0
        ";
        $st = $this->pdo->prepare($sql);
        $st->execute([':uid' => $felhasznaloId]);
        $ossz = (int)$st->fetchColumn();

        $up = $this->pdo->prepare("UPDATE felhasznalo SET MegszerzettPontok = :p WHERE FelhasznaloID = :uid");
        $up->execute([':p' => $ossz, ':uid' => $felhasznaloId]);

        return $ossz;
    }

    /**
     * Recept teljesítés rögzítése a meglévő felhasznalo_recept táblába:
     * - API-n keresztül se lehessen locked receptet “teljesíteni”
     * - ON DUPLICATE KEY: csak Elkeszitette-t állítjuk, KedvencReceptekhez nem nyúlunk
     */
    public function receptTeljesit(int $felhasznaloId, int $receptId): array
    {
        $st = $this->pdo->prepare("SELECT NehezsegiSzintID FROM recept WHERE ReceptID = :rid AND IFNULL(Torolve, 0) = 0");
        $st->execute([':rid' => $receptId]);
        $recept = $st->fetch();

        if (!$recept) {
            throw new RuntimeException("Nincs ilyen recept.");
        }

        $receptSzint = (int)$recept['NehezsegiSzintID'];
        $aktualisSzint = $this->getAktualisSzint($felhasznaloId);

        if ($receptSzint > $aktualisSzint) {
            throw new RuntimeException("Zárolt recept. Előbb érd el a(z) {$receptSzint}. szintet.");
        }

        $sql = "
            INSERT INTO felhasznalo_recept (FelhasznaloID, ReceptID, Elkeszitette)
            VALUES (:uid, :rid, 1)
            ON DUPLICATE KEY UPDATE Elkeszitette = 1
        ";
        $ins = $this->pdo->prepare($sql);
        $ins->execute([':uid' => $felhasznaloId, ':rid' => $receptId]);

        $osszPont = $this->syncOsszPontCache($felhasznaloId);
        $progress = $this->getProgress($felhasznaloId);

        return [
            'osszPont' => $osszPont,
            'progress' => $progress,
        ];
    }
}