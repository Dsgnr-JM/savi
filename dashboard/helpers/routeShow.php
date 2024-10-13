<?php

function getRoute(){
    $routes = array(
        "products" => array(
            "name" => "inventario",
            "route" => "./",
        ),
        "info" => array(
            "name" => "información",
            "route" => "./"
        ),
        "" => array(
            "name" => "",
            "route" => "./"
        ),
        "profile" => array(
            "name" => "perfil",
            "route" => "./"
        ),
        "product" => array(
            "name" => "producto",
            "route" => "./"
        ),
        "regist" => array(
            "name" => "registro",
        ),
        "category" => array(
            "name" => "categoria",
            "route" => "./"
        ),
        "purchase" => array(
            "name" => "compras"
        ),
        "suppliers" => array(
            "name" => "proveedores",
            "route" => "./"
        ),
        "informs" => array(
            "name" => "informes",
            "route" => "./"
        ),
        "sales" => array(
            "name" =>"ventas",
            "route" => "./"
        ),
        "correct" => array(
            "name" => "factura",
            "route" => "./"
        ),
        "list" => array(
            "name"=> "listado",
        "route" => "?place=list"
        ),
        "clients" => array(
            "name" => "clientes",
            "route" => "./"
        ),
        "maintenace" => array(
            "name" => "mantenimiento",
            "route" => "./"
        ),
        "settings" => array(
            "name" => "configuración",
            "route" => "./"
        ),
        "register" => array(
            "name" => "registro",
            "route" => "?place=regist"
        )
    );
    $URI = explode("/",$_SERVER["REQUEST_URI"]);
    $root = explode("/",explode("/dashboard/",$_SERVER["REQUEST_URI"])[1])[0];

    echo "/";
    $index = 0;
    $urlTemplate = array_merge(array(
        "root" => $root
    ), $_GET);
    $keys = array_keys($urlTemplate);
    
    foreach($urlTemplate as $route){
        $template = $routes[$route]["name"] ?? $route;
        $routesRedirect = $routes[$route]["route"]?? "./?".$keys[$index - 1]."=".$urlTemplate[$keys[$index - 1]]."&$keys[$index]=$route";
        $routesRedirect = $keys[$index] == "page" ?"./?page=$route" : $routesRedirect;
        echo " "."<a href='".$routesRedirect."'>".$template."</a> ";
        if($index + 1 < count($urlTemplate)) echo "/";
        $index++;
    }
}

?>