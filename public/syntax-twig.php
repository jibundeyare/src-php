<?php

require __DIR__.'/../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
$twig = new Twig_Environment($loader);

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

$now = new DateTime();

echo $twig->render('syntax-twig.html.twig', [
    'greeting' => $greeting,
    'items' => $items,
    'rows' => $rows,
    'html' => $html,
    'now' => $now,
]);
