import searchEngine from "../lib/searchEngine.js"
import getData from "../lib/getData.js"
import Bell from "../../lib/bell.esm.js";
import '../lib/table.js'
import {openDialog,closeDialog} from '../../lib/dialog.js'
const $inputSearch = document.querySelector("#search-product")
const $formSearch = document.querySelector("#form-search")
const $btnOpenSellForm = document.querySelector("#sale")
const $showRegistClient = document.querySelector("#registClient")
const [$totalModal, $totalIva, $totalPayment] = document.querySelectorAll(".details p span")
const dolarPrice = document.querySelector("#dolarPrice").value
export let sale = []
let conversion = true;

function cleanPrice(convert, num){
    return Number(convert ? num * dolarPrice : num).toFixed(2)
}

$formSearch.addEventListener("submit",e =>{
    e.preventDefault()
    let value = $inputSearch.value
    if(!value) return
    handleAddProduct(value)
})

/**
 * 
 * @param {String} value 
 * @returns 
 */
export async function handleAddProduct(value){
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
    if(stock < product?.amount + 1 | stock < 1) return
    if(product) {
        product.amount++
    }
    else{
        sale.push(data)
    }
    createProductsHTML()
    return true
}

const $tableProducts = document.querySelector("#table-products")
const $total_Price = document.querySelector("#total-price")
const $total_IVA = document.querySelector("#total-iva")
const $total_Neto = document.querySelector("#total-neto")
const $total_Dollar = document.querySelector("#total-dollar")
const [$mainSign, $secondSign] = document.querySelectorAll("#convertSign")

let totalSale = 0

function createProductsHTML(){
    const convertSign = conversion ? "Bs" : "$"
    totalSale = Number(sale.reduce((acc,product) => product.selling_price * product.amount + acc,0)).toFixed(2)
    let totalIva = totalSale * .16
    let total = Number(totalSale) + totalIva
    $total_Price.textContent = cleanPrice(conversion,total);
    $total_IVA.textContent = cleanPrice(conversion,totalSale * .16);
    $total_Neto.textContent = cleanPrice(conversion,totalSale)
    $total_Dollar.textContent = cleanPrice(!conversion,total)
    $totalModal.textContent = `${convertSign}: ` + cleanPrice(conversion,totalSale)
    $totalIva.textContent = `${convertSign}: ` + cleanPrice(conversion,total)
    $tableProducts.innerHTML = ""
    let index = 1;
    $tableProducts.parentElement.classList.remove("empty")
    
    for(let product of sale){
        const $tr = document.createElement("tr");
        const $num = document.createElement("td")
        const $code = document.createElement("td")
        const $description = document.createElement("td")
        const $amount = document.createElement("td")
        const $price = document.createElement("td")
        const $total = document.createElement("td")
        const $actions = document.createElement("td")
        const $btnAdd = document.createElement("button");
        const $btnsubtract = document.createElement("button");
        const $btnDelete = document.createElement("button");
        const $iconAdd = document.createElement("i")
        const $iconDelete = document.createElement("i")
        const $iconsubtract = document.createElement("i")

        $num.textContent = index++
        $code.textContent = product.code
        $description.textContent = product.name
        $amount.textContent = product.amount
        $price.textContent = cleanPrice(conversion, product.selling_price) + ` ${convertSign}`
        $total.textContent =  cleanPrice(conversion, product.selling_price * product.amount) + ` ${convertSign}`
        $actions.classList.add("actions")
        $btnAdd.className = "btn-square add"
        $btnDelete.className = "btn-square delete"
        $btnsubtract.className = "btn-square subtract";
        [$btnAdd,$btnDelete,$btnsubtract].forEach(i => i.dataset.code = product.code)
        $iconAdd.classList.add("ri-add-line")
        $iconDelete.classList.add("ri-delete-bin-6-line")
        $iconsubtract.classList.add("ri-subtract-line")
        $btnAdd.appendChild($iconAdd)
        $btnDelete.appendChild($iconDelete)
        $btnsubtract.appendChild($iconsubtract)
        $actions.append($btnAdd, $btnsubtract, $btnDelete)
        $tr.append($num, $code, $description, $amount, $price, $total, $actions)
        $tableProducts.appendChild($tr)
        $btnsubtract.addEventListener("click", () =>{
            removeAmountSale($btnsubtract.getAttribute("data-code"))
        })
        $btnAdd.addEventListener("click", () =>{
            addAmountSale($btnAdd.getAttribute("data-code"))
        })
        $btnDelete.addEventListener("click", () =>{
            removeSale($btnDelete.getAttribute("data-code"))
        })
    }
    if(sale.length <= 0){
        const $tr = document.createElement("tr")
        $tableProducts.parentElement.classList.add("empty")
        $tableProducts.appendChild($tr)
    }
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
const $dialog = document.querySelector("#dialog")
const $payment = document.querySelector("input[name='payment']")
const $btnSubmit = document.querySelector("form .btn.success")
const $prevBtn = document.querySelector("#prev")
const $exactPrice = document.querySelector(".action")

$exactPrice.addEventListener("click",e=>{
    const convertSign = conversion ? "Bs" : "$"
    let value = cleanPrice(conversion,Number(totalSale) + totalSale * .16)
    $payment.value = value
    $totalPayment.textContent = `${convertSign}: ` + value
})

$payment.addEventListener("input",()=>{
    let totalIva = totalSale * .16
    let total = Number(totalSale) + totalIva
    let conv = conversion ? "Bs" : "$"
    $totalPayment.textContent = `${conv}: ` + $payment.value
    if($payment.value > Number(cleanPrice(conversion,total))) {
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

$dialog.querySelector(".sell form").addEventListener("submit",e=>{
    e.preventDefault()
    if(conversion) e.target.action = e.target.action + "?conversion=bs"
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

$showRegistClient.addEventListener("click",()=>{
    $dialog.classList.add("client_show")
})

$prevBtn.addEventListener("click",()=>{
    $dialog.classList.remove("client_show")
    $showRegistClient.checked = false
})

$dialog.querySelector(".client form").addEventListener("submit",async e=>{
    e.preventDefault()
    console.log("e")
    const $form = e.target
    const formData = new FormData($form)
    const $btn = e.submitter
    
    const fetching = await fetch(`../api/?slot=client&action=insert`, {
        method: "POST",
        body: formData,
    });
    const data = await fetching.json();
    if (data.result) {
        const bell = new Bell(
            { title: "Cliente registrado"},
            "success",
            {
                isColored: false,
                position: "top-center",
                typeAnimation: "bound-2",
                timeScreen: 5000,
                expand: true,
                distance:{
                    y: 10
                }
            }
        );
        bell.launch();
        $btn.disabled = false
        $form.reset()
        setTimeout(() => {
            $prevBtn.click()
        }, 1000);
        document.querySelector("input[name='client']").value = formData.get("dni")

    } else {
        const bell = new Bell(
            { title: "No se pudo registrar"},
            {
                isColored: false,
                position: "top-center",
                typeAnimation: "bound-2",
                timeScreen: 5000,
                expand: true,
                distance:{
                    y: 10
                }
            }
        ).launch();
    $btn.disabled = false
    }
})

const $btnChangeConversion = document.querySelector("#conversion")


$btnChangeConversion.addEventListener("click",()=>{
    conversion = !conversion
    let conv = !conversion ? "Bs" : "$"
    $btnChangeConversion.querySelector("span").textContent = conv
    $mainSign.textContent = conversion ? "Bs" : "$"
    $secondSign.textContent = conv
    createProductsHTML()
})