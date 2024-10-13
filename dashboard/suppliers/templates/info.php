<?php require_once "../helpers/NameTranslator.php" ?>

<h2 class="toLeft"><i class="ri-user-line"></i>Detalles del cliente</h2>
<p class="toLeft">Información general del proveedor, desde los datos básico hasta su movimiento</p>

<h3 style="margin-bottom:10px" class="toLeft">Informacion básica</h3>
<div class="details-general toDown">
    <img src="<?= $image ? $image : "../../assets/no-image.png" ?>">
    <div class="details">
        <h4>RIF del proveedor:</h4>
        <p><?= $rif ?></p>
        <h4>Nombre de la empresa:</h4>
        <p><?= $name ?></p>
        <h4>Nombre del encargado:</h4>
        <p><?= $manager ?> $</p>
    </div>
    <div class="details">
        <h4>Telefono del proveedor:</h4>
        <p><?= $phone ?></p>
        <h4>Email del proveedor:</h4>
        <p><?= $email ?></p>
        <h4>Localización:</h4>
        <p><?= $location ?></p>
    </div>
</div>
<h3 class="toLeft">Listado de ventas</h3>
<p class="toLeft">Indice de ventas realizadas a favor del proveedor.</p>
<div class="stock toDown">
    <div class="card toLeft">
        <h2><?= $total_purchases ?></h2>
        <p>Productos vendidos</p>
    </div>
    <div class="card toLeft">
        <table>
            <thead>
                <tr></tr>
                <td><strong>Código</strong></td>
                <td><strong>Descripcion</strong></td>
                <td><strong>Precio</strong></td>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><span><?= $product["code"] ?></span></td>
                        <td><span><?= $product["name"] ?></span></td>
                        <td><span><?= $product["selling_price"]." $" ?></span></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>