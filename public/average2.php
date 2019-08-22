<?php

$values = [2, 42, 123, 3.14];
$average = 0;

echo '<ol>';

for ($i = 0; $i < count($values); $i++) {
    echo "<li>{$values[$i]}</li>";
    $average += $values[$i];
}

echo '</ol>';

$average /= count($values);

echo "La moyenne : {$average}<br />";

