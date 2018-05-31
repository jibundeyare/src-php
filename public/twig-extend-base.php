<?php

require __DIR__.'/../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
$twig = new Twig_Environment($loader);

$title = 'Extend base twig';
$greeting = 'Hello Extend!';

echo $twig->render('extend-base-twig.html.twig', [
    'title' => $title,
    'greeting' => $greeting,
]);
