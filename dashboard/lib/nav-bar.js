import { $$, $ } from "./dom-selector.js";

const $categories = $$("li.items");
const $btnNav = $(".menu");
const $navBar = $(".primary_navbar");
const $navScroll = $(".nav_items")
const $btnScrollNav = $(".scroll")
const $NavItems = [...$$("#nav_items > li > a")].filter($item => $item.querySelector("#arrowDown"))
const $NavOptions = $$("#nav_items #options")
const tricks = ["buscar usuarios", "ver inventario","registro de productos","analisis de estadisticas","configuracion"]
let scrollX = 1000;

const listURLs = [
  ["", "profile"],
  ["stadistics","products", "suppliers"],
  ["informs", "sales", "clients"],
];

const [_, URL] = window.location.pathname.split("/dashboard/");

listURLs.forEach((urlItem, i) => {
  urlItem.forEach(item =>  {
    const urlNormalize = URL.replace("/","")
    if (item == urlNormalize) return $categories[i].classList.add("active")
  })}
);

$btnNav.addEventListener("click", () => {
  $navBar.classList.toggle("short");
});
$btnScrollNav.addEventListener("click",()=>{
    if(scrollX === 1000){
      $navScroll.scrollTop = scrollX
      scrollX = 0
    }else{
      $navScroll.scrollTop = scrollX
      scrollX = 1000
    }
    $btnScrollNav.firstElementChild.classList.toggle("ri-arrow-drop-down-line")
    $btnScrollNav.firstElementChild.classList.toggle("ri-arrow-drop-up-line")
})


$NavItems.forEach(($item, i) => {
  $item.addEventListener("click",(e)=> {
    const target = e.target
    if(target.id === "arrowDown") {
      e.preventDefault()
      $NavOptions[i].classList.toggle("active")
      if(!$item.nextElementSibling.classList.contains("active")) return
      $navScroll.scrollTop = $item.offsetTop
    }
  })
})

/* $SearchGlobal.addEventListener("input",({target}) => {
  let time = 400
  setTimeout(()=>{
    if(target.value === "") {
      $SearchResult.classList.remove("active")
    }else{
      $SearchResult.classList.add("active")
    }
    $SearchResult.querySelector("span").textContent = target.value
    getTricks(target.value).forEach(trick => {
      const li = document.createElement("li")
      li.textContent = trick
      $SearchResult.querySelector("ol").appendChild(li)
      
    })
  },time,clearInterval(time))
  document.addEventListener("keyup",()=>{
    clearTimeout(time)
  })
})

function getTricks(word){
  return tricks.filter(trick => trick.match(new RegExp(word, "g")))
} */