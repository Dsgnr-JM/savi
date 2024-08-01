<?php require "../ui/header.php" ?>
<title>Configuraciones - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
</head>

<body>
    <?php include '../ui/navbar.php' ?>
    <section>
        <header class="description">
            <i class="ri-settings-2-fill"></i>
            <div>
                <h1>Configuracion</h1>
                <p><i class="ri-information-fill"></i>Esta es el area de configuracion del sistema</p>
            </div>
        </header>
        <main>
            <h2>Administrativas <i class="ri-admin-line"></i></h2>
            <label>
                <input type="checkbox" name="" id="">
                <p>Los usuario que no son administradores pueden ver el modulo Ventas</p>
            </label>
            <label>
                <input type="checkbox" name="" id="">
                <p>Los usuario que no son administradores pueden cambiar los roles</p>
            </label>
            <label>
                <input type="checkbox" name="" id="">
                <p>Los usuario que no son administradores pueden generar informes</p>
            </label>
            <h2>Sistema <i class="ri-settings-2-line"></i></h2>
            <label>
                <input type="checkbox" name="" id="">
                <p>Cachear datos:</p>
            </label>
            <label>
                <input type="checkbox" name="" id="">
                <p>Tema Oscuro:</p>
            </label>
            <label>
                <input type="checkbox" name="" id="">
                <p>Desactivar animaciones del sistema:</p>
            </label>
            <label>
                <input type="checkbox" name="" id="">
                <p>Mantener sesion activa:</p>
            </label>
            <div class="buttons">
                <button>
                    <i class="ri-refresh-line"></i>
                    Resetear
                </button>
                <button>
                    <i class="ri-save-line"></i>
                    Guardar
                </button>
            </div>
        </main>
    </section>
</body>