<?php
if ($_POST) {
    require_once '../../config.php';
    function createFactura($pdo)
    {
        $stmt = $pdo->prepare("SELECT nro_factura FROM purchase ORDER BY CAST(nro_factura AS UNSIGNED) DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->fetch();
        $fact = number_format($result["nro_factura"] ?? 0) + 1;
        $result = str_pad($fact, 6, "0", STR_PAD_LEFT);
        return $result;
    }
    $numFactura = createFactura($pdo);

    function registSale(PDO $pdo, string $numFactura)
    {
        try {
            date_default_timezone_set("America/Caracas");
            $date = date("Y-m-d");
            $stmt = $pdo->prepare("INSERT INTO purchase (nro_factura,date) VALUES(:nro_factura,:date);");
            $stmt->bindParam(":nro_factura", $numFactura);
            $stmt->bindParam(":date", $date);
            $stmt->execute();
            require_once './registSaleProduct.php';
            registProducts($pdo, $numFactura);
        } catch (PDOException $e) {
            return $e . "Uppps";
        }
    }
    registSale($pdo,$numFactura);
    // $location = "./?place=correct&ref=" . $numFactura;
    // header("Location: " . $location);
    echo json_encode(["message" => "correct"]);
}
