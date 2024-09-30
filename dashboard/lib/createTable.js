import { appendAvatar } from "./createAvatar.js"
import paintTextMatched from "../lib/paintToMatch.js"

const translations = {
    complete: "completa",
    pending: "pendiente"
}

/**
 * 
 * @param {Array} data 
 * @param {Array} schemeData 
 * @returns 
 */

export function createTable(data, schemeData,match=""){
    
    const childs = []
    
    for(let item of data){
        const $tr = document.createElement("tr")
        for(let schemeItem of schemeData){
            const $td = document.createElement("td")
            if(schemeItem == "image" || schemeItem == "photo"){
                if(item[schemeItem] !== ""){
                    const $img = document.createElement("img")
                    $img.src = item[schemeItem]
                    $td.appendChild($img)
                    //$td.classList.add("inactive")
                }else{
                    $td.id = "avatar"
                    //$td.classList.add("active")
                    $td.setAttribute("data-avatar", item["name"].substring(0,1))
                    appendAvatar($td)
                }
            }else if(schemeItem == "actions"){
                $td.setAttribute(`data-${schemeData[0]}`,item[schemeData[0]])
                const $div = document.createElement("div")
                $div.classList.add("actions")
                const $btnEdit = document.createElement("button")
                const $btnDelete = document.createElement("button")
                $btnEdit.classList.add("btn-square","edit")
                $btnDelete.classList.add("btn-square","delete")
                const $iEdit = document.createElement("i")
                const $iDelete = document.createElement("i")
                $iEdit.classList.add("ri-edit-line")
                $iDelete.classList.add("ri-delete-bin-6-line")
                $btnDelete.appendChild($iDelete)
                $btnEdit.appendChild($iEdit)
                $div.append($btnEdit, $btnDelete)
                $td.appendChild($div)
            }else if(schemeItem == "status"){
                const $badge = document.createElement("span")
                $badge.classList.add(item[schemeItem],"badge")
                $badge.textContent = translations[item[schemeItem]]
                $td.appendChild($badge)
            }
            else{
                let text = schemeItem === "name" ?
                `${item["name"]} ${item["surname"] ?? ""}` :
                schemeItem == "purchase_price" || schemeItem == "selling_price" || schemeItem == "payment" || schemeItem == "total" ?
                 `$ ${Number(item[schemeItem]).toFixed(2)}` : item[schemeItem]
                if(schemeItem == "enterprise_name" && !item[schemeItem]){
                    $td.classList.add("value-null")
                }else{
                    $td.innerHTML = paintTextMatched(match,text)
                }
            }

            $tr.appendChild($td)
        }
        childs.push($tr)
    }
    return childs
}

export function createSkeleton(){

}