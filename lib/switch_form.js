export default function runSwitchs(){
    const $switchs = document.querySelectorAll("#switch")
    
    $switchs.forEach($switch => {
        const $switchParent = $switch.parentElement
        if($switch.checked) $switchParent.classList.add("active")
        $switch.addEventListener("click",()=>{
            console.log()
            if($switchParent.classList.contains("active")){
                $switchParent.classList.remove("active")
            }else{
                $switchParent.classList.add("active")
            }
        })
    })

}
