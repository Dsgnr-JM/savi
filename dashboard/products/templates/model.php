<main>
    <form action="dashboard" class="form" id="register" style="max-width: 400px;">
        <h2>Registro de modelos</h2>
        <p>Guarda un modelo de un producto para usar despu&eacute;s.</p>
        <label>
            <p>Nombre:</p>
            <span>
                <input type="text" name="model_name" required placeholder="X11201">
                <i class="ri-profile-line" id="icon-form"></i>
            </span>
        </label>
        <div class="container-buttons">
            <a href="./" class="btn cancel">
                Cancelar
            </a>
            <button class="btn success">
                Registrar
                <i class="ri-arrow-drop-right-line" id="icon-form"></i>
            </button>
        </div>
    </form>
</main>
<script type="module" src="./registModel.js"></script>