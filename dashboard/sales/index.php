<?php
require "../ui/header.php";
require_once '../helpers/curlData.php';
require '../helpers/NameTranslator.php';
$place = $_GET["place"] ?? "";
$page = $_GET["page"] ?? 1;
$dolarPrice = getCurl("slot=configs")[0]["dollar_price"];
$categorys = getCurl("slot=categorys");
$data;

if ($place === "list") {
    ["data" => $data,"length" => $pagination] = getCurl("slot=sales");
}

$productNum = array_reduce($categorys, function ($carry, $item) {
    return $carry + $item["num_products"];
}, 0);
?>
<title>Ventas - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="../../forms.css">
<link rel="stylesheet" href="../../lib/dialog.css">
<?php if ($place) : ?>
    <link rel="stylesheet" href="./fact.css">
<?php else : ?>
    <link rel="stylesheet" href="./menu.css">
<?php endif ?>
</head>

<body>
    <?php include '../ui/navbar.php' ?>
    <section class="sell">
        <?php if (!$place) : ?>
            <h2><i class="ri-shopping-basket-line"></i>Ventas</h2>
            <p>Crea una venta a partir de los diferentes productos registrados en la empresa.</p>
            <div class="table-options">
                <form id="form-search" class="form not-ring" style="width:320px;margin:0;">
                    <label style="margin:0;">
                        <span>
                            <i class="ri-search-line"></i>
                            <input type="text" id="search-product" placeholder="Tornillo xs">
                        </span>
                    </label>
                </form>
                <button class="more" data-show="show">
                    <i class="ri-more-2-fill" data-show="show"></i>
                    <ol>
                        <li id="conversion"><i class="ri-coins-line"></i>Cambiar divisa a <span>$</span></li>
                    </ol>
                </button>
            </div>
            <div class="table">
                <table class="empty">
                    <thead>
                        <tr>
                            <td style="width: 50px;">#</td>
                            <td>Codigo</td>
                            <td>Descripcion</td>
                            <td>Cantidad</td>
                            <td>Precio</td>
                            <td>Total</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody id="table-products">
                        <tr>
                        </tr>
                        <!-- <tr>
                        <td>ELE2012</td>
                        <td>Otdos</td>
                        <td>4</td>
                        <td>$5</td>
                        <td>$20</td>
                        <td class="actions">
                            <button class="btn-square edit">
                                <i class="ri-edit-line"></i>
                            </button>
                            <button class="btn-square add">
                                <i class="ri-add-line"></i>
                            </button>
                            <button class="btn-square subtract">
                                <i class="ri-subtract-line"></i>
                            </button>
                            <button class="btn-square delete">
                                <i class="ri-delete-bin-6-line"></i>
                            </button>
                        </td>
                    </tr> -->
                    </tbody>
                </table>
            </div>
            <div class="total-details">
                <div>
                    <p>Total neto: <span id="total-neto">0.00</span></p>
                    <p>I.V.A: <span id="total-iva">0.00</span></p>
                    <h3>Total <span id="convertSign">Bs</span>: <span id="total-price">0.00</span></h3>
                    <p>Total <span id="convertSign">$</span>: <span id="total-dollar">0.00</span></p>
                </div>
            </div>
            <div class="float">
                <button id="sale">
                    <i class="ri-check-fill"></i>
                </button>
                <!-- <div>
                <div class="counted" id="sale_options">
                    <span>Contado</span>
                    <button><i class="ri-bank-card-2-fill"></i></button>
                </div>
                <div class="apart" id="sale_options">
                    <span>Apartado</span>
                    <button><i class="ri-calendar-2-fill"></i></button>
                </div>
            </div> -->
            </div>
            <div class="bg_dialog"></div>
            <main class="dialog" id="dialog">
                <div class="sell">
                    <h2>Datos de venta y cliente</h2>
                    <p>Complete los datos faltantes para completar la venta.</p>
                    <form class="form" action="./sell.php" method="POST">
                        <input type="hidden" id="dolarPrice" value="<?= $dolarPrice ?>" disabled>
                        <label>
                            <p>Cliente DNI:</p>
                            <span>
                                <i class="ri-user-line"></i>
                                <input type="text" name="client" required placeholder="31744101">
                            </span>
                        </label>
                        <label style="flex-direction:row;align-items:center;">
                            <input type="checkbox" id="registClient">
                            <p style="margin: 0 0 0 7px;">Crear cliente:</p>
                        </label>
                        <label>
                            <p>Pago:</p>
                            <span>
                                <i class="ri-mail-line"></i>
                                <button class="badge info action" type="button">Exacto</button>
                                <input type="number" name="payment" step="any" required placeholder="100.43">
                            </span>
                        </label>
                        <div class="details">
                            <p><strong>Total neto <span>Bs: 0</span></strong></p>
                            <p><strong>Total <span>Bs: 0</span></strong></p>
                            <p><strong>Pago <span>Bs: 0</span></strong></p>
                        </div>
                        <div class="container-buttons">
                            <button class="btn cancel" type="button">
                                Cancelar
                            </button>
                            <button class="btn success" type="submit">
                                Realizar compra
                                <i style="font-weight:100" class="ri-money-dollar-circle-line"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="client">
                    <h2>Registre un cliente</h2>
                    <p>Si necesita registrar un cliente de forma avanzada necesita ir a <a href="../clients/?place=register">Clientes</a> para mayor seguridad y gestion.</p>
                    <form class="form">
                        <label>
                            <p>Cedula:</p>
                            <span>
                                <i class="ri-profile-line"></i>
                                <input type="text" name="dni" required placeholder="31744101">
                            </span>
                        </label>
                        <div class="inputs-container">
                            <label>
                                <p>Nombre:</p>
                                <span>
                                    <input type="text" name="name" required placeholder="Maria Gabriela">
                                    <i class="ri-user-line" id="icon-form"></i>
                                </span>
                            </label>
                            <label>
                                <p>Apellido:</p>
                                <span>
                                    <input type="text" name="surname" required placeholder="de los Angeles">
                                    <i class="ri-user-line" id="icon-form"></i>
                                </span>
                            </label>
                        </div>
                        <label>
                            <p>Telefono:</p>
                            <span>
                                <input type="text" name="phone" required placeholder="04247714244">
                                <i class="ri-phone-line" id="icon-form"></i>
                            </span>
                        </label>
                        <input type="hidden" name="location">
                        <div class="container-buttons">
                            <button class="btn cancel" id="prev" type="button">
                                Volver
                            </button>
                            <button class="btn success" type="submit">
                                Registrar
                                <i style="font-weight:100" class="ri-save-2-line"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </main>
            <aside>
                <button>
                    <i class="ri-shopping-cart-line"></i>
                </button>
                <h2><i class="ri-filter-3-line"></i>Clasificaciones:</h2>

                <div class="classifiers">
                    <button class="active" id="category" data-category="" data-name="">
                        <h3>Todos</h3>
                        <p><span><?= $productNum ?></span> productos</p>
                    </button>
                    <?php foreach ($categorys as $category) : ?>
                        <button id="category" data-name="<?= $category["name"] ?>" data-category="<?= $category["id"] ?>">
                            <h3><?= $category["name"] ?></h3>
                            <p><span><?= $category["num_products"] ?></span> productos</p>
                        </button>
                    <?php endforeach ?>
                </div>
                <form class="form not-ring" style="width: 100%;margin:15px 0;">
                    <label style="margin:0;">
                        <span>
                            <i class="ri-search-line"></i>
                            <input type="text" id="search-car" placeholder="Tornillo xs">
                        </span>
                    </label>
                </form>
                <div class="products">
                    <ol id="products-list">
                        <!-- <li>
                            <img src="../../assets/Screenshot_20240915-211427.jpg">
                            <h3>Tornsillo XS</h3>
                            <div class="details">
                                <div class="badge warning">
                                    Mas
                                </div>
                                <h2>$ <span>1.2</span></h2>
                            </div>
                        </li>
                        <li>
                            <img src="../../assets/Screenshot_20240915-211427.jpg">
                            <h3>Mecanismo</h3>
                            <div class="details">
                                <div class="badge success">
                                    Electrodomestico
                                </div>
                                <h2>$ <span>100</span></h2>
                            </div>
                        </li>
                        <li>
                            <img src="../../assets/Screenshot_20240915-211427.jpg">
                            <h3>Cuchilla maquina</h3>
                            <div class="details">
                                <div class="badge success">
                                    Refrigeración
                                </div>
                                <h2>$ <span>100</span></h2>
                            </div>
                        </li>
                        <li>
                            <img src="../../assets/Screenshot_20240915-211427.jpg">
                            <h3>Cuchilla de licuadora</h3>
                            <div class="details">
                                <div class="badge success">
                                    Cocina
                                </div>
                                <h2>$ <span>100</span></h2>
                            </div>
                        </li> -->
                    </ol>
                </div>
            </aside>
            <div class="bg_menu"></div>
            <script type="module" src="./shopping-car.js"></script>
            <script type="module" src="./index.js"></script>
        <?php endif ?>
        <?php if ($place === "correct") : ?>
            <div class="container-buttons" style="justify-content: start;">
                <a href="./" class="btn cancel" style="max-width: 100px;">
                    <i class="ri-arrow-left-line"></i>
                    Volver
                </a>
                <a href="./print/ticket.php?ref=<?= $_GET["ref"] ?>&conversion=<?= $_GET["conversion"] ?? "" ?>" class="btn primary" style="max-width: 100px;">
                    Imprimir
                    <i class="ri-printer-line"></i>
                </a>
            </div>
            <div class="sale-details">
                <picture>
                    <img src="../IMG-20240306-WA0032~2.jpg" alt="logo-empresa">
                </picture>
                <div class="factura">

                    <div class="text">
                        <strong>Nro de factura #<?= $_GET["ref"] ?></strong>
                        <?php
                        require_once '../helpers/formatDate.php';
                        $target = $_GET["ref"];
                        $data = getCurl("slot=sale&search=$target")[0];
                        $client = getCurl("slot=client&search=" . $data['client'])[0];
                        $products = getCurl("slot=sale_product&search=" . $target);
                        $total = array_reduce($products, function ($carry, $item) {
                            return $carry + ($item["selling_price"] * $item["amount"]);
                        }, 0);
                        $convert = $_GET["conversion"] ?? null;
                        $total = $convert == "bs" ? $total * $dolarPrice : $total;
                        $date = $data["date"];

                        ?>
                        <p><?= formatDate($date) ?></p>
                        <!-- <p>Lo atendio: Jota</p> -->
                        <p>Cliente: <strong><?= $client["name"] . " " . $client["surname"] ?></strong></p>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Producto</td>
                                <td>Cantidad</td>
                                <td>Precio</td>
                                <td>Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            foreach ($products as $product) :
                            ?>
                                <?php
                                $price = $convert ? $product["selling_price"] * $dolarPrice : $product["selling_price"];
                                $amountPrice = $price * $product["amount"];
                                $conv = $convert ? "Bs" : "$";
                                ?>
                                <tr>
                                    <td style="width: 50px;"><?= $index++ ?></td>
                                    <td><?= $product["name"] ?></td>
                                    <td><?= $product["amount"] ?></td>
                                    <td><?= $price . " " . $conv ?></td>
                                    <td><?= $amountPrice . " " . $conv ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <div class="total">
                        <p><strong>Total <?= $convert ? "Bs" : "$" ?>: </strong><?= number_format($total, 2)  ?></p>
                        <p><strong>Total + (I.V.A) <?= $convert ? "Bs" : "$" ?>: </strong><?= number_format($total + $total * .16, 2)  ?></p>
                        <p><strong>Pago <?= $convert ? "Bs" : "$" ?>: </strong><?= number_format($convert ? $data["payment"] * $dolarPrice : $data["payment"], 2) ?></p>
                    </div>
                </div>
            </div>
            <main class="sale-message">
                <i class="ri-information-fill"></i>
                <article class="description">
                    <p>Para imprimir haga click en el boton <i class="ri-printer-fill"></i> de la esquina superior izquierda.</p>
                    <p>Recomendamos usar un navegador basado en chromium y desde un ordenador.</p>
                    <p><strong>Nota:</strong> Recuerda que puedes configurar las facturas desde los ajustes del sistema</p>
                </article>
            </main>
        <?php endif ?>
        <?php if ($place === "list") : ?>
            <h2><i class="ri-sh-line"></i>Ventas</h2>
            <p>Echale un vistazo a todas las ventas realizadas</p>
            <div class="table-options">
                <form id="form-search" class="form not-ring" style="width:320px;margin:0;">
                    <label style="margin:0;">
                        <span>
                            <i class="ri-search-line"></i>
                            <input type="text" id="search-table" placeholder="000006">
                        </span>
                    </label>
                </form>
                <button class="more" data-show="show">
                    <i class="ri-filter-3-fill" data-show="show"></i>
                    <ol>
                        <li id="conversion"><i class="ri-coins-line"></i>Cambiar divisa a <span>$</span></li>
                    </ol>
                </button>
            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <td>Nro de Factura</td>
                            <td>Cliente</td>
                            <td>Total</td>
                            <td>Pago</td>
                            <td>Estado</td>
                            <td>Fecha</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $row) : ?>
                            <tr>
                                <td><?= $row["nro_factura"]  ?></td>
                                <td><?= $row["client"]  ?></td>
                                <td><?= "$ " . number_format($row["total"],2)  ?></td>
                                <td><?= "$ " . number_format($row["payment"],2)  ?></td>
                                <td>
                                    <span class="badge <?= $row["status"] ?>"><?= nameTranslator($row["status"]) ?></span>
                                </td>
                                <td><?= $row["date"] ?></td>
                                <td data-code="<?= $row["nro_factura"]  ?>">
                                    <div class="actions">
                                        <button class="btn-square edit">
                                            <i class="ri-edit-line"></i>
                                        </button>
                                        <button class="btn-square delete">
                                            <i class="ri-delete-bin-6-line"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="pagination <?= $pagination > 1 ? '' : "hidden" ?>">
                <button id="movePage">
                    <i class="ri-arrow-left-s-line"></i>
                </button>
                <div class="items_pagination">
                    <?php for ($i = 1; $i <= $pagination; $i++) : ?>
                        <button data-num="<?= $i ?>" class="<?= ($page == $i) ? "active" : "" ?>"><?= $i ?></button>
                    <?php endfor ?>
                </div>
                <button id="movePage">
                    <i class="ri-arrow-right-s-line"></i>
                </button>
            </div>
            <script type="module" src="./list.js"></script>
        <?php endif ?>
    </section>
</body>