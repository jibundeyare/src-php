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

// affectation de l'id en utilisant l'opérateur ternaire
$id = !empty($_GET['id']) ? $_GET['id'] : 0;

// l'utilisation de l'opérateur ternaire remplace le bloc de code suivant
// if (!empty($_GET['id'])) {
//     $id = $_GET['id'];
// } else {
//     $id = 0;
// }

// envoi d'une requête SQL à la BDD et récupération du premier résultat sous forme de tableau PHP dans la variable `$student`
$student = $conn->fetchAssoc('SELECT * FROM students WHERE id = :id', [
    'id' => $id,
]);

// envoi d'une requête SQL à la BDD et récupération du résultat sous forme de tableau PHP dans la variable `$promotions`
$promotions = $conn->fetchAll('SELECT * FROM promotions');

echo $twig->render('student-edit.html.twig', [
    'student' => $student,
    'promotions' => $promotions,
]);
