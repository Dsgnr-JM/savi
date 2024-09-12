<?php require "ui/header.php" ?>
<title>Inicio - Inv.RefriHogar</title>
<link rel="stylesheet" href="index.css">
</head>

<body>
    <?php require 'ui/navbar.php' ?>
    <section>
        <header>
            <div class="card">
                <p>Ingresos</p>
                <div class="details">
                    <div class="gauge">
                        <i class="ri-triangle-fill success"></i>
                        <p>+30.6%</p>
                    </div>
                    <div class="details">
                        <p>Valor(exac)</p>
                        <h2>100.42<span>$</span></h2>
                    </div>
                </div>
            </div>
            <div class="card">
                <p>Gastos</p>
                <div class="details">
                    <div class="gauge">
                        <i class="ri-triangle-fill wrong rotate"></i>
                        <p>+50.6%</p>
                    </div>
                    <div class="details">
                        <p>Valor(exac)</p>
                        <h2>10.68<span>$</span></h2>
                    </div>
                </div>
            </div>
            <div class="card">
                <p>Clientes</p>
                <div class="details">
                    <div class="gauge">
                        <i class="ri-triangle-fill success"></i>
                        <p>+5.02%</p>
                    </div>
                    <div class="details">
                        <p>Valor(exac)</p>
                        <h2>10<span>u</span></h2>
                    </div>
                </div>
            </div>
            <div class="card">
                <p>Ventas</p>
                <div class="details">
                    <div class="gauge">
                        <i class="ri-triangle-fill wrong rotate"></i>
                        <p>-10.6%</p>
                    </div>
                    <div class="details">
                        <p>Valor(exac)</p>
                        <h2>100<span>u</span></h2>
                    </div>
                </div>
            </div>
        </header>
        <div class="stadistics" style="width: 100%" height=200>
            <div class="chart">
                <h2>Ventas por mes</h2>
                <canvas id="Chart"></canvas>
            </div>
            <div class="card-details">
                <div class="details">
                    <h2>Ganancias</h2>
                    <p>Promedio de ganancias entre gastos e ingresos, dicho promedio es mensual y esta disenado estadisticamente.</p>
                </div>
            </div>
            <div class="actual-activity">
                <h2>Notificaciones recientes</h2>
                <ol>
                    <li>
                        <a href="">
                        <i class="ri-alert-line"></i>
                        <div class="details">
                            <p>Se <span>actualizo</span> el <span>producto</span> <span>COC001</span>.</p>
                            <p>10-10-2024</p>
                        </div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                        <i class="ri-alert-line"></i>
                        <div class="details">
                            <p>Se <span>registro</span> el <span>producto</span> <span>ELE002</span>.</p>
                            <p>09-10-2024</p>
                        </div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                        <i class="ri-alert-line"></i>
                        <div class="details">
                            <p>Se <span>elimino</span> el <span>cliente</span> <span>31744101</span>.</p>
                            <p>08-10-2024</p>
                        </div>
                        </a>
                    </li>
                    <li>
                        <a href="">
                        <i class="ri-alert-line"></i>
                        <div class="details">
                            <p>Se <span>actualizo</span> el <span>precio del dolar</span> <span>40.02Bs</span>.</p>
                            <p>08-10-2024</p>
                        </div>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
        <!-- <div class="stadistics" style="width: 100%;" height=200>
            <canvas id="Chart2"></canvas>
        </div> -->
    </section>
    </div>
    <script src="lib/chart.js"></script>
    <script src="index.js" type="module"></script>
</body>
</html>