<?php
/**
 * Cet exemple montre l'intérêt d'utiliser la fonction `htmlentities()` pour se protéger des injection de code JS.
 * La fonction `htmlentities()` doit être utilisée au moment d'afficher une variable.
 * En revanche, il faut éviter d'utiliser la fonction `htmlentities()` au moment d'enregistrer en BDD.
 */

$firstname = 'Lorem';
$lastname = 'Ipsum';

if ($_POST) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>

        <h1>`htmlentities()`</h1>

        <h2>Cette page montre comment protéger une application, à l'aide de la fonction `htmlentities()`, contre les attaques par injection de code HTML ou JavaScript.</h2>

        <p><strong>Rappelons néanmoins que le mieux est d'utiliser le moteur de template Twig qui échappe automatiquement les variables avec `htmlentities()` avant affichage.</strong></p>

        <hr />

        <form method="post">
            <h3>Le 1er champ est protégé contre les injections de code JS grâce à la fonction `htmlentities()`.</h3>
            <p>Essayez de hacker ce champ en insérant le code suivant :</p>
            <code>Lorem&quot; /&gt;&lt;script&gt;alert(&quot;JavaScript code injection&quot;)&lt;/script&gt;</code>
            <p>Validez le formulaire et observez.</p>
            <div>
                <input type="text" name="firstname" value="<?= htmlentities($firstname) ?>" placeholder="prénom" />
            </div>

            <hr />

            <h3>Le 2ème champ est vulnérable aux injections de code HTML ou JavaScript car il n'utilise pas la fonction `htmlentities()`.</h3>
            <p>Maintenant essayez de hacker ce champ en insérant le code suivant :</p>
            <code>Ipsum&quot; /&gt;&lt;script&gt;alert(&quot;JavaScript code injection&quot;)&lt;/script&gt;</code>
            <p>Validez le formulaire et observez.</p>
            <div>
                <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="nom" />
            </div>

            <hr />

            <h3>Avez-vous vu la différence ?</h3>
            <p><strong>Regardez le code source pour comprendre comment protéger votre application.</strong>
            </p>
            <div>
                <button type="submit">Valider</button>
            </div>
        </form>

    </body>
</html>
