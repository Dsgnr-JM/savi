<?php
function recoveryData(PDO $pdo,String $slot,Array $data,Array $message)
{
    $operationsSQL = array(
        "product" => "UPDATE product SET isRemoved = 0, code = :new_id WHERE code = :key",
        "supplier" => "UPDATE supliers SET isRemoved = 0, rif = :new_id WHERE rif = :key",
        "client" => "UPDATE client SET isRemoved = 0,dni = :new_id WHERE dni = :key",
        "sale" => "UPDATE sale SET isRemoved = 0, nro_factura = :new_id WHERE nro_factura = :key"
    );
    try {
        $key = $data["key"];
        $sql = $operationsSQL[$slot];
        $newKey = str_replace("-R","",$key);
        $stmt =$pdo->prepare($sql);
        $stmt->bindParam(":key",$key);
        $stmt->bindParam(":new_id",$newKey);
        $stmt->execute();
        $message["result"] = true;
        $message["description"] = "Successfully recovery";
        require_once 'lib/createLog.php';
        createLog($pdo,"recovery",$slot,$newKey);
    } catch (PDOException $e) {
        $message["description"] = $e;
        return json_encode($message);
    }
    return json_encode($message);
}