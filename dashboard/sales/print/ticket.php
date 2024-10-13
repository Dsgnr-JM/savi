<?php
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

    # Incluyendo librerias necesarias #
    require "./code128.php";

    $pdf = new PDF_Code128('P','mm',array(80,258));
    $pdf->SetMargins(4,10,4);
    $pdf->AddPage();
    
    # Encabezado y datos de la empresa #
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",strtoupper("Inv. Refrihogar de los Hermanos Davids")),0,'C',false);
    $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","RIF: J-50451235-4"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Direccion Boconó, El Barzalito"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Teléfono: 04247714244"),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Email: refrihogar@gmail.com"),0,'C',false);

    $pdf->Ln(1);
    $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","------------------------------------------------------"),0,0,'C');
    $pdf->Ln(5);

    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Fecha: ".date("d/m/Y", strtotime($date))),0,'C',false);
    // $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Caja Nro: 1"),0,'C',false);
    // $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Cajero: Carlos Alfaro"),0,'C',false);
    $pdf->SetFont('Arial','B',9);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1",strtoupper("Nro Factura: #".$nro_factura)),0,'C',false);
    $pdf->SetFont('Arial','',9);

    $pdf->Ln(1);
    $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","------------------------------------------------------"),0,0,'C');
    $pdf->Ln(5);

    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Cliente: ".$clientName),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Documento: ".$client),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Teléfono: ".$clientPhone),0,'C',false);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","Dirección: ".$clientLocation),0,'C',false);

    $pdf->Ln(1);
    $pdf->Cell(0,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');
    $pdf->Ln(3);

    $pdf->SetFont('Arial','',8.5);

    # Tabla de productos #
    $pdf->Cell(10,5,iconv("UTF-8", "ISO-8859-1","Cant."),0,0,'C');
    $pdf->Cell(38,5,iconv("UTF-8", "ISO-8859-1","Producto."),0,0,'C');
    $pdf->Cell(14,5,iconv("UTF-8", "ISO-8859-1","Precio"),0,0,'C');
    $pdf->Cell(10,5,iconv("UTF-8", "ISO-8859-1","Total"),0,0,'C');

    $pdf->Ln(3);
    $pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-----------------------------------------------------------------------"),0,0,'C');
    $pdf->Ln(4);

    /*----------  Detalles de la tabla  ----------*/
    // $pdf->MultiCell(0,4,iconv("UTF-8", "ISO-8859-1","Nombre de producto a vender"),0,'C',false);
    foreach($result as $item){
        $price = $convert == "bs" ? $item["product_price"] * $dolarPrice : $item["product_price"];
        $price = number_format($price,2);

        $totalItem = number_format($price * $item["amount"],2);

        $pdf->Cell(10,4,iconv("UTF-8", "ISO-8859-1",$item["amount"]),0,0,'C');
        $pdf->Cell(38,4,iconv("UTF-8", "ISO-8859-1",$item["product_name"]),0,0,'C');
        $pdf->Cell(14,4,iconv("UTF-8", "ISO-8859-1",$price),0,0,'C');
        $pdf->Cell(10,4,iconv("UTF-8", "ISO-8859-1",$totalItem),0,0,'C');
        //$pdf->Ln(4);
        //$pdf->MultiCell(0,4,iconv("UTF-8", "ISO-8859-1","Garantía de fábrica: 2 Meses"),0,'C',false);
        $pdf->Ln(5);

    }
    
    /*----------  Fin Detalles de la tabla  ----------*/



    $pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-----------------------------------------------------------------------"),0,0,'C');

        $pdf->Ln(5);

    # Impuestos & totales #
    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","SUBTOTAL"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1",$conv." ".$total),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","IVA (16%)"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1",$conv." ".number_format($total * .16,2)),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(72,5,iconv("UTF-8", "ISO-8859-1","-------------------------------------------------------------------"),0,0,'C');

    $pdf->Ln(5);

    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","TOTAL A PAGAR"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1",$conv." ".$totalPlusIVA),0,0,'C');

    $pdf->Ln(5);
    
    $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","TOTAL PAGADO"),0,0,'C');
    $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1",$conv." ".$payment),0,0,'C');

    $pdf->Ln(7);

    // $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    // $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","CAMBIO"),0,0,'C');
    // $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1","$30.00 USD"),0,0,'C');

    // $pdf->Ln(5);

    // $pdf->Cell(18,5,iconv("UTF-8", "ISO-8859-1",""),0,0,'C');
    // $pdf->Cell(22,5,iconv("UTF-8", "ISO-8859-1","USTED AHORRA"),0,0,'C');
    // $pdf->Cell(32,5,iconv("UTF-8", "ISO-8859-1","$0.00 USD"),0,0,'C');

    // $pdf->Ln(10);

    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","*** Precios de productos incluyen impuestos. Para poder realizar un reclamo o devolución debe de presentar este ticket ***"),0,'C',false);

    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(0,7,iconv("UTF-8", "ISO-8859-1","Gracias por su compra"),'',0,'C');

    $pdf->Ln(9);

    # Codigo de barras #
    $pdf->Code128(5,$pdf->GetY(),$nro_factura,70,20);
    $pdf->SetXY(0,$pdf->GetY()+21);
    $pdf->SetFont('Arial','',14);
    $pdf->MultiCell(0,5,iconv("UTF-8", "ISO-8859-1","#".$nro_factura),0,'C',false);
    
    # Nombre del archivo PDF #
    $pdf->Output("I","Ticket_Nro_1.pdf",true);
	