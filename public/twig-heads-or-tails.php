<?php

require __DIR__.'/../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
$twig = new Twig_Environment($loader);

$title = 'Titre de la page';

$error = null;
$bet = null;
$side = null;
$outcome = null;

// la variable $_GET['bet'] doit contenir le pari du joueur

if (!isset($_GET['bet'])) {
    // l'index 'bet' de la variable $_GET n'est pas initialisé
    $error = 'Vous devez parier pile (0) ou face (1)';
} elseif ($_GET['bet'] != '0' && $_GET['bet'] != '1') {
    // la valeur de $_GET['bet'] est différente de 0 et 1, c'est une valeur qui n'est pas autorisée
    $error = 'Vous devez parier pile (0) ou face (1)';
}

if (!$error) {
    if ($_GET['bet'] == 0) {
        $bet = 'pile';
    } elseif ($_GET['bet'] == 1) {
        $bet = 'face';
    }

    // tirage au sort
    // pile (0) ou face (1)
    $draw = random_int(0, 1);

    if ($draw == 0) {
        $side = 'pile';
    } else {
        $side = 'face';
    }

    if ($draw == $_GET['bet']) {
        // le tirage et la pari correspondent
        $outcome = 'gagné :)';
    } else {
        // le tirage et la pari ne correspondent pas
        $outcome = 'perdu :(';
    }
}

// affichage du template
echo $twig->render('twig-heads-or-tails.html.twig', [
    'title' => $title,
    'error' => $error,
    'bet' => $bet,
    'side' => $side,
    'outcome' => $outcome,
]);

