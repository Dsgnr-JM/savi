import "../lib/paginationTable.js"
import {appendAvatar} from "../lib/createAvatar.js"
import paginationTable from "../lib/paginationTable.js"
import searchTable from "../lib/searchTables.js"
import { viewsTables } from "../lib/tableEvents.js"
import '../lib/showOptions.js'
import "../../lib/showFileInput.js"

const scheme = ["dni","image","name","enterprise_name","phone",["view","edit","delete"]]
const $tdTables = document.querySelectorAll("#avatar")
paginationTable("clients",scheme)

$tdTables.forEach($td => {
  appendAvatar($td)
})
searchTable(scheme,"clients")
viewsTables()