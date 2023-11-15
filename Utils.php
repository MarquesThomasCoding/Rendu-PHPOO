<?php

// On crée la classe Utils, qui contient des méthodes statiques
class Utils {
    // On crée la méthode statique generateRandomNumber qui permet de générer un nombre aléatoire entre 2 nombres passés en paramètre
    public static function generateRandomNumber(int $min, int $max) {
        return rand($min, $max);
    }
}

?>