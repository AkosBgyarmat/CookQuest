<?php
function formatIdo(string $ido_str): string
{
    $parts = explode(':', $ido_str);
    if (count($parts) < 2) return $ido_str;

    $ora = (int)$parts[0];
    $perc = (int)$parts[1];

    if ($ora > 0) return $ora . " óra" . ($perc > 0 ? " $perc perc" : "");
    if ($perc > 0) return "$perc perc";

    return "kevesebb mint 1 perc";
}

function formatMennyiseg($mennyiseg)
{
    if (floor($mennyiseg) == $mennyiseg) return (int)$mennyiseg;
    return rtrim(rtrim(number_format((float)$mennyiseg, 2, '.', ''), '0'), '.');
}

function receptKepSrc(?string $dbKep): string
{
    $dbKep = trim((string)$dbKep);

    if ($dbKep === '') {
        return RECIPE_IMG_URL . RECIPE_IMG_PLACEHOLDER;
    }

    $file = trim(basename($dbKep));

    if (!preg_match('/^[a-zA-Z0-9._-]+\.(webp|png|jpg|jpeg)$/i', $file)) {
        return RECIPE_IMG_URL . RECIPE_IMG_PLACEHOLDER;
    }

    if (!is_file(RECIPE_IMG_DIR . $file)) {
        return RECIPE_IMG_URL . RECIPE_IMG_PLACEHOLDER;
    }

    return RECIPE_IMG_URL . rawurlencode($file);
}