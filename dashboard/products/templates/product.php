<main>
    <form autocomplete="off"action="dashboard" class="form" id="register" style="width: 450px;">
        <h2>Registro de productos</h2>
        <p>Almacena productos de manera r&aacute;pida y eficaz.</p>
        <label>
            <p>C&oacute;digo:</p>
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
        <div class="inputs-container">
            <label>
                <p>Departamento:</p>
                <select name="category">
                    <?php foreach ($categorys as $result) : ?>
                        <option value="<?= $result['id'] ?>"><?= $result['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </label>
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
        </div>
        <div class="line-space"></div>
        <div class="inputs-container">
            <label>
                <p>Stock m&iacute;nimo:</p>
                <span>
                    <input type="number" name="stock_min" required placeholder="0">
                    <i class="ri-shopping-basket-line" id="icon-form"></i>
                </span>
            </label>
            <label>
                <p>Stock m&aacute;ximo:</p>
                <span>
                    <input type="number" name="stock_max" required placeholder="0">
                    <i class="ri-shopping-basket-line" id="icon-form"></i>
                </span>
            </label>
        </div>
        <div class="inputs-container">
            <label>
                <p>Precio Venta:</p>
                <span>
                    <input type="number" name="selling_price" step="any" required placeholder="120">
                    <i class="ri-price-tag-line" id="icon-form"></i>
                </span>
            </label>
            <label>
                <p>Precio Compra:</p>
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