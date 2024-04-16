<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="uff-8">
        <link href="./Css/apparance_site.css" rel="stylesheet">
        <title>Accueil</title>
    </head>
    <body>
        
        <?php
       session_start();
        //creer une instance du routeur
        include_once './router.php';
        include_once './menu.php';
        $router = new Router();
        
        //Ajouter des routes.
        $router->addRoute('/', 'index.php');
        $router->addRoute('/Inscription', './Controller/C_Inscription.php');
        $router->addRoute('/liste_des_club', './Controller/C_Club.php');
        $router->addRoute('/user_success', './View/user_sucess.php' );
        $router->addRoute('/Match_en_cours', './View/Match_en_cours.php');
        $router->addRoute('/Connexion', './Controller/C_Connexion.php');
        $router->addRoute('/Article', './Controller/C_Article.php');
        $router->addRoute('/Deconnexion', './View/Deconnexion.php');
        
        
        $url = $_SERVER['REQUEST_URI'];
        
        $router->execute($url);
        ?>
    </body>


</html>




