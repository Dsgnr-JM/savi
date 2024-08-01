<?php require "../ui/header.php" ?>
<?php $place = $_GET["place"] ?>
<title>Ventas - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="../../forms.css">

</head>

<body>
    <?php include '../ui/navbar.php' ?>
    <section>
        <header class="description">
            <i class="ri-shopping-basket-fill"></i>
            <div>
                <h1>Ventas</h1>
                <p><i class="ri-information-fill"></i>Esta es el area de gestion ventas</p>
            </div>
        </header>
        <?php if(!$place): ?>
        <div class="table">
            <button class="more btn-rounded">
                <i class="ri-more-2-fill "></i>
            </button>
            <form id="form-search">
                <label class="search">
                    <button>
                        <i class="ri-search-line"></i>
                    </button>
                    <span>
                        <input type="text" id="search-product" placeholder="Tornillo xs">
                    </span>
                </label>
            </form>
            <h2 style="display: flex;gap:3px;">Total de venta: <p style="color:#292b2d;">$<span id="total-price">0.00</span></p></h2>
            <table>
                <thead>
                    <tr>
                        <td>Codigo</td>
                        <td>Descripcion</td>
                        <td>Cantidad</td>
                        <td>Precio</td>
                        <td>Total</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody id="table-products">
                    <!-- <tr>
                        <td>ELE2012</td>
                        <td>Otdos</td>
                        <td>4</td>
                        <td>$5</td>
                        <td>$20</td>
                        <td class="actions">
                            <button class="btn-square edit">
                                <i class="ri-edit-line"></i>
                            </button>
                            <button class="btn-square add">
                                <i class="ri-add-line"></i>
                            </button>
                            <button class="btn-square subtract">
                                <i class="ri-subtract-line"></i>
                            </button>
                            <button class="btn-square delete">
                                <i class="ri-delete-bin-6-line"></i>
                            </button>
                        </td>
                    </tr> -->
                </tbody>
            </table>
        </div>
        <div class="float">
            <button id="sale">
                <i class="ri-check-fill"></i>
            </button>
            <div>
                <div class="counted" id="sale_options">
                    <span>Contado</span>
                    <button><i class="ri-bank-card-2-fill"></i></button>
                </div>
                <div class="apart" id="sale_options">
                    <span>Apartado</span>
                    <button><i class="ri-calendar-2-fill"></i></button>
                </div>
            </div>
        </div>
        <main class="modal">
            <form action="?place=correct" method="POST" class="form" id="login" style="max-width: 400px;">
                <h3>Terminar venta al contado</h3>
                <input type="hidden" name="login">
                <label>
                    <p>Cantidad recibida:</p>
                    <span>
                        <i class="ri-cash-line"></i>
                        <input type="number" name="username" id="total-recived" required placeholder="2000.0">
                    </span>
                </label>
                <p>Tipo de cliente</p>
                <div>
                    <label style="flex-direction: row;gap:2px;font-size: .9rem; color: #3c515a96;">
                        <input type="radio" name="type" id="client-btn">
                        <p style="margin: 0;">
                            Buscar un cliente
                        </p>
                    </label>
                    <label id="hidden">
                        <span>
                            <i class="ri-user-line"></i>
                            <input type="search" id="search" placeholder="Vanessa">
                        </span>
                    </label>
                </div>
                <div class="prices">
                    <ol>
                        <li>Total: $<span id="prices-total">0</span></li>
                        <li>Pago: $<span id="prices-payment">0</span></li>
                        <li>Cambio: $<span id="prices-change">0</span></li>
                    </ol>
                </div>
                <div class="btns">
                    <button class="btn-primary success" id="close-sale">
                        Terminar venta
                    </button>
                </div>
            </form>
        </main>
        <script src="./index.js" type="module"></script>
        <script type="text/javascript">
            const $btnSale = document.querySelector("#sale")
            const $modal = document.querySelector(".modal")
            $modal.addEventListener("click", ({
                target
            }) => {
                if (target.localName === "main") $modal.classList.remove("active")
            })
            const $optionsSale = document.querySelectorAll("#sale_options")
            $optionsSale.forEach($option => {
                $option.addEventListener("click", () => {
                    $modal.classList.add("active")
                })
            })
            $btnSale.addEventListener("click", () => {
                $btnSale.parentNode.classList.toggle("active")
            })
        </script>
        <?php endif ?>
        <?php if($place === "correct"): ?>
        <main class="sale-message">
            <i class="ri-information-fill"></i>
            <article class="description">
                <p>Para imprimir haga click en el boton <i class="ri-printer-fill"></i> de la esquina superior derecha.</p>
                <p>Recomendamos usar un navegador basado en chromium y desde un ordenador.</p>
                <p><strong>Nota:</strong> Recuerda que puedes configurar las facturas desde los ajustes del sistema</p>
            </article>
        </main>
        <a href="<?= URI_PATH ."sales" ?>" class="btn primary" style="max-width: 100px;">
            <i class="ri-arrow-left-line"></i>
            Volver
        </a>
        <div class="sale-details">
            <picture>
                <img src="../IMG-20240306-WA0032~2.jpg" alt="logo-empresa">
            </picture>
            <div class="text">
                <strong>Ticket de venta #01</strong>
                <p>martes, 13 de abril de 2024, 19:00</p>
                <p>Lo atendio: Jota</p>
                <p>Cliente: <strong>Vainilla</strong></p>
            </div>
            <table>
                <tbody>
                    <tr>
                        <td>Otros</td>
                        <td>3 x $ 123.00 x $ 369</td>
                    </tr>
                    <tr>
                        <td>Tornillo</td>
                        <td>2 x $ 9.00 x $ 18</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><strong>Total: $ 132.00</strong></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><strong>Su pago: $ 132.00</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php endif ?>
    </section>
</body>