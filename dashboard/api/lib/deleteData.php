<?php
function deleteData(PDO $pdo,String $slot,Array $data,Array $message)
{
    $operationsSQL = array(
        "product" => "UPDATE product SET isRemoved = 1, code = :new_id WHERE code = :key",
        "supplier" => "UPDATE supliers SET isRemoved = 1, rif = :new_id WHERE rif = :key",
        "client" => "UPDATE client SET isRemoved = 1,dni = :new_id WHERE dni = :key",
        "sale" => "UPDATE sale SET isRemoved = 1, nro_factura = :new_id WHERE nro_factura = :key"
    );
    try {
        $key = $data["key"];
        $sql = $operationsSQL[$slot];
        $newKey = $key."-R";
        $stmt =$pdo->prepare($sql);
        $stmt->bindParam(":key",$key);
        $stmt->bindParam(":new_id",$newKey);
        $stmt->execute();
        $message["result"] = true;
        $message["description"] = "Successfully delete";
        require_once 'lib/createLog.php';
        createLog($pdo,"delete",$slot,$key);
    } catch (PDOException $e) {
        $message["description"] = $e;
        return json_encode($message);
    }
    return json_encode($message);
}