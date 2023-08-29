<?php
function changeToReverseDate($date)
{
    if($date=="0000-00-00" || $date=="")
    {
        return "0000-00-00";
    }
    $date = explode("-",$date);
    $reverse_date = $date[2]."-".$date[1]."-".$date[0];
    return $reverse_date;
}


?>

