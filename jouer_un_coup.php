<?php

session_start();

require_once __DIR__ . '/Morpion.php';
require_once __DIR__ . '/vendor/autoload.php';

if (empty($_SESSION['jeu'])) {
    $_SESSION['jeu'] = serialize(new Morpion);
}

$jeu = unserialize($_SESSION['jeu']);


if (isset($_GET['x']) && isset($_GET['y'])) {
    $jeu->jouerUnCoup($_GET['x'], $_GET['y']);
}

$_SESSION['jeu'] = serialize($jeu);

header('location: index.php');