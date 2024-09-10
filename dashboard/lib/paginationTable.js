import getData from "../lib/getData.js"
import { createTable } from "../lib/createTable.js"
import { appendAvatar } from "../lib/createAvatar.js"


export default function paginationTable(slot, schemeData) {
    const $paginationBtns = document.querySelectorAll(".items_pagination button")
    const $paginationContainer = document.querySelector(".items_pagination")
    const [$btnPrev, $btnNext] = document.querySelectorAll("#movePage");
    const $tbody = document.querySelector("tbody")
    let actualNum = 0;

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
            const childs = createTable(data, schemeData)
            $tbody.append(...childs)

            const $tdTables = document.querySelectorAll("#avatar")

            $tdTables.forEach($td => {
                appendAvatar($td)
            })
            scrollTo()
        })
    })

    $btnPrev.addEventListener("click", async () => {
        const num = (Number(actualNum) - 1)
        if (num <= 0 || num == actualNum) return
        const $btn = $paginationBtns[num - 1]
        activeBtn($paginationBtns, $btn)
        updateActualNum($btn, num, $paginationContainer);
        const { data } = await getData(`slot=${slot}&page=${num}`)
        $tbody.innerHTML = ""
        const childs = createTable(data, schemeData)
        $tbody.append(...childs)

        const $tdTables = document.querySelectorAll("#avatar")

        $tdTables.forEach($td => {
            appendAvatar($td)
        })
        scrollTo()
    })

    $btnNext.addEventListener("click", async () => {
        const num = (Number(actualNum) + 1)
        if (num > $paginationBtns.length || num == actualNum) return
        const $btn = $paginationBtns[num - 1]
        activeBtn($paginationBtns, $btn)
        updateActualNum($btn, num, $paginationContainer);
        const { data } = await getData(`slot=${slot}&page=${num}`)
        $tbody.innerHTML = ""
        const childs = createTable(data, schemeData)
        $tbody.append(...childs)

        const $tdTables = document.querySelectorAll("#avatar")

        $tdTables.forEach($td => {
            appendAvatar($td)
        })
        scrollTo()
    })
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

}
function scrollTo() {
    const $root = document.querySelector(".root > section")
    $root.scrollTo(0, $root.clientHeight)
}