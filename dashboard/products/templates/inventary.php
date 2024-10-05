<h2><i class="ri-folder-5-line"></i>Inventario</h2>
<p>&Eacute;chale un vistazo al inventario de productos registrados en tu organizaci&oacute;n</p>
<div class="table-options">
    <form id="form-search" class="form not-ring" style="width:320px;margin:0;">
        <label style="margin:0;">
            <span>
                <i class="ri-search-line"></i>
                <input type="text" id="search-table" placeholder="Tornillo xs">
            </span>
        </label>
    </form>
    <button class="more" data-show="show">
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
            <li>
                <i class="ri-coins-line"></i>Cambiar divisa a Bs
            </li>
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
</div>
<div class="table">
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