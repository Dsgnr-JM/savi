<?php

function registProducts(PDO $pdo, string $numFactura){
    try {
        $products = $_POST["product"];
        $amounts = $_POST["amount"];
        $prices = $_POST["price"];
        for($i = 0; $i < count($products); $i++){
            $stmt = $pdo->prepare("INSERT INTO purchase_product VALUES(:num_factura,:product,:amount)");
            $stmt->bindParam(":num_factura",$numFactura);
            $stmt->bindParam(":product",$products[$i]);
            $stmt->bindParam(":amount",$amounts[$i]);
            $stmt->execute();
            $stmt = $pdo->prepare("UPDATE product SET stock = stock + :amount, purchase_price = :price WHERE code = :code");
            $stmt->bindParam(":amount",$amounts[$i]);
            $stmt->bindParam(":code",$products[$i]);
            $stmt->bindParam(":price",$prices[$i]);
            $result = $stmt->execute();

            //var_dump($products[$i]);
            //$stmt = $pdo->prepare("UPDATE");
        }
        
    } catch (PDOException $e) {
        echo $e;
    }

}

?>