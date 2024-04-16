<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../Css/apparance_GestionMdp.css" rel="stylesheet">
        <title></title>
    </head>
    <body>
        <div class="GestionMdp">
            <div>
                <form method="post" action="">
                    <label for="mdp">mot de passe : </label>
                    <input type="password" name="mdp" id="mdp" value="" /><input type="checkbox" id="showPassword"><br><br>

                    <text>le mot de passe doit contenir 8 caractère minimun avec une majuscule , une minuscule , un nombre et un caractère spéciaux.</text><br><br>

                    <label for="hashingMethod">Choix du hachage : </label>
                    <select name="hashingMethod" id="hashingMethod">
                        <option value="md5">MD5</option>
                        <option value="sha1">SHA1</option>
                        <option value="hash">Hash</option>
                        <option value="crypt">Crypt</option>
                        <option value="password_hash">Password_Hash</option>
                    </select><br><br>

                    <input type="submit" value="S'inscrire" name="submit"><br><br>
                    
                    <div id="passwordStrength"></div>
                    <div id="strengthBar"></div>
                    <div id="strengthText">Faible</div>
                </form>
            </div>
            <div>
                <?php
                if (isset($_POST['submit'])) {
                    $mdp = $_POST['mdp'];
                    $hashingMethod = $_POST['hashingMethod'];
                    $hashed_password = '';

                    if ($hashingMethod === 'md5') {
                        $hashed_password = md5($mdp);
                    } elseif ($hashingMethod === 'sha1') {
                        $hashed_password = sha1($mdp);
                    } elseif ($hashingMethod === 'hash') {
                        $hashed_password = hash('sha256', $mdp); // Vous pouvez utiliser un algorithme de hachage au lieu de 'sha256'.
                    } elseif ($hashingMethod === 'crypt') {
                        $salt = '$2a$07$YourSaltValueHere$'; // Ajoutez un sel sécurisé ici.
                        $hashed_password = crypt($mdp, $salt);
                    } elseif ($hashingMethod === 'password_hash') {
                        $hashed_password = password_hash($mdp, PASSWORD_DEFAULT); // Utilisez PASSWORD_DEFAULT pour un hachage sécurisé.
                    }

                    echo "Mot de passe haché ($hashingMethod): $hashed_password<br>";
                }
                ?>
            </div>
        </div>
         <script>
        const passwordInput = document.getElementById("mdp");
        const showPasswordCheckbox = document.getElementById("showPassword");
        const passwordStrength = document.getElementById("passwordStrength");
        const strengthBar = document.getElementById("strengthBar");
        const strengthText = document.getElementById("strengthText");

        showPasswordCheckbox.addEventListener("change", function() {
            if (showPasswordCheckbox.checked) {
                passwordInput.type = "text"; // Affiche le mot de passe
            } else {
                passwordInput.type = "password"; // Masque le mot de passe
            }
        });

        passwordInput.addEventListener("input", function() {
            const password = passwordInput.value;
            const length = password.length;
            const hasSpecialChar = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(password);
            const hasDigit = /[0-9]+/.test(password);
            const hasUppercase = /[A-Z]+/.test(password);
            const hasLowercase = /[a-z]+/.test(password);

            let strength = 0;
            if (length >= 8) strength++;
            if (hasSpecialChar) strength++;
            if (hasDigit) strength++;
            if (hasUppercase) strength++;
            if (hasLowercase) strength++;

            const colors = ["white", "red", "yellow", "green", "darkgreen"];
            strengthBar.style.width = Math.min((strength * 33.33), 99.99) + "%"; // 33.33% for each strength level
            strengthBar.style.backgroundColor = colors[strength];
            
            const strengthLabels = ["Faible","peu faible", "Moyen", "Fort","Très_fort"];
            strengthText.innerText = strengthLabels[strength];
        });
    </script>        
    </body>
</html>
