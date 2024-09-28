<?php require "../ui/header.php" ?>
<?php
require_once "../helpers/curlData.php";

$data = getCurl('slot=user&search=' . $_SESSION["session"])[0];
$roles = getCurl("slot=roles");
$role =$roles[0];
$notifications = getCurl("slot=logs");
$notificationsLength = $notifications["length"];
$notifications = $notifications["data"];
$dollarPrice = getCurl('slot=configs')[0];

$roleNames = array(
    "assistant" => "Asistente",
    "seller" => "Vendedor",
    "administrator" => "Administrador"
);

$manage = array(
    "products" => $role["manage_products"] ? "checked" : "",
    "sales" => $role["manage_sales"] ? "checked" : "",
    "clients" => $role["manage_clients"] ? "checked" : "",
    "expenses" => $role["manage_expenses"] ? "checked" : "",
    "providers" => $role["manage_providers"] ? "checked" : "",
    "informs" => $role["manage_informs"] ? "checked" : "",
    "system" => $role["manage_system"] ? "checked" : "",
    "stadistics" => $role["manage_stadistics"] ? "checked" : "",

);

function appendClassIfTrue(string $text, string $class)
{
    return !empty($text) ? $class : "";
}

$numRole = $data["manage_products"] + $data["manage_clients"] + $data["manage_system"] + $data["manage_informs"] + $data["manage_stadistics"] + $data["manage_providers"] + $data["manage_expenses"] + $data["manage_sales"];


?>
<title>Configuracion - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="../../forms.css">
<link rel="stylesheet" href="../../lib/dialog.css">
<link rel="stylesheet" href="../../lib/alert-message.css">
</head>
<style>
    .bar::before {
        width: <?= $numRole / 8 * 100 . "%" ?> !important;
    }
</style>

