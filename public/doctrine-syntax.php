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

echo "<h1>syntaxe de Doctrine</h1>";

echo "<h2>SELECT de plusieurs lignes avec la méthode `fetchAll()`</h2>";

// envoi d'une requête SQL à la BDD et récupération du jeu de résultats sous la forme d'un tableau PHP dans la variable `$items`
$items = $conn->fetchAll('SELECT * FROM students INNER JOIN promotions ON students.promotion_id = promotions.id');

// parcours de chacun des éléments du tableau `$items`
foreach ($items as $item) {
    // à chaque itération de la boucle, la variable `$item` contient une ligne de la table
    // chaque clé alpha-numérique représente une colonne de la table
    echo $item['id'].'<br />';
    echo $item['firstname'].'<br />';
    echo $item['lastname'].'<br />';
    echo $item['name'].'<br />';
    echo '<br />';
}

echo "<h2>SELECT de plusieurs lignes avec la méthode `executeQuery()`</h2>";

$promotionId = 1;

// création une requête préparée et récupération d'un pointeur sur le jeu de résultats dans la variable `$stmt`
// la méthode `executeQuery()` permet d'ajouter des paramètres à la requête SQL de façon sécurisée
$stmt = $conn->executeQuery('SELECT students.id, firstname, lastname, promotions.name FROM students INNER JOIN promotions ON students.promotion_id = promotions.id WHERE students.promotion_id = :promotion_id', [
    'promotion_id' => $promotionId,
]);

// la méthode `rowCount()` permet de savoir combien de lignes le résultat comporte
echo 'results : '.$stmt->rowCount().'<br />';
echo '<br />';

// boucle `while` qui récupère les résultats ligne par ligne
while ($item = $stmt->fetch()) {
    // à chaque itération de la boucle, la variable `$item` contient une ligne de la table
    // chaque clé alpha-numérique représente une colonne de la table
    echo $item['id'].'<br />';
    echo $item['firstname'].'<br />';
    echo $item['lastname'].'<br />';
    echo $item['name'].'<br />';
    echo '<br />';
}

echo "<h2>SELECT d'une seule ligne avec la méthode `fetchAssoc()`</h2>";

$studentId = 1;

// envoi d'une requête SQL à la BDD et récupération du premier résultat sous la forme d'un tableau PHP dans la variable `$item`
// la méthode `fetchAssoc()` permet d'ajouter des paramètres à la requête SQL de façon sécurisée
$item = $conn->fetchAssoc('SELECT * FROM students WHERE id = :id', [
    'id' => $studentId,
]);

// vérification de la présence d'un résultat
// si la méthode `fetchAssoc()` ne renvoie aucun résultat, `$item` est égal à `false`
if ($item) {
    // affichage des données de chaque colonne
    // chaque clé alpha-numérique représente une colonne de la table
    echo $item['id'].'<br />';
    echo $item['firstname'].'<br />';
    echo $item['lastname'].'<br />';
    echo '<br />';
}

echo "<h2>INSERT d'une nouvelle ligne avec la méthode `insert()`</h2>";

$firstname = 'Foo';
$lastname = 'Bar';
$promotionId = 4;

// envoi d'une requête SQL à la BDD et récupération du nombre de lignes insérées dans la variable `$count`
// la méthode `insert()` permet d'ajouter des paramètres à la requête SQL de façon sécurisée
// requête SQL générée : `INSERT INTO students (firstname, lastname, promotion_id) VALUES ('$firstname', '$lastname', '$promotionId')`
$count = $conn->insert('students', [
    'firstname' => $firstname,
    'lastname' => $lastname,
    'promotion_id' => $promotionId,
]);

// récupération de l'id du dernier élément inséré en BDD
$lastInsertId = $conn->lastInsertId();

echo 'nombre d\'éléments insérés : '.$count.'<br />';
echo 'id de l\'élément inséré : '.$lastInsertId.'<br />';

echo "<h2>UPDATE d'une ligne avec la méthode `update()`</h2>";

$id = $lastInsertId;
$lastname = 'Lorem';

// envoi d'une requête SQL à la BDD et récupération du nombre de lignes modifiées dans la variable `$count`
// la méthode `update()` permet d'ajouter des paramètres à la requête SQL de façon sécurisée
// requête SQL générée : `UPDATE students SET lastname = '$lastname' WHERE id = '$id'`
$count = $conn->update('students', [
    'lastname' => $lastname,
], [
    'id' => $id,
]);

echo 'nombre d\'éléments modifiés : '.$count.'<br />';

echo "<h2>DELETE d'une ligne avec la méthode `delete()`</h2>";

$id = $lastInsertId;

// envoi d'une requête SQL à la BDD et récupération du nombre de lignes modifiées dans la variable `$count`
// la méthode `delete()` permet d'ajouter des paramètres à la requête SQL de façon sécurisée
// requête SQL générée : `DELETE FROM students WHERE id = '$id'`
$count = $conn->delete('students', [
    'id' => $id,
]);

echo 'nombre d\'éléments supprimés : '.$count.'<br />';

echo "<h2>UPDATE de plusieurs lignes avec la méthode `executeUpdate()`</h2>";

$firstname = 'Lorem';
$lastname = 'Ipsum';
$promotionId = 4;

// création une requête préparée et récupération du nombre de lignes modifiées dans la variable `$count`
// la méthode `executeUpdate()` permet d'ajouter des paramètres à la requête SQL de façon sécurisée
// avec la méthode `executeUpdate()`, il est possible de faire des requêtes `INSERT`, `DELETE`, `UPDATE`, `ALTER` ou toute requête autre qu'un `SELECT`
$count = $conn->executeUpdate('UPDATE students SET firstname = :firstname, lastname = :lastname WHERE promotion_id = :promotion_id', [
    'firstname' => $firstname,
    'lastname' => $lastname,
    'promotion_id' => $promotionId,
]);

echo 'nombre d\'éléments modifiés : '.$count.'<br />';

