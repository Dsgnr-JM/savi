import { $, $$ } from '../lib/dom-selector.js'
import { openDialog, closeDialog } from '../../lib/dialog.js'
import Bell from '../../lib/bell.esm.js'
import searchEngine from '../lib/searchEngine.js'
import {cleanPrice} from '../lib/conversion.js'
import '../lib/showOptions.js'

const $openModal = $("#search-modal")
const $dialogProducts = $(".dialog.products")
const $closeModal = $("#close-modal")
const $searchProduct = $("#search-product")
const $tableDialog = $(".dialog tbody")
const $tableProduct = $("#table-products")
const $deleteAll = $("#deleteAll")
const $purchaseBtn = $("#purchase")
// const $conversion = $("#conversion")
const [$firstSign,$secondSign] = $$("#convertSign")
const [$firstTotal,$secondTotal] = $$("#total-price")
let conversion = false
let store = []
let purchase = []

$deleteAll.addEventListener("click",()=>{
    purchase.length = 0
    createTableProducts($tableProduct,[])
})
// $conversion.addEventListener("click",()=>{
//     conversion = !conversion
//     createTableProducts($tableProduct,purchase)
// })

$openModal.addEventListener("click", () => { 
    $searchProduct.focus()
    openDialog($dialogProducts)
})
$closeModal.addEventListener("click", () => {
    closeDialog($dialogProducts)
    $searchProduct.value = ""
    createTableSearch($tableDialog, [])
    store.length = 0
})

$searchProduct.addEventListener("input", handleSearch)

async function handleSearch() {
    const data = await searchEngine("products", $searchProduct.value, true)
    store = data
    createTableSearch($tableDialog, data)
}
/**
 * 
 * @param {HTMLTableElement} $container 
 * @param {Array} data 
 */
function createTableSearch($container, data) {
    $container.innerHTML = ""
    data.forEach(product => {
        const $tr = document.createElement("tr")
        const [$code, $description] = [document.createElement("td"), document.createElement("td")];
        $tr.dataset.code = product.code
        $code.textContent = product.code
        $description.textContent = product.name
        $tr.addEventListener("click", () => {
            handleAddProduct(product.code)
        })
        $tr.append($code, $description)
        $container.appendChild($tr)
    })
}

function handleAddProduct(code) {
    let product = store.find(product => product.code == code)
    handleProduct(product.code, product, 1)
    createTableProducts($tableProduct, purchase)
}

function handleProduct(code, product, amount,type,isInput) {
    let repeatProduct = purchase.find(product => product.code == code)
    if (repeatProduct) {
        let value = Number(repeatProduct[type])
        amount = Number(amount)
        repeatProduct[type] = type != "amount" ? (value + amount).toFixed(2) : (value + amount)
        if(isInput) repeatProduct[type] = type != "amount" ? amount.toFixed(2) : amount
    } else {
        let { code, name, purchase_price, stock, stock_max } = product
        purchase.push({ code, name, purchase_price, stock, stock_max, amount: amount })
    }
}

function createTableProducts($container, data) {
    $container.innerHTML = ""
    let [signFirst,secondFirst] = conversion ? ["Bs","$"] : ["$","Bs"]
    let totalSale = Number(purchase.reduce((acc,product) => product.purchase_price * product.amount + acc,0)).toFixed(2)
    const $parent = $container.parentElement
    $firstSign.textContent = signFirst
    $secondSign.textContent = secondFirst
    $firstTotal.textContent = cleanPrice(conversion,totalSale)
    $secondTotal.textContent = cleanPrice(!conversion,totalSale)
    if(data.length <= 0){
        $parent.classList.add("empty")
        $container.innerHTML = "<tr></tr>"
        return
    }else{
        $parent.classList.remove("empty")
    }
    data.forEach((product, i) => {
        const price = cleanPrice(conversion,product.purchase_price)
        const total = cleanPrice(conversion,product.purchase_price * product.amount)

        const $tr = document.createElement("tr")
        const [$index, $code, $description, $stock, $amount, $price, $total, $actions] = [...Array(8)].map(() => document.createElement("td"))
        const $number_selector = createNumberSelector(product.code, product.amount,"amount")
        const $price_selector = createNumberSelector(product.code, price,"purchase_price")
        const $btnDelete = document.createElement("button");
        $index.textContent = i + 1
        $code.textContent = product.code
        $stock.textContent = product.stock
        $amount.append($number_selector);
        $description.textContent = product.name
        $price.appendChild($price_selector)
        $total.textContent = total + ` ${signFirst}`
        $btnDelete.className = "btn-square delete"
        $btnDelete.innerHTML = `<i class="ri-delete-bin-6-line"></i>`
        $btnDelete.addEventListener("click",()=>{
            purchase = purchase.filter(product => product.code != $btnDelete.closest("tr").dataset.code)
            createTableProducts($tableProduct,purchase)
        })
        $tr.dataset.code = product.code
        $actions.classList.add("actions")
        $actions.appendChild($btnDelete)
        $tr.append($index, $code, $description, $stock, $amount, $price, $total, $actions)
        $container.append($tr)
    })
}

