//import "../lib/checkInputFile.js"
//import "../../lib/showFileInput.js"
import registData from "../lib/registData.js"
/*import {appendAvatar} from "../lib/createAvatar.js"

const $list = document.querySelectorAll("#avatar")

$list.forEach($td => {
  appendAvatar($td)
})*/

const $form = document.querySelector("#register")

const message = {
    202:{
        title: "Categoria registrada",
        description: "La categoria fue registrada"
    },
    1062:{
        title: "No se registro",
        description: "Nobre de categoria duplicado"
    }
}

$form.addEventListener("submit",(e)=>{
    e.preventDefault()
    const $btn = e.submitter
    registData("slot=category&action=insert",$form,$btn,message);
})