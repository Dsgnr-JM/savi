<?php
require_once "../helpers/curlData.php";
require_once "../helpers/template.php";

$page = $_GET["page"] ?? 1;
$data = getCurl("slot=products");
$pagination = $data["length"];
$data = $data["data"];
$action = $_GET["action"] ?? null;

$brands = getCurl("slot=brands");
$models = getCurl("slot=models");

$suppliers = getCurl("slot=suppliers")["data"];
$categorys = getCurl("slot=categorys");

?>

<?php require "../ui/header.php" ?>
<?php $place = $_GET["place"] ?? "" ?>
<title>Productos - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="../../forms.css">
<?php if ($action == "purchase") : ?>
    <link rel="stylesheet" href="./purchase.css">
    <link rel="stylesheet" href="../../lib/dialog.css">
<?php endif ?>


<?php
$optionsTitle = array(
    "product" => "Registro de productos",
    "brand" => "Registro de marcas.",
    "category" => "Registro de categorias.",
    "model" => "Registro de modelos."
)
?>
</head>

<body>
    <?php include '../ui/navbar.php' ?>
    <section>
        <?php if (!$place) template("inventary",array(
            "data" => $data,
            "pagination" => $pagination,
            "page" => $page
        ))?>
        <?php if ($place === "product" && $action == "regist") template("product",array(
            "categorys" => $categorys,
            "models" => $models,
            "brands" => $brands,
            "suppliers" => $suppliers,
            "data" => $data
        ))?>
        <?php if ($place === "product" && $action == "purchase") template("purchase") ?>
        <?php if ($place === "brand") template("brand") ?>
        <?php if ($place === "model") template("model")?>
        <?php if ($place === "category") template("category")?>
    </section>
</body>

</html>