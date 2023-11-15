<?php


// On crée la classe Player, abstract car on ne veut pas pouvoir créer d'objet de cette classe
abstract class Player {

    // On crée les attributs de la classe Player
    private $nom;
    private $nbBilles;

    // On crée le constructeur de la classe Player
    public function __construct(string $nom, string $nbBilles) {
        $this->nom = $nom;
        $this->nbBilles = $nbBilles;
    }

    // On crée les méthodes de la classe Player utilisées dans les classes Hero et Enemy
    // On crée la méthode gagner, commune aux classes Hero et Enemy, qui prend en paramètre un objet de la classe Player
    // La méthode est abstract car on veut quelle soit définie dans les classes Hero et Enemy selon leurs besoins
    abstract public function gagner(Player $player);

    // On crée les getters et setters de la classe Player
    public function getNbBilles() {
        return $this->nbBilles;
    }

    public function setNbBilles(int $nbBilles) {
        $this->nbBilles = $nbBilles;
    }

    public function getNom() {
        return $this->nom;
    }
}

?>