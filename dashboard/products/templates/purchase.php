<h2><i class="ri-shopping-cart-line"></i>Compras</h2>
<p>Genera compras de productos, aumenta su stock y maneja sus precios.</p>
<div class="table-options">
    <form autocomplete="off"id="form-search" class="form not-ring" style="width:320px;margin:0;">
        <input type="hidden" id="dolarPrice" value="<?= $dolarPrice ?>" disabled>
        <label style="margin:0;">
            <span>
                <i class="ri-search-line"></i>
                <input type="text" id="search-modal" placeholder="Tornillo xs">
            </span>
        </label>
    </form>
    <button class="more" data-show="show">
        <i class="ri-more-2-line" data-show="show"></i>
        <ol>
            <li>
                <i class="ri-camera-lens-line"></i>Escanear <span class="badge ia">IA</span>
                <ol>
                    <li>Tomar fotografia</li>
                    <li>Subir archivo</li>
                </ol>
            </li>
            <!-- <li id="conversion"><i class="ri-coins-line"></i>Cambiar divisa a <span>$</span></li> -->
            <li id="deleteAll"><i class="ri-delete-bin-6-line"></i>Borrar todo</li>
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
                <td>Stock Actual</td>
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
        <h3>Total <span id="convertSign">Bs</span>: <span id="total-price">0.00</span></h3>
        <p>Total <span id="convertSign">$</span>: <span id="total-price">0.00</span></p>
    </div>
</div>
<div class="float">
    <button id="purchase">
        <i class="ri-check-fill"></i>
    </button>
</div>
<div class="bg_dialog"></div>
<main class="dialog products">
    <h2>Busca los productos que deseas añadir a la compra</h2>
    <p>Ten en cuenta que solo puedes cambiar el stock a productos ya registrados.</p>
    <form autocomplete="off"class="form">
        <label style="margin-top:20px;">
            <span>
                <i class="ri-search-line"></i>
                <input type="text" autocomplete="off" id="search-product" placeholder="Tornillo xs">
            </span>
        </label>
    </form>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <td>Codigo</td>
                    <td>Descripción</td>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="container-buttons">
        <button type="button" class="btn fit success" id="close-modal"><i class="ri-check-line"></i>Listo</button>
    </div>
</main>
<script type="module" src="./purchase.js"></script>