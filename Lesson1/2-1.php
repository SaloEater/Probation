<?php
$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9];

$comp = array_reduce($arr,
    function ($_comp, $el)
    {
        return $_comp*=$el;
    }, 1);

print_r($comp);
?>