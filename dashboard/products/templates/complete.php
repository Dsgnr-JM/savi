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
            $data = getCurl("slot=purchase&search=$target")[0];
            $products = getCurl("slot=purchase_product&search=" . $target);
            $total = array_reduce($products, function ($carry, $item) {
                return $carry + ($item["selling_price"] * $item["amount"]);
            }, 0);
            $convert = $_GET["conversion"] ?? null;
            $total = $convert == "bs" ? $total * $dolarPrice : $total;
            $date = $data["date"];

            ?>
            <p><?= formatDate($date) ?></p>
            <!-- <p>Lo atendio: Jota</p> -->
            <p>Inv. Refrihogar</p>
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
        </div>
    </div>
</div>
<main class="sale-message">
    <i class="ri-information-fill"></i>
    <article class="description">
        <p>Para imprimir haga click en el bot&oacute;n <i class="ri-printer-fill"></i> de la esquina superior izquierda.</p>
        <p>Recomendamos usar un navegador basado en chromium y desde un ordenador.</p>
        <p><strong>Nota:</strong> Recuerda que puedes configurar las facturas desde los ajustes del sistema</p>
    </article>
</main>