<?php

$URI = $_SERVER["SCRIPT_FILENAME"];
$URI = explode("dashboard", $URI);
$configURL = "SAVI/config.php";

if (!file_exists($configURL)) $configURL = "$URI[0]config.php";

require_once $configURL;
$curlURL = "helpers/curlData.php";
if (!file_exists($curlURL)) $curlURL = "../helpers/curlData.php";
require_once $curlURL;
if (file_exists('../helpers/routeShow.php')) {
    include_once '../helpers/routeShow.php';
} else {
    include_once './helpers/routeShow.php';
}
$user = getCurl('slot=user&search=' . $_SESSION["session"])[0];

$image = $user["photo"];
if (!file_exists($image)) $image = str_replace("../", "", $image);
?>



<nav class="primary_navbar">
    <div class="header">
        <section>
            <span style="display:block;height: 20px; width: 20px;"></span>
            <h2 class="nav_title" alt="Inv.RefriHogar">Inv.RefriHogar</h2>
            <button class="menu">
                <i class="ri-menu-line"></i>
            </button>
        </section>
        <ol class="nav_items" id="nav_items">
            <li class="items">
                <h3>Home</h3>
                <a href="/SAVI/dashboard/" data-url="">
                    <div>
                        <i class="ri-home-line"></i>
                        <p>Inicio</p>
                    </div>
                </a>
                <a href="/SAVI/dashboard/profile/" data-url="profile">
                    <div>
                        <i class="ri-user-line"></i>
                        <p>Perfil</p>
                    </div>
                </a>
            </li>
            <li class="items">
                <h3>Analitics</h3>
                <a href="/SAVI/dashboard/products" data-url="products">
                    <div>
                        <i class="ri-folder-5-line"></i>
                        <p>Inventario</p>
                    </div>
                    <i class="ri-arrow-drop-down-line" id="arrowDown"></i>
                </a>
                <ol id="options">
                    <li>
                        <a href="/SAVI/dashboard/products?place=product&action=regist">Registro de productos</a>
                    </li>
                    <li>
                        <a href="/SAVI/dashboard/products?place=category&action=regist">Registro de departamentos</a>
                    </li>
                    <li>
                        <a href="/SAVI/dashboard/products?place=product&action=purchase">Compras de stock</a>
                    </li>
                    <li>
                        <a href="/SAVI/dashboard/products?isRemoved">Eliminados</a>
                    </li>
                </ol>
                <?php if ($user["manage_providers"]) : ?>
                    <a href="/SAVI/dashboard/suppliers" data-url="suppliers">
                        <div>
                            <i class="ri-caravan-line"></i>
                            <p>Proveedores</p>
                        </div>
                        <i class="ri-arrow-drop-down-line" id="arrowDown"></i>
                    </a>
                    <ol id="options">
                        <li>
                            <a href="/SAVI/dashboard/suppliers?place=register">Registro</a>
                        </li>
                        <li>
                            <a href="/SAVI/dashboard/suppliers?isRemoved">Eliminados</a>
                        </li>
                    </ol>
                <?php endif ?>
                <?php if ($user["manage_informs"]) : ?>

                    <a href="/SAVI/dashboard/informs" data-url="informs">
                        <div>
                            <i class="ri-file-text-line"></i>
                            <p>Informes</p>
                        </div>
                    </a>
                <?php endif ?>
            </li>
            <li class="items" data-url="sales">
                <h3>Sales</h3>
                <a href="/SAVI/dashboard/sales" data-url="sales">
                    <div>
                        <i class="ri-shopping-basket-line"></i>
                        <p>Ventas</p>
                    </div>
                    <i class="ri-arrow-drop-down-line" id="arrowDown"></i>
                </a>
                <ol id="options">
                    <li>
                        <a href="/SAVI/dashboard/sales?place=list">Listado de ventas</a>
                    </li>
                    <li>
                        <a href="/SAVI/dashboard/sales?place=list&isRemoved">Eliminadas</a>
                    </li>
                </ol>
                <a href="/SAVI/dashboard/clients" data-url="clients">
                    <div>
                        <i class="ri-group-2-line"></i>
                        <p>Clientes</p>
                    </div>
                    <i class="ri-arrow-drop-down-line" id="arrowDown"></i>
                </a>
                <ol id="options">
                    <li>
                        <a href="/SAVI/dashboard/clients?place=register">Registro</a>
                    </li>
                    <li>
                        <a href="/SAVI/dashboard/clients?isRemoved">Eliminados</a>
                    </li>
                </ol>
            </li>
        </ol>
        <button class="btn-rounded scroll">
            <i class="ri-arrow-drop-down-line" id="arrowDown"></i>
        </button>
    </div>
    <div class="end-">
        <?php if ($user["manage_system"]) : ?>
            <a href="/SAVI/dashboard/maintenace" class="config" data-url="maintenace">
                <div>
                    <i class="ri-shield-check-line"></i>
                    <p>Mantenimiento</p>
                </div>
            </a>
            <a href="/SAVI/dashboard/settings" class="config" data-url="settings">
                <div>
                    <i class="ri-settings-4-line"></i>
                    <p>Configuraci&oacute;n</p>
                </div>
            </a>
        <?php endif ?>
        <a href="/SAVI/dashboard/logout.php" class="config">
            <div>
                <i class="ri-logout-circle-line"></i>
                <p>Salir</p>
            </div>
        </a>
        <div>
</nav>
<div class="root">
    <header class="first-header">
        <div class="location">
            <?= getRoute() ?>
        </div>
        <main>
            <div class="options">
                <img src="<?= $image ?>" alt="Imagen de perfil">
                <p><?= $user["name"] . " " . $user["surname"] ?></p>
                <button id="btn-profile">
                    <i class="ri-arrow-drop-down-line" id="arrowDown"></i>
                </button>
                <div class="dropdown_profile">
                    <span>
                        <img src="/SAVI/assets/_c7f93b51-6c46-4d20-97ef-ba29bdb56088.jpeg" alt="">
                    </span>
                    <h3><?= $user["name"] ?></h3>
                </div>
                <!-- <div>
                <img src="SAVI/assets/_c7f93b51-6c46-4d20-97ef-ba29bdb56088.jpeg" alt="Imagen alt">
                <h3>Kilian Mbappe</h3>
            </div> -->
            </div>
        </main>
    </header>