<?php

function nameTranslator(string $name){
    $translations = array(
        "complete" => "completa",
        "pending" => "pendiente"
    );
    return $translations[$name];
}
?>