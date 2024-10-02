<?php
require_once "../helpers/curlData.php";

$page = $_GET["page"] ?? 1;
$data = getCurl("slot=suppliers");
$pagination = $data["length"];
$data = $data["data"];
?>
<?php require "../ui/header.php" ?>
<?php $place = $_GET["place"] ?? "" ?>
<title>Proveedores - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="../../forms.css">

<?php 
    $optionsTitle = array(
        "register" => "Registro",
        "consult" => "Consulta"
    )
 ?>
</head>

<body>
    <?php include '../ui/navbar.php' ?>
    <section>
        <?php if (!$place) : ?>
        <h2>Proveedores</h2>
        <p>&Eacute;chale un vistazo a los proveedores de productos registrados en tu organizaci&oacute;n</p>
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
                        <td>Rif</td>
                        <td>Empresa</td>
                        <td>Imagen</td>
                        <td>Tel&eacute;fono</td>
                        <td>Email</td>
                        <td>Localizaci&oacute;n</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($data as $row): ?>
                            <tr>
                                <td><?= $row["rif"]  ?></td>
                                <td><?= $row["name"]  ?></td>
                                <td id="avatar" class="<?= !empty($row["image"]) ? "inactive" : "active" ?>" data-avatar="<?= substr($row["name"], 0,1) ?>">
                                    <?php if(!empty($row["image"])): ?>
                                        <img src="<?= $row["image"] ?>" ></td>
                                    <?php endif ?>
                                <td><?= $row["phone"]  ?></td>
                                <td><?= $row["email"] ?></td>
                                <td><?= $row["location"]  ?></td>
                                <td data-code="<?= $row["rif"]  ?>">
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
            </div>
        <script type="module" src="index.js"></script>
        <?php endif ?>
        <?php if ($place === "register") : ?>
            <main>
                <form action="dashboard" class="form" id="register" style="max-width: 400px;">
                    <h2>Registro de proveedores</h2>
                    <p>Guarde un proveedor de productos para usar despu&eacute;s.</p>
                    <input type="hidden">
                    <label>
                        <p>DNI (Rif/CI):</p>
                        <span>
                            <i class="ri-profile-line"></i>
                            <input type="number" name="rif" required placeholder="931744101">
                        </span>
                    </label>
                    <label>
                        <p>Nombre empresa:</p>
                        <span>
                            <i class="ri-shield-user-line"></i>
                            <input type="text" name="name" required placeholder="Vanessa.AC">
                        </span>
                    </label>
                    <label>
                        <p>Nombre encargado:</p>
                        <span>
                            <i class="ri-user-line"></i>
                            <input type="text" name="name" required placeholder="Vanessa Teran">
                        </span>
                    </label>
                    <label>
                        <p>Tel&eacute;fono:</p>
                        <span>
                            <i class="ri-phone-line"></i>
                            <input type="number" name="phone" required placeholder="0424-7714244">
                        </span>
                    </label>
                    <label>
                        <p>Email:</p>
                        <span>
                            <i class="ri-mail-line"></i>
                            <input type="email" name="email" required placeholder="vanis@gmail.com">
                        </span>
                    </label>
                    <label>
                        <p>Localizaci&oacute;n:</p>
                        <span>
                            <i class="ri-gps-line"></i>
                            <input type="text" name="location" required placeholder="Bisnaca">
                        </span>
                    </label>
                    <label class="showSetFile">
                        <input type="radio" id="setFile">
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
                        <a href="./"class="btn cancel">
                            Cancelar
                        </a> 
                        <button class="btn success">
                            Registrar
                            <i class="ri-arrow-drop-right-line"></i>
                        </button>                      
                    </div>
                </form>
            </main>
            <script src="../../lib/showFileInput.js"></script>
            <script src="./script.js" type="module"></script>
        <?php endif ?>
    </section>
</body>