<?php

require __DIR__.'/../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
$twig = new Twig_Environment($loader, [
    // @todo désactiver en prod
    'debug' => true,
    'strict_variables' => true,
    // @todo activer en prod
    // 'cache' => __DIR__.'/../var/cache',
]);

$title = 'Titre de la page';

echo $twig->render('twig-template.html.twig', [
    'title' => $title,
]);

