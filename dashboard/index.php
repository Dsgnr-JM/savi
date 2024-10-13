<?php
require_once './helpers/curlData.php';
require_once './helpers/numberFormat.php';
require_once './helpers/matchWords.php';
$saleTotal = getCurl("slot=sale_total")[0];
$saleCount = getCurl("slot=sale_count")[0];
$productCount = getCurl("slot=product_count")[0]["total"];
$clientCount = getCurl("slot=client_count")[0]["total"];
$notifications = getCurl("slot=logs")["data"];
$saleCountPercentaje = formatPercentaje($saleCount["sale_month"],$saleCount["sale_old_month"]);
$simbolCount = numberSimbol($saleCountPercentaje);
$simbolSale =  numberSimbol($saleTotal["total_sale_month"]);
$saleCountPercentaje = abs($saleCountPercentaje);
$index = 0;

?>

<?php require "ui/header.php" ?>
<title>Inicio - Inv.RefriHogar</title>
<link rel="stylesheet" href="index.css">
</head>

<body>
    <?php require 'ui/navbar.php' ?>
    <section>
        <h2 class="toLeft"><i class="ri-dashboard-line"></i>Visi&oacute;n general</h2>
        <p class="toLeft">Bienvenido de nuevo <strong><?= $user["name"]." ".$user["surname"]?></strong></p>
        <header class="toDown">
            <div class="card">
                <p>Ingresos</p>
                <div class="details">
                    <div class="gauge">
                        <i class="ri-triangle-fill <?= $simbolCount == "+" ? "success": "wrong rotate" ?>"></i>
                        <p><?=$simbolCount.$saleCountPercentaje?>%</p>
                    </div>
                    <div class="details">
                        <p>Valor(exac)</p>
                        <h2><?= $saleTotal["total_sale_month"]?><span>$</span></h2>
                    </div>
                </div>
            </div>
            <div class="card">
                <p>Ventas</p>
                <div class="details">
                    <div class="gauge">
                        <i class="<?= $simbolSale == "+" ? "success": "wrong rotate" ?> ri-triangle-fill"></i>
                        <p><?=$simbolSale.$saleCountPercentaje?>%</p>
                    </div>
                    <div class="details">
                        <p>Valor(exac)</p>
                        <h2><?=$saleCount["sale_month"]?><span>u</span></h2>
                    </div>
                </div>
            </div>
            <div class="card">
                <p>Productos</p>
                <div class="details">
                    <div class="gauge">
                        <i class="ri-shopping-bag-line success"></i>
                        <p style="opacity: 0;">+5.02%</p>
                    </div>
                    <div class="details">
                        <p>Valor(exac)</p>
                        <h2><?=$productCount ?><span>u</span></h2>
                    </div>
                </div>
            </div>
            <div class="card">
                <p>Clientes</p>
                <div class="details">
                    <div class="gauge">
                        <i class="ri-user-line success"></i>
                        <p style="opacity: 0;">+5.02%</p>
                    </div>
                    <div class="details">
                        <p>Valor(exac)</p>
                        <h2><?=$clientCount ?><span>u</span></h2>
                    </div>
                </div>
            </div>
        </header>
        <div class="stadistics" style="width: 100%" height=200>
            <div class="chart toDown">
                <h2>Ventas por mes</h2>
                <canvas id="Chart"></canvas>
            </div>
            <!-- <div class="card-details toDown">
                <div class="details">
                    <h2>Ganancias</h2>
                    <p>Promedio de ganancias entre gastos e ingresos, dicho promedio es mensual y esta dise&ntilde;ado estadisticamente.</p>
                </div>
            </div> -->
            <div class="actual-activity toDown">
                <h2>Notificaciones recientes</h2>
                <ol>
                <?php foreach($notifications as $notification ): ?>
                        <?php
                            if($index > 2) break;
                            $index++;
                        ?>
                        <li>
                            <i class="ri-alert-line"></i>
                            <div class="details">
                                <p><?=matchWords($notification["message"])?></p>
                                <p></p>
                            </div>
                        </li>
                    <?php endforeach ?>
                </ol>
            </div>
        </div>
        <!-- <div class="stadistics" style="width: 100%;" height=200>
            <canvas id="Chart2"></canvas>
        </div> -->
    </section>
    </div>
    <?php include 'ui/animate.php' ?>
    <script src="lib/chart.js"></script>
    <script src="index.js" type="module"></script>
</body>
</html>