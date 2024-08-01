<?php require "../ui/header.php" ?>
<?php $place = $_GET["place"] ?>
<title>Productos - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
<?php if ($place) :  ?>
    <link rel="stylesheet" href="../../forms.css">
<?php endif ?>
<title>Informes - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
</head>

<body>
    <?php include '../ui/navbar.php' ?>
    <section>
        <?php if (!$place) : ?>
            <div class="table">
                <h2>Clientes</h2>
                <p>Echale un vistazo a todos los clientes registrados en tu organizaciòn</p>
                <div class="overflow">
                    <table>
                        <thead>
                            <tr>
                                <td>Nombre y Apellido</td>
                                <td>Imagen</td>
                                <td>Cedula</td>
                                <td>Telefono</td>
                                <td>Email</td>
                                <td>Cuentas</td>
                                <td>Localizacion</td>
                                <td>Empresa</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Pausides Yepez</td>
                                <td><img src="/SAVI/assets/_c7f93b51-6c46-4d20-97ef-ba29bdb56088.jpeg" alt="Imagen de perfil">
                                </td>
                                <td>V-28120111</td>
                                <td>04127701211</td>
                                <td>pausides@gmail.com</td>
                                <td><span class="badge warning">pendiente</span></td>
                                <td>Barzalito II</td>
                                <td>Tesla.CA</td>
                            </tr>
                            <tr>
                                <td>Vanesa Teran de Yepez</td>
                                <td><img src="/SAVI/assets/_c7f93b51-6c46-4d20-97ef-ba29bdb56088.jpeg"" alt=" Imagen de perfil">
                                </td>
                                <td>V-28120214</td>
                                <td>04162121211</td>
                                <td>vainilla@gmail.com</td>
                                <td><span class="badge success">activo</span></td>
                                <td>Sochit</td>
                                <td>Club PlayBoy</td>
                            </tr>
                            <tr>
                                <td>Jhoan Mejia</td>
                                <td><img src="/SAVI/assets/_c7f93b51-6c46-4d20-97ef-ba29bdb56088.jpeg"" alt=" Imagen de perfil">
                                </td>
                                <td>V-31744101</td>
                                <td>04247079098</td>
                                <td>mejiajhoan2021@gmail.com</td>
                                <td><span class="badge warning">pendiente</span></td>
                                <td>Bisnaca</td>
                                <td>JothaEngine</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="pagination">
                    <button>
                        <i class="ri-arrow-left-s-line"></i>
                    </button>
                    <div class="items_pagination">
                        <button class="active">
                            1
                        </button>
                        <button>
                            2
                        </button>
                        <button>
                            3
                        </button>
                        <button>
                            4
                        </button>
                        <button>
                            ...
                        </button>
                        <button>
                            5
                        </button>
                        <button>
                            6
                        </button>
                    </div>
                    <button>
                        <i class="ri-arrow-right-s-line"></i>
                    </button>
                </div>
            </div>
        <?php endif ?>
        <?php if ($place === "register") : ?>
            <main>
                <form action="dashboard" class="form" id="register" style="max-width: 400px;">
                    <h2>Registro de cliente</h2>
                    <p>Guarde un cliente para realizar una venta despues.</p>
                    <input type="hidden">
                    <label>
                        <p id="dni">CI:</p>
                        <span>
                            <i class="ri-profile-line"></i>
                            <input type="number" name="rif" required placeholder="931744101">
                        </span>
                    </label>
                    <label class="show-set-input">
                        <input type="radio" id="setShowInput">
                        <p>Es una empresa?</p>
                    </label>
                    <label class="input-enterprise">
                        <p>Nombre empresa:</p>
                        <span>
                            <i class="ri-shield-user-line"></i>
                            <input type="text" name="enterprise-name" required placeholder="Vanessa.AC" id="input-enterprise">
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
                        <p>Telefono:</p>
                        <span>
                            <i class="ri-phone-line"></i>
                            <input type="number" name="phone" required placeholder="0424-7714244">
                        </span>
                    </label>
                    <label>
                        <p>Localizacion:</p>
                        <span>
                            <i class="ri-gps-line"></i>
                            <input type="text" name="location" required placeholder="Bisnaca">
                        </span>
                    </label>
                    <label class="showSetFile">
                        <input type="radio" id="setFile">
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
                    <ol>
                        <li>
                            <a href="">
                                <img src="../IMG-20240306-WA0032~2.jpg">
                                <div class="details">
                                    <p>Tecno X</p>
                                    <p>Vanessa Teran</p>
                                </div>
                                <i class="ri-arrow-right-line"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="../IMG-20240306-WA0032~2.jpg">
                                <div class="details">
                                    <p>Amazon</p>
                                    <p>Pausides Yepez</p>
                                </div>
                                <i class="ri-arrow-right-line"></i>
                            </a>
                        </li>
                    </ol>
                </div>
            </main>
            <script src="../../lib/showFileInput.js"></script>
            <script src="./script.js" type="module"></script>
        <?php endif ?>
    </section>
</body>