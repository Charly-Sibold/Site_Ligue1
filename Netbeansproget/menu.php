<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<html>
    <head>
        <meta charset="UTF-8">
        <link href="./Css/header.css" rel="stylesheet">
        <title></title>
    </head>
    <body>
         <?php
    
    // Vérifiez si l'utilisateur est connecté
    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
        $nom = $_SESSION['Snom'];
        
        
        // Affichez l'icône de l'utilisateur et le lien de déconnexion
        echo "<header>
                <h1>Ligue Football</h1>
                <h2 class='accueil'><a href='/'>accueil</a></h2>
                <h2 class='listeclub'><a href='/liste_des_club'>liste des clubs</a></h2>
                <h2 class='inscription'><a href='/Inscription'>Inscription</a></h2>
                <h2 class='header_match_en_cours'><a href='/Match_en_cours'>Match_en_cours</a></h2>
                <h2 class='Article'><a href='/Article'>Article</a></h2>
                <h2 class='user-icon'>$icone <a href='/Deconnexion'>Déconnexion</a></h2>
            </header>";
    } else {
        // Affichez le lien de connexion
        echo "<header>
                <h1>Ligue Football</h1>
                <h2 class='accueil'><a href='/'>accueil</a></h2>
                <h2 class='listeclub'><a href='/liste_des_club'>liste des clubs</a></h2>
                <h2 class='inscription'><a href='/Inscription'>Inscription</a></h2>
                <h2 class='header_match_en_cours'><a href='/Match_en_cours'>Match_en_cours</a></h2>
                <h2 class='Article'><a href='/Article'>Article</a></h2>
                <h2 class='connexion'><a href='/Connexion'>Connexion</a></h2>
            </header>";
    }
    ?>
    </body>
</html>
