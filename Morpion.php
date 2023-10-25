<?php

class Morpion {
    public $joueur1 = 'X';
    public $joueur2 = 'O';

    public $plateau = [
        0 => [null, null, null],
        1 => [null, null, null],
        2 => [null, null, null],
    ];

    public $joueurActif = 'X';
    public $gagnant;

    public $erreur;

    public function jouerUnCoup(int $x, int $y) {
        // On vérifie que les coordonnées sont correctes
        if ($x >= 0 && $x <= 2 && $y >= 0 && $y <= 2) {

            // On place notre jeton
            $this->plateau[$x][$y] = $this->joueurActif;

            if ($this->existeComboGagnant()) {
                // S'il y a un gagnant
                $this->gagnant = $this->joueurActif;
            } else {
                // Sinon
                // On change de joueur actif
                if ($this->joueurActif == 'O') {
                    $this->joueurActif = 'X';
                } else {
                    $this->joueurActif = 'O';
                }
            }
        } else {
            // Si les coordonnées sont pas bonnes, on a une erreur
            $this->erreur = 'La case ciblée n\'existe pas.';
        }
    }

    public function existeComboGagnant(): bool {
        foreach ($this->plateau as $x => $ligne) {
            foreach ($ligne as $y => $jeton) { // On vérifie pour chaque case
                if ($jeton === null) continue; // Si la case est vide elle nous intéresse pas

                for ($i = -1; $i <= 1; $i++) {
                    for ($j = -1; $j <= 1; $j++) { // On va vérifier les cases autour (donc +- 1 par rapport à x et y)

                        if ($i === 0 && $j === 0) continue; // Si on est sur 0 et 0 on saute (même case)

                        if (
                            !isset($this->plateau[$i + $x][$j + $y])
                            || !isset($this->plateau[-$i + $x][-$j + $y])
                        ) continue; // Si une des cases n'existe pas on saute

                        if (
                            $this->plateau[$i + $x][$j + $y] === $jeton
                            && $this->plateau[-$i + $x][-$j + $y] === $jeton // Et si les deux cases valent la même chose que la case initiale
                        ) return true;
                    }
                }
            }
        }

        return false;
    }

    public function estMatchNul(): bool {
        foreach ($this->plateau as $ligne) {
            foreach ($ligne as $case) {
                if ($case === null) {
                    return false;
                }
            }
        }

        return !$this->existeComboGagnant();
    }
}
