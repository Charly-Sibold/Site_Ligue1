<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../Css/apparance_match_en_cours.css" rel="stylesheet">
    <title>Match en cours</title>
</head>
<body>
    <div class="match_en_cours">
        <form method="post" action="" id="Match_en_cours">
            <h2>Match en cours</h2>
            <table>
                <tr>
                    <th>Équipe Domicile</th>
                    <th>Équipe Visiteur</th>
                    <th>Date du Match</th>
                    <th>Score Domicile</th>
                    <th>Score Visiteur</th>
                </tr>
                <?php
                $host = 'pgsql:host=localhost;dbname=Ligue1';
                $user = 'postgres';
                $password = 'p@ssw0rd';
                $pdo = null;

                try {
                    $pdo = new PDO($host, $user, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    die("Erreur de connexion à la base de données: " . $e->getMessage());
                }
                
                $query = "SELECT * FROM match_en_cours()";
                $result = $pdo->query($query);
                
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    echo '<td>' . $row['nom_equipe_domicile'] . '</td>';
                    echo '<td>' . $row['nom_equipe_visiteur'] . '</td>';
                    echo '<td>' . $row['date_match'] . '</td>';
                    echo '<td>' . $row['score_domicile'] . '</td>';
                    echo '<td>' . $row['score_visiteur'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </table>
        </form>
    </div>
</body>
</html>

