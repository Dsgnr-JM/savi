<div class="sale-details">
    <picture>
        <img src="../IMG-20240306-WA0032~2.jpg" alt="logo-empresa">
    </picture>
    <div class="factura">
        <button class="more toDown" data-show="show">
            <i class="ri-more-2-line" data-show="show"></i>
            <ol>
                <a href="./print/ticket.php?ref=<?= $_GET["ref"] ?>&conversion=<?= $_GET["conversion"] ?? "" ?>"><i class="ri-ticket-line"></i>Generar Ticket</a>
                <a href="./print/book.php?ref=<?= $_GET["ref"] ?>&conversion=<?= $_GET["conversion"] ?? "" ?>"><i class="ri-book-line"></i>Generar Talonario</a>
                <a href="./print/invoice.php?ref=<?= $_GET["ref"] ?>&conversion=<?= $_GET["conversion"] ?? "" ?>"><i class="ri-file-line"></i>Generar Factura</a>
            </ol>
        </button>
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
        <p>Para imprimir haga click en el bot&oacute;n <i class="ri-more-fill" style="background-color: var(--primary-color);color:white"></i> de la esquina superior izquierda y seleccione la opción que le convenga.</p>
        <p>Recomendamos usar un navegador basado en chromium y desde un ordenador.</p>
        <p><strong>Nota:</strong> Recuerda que puedes configurar las facturas desde los ajustes del sistema</p>
    </article>
</main>
<script type="module" src="./fact.js"></script>