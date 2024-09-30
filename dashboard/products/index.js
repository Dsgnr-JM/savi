import "../lib/paginationTable.js"
import {appendAvatar} from "../lib/createAvatar.js"
import paginationTable from "../lib/paginationTable.js"
import searchTable from "../lib/searchTables.js"

const scheme = ["code","name","photo","category","selling_price","stock","actions"]
const $tdTables = document.querySelectorAll("#avatar")
paginationTable("products",scheme)

$tdTables.forEach($td => {
  appendAvatar($td)
})
searchTable(scheme,"products")