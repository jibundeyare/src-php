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

        <form method="post">
            <p>Le 1er champ est protégé contre les injections de code JS grâce à la fonction `htmlentities()`.</p>
            <p>Essayez de hacker ce champ en insérant le code suivant :</p>
            <code>Lorem&quot; /&gt;&lt;script&gt;alert(&quot;JS code injection&quot;)&lt;/script&gt;</code>
            <p>Validez le formulaire et observez.</p>
            <div>
                <input type="text" name="firstname" value="<?= htmlentities($firstname) ?>" placeholder="prénom" />
            </div>

            <hr />

            <p>Le 2ème champ est vulnérable aux injections de code JS car il n'utilise pas la fonction `htmlentities()`</p>
            <p>Maintenant essayez de hacker ce champ en insérant le code suivant :</p>
            <code>Ipsum&quot; /&gt;&lt;script&gt;alert(&quot;JS code injection&quot;)&lt;/script&gt;</code>
            <p>Validez le formulaire et observez.</p>
            <div>
                <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="nom" />
            </div>

            <hr />

            <p>Est-ce que vous avez vu la différence ?</p>
            <div>
                <button type="submit">Valider</button>
            </div>
        </form>

    </body>
</html>
