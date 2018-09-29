<?php
$text = 'Made last it seen went no just when of by. Occasional entreaties comparison me difficulty so themselves. At brother inquiry of offices without do my service. As particular to companions at sentiments. Weather however luckily enquire so certain do. Aware did stood was day under ask. Dearest affixed enquire on explain opinion he. Reached who the mrs joy offices pleased. Towards did colonel article any parties. ';

if(strlen($text)>50)
{
    $text = trim(substr($text, 0, 47)) . '...';
}
print_r($text);
?>