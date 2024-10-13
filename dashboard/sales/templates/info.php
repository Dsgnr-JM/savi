<?php require_once "../helpers/NameTranslator.php" ?>

<h2 class="toLeft"><i class="ri-user-line"></i>Detalles de Venta</h2>
<p class="toLeft">Información general de la venta.</p>

<h3 style="margin-bottom:10px" class="toLeft">Informacion básica</h3>
<div class="details-general toDown">
    <div class="details">
        <h4>Nro de factura:</h4>
        <p><?= $nro_factura ?></p>
        <h4>Fecha de venta:</h4>
        <p><?= $date ?></p>
        <h4>Estado de venta:</h4>
        <p><?= $status == "pending" ? "Pendiente" : "Pagado"; ?></p>
    </div>
    <div class="details">
    <h4>Precio de la venta:</h4>
        <p><?= $total ?> $</p>
        <h4>Pago del cliente:</h4>
        <p><?= $payment ?> $</p>
        <h4>Faltante:</h4>
        <p><?= $missing ?> $</p>
    </div>
    <div class="details">
        <h4>DNI del cliente:</h4>
        <p><?= $client ?></p>
        <h4>Nombre del cliente:</h4>
        <p><?= $enterprise_name ?? $name." ".$surname ?></p>
        <h4>Telefono del cliente:</h4>
        <p><?= $phone ?></p>
        <h4>Localización:</h4>
        <p><?= $location ?></p>
    </div>
</div>
<h3 class="toLeft">Productos</h3>
<p class="toLeft">Indice de productos existentes en la venta.</p>
<div class="stock toDown">
    <div class="card toLeft">
        <table>
            <thead>
                <tr></tr>
                <td><strong>Código</strong></td>
                <td><strong>Descripcion</strong></td>
                <td><strong>Precio</strong></td>
                <td><strong>Cantidad</strong></td>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><span><?= $product["code"] ?></span></td>
                        <td><span><?= $product["name"] ?></span></td>
                        <td><span><?= $product["selling_price"] ?> $</span></td>
                        <td><span><?= $product["amount"] ?></span></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>