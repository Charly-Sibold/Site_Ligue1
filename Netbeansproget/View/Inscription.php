<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../Css/formulaire_incription.css" rel="stylesheet">
        <title>Inscription</title>
    </head>
    <body>
        <div class="formulaire">

            <form method="post" action="./Controller/C_inscription.php" id="Formulaire">
                <p>inscription</p>
                <?php
                // Vérifiez s'il y a un message d'erreur dans la session
                if (isset($_SESSION['error_message'])) {
                    $errorMessage = $_SESSION['error_message'];

                    // Affichez l'alerte d'erreur
                    echo "<div class='alert'>$errorMessage</div>";

                    // Effacez le message d'erreur de la session pour éviter de l'afficher à nouveau
                    unset($_SESSION['error_message']);
                    $Snom = isset($_SESSION['Snom']) ? $_SESSION['Snom'] : '';
                    $Sprenom = isset($_SESSION['Sprenom']) ? $_SESSION['Sprenom'] : '';
                    $Semail = isset($_SESSION['Semail']) ? $_SESSION['Semail'] : '';
                    $Smdp = isset($_SESSION['Smdp']) ? $_SESSION['Smdp'] : '';
                    $Ssexe = isset($_SESSION['Ssexe']) ? $_SESSION['Ssexe'] : '';
                    $emailExists = isset($_SESSION['SemailExists']) ? $_SESSION['SemailExists'] : '';
                } else {
                    $Snom = $Sprenom = $Semail = $Smdp = $Ssexe = $emailExists = '';
                }
                ?>
                <div id="alert-box" style="display:none;" class="alert">
                    <span class="closebtn" onclick="closeAlert()">&times;</span>
                    Le mot de passe doit comporter au moins une majuscule, une minuscule, un chiffre, un caractère spécial, et faire au moins 8 caractères.
                </div>

                <div>
                    <section>
                        <label for="nom">Nom : </label>
                        <input class="basic-slide" type="text" name="nom" id="nom" value="<?php echo $Snom; ?>" /><br><br>

                    </section>
                </div>
                <div>
                    <label for="prenom">Prénom : </label>
                    <input class="basic-slide" type="text" name="prenom" id="prenom" value="<?php echo $Sprenom; ?>" /><br><br>

                </div> 
                <div>
                    <label for="adresse-email">Email : </label>
                    <input class="basic-slide" type="text" name="adresse-email" id="adresse-email" value="<?php echo $Semail; ?>"/><br><br>
                </div>

                <div>
                    <label for="mdp">mot de passe : </label>
                    <input type="password" name="mdp" id="mdp" value="<?php echo $Smdp; ?>" /><input type="checkbox" id="showPassword"><br><br>

                    <text>le mot de passe doit contenir 8 caractère minimun avec une majuscule , une minuscule , un nombre et un caractère spéciaux.</text><br><br>

                    <div id="strengthBar"></div>
                    <div id="strengthText">Faible</div>
                </div><br>
                <div>

                    <div>
                        <legend>Sexe</legend>
                        <label for="Homme">Homme</label>
                        <input type="radio" id="Homme" name="sexe"  value="Homme" <?php echo ($Ssexe === 'Homme') ? 'checked' : ''; ?> />
                    </div>
                    <div>
                        <label for="Femme">Femme</label>
                        <input type="radio" id="Femme" name="sexe" value="Femme" <?php echo ($Ssexe === 'Femme') ? 'checked' : ''; ?> /><br><br>

                    </div>

                </div>
                <div>
                    <label for="Club_favori">Votre club favori : </label>
                    <select name="Club_favori" id="Club_favori">
                        <?php
                        require_once('Model/db_connect.php');
                        $query = "SELECT id_club, nom_club FROM club";
                        $result = $pdo->query($query);

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            $nomClub = $row['nom_club'];
                            $idClub = $row['id_club'];
                            echo "<option value=\"" . $idClub . "\">" . $nomClub . "</option>";
                        }
                        ?>
                    </select><br><br>
                </div>
                <div>
                    <label for="photo">Photo de profil :</label>
                    <input type="file" id="photo" name="photo" accept="image/*"><br><br>
                </div>
                <div>
                    <p>Choisissez les clubs auxquels vous souhaitez avoir des new :</p>
                    <input type="checkbox" id="paris_fc" name="clubs[]" value="Paris_fc">
                    <label for="paris_fc">Paris FC</label><br>

                    <input type="checkbox" id="valence" name="clubs[]" value="valence">
                    <label for="valence">valence</label><br>

                    <input type="checkbox" id="lyonnais" name="clubs[]" value="lyonnais">
                    <label for="lyonnais">lyonnais</label><br>

                    <input type="checkbox" id="marseille" name="clubs[]" value="marseille">
                    <label for="marseille">Olympique de marseille</label><br>

                    <input type="checkbox" id="monaco" name="clubs[]" value="monaco">
                    <label for="monaco">AS Monaco</label><br><br>
                </div>
                <div>
                <div>Teachable Machine Image Model</div>