function handleAdd(code,type) {
    let product = purchase.find(product => product.code == code)
    handleProduct(product.code, product, 1,type)
    createTableProducts($tableProduct,purchase)
}
function handleRemove(code,type) {
    let product = purchase.find(product => product.code == code)
    if (type=="amount" && product.amount - 1 < 1) {
        purchase = purchase.filter(item => item !== product);
        createTableProducts($tableProduct, purchase)
        return
    }else{
        let value = product.purchase_price - 1 < 0 ? 0 : -1
        handleProduct(product.code, product, value,type,!Boolean(value))
        createTableProducts($tableProduct,purchase)
    }
}

function handleInput(code,value,type){
    let product = purchase.find(product => product.code == code)
    if (value < 1) {
        purchase = purchase.filter(item => item !== product);
        createTableProducts($tableProduct, purchase)
        return
    }
    handleProduct(product.code, product, Number(value),type,true)
    createTableProducts($tableProduct,purchase)
}

function createNumberSelector(code, value,type) {
    const $container = document.createElement("label")
    $container.classList.add("number_selector")
    const $input = document.createElement("input")
    $input.addEventListener("input",()=>{
        $input.addEventListener("focusout",()=>{
            handleInput(code,$input.value,type)
        })
    })
    $input.type = "number"
    $input.value = value
    const $action = document.createElement("div")
    $action.classList.add("action")
    const [$add, $remove] = [...Array(2)].map(item => document.createElement("button"))
    $add.addEventListener("click", () => {
        handleAdd(code,type)
    })
    $remove.addEventListener("click", () => {
        handleRemove(code,type)
    })
    $add.innerHTML = `<i class="ri-arrow-drop-up-line"></i>`
    $remove.innerHTML = `<i class="ri-arrow-drop-down-line"></i>`
    $action.append($add, $remove)
    $container.append($input, $action);
    return $container;
}

$purchaseBtn.addEventListener("click",async()=>{
    if(purchase.length < 1) return

    const $form = document.querySelector("form")
    $form.action = "purchase.php"
    $form.method = "POST"
    purchase.map(product => {
        const $inputProduct = document.createElement("input")
        const $inputAmount = document.createElement("input")
        const $inputPrice = document.createElement("input")
        $inputProduct.value = product.code
        $inputProduct.type = "hidden"
        $inputAmount.type = "hidden"
        $inputPrice.type = "hidden"
        $inputAmount.value = product.amount
        $inputPrice.value = product.purchase_price
        $inputProduct.name = "product[]"
        $inputAmount.name = "amount[]"
        $inputPrice.name = "price[]"
        $form.append($inputProduct,$inputAmount,$inputPrice)
    })
    const data = await fetch("purchase.php",{
        body: new FormData($form),
        method: "POST"
    })
    const result = await data.json()
    if(result.message == "correct"){
        purchase.length = 0
        createTableProducts($tableProduct,purchase)
        new Bell({title: "Compra realizada exitosamente"},"success",{
            screenTime: 5000,
            theme: "light",
            position: "top-center"
        }).launch()
    }else{
        new Bell({title: "No se pudo realizar al compra"},"error",{
            screenTime: 5000,
            theme: "light",
            position: "top-center"
        }).launch()
    }
    //$form.submit()
})