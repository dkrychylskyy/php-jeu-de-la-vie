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
include 'Grille.php';

/*
 * Autorefresh
 */


$url1=$_SERVER['REQUEST_URI'];

header("Refresh: 3; URL=$url1");

if (!isset($_SESSION['initGrille'])){

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
    $_SESSION['initGrille'] = 1;

    $_SESSION['grille'] = serialize($grille);
}

echo $_SESSION['initGrille'];

$grille = unserialize($_SESSION['grille']);


/* Afficher la grille*/
echo "<div class='grille'>";
foreach ($grille as $line){
    echo '<div class="cologne">';
    foreach ($line as $cell){
        $etat = $cell->getEtat();
        echo "<div class=$etat></div>";
    }
    echo '</div>';
}
echo "</div>";

echo "<a href=\"index.html\">Retour</a>";
?>

</body>
</html>
