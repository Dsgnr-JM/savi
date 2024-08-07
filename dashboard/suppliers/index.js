import "../lib/paginationTable.js"
import {appendAvatar} from "../lib/createAvatar.js"
import paginationTable from "../lib/paginationTable.js"

paginationTable("products",["code","name","photo","selling_price","purchase_price","stock","actions"])

const $tdTables = document.querySelectorAll("#avatar")

$tdTables.forEach($td => {
  appendAvatar($td)
})