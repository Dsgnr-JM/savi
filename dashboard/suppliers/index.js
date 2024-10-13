import {appendAvatar} from "../lib/createAvatar.js"
import paginationTable from "../lib/paginationTable.js"
import searchTable from "../lib/searchTables.js"
import '../lib/showOptions.js'
import { viewsTables } from "../lib/tableEvents.js"

const scheme = ["rif","name","image","phone","email","location",["view","edit","delete"]]
const $tdTables = document.querySelectorAll("#avatar")
paginationTable("suppliers",scheme)

$tdTables.forEach($td => {
  appendAvatar($td)
})
searchTable(scheme,"suppliers")
viewsTables()