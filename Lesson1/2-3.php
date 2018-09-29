<?php
$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9];
$map = array_map(
    function($el)
    {
        return $el*$el;
    }, $arr);
print_r($map);
?>