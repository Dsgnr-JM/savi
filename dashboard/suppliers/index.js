import {appendAvatar} from "../lib/createAvatar.js"
import paginationTable from "../lib/paginationTable.js"
import searchTable from "../lib/searchTables.js"

const scheme = ["dni","name","image","phone","email","location","actions"]
const $tdTables = document.querySelectorAll("#avatar")
paginationTable("suppliers",scheme)

$tdTables.forEach($td => {
  appendAvatar($td)
})
searchTable(scheme,"suppliers")