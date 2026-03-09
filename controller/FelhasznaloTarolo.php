<?php
class FelhasznaloTarolo
{
    public function __construct(private PDO $pdo) {}

    public function pontok(int $felhasznaloId): int
    {
        $st = $this->pdo->prepare("SELECT MegszerzettPontok FROM felhasznalo WHERE FelhasznaloID = ?");
        $st->execute([$felhasznaloId]);
        return (int)$st->fetchColumn();
    }

    public function pontHozzaad(int $felhasznaloId, int $pont): void
    {
        $st = $this->pdo->prepare("
            UPDATE felhasznalo
            SET MegszerzettPontok = COALESCE(MegszerzettPontok,0) + ?
            WHERE FelhasznaloID = ?
        ");
        $st->execute([$pont, $felhasznaloId]);
    }
}