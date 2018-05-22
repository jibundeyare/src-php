<?php

require __DIR__.'/../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
$twig = new Twig_Environment($loader);

$greeting = 'Hello Twig!';

echo $twig->render('hello-twig.html.twig', [
    'greeting' => $greeting,
]);
