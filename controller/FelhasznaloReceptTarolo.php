<?php
class FelhasznaloReceptTarolo
{
    public function __construct(private PDO $pdo) {}

    public function elkeszitette(int $felhasznaloId, int $receptId): bool
    {
        $st = $this->pdo->prepare("
            SELECT COALESCE(Elkeszitette,0)
            FROM felhasznalo_recept
            WHERE FelhasznaloID = ? AND ReceptID = ?
            LIMIT 1
        ");
        $st->execute([$felhasznaloId, $receptId]);
        return ((int)$st->fetchColumn() === 1);
    }

    public function elkeszitetteBeallit(int $felhasznaloId, int $receptId): void
    {
        $st = $this->pdo->prepare("
            SELECT 1
            FROM felhasznalo_recept
            WHERE FelhasznaloID = ? AND ReceptID = ?
            LIMIT 1
        ");
        $st->execute([$felhasznaloId, $receptId]);
        $letezik = (bool)$st->fetchColumn();

        if (!$letezik) {
            $st = $this->pdo->prepare("
                INSERT INTO felhasznalo_recept (FelhasznaloID, ReceptID, Elkeszitette, KedvencReceptek)
                VALUES (?, ?, 1, 0)
            ");
            $st->execute([$felhasznaloId, $receptId]);
        } else {
            $st = $this->pdo->prepare("
                UPDATE felhasznalo_recept
                SET Elkeszitette = 1
                WHERE FelhasznaloID = ? AND ReceptID = ?
            ");
            $st->execute([$felhasznaloId, $receptId]);
        }
    }
}