<?php
$name = 'Danil';
$counter;
for($i = 0; $i < strlen($name); $i++)
    $counter[$name[$i]]=0;

$text = 'Made last it seen went no just when of by. Occasional entreaties comparison me difficulty so themselves. At brother inquiry of offices without do my service. As particular to companions at sentiments. Weather however luckily enquire so certain do. Aware did stood was day under ask. Dearest affixed enquire on explain opinion he. Reached who the mrs joy offices pleased. Towards did colonel article any parties. ';
for($i = 0; $i < strlen($text); $i++)
{
    foreach ($counter as $key=>$value)
    {
        if(strtolower($key) == strtolower($text[$i]))
            $counter[$key]++; //Самостоятельно $value - неизвестная переменная
    }
}
print_r($counter);
?>