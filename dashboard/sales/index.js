import searchEngine from "../lib/searchEngine.js"
import getData from "../lib/getData.js"
import Bell from "../../lib/bell.esm.js";
import {openDialog,closeDialog} from '../../lib/dialog.js'

const $inputSearch = document.querySelector("#search-product")
const $formSearch = document.querySelector("#form-search")
const $btnOpenSellForm = document.querySelector("#sale")
const [$totalModal, $totalPayment] = document.querySelectorAll(".details p span")
let sale = []

$formSearch.addEventListener("submit",async e =>{
    e.preventDefault()
    let value = $inputSearch.value
    if(!value) return
    let productData = await getData(`slot=product&search=${value}`)

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
    let [{name,code,selling_price,stock}] = productData
    const data = {name,code,selling_price,amount:1,stock}
    let product = sale.find(product => product.code == data.code)
    if(stock < product?.amount + 1) return
    if(product) {
        product.amount++
    }
    else{
        sale.push(data)
    }
    // const s = await fetch("./test/api.php",{
    //     method: "POST",
    //     body: JSON.stringify(sale)
    // })
    // console.log( await s.text())
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
    $totalPrice.textContent = totalSale
    $totalModal.textContent = totalSale + "$ / " + totalSale * 37 + "Bs"
    $tableProducts.innerHTML = ""
    let index = 1;

    for(let product of sale){
        const $tr = document.createElement("tr");
        const $num = document.createElement("td")
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

        $num.textContent = index++
        $code.textContent = product.code
        $description.textContent = product.name
        $amount.textContent = product.amount
        $price.textContent = "$" + Number(product.selling_price).toFixed(2)
        $total.textContent = "$" + Number(product.selling_price * product.amount).toFixed(2)
        $actions.classList.add("actions")
        $btnAdd.className = "btn-square add"
        $btnEdit.className = "btn-square edit"
        $btnDelete.className = "btn-square delete"
        $btnsubtract.className = "btn-square subtract";
        [$btnAdd,$btnDelete,$btnEdit,$btnsubtract].forEach(i => i.dataset.code = product.code)
        $iconEdit.classList.add("ri-edit-line")
        $iconAdd.classList.add("ri-add-line")
        $iconDelete.classList.add("ri-delete-bin-6-line")
        $iconsubtract.classList.add("ri-subtract-line")
        $btnAdd.appendChild($iconAdd)
        $btnDelete.appendChild($iconDelete)
        $btnsubtract.appendChild($iconsubtract)
        $btnEdit.appendChild($iconEdit)
        $actions.append($btnEdit, $btnAdd, $btnsubtract, $btnDelete)
        $tr.append($num, $code, $description, $amount, $price, $total, $actions)
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
    if(product?.stock < product?.amount + 1) return
    product.amount++
    createProductsHTML()
}
function removeSale(code){
    const product = sale.find(productSale => productSale.code == code)
    sale = sale.filter(productSale => productSale.code !== product.code)
    createProductsHTML()
}
// $totalReceived.addEventListener("input",() => {
//     if(totalSale -$totalReceived.value < 0) {
//         $totalReceived.classList.add("wrong")
//     }else{
//         $totalReceived.classList.remove("wrong")
//     }
//     $pricesPayment.textContent = $totalReceived.value
//     $pricesReturn.textContent = $totalReceived.value - totalSale
// })
const $dialog = document.querySelector("#dialog")
const $payment = document.querySelector("input[name='payment']")
const $btnSubmit = document.querySelector("form .btn.success")

$payment.addEventListener("input",()=>{
    $totalPayment.textContent = $payment.value + "$ / " + $payment.value * 37 + "Bs"
    
    if(Number($payment.value) > totalSale) {
        $btnSubmit.disabled = true
        $payment.classList.add("wrong")
        return
    }
    $btnSubmit.disabled = false
    $payment.classList.remove("wrong")
})

$btnOpenSellForm.addEventListener("click",()=>{
    if(sale.length <= 0)return
    openDialog($dialog)
})

$dialog.querySelector("form").addEventListener("submit",e=>{
    e.preventDefault()
    sale.forEach(item => {
        const $inputProduct = document.createElement("input")
        const $inputAmount = document.createElement("input")
        $inputProduct.value = item.code
        $inputProduct.type = "hidden"
        $inputAmount.type = "hidden"
        $inputAmount.value = item.amount
        $inputProduct.name = "product[]"
        $inputAmount.name = "amount[]"
        
        e.target.append($inputProduct,$inputAmount)
    })
    e.target.submit()
})