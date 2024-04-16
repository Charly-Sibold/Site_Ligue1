<?php


$page = $_SERVER['SCRIPT_NAME'];
//echo "<script>alert('" . $page . "');</script>";
/* if ($page == "/index.php") {

  require_once ('./Model/db_connect.php');
  include("./View/Connexion.php");
  } else {   //page Controller/C_Connexion.php
  require_once ('../Model/db_connect.php');
 */
require_once ('./Model/db_connect.php');

if (isset($_POST['submit'])) {
    echo "<script>alert('" . $page . "');</script>";
    echo "formulaire soumis";

    $nom = $_POST['nom'];
    $mdp = $_POST['mdp'];
    
    echo $nom." ".$mdp;
    $errorMessage = "";

    $query = "SELECT nom_uti, password_uti , image_uti FROM utilisateur WHERE nom_uti = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$nom]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $errorMessage .= "Le login n'existe pas";
    } else {
// Vérifier le mot de passe haché
        $hashedPassword = $user['password_uti'];
        if (!$user || !password_verify($mdp, $user['password_uti'])) {
// Identifiants incorrects
            $errorMessage .= "Le nom d'utilisateur ou le mot de passe est incorrect";
        } else {
// Authentification réussie
            $_SESSION['authenticated'] = true;
            $_SESSION['Snom'] = $nom;
        }
    }
    if (!empty($errorMessage)) {
// Rediriger l'utilisateur vers le formulaire avec les erreurs spécifiques
        $_SESSION['error_message'] = $errorMessage;
        var_dump($errorMessage);
        header("Location: /Connexion");
        //exit;
    } else {
// Authentification réussie, rediriger vers la page appropriée
        header("Location:/user_success");
        //exit;
    }
} else {
    include("./View/Connexion.php");
}



   
