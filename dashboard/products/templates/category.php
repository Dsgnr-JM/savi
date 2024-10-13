<main>
    <form autocomplete="off"action="dashboard" class="form" id="register" style="max-width: 400px;">
        <h2>Registro de departamentos</h2>
        <p>Guarda departamento de productos, para poder usarlos despu&eacute;s.</p>
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