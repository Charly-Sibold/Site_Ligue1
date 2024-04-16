<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of clubModel
 *
 * @author charlysbl26
 */
class GestionClub {

    private PDO $cnx;

    public function __construct(PDO $cnx) {
        $this->cnx = $cnx;
    }

    function getListeClub(): array {
        
        require_once './Model/db_connect.php';
        $query = "SELECT club.* FROM club";
        $stmt = $this->cnx->query($query);

        //récupéré les résultat sous forme d'objet club.
        $clubs = [];
        while ($row = $stmt->fetch()) {
            $clubs[] = new club($row['id_club'], $row['nom_club'], $row['ligue_club']);
            
        }
        return $clubs;
    }

}
