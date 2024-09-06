<?php

function getRoute(){
    $routes = array(
        "" => "",
        "products" => "productos",
        "maintenace" => "mantenimiento",
        "product" => "producto",
        "regist" => "registro" ,
        "profile" => "perfil",
        "stadistics" => "estadisticas",
        "suppliers" => "provedores",
        "clients" => "clientes",
        "informs" => "informes",
        "register" => "registro",
        "sales" => "ventas",
        "brand" => "marca",
    );
    $URI = explode("/",$_SERVER["REQUEST_URI"]);
    $URILength = count($URI);
    $root = $URI[$URILength - 1]; 
    $place = explode("/",explode("/dashboard/",$_SERVER["REQUEST_URI"])[1])[0];
    $action = explode("&",explode("=", $root)[1] ?? null)[0] ?? null;
    $param = explode("=", $root)[2] ?? null;
    $uriTemplate = [];

    if($place) $uriTemplate[0] = $place;
    if($action) $uriTemplate[1] = $action;
    if($param) $uriTemplate[2] = $param;

    echo "/";
    for($i = 0; $i < count($uriTemplate); $i++){
        echo " " .$routes[$uriTemplate[$i]] . " ";
        if($i + 1 < count($uriTemplate)) echo "/";
    }
}

?>