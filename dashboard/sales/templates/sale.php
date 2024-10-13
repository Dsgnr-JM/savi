<h2><i class="ri-shopping-basket-line"></i>Ventas</h2>
<p>Crea una venta a partir de los diferentes productos registrados en la empresa.</p>
<div class="table-options">
    <form autocomplete="off"id="form-search" class="form not-ring" style="width:320px;margin:0;">
        <label style="margin:0;">
            <span>
                <i class="ri-search-line"></i>
                <input type="text" id="search-product" placeholder="Tornillo xs">
            </span>
        </label>
    </form>
    <button class="more" data-show="show">
        <i class="ri-more-2-line" data-show="show"></i>
        <ol>
            <li id="conversion"><i class="ri-coins-line"></i>Cambiar divisa a <span>$</span></li>
        </ol>
    </button>
</div>
<div class="table">
    <table class="empty">
        <thead>
            <tr>
                <td style="width: 50px;">#</td>
                <td>C&oacute;digo</td>
                <td>Descripci&oacute;n</td>
                <td>Cantidad</td>
                <td>Precio</td>
                <td>Total</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody id="table-products">
            <tr>
            </tr>
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
<div class="total-details">
    <div>
        <p>Total neto: <span id="total-neto">0.00</span></p>
        <p>I.V.A: <span id="total-iva">0.00</span></p>
        <h3>Total <span id="convertSign">Bs</span>: <span id="total-price">0.00</span></h3>
        <p>Total <span id="convertSign">$</span>: <span id="total-dollar">0.00</span></p>
    </div>
</div>
<div class="float">
    <button id="sale">
        <i class="ri-check-fill"></i>
    </button>
</div>
<div class="bg_dialog"></div>
<main class="dialog" id="dialog">
    <div class="sell">
        <h2>Datos de venta y cliente</h2>
        <p>Complete los datos faltantes para completar la venta.</p>
        <form autocomplete="off"class="form" action="./sell.php" method="POST">
            <input type="hidden" id="dolarPrice" value="<?= $dolarPrice ?>" disabled>
            <label>
                <p>Cliente DNI:</p>
                <span>
                    <i class="ri-user-line"></i>
                    <input type="text" name="client" required placeholder="31744101">
                </span>
            </label>
            <label style="flex-direction:row;align-items:center;">
                <input type="checkbox" id="registClient">
                <p style="margin: 0 0 0 7px;">Crear cliente:</p>
            </label>
            <label>
                <p>Pago:</p>
                <span>
                    <i class="ri-mail-line"></i>
                    <button class="badge info action" type="button">Exacto</button>
                    <input type="number" name="payment" step="any" required placeholder="100.43">
                </span>
            </label>
            <div class="details">
                <p><strong>Total neto <span>Bs: 0</span></strong></p>
                <p><strong>Total <span>Bs: 0</span></strong></p>
                <p><strong>Pago <span>Bs: 0</span></strong></p>
            </div>
            <div class="container-buttons">
                <button class="btn cancel" type="button">
                    Cancelar
                </button>
                <button class="btn success" type="submit">
                    Realizar compra
                    <i style="font-weight:100" class="ri-money-dollar-circle-line"></i>
                </button>
            </div>
        </form>
    </div>
    <div class="client">
        <h2>Registre un cliente</h2>
        <p>Si necesita registrar un cliente de forma avanzada necesita ir a <a href="../clients/?place=register">Clientes</a> para mayor seguridad y gesti&oacute;n.</p>
        <form autocomplete="off"class="form">
            <label>
                <p>C&eacute;dula:</p>
                <span>
                    <i class="ri-profile-line"></i>
                    <input type="text" name="dni" required placeholder="31744101">
                </span>
            </label>
            <div class="inputs-container">
                <label>
                    <p>Nombre:</p>
                    <span>
                        <input type="text" name="name" required placeholder="Maria Gabriela">
                        <i class="ri-user-line" id="icon-form"></i>
                    </span>
                </label>
                <label>
                    <p>Apellido:</p>
                    <span>
                        <input type="text" name="surname" required placeholder="de los Angeles">
                        <i class="ri-user-line" id="icon-form"></i>
                    </span>
                </label>
            </div>
            <label>
                <p>Tel&eacute;fono:</p>
                <span>
                    <input type="text" name="phone" required placeholder="04247714244">
                    <i class="ri-phone-line" id="icon-form"></i>
                </span>
            </label>
            <input type="hidden" name="location">
            <div class="container-buttons">
                <button class="btn cancel" id="prev" type="button">
                    Volver
                </button>
                <button class="btn success" type="submit">
                    Registrar
                    <i style="font-weight:100" class="ri-save-2-line"></i>
                </button>
            </div>
        </form>
    </div>
</main>
<aside>
    <button>
        <i class="ri-shopping-cart-line"></i>
    </button>
    <h2><i class="ri-filter-3-line"></i>Clasificaciones:</h2>

    <div class="classifiers">
        <button class="active" id="category" data-category="" data-name="">
            <h3>Todos</h3>
            <p><span><?= $productNum ?></span> productos</p>
        </button>
        <?php foreach ($categorys as $category) : ?>
            <button id="category" data-name="<?= $category["name"] ?>" data-category="<?= $category["id"] ?>">
                <h3><?= $category["name"] ?></h3>
                <p><span><?= $category["num_products"] ?></span> productos</p>
            </button>
        <?php endforeach ?>
    </div>
    <form autocomplete="off"class="form not-ring" style="width: 100%;margin:15px 0;">
        <label style="margin:0;">
            <span>
                <i class="ri-search-line"></i>
                <input type="text" id="search-car" placeholder="Tornillo xs">
            </span>
        </label>
    </form>
    <div class="products">
        <ol id="products-list">
        </ol>
    </div>
</aside>
<div class="bg_menu"></div>
<script type="module" src="./shopping-car.js"></script>
<script type="module" src="./index.js"></script>