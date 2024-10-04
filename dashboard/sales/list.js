import paginationTable from "../lib/paginationTable.js"
import searchTable from "../lib/searchTables.js"
import "../lib/showOptions.js"

const scheme = ["nro_factura","client","total","payment","status","date","actions"]
paginationTable("sales",scheme)
searchTable(scheme,"sales")