<?php

require __DIR__.'/../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
$twig = new Twig_Environment($loader);

$title = 'Titre de la page';

echo $twig->render('twig-template.html.twig', [
    'title' => $title,
]);

