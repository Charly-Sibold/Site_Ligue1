<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
//include_once '../Model/db_connect.php';
include_once '../Model/club.php';
include_once '../Model/GestionClub.php';
include_once '../Model/db_connect.php';


$gc = new GestionClub($pdo);
$tab = $gc->getListeClub();
//echo "<pre>";
//var_dump($tab);
//echo "</pre>";
//for
    //$tab[i]->getNom_club();

       
