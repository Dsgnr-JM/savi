<?php

function getRoute(){
    $routes = array(
        "" => "",
        "products" => "productos",
        "maintenace" => "mantenimiento",
        "purchase" => "compra",
        "product" => "producto",
        "regist" => "registro" ,
        "profile" => "perfil",
        "model" => "modelo",
        "settings" => "configuración",
        "stadistics" => "estadisticas",
        "suppliers" => "provedores",
        "clients" => "clientes",
        "correct" => "factura",
        "informs" => "informes",
        "register" => "registro",
        "sales" => "ventas",
        "brand" => "marca",
    );
    $URI = explode("/",$_SERVER["REQUEST_URI"]);
    $root = explode("/",explode("/dashboard/",$_SERVER["REQUEST_URI"])[1])[0];

    echo "/";
    $index = 0;
    $urlTemplate = array_merge(array(
        "root" => $root
    ), $_GET);
    
    foreach($urlTemplate as $route){
        $template = $routes[$route] ?? $route;
        echo " "."<a href=''>".$template."</a> ";
        if($index + 1 < count($urlTemplate)) echo "/";
        $index++;
    }
}

?>