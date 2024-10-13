import '../../lib/showFileInput.js'
import {$} from '../lib/dom-selector.js'
import registData from '../lib/registData.js'
import checkInputFile from '../lib/checkInputFile.js'

const $form = $("form")
const $inputKey = $("form input[name='rif']")
checkInputFile()

const message = {
    202:{
        title: "Proveedor registrado",
    },
    1062:{
        title: "Este proveedor: {{id}} ya existe",
    }
}

$form.addEventListener("submit",handleSubmit)

/**
 * 
 * @param {Event} e 
 */
async function handleSubmit(e) {
    message[1062].title = message[1062].title.replace("{{id}}",$inputKey.value)
    e.preventDefault()
    const $btn = e.submitter
    registData("slot=supplier&action=insert",$form,$btn,message);
}