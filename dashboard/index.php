<?php require "ui/header.php" ?>
<title>Inicio - Inv.RefriHogar</title>
<link rel="stylesheet" href="index.css">
</head>

<body>
    <?php require 'ui/navbar.php' ?>
    <section>
        <header>
            <div class="card">
                <span>
                    <h2 style="color:forestgreen">
                        $12012
                        <span>Ingresos</span>
                    </h2>
                    <i class="ri-money-dollar-circle-line"></i>
                </span>
                <span style="background: linear-gradient(to right,rgb(0 210 131), rgb(4 255 164));">
                    <p>% cambiado</p>
                    <i class="ri-line-chart-line"></i>
                </span>

            </div>
            <div class="card">
                <span>
                    <h2 style="color:coral">
                        $12.05
                        <span>Perdidas:</span>
                    </h2>
                    <i class="ri-error-warning-line"></i>
                </span>
                <span style="background: linear-gradient(to right,rgb(255 141 90), rgb(255 181 146))">
                    <p>% cambiado</p>
                    <i class="ri-line-chart-line"></i>
                </span>

            </div>
            <div class="card">
                <span>
                    <h2 style="color:deeppink">
                        5891
                        <span>Ventas</span>
                    </h2>
                    <i class="ri-file-chart-line"></i>
                </span>
                <span style="background: linear-gradient(to right,rgb(255 49 103), rgb(255 127 151))">
                    <p>% cambiado</p>
                    <i class="ri-line-chart-line"></i>
                </span>

            </div>
            <div class="card">
                <span>
                    <h2 style="color:dodgerblue">
                        1245
                        <span>Clientes</span>
                    </h2>
                    <i class="ri-group-line"></i>
                </span>
                <span style="background: linear-gradient(to right,rgb(6 174 176), rgb(0 225 225))">
                    <p>% cambiado</p>
                    <i class="ri-line-chart-line"></i>
                </span>

            </div>
        </header>
        <div class="stadistics" style="width: 100%;" height=200>
            <canvas id="Chart"></canvas>
        </div>
    </section>
    </div>
    <script src="lib/chart.js"></script>
    <script src="index.js" type="module"></script>
</body>
</html>