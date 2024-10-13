import Bell from '../../lib/bell.esm.js'

export default function(){
    const $formConversion = document.querySelector("#form_conversion")
    $formConversion.addEventListener("submit",e=>{
        e.preventDefault()
        const $btn = e.submitter
        $btn.disabled = true
        const data = new FormData($formConversion);
        handleForm(data,$btn)
    })
}

/**
 * 
 * @param {FormData} data 
 * @param {HTMLButtonElement} $btn
 */
async function handleForm(data, $btn) {
    const fetching = await fetch("../api/?slot=config&action=update",{
        method: "POST",
        body: data
    })
    const response = await fetching.json()
    if(response.result){
        new Bell({title:"Precio del dolar actualizado"},"success",{
            position: "top-center",
            typeAnimation: "bound-2",
            theme: "light",
            removeOn: "click"
        }).launch()
        $btn.disabled = false
    }else{
        new Bell({title:"No se pudo actualizar"},"error",{
            position: "top-center",
            typeAnimation: "bound-2",
            theme: "light",
            removeOn: "click"
        }).launch()
    }
}