<?php

function formatDate(string $date){
    $date = substr($date, 0, 10);
    $numDay = date('d', strtotime($date));
    $day = date('l', strtotime($date));
    $month = date('F', strtotime($date));
    $year = date('Y', strtotime($date));
    $days_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $days_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $dayName = str_replace($days_EN, $days_ES, $day);
    $months_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $months_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $monthName = str_replace($months_EN, $months_ES, $month);
    return $dayName.", ".$numDay." de ".$monthName." ".$year;
}

?>