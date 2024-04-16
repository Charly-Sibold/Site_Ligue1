<?php

//echo "Controleur inscription " . $_SERVER['SCRIPT_NAME'];
$page = $_SERVER['SCRIPT_NAME'];

if ($page == "/index.php") {
    require_once ('./Model/db_connect.php');
    include("./View/Inscription.php");
} else {   //page Controller/c_inscription
    require_once ('../Model/db_connect.php');

//Tableau contenant les informatique de l'utilisateur.
    //var_dump($_POST);
    if (isset($_POST['submit']) /* && $_POST['nom'] != null && $_POST['prenom'] != null && $_POST['adresse-email'] != null && $_POST['mdp'] != null && $_POST['sexe'] != null */) {

        echo "premier if";
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['adresse-email'];
        $mdp = $_POST['mdp'];
        $sexe = $_POST['sexe'];
        $clubFavori = $_POST['Club_favori'];
        #$photo = $_FILES['photo'];
        #$clubNews=$_POST['checkbox'];
        $hashingMethod = $_POST['hashingMethod'];
        $hashed_password = '';
        $errorMessage = "";

        if (empty($nom)) {
            $errorMessage .= "Le champ nom est obligatoire. <br>";
        } else {
            $_SESSION['Snom'] = $nom;
        }
        if (empty($prenom)) {
            $errorMessage .= "Le champ prénom est obligatoire. <br>";
        } else {
            $_SESSION['Sprenom'] = $prenom;
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage .= "L'adresse email n'est pas valide.<br> ";
        } else {
            $_SESSION['Semail'] = $email;
        }

        $checkEmailSql = "SELECT COUNT(*) FROM utilisateur WHERE mail_uti = :mail";
        $checkEmailQuery = $pdo->prepare($checkEmailSql);
        $checkEmailQuery->bindParam(':mail', $email, PDO::PARAM_STR);
        $checkEmailQuery->execute();
        $emailExists = $checkEmailQuery->fetchColumn();

        if ($emailExists) {
            $errorMessage .= "Cet email est déjà enregistré. Veuillez utiliser un autre email.<br>";
        } else {
            $_SESSION['SemailExists'] = $emailExists;
        }
        if (
                strlen($mdp) < 8 ||
                !preg_match('/[A-Z]/', $mdp) ||
                !preg_match('/[a-z]/', $mdp) ||
                !preg_match('/[0-9]/', $mdp) ||
                !preg_match('/[^a-zA-Z0-9]/', $mdp)
        ) {
            $errorMessage .= "Le mot de passe doit respecter les critères requis.<br> ";
        } else {

            $hashed_password = password_hash($mdp, PASSWORD_DEFAULT);
            $_SESSION['Smdp'] = $mdp;
        }
        if (empty($sexe)) {
            $errorMessage .= "Le choix du sexe est obligatoire. <br>";
        } else {
            $_SESSION['Ssexe'] = $sexe;
        }


        if (!empty($errorMessage)) {
            // Rediriger l'utilisateur vers le formulaire avec les erreurs spécifiques
            $_SESSION['error_message'] = $errorMessage;
            header("Location: /Inscription");

            exit;
        }

        if (!empty($_FILES['photo']['name'])) {
            $photo = $_FILES['photo'];
            $target_directory = "../img";
            $target_file = $target_directory . basename($photo['name']);
            move_uploaded_file($photo['tmp_name'], $target_file);
        } else {
            $target_file = null; // ou une valeur par défaut
        }



        $sql = "INSERT INTO utilisateur (id_club ,nom_uti , prenom_uti , sexe_uti , password_uti  ,date_inscription, image_uti, mail_uti) VALUES ( :id_club, :nom , :prenom , :sexe , :pwd, NOW() ,:image, :mail)";
        $requete = $pdo->prepare($sql);

        $requete->bindParam(':id_club', $clubFavori, PDO::PARAM_STR);
        $requete->bindParam(':nom', $nom, PDO::PARAM_STR);
        $requete->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $requete->bindParam(':sexe', $sexe, PDO::PARAM_STR);
        $requete->bindParam(':pwd', $hashed_password, PDO::PARAM_STR);
        $requete->bindParam(':image', $target_file, PDO::PARAM_STR);
        $requete->bindParam(':mail', $email, PDO::PARAM_STR);

        try {
            $requete->execute();
            header("Location: /user_success");
        } catch (PDOException $e) {
            die("Erreur de la requete sql " . $e->getMessage());
        }
        $pdo = null;
    } else {
        include("./View/Inscription.php");
    }
}
?>
