<?php
require_once "../helpers/curlData.php";

$data = getCurl("slot=products");
?>

<?php require "../ui/header.php" ?>
<?php $place = $_GET["place"] ?>
<title>Productos - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
<?php if ($place) :  ?>
    <link rel="stylesheet" href="../../forms.css">
<?php endif ?>

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
            <div class="table">
                <button class="more btn-rounded">
                    <i class="ri-more-2-fill "></i>
                </button>
                <h2>Lista de productos</h2>
                <label class="search">
                    <input type="text" name="" id="" placeholder="Busca tu producto">
                    <button><i class="ri-search-line"></i></button>
                </label>
                <table>
                    <thead>
                        <tr>
                            <td>Codigo</td>
                            <td>Nombre</td>
                            <td>Imagen</td>
                            <td>Precio Venta</td>
                            <td>Precio Compra</td>
                            <td>Stock</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $row): ?>
                            <tr>
                                <td><?= $row["code"]  ?></td>
                                <td><?= $row["name"]  ?></td>
                                <td id="avatar" data-avatar="<?= substr($row["name"], 0,1) ?>">
                                    <?php if(!empty($row["photo"])): ?>
                                        <img src="../../assets/img/<?= $row["photo"] ?>" ></td>
                                    <?php endif ?>
                                <td><?= "$ ".$row["selling_price"]  ?></td>
                                <td><?= "$ ".$row["purchase_price"] ?></td>
                                <td><?= $row["stock"]  ?></td>
                                <td class="actions" data-product-code="<?= $row["code"]  ?>">
                                    <button class="btn-square edit">
                                        <i class="ri-edit-line"></i>
                                    </button>
                                    <button class="btn-square delete">
                                        <i class="ri-delete-bin-6-line"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <button class="btn-rounded">
                        <i class="ri-arrow-left-double-line"></i>
                    </button>
                    <button class="btn-rounded">
                        <i class="ri-arrow-left-s-line"></i>
                    </button>
                    <div>
                        <button class="btn-rounded">
                            <i class="ri-number-1"></i>
                        </button>
                    </div>
                    <button class="btn-rounded">
                        <i class="ri-arrow-right-s-line"></i>
                    </button>
                    <button class="btn-rounded">
                        <i class="ri-arrow-right-double-line"></i>
                    </button>
                </div>
            </div>
            <script src="../lib/createAvatar.js"></script>
            <script src="index.js"></script>
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
                    <label>
                        <p>Descripcion:</p>
                        <span>
                            <input type="text" name="description" required placeholder="Tuerca xm para botones">
                            <i class="ri-file-edit-line" id="icon-form"></i>
                        </span>
                    </label>
                    <div class="line-space"></div>
                    <div class="inputs-container">

                        <label>
                            <p>Departamento:</p>
                            <select name="category">
                                <?php
                                require_once "../../config.php";
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $stmt = $pdo->prepare("SELECT * FROM category");
                                $stmt->execute();
                                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                                <?php foreach ($results as $result) : ?>
                                    <option value="<?= $result['category_id'] ?>"><?= $result['category_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </label>
                        <label>
                            <p>Modelo:</p>
                            <select name="model">
                                <?php
                                require_once "../../config.php";
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $stmt = $pdo->prepare("SELECT * FROM models");
                                $stmt->execute();
                                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                                <?php foreach ($results as $result) : ?>
                                    <option value="<?= $result['model_id'] ?>"><?= $result['model_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </label>
                        <label>
                            <p>Marca:</p>
                            <span>
                                <select name="brad">
                                    <?php
                                    $stmt = $pdo->prepare("SELECT * FROM brad");
                                    $stmt->execute();
                                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    ?>
                                    <?php foreach ($results as $result) : ?>
                                        <option value="<?= $result['brad_id'] ?>"><?= $result['brad_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </span>
                        </label>

                    </div>
                    <label>
                        <p>Proveedor:</p>
                        <span>
                            <input type="text" name="username" required placeholder="Vanessa.CA">
                            <i class="ri-caravan-line" id="icon-form"></i>
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
                                <input type="number" name="price" required placeholder="120">
                                <i class="ri-price-tag-line" id="icon-form"></i>
                            </span>
                        </label>
                        <label>
                            <p>Precio entrada:</p>
                            <span>
                                <i class="ri-price-tag-line"></i>
                                <input type="number" name="price" required placeholder="120">
                            </span>
                        </label>
                    </div>
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
            <script src="../../lib/showFileInput.js"></script>
            <script src="./index.js" type="module"></script>
        <?php endif ?>
        <?php if ($place === "brand") : ?>
            <main>
                <form action="dashboard" class="form" id="register" style="max-width: 400px;">
                    <h2>Registro de marcas</h2>
                    <p>Guarda una marca de producto para usar despues.</p>
                    <label>
                        <p>Nombre:</p>
                        <span>
                            <input type="text" name="name" required placeholder="OSTEL">
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
        <?php endif ?>
        <?php if ($place === "model") : ?>
            <main>
                <form action="dashboard" class="form" id="register" style="max-width: 400px;">
                    <h2>Registro de modelos</h2>
                    <p>Guarda un modelo de un producto para usar despues.</p>
                    <label>
                        <p>Nombre:</p>
                        <span>
                            <input type="text" name="name" required placeholder="X11201">
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
        <?php endif ?>
        <?php if ($place === "category") : ?>
            <main>
                <form action="dashboard" class="form" id="register" style="max-width: 400px;">
                    <h2>Registro de categorias</h2>
                    <p>Guarda una categoria para un producto y asi poder usar despues.</p>
                    <label>
                        <p>Nombre:</p>
                        <span>
                            <input type="text" name="name" required placeholder="Electrodomesticos">
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
        <?php endif ?>
    </section>
</body>

</html>