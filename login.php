<?php
session_start();
if (isset($_SESSION["session"])) {
    header("Location: dashboard");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicie sesi&oacute;n para continuar</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="forms.css">
    <link rel="stylesheet" href="lib/bell.css">
</head>

<body>
    <main>
        <h1>
            La <span style="color:coral">gesti&oacute;n</span> de inventario y POS es un <span style="color:mediumseagreen">proceso</span> tedioso haslo f&aacute;cil con <span style="color:cornflowerblue">SAVI</span>
        </h1>
    </main>
    <section>
        <form autocomplete="off"action="dashboard" class="form" id="login">
            <h2>Inicio de Sesi&oacute;n</h2>
            <p>Tus datos de inicio de sesi&oacute;n son totalmente privados.</p>
            <label>
                <p>Usuario:</p>
                <span>
                    <input type="text" name="username" required placeholder="maria9b" data-length="5">
                    <i class="ri-profile-line" id="icon-form"></i>
                </span>
            </label>
            <label>
                <p>Contrase&ntilde;a:</p>
                <span>
                    <input type="password" name="password" required placeholder="******"data-length="8">
                    <i class="ri-lock-line" id="icon-form"></i>
                </span>
            </label>
            <label class="terms">
                <input type="checkbox" name="terms" required>
                <p>Mantener sesi&oacute;n iniciada</p>
            </label>
            <button class="btn success" disabled>
                Entrar
                <i class="ri-arrow-drop-right-line"></i>
            </button>
            <span>
                o
            </span>
            <a href="index.php">¿No tienes cuenta?</a>
        </form>
    </section>
    <script src="./lib/passwordHidden.js"></script>
    <script type="module" src="./login.js"></script>
</body>

</html>