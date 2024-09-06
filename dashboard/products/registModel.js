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
        title: "Modelo registrado",
        description: "El modelo fue registrado"
    },
    1062:{
        title: "No se registro",
        description: "Codigo del modelo duplicado"
    }
}

$form.addEventListener("submit",(e)=>{
    e.preventDefault()
    const $btn = e.submitter
    registData("slot=model&action=insert",$form,$btn,message);
})