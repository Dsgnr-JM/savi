<?php require "../ui/header.php" ?>
<title>Mantenimiento - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="../../forms.css">
<link rel="stylesheet" href="../../lib/dialog.css">
</head>

<body>
    <?php include '../ui/navbar.php' ?>
    <section>
        <h2><i class="ri-shield-check-line"></i>Mantenimiento</h2>
        <p>Gestiona el mantenimiento del sistema, crea copias de seguridad y envia feedback al equipo desarrollador.</p>
        <div class="maintenace">
            <button class="card" data-dialog="export_bd">
                <i class="ri-export-line"></i>
                <div>
                    <h3>Exportar datos</h3>
                    <p>Exporta una base de datos en formato <strong>sql</strong>.</p>
                </div>
            </button>
            <button class="card" data-dialog="import_bd">
                <i class="ri-import-line"></i>
                <div>
                    <h3>Importar datos</h3>
                    <p>Sube tu propia base de datos, y <strong>modifica</strong> los datos actuales.</p>
                </div>
            </button>
            <button class="card" data-dialog="contact">
                <i class="ri-discuss-line"></i>
                <div>
                    <h3>Contactar soporte</h3>
                    <p>Env&iacute;a un correo de soporta al equipo de desarrollo.</p>
                </div>
            </button>
        </div>
        <div class="bg_dialog"></div>
        <main class="dialog" id="export_bd">
            <h2>¿Est&aacute;s seguro de exportar la Base de Datos?</h2>
            <p>Tenga en cuenta que esto puede poner recaer en peligro a la seguridad del sistema. Si desea continuar por favor presione el bot&oacute;n de exportar.</p>
            <div class="container-buttons">
                <button class="btn cancel">
                    Cancelar
                </button>
                <button class="btn success">
                    Exportar
                    <i class="ri-arrow-drop-right-line"></i>
                </button>
            </div>
        </main>
        <main class="dialog" id="import_bd">
            <h2>¿Est&aacute;s seguro de importar la Base de Datos?</h2>
            <p>Esto puede ocacionar fugaz o perdida de informaci&oacute;n que escapa de la zona segura del sistema. Si desea continuar presione cargue el archivo SQL</p>
            <div class="container-buttons">
                <button class="btn cancel">
                    Cancelar
                </button>
                <button class="btn success">
                    Exportar
                    <i class="ri-arrow-drop-right-line"></i>
                </button>
            </div>
        </main>
        <main class="dialog" id="contact">
            <h2>¿Tiene alg&uacute;n problema o inconformidad?</h2>
            <p>Contacte al equipo de desarrolladores de SAVI y denos <strong>feedback</strong> del problema para as&iacute; poder ayudarle.</p>
            <form class="form">
                <div class="inputs-container">
                    <label>
                        <p>Nombre:</p>
                        <span>
                            <i class="ri-user-line"></i>
                            <input type="text" name="name" required placeholder="John">
                        </span>
                    </label>
                    <label>
                        <p>Apellido:</p>
                        <span>
                            <i class="ri-user-line"></i>
                            <input type="text" name="surname" required placeholder="Doe">
                        </span>
                    </label>
                </div>
                <label>
                    <p>Email:</p>
                    <span>
                        <i class="ri-mail-line"></i>
                        <input type="email" name="email" required placeholder="noreply@gmail.com">
                    </span>
                </label>
                <label>
                    <p>Mensaje:</p>
                    <textarea name="message" placeholder="Hola somos la empresa..."></textarea>
                </label>
                <div class="container-buttons">
                    <button class="btn cancel" type="button">
                        Cancelar
                    </button>
                    <button class="btn success" type="submit">
                        Enviar
                        <i class="ri-arrow-drop-right-line"></i>
                    </button>
                </div>
            </form>
        </main>
    </section>
    <script type="module" src="index.js"></script>
</body>