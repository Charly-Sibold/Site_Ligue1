<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Router
 *
 * @author charlysbl26
 */
class Router {
 	private array $routes;

    	public function __construct() {
        		$this->routes=[];
    	}


    
    
    // Ajoute une route au routeur
    public function addRoute($url, $controllerFile) {
        $this->routes[$url] = $controllerFile;
    }

    // Traite la demande actuelle
    public function execute($url) {
        if (array_key_exists($url, $this->routes)) {
            // Si l'URL correspond à une route, incluez le fichier du contrôleur
            $controllerFile = $this->routes[$url];
            if (file_exists($controllerFile)) {
                include_once($controllerFile);
            } else {
                // Gérer les erreurs si le fichier du contrôleur n'existe pas
                echo "Erreur : Contrôleur non trouvé";
            }
        } else {
            // Gérer les erreurs 404 si l'URL n'est pas trouvée
            echo "Page non trouvée (Erreur 404)";
        }
    }
}


