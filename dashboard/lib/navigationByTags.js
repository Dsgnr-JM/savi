const $navigationBtn = document.querySelectorAll("button[data-slot-pointed]")
const $contentContainer = document.querySelector("#contentContainer")
const $navigation = document.querySelector(".navigation")

let actualSlot = $navigationBtn[0].getAttribute("data-slot-pointed")
const dependeciesTransitive = $navigationBtn[0].getAttribute("data-dependecies-transitive").split(" ")

dependeciesTransitive.forEach(dependecie => {
    appendScript(dependecie, "../lib/")
})
appendScript(actualSlot)
drawSlot(actualSlot, true)

let first = true

$navigation.style.setProperty("--width-line", `${$navigationBtn[0].offsetWidth}px`)
$navigation.style.setProperty("--left-position-line", `${$navigationBtn[0].offsetLeft}px`)

$navigationBtn.forEach($btn => {
    $btn.addEventListener("click",()=>{
        const slotPointed = $btn.getAttribute("data-slot-pointed")
        let dependecies = $btn.getAttribute("data-dependecies-transitive")

        if(dependecies){
            dependecies = dependecies.split(" ")
            dependecies.forEach(dependecie => appendScript(dependecie, "../lib/"))
        }

        for(let $btnClone of $navigationBtn){
            $btnClone.classList.remove("active")
            if($btnClone == $btn){
                $btn.classList.add("active")
                $navigation.style.setProperty("--width-line", `${$btn.offsetWidth}px`)
                $navigation.style.setProperty("--left-position-line", `${$btn.offsetLeft}px`)
            }
        }
        if(slotPointed == actualSlot && !first) return

        first = false

        appendScript(slotPointed)
        drawSlot(slotPointed)

    })
})

function appendScript(dependencie, isLib){
    if(dependencie){
        const url = isLib ? isLib : ""
        document.querySelectorAll("script[data-dependecies]").forEach(item => {
            item.remove()
        })
        const script = document.createElement("script")
        script.setAttribute("data-dependecies", "true")
        script.src = url + dependencie + ".js"
        document.body.appendChild(script)
        actualDependencie = dependencie
    }

}

function drawSlot(slot, first){
    const template = document.getElementById(slot)
    const templateClone = document.importNode(template.content, true)
    actualSlot = slot

    $contentContainer.innerHTML = ""
    $contentContainer.appendChild(templateClone)

}
