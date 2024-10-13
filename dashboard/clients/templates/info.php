<?php require_once "../helpers/NameTranslator.php" ?>

<h2 class="toLeft"><i class="ri-user-line"></i>Detalles del cliente</h2>
<p class="toLeft">Información general del cliente, desde los datos básico hasta su movimiento</p>

<h3 style="margin-bottom:10px" class="toLeft">Informacion básica</h3>
<div class="details-general toDown">
    <img src="<?= $image ?? "../../assets/no-image.png" ?>">
    <div class="details">
        <h4>DNI del cliente:</h4>
        <p><?= $dni ?></p>
        <h4>Nombre del cliente:</h4>
        <p><?= $name . " " . $surname ?></p>
        <h4>Telefono del cliente:</h4>
        <p><?= $phone ?></p>
        <h4>Localización:</h4>
        <p><?= $location ?></p>
    </div>
    <div class="details">
        <h4>Tipo de cliente:</h4>
        <p><?= $type ?></p>
        <h4>Nombre de la Empresa:</h4>
        <p><?= $enterprise_name ?></p>
        <h4>Cuentas pendiente:</h4>
        <p><?= $status ?></p>
    </div>
</div>
<h3 class="toLeft">Listado de compras</h3>
<p class="toLeft">Indice de compras realizadas a favor del cliente.</p>
<div class="stock toDown">
    <div class="card toLeft">
        <h2><?= $total_sales ?></h2>
        <p>Ventas realizadas</p>
    </div>
    <div class="card toLeft">
        <table>
            <thead>
                <tr></tr>
                <td><strong>Nro. Factura</strong></td>
                <td><strong>Fecha</strong></td>
                <td><strong>Estado</strong></td>
            </thead>
            <tbody>
                <?php foreach ($sales as $sale) : ?>
                    <tr>
                        <td><span><?= $sale["nro_factura"] ?></span></td>
                        <td><span><?= $sale["date"] ?></span></td>
                        <td><span class="badge <?= $sale["status"]?>"><?= nameTranslator($sale["status"])?></span></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>