<h2>Clientes</h2>
<p>&Eacute;chale un vistazo a todos los clientes registrados en tu organizaci&oacute;n</p>
<div class="table-options">
    <form autocomplete="off"id="form-search" class="form not-ring" style="width:320px;margin:0;">
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
                    <li>Cédula</li>
                    <li>Nombre y Apellido</li>
                    <li>Tipo</li>
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
                <td>C&eacute;dula</td>
                <td>Imagen</td>
                <td>Nombre y Apellido</td>
                <td>Empresa</td>
                <!-- <td>Estado</td> -->
                <td>Tel&eacute;fono</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody data-slot="client">
            <?php if ($pagination <= 0) : ?>
                <tr class="not-elements" style="--text-alert:'No hay registros aun';">
                </tr>
            <?php endif ?>
            <?php foreach ($data as $row) : ?>
                <tr>
                    <td><?= $row["dni"]  ?></td>
                    <td id="avatar" class="<?= !empty($row["image"]) ? "inactive" : "active" ?>" data-avatar="<?= substr($row["name"], 0, 1) ?>">
                        <?php if (!empty($row["image"])) : ?>
                            <img src="<?= $row["image"] ?>">
                    </td>
                <?php endif ?>
                <td><?= $row["name"] . " " . $row["surname"]  ?></td>
                <td class="<?= empty($row["enterprise_name"]) ? "value-null" : "" ?>"><?= $row["enterprise_name"] ?></td>
                <!-- <td><span class="badge success">pendiente</span></td> -->
                <td><?= $row["phone"]  ?></td>
                <!---<td><?= $row["status"]  ?></td>-->
                <td data-dni="<?= $row["dni"]  ?>">
                    <div class="actions">
                        <button aria-label="Ver" data-balloon-pos="up" class="subtract">
                            <i class="ri-eye-line"></i>
                        </button>
                        <button class="edit" aria-label="Editar" data-balloon-pos="up">
                            <i class="ri-edit-line"></i>
                        </button>
                        <button class="delete" aria-label="Borrar" data-balloon-pos="up">
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
<div class="bg_dialog"></div>
<main class="dialog" id="edit">
    <h2>Edición de Clientes</h2>
    <p>Edite los datos básicos del cliente que haya seleccionado.</p>
    <form autocomplete="off" class="form">
        <input type="hidden" name="key" value="">
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
                <input type="text" name="enterprise_name" placeholder="Vanessa.AC" id="input-enterprise">
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
            <p>Tel&eacute;fono:</p>
            <span>
                <i class="ri-phone-line"></i>
                <input type="number" name="phone" required placeholder="0424-7714244">
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