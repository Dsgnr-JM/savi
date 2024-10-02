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
    <title>Registrese para continuar</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="forms.css">
    <link rel="stylesheet" href="lib/bell.css">
</head>

<body>
    <section>
        <form action="" class="form" id="signup">
            <h2>Registro</h2>
            <p>Tomat&eacute; unos minutos para registrar tu usuario y poder comenzar.</p>
            <div class="inputs-container">
                <label>
                    <p>Nombre:</p>
                    <span>
                        <input type="text" name="name" required data-length="3" placeholder="Maria Gabriela">
                        <i class="ri-user-line" id="icon-form"></i>
                    </span>
                </label>
                <label>
                    <p>Apellido:</p>
                    <span>
                        <input type="text" name="surname" required data-length="3" placeholder="de los Angeles">
                        <i class="ri-user-line" id="icon-form"></i>
                    </span>
                </label>             
            </div>
            <label>
                <p>Tel&eacute;fono:</p>
                <span>
                    <input type="number" name="phone" required data-length="11" placeholder="04247079098">
                    <i class="ri-id-card-line" id="icon-form"></i>
                </span>
            </label>
            <label>
                <p>C&eacute;dula:</p>
                <span>
                    <input type="number" name="ci" required data-length="7" placeholder="317079091">
                    <i class="ri-id-card-line" id="icon-form"></i>
                </span>
            </label>
            <div class="inputs-container">
                <label>
                    <p>Usuario:</p>
                    <span>
                        <input type="text" name="username" required data-length="5" placeholder="maria9b">
                        <i class="ri-file-user-line" id="icon-form"></i>
                    </span>
                </label>
                <label>
                    <p>Contrase&ntilde;a:</p>
                    <span>
                        <input type="password" name="password" required data-length="5" placeholder="******">
                        <i class="ri-lock-line" id="icon-form"></i>
                    </span>
                </label>              
            </div>
            <button class="btn success" id="btn_sucess" disabled>
                Registrar
                <i class="ri-arrow-drop-right-line"></i>
            </button>
            <span>
                o
            </span>
            <a href="login.php">Ya tienes cuenta</a>
        </form>
    </section>
    <main>
        <h1>
            <span style="color:coral;">SAVI</span>: administrar un sistema de <span style="color:mediumseagreen"> inventario </span> nunca fue tan <span style="color:cornflowerblue;">f&aacute;cil</span>
        </h1>
    </main>
    <script type="module" src="./signup.js"></script>
</body>

</html>