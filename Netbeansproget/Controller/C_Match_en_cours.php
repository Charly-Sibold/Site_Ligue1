<?php
class GestionMatch_en_cours {

    private PDO $cnx;

    public function __construct(PDO $cnx) {
        $this->cnx = $cnx;
    }

    function getListeMatch_en_cours(): array {
    $host = 'pgsql:host=localhost;dbname=Ligue1';
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
    
    $query = "select * from mathc_en_cours()";
    $stmt = $this->cnx->query($query);
    //récupéré les résultat sous forme d'objet club.
        $match_en_cours = [];
        while ($row = $stmt->fetch()) {
            $match_en_cours[] = new club($row['nom_equipe_domicile'], $row['nom_equipe_visiteur'], $row['date_match'],$row['score_domicile'],$row['score_visiteur']);
            
        }
        return $match_en_cours;
}

        }
?>