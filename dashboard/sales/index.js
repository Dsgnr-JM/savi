import Bell from "../../lib/bell.js";
const $searchClient = document.querySelector("label#hidden")
const $clientBtn = document.querySelector("#client-btn")
const $searchProduct = document.querySelector("#search-product")
const $formSearch = document.querySelector("#form-search")
const $tableProducts = document.querySelector("#table-products")
const $totalPrice = document.querySelector("#total-price")
const $pricesTotal = document.querySelector("#prices-total")
const $pricesPayment = document.querySelector("#prices-payment")
const $pricesReturn = document.querySelector("#prices-change")
const $closeSale = document.querySelector("#close-sale")
const $totalReceived = document.querySelector("#total-recived")

$clientBtn.addEventListener("click",() => {
    $searchClient.classList.toggle("active")
})

const products = [
    {
        code: "ELE0002",
        description: "Otros",
        stock: 5,
        price: 12
    },
    {
        code: "ELE0001",
        description: "Ventilador",
        stock: 2,
        price: 50
    },
    {
        code: "VEN002",
        description: "Variado",
        stock: 5,
        price: 5.2
    },
    {
        code: "COC001",
        description: "Otros",
        stock: 5,
        price: 13
    },
]
let sale = []
$formSearch.addEventListener("submit",(e)=>{
    e.preventDefault();
    const schemaSale = {
        code:null,
        description:null,
        amount: null,
        price: null,
    }
    const productFind = products.find(product => product.code === $searchProduct.value || product.description === $searchProduct.value)
    if(!productFind){
        const bell = new Bell(
          { title: "Algo salio mal", description: "El producto no fue encontrado" },
          "warning",
          {
            animate: true,
            isColored: true,
            transitionDuration: 300,
            position: "bottom-right",
            typeAnimation: "fade-in",
            timeScreen: 8000,
            expand: true,
          }
        );
        bell.launch();
        $searchProduct.value = ""
        return 
    }

    const productRepeat = sale.find(saleProduct => saleProduct.code === productFind.code)

    if(productRepeat){
        productRepeat.amount++
    }else{
        schemaSale.code = productFind.code
        schemaSale.description = productFind.description
        schemaSale.amount = 1
        schemaSale.price = productFind.price
        sale.push(schemaSale)       
    }

    createProductsHTML()
})
let totalSale = 0

function createProductsHTML(){
    totalSale = sale.reduce((acc,product) => product.price * product.amount + acc,0)
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
        $description.textContent = product.description
        $amount.textContent = product.amount
        $price.textContent = product.price
        $total.textContent = "$" + product.price * product.amount
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