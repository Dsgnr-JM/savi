<h2>Proveedores</h2>
<p>&Eacute;chale un vistazo a los proveedores <?= $isRemoved ? "que se encuentran eliminados de": "registrados en" ?> tu organizaci&oacute;n</p>
<div class="table-options">
    <form autocomplete="off" id="form-search" class="form not-ring" style="width:320px;margin:0;">
        <label style="margin:0;">
            <span>
                <i class="ri-search-line"></i>
                <input type="text" id="search-table" placeholder="Tornillo xs">
            </span>
        </label>
    </form>
    <?php if(!$isRemoved): ?>
        <button class="more" data-show="show">
            <i class="ri-filter-3-fill" data-show="show"></i>
            <ol>
                <li id="conversion"><i class="ri-coins-line"></i>Cambiar divisa a <span>$</span></li>
            </ol>
        </button>
    <?php endif ?>
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
        <tbody data-slot="supplier">
            <?php foreach ($data as $row) : ?>
                <tr>
                    <td><?= $row["rif"]  ?></td>
                    <td><?= $row["name"]  ?></td>
                    <td id="avatar" class="<?= !empty($row["image"]) ? "inactive" : "active" ?>" data-avatar="<?= substr($row["name"], 0, 1) ?>">
                        <?php if (!empty($row["image"])) : ?>
                            <img src="<?= $row["image"] ?>">
                    </td>
                <?php endif ?>
                <td><?= $row["phone"]  ?></td>
                <td><?= $row["email"] ?></td>
                <td><?= $row["location"]  ?></td>
                <td data-code="<?= $row["rif"]  ?>">
                    <div class="actions">
                        <?php if($isRemoved) :?>
                            <button aria-label="Recuperar" data-balloon-pos="up" class="recovery">
                                <i class="ri-arrow-turn-forward-line"></i>
                            </button>
                        <?php else:?>
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
    <h2>Edición de Proveedores</h2>
    <p>Edite los datos básicos del proveedor seleccionado.</p>
    <form autocomplete="off" class="form">
        <input type="hidden" name="key" value="">
        <label>
            <p>DNI (Rif/CI):</p>
            <span>
                <input type="text" name="rif" required placeholder="31744101">
                <i class="ri-profile-line" id="icon-form"></i>
            </span>
        </label>
        <div class="inputs-container">
            <label>
                <p>Nombre empresa:</p>
                <span>
                    <input type="text" name="name" required placeholder="BellJs">
                    <i class="ri-shield-user-line" id="icon-form"></i>
                </span>
            </label>
            <label>
                <p>Nombre encargado:</p>
                <span>
                    <input type="text" name="manager" required placeholder="Jota">
                    <i class="ri-user-line" id="icon-form"></i>
                </span>
            </label>
        </div>
        <div class="line-space"></div>
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