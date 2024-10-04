const $btnOptionsTable = document.querySelector("button.more")
let showBtn = false;

$btnOptionsTable.addEventListener("click",e=>{
    if(e.target.dataset.show !== "show") return
    $btnOptionsTable.classList.toggle("active")
    showBtn = !showBtn
    const $icon = $btnOptionsTable.querySelector("i")
    if(showBtn){
        $icon.classList.remove("ri-more-2-line")
        $icon.classList.add("ri-close-line")
    }else{
        $icon.classList.remove("ri-close-line")
        $icon.classList.add("ri-more-2-line")

    }
})