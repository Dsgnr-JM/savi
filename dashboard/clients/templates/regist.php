<main>
    <form autocomplete="off"action="dashboard" class="form" id="register" style="max-width: 400px;">
        <h2>Registro de cliente</h2>
        <p>Guarde un cliente para realizar una venta despu&eacute;s.</p>
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
            <?php $data = array_slice($data, 0, 5) ?>
            <?php foreach ($data as $row) : ?>
                <li>
                    <a href="">
                        <picture id="avatar" data-avatar="<?= substr($row["name"], 0, 1) ?>">
                            <?php if (!empty($row["image"])) : ?>
                                <img src="<?= $row["image"] ?>">
                            <?php endif ?>
                        </picture>
                        <div class="details">
                            <p><?= $row["name"] . " " . $row["surname"]  ?></p>
                            <p><?= $row["dni"] ?></p>
                        </div>
                        <i class="ri-arrow-right-line"></i>
                    </a>
                </li>
            <?php endforeach ?>
        </ol>
        <a href="./" class="btn cancel"> Ver m&aacute;s </a>
    </div>
</main>
<script type="module" src="./registClient.js"></script>