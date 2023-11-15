<?php

// On importe les classes dont on a besoin
require_once 'Player.php';
require_once 'Utils.php';

// On crée la classe Hero qui hérite de la classe Player
class Hero extends Player {

    // On crée les attributs de la classe Hero
    private $bonus;
    private $malus;
    private $screamWar;

    // On crée le constructeur de la classe Hero,
    // qui hérite du constructeur de la classe Player
    public function __construct(string $nom, int $nbBilles, int $bonus, int $malus, string $screamWar) {
        parent::__construct($nom, $nbBilles);
        $this->bonus = $bonus;
        $this->malus = $malus;
        $this->screamWar = $screamWar;
    }

    // On crée les méthodes de la classe Hero
    // On crée la méthode tricher qui permet de tricher si l'adversaire a plus de 70 ans
    // Cette méthode renvoie true si le héro a triché, false sinon. Elle prend en paramètre un objet de la classe Enemy
    public function tricher(Enemy $enemy) {
        // On génère un nombre aléatoire entre 0 et 1 grâce à la méthode generateRandomNumber de la classe Utils
        $rdNb = Utils::generateRandomNumber(0, 1);
        // Si l'adversaire a plus de 70 ans, le héro peut tricher
        if($enemy->getAge() > 70) {
            echo "👴 L'adversaire a plus de 70 ans, le héro peut tricher <br>";
            // Si le nombre aléatoire est égal à 0, le héro triche
            if($rdNb == 0) {
                // On calcule le nombre de billes gagnées
                $billesGagnees = $enemy->getNbBilles();
                // On ajoute le nombre de billes gagnées au nombre de billes du héro
                $this->setNbBilles($this->getNbBilles()+ $billesGagnees);
                echo "🎺 " . $this->screamWar . '<br>';
                echo "➕ Le héro a triché, l'adversaire avait " . $enemy->getNbBilles() . " billes. Il remporte donc " . $billesGagnees . " billes <br>";
                return true;
            }
            echo "🟰 Le héro ne triche pas <br>";
        }
        return false;
    }

    // On crée la méthode privée (car utilisable uniquement dans la classe Hero) choisirPairOuImpair qui permet de choisir pair ou impair
    private function choisirPairOuImpair() {
        // On génère un nombre aléatoire entre 0 et 1 grâce à la méthode generateRandomNumber de la classe Utils
        $pairOuImpair = Utils::generateRandomNumber(0, 1);
        // On affiche le choix du héro
        if($pairOuImpair == 0) {
            echo "0️⃣ Le héro a choisi pair <br>";
        } else {
            echo "1️⃣ Le héro a choisi impair <br>";
        }
        // On retourne le choix du héro
        return $pairOuImpair;
    }

    // On crée la méthode checkSiHeroAGagneOuPerdu publique (car utilisable en dehors de la classe Hero) qui permet de vérifier si le héro a gagné ou perdu
    public function checkSiHeroAGagneOuPerdu(Player $enemy) {
        if($this->choisirPairOuImpair() == $enemy->getNbBilles()%2) {
            return true;
        } else {
            return false;
        }
    }

    // On crée les méthodes gagner et perdre qui permettent de gagner ou perdre des billes, et qui prennent en paramètre un objet de la classe Enemy
    public function gagner(Player $enemy) {
        // On calcule le nombre de billes gagnées
        $billesGagnees = $this->bonus + $enemy->getNbBilles();
        // On ajoute le nombre de billes gagnées au nombre de billes du héro
        $this->setNbBilles($this->getNbBilles()+ $billesGagnees);
        echo "🎺 " . $this->screamWar . '<br>';
        echo "➕ Le héro a gagné, l'adversaire avait " . $enemy->getNbBilles() . " billes. Il remporte donc " . $enemy->getNbBilles() . " + " . $this->bonus . " billes, soit " . $billesGagnees . " billes <br>";
    }

    public function perdre(Player $enemy) {
        // On calcule le nombre de billes perdues
        $billesPerdues = $this->malus + $enemy->getNbBilles();
        // On retire le nombre de billes perdues au nombre de billes du héro
        $this->setNbBilles($this->getNbBilles()- $billesPerdues);
        echo "➖ Le héro a perdu, l'adversaire avait " . $enemy->getNbBilles() . " billes. Il perd donc " . $enemy->getNbBilles() . " + " . $this->malus . " billes, soit " . $billesPerdues . " billes <br>";
    }

}

?>