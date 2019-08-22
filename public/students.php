<?php

// @todo externaliser la config de la BDD

// déclaration des classes PHP qui seront utilisées
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

// activation du système d'autoloading de Composer
require __DIR__.'/../vendor/autoload.php';

// création d'une variable avec une configuration par défaut
$config = new Configuration();

// création d'un tableau avec les paramètres de connection à la BDD
$connectionParams = [
    'driver'    => 'pdo_mysql',
    'host'      => '127.0.0.1',
    'port'      => '3306',
    'dbname'    => 'src_php',
    'user'      => 'root',
    'password'  => '123',
    'charset'   => 'utf8mb4',
];

// connection à la BDD
// la variable `$conn` permet de communiquer avec la BDD
$conn = DriverManager::getConnection($connectionParams, $config);

// configuration du moteur de template Twig
// spécification du dossier où sont stockés les templates
$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
// initialisation du moteur de template Twig
$twig = new Twig_Environment($loader);

// créer une requête préparée à partir du code SQL et renvoie un pointeur sur le résultat
$students = $conn->executeQuery('SELECT students.id, firstname, lastname, promotions.name FROM students INNER JOIN promotions ON students.promotion_id = promotions.id');

// affichage du rendu du template
echo $twig->render('students.html.twig', [
    // transmission de variables au template
    // la clé (à gauche) représente le nom de la variable dans le template Twig
    // la variable (à droite) est la valeur de la variable dans le template Twig
    'students' => $students,
]);

