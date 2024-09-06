import searchEngine from "../lib/searchEngine.js"
import getData from "../lib/getData.js"
import Bell from "../../lib/bell.esm.js";

const $inputSearch = document.querySelector("#search-product")
const $formSearch = document.querySelector("#form-search")
let sale = []

$formSearch.addEventListener("submit",async e =>{
    e.preventDefault()
    let value = $inputSearch.value
    if(!value) return
    let productData = await getData(`slot=product&search=${value}`)
    console.log(productData.length)

    if(productData.length <= 0) {
        new Bell({
        title: "No se encontro el producto"
        },"warning",{
            screenTime: 6000,
            removeOn: "click",
            isColored: false,
            typeAnimation: "bound-2",
            position:"bottom-center"
        }).launch()
        return
    }
    let [{name,code,selling_price}] = productData
    const data = {name,code,selling_price,amount:1}
    let product = sale.find(product => product.code == data.code)
    if(product) {product.amount++}
    else{
        sale.push(data)
    }
    createProductsHTML()
})

const $searchClient = document.querySelector("label#hidden")
const $clientBtn = document.querySelector("#client-btn")
const $searchProduct = document.querySelector("#search-product")
const $tableProducts = document.querySelector("#table-products")
const $totalPrice = document.querySelector("#total-price")
const $pricesTotal = document.querySelector("#prices-total")
const $pricesPayment = document.querySelector("#prices-payment")
const $pricesReturn = document.querySelector("#prices-change")
const $closeSale = document.querySelector("#close-sale")
const $totalReceived = document.querySelector("#total-recived")

let totalSale = 0

function createProductsHTML(){
    totalSale = Number(sale.reduce((acc,product) => product.selling_price * product.amount + acc,0)).toFixed(2)
    $pricesTotal.textContent = totalSale
    $totalPrice.textContent = totalSale
    $tableProducts.innerHTML = ""
    for(let product of sale){
        const $tr = document.createElement("tr");
        const $code = document.createElement("td")
        const $description = document.createElement("td")
        const $amount = document.createElement("td")
        const $price = document.createElement("td")
        const $total = document.createElement("td")
        const $actions = document.createElement("td")
        const $btnEdit = document.createElement("button");
        const $btnAdd = document.createElement("button");
        const $btnsubtract = document.createElement("button");
        const $btnDelete = document.createElement("button");
        const $iconEdit = document.createElement("i")
        const $iconAdd = document.createElement("i")
        const $iconDelete = document.createElement("i")
        const $iconsubtract = document.createElement("i")

        $code.textContent = product.code
        $description.textContent = product.name
        $amount.textContent = product.amount
        $price.textContent = "$" + Number(product.selling_price).toFixed(2)
        $total.textContent = "$" + Number(product.selling_price * product.amount).toFixed(2)
        $actions.classList.add("actions")
        $btnAdd.className = "btn-square add"
        $btnEdit.className = "btn-square edit"
        $btnDelete.className = "btn-square delete"
        $btnsubtract.className = "btn-square subtract"
        $btnAdd.setAttribute("data-code", product.code)
        $btnDelete.setAttribute("data-code", product.code)
        $btnEdit.setAttribute("data-code", product.code)
        $btnsubtract.setAttribute("data-code", product.code)
        $iconEdit.classList.add("ri-edit-line")
        $iconAdd.classList.add("ri-add-line")
        $iconDelete.classList.add("ri-delete-bin-6-line")
        $iconsubtract.classList.add("ri-subtract-line")
        $btnAdd.appendChild($iconAdd)
        $btnDelete.appendChild($iconDelete)
        $btnsubtract.appendChild($iconsubtract)
        $btnEdit.appendChild($iconEdit)
        $actions.append($btnEdit, $btnAdd, $btnsubtract, $btnDelete)
        $tr.append($code, $description, $amount, $price, $total, $actions)
        $tableProducts.appendChild($tr)
    }
    document.querySelectorAll(".subtract").forEach(btn => btn.addEventListener("click", e =>{
        removeAmountSale(btn.getAttribute("data-code"))
    }))
    document.querySelectorAll(".add").forEach(btn => btn.addEventListener("click", e =>{
        addAmountSale(btn.getAttribute("data-code"))
    }))
    document.querySelectorAll(".delete").forEach(btn => btn.addEventListener("click", e =>{
        removeSale(btn.getAttribute("data-code"))
    }))
}

function removeAmountSale(code){
    let indexOf;
    const product = sale.find((product, i) => {
        if(product.code == code){
            indexOf = i
            return product
        }})
    if(product.amount == 1){       
        sale = sale.filter(productSale => productSale.code !== product.code)
    }else{
        product.amount--
    }
    createProductsHTML()
}
function addAmountSale(code){
    const product = sale.find(productSale => productSale.code == code)
    product.amount++
    createProductsHTML()
}
function removeSale(code){
    const product = sale.find(productSale => productSale.code == code)
    sale = sale.filter(productSale => productSale.code !== product.code)
    createProductsHTML()
}
$totalReceived.addEventListener("input",() => {
    if(totalSale -$totalReceived.value < 0) {
        $totalReceived.classList.add("wrong")
    }else{
        $totalReceived.classList.remove("wrong")
    }
    $pricesPayment.textContent = $totalReceived.value
    $pricesReturn.textContent = $totalReceived.value - totalSale
})