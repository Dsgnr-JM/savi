<h2 class="toLeft"><i class="ri-folder-5-line"></i>Inventario</h2>
<p class="toLeft">&Eacute;chale un vistazo a los productos <?= $isRemoved ? "eliminados de": "registrados en" ?> tu organizaci&oacute;n</p>
<div class="table-options">
    <form autocomplete="off" id="form-search" class="form not-ring toDown" style="width:320px;margin:0;">
        <label style="margin:0;">
            <span>
                <i class="ri-search-line"></i>
                <input type="text" id="search-table" placeholder="Tornillo xs">
            </span>
        </label>
    </form>
    <?php if(!$isRemoved): ?>
    <button class="more toDown" data-show="show">
        <i class="ri-more-2-line" data-show="show"></i>
        <ol>
            <li>
                <i class="ri-filter-3-line"></i>Ordernar por:
                <ol>
                    <li>Codigo</li>
                    <li>Nombre</li>
                    <li>Departamento</li>
                </ol>
            </li>
            <!-- <li>
                <i class="ri-coins-line"></i>Cambiar divisa a Bs
            </li> -->
            <li>
                <i class="ri-file-download-line"></i>Exportar en:
                <ol>
                    <li><i class="ri-file-excel-2-line"></i>Excel</li>
                    <li><i class="ri-file-pdf-2-line"></i>PDF</li>
                </ol>
            </li>
            <li>
                <i class="ri-file-add-line"></i>Importar por:
                <ol>
                    <li><i class="ri-file-excel-2-line"></i>Excel</li>
                    <li><i class="ri-file-2-line"></i>CSV</li>
                </ol>
            </li>
            <li>
                <i class="ri-delete-bin-6-line"></i>Eliminar todos
            </li>
        </ol>
    </button>
    <?php endif ?>
</div>
<div class="table toDown">
    <table>
        <thead>
            <tr>
                <td>C&oacute;digo</td>
                <td>Nombre</td>
                <td>Imagen</td>
                <!-- <td>Precio Venta</td> -->
                <td>Departamento</td>
                <td>Precio Venta</td>
                <td>Stock</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody data-slot="product">
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
                        <?php if ($isRemoved) : ?>
                            <button aria-label="Recuperar" data-balloon-pos="up" class="recovery">
                                <i class="ri-arrow-turn-forward-line"></i>
                            </button>
                        <?php else : ?>
                            <button aria-label="Ver" data-balloon-pos="up" class="subtract">
                                <i class="ri-eye-line"></i>
                            </button>
                            <button class="edit" aria-label="Editar" data-balloon-pos="up">
                                <i class="ri-edit-line"></i>
                            </button>
                            <button class="delete" aria-label="Borrar" data-balloon-pos="up">
                                <i class="ri-delete-bin-6-line"></i>
                            </button>
                        <?php endif ?>
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
<div class="bg_dialog"></div>
<main class="dialog" id="edit">
    <h2>Edición del Producto</h2>
    <p>Edite los datos básicos del producto seleccionado.</p>
    <form autocomplete="off" class="form">
        <input type="hidden" name="key" value="">
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
            <input type="file" name="photo" id="inputFile">
            <div class="presentation">
                <i class="ri-gallery-line"></i>
                <p>Arrastre y suelte una imagen en formato png | jpeg | webp</p>
            </div>
        </label>
        <div class="line-space"></div>
        <div class="container-buttons">
            <button class="btn cancel" type="button">
                Cancelar
            </button>
            <button class="btn success">
                Actualizar
                <i class="ri-arrow-drop-right-line"></i>
            </button>
        </div>
    </form>
</main>
<script type="module" src="index.js"></script>