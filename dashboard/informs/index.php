<?php require "../ui/header.php" ?>
<title>Informes - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="../../lib/alert-message.css">
<link rel="stylesheet" href="../../lib/dialog.css">
<link rel="stylesheet" href="../../forms.css">
</head>

<body>
    <?php include '../ui/navbar.php' ?>
    <section>
        <h2><i class="ri-file-text-line"></i>Informes</h2>
        <p>Secci&oacute;n de informes y reportes del sistema.</p>
        <button class="btn success" style="margin-top:20px">
            <i class="ri-add-line"></i>Crear informe
        </button>
        <div class="informs-options">
            <div class="card-inform">
                <div class="details">
                    <h3><i class="ri-bar-chart-fill"></i>Ventas por Peri&oacute;do</h3>
                    <p>Resumen de ventas</p>
                    <p>Ultima actualizaci&oacute;n: <span>2023-06-15</span></p>
                </div>
                <div class="actions">
                    <div class="badge warning">Desactualizado</div>
                    <a href="generateInforms.php?type=sales">Generar</a>
                </div>
            </div>
            <div class="card-inform">
                <div class="details">
                    <h3><i class="ri-line-chart-fill"></i>An&aacute;lisis de Tendencias</h3>
                    <p>Tendencias de productos</p>
                    <p>Ultima actualizaci&oacute;n: <span>2023-06-15</span></p>
                </div>
                <div class="actions">
                    <div class="badge warning">Desactualizado</div>
                    <a href="generateInforms.php?type=trend_products">Generar</a>
                </div>
            </div>
            <div class="card-inform">
                <div class="details">
                    <h3><i class="ri-file-3-line"></i>Reporte de Inventario</h3>
                    <p>Estado actual del inventario</p>
                    <p>Ultima actualizaci&oacute;n: <span>2023-06-12</span></p>
                </div>
                <div class="actions">
                    <div class="badge success">Actualizado</div>
                    <a href="generateInforms.php?type=inventary">Generar</a>
                </div>
            </div>
            <div class="card-inform">
                <div class="details">
                    <h3><i class="ri-user-line"></i>Reporte de Clientes</h3>
                    <p>Resumen de clientes</p>
                    <p>Ultima actualizaci&oacute;n: <span>2023-06-05</span></p>
                </div>
                <div class="actions">
                    <div class="badge success">Actualizado</div>
                    <a href="generateInforms.php?type=clients">Generar</a>
                </div>
            </div>
        </div>
        <div class="alert-message warning">
            <i class="ri-error-warning-line"></i>
            <div class="details">
                <h3>Informaci&oacute;n importante</h3>
                <p>Los informes proporcionan una visi&oacute;n general del rendimiento de la empresa. Asegurese de revisar y actualizar regularmente para tomar decisiones informadas. Los informes marcados como "Desactualizados" pueden contener informaci&oacute;n obsoleta.</p>
            </div>
        </div>
    </section>
</body>