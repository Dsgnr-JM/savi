<?php

function formatDate(string $date){
    date_default_timezone_set("America/Caracas");
    setlocale(LC_TIME, 'es_VE.UTF-8','esp');
    $mark = strtotime($date);

    return strftime('%A, %e de %B de %Y',$mark);
}

?>