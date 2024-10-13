import "../lib/paginationTable.js"
import {appendAvatar} from "../lib/createAvatar.js"
import paginationTable from "../lib/paginationTable.js"
import searchTable from "../lib/searchTables.js"
import '../lib/showOptions.js'
import {viewsTables} from '../lib/tableEvents.js'
import '../../lib/showFileInput.js'
import checkInputFile from "../lib/checkInputFile.js"

checkInputFile()

const scheme = ["code","name","photo","category","selling_price","stock",["view","edit","delete"]]
const $tdTables = document.querySelectorAll("#avatar")
paginationTable("products",scheme)

$tdTables.forEach($td => {
  appendAvatar($td)
})
searchTable(scheme,"products")

viewsTables()

