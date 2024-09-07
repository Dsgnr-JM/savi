<?php require "../ui/header.php" ?>
<?php $place = $_GET["place"] ?? "" ?>
<title>Ventas - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="../../forms.css">
<link rel="stylesheet" href="../../lib/dialog.css">
<?php if($place):?>
    <link rel="stylesheet" href="./fact.css">
<?php endif ?>
</head>

<body>
    <?php include '../ui/navbar.php' ?>
    <section>
        <?php if(!$place): ?>
        <div class="table">
            <h2>Productos</h2>
            <p>Echale un vistazo al inventario de productos registrados en tu organizaciòn</p>
                
            <button class="more btn-rounded">
                <i class="ri-more-2-fill "></i>
            </button>
            <form id="form-search">
                <label class="search">
                    <button id="search-products">
                        <i class="ri-search-line"></i>
                    </button>
                    <span>
                        <input type="text" id="search-product" placeholder="Tornillo xs">
                    </span>
                </label>
            </form>
            <h2 style="display: flex;gap:3px;">Total de venta: <p style="color:#292b2d;">$<span id="total-price">0.00</span></p></h2>
            <table>
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
        <div class="float">
            <button id="sale">
                <i class="ri-check-fill"></i>
            </button>
            <div>
                <div class="counted" id="sale_options">
                    <span>Contado</span>
                    <button><i class="ri-bank-card-2-fill"></i></button>
                </div>
                <div class="apart" id="sale_options">
                    <span>Apartado</span>
                    <button><i class="ri-calendar-2-fill"></i></button>
                </div>
            </div>
        </div>
        <div class="bg_dialog"></div>
        <main class="dialog" id="dialog">
        <h2>Datos de venta y cliente</h2>
            <p>Complete los datos faltantes para completar la venta.</p>
            <form class="form" action="./sell.php" method="POST">
            <label>
                <p>Cliente DNI:</p>
                    <span>
                        <i class="ri-user-line"></i>
                        <input type="text" name="client" required placeholder="31744101">
                    </span>
                </label>
            <label>
                <p>Pago:</p>
                <span>
                    <i class="ri-mail-line"></i>
                    <input type="number" name="payment" step="any" required placeholder="100.43">
                </span>
            </label>
            <div class="details">
                <p><strong>Total:</strong> <span>3$ / 106Bs</span></p>
                <p><strong>Pago:</strong> <span>0$ / 0Bs</span></p>
            </div>
            <div class="container-buttons">
                <button class="btn cancel" type="button">
                    Cancelar
                </button>
                <button class="btn success" type="submit">
                    Realizar compra
                    <i style="font-weight:100"class="ri-money-dollar-circle-line"></i>
                </button>
            </div>
            </form>
        </main>
        <script type="module" src="./index.js"></script>
        <!-- <script type="text/javascript">
            const $btnSale = document.querySelector("#sale")
            const $modal = document.querySelector(".modal")
            $modal.addEventListener("click", ({
                target
            }) => {
                if (target.localName === "main") $modal.classList.remove("active")
            })
            const $optionsSale = document.querySelectorAll("#sale_options")
            $optionsSale.forEach($option => {
                $option.addEventListener("click", () => {
                    $modal.classList.add("active")
                })
            })
            $btnSale.addEventListener("click", () => {
                $btnSale.parentNode.classList.toggle("active")
            })
        </script> -->
        <?php endif ?>
        <?php if($place === "correct"): ?>
        <div class="container-buttons" style="justify-content: start;">
            <a href="./" class="btn cancel" style="max-width: 100px;">
                <i class="ri-arrow-left-line"></i>
                Volver
            </a>
            <a href="./print.php?ref=<?= $_GET["ref"]?>" class="btn primary" style="max-width: 100px;">
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
                        require_once '../helpers/curlData.php';
                        require_once '../helpers/formatDate.php';
                        $target = $_GET["ref"];
                        $data = getCurl("slot=sale&search=$target")[0];
                        $client = getCurl("slot=client&search=".$data['client'])[0];
                        $products = getCurl("slot=sale_product&search=".$target);
                        $total = array_reduce($products, function($carry,$item){
                            return $carry +($item["selling_price"] * $item["amount"]);
                        },0);
                        $date = $data["date"];
    
                    ?>
                    <p><?= formatDate($date) ?></p>
                    <!-- <p>Lo atendio: Jota</p> -->
                    <p>Cliente: <strong><?= $client["name"]." ".$client["surname"]?></strong></p>
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
                            foreach($products as $product):
                        ?>
                            <tr>
                                <td style="width: 50px;"><?= $index++ ?></td>
                                <td><?= $product["name"]?></td>
                                <td><?= $product["amount"]?></td>
                                <td><?= $product["selling_price"]."$"?></td>
                                <td><?= $product["selling_price"] * $product["amount"] ."$"?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div class="total">
                    <p><strong>Total: </strong><?= $total."$"?></p>
                    <p><strong>Pago: </strong><?= $data["payment"]."$"?></p>
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
    </section>
</body>