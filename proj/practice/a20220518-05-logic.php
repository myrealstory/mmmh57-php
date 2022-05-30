<?php

echo (5 && 7) ? 'yes<br>' : 'no<br>';

$a = 5 || 7;

echo $a ? '$a=true<br>' : '$a=false<br>';

$b = 5 or 7; // and, or 優先權比 = 還低

echo "\$b=$b<br>";
$c = (5 or 7);

echo "\$c=$c<br>";
