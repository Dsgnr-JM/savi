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
<title>Configuracion - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="../../forms.css">
<link rel="stylesheet" href="../../lib/dialog.css">
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
            <h2>Configuracion y logs</h2>
            <p>Administra los permisos y funcionalidad del sistema. Lleva un seguimiento a los logs.</p>
            <div class="navigation">
                <button class="active" data-slot-pointed="permissions" data-need-dependencies="true" data-dependecies-transitive="checkInputFile">Directivas</button>
                <button data-slot-pointed="logs">Logs</button>
            </div>
            <div class="content" id="contentContainer">
                
            </div>
            <template id="permissions">
                <div class="permissions">
                    <form class="form not-ring">
                        <div>
                            <h3>Permisos</h3>
                            <p>Directivas que seguira el sistema dependiendo del rol del usuario.</p>
                            <label>
                                <p>Rol:</p>
                                <select name="rol">
                                    <option value="seller">Vendedor</option>
                                    <option value="assistant">Asistente</option>
                                    <option value="administrator">Administrador</option>
                                </select>
                            </label>
                            <main class="sale-message">
                                <i class="ri-information-fill"></i>
                                <article class="description">
                                    <p>Los permisos del administrador no se pueden cambiar por temas de seguridad y para mantener la integridad del sistema.</p>
                                    <p>Tenga en cuenta que los usuarios seran afectados directamente.</p>
                                </article>
                            </main>
                        </div>
                        <div>
                            <label class="checkbox">
                                <input type="checkbox" name="manage_stadistics">
                                <p>Visualizar estadisticas</p>
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="manage_products">
                                <p>Gestionar productos</p>
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="manage_providers">
                                <p>Gestionar Provedores</p>
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="manage_sales">
                                <p>Realizar ventas</p>
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="manage_expenses">
                                <p>Gestionar gastos</p>
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="manage_clients">
                                <p>Gestionar clientes</p>
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="manage_informs">
                                <p>Visualizar y generar informes</p>
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" name="manage_config">
                                <p>Cambiar roles y visualizar logs</p>
                            </label>
                            <div class="container-buttons">
                                <button class="btn cancel" type="button">
                                    Cancelar
                                </button>
                                <button class="btn success" type="submit">
                                    Cambiar permissos
                                    <i style="font-weight:100" class="ri-lock-line"></i>
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </template>
            <template id="logs">
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
        </div>
        </main>
    </section>
    </div>
    <script src="../lib/navigationByTags.js"></script>
</body>
</html>