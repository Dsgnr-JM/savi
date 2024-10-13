import { $$, $ } from "./dom-selector.js";

const $categories = $$("li.items");
const $btnNav = $(".menu");
let shortNav = localStorage.getItem("nav-bar-savi") ?? false;
const $navBar = $(".primary_navbar");
const $navScroll = $(".nav_items")
const $btnScrollNav = $(".scroll")
const $NavItems = [...$$("#nav_items > li > a")].filter($item => $item.querySelector("#arrowDown"))
const $NavOptions = $$("#nav_items #options")
let scrollX = 1000;

const listURLs = [
  ["", "profile"],
  ["stadistics","products", "suppliers"],
  ["informs", "sales", "clients"],
];

const [_, URL] = window.location.pathname.split("/dashboard/");
const urlNormalize = URL.replace("/","")

document.querySelector(`a[data-url="${urlNormalize}"]`).classList.add("active")


//if(shortNav) $navBar.classList.add("short")

listURLs.forEach((urlItem, i) => {
  urlItem.forEach(item =>  {
    if (item == urlNormalize) {
      $categories[i].classList.add("active")
      $navScroll.scrollTop = $categories[i].offsetTop
    }
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