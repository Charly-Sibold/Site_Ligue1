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

        class club {

            private int $id;
            private String $nom_club;
            private String $ligue;

            public function __construct(int $id, String $nom_club, String $ligue) {
                $this->id = $id;
                $this->nom_club = $nom_club;
                $this->ligue = $ligue;
            }
            public function getId(): int {
                return $this->id;
            }
            public function setId(int $id): void {
                $this->id = $id;
            }

            public function setNom_club(String $nom_club): void {
                $this->nom_club = $nom_club;
            }

            public function setLigue(String $ligue): void {
                $this->ligue = $ligue;
            }

                        public function getNom_club(): String {
                return $this->nom_club;
            }

            public function getLigue(): String {
                return $this->ligue;
            }

                }
        ?>
    </body>
</html>
