<?php

$values = [2, 42, 123, 3.14];
$average = 0;

for ($i = 0; $i < count($values); $i++) {
    echo $values[$i].'<br />';
    $average += $values[$i];
}

$average /= count($values);

echo "La moyenne : {$average}<br />";

