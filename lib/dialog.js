/**
 * 
 * @param {HTMLElement} dialog 
 */
export function openDialog(dialog){
    dialog.classList.add("active")
    dialog.querySelector("button.cancel").addEventListener("click",()=>closeDialog(dialog),{once:true})
    document.querySelector(".bg_dialog").classList.add("active")
}
export function closeDialog(dialog){
    //const $formDialog = dialog.querySelector("form")
    //if($formDialog) $formDialog.reset()
    dialog.classList.remove("active")
    document.querySelector(".bg_dialog").classList.remove("active")
}