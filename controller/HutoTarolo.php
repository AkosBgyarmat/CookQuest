<?php

// HutoTarolo:
// A hutom oldal adat-hozzaferesi retege 
// itt tortenik minden kozvetlen adatbazis lekerdezes.
class HutoTarolo
{
    public function __construct(private PDO $pdo) {}

    public function osszesHozzavalo(): array
    {
        // Az osszes hozzavalo lista a keresofelulet checkboxaihoz.
        return $this->pdo->query("
            SELECT HozzavaloID, Elnevezes
            FROM hozzavalo
            WHERE Torolve = 0
            ORDER BY Elnevezes
        ")->fetchAll();
    }

    public function szurtReceptek(array $kivalasztottHozzavaloIdk, int $minMatch): array
    {
        // Ures bemenetnel nincs talalat.
        if (empty($kivalasztottHozzavaloIdk)) {
            return [];
        }

        // Dinamikus IN (...) helyettesitok a kivalasztott hozzavalo ID-k szamahoz.
        $placeholders = implode(',', array_fill(0, count($kivalasztottHozzavaloIdk), '?'));

        // Olyan recepteket kerunk le, ahol a kivalasztott hozzavalokbol legalabb
        // minMatch darab megtalalhato (egyezo_db).
        $sql = "
            SELECT
                r.ReceptID,
                r.Nev,
                TRIM(r.Kep) AS Kep,
                r.ElkeszitesiIdo,
                n.Szint,
                COUNT(DISTINCT rh.HozzavaloID) AS egyezo_db
            FROM recept r
            JOIN recept_hozzavalo rh ON r.ReceptID = rh.ReceptID
            JOIN hozzavalo h_match ON rh.HozzavaloID = h_match.HozzavaloID
            JOIN nehezsegiszint n ON r.NehezsegiSzintID = n.NehezsegiSzintID
            LEFT JOIN alkategoria alk ON r.AlkategoriaID = alk.AlkategoriaID
            LEFT JOIN kategoria kat ON alk.KategoriaID = kat.KategoriaID
            WHERE rh.HozzavaloID IN ($placeholders)
                            AND IFNULL(r.Torolve, 0) = 0
              AND h_match.Torolve = 0
              AND (kat.KategoriaID IS NULL OR kat.Torolve = 0)
              AND NOT EXISTS (
                  SELECT 1
                  FROM recept_hozzavalo rh_del
                  JOIN hozzavalo h_del ON rh_del.HozzavaloID = h_del.HozzavaloID
                  WHERE rh_del.ReceptID = r.ReceptID
                    AND h_del.Torolve = 1
              )
            GROUP BY r.ReceptID
            HAVING egyezo_db >= ?
            ORDER BY egyezo_db DESC
        ";

        $stmt = $this->pdo->prepare($sql);

        // A parameterek vegen adjuk at a minimum egyezesi kuszobot.
        $params = $kivalasztottHozzavaloIdk;
        $params[] = $minMatch;

        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function receptHozzavalokByReceptek(array $receptIdk): array
    {
        // Ha nincs recept, nincs mit csoportositani.
        if (empty($receptIdk)) {
            return [];
        }

        // Minden talalati recept osszes hozzavalojat lekerjuk,
        // hogy a view jelezni tudja a "megvan" es "hianyzik" listakat.
        $placeholders = implode(',', array_fill(0, count($receptIdk), '?'));
        $stmt = $this->pdo->prepare("
            SELECT rh.ReceptID, h.HozzavaloID, h.Elnevezes
            FROM recept_hozzavalo rh
            JOIN hozzavalo h ON rh.HozzavaloID = h.HozzavaloID
            WHERE rh.ReceptID IN ($placeholders)
              AND h.Torolve = 0
            ORDER BY h.Elnevezes
        ");
        $stmt->execute($receptIdk);

        // ReceptID szerint csoportositott tombot epitunk a gyors view-feldolgozashoz.
        $receptHozzavalok = [];
        foreach ($stmt->fetchAll() as $sor) {
            $receptHozzavalok[(int)$sor['ReceptID']][] = $sor;
        }

        return $receptHozzavalok;
    }
}
