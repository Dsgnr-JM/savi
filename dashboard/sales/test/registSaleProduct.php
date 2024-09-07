<?php

function registProducts(PDO $pdo, string $numFactura){
    try {
        $products = $_POST["product"];
        $amounts = $_POST["amount"];
        for($i = 0; $i < count($products); $i++){
            $stmt = $pdo->prepare("INSERT INTO sale_product VALUES(:num_factura,:product,:amount)");
            $stmt->bindParam(":num_factura",$numFactura);
            $stmt->bindParam(":product",$products[$i]);
            $stmt->bindParam(":amount",$amounts[$i]);
            $stmt->execute();
            //$stmt = $pdo->prepare("UPDATE");
        }
        
    } catch (PDOException $e) {
        echo $e;
    }

}

?>