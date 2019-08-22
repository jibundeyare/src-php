<?php

/**
 * Ce programme est un jeu de pile ou face
 *
 * Pour parier pile, utilisez l'url suivante :
 * http://localhost/heads-or-tails.php?bet=0
 *
 * Pour parier face, utilisez l'url suivante :
 * http://localhost/heads-or-tails.php?bet=1
 */

// la variable $_GET['bet'] doit contenir le pari du joueur

// vérifions si la clé 'bet' existe dans le tableau $_GET
// vérifions aussi si la valeur associée à la clé 'bet' est différente de 0 et de 1
if (!isset($_GET['bet'])) {
    // la clé 'bet' de la variable $_GET n'existe pas
    echo 'Vous devez parier pile (0) ou face (1)<br />';
    exit();
} elseif ($_GET['bet'] != '0' && $_GET['bet'] != '1') {
    // la valeur de $_GET['bet'] est différente de 0 et 1, c'est une valeur qui n'est pas autorisée
    echo 'Vous devez parier pile (0) ou face (1)<br />';
    exit();
}

// affichons le pari du joueur
if ($_GET['bet'] == 0) {
    echo 'Vous avez parié : pile<br />';
} elseif ($_GET['bet'] == 1) {
    echo 'Vous avez parié : face<br />';
}

// tirage au sort de pile (0) ou face (1)
$draw = random_int(0, 1);

// affichons le tirage
if ($draw == 0) {
    echo 'Le tirage donne : pile<br />';
} elseif ($draw == 1) {
    echo 'Le tirage donne : face<br />';
}

// comparons la valeur pariée par le joueur et la valeur du tirage au sort
if ($draw == $_GET['bet']) {
    // le tirage et la pari correspondent
    echo 'L\'issue : gagné :)<br />';
} else {
    // le tirage et la pari ne correspondent pas
    echo 'L\'issue : perdu :(<br />';
}

