import searchEngine from '../lib/searchEngine.js'
import { createTable } from "../lib/createTable.js"
import { updatePagination } from "../lib/paginationTable.js"
import {isRemoved} from "./tableEvents.js"

export let searchActual = "";

export default function searchTable(scheme,target) {
    const $input = document.querySelector("#search-table")
    const $tbody = document.querySelector("tbody")

    $input.addEventListener("input", () => {
        let value = $input.value
        handleSearchSale(value)
    })

    async function handleSearchSale(value) {
        searchActual = value
        const { data, length } = await searchEngine(target, `${value}&${isRemoved}`)
        $tbody.innerHTML = ""
        const $tds = createTable(data, scheme, value)
        $tbody.append(...$tds)
        updatePagination(length, `${target}&like=${value}&${isRemoved}`, scheme)
    }
}