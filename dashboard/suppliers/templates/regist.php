<main>
    <form autocomplete="off" action="dashboard" class="form" id="register" style="max-width: 400px;">
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
            <p>Nombre Encargado:</p>
            <span>
                <i class="ri-user-line"></i>
                <input type="text" name="manager" required placeholder="Vanessa Teran">
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
</main>
<script src="./regist.js" type="module"></script>