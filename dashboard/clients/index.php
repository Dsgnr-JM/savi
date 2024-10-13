<?php
require_once "../helpers/curlData.php";
require_once "../helpers/template.php";

?>


<?php require "../ui/header.php" ?>
<?php $place = $_GET["place"] ?? "" ?>
<title>Clientes - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
<title>Informes - Inv.Refrihogar</title>
<link rel="stylesheet" href="../../forms.css">
<link rel="stylesheet" href="index.css">
<?php if($place == "info"):?>
    <link rel="stylesheet" href="./view.css">
<?php endif ?>
<?php if(!$place): ?>
    <link rel="stylesheet" href="../../lib/dialog.css">
<?php endif ?>
</head>

<body>
    <?php include '../ui/navbar.php' ?>
    <section>
        <?php if (!$place) {
            $page = $_GET["page"] ?? 1;
            $data = getCurl("slot=clients&page=$page");
            $pagination = $data["length"];
            $data = $data["data"];
            template("list",array(
                "data" => $data,
                "pagination" => $pagination,
                "page" => $page
            ));
        }?>
        <?php if ($place === "register") {
            $page = $_GET["page"] ?? 1;
            $data = getCurl("slot=clients&page=$page")["data"];
            template("regist",array(
                "data" => $data
            ));
        }?>
        <?php if($place=="info"){
            $target = $_GET["view"];
            $data = getCurl("slot=client&search=$target")[0];
            $data["image"] = $data["image"] ? $data["image"]: "../../assets/no-image.png";
            $data["status"] = $data["status"] == "complete" ? "No" : "Si";
            $data["type"] =  $data["enterprise_name"] ? "Normal" : "Juridico";
            $data["enterprise_name"] = $data["enterprise_name"] ? $data["enterprise_name"] : "Ninguno";
            $data["sales"] = 5;
            $sales = getCurl("slot=sale&search=$target");
            $sales = array(
                "sales" => $sales,
                "total_sales" => count($sales)
            );
            template("info",array_merge($data,$sales));
        }?>
    </section>
</body>