<?php
/**
 * Created by PhpStorm.
 * User: dimitry.krychylskyy
 * Date: 15/03/2018
 * Time: 11:50
 */
include 'Cellule.php';

class Grille
{

    public $lignes;
    public $colonnes;
    public $vivantes;

    /**
     * @param mixed $colonnes
     */
    public function setColonnes($colonnes): void
    {
        $this->colonnes = $colonnes;
    }

    /**
     * @param mixed $lignes
     */
    public function setLignes($lignes): void
    {
        $this->lignes = $lignes;
    }

    /**
     * @param mixed $vivantes
     */
    public function setVivantes($vivantes): void
    {
        $this->vivantes = $vivantes;
    }

    public function createGrille()
    {
        $cellule_vivante = new Cellule("cellule_V");
        $cellule_morte = new Cellule("cellule_M");
        $grille = Array();
        $cmpt = 0;

        for ($i = 0; $i < $this->lignes; $i++) {
            for ($j = 0; $j < $this->colonnes; $j++) {
                // Creation tableau ou tous cellules = mortes
                $grille[$i][$j] = $cellule_morte;
            }
        }

        // Compteur pour mettre en place cellules vivante
        // en quantité predefinié par utilisateur
        while ($cmpt < $this->vivantes) {
            $random_X = random_int(0, $this->lignes - 1);
            $random_Y = random_int(0, $this->colonnes - 1);
            if ($grille[$random_X][$random_Y] != $cellule_vivante) {
                $grille[$random_X][$random_Y] = $cellule_vivante;
            }
            $cmpt++;
        }
        return $grille;
    }
}