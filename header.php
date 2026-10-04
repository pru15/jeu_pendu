<?php 
declare(strict_types=1);
session_start();
ini_set('dislpay_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $db = new PDO('mysql:host=localhost;dbname=pendu;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?> 

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mon site web</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>JEU</h1>

