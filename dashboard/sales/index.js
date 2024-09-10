import searchEngine from "../lib/searchEngine.js"
import getData from "../lib/getData.js"
import Bell from "../../lib/bell.esm.js";
import {openDialog,closeDialog} from '../../lib/dialog.js'

const $inputSearch = document.querySelector("#search-product")
const $formSearch = document.querySelector("#form-search")
const $btnOpenSellForm = document.querySelector("#sale")
const $showRegistClient = document.querySelector("#registClient")
const [$totalModal, $totalIva, $totalPayment] = document.querySelectorAll(".details p span")
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
    if(stock < product?.amount + 1 | stock < 1) return
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

const $tableProducts = document.querySelector("#table-products")
const $totalPrice = document.querySelector("#total-price")

let totalSale = 0

function createProductsHTML(){
    totalSale = Number(sale.reduce((acc,product) => product.selling_price * product.amount + acc,0)).toFixed(2)
    let totalIva = (Number(totalSale) +(totalSale / 100 * 16)).toFixed(2);
    console.log(totalSale )
    $totalPrice.textContent = totalSale
    $totalModal.textContent = totalSale + "$ / " + totalSale * dolarPrice + "Bs"
    $totalIva.textContent = totalIva + "$ / " +(totalIva *dolarPrice).toFixed(2) + "Bs"
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
        $price.textContent = "$" + Number(product.selling_price).toFixed(2)
        $total.textContent = "$" + Number(product.selling_price * product.amount).toFixed(2)
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
const $prevBtn = document.querySelector("#prev")
const dolarPrice = document.querySelector("#dolarPrice").value

$payment.addEventListener("input",()=>{
    $totalPayment.textContent = $payment.value + "$ / " + $payment.value * dolarPrice + "Bs"
    
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

$dialog.querySelector(".sell form").addEventListener("submit",e=>{
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
        );
    $btn.disabled = false
    }
})
