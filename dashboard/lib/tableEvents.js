import {$,$$} from '../lib/dom-selector.js';
import getData from './getData.js'
import { openDialog, closeDialog } from "../../lib/dialog.js"
import paginationTable, {actualNum,slotActual,schemeDataActual, updatePagination} from './paginationTable.js'
import "../../lib/showFileInput.js"
import {searchActual} from './searchTables.js'
import { createTable } from './createTable.js';
import Bell from '../../lib/bell.esm.js'
const $dialogEdit = document.querySelector(".dialog#edit")
const $formEdit = $dialogEdit.querySelector("form")
const $table = $("tbody")
const {slot} = $table.dataset
export const isRemoved = typeof new URLSearchParams(window.location.search).get("isRemoved") == "string" ? "isRemoved" : ""
 
$dialogEdit.querySelector("button.cancel").addEventListener("click",()=>{
    $formEdit.reset()
})
$formEdit.addEventListener("submit",e=>{
    e.preventDefault()
    updateData($formEdit,slot)
})
export function viewsTables(childView,childEdit,childDelete,childRecovery) {
    const $allBtnsView = Boolean(childView?.length) ? childView : $$(".subtract")
    const $allBtnsEdit = Boolean(childEdit?.length) ? childEdit : $$(".edit")
    const $allBtnsDelete = Boolean(childDelete?.length) ? childDelete : $$(".delete")
    const $allBtnsRecovery = Boolean(childRecovery?.length) ? childRecovery : $$(".recovery")
    console.log($allBtnsDelete,$allBtnsEdit,$allBtnsView,$allBtnsView)
    $allBtnsView?.forEach($btnView => $btnView.addEventListener("click",handleView));
    $allBtnsEdit?.forEach($btnEdit =>$btnEdit.addEventListener("click",handleEdit));
    $allBtnsDelete?.forEach($btnDelete => $btnDelete.addEventListener("click", handleDelete))
    $allBtnsRecovery?.forEach($btnDelete => $btnDelete.addEventListener("click", handleRecovery))
}

export function handleView(e) {
    const {code,dni} = e.target.closest("td").dataset
    window.location.href = `?place=info&view=${code ?? dni}`
}
export async function handleEdit({target}){
    $formEdit.reset()
    const {code,dni,nro_factura} = target.closest("td").dataset
    console.log(code,dni,nro_factura)
    const [data] = await getData(`slot=${slot}&search=${code ?? dni ?? nro_factura}`)
    const $key = $formEdit.querySelector("input[name='key']")
    $key.value = data.code ?? data.dni ?? data.rif ?? data.category_id ?? data.ci ?? data.nro_factura
    Object.entries(data).forEach(item => {
        let [key,value] = item
        if(key == "total" || key =="payment") value = Number(value).toFixed(2)
        let $input = $formEdit.querySelector(`input[name="${key}"],select[name="${key}"]`)
        if(!$input) return
        if($input.type == "file") return//addImageToInput($input,value)
        else $input.value = value
    })
    openDialog($dialogEdit)
}
export async function updateData($form,slot){
    const data = new FormData($form)
    const fetching = await fetch(`../api/?action=update&slot=${slot}`,{
        method: "POST",
        body: data
    })
    const result = await fetching.text()
    console.log(result)
    if(result.result){
        new Bell({title:"Producto actualizado"},"success",{
            theme: "light",
            position: "top-center"
        }).launch()
    }else{
        new Bell({title:"Hubo un error"},"error",{
            theme: "light",
            position: "top-center"
        }).launch()
    }
    updateTable()
}

async function handleDelete({target}) {
    const {code,dni,rif} = target.closest("td").dataset
    const {slot} = target.closest("tbody").dataset
    const formData = new FormData()
    formData.set("key",code ?? dni ?? rif)
    const fetching = await fetch(`../api/?slot=${slot}&action=delete`,{
        method: "POST",
        body: formData
    })
    const data = await fetching.json()
    console.log(data)
    updateTable()
}

async function handleRecovery({target}) {
    const {code,dni,rif} = target.closest("td").dataset
    const {slot} = target.closest("tbody").dataset
    const formData = new FormData()
    formData.set("key",code ?? dni ?? rif)
    const fetching = await fetch(`../api/?slot=${slot}&action=recovery`,{
        method: "POST",
        body: formData
    })
    const data = await fetching.text()
    console.log(data)
    updateTable()
}

async function updateTable() {
    
    let url = `page=${actualNum}&slot=${slotActual}&${isRemoved}`
    let params = (searchActual ? `&like=${searchActual}` : "")
    const {data,length} = await getData(url+params)
    $table.innerHTML = ""
    $table.append(...createTable(data,schemeDataActual,searchActual))
    updatePagination(length,slotActual+params,schemeDataActual,actualNum)
}