<?php
require "../ui/header.php";
require_once '../helpers/curlData.php';
require '../helpers/NameTranslator.php';
require_once '../helpers/template.php';
$place = $_GET["place"] ?? "";
$dolarPrice = getCurl("slot=configs")[0]["dollar_price"];

?>
<title>Ventas - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="../../forms.css">
<link rel="stylesheet" href="../../lib/dialog.css">
<?php if ($place == "correct") : ?>
    <link rel="stylesheet" href="./fact.css">
<?php else : ?>
    <link rel="stylesheet" href="./menu.css">
<?php endif ?>
<?php if($place == "info"): ?>
    <link rel="stylesheet" href="./view.css">
<?php endif ?>
</head>

<body>
    <?php include '../ui/navbar.php' ?>
    <section class="sell">
        <?php if (!$place) {
            $categorys = getCurl("slot=categorys");

            $productNum = array_reduce($categorys, function ($carry, $item) {
                return $carry + $item["num_products"];
            }, 0);
            template("sale", array(
                "dolarPrice" => $dolarPrice,
                "productNum" => $productNum,
                "categorys" => $categorys
            ));
        } ?>
        <?php if ($place === "correct") template("complete",array(
            "dolarPrice" => $dolarPrice
        )) ?>
        <?php if ($place === "list") {
            $isRemoved = isset($_GET["isRemoved"]) ? "&isRemoved":"";
            ["data" => $data, "length" => $pagination] = getCurl("slot=sales$isRemoved");
            $page = $_GET["page"] ?? 1;

            template("list", array(
                "pagination" => $pagination,
                "data" => $data,
                "page" => $page,
                "isRemoved" => $isRemoved
            ));
        } ?>
        <?php if($place== "info"){
            require_once "../helpers/formatDate.php";
            $target = $_GET["view"];
            $sale = getCurl("slot=sale&search=$target")[0];
            $targetClient = $sale["client"];
            $sale["total"] = number_format($sale["total"],2);
            $sale["date"] = formatDate($sale["date"]);
            $sale["missing"] = $sale["total"] - $sale["payment"];
            $client = getCurl("slot=client&search=$targetClient")[0];
            $products = getCurl("slot=sale_product&search=$target");
            template("info",array_merge($sale,$client,array(
                "products" => $products
            )));
        }?>
    </section>
</body>