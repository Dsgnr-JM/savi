<?php
require_once "../helpers/curlData.php";
require_once "../helpers/template.php";
$action = $_GET["action"] ?? null;
$dolarPrice = getCurl("slot=configs")[0]["dollar_price"];

$suppliers = getCurl("slot=suppliers")["data"];
$categorys = getCurl("slot=categorys");

?>

<?php require "../ui/header.php" ?>
<?php $place = $_GET["place"] ?? "" ?>
<title>Inventario - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="../../forms.css">
<?php if ($action == "purchase") : ?>
    <link rel="stylesheet" href="./purchase.css">
    <link rel="stylesheet" href="../../lib/dialog.css">
<?php endif ?>
<?php if ($place == "correct") : ?>
    <link rel="stylesheet" href="./fact.css">
<?php endif ?>
<?php if ($place == "info") : ?>
    <link rel="stylesheet" href="./product_details.css">
<?php endif ?>
<link rel="stylesheet" href="../../lib/dialog.css">
</head>

<body>
    <?php include '../ui/navbar.php' ?>
    <section>
        <?php if (!$place) {
            $isRemoved = isset($_GET["isRemoved"]) ? "isRemoved" : "";
            $page = $_GET["page"] ?? 1;
            $data = getCurl("slot=products&$isRemoved");
            $pagination = $data["length"];
            $data = $data["data"];
            template("inventary", array(
                "data" => $data,
                "isRemoved" => $isRemoved,
                "categorys" => $categorys,
                "suppliers" => $suppliers,
                "pagination" => $pagination,
                "page" => $page
            ));
        } ?>
        <?php if ($place === "product" && $action == "regist") template("product", array(
            "categorys" => $categorys,
            "suppliers" => $suppliers,
            "data" => getCurl("slot=products")["data"]
        )) ?>
        <?php if ($place === "product" && $action == "purchase") {
            $dolarPrice = getCurl("slot=configs")[0]["dollar_price"];

            template("purchase", array(
                "dolarPrice" => $dolarPrice
            ));
        } ?>
        <?php if ($place === "category") template("category") ?>
        <?php if ($place === "correct") template("complete", array(
            "dolarPrice" => $dolarPrice
        )) ?>
        <?php if ($place === "info") {
            $target = $_GET["view"];
            $data = getCurl("slot=product&search=$target")[0];
            $data["photo"] = $data["photo"] ? $data["photo"] : "../../assets/no-image.png";
            $grossProfit = $data["selling_price"] - $data["purchase_price"];
            $earnings = array(
                "grossProfit" => $grossProfit,
                "percentage" => number_format($grossProfit / $data["purchase_price"] * 100, 2)
            );

            template("info", array_merge(array(
                "code" => $target,
                "earnings" => $earnings
            ), $data));
        } ?>
    </section>
    <?php include '../ui/animate.php' ?>
</body>

</html>