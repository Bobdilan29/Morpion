<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Morpion.php';

session_start();

if (empty($_SESSION['jeu'])) {
    $_SESSION['jeu'] = serialize(new Morpion);
}

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

// dd($_SESSION['jeu']); // Dump & die

echo $twig->render('jeu.html', [
    'jeu' => unserialize($_SESSION['jeu'])
]);