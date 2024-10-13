<?php
require_once "../helpers/curlData.php";
require_once "../helpers/template.php";
?>
<?php require "../ui/header.php" ?>
<?php $place = $_GET["place"] ?? "" ?>
<title>Proveedores - Inv.Refrihogar</title>
<?php if(!$place): ?>
    <link rel="stylesheet" href="../../lib/dialog.css">
<?php endif ?>
<?php if(isset($_GET["view"])): ?>
    <link rel="stylesheet" href="./view.css">
<?php endif ?>
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="../../forms.css">
<?php
?>
</head>

<body>
    <?php include '../ui/navbar.php' ?>
    <section>
        <?php if (!$place) {
            $page = $_GET["page"] ?? 1;
            $isRemoved = isset($_GET["isRemoved"]) ? "isRemoved": "";
            $data = getCurl("slot=suppliers&$isRemoved");
            $pagination = $data["length"];
            $data = $data["data"];
            template("list",array_merge(array("data" => $data),array("isRemoved" => $isRemoved)));
        } ?>
        <?php if ($place === "register") template("regist")?>
        <?php if($place == "info"){
            $target = $_GET["view"];
            $data = getCurl("slot=supplier&search=$target")[0];
            $supplierProducts = getCurl("slot=products&like=$target&all=true");
            $numProducts = count($supplierProducts);
            template("info",array_merge(
                $data,array(
                    "products" => $supplierProducts,
                    "total_purchases" => $numProducts
                )
            ));
        }?>
    </section>
</body>