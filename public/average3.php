<?php

/**
 * Ce programme calcul une moyenne
 * 
 * Pour transmettre des valeurs, utilisez l'url suivante :
 * http://localhost/average3.php?values[]=2&values[]=42&values[]=123&values[]=3.14
 */

if (!isset($_GET['values'])) {
    echo 'Vous devez spécifier des valeurs<br />';
    exit();
}

$values = $_GET['values'];
$average = 0;

echo '<ol>';

for ($i = 0; $i < count($values); $i++) {
    echo "<li>{$values[$i]}</li>";
    $average += $values[$i];
}

echo '</ol>';

$average /= count($values);

echo "La moyenne : $average<br />";

