<h2><i class="ri-shopping-basket-line"></i>Ventas</h2>
<p>&Eacute;chale un vistazo a las ventas <?= $isRemoved ? "eliminadas" : "realizadas" ?></p>
<div class="table-options">
    <form autocomplete="off" id="form-search" class="form not-ring" style="width:320px;margin:0;">
        <label style="margin:0;">
            <span>
                <i class="ri-search-line"></i>
                <input type="text" id="search-table" placeholder="000006">
            </span>
        </label>
    </form>
    <?php if (!$isRemoved) : ?>
        <button class="more" data-show="show">
            <i class="ri-more-2-line" data-show="show"></i>
            <ol>
                <li>
                    <i class="ri-filter-3-line"></i>Ordernar por:
                    <ol>
                        <li>Nro de Factura</li>
                        <li>Cliente</li>
                        <li>Estado</li>
                        <li>Fecha</li>
                    </ol>
                </li>
                <li>
                    <i class="ri-file-download-line"></i>Exportar en:
                    <ol>
                        <li><i class="ri-file-excel-2-line"></i>Excel</li>
                        <li><i class="ri-file-pdf-2-line"></i>PDF</li>
                    </ol>
                </li>
                <li>
                    <i class="ri-delete-bin-6-line"></i>Eliminar todas
                </li>
            </ol>
        </button>
    <?php endif ?>
</div>
<div class="table">
    <table>
        <thead>
            <tr>
                <td>Nro de Factura</td>
                <td>Cliente</td>
                <td>Total</td>
                <td>Pago</td>
                <td>Estado</td>
                <td>Fecha</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody data-slot="sale">
            <?php foreach ($data as $row) : ?>
                <tr>
                    <td><?= $row["nro_factura"]  ?></td>
                    <td><?= $row["client"]  ?></td>
                    <td><?= "$ " . number_format($row["total"], 2)  ?></td>
                    <td><?= "$ " . number_format($row["payment"], 2)  ?></td>
                    <td>
                        <span class="badge <?= $row["status"] ?>"><?= nameTranslator($row["status"]) ?></span>
                    </td>
                    <td><?= $row["date"] ?></td>
                    <td data-code="<?= $row["nro_factura"]  ?>">
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
    <h2>Edición de Ventas</h2>
    <p>Edite los datos básicos de la venta seleccionada.</p>
    <form autocomplete="off" class="form">
        <input type="hidden" name="key" value="">
        <label>
            <p>Nro Factura:</p>
            <span>
                <input type="text" name="nro_factura" required placeholder="000001" disabled>
                <i class="ri-barcode-line" id="icon-form"></i>
            </span>
        </label>
        <label>
            <p>Cliente:</p>
            <span>
                <input type="text" name="name" disabled required placeholder="Jhoan Mejia">
                <i class="ri-user-line" id="icon-form"></i>
            </span>
        </label>
        <div class="inputs-container">
            <label>
                <p>Total:</p>
                <span>
                    <input type="text" name="total" disabled required placeholder="Jhoan Mejia">
                    <i class="ri-money-dollar-box-line" id="icon-form"></i>
                </span>
            </label>
            <label>
                <p>Pago:</p>
                <span>
                    <input type="text" name="payment" required placeholder="300">
                    <i class="ri-money-dollar-box-line" id="icon-form"></i>
                </span>
            </label>
        </div>
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
<script type="module" src="./list.js"></script>