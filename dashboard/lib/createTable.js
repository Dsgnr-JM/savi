import { appendAvatar } from "./createAvatar.js"
import paintTextMatched from "../lib/paintToMatch.js"
import { viewsTables,isRemoved } from "./tableEvents.js"

const translations = {
    complete: "completa",
    pending: "pendiente"
}
const actions = {
    edit: {
        class: "edit",
        icon: "ri-edit-line",
        tooltip: "Editar"
    },
    delete: {
        class: "delete",
        icon: "ri-delete-bin-6-line",
        tooltip: "Borrar"
    },
    view: {
        class: "subtract",
        icon: "ri-eye-line",
        tooltip: "Ver"
    },
    recovery:{
        class: "recovery",
        icon: "ri-arrow-turn-forward-line",
        tooltip: "Recuperar"
    }
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
            }else if(typeof schemeItem == "object"){
                $td.setAttribute(`data-${schemeData[0]}`,item[schemeData[0]])
                const $div = document.createElement("div")
                $div.classList.add("actions")
                if(Boolean(isRemoved)) schemeItem = ['recovery']
                schemeItem.forEach(action => {
                    let {class: type,icon,tooltip} = actions[action]
                    const $btn = document.createElement("button")
                    $btn.ariaLabel = tooltip
                    $btn.dataset.balloonPos = "up"
                    $btn.classList.add(type)
                    const $icon = document.createElement("i")
                    $icon.classList.add(icon)
                    $btn.appendChild($icon)
                    $div.appendChild($btn)
                });
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
    const $btnsView = childs.map(i => i.querySelector(".subtract")).filter(i => i)
    const $btnsEdit = childs.map(i => i.querySelector(".edit")).filter(i => i)
    const $btnsDelete = childs.map(i => i.querySelector(".delete")).filter(i => i)
    const $btnsRecovery = childs.map(i => i.querySelector(".recovery")).filter(i => i)
    viewsTables($btnsView,$btnsEdit,$btnsDelete,$btnsRecovery)
    return childs
}

export function createSkeleton(){

}