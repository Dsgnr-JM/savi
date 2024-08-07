<?php require "../ui/header.php" ?>
<?php 
    require_once "../helpers/curlData.php";

    $data = getCurl('slot=user&search='.$_SESSION["session"])[0];

    function appendClassIfTrue(string $text, string $class)
    {
        return !empty($text) ? $class : "";
    }

    $numRole = $data["manage_products"] + $data["manage_clients"] + $data["manage_system"] + $data["manage_informs"] + $data["manage_stadistics"] + $data["manage_providers"] + $data["manage_expenses"] + $data["manage_sales"];


 ?>
<title>Perfil - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="../../forms.css">
</head>
<style>
    .bar::before{
        width: <?= $numRole/8 * 100 . "%" ?> !important;
    }
</style>

<body>
    <?php include '../ui/navbar.php' ?>
    <section>
        <main>
        <div class="profile">
            <h2>Cuenta y gestion de usuario</h2>
            <p>Gestiona tu informacion personal, notificacion y radea tu actividad.</p>
            <div class="navigation">
                <button class="active" data-slot-pointed="account-details" data-need-dependencies="true" data-dependecies-transitive="checkInputFile">Detalles de la cuenta</button>
                <button data-slot-pointed="permissions">Permisos</button>
                <button data-slot-pointed="activity" data-need-dependencies="true">Actividad</button>
            </div>
            <div class="content" id="contentContainer">
                
            </div>
            <input type="hidden" name="ci" value="<?= $data["ci"] ?>">
            <template id="account-details">
                <form action="" data-action="updatePersonal" class="form not-ring" id="updatedName" style="width: 400px;">
                    <h3>Datos personales</h3>
                    <p>Actualiza tus datos personales asociados a tu cuenta.</p>
                    <label>
                        <p>Tu usuario:</p>
                        <span>
                            <input type="text" name="username" disabled required placeholder="user***" value="<?= $data["username"] ?>">
                            <i class="ri-profile-line" id="icon-form"></i>
                        </span>
                    </label>
                    <label>
                        <p>Tu cedula:</p>
                        <span>
                            <input type="text" name="name" disabled required placeholder="31744***" value="<?= $data["ci"] ?>">
                            <i class="ri-profile-line" id="icon-form"></i>
                        </span>
                    </label>
                    <label>
                        <p>Tu role:</p>
                        <span>
                            <input type="text" name="role" disabled required placeholder="vendedor" value="vendedor">
                            <i class="ri-profile-line" id="icon-form"></i>
                        </span>
                    </label>
                    <label>
                        <p>Actualizar nombre:</p>
                        <span>
                            <input type="text" name="name" placeholder="Anita" required value="<?= $data["name"]?>">
                            <i class="ri-user-line" id="icon-form"></i>
                        </span>
                    </label>
                    <label>
                        <p>Actualizar apellido:</p>
                        <span>
                            <input type="text" name="surname" value="<?= $data["surname"] ?>" required placeholder="Marcado">
                            <i class="ri-user-line" id="icon-form"></i>
                        </span>
                    </label>
                    <div class="container-buttons left">
                        <button class="btn success">
                            Actualizar datos
                        </button>
                    </div>
                </form>
                <div class="line-space"></div>
                <form action="#" class="form not-ring" data-action="updatePassword" id="updatedName" style="width: 400px;">
                    <h3>Contraseña</h3>
                    <p>Actualiza la contraseña asosociada a tu cuenta.</p>
                    <label>
                        <p>Contraseña actual:</p>
                        <span>
                            <input type="text" name="name" value="<?= $data["password"] ?>" disabled required placeholder="31744101" disabled>
                            <i class="ri-lock-unlock-line" id="icon-form"></i>
                        </span>
                    </label>
                    <label>
                        <p>Nueva contraseña:</p>
                        <span>
                            <input type="password" name="password" required placeholder="jotadev">
                            <i class="ri-lock-line" id="icon-form"></i>
                        </span>
                    </label>
                    <div class="container-buttons left">
                        <button class="btn success">
                            Actualizar contraseña
                        </button>
                    </div>
                </form>
                <div class="line-space"></div>
                <form action="#" class="form not-ring" data-action="updateAditional" enctype="multipart/form-data" id="updateAditional" style="width: 400px;">
                    <h3>Adicionales</h3>
                    <p>Actualiza los datos opcionales de tu cuenta.</p>
                    <label>
                        <p>Actualiza telefono:</p>
                        <span>
                            <input type="text" name="phone" value="<?= $data["phone"] ?>" required placeholder="04247079098">
                            <i class="ri-phone-line" id="icon-form"></i>
                        </span>
                    </label>
                    <label class="inputFile active">
                        <input type="file" name="image" id="inputFile" accept="">
                        <div class="presentation">
                            <i class="ri-gallery-line"></i>
                            <p>Arrastre y suelte una imagen en formato png | jpeg | webp</p>
                        </div>
                    </label>
                    <div class="container-buttons left">
                        <button class="btn success">
                            Actualizar adicionales
                        </button>
                    </div>
                </form>
                <div class="line-space"></div>
            </template>
            <template id="permissions">
                <div class="activity">
                    <h3>Roles y permisos</h3>
                    <p>Checkea cuales son tus permisos y el alcance que tienen los mismo para realizar operaciones dentro del sistema.</p>
                    <div class="permissions-overview">
                        <div class="permissions-bar">
                            <p>Alcance <p><?= $numRole ?>/8</p></p>
                            <span class="bar"></span>
                        </div>
                        <div class="card <?= appendClassIfTrue($data["manage_sales"], "active") ?>">
                            <i class="<?= !empty($data["manage_sales"]) ? "ri-checkbox-circle-fill" : "ri-close-circle-fill" ?> role icon"></i>
                            <div class="details">
                                <h3>Vender productos</h3>
                                <p>Vende productos de la organizacion a clientes registrados.</p>
                            </div>
                        </div>
                        <div class="card <?= appendClassIfTrue($data["manage_clients"], "active") ?>">
                            <i class="<?= !empty($data["manage_clients"]) ? "ri-checkbox-circle-fill" : "ri-close-circle-fill" ?> icon"></i>
                            <div class="details">
                                <h3>Registrar y visualizar clientes</h3>
                                <p>Administra a los clientes y registra a los mismos.</p>
                            </div>
                        </div>
                        <div class="card <?= appendClassIfTrue($data["manage_expenses"], "active") ?>">
                            <i class="<?= !empty($data["manage_expenses"]) ? "ri-checkbox-circle-fill" : "ri-close-circle-fill" ?> icon"></i>
                            <div class="details">
                                <h3>Administrar gastos</h3>
                                <p>Acceso al registro, modificacion y eliminacion de los gastos.</p>
                            </div>
                        </div>
                        <div class="card <?= appendClassIfTrue($data["manage_products"], "active") ?>">
                            <i class="<?= !empty($data["manage_products"]) ? "ri-checkbox-circle-fill" : "ri-close-circle-fill" ?> icon"></i>
                            <div class="details">
                                <h3>Administrar productos</h3>
                                <p>Cambia los detalles de los productos existentes en la empresa, ademas de otras operaciones.</p>
                            </div>
                        </div>
                        <div class="card <?= appendClassIfTrue($data["manage_providers"], "active") ?>">
                            <i class="<?= !empty($data["manage_providers"]) ? "ri-checkbox-circle-fill" : "ri-close-circle-fill" ?> icon"></i>
                            <div class="details">
                                <h3>Administrar proveedores</h3>
                                <p>Maneja todo lo relacionado a los proveedores y operaciones relacionadas.</p>
                            </div>
                        </div>
                        <div class="card <?= appendClassIfTrue($data["manage_stadistics"], "active") ?>">
                            <i class="<?= !empty($data["manage_stadistics"]) ? "ri-checkbox-circle-fill" : "ri-close-circle-fill" ?> icon"></i>
                            <div class="details">
                                <h3>Visualizar estadisticas</h3>
                                <p>Generacion y visualizacion de estadisticas y graficos.</p>
                            </div>
                        </div>
                        <div class="card <?= appendClassIfTrue($data["manage_informs"], "active") ?>">
                            <i class="<?= !empty($data["manage_informs"]) ? "ri-checkbox-circle-fill" : "ri-close-circle-fill" ?> icon"></i>
                            <div class="details">
                                <h3>Generar informes</h3>
                                <p>Administracion y generacion de informes generales entre otros.</p>
                            </div>
                        </div>
                        <div class="card <?= appendClassIfTrue($data["manage_system"], "active") ?>">
                            <i class="<?= !empty($data["manage_system"]) ? "ri-checkbox-circle-fill" : "ri-close-circle-fill" ?> icon"></i>
                            <div class="details">
                                <h3>Administrar sistema</h3>
                                <p>Acceso y control total al manejo de los roles y el sistema.</p>
                            </div>
                        </div>
                    </div>
                    <blockquote class="info">
                        <p>Tienes problemas con tus roles?</p>
                        <p>Consulta con tu administrador de sistemas o el soporte.</p>
                    </blockquote>
                </div>
            </template>
            <template id="activity">
                 <div class="activity">
                    <h3>Actividad y rastreo</h3>
                    <p>Visualiza todo tu historial de operaciones en el sistema.</p>
                    <div class="activity-overview">
                        <p>Vision general (9)</p>
                        <ol>
                            <li>
                                <span></span>
                                <div>
                                    <p>Tornillo xs vendido</p>
                                    <p>Hecho el 2024-11-03</p>
                                </div>
                            </li>
                            <li>
                                <span></span>
                                <div>
                                    <p>Tornillo xs vendido</p>
                                    <p>Hecho el 2024-11-03</p>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </template>
        </div>
        </main>
    </section>
    </div>
    <script src="../../lib/bell.mjs"></script>
    <script src="../lib/navigationByTags.js"></script>
</body>

</html>