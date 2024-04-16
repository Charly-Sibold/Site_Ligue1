<?php

session_start();
$page = $_SERVER['SCRIPT_NAME'];

if ($page == "/index.php") {
    require_once ('Model/db_connect.php');
    include("./View/Article.php");
} else {   //page Controller/C_Article.php
    require_once ('../Model/db_connect.php');

    if (isset($_POST['submit'])) {
        $articleNews = $_POST['articleNews'];
        $nomCom = $_POST['nomCom'];
        $commentaire = $_POST['commentaire'];

        $errorMessage = "";

        if (empty($nomCom)) {
            $errorMessage .= "Le champ nom du commentaire est obligatoire. <br>";
        } else {
            $_SESSION['SnomCom'] = $nomCom;
        }
        if (empty($commentaire)) {
            $errorMessage .= "Le champ commentaire est obligatoire. <br>";
        } else {
            $_SESSION['Scommentaire'] = $commentaire;
        }

        if (!empty($errorMessage)) {
            // Rediriger l'utilisateur vers le formulaire avec les erreurs spécifiques
            $_SESSION['error_message'] = $errorMessage;
            header("Location: /Article");

            exit;
        }



        $sql = "INSERT INTO commentaire (id_news , nom_com , text_com) VALUES (:id_news ,:nomCom , :commentaire)";
        $requete = $pdo->prepare($sql);

        $commentaire = strip_tags($commentaire);
        $requete->bindParam(':id_news', $articleNews, PDO::PARAM_INT);
        $requete->bindParam(':nomCom', $nomCom, PDO::PARAM_STR);
        $requete->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);

        try {
            $requete->execute();
            header("Location: /Article");
        } catch (PDOException $e) {
            die("Erreur de la requete sql " . $e->getMessage());
        }
        $pdo = null;
    } else {
        include("./View/Article.php");
    }
}
?>