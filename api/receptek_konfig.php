<?php
if (!defined('APP_BASE_URL')) {
    define('APP_BASE_URL', '/CookQuest');
}

if (!defined('RECIPE_IMG_URL')) {
    define('RECIPE_IMG_URL', APP_BASE_URL . '/assets/kepek/etelek/');
}

if (!defined('RECIPE_IMG_PLACEHOLDER')) {
    define('RECIPE_IMG_PLACEHOLDER', 'placeholder.webp');
}

if (!defined('RECIPE_IMG_DIR')) {
    define('RECIPE_IMG_DIR', rtrim($_SERVER['DOCUMENT_ROOT'], '/\\') . RECIPE_IMG_URL);
}