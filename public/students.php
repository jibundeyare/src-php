<?php

// déclaration des classes PHP qui seront utilisées
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

// activation de la fonction autoloading de Composer
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

$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
$twig = new Twig_Environment($loader);

// créer une requête préparée à partir du code SQL et renvoie un pointeur sur le résultat
$students = $conn->executeQuery('SELECT students.id, firstname, lastname, promotions.name FROM students INNER JOIN promotions ON students.promotion_id = promotions.id');

echo $twig->render('students.html.twig', [
    'students' => $students,
]);
