<?php
    require_once '../../../config.php';
    function registSale(PDO $pdo){
        try {
            $stmt = $pdo->prepare("INSERT INTO sale (nro_factura,client,payment,date) VALUES(:nro,:client,:payment,:date)");
            $data = array(
                "nro" => "00014",
                "client" => "10202010",
                "payment" => 10.82,
                "date" => "2024-02-10"
            );
            $stmt->bindParam(":nro",$data["nro"]);
            $stmt->bindParam(":client",$data["client"]);
            $stmt->bindParam(":payment",$data["payment"]);
            $stmt->bindParam(":date",$data["date"]);
            $stmt->execute();
            echo "success";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    registSale($pdo);
?>