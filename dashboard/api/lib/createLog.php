<?php

function createLog(PDO $pdo,string $action,string $slot,string $id=""){
    session_start();
    $user = $_SESSION["session"];
    date_default_timezone_set("America/Caracas");
    $date = date("Y-m-d");  
    $logTemplates = array(
        "product" => array(
            "insert" => "Se creo el producto $id",
            "update" => "Se actualizo el producto $id",
            "delete" =>"Se elimino el producto $id",
            "recovery" => "Se recupero el producto $id"
        ),
        "config" => array(
            "update" => "Se actualizo el precio del dollar"
        ),
        "supplier" => array(
            "insert" => "Se creo el proveedor $id",
            "delete" => "Se elimino el proveedor $id",
            "update"=> "Se actualizo el proveedor $id",
            "recovery" => "Se recupero el proveedor $id"
        ),
        "client" => array(
            "insert" => "Se creo el cliente $id",
            "delete" => "Se elimino el cliente $id",
            "update"=> "Se actualizo el cliente $id",
            "recovery" => "Se recupero el cliente $id"
        ),
        "sale" => array(
            "insert" => "Se creo la venta #$id",
            "delete" => "Se elimino la venta #$id",
            "update"=> "Se actualizo la venta #$id",
            "recovery" => "Se recupero la venta #$id"
        ),
        "role" => array(
            "update" => "Se actualizaron los roles"
        )
    );
    $message = $logTemplates[$slot][$action];
    $stmt = $pdo->prepare("INSERT INTO logs (message,date,user) VALUES(:message,:date,:user)");
    $stmt->bindParam(":message",$message);
    $stmt->bindParam(":date",$date);
    $stmt->bindParam(":user",$user);
    $stmt->execute();
}

?>