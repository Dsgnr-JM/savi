const $btnOptionsTable = document.querySelector("button.more")
let showBtn = false;

$btnOptionsTable.addEventListener("click",e=>{
    if(e.target.dataset.show !== "show") return
    $btnOptionsTable.classList.toggle("active")
    showBtn = !showBtn
    const $icon = $btnOptionsTable.querySelector("i")
    if(showBtn){
        $icon.classList.remove("ri-more-2-fill")
        $icon.classList.add("ri-close-fill")
    }else{
        $icon.classList.remove("ri-close-fill")
        $icon.classList.add("ri-more-2-fill")

    }
})