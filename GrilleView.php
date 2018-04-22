<?php session_start() ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: dimitry.krychylskyy
 * Date: 15/03/2018
 * Time: 11:33
 */
phpinfo();
include 'Grille.php';
/*
 * Autorefresh
 */
const VIVANTE = "cellule_V";
const MORTE = "cellule_M";

$url1=$_SERVER['REQUEST_URI'];

header("Refresh: 5; URL=$url1");

if (!isset($_SESSION['init'])){

    $grilleObj = new Grille();

    $nbLines = $_GET["nbLines"];
    $nbColonnes = $_GET["nbColonnes"];
    $nbCellViv = $_GET["nbCellViv"];

    if (isset($nbLines) && isset($nbColonnes) && isset($nbCellViv)) {

        $grilleObj->setLignes($nbLines);
        $grilleObj->setColonnes($nbColonnes);
        $grilleObj->setVivantes($nbCellViv);
        $grille = $grilleObj->createGrille();
    }
    $_SESSION['init'] = 1;

    $_SESSION['grille'] = serialize($grille);
}

if (isset($_SESSION['init'])){
    changerEtatCellule3Voisines();
}

$grilleUnserialize = unserialize($_SESSION['grille']);


/* Afficher la grille*/
echo "<div class='grille'>";
foreach ($grilleUnserialize as $line){
    echo '<div class="cologne">';
    foreach ($line as $cell){
        $etat = $cell->getEtat();
        echo "<div class=$etat></div>";
    }
    echo '</div>';
}
echo "</div>";

echo "<a href=\"index.html\">Retour</a>";


/*
 * Les fonctions
 */

function changerEtatCellule3Voisines(){
    $grilleUnserializeBoucle = unserialize($_SESSION['grille']);
    for ($i = 0; $i < count($grilleUnserializeBoucle); $i++){
        for ($j = 0; $j < count($grilleUnserializeBoucle[$i]); $j++){

            // Creation tableau ou tous cellules = mortes
            $celluleCourante = $grilleUnserializeBoucle[$i][$j];
            $countCellulesVivantes = 0;
            var_dump($celluleCourante->getEtat());
            if (isset($celluleCourante) && $celluleCourante->getEtat() == MORTE){
                // Verif à gauche
                if (isset($grilleUnserializeBoucle[$i][$j - 1])&& $grilleUnserializeBoucle[$i][$j - 1]->getEtat() == VIVANTE) {
                    //var_dump("Verif à gauche" . "\n" . $grilleUnserializeBoucle[$i][$j - 1]->getEtat() . "\n");

                    $countCellulesVivantes++;

                }
                // Verif cellule à droite
                if (isset($grilleUnserializeBoucle[$i][$j + 1 ])&& $grilleUnserializeBoucle[$i][$j + 1]->getEtat() == VIVANTE) {
                    $countCellulesVivantes++;
                    //var_dump("Verif à droit" . "\n" . $grilleUnserializeBoucle[$i][$j + 1]->getEtat() . "\n");

                }
                // Verif cellule à haut
                if (isset($grilleUnserializeBoucle[$i + 1][$j])&& $grilleUnserializeBoucle[$i + 1][$j]->getEtat() == VIVANTE) {
                    $countCellulesVivantes++;
                    //var_dump("Verif à haut" . "\n" . $grilleUnserializeBoucle[$i + 1][$j]->getEtat() . "\n");

                }
                // Verif cellule en bas
                if (isset($grilleUnserializeBoucle[$i - 1][$j])&& $grilleUnserializeBoucle[$i - 1][$j]->getEtat() == VIVANTE) {
                    $countCellulesVivantes++;
                    //var_dump("Verif en bas" . "\n" . $grilleUnserializeBoucle[$i - 1][$j]->getEtat() . "\n");

                }
                // Verif cellule diagonale à haut - gauche
                if (isset($grilleUnserializeBoucle[$i - 1][$j - 1])&& $grilleUnserializeBoucle[$i - 1][$j - 1]->getEtat() == VIVANTE) {
                    $countCellulesVivantes++;
                    //var_dump("Verif à haut - gauche" . "\n" . $grilleUnserializeBoucle[$i - 1][$j - 1]->getEtat() . "\n");
                }
                // Verif cellule diagonale à haut - droit
                if (isset($grilleUnserializeBoucle[$i - 1][$j + 1])&& $grilleUnserializeBoucle[$i - 1][$j + 1]->getEtat() == VIVANTE) {
                    $countCellulesVivantes++;
                    //var_dump("Verif à haut - droit" . "\n" . $grilleUnserializeBoucle[$i - 1][$j + 1]->getEtat() . "\n");
                }
                // Verif cellule diagonale en bas - gauche
                if (isset($grilleUnserializeBoucle[$i + 1][$j - 1])&& $grilleUnserializeBoucle[$i + 1][$j - 1]->getEtat() == VIVANTE) {
                    $countCellulesVivantes++;
                    //var_dump("Verif en bas - gauche" . "\n" . $grilleUnserializeBoucle[$i + 1][$j - 1]->getEtat() . "\n");
                }
                // Verif cellule diagonale en bas - droit
                if (isset($grilleUnserializeBoucle[$i + 1][$j + 1])&& $grilleUnserializeBoucle[$i + 1][$j + 1]->getEtat() == VIVANTE) {
                    $countCellulesVivantes++;
                    //var_dump("Verif en bas - droit" . "\n" . $grilleUnserializeBoucle[$i + 1][$j + 1]->getEtat() . "\n");
                }
                if ($countCellulesVivantes == 3){
                    $celluleCourante->setEtat(VIVANTE);
                }
            }
        }
    }
    $_SESSION['grille'] = serialize($grilleUnserializeBoucle);
};
?>

</body>
</html>
