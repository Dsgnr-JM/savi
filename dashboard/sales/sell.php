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
            $conv = null;
            try{
                $payment = $_POST["payment"];
                if(isset($_GET["conversion"]) && $_GET["conversion"] == "bs" ){
                    $stmt = $pdo->prepare("SELECT dollar_price FROM config LIMIT 0,1");
                    $stmt->execute();
                    $result = $stmt->fetch();
                    $payment = number_format($payment / $result["dollar_price"],4);
                    $conv = "bs";
                }


                date_default_timezone_set("America/Caracas");
                $date = date("Y-m-d");
                $stmt = $pdo->prepare("INSERT INTO sale (nro_factura,client,payment,date) VALUES(:nro_factura,:client,:payment,:date);");
                $stmt->bindParam(":nro_factura",$numFactura);
                $stmt->bindParam(":client", $_POST["client"]);
                $stmt->bindParam(":payment", $payment);
                $stmt->bindParam(":date", $date);
                $stmt->execute();
                
                require_once './registSaleProduct.php';
    
                registProducts($pdo, $numFactura);
                return $conv;
    
            }catch(PDOException $e){
                return $e . "Uppps";
            }
        }
        $conv = registSale($pdo,$numFactura);
        $location = "./?place=correct&ref=".$numFactura;
        if($conv) $location = $location."&conversion=bs";
        header("Location: ".$location);
    }
?>