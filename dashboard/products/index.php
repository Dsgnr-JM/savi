<?php
require_once "../helpers/curlData.php";

$page = $_GET["page"] ?? 1;
$data = getCurl("slot=products");
$pagination = $data["length"];
$data = $data["data"];

$brands = getCurl("slot=brands");
$models = getCurl("slot=models");

$suppliers = getCurl("slot=suppliers")["data"];
$categorys = getCurl("slot=categorys");

?>

<?php require "../ui/header.php" ?>
<?php $place = $_GET["place"] ?? "" ?>
<title>Productos - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="../../forms.css">


<?php
$optionsTitle = array(
    "product" => "Registro de productos",
    "brand" => "Registro de marcas.",
    "category" => "Registro de categorias.",
    "model" => "Registro de modelos."
)
?>
</head>

<body>
    <?php include '../ui/navbar.php' ?>
    <section>
        <?php if (!$place) : ?>
                <h2><i class="ri-folder-5-line"></i>Productos</h2>
                <p>Echale un vistazo al inventario de productos registrados en tu organizaciòn</p>
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
                                <td>Codigo</td>
                                <td>Nombre</td>
                                <td>Imagen</td>
                                <!-- <td>Precio Venta</td> -->
                                <td>Departamento</td>
                                <td>Precio Compra</td>
                                <td>Stock</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $row) : ?>
                                <tr>
                                    <td><?= $row["code"]  ?></td>
                                    <td><?= $row["name"]  ?></td>
                                    <td id="avatar" class="<?= !empty($row["photo"]) ? "inactive" : "active" ?>" data-avatar="<?= substr($row["name"], 0, 1) ?>">
                                        <?php if (!empty($row["photo"])) : ?>
                                            <img src="<?= $row["photo"] ?>">
                                        </td>
                                        <?php endif ?>
                                        <td><?= $row["category"]  ?></td>
                                <td><?= "$ " . $row["selling_price"]  ?></td>
                                <td><?= $row["stock"]  ?></td>
                                <td data-code="<?= $row["code"]  ?>">
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
                <div class="pagination <?= $pagination > 1 ? '' : "hidden" ?>">
                    <button id="movePage">
                        <i class="ri-arrow-left-s-line"></i>
                    </button>
                    <div class="items_pagination">
                        <?php for ($i = 1; $i <= $pagination; $i++) : ?>
                            <button data-num="<?= $i ?>" class="<?= ($page == $i) ? "active" : "" ?>"><?= $i ?></button>
                        <?php endfor ?>
                    </div>
                    <button id="movePage">
                        <i class="ri-arrow-right-s-line"></i>
                    </button>
                </div>
            <script type="module" src="index.js"></script>
        <?php endif ?>
        <?php if ($place === "product") : ?>
            <main>
                <form action="dashboard" class="form" id="register" style="width: 450px;">
                    <h2>Registro de productos</h2>
                    <p>Almacena productos de manera rapida y eficaz.</p>
                    <label>
                        <p>Codigo:</p>
                        <span>
                            <input type="text" name="code" required placeholder="ELE4521">
                            <i class="ri-barcode-line" id="icon-form"></i>
                        </span>
                    </label>
                    <label>
                        <p>Nombre:</p>
                        <span>
                            <input type="text" name="name" required placeholder="Tuerca xm">
                            <i class="ri-profile-line" id="icon-form"></i>
                        </span>
                    </label>
                    <div class="line-space"></div>
                    <div class="inputs-container">
                        <label>
                            <p>Departamento:</p>
                            <select name="category">
                                <?php foreach ($categorys as $result) : ?>
                                    <option value="<?= $result['category_id'] ?>"><?= $result['category_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </label>
                        <label>
                            <p>Modelo:</p>
                            <select name="models">

                                <?php foreach ($models as $result) : ?>
                                    <option value="<?= $result['model_id'] ?>"><?= $result['model_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </label>
                        <label>
                            <p>Marca:</p>
                            <span>
                                <select name="brand">

                                    <?php foreach ($brands as $result) : ?>
                                        <option value="<?= $result['id_brand'] ?>"><?= $result['brad_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </span>
                        </label>

                    </div>
                    <label>
                        <p>Proveedor:</p>
                        <span>
                            <select name="supplier">

                                <?php foreach ($suppliers as $result) : ?>
                                    <option value="<?= $result['rif'] ?>"><?= $result['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </span>
                    </label>
                    <div class="line-space"></div>
                    <div class="inputs-container">
                        <label>
                            <p>Stock:</p>
                            <span>
                                <input type="number" name="stock" required placeholder="0">
                                <i class="ri-shopping-basket-line" id="icon-form"></i>
                            </span>
                        </label>
                        <label>
                            <p>Stock minimo:</p>
                            <span>
                                <input type="number" name="stock_min" required placeholder="0">
                                <i class="ri-shopping-basket-line" id="icon-form"></i>
                            </span>
                        </label>
                        <label>
                            <p>Stock maximo:</p>
                            <span>
                                <input type="number" name="stock_max" required placeholder="0">
                                <i class="ri-shopping-basket-line" id="icon-form"></i>
                            </span>
                        </label>
                    </div>
                    <div class="inputs-container">
                        <label>
                            <p>Precio salida:</p>
                            <span>
                                <input type="number" name="selling_price" step="any" required placeholder="120">
                                <i class="ri-price-tag-line" id="icon-form"></i>
                            </span>
                        </label>
                        <label>
                            <p>Precio entrada:</p>
                            <span>
                                <i class="ri-price-tag-line"></i>
                                <input type="number" name="purchase_price" step="any" required placeholder="120">
                            </span>
                        </label>
                    </div>
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
                    <h2>Listado de productos</h2>
                    <p>Productos que se encuentran en el sistema.</p>
                    <ol>
                        <?php $data = array_slice($data, 0, 5) ?>
                        <?php foreach ($data as $row) : ?>
                            <li>
                                <a href="">
                                    <picture id="<?= empty($row['photo']) ? 'avatar' : '' ?>" data-avatar="<?= substr($row["name"], 0, 1) ?>">
                                        <?php if (!empty($row["photo"])) : ?>
                                            <img src="<?= $row["photo"] ?>">
                                        <?php endif ?>
                                    </picture>
                                    </picture>
                                    <div class="details">
                                        <p><?= $row["name"] ?></p>
                                        <p><?= $row["code"] ?></p>
                                    </div>
                                    <i class="ri-arrow-right-line"></i>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ol>
                    <a href="./" class="btn cancel"> Ver mas </a>
                </div>
            </main>
            <script type="module" src="./registProduct.js"></script>
        <?php endif ?>
        <?php if ($place === "brand") : ?>
            <main>
                <form action="dashboard" class="form" id="register" style="max-width: 400px;">
                    <h2>Registro de marcas</h2>
                    <p>Guarda una marca de producto para usar despues.</p>
                    <label>
                        <p>Nombre:</p>
                        <span>
                            <input type="text" name="brand_name" required placeholder="OSTEL">
                            <i class="ri-profile-line" id="icon-form"></i>
                        </span>
                    </label>
                    <div class="container-buttons">
                        <a href="./" class="btn cancel">
                            Cancelar
                        </a>
                        <button class="btn success">
                            Registrar
                            <i class="ri-arrow-drop-right-line"></i>
                        </button>
                    </div>
                    </div>
                </form>
            </main>
            <script type="module" src="./registBrand.js"></script>
        <?php endif ?>
        <?php if ($place === "model") : ?>
            <main>
                <form action="dashboard" class="form" id="register" style="max-width: 400px;">
                    <h2>Registro de modelos</h2>
                    <p>Guarda un modelo de un producto para usar despues.</p>
                    <label>
                        <p>Nombre:</p>
                        <span>
                            <input type="text" name="model_name" required placeholder="X11201">
                            <i class="ri-profile-line" id="icon-form"></i>
                        </span>
                    </label>
                    <div class="container-buttons">
                        <a href="./" class="btn cancel">
                            Cancelar
                        </a>
                        <button class="btn success">
                            Registrar
                            <i class="ri-arrow-drop-right-line" id="icon-form"></i>
                        </button>
                    </div>
                </form>
            </main>
            <script type="module" src="./registModel.js"></script>
        <?php endif ?>
        <?php if ($place === "category") : ?>
            <main>
                <form action="dashboard" class="form" id="register" style="max-width: 400px;">
                    <h2>Registro de categorias</h2>
                    <p>Guarda una categoria para un producto y asi poder usar despues.</p>
                    <label>
                        <p>Nombre:</p>
                        <span>
                            <input type="text" name="category_name" required placeholder="Electrodomesticos">
                            <i class="ri-profile-line" id="icon-form"></i>
                        </span>
                    </label>
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
            </main>
            <script type="module" src="./registCategory.js"></script>
        <?php endif ?>
    </section>
</body>

</html>