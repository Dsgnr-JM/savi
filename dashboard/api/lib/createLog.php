<?php

function createLog(PDO $pdo,string $action,string $slot,string $id=""){
    session_start();
    $user = $_SESSION["session"];
    date_default_timezone_set("America/Caracas");
    $date = date("Y-m-d");   
    $logTemplates = array(
        "product" => array(
            "insert" => "Se creo el producto $id"
        ),
        "config" => array(
            "update" => "Se actualizo el precio del dollar"
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