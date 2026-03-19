<?php

class IndexOldalRecept
{
    public function __construct(private PDO $pdo) {}

    public function indexReceptek(int $limit = 24): array
    {
        $biztonsagosLimit = max(1, (int)$limit);

        $sorok = $this->pdo->query("
            SELECT
                r.ReceptID,
                r.Nev,
                r.Kep,
                r.ElkeszitesiIdo,
                r.BegyujthetoPontok,
                n.Szint
            FROM recept r
            INNER JOIN nehezsegiszint n ON r.NehezsegiSzintID = n.NehezsegiSzintID
            WHERE n.Szint = 1
            ORDER BY r.Nev ASC
            LIMIT {$biztonsagosLimit}
        ")->fetchAll();

        return array_map(static function (array $recept): array {
            $recept['KepSrc'] = receptKepSrc((string)($recept['Kep'] ?? ''));
            $recept['ElkeszitesiIdoFormazott'] = formatIdo((string)($recept['ElkeszitesiIdo'] ?? ''));
            return $recept;
        }, $sorok);
    }
}

// Ha az index oldalról közvetlenül require-oljuk ezt a fájlt,
// automatikusan előállítjuk az ott használt $indexReceptek változót.
if (isset($pdo) && $pdo instanceof PDO && !isset($indexReceptek)) {
    $indexOldalReceptSzolgaltatas = new IndexOldalRecept($pdo);
    $indexReceptek = $indexOldalReceptSzolgaltatas->indexReceptek(24);
}