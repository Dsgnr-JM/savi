<?php
require('fpdf.php');
require_once '../../../config.php';
    require '../../helpers/curlData.php';

    $dolarPrice = getCurl("slot=configs")[0]["dollar_price"];
    $nro_factura = $_GET["ref"];
    $conversion = $_GET["coversion"] ?? "";
    $stmt = $pdo->prepare("SELECT s.nro_factura, s.payment, s.date, s.client, sp.amount, p.name as product_name, p.selling_price as product_price, c.name as client_name, c.surname client_surname, c.location as client_location, c.phone as client_phone FROM sale s JOIN sale_product sp ON s.nro_factura = sp.nro_factura JOIN product p ON sp.product = p.code JOIN client c ON s.client = c.dni WHERE s.nro_factura = :nro_factura");
    $stmt->bindParam(":nro_factura",$nro_factura);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $total = array_reduce($result, function ($carry, $item) {
        return $carry + ($item["product_price"] * $item["amount"]);
    }, 0);
    $clientName = $result[0]["client_name"]." ".$result[0]["client_surname"];
    $clientPhone = $result[0]["client_phone"];
    $clientLocation = $result[0]["client_location"];
    $convert = $_GET["conversion"] ?? null;
    $conv = $convert == "bs" ? "Bs" : "$";
    $total = $convert == "bs" ? $total * $dolarPrice : $total;
    $totalPlusIVA = number_format($total + $total * .16,2);
    $date = $result[0]["date"];
    $payment = $result[0]["payment"];
    $payment = number_format($convert == "bs" ? $payment * $dolarPrice : $payment, 2);
    $client = $result[0]["client"];

// Crear un nuevo PDF
$pdf = new FPDF('P', 'cm', array(10, 13)); // P=Portrait, cm=centímetros, tamaño personalizado
$pdf->AddPage();

// Configuración de márgenes
$pdf->SetMargins(1, 1, 1);

// Encabezado
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 1, 'Inversiones Refrihogar de los Hermanos Davids C.A' . str_repeat(' ', 4) . 'N- ' . $pdf->PageNo(), 0, 1, 'C');

// Datos del cliente
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(0, 0.5, 'Cliente: '.$clientName, 0, 1);
$pdf->Cell(0, 0.5, 'CI:  '.$client.'         Fecha: '.$date, 0, 1);
$pdf->Cell(0, 0.5, '', 0, 1);

// Tabla de productos o servicios
$pdf->Cell(1.5, 0.5, 'Cantidad', 1, 0, 'C');
$pdf->Cell(4, 0.5, 'Nombre', 1, 0, 'C');
$pdf->Cell(1.4, 0.5, 'Precio', 1, 0, 'C');
$pdf->Cell(1.4, 0.5, 'Importe', 1, 1, 'C');

// Filas vacías
foreach($result as $item){
    $total = number_format($item["amount"] * $item["product_price"],2);
    $pdf->Cell(1.5, 0.5, $item["amount"], 1, 0);
    $pdf->Cell(4, 0.5, $item["product_name"], 1, 0);
    $pdf->Cell(1.4, 0.5, number_format($item["product_price"],2), 1, 0);
    $pdf->Cell(1.4, 0.5, $total, 1, 1);
}

// Firma y concepto de entrega
// Firma y concepto de entrega
$pdf->Cell(2.4, 1.0, 'Firma:', 1, 0, 'B');

// Totales
$pdf->Cell(3.5, 1.0, 'SUB-TOTAL:', 1, 0, 'B');
$pdf->Cell(2.4, 1.0, 'TOTAL: '.$totalPlusIVA, 1, 1, 'B');

$pdf->Output();

?>