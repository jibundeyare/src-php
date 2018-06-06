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

// configuration du moteur de template Twig
// spécification du dossier où sont stockés les templates
$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates');
// initialisation du moteur de template Twig
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

// initilisation de variables qui contiendront des infos pour l'utilisateur
$infos = '';
$errors = [];

// vérification de l'envoi de données par l'utilisateur
if ($_POST) {
    // récupération des données envoyées par l'utilisateur dans la variable `$student`
    // ceci permet de réafficher les données de l'utilisateur s'il a mal rempli le formulaire
    $student = $_POST;

    // vérification si le champ est vide
    if (empty($_POST['firstname'])) {
        // ajout d'un message d'erreur si le champ est vide
        $errors['firstname'] = 'Veuillez renseigner le champ';
    }

    // vérification si le champ est vide
    if (empty($_POST['lastname'])) {
        // ajout d'un message d'erreur si le champ est vide
        $errors['lastname'] = 'Veuillez renseigner le champ';
    }

    // vérification si le champ est vide
    if (empty($_POST['promotion_id'])) {
        // ajout d'un message d'erreur si le champ est vide
        $errors['promotion_id'] = 'Veuillez renseigner le champ';
    } else {
        // recherche de la promotion sélectionnée
        // la variable `$promotion` est égale à `false` si la promotion n'existe pas
        $promotion = $conn->fetchAssoc('SELECT * FROM promotions WHERE id = :id', [
            'id' => $_POST['promotion_id'],
        ]);

        // vérification si la promotion sélectionnée a été trouvée
        if (empty($promotion)) {
            // ajout d'un message d'erreur si la promotion n'a pas été trouvée
            $errors['promotion_id'] = 'Veuillez renseigner le champ';
        }
    }

    // vérification de l'absence d'erreurs
    if (empty($errors)) {
        // envoi d'une requête SQL à la BDD et récupération du nombre de lignes modifiées dans la variable `$count`
        // la méthode `update()` permet d'ajouter des paramètres à la requête SQL de façon sécurisée
        // requête SQL générée : `UPDATE students SET firstname = '$_POST['firstname']', lastname = '$_POST['lastname']', promotion_id = '$_POST['promotion_id']' WHERE id = '$id'`
        $count = $conn->update('students', [
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'promotion_id' => $_POST['promotion_id'],
        ], [
            'id' => $id,
        ]);

        // message de confirmation
        $infos = 'Les données ont été mises à jour';
    }
}

// affichage du rendu du template
echo $twig->render('student-edit.html.twig', [
    // transmission de variables au template
    // la clé (à gauche) représente le nom de la variable dans le template Twig
    // la variable (à droite) est la valeur de la variable dans le template Twig
    'student' => $student,
    'promotions' => $promotions,
    'infos' => $infos,
    'errors' => $errors,
]);
