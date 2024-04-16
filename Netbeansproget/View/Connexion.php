<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../Css/apparance_connexion.css" rel="stylesheet">
        <title>Connexion</title>
    </head>
    <body>
        <form method="post" action="/Connexion" id="Connexion">
        
            
        <div class="Connexion">
            <p>Connexion</p>
            <?php
                // Vérifiez s'il y a un message d'erreur dans la session
                if (isset($_SESSION['error_message'])) {
                    $errorMessage = $_SESSION['error_message'];

                    // Affichez l'alerte d'erreur
                    echo "<div class='alert'>$errorMessage</div>";

                    // Effacez le message d'erreur de la session pour éviter de l'afficher à nouveau
                    unset($_SESSION['error_message']);
                    $Snom = isset($_SESSION['Snom']) ? $_SESSION['Snom'] : '';
                    $Smdp = isset($_SESSION['Smdp']) ? $_SESSION['Smdp'] : '';
                } else {
                    $Snom = $Smdp = '';
                }
                ?>
            <section>
                <label for="nom">Nom : </label>
                <input class="basic-slide" type="text" name="nom" id="nom" value="" /><br><br>
            </section>
            <div>
                    <label for="mdp">mot de passe : </label>
                    <input type="password" name="mdp" id="mdp" value="" /><input type="checkbox" id="showPassword"><br><br>
            </div>
            <div>
                    <input type="submit" value="Connexion" name="submit">
                </div>
        </div>
        </form>
        <script>
        <script>
            const passwordInput = document.getElementById("mdp");
            const showPasswordCheckbox = document.getElementById("showPassword");

            showPasswordCheckbox.addEventListener("change", function () {
                if (showPasswordCheckbox.checked) {
                    passwordInput.type = "text"; // Affiche le mot de passe
                } else {
                    passwordInput.type = "password"; // Masque le mot de passe
                }
            });
        </script>
    </body>
</html>
