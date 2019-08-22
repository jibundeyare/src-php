<?php

// activation du système d'autoloading de Composer
require __DIR__.'/../vendor/autoload.php';

// configuration du moteur de template Twig
// spécification du dossier où sont stockés les templates
$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
// initialisation du moteur de template Twig
$twig = new Twig_Environment($loader);

// configuration de l'affichacge des nombres à virgules flottant (seulement deux chiffres après la virgule avec un espace aux milliers)
$twig->getExtension('Twig_Extension_Core')->setNumberFormat(2, ',', ' ');
// configuration du fuseau horaire
$twig->getExtension('Twig_Extension_Core')->setTimezone('Europe/Paris');
// configuration de la locale `fr-FR`
// @warning requiert l'extension php-intl
Locale::setDefault('fr-FR');
// chargement de l'extension `Twig_Extensions_Extension_Intl` qui permet de localiser l'affichage des dates
// @warning requiert l'extension php-intl
$twig->addExtension(new Twig_Extensions_Extension_Intl());

// initialisation d'une variable
$greeting = 'Hello Syntax!';

// initialisation d'un tableau
$items = [
    'foo',
    'bar',
    'baz',
];

// initialisation d'un tableau contenant des tableaux à clés alpha-numériques
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

// initialisation d'une variable contenant du code HTML
$html = '<strong>foo bar baz</strong>';

// initialisation d'une variable contenant un nombre à virgule flottant
$pi = M_PI;

// initialisation d'une variable contenant un objet de type `DateTime`
$now = new DateTime();

// affichage du rendu du template
echo $twig->render('twig-syntax.html.twig', [
    // transmission de variables au template
    // la clé (à gauche) représente le nom de la variable dans le template Twig
    // la variable (à droite) est la valeur de la variable dans le template Twig
    'greeting' => $greeting,
    'items' => $items,
    'rows' => $rows,
    'html' => $html,
    'pi' => $pi,
    'now' => $now,
]);

