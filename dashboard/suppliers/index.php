<?php require "../ui/header.php" ?>
<?php $place = $_GET["place"] ?>
<title>Proveedores - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
<?php if ($place === "register") :  ?>
    <link rel="stylesheet" href="../../forms.css">
<?php endif ?>

<?php 
    $optionsTitle = array(
        "register" => "Registro",
        "consult" => "Consulta"
    )
 ?>
</head>

<body>
    <?php include '../ui/navbar.php' ?>
    <section>
        <?php if (!$place) : ?>
        <div class="table">
            <h2>Lista de proveedores</h2>
            <table>
                <thead>
                    <tr>
                        <td>Rif</td>
                        <td>Empresa</td>
                        <td>Imagen</td>
                        <td>Telefono</td>
                        <td>Email</td>
                        <td>Localizacion</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        require_once "../../config.php";
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $stmt = $pdo->prepare("SELECT * FROM supliers");
                        $stmt->execute();
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                     ?>
                     <?php foreach($results as $result): ?>
                    <tr>
                        <td><?= $result["suplier_rif"]  ?></td>
                        <td><?= $result["suplier_name"]  ?></td>
                        <td><img src="/SAVI/assets/_c7f93b51-6c46-4d20-97ef-ba29bdb56088.jpeg" alt="Imagen de perfil">
                        </td>
                        <td><?= $result["suplier_phone"]  ?></td>
                        <td><?= $result["suplier_email"]  ?></td>
                        <td><?= $result["suplier_location"]  ?></td>
                        <td class="actions">
                            <button class="btn-square edit" data-id="<?= $result['suplier_rif']  ?>">
                                <i class="ri-edit-line"></i>
                            </button>
                            <button class="btn-square delete" data-id="<?= $result['suplier_rif']  ?>">
                                <i class="ri-delete-bin-6-line"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
            <div class="pagination">
                <button class="btn-rounded">
                    <i class="ri-arrow-left-double-line"></i>
                </button>
                <button class="btn-rounded">
                    <i class="ri-arrow-left-s-line"></i>
                </button>
                <div>
                    <button class="btn-rounded">
                        <i class="ri-number-1"></i>
                    </button>
                </div>
                <button class="btn-rounded">
                    <i class="ri-arrow-right-s-line"></i>
                </button>
                <button class="btn-rounded">
                    <i class="ri-arrow-right-double-line"></i>
                </button>
            </div>
        </div>
        <?php endif ?>
        <?php if ($place === "register") : ?>
            <main>
                <form action="dashboard" class="form" id="register" style="max-width: 400px;">
                    <h2>Registro de proveedores</h2>
                    <p>Guarde un proveedor de productos para usar despues.</p>
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
                        <p>Nombre encargado:</p>
                        <span>
                            <i class="ri-user-line"></i>
                            <input type="text" name="name" required placeholder="Vanessa Teran">
                        </span>
                    </label>
                    <label>
                        <p>Telefono:</p>
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
                        <a href="./"class="btn cancel">
                            Cancelar
                        </a> 
                        <button class="btn success">
                            Registrar
                            <i class="ri-arrow-drop-right-line"></i>
                        </button>                      
                    </div>
                </form>
            </main>
            <script src="../../lib/showFileInput.js"></script>
            <script src="./script.js" type="module"></script>
        <?php endif ?>
    </section>
</body>