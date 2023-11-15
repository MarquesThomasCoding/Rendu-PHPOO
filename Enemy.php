<?php

// On importe les classes dont on a besoin
require_once 'Player.php';
require_once 'Utils.php';

// On crée la classe Enemy qui hérite de la classe Player
class Enemy extends Player {
    // On crée les attributs de la classe Enemy
    private $age;

    // On crée le constructeur de la classe Enemy, qui hérite du constructeur de la classe Player
    public function __construct(string $nom, int $nbBilles, int $age) {
        parent::__construct($nom, $nbBilles);
        $this->age = $age;
    }

    // On crée les méthodes de la classe Enemy
    // On crée la méthode gagner qui permet de gagner des billes, et qui prend en paramètre un objet de la classe Player
    public function gagner(Player $hero) {
        // On calcule le nombre de billes gagnées
        $this->setNbBilles($this->getNbBilles()*2);
    }

    // On crée le getter de l'attribut age
    public function getAge() {
        return $this->age;
    }
}

?>