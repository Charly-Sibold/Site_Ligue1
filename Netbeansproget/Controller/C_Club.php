<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of C
 *
 * @author charlysbl26
 */
//include_once '../Model/db_connect.php';
include_once './Model/club.php';
include_once './Model/GestionClub.php';

$host = 'pgsql:host=localhost;dbname=ligue_football';
#$port = '5432';
#$database = 'ligue_football';
$user = 'postgres';
$password = 'p@ssw0rd';

$pdo = null;

try {
    $pdo = new PDO($host, $user, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de conenxion a la base de données: " . $e->getMessage());
}

$gc = new GestionClub($pdo);
$tab = $gc->getListeClub();
include_once './View/V_Club.php';
    

