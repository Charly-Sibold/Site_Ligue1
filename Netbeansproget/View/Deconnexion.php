<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
// Démarrez la session (si ce n'est pas déjà fait)


// Déconnectez l'utilisateur en détruisant la session
session_destroy();

// Assurez-vous que toutes les sorties sont terminées avant la redirection
ob_clean();

// Redirigez l'utilisateur vers la page d'accueil ou une autre page
header("Location: /");
exit();
?>



    </body>
</html>
