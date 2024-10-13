import getData from "../lib/getData.js"
import { createTable } from "../lib/createTable.js"
import { viewsTables } from "./tableEvents.js"

const $paginationContainer = document.querySelector(".items_pagination")
const $tbody = document.querySelector("tbody")
const $input = document.querySelector("#form-search input")
export let actualNum = 0;
export let slotActual = ""
export let schemeDataActual =[];

const [$btnPrev, $btnNext] = document.querySelectorAll("#movePage");

$btnPrev.addEventListener("click", handlePrev)
async function handlePrev(e){
    const $paginationBtns = document.querySelectorAll(".items_pagination button")
    const num = (Number(actualNum) - 1)
    if (num <= 0 || num == actualNum) return
    const $btn = $paginationBtns[num - 1]
    activeBtn($paginationBtns, $btn)
    updateActualNum($btn, num, $paginationContainer);
    const { data } = await getData(`slot=${slotActual}&page=${num}`)
    $tbody.innerHTML = ""
    const childs = createTable(data, schemeDataActual,$input.value)
    $tbody.append(...childs)
    scrollTo()
    viewsTables()
}

$btnNext.addEventListener("click", handleNext)
async function handleNext() {
    const $paginationBtns = document.querySelectorAll(".items_pagination button")
    const num = (Number(actualNum) + 1)
    if (num > $paginationBtns.length || num == actualNum) return
    const $btn = $paginationBtns[num - 1]
    activeBtn($paginationBtns, $btn)
    updateActualNum($btn, num, $paginationContainer);
    const { data } = await getData(`slot=${slotActual}&page=${num}`)
    $tbody.innerHTML = ""
    const childs = createTable(data, schemeDataActual,$input.value)
    $tbody.append(...childs)
    scrollTo()
}

export default function paginationTable(slot, schemeData) {
    slotActual = slot
    schemeDataActual = schemeData
    const $paginationBtns = document.querySelectorAll(".items_pagination button")
    activePagination($paginationBtns,slot,$tbody,schemeData)
}
function activePagination($paginationBtns,slot,$tbody,schemeData){
    $paginationBtns.forEach($btn => {
        let num = $btn.getAttribute("data-num")

        updateActualNum($btn, num, $paginationContainer)

        $btn.addEventListener("click", async () => {
            //if(!num || num === actualNum) return
            const $btnTarget = document.querySelector(`.items_pagination button[data-num='${num}']`)

            activeBtn($paginationBtns, $btnTarget)

            updateActualNum($btn, num, $paginationContainer)
            const { data } = await getData(`slot=${slot}&page=${num}`)
            $tbody.innerHTML = ""
            const childs = createTable(data, schemeData,$input.value)
            $tbody.append(...childs)
            scrollTo()
        })
    })
}

    /**
     * 
     * @param {HTMLButtonElement} $btn 
     */
     function updateActualNum($btn, num, $paginationContainer) {
        if ($btn.classList.contains("active")) {
            actualNum = num
            $btn.disabled = true
            moveAndDrawLine($paginationContainer, $btn)
        }
    }

    /**
     * 
     * @param {HTMLElement} $container 
     * @param {HTMLButtonElement} $btn 
     */
    function moveAndDrawLine($container, $btn) {
        $container.style.setProperty("--width-line", `${$btn.offsetWidth}px`)
        $container.style.setProperty("--left-position-line", `${$btn.offsetLeft}px`)
    }

    function activeBtn($paginationBtns, $target) {
        $paginationBtns.forEach($btnE => {
            if ($btnE == $target) {
                $target.classList.add("active")
            } else {
                $btnE.classList.remove("active")
                $btnE.disabled = false
            }
        })
    }

function scrollTo() {
    const $root = document.querySelector(".root > section")
    $root.scrollTo(0, $root.clientHeight)
}

export function updatePagination(length,searchActual,scheme,num){
    $paginationContainer.innerHTML = ""
    const $paginatination = $paginationContainer.parentElement
    if(length <= 1) {
        $paginatination.classList.add("hidden")
        return
    }
    $paginatination.classList.remove("hidden")
    actualNum = num ?? 1
    for(let i = 1; i <= length;i++){
        const $btn = document.createElement("button")
        $btn.dataset.num = i
        if(i === actualNum)$btn.classList.add("active")
        $btn.textContent = i
        $paginationContainer.appendChild($btn)
    }
    paginationTable(searchActual,scheme)
}