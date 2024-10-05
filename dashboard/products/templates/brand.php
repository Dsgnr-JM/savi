<main>
    <form action="dashboard" class="form" id="register" style="max-width: 400px;">
        <h2>Registro de marcas</h2>
        <p>Guarda una marca de producto para usar despu&eacute;s.</p>
        <label>
            <p>Nombre:</p>
            <span>
                <input type="text" name="brand_name" required placeholder="OSTEL">
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
<script type="module" src="./registBrand.js"></script>