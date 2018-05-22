<?php

require __DIR__.'/../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
$twig = new Twig_Environment($loader);

$twig->getExtension('Twig_Extension_Core')->setNumberFormat(2, ',', ' ');
$twig->getExtension('Twig_Extension_Core')->setTimezone('Europe/Paris');
Locale::setDefault('fr-FR');
$twig->addExtension(new Twig_Extensions_Extension_Intl());

$greeting = 'Hello Syntax!';

$items = [
    'foo',
    'bar',
    'baz',
];

$rows = [
    [
        'id' => 1,
        'name' => 'foo',
    ], [
        'id' => 2,
        'name' => 'bar',
    ], [
        'id' => 3,
        'name' => 'baz',
    ]
];

$html = '<strong>foo bar baz</strong>';

$pi = M_PI;

$now = new DateTime();

echo $twig->render('syntax-twig.html.twig', [
    'greeting' => $greeting,
    'items' => $items,
    'rows' => $rows,
    'html' => $html,
    'pi' => $pi,
    'now' => $now,
]);