<body>
    <?php include '../ui/navbar.php' ?>
    <section>
        <h2><i class="ri-settings-4-line"></i>Configuraciones</h2>
        <p>Manejo de directivas del sistema</p>
        <main style="margin-top:20px">
            <div class="profile">
                <div class="navigation">
                    <button class="active" data-slot-pointed="permissions">Directivas</button>
                    <button data-slot-pointed="logs">Logs</button>
                    <button data-slot-pointed="conversion">Divisa</button>
                </div>
                <div class="content" id="contentContainer">

                </div>
                <template id="permissions">
                    <div class="permissions">
                        <form class="form not-ring" style="width:100%;">
                            <div>
                                <h3>Permisos</h3>
                                <p>Directivas que seguira el sistema dependiendo del rol del usuario.</p>
                                <label style="width: 300px;">
                                    <p>Rol:</p>
                                    <select id="role" name="role">
                                        <?php foreach($roles as $role): ?>
                                        <option value="<?=$role["role"]?>"><?=$roleNames[$role["role"]]?></option>
                                        <?php endforeach ?>
                                    </select>
                                </label>
                            </div>
                            <h3>Lista de permisos</h3>
                            <p>Listado de todos los permisos disponibles dentro del sistema</p>
                            <div class="permission">
                                <div class="details">
                                    <h3>Productos</h3>
                                    <p>Permite al usuario acceder al modulo de productos. Tambien puede editar, ver, borrar y actualizar los productos y sus diferentes categorias, modelos, etc.</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" name="manage_products" <?= $manage["products"] ?> id="switch">
                                </label>
                            </div>
                            <div class="permission">
                                <div class="details">
                                    <h3>Estadisticas</h3>
                                    <p>Permite al usuario acceder al modulo, asi como tambien generar estadisticas de productos, clientes etc.</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" name="manage_stadistics" <?= $manage["stadistics"] ?> id="switch">
                                </label>
                            </div>
                            <div class="permission">
                                <div class="details">
                                    <h3>Proveedores</h3>
                                    <p>Permite al usuario acceder al modulo de proveedores, añadir, eliminar y actualizarlos.</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" name="manage_providers" <?= $manage["providers"] ?> id="switch">
                                </label>
                            </div>
                            <div class="permission">
                                <div class="details">
                                    <h3>Clientes</h3>
                                    <p>Permite al usuario acceder al modulo de clientes, añadir, eliminar y actualizarlos.</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" name="manage_clients" <?= $manage["clients"] ?> id="switch">
                                </label>
                            </div>
                            <div class="permission">
                                <div class="details">
                                    <h3>Ventas</h3>
                                    <p>Permite al usuario acceder al modulo de ventas. Tambien puede generarlas y visualizarlas.</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" name="manage_sales" <?= $manage["sales"] ?> id="switch">
                                </label>
                            </div>
                            <div class="permission">
                                <div class="details">
                                    <h3>Gastos</h3>
                                    <p>Permite al usuario acceder al modulo de gastos. Tambien puede añadir, eliminar y actulizar los gastos.</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" name="manage_expenses" <?= $manage["expenses"] ?> id="switch">
                                </label>
                            </div>
                            <div class="permission">
                                <div class="details">
                                    <h3>Informes</h3>
                                    <p>Permite al usuario acceder al modulo de informes. Tambien puede generar, actualizar, descargar y visualizar los diferentes informes.</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" name="manage_informs" <?= $manage["informs"] ?> id="switch">
                                </label>
                            </div>
                            <div class="permission">
                                <div class="details">
                                    <h3>Sistema</h3>
                                    <p>Permite al usuario acceder al modulo de configuracion y mantenimiento. Puede cambiar roles, ver actividad, precio de divisas, exportacion e importacion de datos.</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" name="manage_system" <?= $manage["system"] ?> id="switch">
                                </label>
                            </div>
                            <!-- <div class="container-buttons" style="justify-content: start;">
                                <button class="btn cancel" type="button">
                                    Cancelar
                                </button>
                                <button class="btn success">Guardar <i class="ri-save-line"></i></button>
                            </div> -->
                        </form>
                    </div>
                </template>
                <template id="logs">
                    <h3>Historial</h3>
                    <p>Dale un seguimiento a toda la actividad registrada dentro del sistema.</p>
                    <ol id="container_logs">
                        <?php foreach ($notifications as $notification) : ?>
                            <li>
                                <i class="ri-notification-3-line"></i>
                                <div class="details">
                                    <p><?= $notification["message"] . "." ?></p>
                                    <p><?= $notification["date"] ?></p>
                                    <span class="badge info">Accion realizada por el usuario <?= $notification["user"] ?></span>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </ol>
                    <?php if ($notificationsLength > 1) : ?>
                        <button class="btn cancel" style="margin:20px auto;width:fit-content;" id="view-more">
                            Ver mas
                            <i class="ri-arrow-down-s-line"></i>
                        </button>
                    <?php endif ?>
                </template>
                <template id="conversion">
                    <form class="form not-ring" style="width:100%" id="form_conversion">
                        <div>
                            <h3 style="margin-top: 0;">Precio del Dolar</h3>
                            <p>Cambie el precio de la divisa y mantenga actulizado el precio de cambio.</p>
                            <label style="width: 300px;">
                                <p>Cambio a Bs:</p>
                                <span>
                                    <input type="text" name="dollar_price" required placeholder="37.2">
                                    <i class="ri-coins-line" id="icon-form"></i>
                                </span>
                            </label>
                            <button class="btn primary fit" style="margin-top: 20px;">Cambiar <i class="ri-save-line"></i></button>
                        </div>
                        <div class="alert-message info">
                            <i class="ri-error-warning-line"></i>
                            <div class="details">
                                <h3>Informacion importante</h3>
                                <p>El precio del dolar actual es <?= $dollarPrice["dollar_price"] ?> Bs, informacion del <?= $dollarPrice["date"] ?>.</p>
                            </div>
                        </div>
                    </form>
                </template>
            </div>
        </main>
    </section>
    </div>
    <script src="../lib/navigationByTags.js"></script>
</body>

</html>