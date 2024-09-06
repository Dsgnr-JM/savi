<?php require "../ui/header.php" ?>
<title>Mantenimiento - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
</head>

<body>
    <?php include '../ui/navbar.php' ?>
    <section>
        <header class="description">
            <i class="ri-shield-check-fill"></i>
            <div>
                <h1>Mantenimiento</h1>
                <p><i class="ri-information-fill"></i>Esta es el area de mantenimiento para el sistema</p>
            </div>
        </header>
        <div>
            <button class="card">
                <i class="ri-export-line"></i>
                <div>
                    <h3>Exportar base de datos</h3>
                    <p>Exporta una base de datos en formato <strong>sql</strong>.</p>
                </div>
            </button>
            <button class="card">
                <i class="ri-import-line"></i>
                <div>
                    <h3>Importar base de datos</h3>
                    <p>Sube tu propio base de datos, y <strong>modifica</strong> los datos actuales.</p>
                </div>
            </button>
            <button class="card">
                <i class="ri-discuss-line"></i>
                <div>
                    <h3>Contactar soporte</h3>
                    <p>Envia un correo de soporta al equipo de desarrollo.</p>
                </div>
            </button>
        </div>
    </section>
</body>
