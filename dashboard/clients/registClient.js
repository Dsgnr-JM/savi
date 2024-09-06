import Bell from "../../lib/bell.esm.js"
import "../lib/checkInputFile.js"
import "../../lib/showFileInput.js"
import {appendAvatar} from "../lib/createAvatar.js"

const $list = document.querySelectorAll("#avatar")

$list.forEach($td => {
  appendAvatar($td)
})

const message = {
    202:{
        title: "Cliente guardado",
        description: "El cliente fue registrado correctamente"
    },
    1062:{
        title: "No se registro",
        description: "Codigo de producto duplicado"
    }
}

const $form = document.querySelector("#register")
$form.addEventListener("submit",async(e)=>{
    e.preventDefault()
    const $btn = e.submitter
    const formData = new FormData($form)

    const fetching = await fetch(`../api/?slot=client&action=insert`, {
        method: "POST",
        body: formData,
    });
    const data = await fetching.json();

    if (data.result) {
        const bell = new Bell(
            { title: message[202].title, description: message[202].description},
            "success",
            {
                isColored: false,
                position: "top-center",
                typeAnimation: "bound-2",
                timeScreen: 8000,
                expand: true,
            }
        );
        bell.launch();
        $btn.disabled = false
        $form.reset()
    } else {
        const bell = new Bell(
            { title: message[data.description.errorInfo[1]].title, description: message[data.description.errorInfo[1]].description},
            {
                isColored: false,
                position: "top-center",
                typeAnimation: "bound-2",
                timeScreen: 8000,
                expand: true,
            }
        );
        $btn.disabled = false
    }
})