<?php
    if($_POST){
        require_once '../../config.php';
        
        function createFactura($pdo){
            $stmt = $pdo->prepare("SELECT nro_factura FROM sale ORDER BY CAST(nro_factura AS UNSIGNED) DESC LIMIT 1");
            $stmt->execute();
            $result = $stmt->fetch();
            $fact = number_format($result["nro_factura"]) + 1;
            $result = str_pad($fact,6,"0",STR_PAD_LEFT);
            return $result;
        }
        $numFactura = createFactura($pdo);
        
        function registSale(PDO $pdo, string $numFactura)
        {
            try{
                date_default_timezone_set("America/Caracas");
                $date = date("Y-m-d");
                $stmt = $pdo->prepare("INSERT INTO sale (nro_factura,client,payment,date) VALUES(:nro_factura,:client,:payment,:date);");
                $stmt->bindParam(":nro_factura",$numFactura);
                $stmt->bindParam(":client", $_POST["client"]);
                $stmt->bindParam(":payment", $_POST["payment"]);
                $stmt->bindParam(":date", $date);
                $stmt->execute();
                
                require_once './registSaleProduct.php';
    
                registProducts($pdo, $numFactura);
                return "Success";
    
            }catch(PDOException $e){
                return $e . "Uppps";
            }
        }
        echo registSale($pdo,$numFactura);
        header("Location: ./?place=correct&ref=".$numFactura);
    }
?>