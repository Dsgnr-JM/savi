<?php
    require_once "../../../config.php";
    
    //echo createFactura($pdo);
?>

<form autocomplete="off"action="" method="POST" autocomplete="on">
    <input type="text" name="product[]" value="ELE002">
    <input type="text" name="product[]" value="COC002">
    <input type="text" name="product[]" value="MAS002">
    <input type="text" name="product[]" value="MAS001">

    <input type="text" name="amount[]" value="5">
    <input type="text" name="amount[]" value="3">
    <input type="text" name="amount[]" value="2">
    <input type="text" name="amount[]" value="1">
    <button>Enviar</button>
</form>

<?php
/*if($_POST){
    require_once '../../../config.php';

    function createFactura($pdo){
        $stmt = $pdo->prepare("SELECT nro_factura FROM sale ORDER BY CAST(nro_factura AS UNSIGNED) DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->fetch();
        $fact = number_format($result["nro_factura"]) + 1;
        $result = str_pad($fact,6,"0",STR_PAD_LEFT);
        return $result;
    }
    
    function registSale(PDO $pdo)
    {
        try{
            $numFactura = createFactura($pdo);
            date_default_timezone_set("America/Caracas");
            $date = date("Y-m-d");
            $stmt = $pdo->prepare("INSERT INTO sale (nro_factura,client,payment,date) VALUES(:nro_factura,:client,:payment,:date);");
            $data = array("client" => "31744101","payment" => 15.12, "date" => $date);
            $stmt->bindParam(":nro_factura",$numFactura);
            $stmt->bindParam(":client", $data["client"]);
            $stmt->bindParam(":payment", $data["payment"]);
            $stmt->bindParam(":date", $data["date"]);
            $stmt->execute();
            
            require_once './registSaleProduct.php';

            registProducts($pdo, $numFactura);
            return "Success";

        }catch(PDOException $e){
            return $e . "Uppps";
        }
    }
    echo registSale($pdo);

}*/
?>