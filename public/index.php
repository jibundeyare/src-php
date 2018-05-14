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

// envoi d'une requête SQL à la BDD et récupération du résultat sous forme de tableau PHP dans la variable `$items`
$items = $conn->fetchAll('SELECT * FROM todo');

// parcours de chacun des éléments tu tableau `$items`
foreach ($items as $item) {
    // à chaque itération de la boucle, la variable `$item` contient une ligne de la table
    // chaque clé alpha-numérique représente une colonne de la table
    echo $item['id'].'<br />';
    echo $item['name'].'<br />';
    echo $item['deadline'].'<br />';
    echo $item['done'].'<br />';
    echo $item['description'].'<br />';
    echo '<br />';
}
