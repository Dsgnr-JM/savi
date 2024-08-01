<?php
    include_once "SAVI/config.php";
    $URI = $_SERVER["SCRIPT_FILENAME"];
    $URI = explode("dashboard", $URI);
    require_once "$URI[0]config.php";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare("SELECT u.*, r.* FROM tb_users u JOIN role r ON u.role = r.role WHERE ci = :ci");
    $stmt->bindParam(":ci", $_SESSION["session"]["ci"]);
    $stmt->execute();
    $user = $stmt->fetch();
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
                <a href="/SAVI/dashboard/">
                    <div>
                        <i class="ri-home-line"></i>
                        <p>Inicio</p>
                    </div>
                </a>
                <a href="/SAVI/dashboard/profile/">
                    <div>
                        <i class="ri-profile-line"></i>
                        <p>Perfil</p>
                    </div>
                </a>
            </li>
            <li class="items" data-url="analitics">
                <h3>Analitics</h3>
                <?php if($user["manage_stadistics"]): ?>
                <a href="/SAVI/dashboard/stadistics">
                    <div>
                        <i class="ri-pie-chart-line"></i>
                        <p>Estadisticas</p>
                    </div>
                    <i class="ri-arrow-drop-down-line" id="arrowDown"></i>
                </a>
                <ol id="options">
                    <li>
                        <a href="#">Periodicas</a>
                    </li>
                    <li>
                        <a href="#">Productos</a>
                    </li>
                    <li>
                        <a href="#">Clientes y Provedores</a>
                    </li>
                </ol>
            <?php endif ?>
                <a href="/SAVI/dashboard/products">
                    <div>
                        <i class="ri-folder-line"></i>
                        <p>Productos</p>
                    </div>
                    <i class="ri-arrow-drop-down-line" id="arrowDown"></i>
                </a>
                <ol id="options">
                    <li>
                        <a href="/SAVI/dashboard/products?place=product">Registro de producto</a>
                    </li>
                    <li>
                        <a href="/SAVI/dashboard/products?place=model">Registro de modelo</a>
                    </li>
                    <li>
                        <a href="/SAVI/dashboard/products?place=brand">Registro de marca</a>
                    </li>
                    <li>
                        <a href="/SAVI/dashboard/products?place=category">Registro de categoria</a>
                    </li>
                </ol>
                <?php if($user["manage_providers"]): ?>
                <a href="/SAVI/dashboard/suppliers">
                    <div>
                        <i class="ri-caravan-line"></i>
                        <p>Provedores</p>
                    </div>
                    <i class="ri-arrow-drop-down-line" id="arrowDown"></i>
                </a>
                <ol id="options">
                    <li>
                        <a href="/SAVI/dashboard/suppliers?place=register">Registro</a>
                    </li>
                    <li>
                        <a href="#">Consultas</a>
                    </li>
                </ol>
            <?php endif ?>
            </li>
            <li class="items" data-url="sales">
                <h3>Sales</h3>
                <a href="/SAVI/dashboard/sales">
                    <div>
                        <i class="ri-shopping-basket-line"></i>
                        <p>Ventas</p>
                    </div>
                </a>
                <a href="/SAVI/dashboard/clients">
                    <div>
                        <i class="ri-group-2-line"></i>
                        <p>Clientes</p>
                    </div>
                    <i class="ri-arrow-drop-down-line" id="arrowDown"></i>
                </a>
                <ol id="options">
                    <li>
                        <a href="#">Pendientes</a>
                    </li>
                    <li>
                        <a href="#">Activos</a>
                    </li>
                </ol>
                <?php if($user["manage_informs"]): ?>

                <a href="/SAVI/dashboard/informs">
                    <div>
                        <i class="ri-file-text-line"></i>
                        <p>Informes</p>
                    </div>
                    <i class="ri-arrow-drop-down-line" id="arrowDown"></i>
                </a>
                <ol id="options">
                    <li>
                        <a href="#">Periodicas</a>
                    </li>
                    <li>
                        <a href="#">De productos</a>
                    </li>
                    <li>
                        <a href="#">De clientes</a>
                    </li>
                </ol>
            <?php endif ?>
            </li>
        </ol>
        <button class="btn-rounded scroll">
            <i class="ri-arrow-drop-down-line" id="arrowDown"></i>
        </button>
    </div>
    <div class="end-">
        <?php if($user["manage_system"]): ?>
        <a href="/SAVI/dashboard/maintenace" class="config">
            <div>
                <i class="ri-shield-check-line"></i>
                <p>Mantenimiento</p>
            </div>
        </a>
        <a href="/SAVI/dashboard/settings" class="config">
            <div>
                <i class="ri-settings-4-line"></i>
                <p>Configuracion</p>
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
            hola > mundo
        </div>
        <main>
            <button>
                <i class="ri-notification-2-line"></i>
            </button>
            <button>
                <i class="ri-message-line"></i>
            </button>
            <div class="options">
                <img src="/SAVI/assets/_c7f93b51-6c46-4d20-97ef-ba29bdb56088.jpeg" alt="Imagen de perfil">
                <p><?= $_SESSION["session"]["name"] . " " . $_SESSION["session"]["surname"] ?></p>
                <button id="btn-profile">
                    <i class="ri-arrow-drop-down-line" id="arrowDown"></i>
                </button>
                <div class="dropdown_profile">
                    <span>
                        <img src="/SAVI/assets/_c7f93b51-6c46-4d20-97ef-ba29bdb56088.jpeg" alt="">
                    </span>
                    <h3><?= $_SESSION["name"] ?></h3>
                </div>
                <!-- <div>
                <img src="SAVI/assets/_c7f93b51-6c46-4d20-97ef-ba29bdb56088.jpeg" alt="Imagen alt">
                <h3>Kilian Mbappe</h3>
            </div> -->
            </div>
        </main>
    </header>