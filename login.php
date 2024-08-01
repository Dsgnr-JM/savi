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
    <title>Inicie sesion para continuar</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="forms.css">
    <link rel="stylesheet" href="lib/bell.css">
</head>

<body>
    <main>
        <h1>
            La <span style="color:coral">gestion</span> de inventario y POS es un <span style="color:mediumseagreen">proceso</span> tedioso haslo facil con <span style="color:cornflowerblue">SAVI</span>
        </h1>
    </main>
    <section>
        <form action="dashboard" class="form" id="login">
            <h2>Inicio de Sesion</h2>
            <p>Tus datos de inicio de sesion son totalmente privados.</p>
            <label>
                <p>Usuario:</p>
                <span>
                    <input type="text" name="username" required placeholder="maria9b" data-length="5">
                    <i class="ri-profile-line" id="icon-form"></i>
                </span>
            </label>
            <label>
                <p>Contraseña:</p>
                <span>
                    <input type="password" name="password" required placeholder="******"data-length="8">
                    <i class="ri-lock-line" id="icon-form"></i>
                </span>
            </label>
            <label class="terms">
                <input type="checkbox" name="terms" required>
                <p>Mantener sesion iniciada</p>
            </label>
            <button class="btn success" disabled>
                Entrar
                <i class="ri-arrow-drop-right-line"></i>
            </button>
            <span>
                o
            </span>
            <a href="index.php">No tienes cuenta</a>
        </form>
    </section>
    <script src="./lib/passwordHidden.js"></script>
    <script type="module" src="./login.js"></script>
</body>

</html>