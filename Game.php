<?php

// On importe les classes dont on a besoin

require_once 'Hero.php';
require_once 'Enemy.php';
require_once 'Utils.php';


// On crée la classe Game
class Game {

    // On crée un tableau de 3 héros avec leurs caractéristiques
    private $heros = [
        [
            'nom' => 'Seong Gi-hun',
            'marbles' => 15,
            'loss' => 2,
            'gain' => 1,
            'scream_war' => 'Aaaaaa ! Victory !'
        ],
        [
            'nom' => 'Kang Sae-byeok',
            'marbles' => 25,
            'loss' => 1,
            'gain' => 2,
            'scream_war' => 'Nobody can beat me !'
        ],
        [
            'nom' => 'Cho Sang-woo',
            'marbles' => 35,
            'loss' => 0,
            'gain' => 3,
            'scream_war' => 'I\'m the best !'
        ],
    ];

    // On crée les attributs de la classe Game
    // On crée un attribut hero qui sera un objet de la classe Hero
    private $hero;
    // On crée un attribut enemy qui sera un objet de la classe Enemy
    private $enemy;
    // On crée un attribut enemies qui sera un tableau d'objets de la classe Enemy
    private $enemies;
    // On crée un attribut nbEnemies qui sera un entier qui représente le nombre d'ennemis à battre
    private $nbEnemies;

    // On crée la méthode choixHero qui permet de choisir un héro aléatoirement parmi les 3 héros
    private function choixHero() {
        // On génère un nombre aléatoire entre 0 et 2 grâce à la méthode generateRandomNumber de la classe Utils
        $randomIndex = Utils::generateRandomNumber(0, 2);
        $selectedHero = $this->heros[$randomIndex];
        // On crée un objet de la classe Hero avec les caractéristiques du héro choisi
        $this->hero = new Hero(
            $selectedHero['nom'],
            $selectedHero['marbles'],
            $selectedHero['loss'],
            $selectedHero['gain'],
            $selectedHero['scream_war']
        );
        // On affiche le nom du héro choisi
        echo '👤 Le héro choisi est ' . $this->hero->getNom() . '<br>';
    }

    // On crée la méthode createEnemies qui permet de créer 20 ennemis
    private function createEnemies() {
        for($i = 0; $i < 20; $i++) {
            // On crée un objet de la classe Enemy avec des caractéristiques nbBilles et Age aléatoires
            $this->enemies[] = new Enemy('Enemy'.$i, Utils::generateRandomNumber(1, 20), Utils::generateRandomNumber(1, 100));
        }
    }

    // On crée la méthode choixDifficulte qui permet de choisir la difficulté du jeu
    public function choixDifficulte() {
        // Difficulté 1 = facile;
        // Difficulté 2 = difficile;
        // Difficulté 3 = impossible;

        // On génère un nombre aléatoire entre 1 et 3 grâce à la méthode generateRandomNumber de la classe Utils
        $nb = Utils::generateRandomNumber(1, 3);

        // On définit le nombre d'ennemis à battre en fonction de la difficulté choisie
        if($nb == 1) {
            $this->nbEnemies = 5;
            echo "---<br> 🟢 Difficulté définie sur FACILE : 5 ennemis à battre <br>---<br>";
        } elseif($nb == 2) {
            $this->nbEnemies = 10;
            echo "---<br> 🟠 Difficulté définie sur DIFFICILE : 10 ennemis à battre <br>---<br>";
        } else {
            $this->nbEnemies = 20;
            echo "---<br> 🔴 Difficulté définie sur IMPOSSIBLE : 20 ennemis à battre <br>---<br>";
        }
    }


    // On crée la méthode launchGame qui permet de lancer le jeu
    public function launchGame() {
        // On appelle les méthodes choixDifficulte, choixHero et createEnemies
        $this->choixDifficulte();
        $this->choixHero();
        $this->createEnemies();

        // On lance la partie, et on continue tant que le nombre d'ennemis est supérieur à 0 et que le héro a encore des billes
        while ($this->nbEnemies > 0 && $this->hero->getNbBilles() > 0) {
            // On décrémente le nombre d'ennemis à battre
            $this->nbEnemies--;
            // On selectionne aléatoirement un enemi dans notre tableau d'ennemis
            $this->enemy = $this->enemies[Utils::generateRandomNumber(0, count($this->enemies) - 1)];
            // On affiche le nombre de billes du héro
            echo '🎱' . $this->hero->getNom() . ' a ' . $this->hero->getNbBilles() . ' billes <br>';

            // On vérifie si le héro triche ou non
            if($this->hero->tricher($this->enemy)) {
                // Si oui, on passe à l'itération de boucle suivante
                continue;
            }

            // Sinon, on vérifie si le héro a gagné ou perdu en appelant la méthode checkSiHeroAGagneOuPerdu de l'objet hero
            if($this->hero->checkSiHeroAGagneOuPerdu($this->enemy)) {
                // Si le héro a gagné, on appelle la méthode gagner de l'objet hero et la méthode perdre de l'objet enemy
                $this->hero->gagner($this->enemy);
                // On supprime l'ennemi du tableau d'ennemis
                array_splice($this->enemies, array_search($this, $this->enemies), 1);
            } 
            
            // Sinon, on appelle la méthode perdre de l'objet hero et la méthode gagner de l'objet enemy
            else {
                $this->hero->perdre($this->enemy);
                $this->enemy->gagner($this->hero);
            }
        }

        // On affiche le résultat de la partie
        // Si le nombre d'ennemis est égal à 0, le héro a donc gagné
        if($this->nbEnemies == 0) {
            echo '💰 Le héro a gagné le duel ! Il remporte 46.500.000 de Won !';
        // Sinon, le héro a donc perdu
        } else {
            echo '👎🏼 Le héro a perdu toutes ses billes ! Il perd le duel !';
        }
    }
}

// On instancie un objet de la classe Game
$game = new Game();
// On lance le jeu
$game->launchGame();

?>