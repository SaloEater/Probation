<?php
$arr = ['Alex', 'vasya', 'dima', 'Petr', 'ivan'];
$counter = 0;
foreach ($arr as $value)
{
    if(ctype_lower($value[0]))$counter++;
}
echo $counter . PHP_EOL;
?>