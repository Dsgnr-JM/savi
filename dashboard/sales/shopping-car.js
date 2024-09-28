import searchEngine from '../lib/searchEngine.js'
import getData from "../lib/getData.js"
import { sale, handleAddProduct } from './index.js'
import '../lib/html2canvas.min.js'

const $searchCar = document.querySelector("#search-car")
const $productList = document.querySelector("#products-list")
const $categorys = document.querySelectorAll("#category")
let filter = "";
let listProducts;
const svgLoader = `<svg class="loader" xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'><radialGradient id='a9' cx='.66' fx='.66' cy='.3125' fy='.3125' gradientTransform='scale(1.5)'><stop offset='0' stop-color='#A9BFBB'></stop><stop offset='.3' stop-color='#A9BFBB' stop-opacity='.9'></stop><stop offset='.6' stop-color='#A9BFBB' stop-opacity='.6'></stop><stop offset='.8' stop-color='#A9BFBB' stop-opacity='.3'></stop><stop offset='1' stop-color='#A9BFBB' stop-opacity='0'></stop></radialGradient><circle transform-origin='center' fill='none' stroke='url(#a9)' stroke-width='15' stroke-linecap='round' stroke-dasharray='200 1000' stroke-dashoffset='0' cx='100' cy='100' r='70'><animateTransform type='rotate' attributeName='transform' calcMode='spline' dur='2' values='360;0' keyTimes='0;1' keySplines='0 0 1 1' repeatCount='indefinite'></animateTransform></circle><circle transform-origin='center' fill='none' opacity='.2' stroke='#A9BFBB' stroke-width='15' stroke-linecap='round' cx='100' cy='100' r='70'></circle></svg>`

$categorys.forEach($category => {
    $category.addEventListener("click",async()=>{
        document.querySelectorAll("#category.active").forEach(item => item.classList.remove("active"))
        $category.classList.add("active")
        let category = $category.dataset.category
        filter = category
        $productList.innerHTML = svgLoader
        let result = await searchEngine("products",$searchCar.value,true,filter)
        listProducts = result
        createListProduct(listProducts)
    })
})

const categorys = await getData("slot=categorys")
const categorysStyles = {}
categorys.forEach((category,i) => categorysStyles[category.name] = i);
$searchCar.addEventListener("input",async ()=>{
    $productList.innerHTML = svgLoader
    let result = await searchEngine("products",$searchCar.value,true,filter)
    listProducts = result
    createListProduct(listProducts)
})

function createListProduct(products){
    $productList.innerHTML = ""
    if(products.length < 1){
        const $p = document.querySelector("p")
        $p.classList.add("shopping_empty")
        $p.textContent = "No se encontraron productos..."
        $productList.appendChild($p)
        return
    }
    for(let product of products){
        const {code,name,photo,category,purchase_price} = product
        const $container = document.createElement("li")
        $container.dataset.code = code
        $container.id = "product_shopping"
        const $img = document.createElement("img")
        $img.src = photo || "../../assets/no-image.png"
        
        const $title = document.createElement("h3")
        $title.textContent = name
        const $details = document.createElement("div")
        $details.classList.add("details")
        $container.append($img,$title,$details)
        const $badge = document.createElement("div")
        $badge.classList.add("badge")
        $badge.dataset.theme = categorysStyles[category]
        $badge.textContent = category
        const $price = document.createElement("h2")
        $price.innerHTML =`<span>${purchase_price}</span> $`
        $details.append($badge,$price)
        $productList.appendChild($container)
        $container.addEventListener("click",e =>handleShopping($container.dataset.code,$container.querySelector("img"),e))
    }
}
/**
 * 
 * @param {String} code 
 * @param {HTMLElement} productContainer
 */
function handleShopping(code,$imgOriginal,e){
    const $img = $imgOriginal.cloneNode()
    $img.classList.add("shopping_animate")
    const {x,y,height,width} = $imgOriginal.getBoundingClientRect()
    $img.height = height
    $img.width = width
    $img.style.left = x + "px"
    $img.style.top = y + "px"
    $img.style.setProperty('--shopping-top',y - 100 + "px")
    document.body.appendChild($img)
    setTimeout(()=>{
        $img.remove()
    },1000)
    handleAddProduct(code)
    // html2canvas(productContainer).then(canvas => {
    //     let url = document.createElement("a")
    //     url.download = "Captura"
    //     url.href = canvas.toDataURL()
    //     url.click()
    // })
}