export default function runSwitchs(){
    const $switchs = document.querySelectorAll("#switch")
    
    $switchs.forEach($switch => {
        const $switchParent = $switch.parentElement
        switchIsChecked($switch.checked,$switchParent)
        $switch.addEventListener("click",()=>{
            if($switchParent.classList.contains("active")){
                $switchParent.classList.remove("active")
            }else{
                $switchParent.classList.add("active")
            }
        })
    })
}
/**
 * 
 * @param {Boolean} checked 
 * @param {HTMLLabelElement} $parent
 */
export function switchIsChecked(checked,$parent){
    if(checked) {
        $parent.classList.add("active")
    }else{
        $parent.classList.remove("active")
    }
}