<?php

// Classe de base pour les personnages
abstract class Personnage {
    protected $nom;
    protected $vie;
    protected $attaque;
    protected $defense;
    
    public function __construct($nom, $vie, $attaque, $defense) {
        $this->nom = $nom;
        $this->vie = $vie;
        $this->attaque = $attaque;
        $this->defense = $defense;
    }
    
    public function getNom() {
        return $this->nom;
    }
    
    public function getVie() {
        return $this->vie;
    }
    
    public function attaquer(Personnage $cible) {
        $cible->subirDegats($this->attaque);
    }
    
    public function subirDegats($degats) {
        $this->vie -= $degats;
        if ($this->vie < 0) {
            $this->vie = 0;
        }
    }
    
    abstract public function actionSpeciale();
}

// Classe pour les guerriers
class Guerrier extends Personnage {
    public function __construct($nom) {
        parent::__construct($nom, 100, rand(20, 40), rand(10, 19));
    }
    
    public function actionSpeciale() {
        // Les guerriers n'ont pas d'action spéciale
        echo "Le guerrier n'a pas d'action spéciale.\n";
    }
}

// Classe pour les magiciens
class Magicien extends Personnage {
    private $peutEndormir = true;
    
    public function __construct($nom) {
        parent::__construct($nom, 100, rand(5, 10), 0);
    }
    
    public function actionSpeciale() {
        if ($this->peutEndormir) {
            $this->peutEndormir = false;
            echo "Le magicien endort son adversaire pendant 15 secondes !\n";
            // Logique pour endormir l'adversaire pendant 15 secondes
            sleep(15);
            $this->peutEndormir = true;
        } else {
            echo "Le magicien ne peut pas encore endormir son adversaire. Veuillez patienter.\n";
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifie si les clés "nom" et "type" sont définies dans le tableau $_POST
    if (isset($_POST['nom']) && isset($_POST['type'])) {
        // Création du personnage
        $nomPersonnage = $_POST['nom'];
        $typePersonnage = $_POST['type'];

        $personnage = null;

        if ($typePersonnage === "guerrier") {
            $personnage = new Guerrier($nomPersonnage);
        } elseif ($typePersonnage === "magicien") {
            $personnage = new Magicien($nomPersonnage);
        } else {
            echo "Type de personnage invalide.";
            exit;
        }

        // Interaction avec le personnage
        $personnage->actionSpeciale();

        // Affichage des informations du personnage
        echo "Nom du personnage : " . $personnage->getNom() . "\n";
        echo "Points de vie : " . $personnage->getVie() . "\n";
        echo "Attaque : " . $personnage->attaque . "\n";
        echo "Défense : " . $personnage->defense . "\n";
    } else {
        echo "Veuillez saisir toutes les informations du personnage.";
    }
}

?>