<button type="button" onclick="init()">Start</button>
<div id="webcam-container"></div>
<div id="label-container"></div>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>
<script type="text/javascript">
    // More API functions here:
    // https://github.com/googlecreativelab/teachablemachine-community/tree/master/libraries/image

    // the link to your model provided by Teachable Machine export panel
    const URL = "../model/";

    let model, webcam, labelContainer, maxPredictions;

    // Load the image model and setup the webcam
    async function init() {
        const modelURL = URL + "model.json";
        const metadataURL = URL + "metadata.json";

        // load the model and metadata
        // Refer to tmImage.loadFromFiles() in the API to support files from a file picker
        // or files from your local hard drive
        // Note: the pose library adds "tmImage" object to your window (window.tmImage)
        model = await tmImage.load(modelURL, metadataURL);
        maxPredictions = model.getTotalClasses();

        // Convenience function to setup a webcam
        const flip = true; // whether to flip the webcam
        webcam = new tmImage.Webcam(200, 200, flip); // width, height, flip
        await webcam.setup(); // request access to the webcam
        await webcam.play();
        window.requestAnimationFrame(loop);

        // append elements to the DOM
        document.getElementById("webcam-container").appendChild(webcam.canvas);
        labelContainer = document.getElementById("label-container");
        for (let i = 0; i < maxPredictions; i++) { // and class labels
            labelContainer.appendChild(document.createElement("div"));
        }
    }

    async function loop() {
        webcam.update(); // update the webcam frame
        await predict();
        window.requestAnimationFrame(loop);
    }

    // run the webcam image through the image model
    async function predict() {
        // predict can take in an image, video or canvas html element
        const prediction = await model.predict(webcam.canvas);
        for (let i = 0; i < maxPredictions; i++) {
            const classPrediction =
                prediction[i].className + ": " + prediction[i].probability.toFixed(2);
            labelContainer.childNodes[i].innerHTML = classPrediction;
        }
    }
</script><br><br>
                </div>
                
                
                <div>
                    <input type="submit" value="S'inscrire" name="submit">
                </div>
            </form>
        </div>
        
        
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

            passwordInput.addEventListener("input", function () {
                const password = passwordInput.value;
                const length = password.length;
                const hasSpecialChar = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test(password);
                const hasDigit = /[0-9]+/.test(password);
                const hasUppercase = /[A-Z]+/.test(password);
                const hasLowercase = /[a-z]+/.test(password);

                let strength = 0;
                if (length >= 8)
                    strength++;
                if (hasSpecialChar)
                    strength++;
                if (hasDigit)
                    strength++;
                if (hasUppercase)
                    strength++;
                if (hasLowercase)
                    strength++;

                const colors = ["white", "red", "yellow", "green", "darkgreen"];
                strengthBar.style.width = Math.min((strength * 33.33), 99.99) + "%"; // 33.33% for each strength level
                strengthBar.style.backgroundColor = colors[strength];

                const strengthLabels = ["Faible", "peu faible", "Moyen", "Fort", "Très_fort"];
                strengthText.innerText = strengthLabels[strength];
            });
            function closeAlert() {
                document.getElementById("alert-box").style.display = "none";
            }

            document.getElementById("Formulaire").addEventListener("submit", function (event) {
                var nom = document.getElementById("nom").value;
                var prenom = document.getElementById("prenom").value;
                var password = document.getElementById("mdp").value;
                var errorMessage = "";
                if (nom.trim() === "") {
                    errorMessage += "Le champ nom est obligatoire. ";
                } else if (prenom.trim() === "") {
                    errorMessage = "Le champ prénom est obligatoire.";
                } else if (email.trim() === "" || !email.includes("@")) {
                    errorMessage = "L'adresse email n'est pas valide.";
                } else if (
                        nom.trim() === "" ||
                        prenom.trim() === "" ||
                        password.length < 8 ||
                        !/[A-Z]/.test(password) || // Au moins une majuscule
                        !/[a-z]/.test(password) || // Au moins une minuscule
                        !/[0-9]/.test(password) || // Au moins un chiffre
                        !/[^a-zA-Z0-9]/.test(password)  // Au moins un caractère spécial
                        ) {
                    event.preventDefault(); // Empêche l'envoi du formulaire
                    document.getElementById("alert-box").style.display = "block";
                }
            });
        </script>

    </body>
</html>
