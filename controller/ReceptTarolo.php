<?php
class ReceptTarolo
{
    public function __construct(private PDO $pdo) {}

    public function osszesLista(): array
    {
        return $this->pdo->query("
            SELECT 
                r.ReceptID, r.Nev, r.Kep, r.ElkeszitesiIdo, r.BegyujthetoPontok, r.Kaloria,
                r.Elkeszitesi_leiras, n.Szint, 
                kat.Kategoria AS FoKategoriaNev, 
                alk.Alkategoria AS AlkategoriaNev, 
                a.Arkategoria AS ArkategoriaNev 
            FROM recept r 
            INNER JOIN nehezsegiszint n ON r.NehezsegiSzintID = n.NehezsegiSzintID 
            LEFT JOIN alkategoria alk ON r.AlkategoriaID = alk.AlkategoriaID 
            LEFT JOIN kategoria kat ON alk.KategoriaID = kat.KategoriaID 
            LEFT JOIN arkategoria a ON r.ArkategoriaID = a.ArkategoriaID 
            ORDER BY n.Szint, r.Nev
        ")->fetchAll();
    }

    public function egy(int $id): ?array
    {
        $st = $this->pdo->prepare("
            SELECT 
                r.*, n.Szint, a.Arkategoria AS ArkategoriaNev, 
                kat.Kategoria AS FoKategoriaNev, alk.Alkategoria AS AlkategoriaNev 
            FROM recept r 
            JOIN nehezsegiszint n ON r.NehezsegiSzintID = n.NehezsegiSzintID 
            LEFT JOIN arkategoria a ON r.ArkategoriaID = a.ArkategoriaID 
            LEFT JOIN alkategoria alk ON r.AlkategoriaID = alk.AlkategoriaID 
            LEFT JOIN kategoria kat ON alk.KategoriaID = kat.KategoriaID 
            WHERE r.ReceptID = ?
        ");
        $st->execute([$id]);
        $row = $st->fetch();
        return $row ?: null;
    }

    public function hozzavalok(int $id): array
    {
        $st = $this->pdo->prepare("
            SELECT 
                h.Elnevezes, rh.Mennyiseg, m.Elnevezes AS Mertekegyseg 
            FROM recept_hozzavalo rh 
            JOIN hozzavalo h ON rh.HozzavaloID = h.HozzavaloID 
            JOIN mertekegyseg m ON rh.MertekegysegID = m.MertekegysegID 
            WHERE rh.ReceptID = ?
        ");
        $st->execute([$id]);
        return $st->fetchAll();
    }

    public function pont(int $id): int
    {
        $st = $this->pdo->prepare("SELECT BegyujthetoPontok FROM recept WHERE ReceptID = ? LIMIT 1");
        $st->execute([$id]);
        return (int)$st->fetchColumn();
    }
}