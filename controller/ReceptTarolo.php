<?php
/**
 * Recept adatok lekérdezéséért felelős osztály (Repository réteg)
 * Adatbázis műveletek elkülönítése az üzleti logikától
 */
class ReceptTarolo
{
    // PDO kapcsolat injektálása (dependency injection)
    public function __construct(private PDO $pdo) {}

    /**
     * Összes recept lekérdezése a szükséges kapcsolódó adatokkal
     * (nehézségi szint, kategóriák, árkategória)
     */
    public function osszesLista(): array
    {
        return $this->pdo->query("
            SELECT 
                r.*, n.Szint, 
                kat.Kategoria AS FoKategoriaNev,
                kat.KategoriaID AS FoKategoriaID,
                alk.Alkategoria AS AlkategoriaNev,
                alk.AlkategoriaID AS AlkategoriaID,
                a.Arkategoria AS ArkategoriaNev 
            FROM recept r 
            INNER JOIN nehezsegiszint n ON r.NehezsegiSzintID = n.NehezsegiSzintID 
            LEFT JOIN alkategoria alk ON r.AlkategoriaID = alk.AlkategoriaID 
            LEFT JOIN kategoria kat ON alk.KategoriaID = kat.KategoriaID 
            LEFT JOIN arkategoria a ON r.ArkategoriaID = a.ArkategoriaID 
            WHERE NOT EXISTS (
                                SELECT 1
                                FROM alkategoria alk_del
                                JOIN kategoria kat_del ON alk_del.KategoriaID = kat_del.KategoriaID
                                WHERE alk_del.AlkategoriaID = r.AlkategoriaID
                                    AND kat_del.Torolve = 1
                        )
                            AND NOT EXISTS (
                SELECT 1
                FROM recept_hozzavalo rh_del
                JOIN hozzavalo h_del ON rh_del.HozzavaloID = h_del.HozzavaloID
                WHERE rh_del.ReceptID = r.ReceptID
                  AND h_del.Torolve = 1
            )
            ORDER BY n.Szint, r.Nev
        ")->fetchAll(); // Több sor visszaadása tömbként
    }

    /**
     * Egy konkrét recept lekérdezése azonosító alapján
     * Prepared statement használata SQL injection ellen
     */
    public function egy(int $id): ?array
    {
        $st = $this->pdo->prepare("
            SELECT 
                r.*, n.Szint,
                a.Arkategoria AS ArkategoriaNev,
                kat.Kategoria AS FoKategoriaNev,
                kat.KategoriaID AS FoKategoriaID,
                alk.Alkategoria AS AlkategoriaNev,
                alk.AlkategoriaID AS AlkategoriaID 
            FROM recept r 
            JOIN nehezsegiszint n ON r.NehezsegiSzintID = n.NehezsegiSzintID 
            LEFT JOIN arkategoria a ON r.ArkategoriaID = a.ArkategoriaID 
            LEFT JOIN alkategoria alk ON r.AlkategoriaID = alk.AlkategoriaID 
            LEFT JOIN kategoria kat ON alk.KategoriaID = kat.KategoriaID 
                        WHERE r.ReceptID = ?
                            AND NOT EXISTS (
                                    SELECT 1
                                    FROM alkategoria alk_del
                                    JOIN kategoria kat_del ON alk_del.KategoriaID = kat_del.KategoriaID
                                    WHERE alk_del.AlkategoriaID = r.AlkategoriaID
                                        AND kat_del.Torolve = 1
                            )
                            AND NOT EXISTS (
                                    SELECT 1
                                    FROM recept_hozzavalo rh_del
                                    JOIN hozzavalo h_del ON rh_del.HozzavaloID = h_del.HozzavaloID
                                    WHERE rh_del.ReceptID = r.ReceptID
                                        AND h_del.Torolve = 1
                            )
        ");
        
        $st->execute([$id]);
        $row = $st->fetch();

        // Ha nincs találat, null értéket adunk vissza (defenzív programozás)
        return $row ?: null;
    }

    /**
     * Egy recepthez tartozó hozzávalók lekérdezése
     * Kapcsolótáblán (recept_hozzavalo) keresztül
     */
    public function hozzavalok(int $id): array
    {
        $st = $this->pdo->prepare("
            SELECT 
                h.Elnevezes, 
                rh.Mennyiseg, 
                m.Elnevezes AS Mertekegyseg 
            FROM recept_hozzavalo rh 
            JOIN hozzavalo h ON rh.HozzavaloID = h.HozzavaloID 
            JOIN mertekegyseg m ON rh.MertekegysegID = m.MertekegysegID 
            WHERE rh.ReceptID = ?
              AND h.Torolve = 0
        ");

        $st->execute([$id]);
        return $st->fetchAll(); // Több hozzávaló visszaadása
    }

    /**
     * Egy recepthez tartozó begyűjthető pontok lekérdezése
     * Skalár értéket ad vissza
     */
    public function pont(int $id): int
    {
        $st = $this->pdo->prepare("
            SELECT BegyujthetoPontok 
            FROM recept 
            WHERE ReceptID = ? 
            LIMIT 1
        ");

        $st->execute([$id]);

        // fetchColumn: egyetlen érték lekérdezése (optimalizált)
        return (int)$st->fetchColumn();
    }
}