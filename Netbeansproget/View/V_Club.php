<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="./Css/table_listeClubs.css" rel="stylesheet">
        <title>Les Club</title>
    </head>
    <body>
        <table>
            <caption>
                Liste des différent club .
            </caption>
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nom du club</th>
                    <th scope="col">numéro de ligue</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $length = count($tab);

                for ($i = 0; $i < $length; $i++) {
                    $clubtab = $tab[$i];
                    echo '<tr>';
                    echo '<td>' . $clubtab->getId() . '</td>';
                    echo '<td>' . $clubtab->getNom_club() . '</td>';
                    echo '<td>' . $clubtab->getLigue() . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </body>
</html>
