<?php

// Classe de base pour les personnages
abstract class Personnage {
    // ...
}

// Classe pour les guerriers
class Guerrier extends Personnage {
    // ...
}

// Classe pour les magiciens
class Magicien extends Personnage {
    // ...
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
