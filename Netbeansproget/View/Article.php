<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../Css/apparance_article.css" rel="stylesheet">
        <title></title>
    </head>
    <body>
        <div class="article">
            <form method="post" action="./Controller/C_Article.php" id="Article">

                <div>
                    <?php
                    // Vérifiez s'il y a un message d'erreur dans la session
                    if (isset($_SESSION['error_message'])) {
                    $errorMessage = $_SESSION['error_message'];

                    // Affichez l'alerte d'erreur
                    echo "<div class='alert'>$errorMessage</div>";

                    // Effacez le message d'erreur de la session pour éviter de l'afficher à nouveau
                    unset($_SESSION['error_message']);
                    $Snom = isset($_SESSION['SnomCom']) ? $_SESSION['SnomCom'] : '';
                    $Sprenom = isset($_SESSION['Scommentaire']) ? $_SESSION['Scommentaire'] : '';
                    } else {
                    $SnomCom = $Scommentaire = '';
                    }
                    ?>
                    <p name="articleNews" id="articleNews">

                        <?php
                        require_once ('Model/db_connect.php');
                        $query = "SELECT id_news, titre_news , article_news from news";
                        $result = $pdo->query($query);

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $articleId = $row['id_news'];
                        $titreNews = $row['titre_news'];
                        $article = $row['article_news'];
                        echo '<p>';
                        echo $titreNews;
                        echo '</p><br><br>';
                        echo '<p>';
                        echo $article;
                        echo '</p>';
                        // Champ caché avec l'ID de l'article
                        echo '<input type="hidden" name="articleNews" value="' . $articleId . '" />';
                        }
                        
                        ?>
                    </p><br><br>
                </div>
                <div>
                    <label for="nomCom">Nom du commentateur : </label>
                    <input class="basic-slide" type="text" name="nomCom" id="nomCom" value="" /><br><br>

                </div>
                <div>    
                    <label for="commentaire">Commentaire : </label>
                    <textarea name="commentaire" id="commentaire" rows="4"></textarea><br><br>
                </div>
                <div>
                    <input type="submit" value="Commenter" name="submit">
                </div>
            </form>
            <p id="commentaireP">
                <?php
// Récupérer les commentaires de la base de données pour un article spécifique
                $article_id = $articleId;
                $query = "SELECT nom_com , text_com from commentaire comments WHERE id_news = $article_id";
                $result = $pdo->query($query);

                
// Afficher les commentaires
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                    echo "<p><strong>{$row['nom_com']} :</strong> {$row['text_com']}</p>";
                }
                ?>
            </p>

        </div>
    </body>
</html>
