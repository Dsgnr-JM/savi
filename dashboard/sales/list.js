import paginationTable from "../lib/paginationTable.js"
import searchTable from "../lib/searchTables.js"
import "../lib/showOptions.js"
import { viewsTables } from "../lib/tableEvents.js"

const scheme = ["nro_factura","client","total","payment","status","date",["view","edit","delete"]]
paginationTable("sales",scheme)
searchTable(scheme,"sales")
viewsTables()