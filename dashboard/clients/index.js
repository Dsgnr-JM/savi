import "../lib/paginationTable.js"
import {appendAvatar} from "../lib/createAvatar.js"
import paginationTable from "../lib/paginationTable.js"


paginationTable("clients",["dni","image","name","enterprise_name","phone","actions"])

const $tdTables = document.querySelectorAll("#avatar")

$tdTables.forEach($td => {
  appendAvatar($td)
})