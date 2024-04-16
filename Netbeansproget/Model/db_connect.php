<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $host = 'pgsql:host=localhost;dbname=ligue_football';
        #$port = '5432';
        #$database = 'ligue_football';
        $user = 'postgres';
        $password = 'p@ssw0rd';

        try {

            $pdo = new PDO($host, $user, $password);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de conenxion a la base de données: " . $e->getMessage());
        }
        ?>
    </body>
</html>
