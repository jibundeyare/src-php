<?php

// activation de la fonction autoloading de Composer
require __DIR__.'/../vendor/autoload.php';

// configuration du moteur de template Twig
// spécification du dossier où sont stockés les templates
$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
// initialisation du moteur de template Twig
$twig = new Twig_Environment($loader);

// initialisation d'une variable
$greeting = 'Hello Twig!';

// affichage du rendu du template
echo $twig->render('hello-twig.html.twig', [
    // transmission de variables au template
    // la clé (à gauche) représente le nom de la variable dans le template Twig
    // la variable (à droite) est la valeur de la variable dans le template Twig
    'greeting' => $greeting,
]);
