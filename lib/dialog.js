/**
 * 
 * @param {HTMLElement} dialog 
 */
export function openDialog(dialog){
    dialog.classList.add("active")
    dialog.querySelector("button.cancel")?.addEventListener("click",()=>closeDialog(dialog),{once:true})
    const $bgDialog = document.querySelector(".bg_dialog")
    $bgDialog.classList.add("active")
    $bgDialog.addEventListener("click",() =>closeDialog(dialog),{once:true})
}
export function closeDialog(dialog){
    //const $formDialog = dialog.querySelector("form")
    //if($formDialog) $formDialog.reset()
    dialog.classList.remove("active")
    document.querySelector(".bg_dialog").classList.remove("active")
}