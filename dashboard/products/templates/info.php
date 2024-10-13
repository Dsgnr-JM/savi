<h2 class="toLeft"><i class="ri-file-info-line"></i>Detalles del producto</h2>
<p class="toLeft">Información general del producto, desde los datos básico hasta los detalles de ventas</p>

<h3 style="margin-bottom:10px"class="toLeft">Informacion básica</h3>
<div class="details-general toDown">
    <img src="<?= $photo ?? "../../assets/no-image.png"?>">
        <div class="details">
            <h4>Codigo del producto:</h4>
            <p><?= $code ?></p>
            <h4>Nombre del producto:</h4>
            <p><?= $name ?></p>
            <h4>Precio de Compra:</h4>
            <p><?= $purchase_price ?> $</p>
            <h4>Precio de Venta:</h4>
            <p><?= $selling_price ?> $</p>
        </div>
        <div class="details">
            <h4>Departamento:</h4>
            <p><?= $category_name ?></p>
            <h4>RIF Proveedor:</h4>
            <p><?= $supplier ?></p>
            <h4>Nombre del Proveedor:</h4>
            <p><?= $supplier_name ?></p>
            <h4>Localización del Proveedor:</h4>
            <p><?= $supplier_location ?></p>
        </div>
</div>
<h3 class="toLeft">Stock</h3>
<p class="toLeft">Cantidad de existencias actuales.</p>
<div class="stock toDown">
    <div class="card toLeft">
        <h2><?=$stock_min?></h2>
        <p>Stock Minimo</p>
    </div>
    <div class="card toLeft">
        <h2><?=$stock?></h2>
        <p>Stock Actual</p>
    </div>
    <div class="card toLeft">
        <h2><?=$stock_max?></h2>
        <p>Stock Maximo</p>
    </div>
</div>
<h3>Ventas y Ganancias</h3>
<p>Movimiento del producto dentro del sistema.</p>
<div class="sell">
    <div class="card">
        <h2><?= $total_sales ?></h2>
        <p>Veces vendidos</p>
    </div>
    <div class="card">
        <h2><?= $earnings["grossProfit"] ?> $ <span class="<?=$earnings["percentage"] < 0 ?'wrong' : ''?>"><?=$earnings["percentage"]?>%</span></h2>
        <p>Ganancias en factor al Precio</p>
    </div>
</div>