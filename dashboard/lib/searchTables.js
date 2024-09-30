import searchEngine from '../lib/searchEngine.js'
import { createTable } from "../lib/createTable.js"
import { updatePagination } from "../lib/paginationTable.js"

export default function searchTable(scheme,target) {
    const $input = document.querySelector("#search-table")
    const $tbody = document.querySelector("tbody")
    let searchActual = "";

    $input.addEventListener("input", () => {
        let value = $input.value
        handleSearchSale(value)
    })

    async function handleSearchSale(value) {
        searchActual = `${target}&like=${value}`
        const { data, length } = await searchEngine(target, value)
        $tbody.innerHTML = ""
        const $tds = createTable(data, scheme, value)
        $tbody.append(...$tds)
        updatePagination(length, searchActual, scheme)
    }
}