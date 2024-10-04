import "../lib/paginationTable.js"
import {appendAvatar} from "../lib/createAvatar.js"
import paginationTable from "../lib/paginationTable.js"
import searchTable from "../lib/searchTables.js"
import '../lib/showOptions.js'

const scheme = ["dni","image","name","enterprise_name","phone","actions"]
const $tdTables = document.querySelectorAll("#avatar")
paginationTable("clients",scheme)

$tdTables.forEach($td => {
  appendAvatar($td)
})
searchTable(scheme,"clients")