<?php
function changeToReverseDate($date)
{
    $date = explode("-",$date);
    $reverse_date = $date[2]."-".$date[1]."-".$date[0];
    return $reverse_date;
}


?>

