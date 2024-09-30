<?php
require_once "../helpers/curlData.php";

$page = $_GET["page"] ?? 1;
$data = getCurl("slot=clients&page=$page");
$pagination = $data["length"];
$data = $data["data"];


?>


<?php require "../ui/header.php" ?>
<?php $place = $_GET["place"] ?? "" ?>
<title>Clientes - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
<title>Informes - Inv.Refrihogar</title>
<link rel="stylesheet" href="../../forms.css">
<link rel="stylesheet" href="index.css">
</head>

<body>
    <?php include '../ui/navbar.php' ?>
    <section>
        <?php if (!$place) : ?>
            <h2>Clientes</h2>
            <p>Echale un vistazo a todos los clientes registrados en tu organizaciòn</p>
            <div class="table-options">
                <form id="form-search" class="form not-ring" style="width:320px;margin:0;">
                    <label style="margin:0;">
                            <span>
                            <i class="ri-search-line"></i>
                            <input type="text" id="search-product" placeholder="Tornillo xs">
                        </span>
                    </label>
                </form>
                <button class="more" data-show="show">
                    <i class="ri-filter-3-fill" data-show="show"></i>
                    <ol>
                        <li id="conversion"><i class="ri-coins-line"></i>Cambiar divisa a <span>$</span></li>
                    </ol>
                </button>
            </div>
            <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <td>Cedula</td>
                                <td>Imagen</td>
                                <td>Nombre y Apellido</td>
                                <td>Empresa</td>
                                <!-- <td>Estado</td> -->
                                <td>Telefono</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($pagination <= 0): ?>
                            <tr class="not-elements" style="--text-alert:'No hay registros aun';">
                            </tr>
                            <?php endif ?>
                            <?php foreach($data as $row): ?>
                                <tr>
                                    <td><?= $row["dni"]  ?></td>
                                    <td id="avatar" class="<?= !empty($row["photo"]) ? "inactive" : "active" ?>" data-avatar="<?= substr($row["name"], 0,1) ?>">
                                        <?php if(!empty($row["image"])): ?>
                                            <img src="../../assets/img/<?= $row["image"] ?>" ></td>
                                            <?php endif ?>
                                            <td><?= $row["name"]. " " .$row["surname"]  ?></td>
                                <td class="<?= empty($row["enterprise_name"]) ? "value-null" : "" ?>"><?= $row["enterprise_name"] ?></td>
                                <!-- <td><span class="badge success">pendiente</span></td> -->
                                <td><?= $row["phone"]  ?></td>
                                <!---<td><?= $row["status"]  ?></td>-->
                                <td data-dni="<?= $row["dni"]  ?>">
                                    <div class="actions">
                                        <button class="btn-square edit">
                                            <i class="ri-edit-line"></i>
                                        </button>
                                        <button class="btn-square delete">
                                            <i class="ri-delete-bin-6-line"></i>
                                        </button>
                                    </div>
                                </td>
                                </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination <?= $pagination > 1 ? '': "hidden" ?>">
                    <button id="movePage">
                        <i class="ri-arrow-left-s-line"></i>
                    </button>
                    <div class="items_pagination">
                        <?php for($i = 1; $i <= $pagination;$i++): ?>
                            <button data-num="<?= $i ?>" class="<?= ($page == $i) ? "active" : "" ?>"><?=$i?></button>
                        <?php endfor ?> 
                    </div>
                    <button id="movePage">
                        <i class="ri-arrow-right-s-line"></i>
                    </button>
                </div>
            <script type="module" src="index.js"></script>
        <?php endif ?>
        <?php if ($place === "register") : ?>
            <main>
                <form action="dashboard" class="form" id="register" style="max-width: 400px;">
                    <h2>Registro de cliente</h2>
                    <p>Guarde un cliente para realizar una venta despues.</p>
                    <input type="hidden">
                    <label>
                        <p id="dni">CI:</p>
                        <span>
                            <i class="ri-profile-line"></i>
                            <input type="number" name="dni" required placeholder="931744101">
                        </span>
                    </label>
                    <label class="show-set-input">
                        <input type="checkbox" id="setShowInput">
                        <p>Es una empresa?</p>
                    </label>
                    <label class="input-enterprise">
                        <p>Nombre empresa:</p>
                        <span>
                            <i class="ri-shield-user-line"></i>
                            <input type="text" name="enterprise-name" placeholder="Vanessa.AC" id="input-enterprise">
                        </span>
                    </label>
                    <label>
                        <p id="name">Nombre:</p>
                        <span>
                            <i class="ri-user-line"></i>
                            <input type="text" name="name" required placeholder="Vanessa Teran">
                        </span>
                    </label>
                    <label>
                        <p id="surname">Apellido:</p>
                        <span>
                            <i class="ri-user-line"></i>
                            <input type="text" name="surname" required placeholder="Vanessa Teran">
                        </span>
                    </label>
                    <div class="line-space"></div>
                    <label>
                        <p>Telefono:</p>
                        <span>
                            <i class="ri-phone-line"></i>
                            <input type="number" name="phone" required placeholder="0424-7714244">
                        </span>
                    </label>
                    <label>
                        <p>Localizacion:</p>
                        <span>
                            <i class="ri-gps-line"></i>
                            <input type="text" name="location" required placeholder="Bisnaca">
                        </span>
                    </label>
                    <label class="showSetFile">
                        <input type="checkbox" id="setFile">
                        <p>Subir imagen</p>
                    </label>
                    <label class="inputFile">
                        <input type="file" name="image" id="inputFile">
                        <div class="presentation">
                            <i class="ri-gallery-line"></i>
                            <p>Arrastre y suelte una imagen en formato png | jpeg | webp</p>
                        </div>
                    </label>
                    <div class="line-space"></div>
                    <div class="container-buttons">
                        <a href="./" class="btn cancel">
                            Cancelar
                        </a>
                        <button class="btn success">
                            Registrar
                            <i class="ri-arrow-drop-right-line"></i>
                        </button>
                    </div>
                </form>
                <div class="listed">
                    <h2>Listado de clientes</h2>
                    <p>Clientes que ya se encuentran en el sistema.</p>
                    <ol>
                        <?php $data = array_slice($data,0,5)?>
                        <?php foreach($data as $row):?>
                        <li>
                            <a href="">
                                <picture id="avatar" data-avatar="<?= substr($row["name"], 0,1) ?>">
                                    <?php if(!empty($row["image"])): ?>
                                    <img src="<?= $row["image"] ?>" >
                                    <?php endif ?>
                                </picture>
                                <div class="details">
                                    <p><?= $row["name"] ." ".$row["surname"]  ?></p>
                                    <p><?= $row["dni"] ?></p>
                                </div>
                                <i class="ri-arrow-right-line"></i>
                            </a>
                        </li>
                        <?php endforeach ?>
                    </ol>
                    <a href="./" class="btn cancel"> Ver mas </a>
                </div>
            </main>
            <script type="module" src="./registClient.js"></script>
        <?php endif ?>
    </section>
</body>