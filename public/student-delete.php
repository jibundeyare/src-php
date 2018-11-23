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

// l'id est récupéré depuis l'URL en GET
// affectation de l'id en utilisant l'opérateur ternaire
// si l'id est vide, on affecte la valeur 0
$id = !empty($_GET['id']) ? $_GET['id'] : 0;

// l'utilisation de l'opérateur ternaire remplace le bloc de code suivant
// if (!empty($_GET['id'])) {
//     $id = $_GET['id'];
// } else {
//     $id = 0;
// }

// envoi d'une requête SQL à la BDD et récupération du nombre de lignes modifiées dans la variable `$count`
// la méthode `delete()` permet d'ajouter des paramètres à la requête SQL de façon sécurisée
// requête SQL générée : `DELETE FROM students WHERE id = '$id'`
$count = $conn->delete('students', [
    'id' => $id,
]);

// redirection temporaire (302) vers une autre page
header('location: /students.php', true, 302);
// arrêt immédiat du script pour éviter d'afficher du HTML avant la redirection
exit();

