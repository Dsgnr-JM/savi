import runSwitchs,{switchIsChecked} from '../../lib/switch_form.js'
import getData from '../lib/getData.js'
import Bell from '../../lib/bell.esm.js'

let roleName = 'administrator'

export default function(){
    runSwitchs()
    const $switchs = document.querySelectorAll("input[type='checkbox']")
    const $role = document.querySelector("#role")

    $role.addEventListener("change",async()=>{
        roleName = $role.value
        const formData = new FormData()
        formData.append("role",$role.value)
        const [permissions] = await getData(`slot=role&search=${roleName}`);
        $switchs.forEach($switch => {
            formData.append($switch.name,Number(permissions[$switch.name]))
            $switch.addEventListener("change",async()=>{
                formData.set($switch.name,Number($switch.parentElement.classList.contains("active")))
                handleForm(formData)
            })
            const $switchParent = $switch.parentElement
            switchIsChecked(Boolean(+permissions[$switch.name]),$switchParent)
        })
    })
}

async function handleForm(data) {
    const fetching = await fetch("../api/?slot=role&action=update",{
        method: "POST",
        body: data
    })
    const response = await fetching.json()
    if(response.result){
        new Bell({title:"Permiso actualizado"},"success",{
            position: "top-center",
            typeAnimation: "bound-2",
            removeOn: "click"
        }).launch()
    }else{
        new Bell({title:"No se pudo actualizar"},"error",{
            position: "top-center",
            typeAnimation: "bound-2",
            removeOn: "click"
        }).launch()
    }
}