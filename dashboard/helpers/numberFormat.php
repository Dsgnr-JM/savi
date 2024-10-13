<?php
    function formatPercentaje(float $fistValue, float $secondValue){
        return $secondValue != 0 ? number_format(($fistValue - $secondValue) / $secondValue * 100) : 100;
    }
    function numberSimbol(float $value)
    {
        return $value > 0 ? "+" : "-";
    }

?>