const $btnShowInputFile = document.getElementById("setFile")
const $fileContainer = document.querySelector(".inputFile")
const $inputFile = document.getElementById("inputFile")
const $btnShowInputEnterprise = document.getElementById("setShowInput")

if($btnShowInputEnterprise){
    const $enterpriseContainer = document.querySelector(".input-enterprise")
    const $name = document.getElementById("name")
    const $surname = document.getElementById("surname")
    const $dni = document.getElementById("dni")
    $btnShowInputEnterprise.addEventListener("click",()=>{
        if($btnShowInputEnterprise.checked){
            $enterpriseContainer.classList.add("active")
            $name.textContent = "Nombre de encargado"
            $surname.textContent = "Apellido de encargado"
            $dni.textContent = "Rif"
        }
    })
}

$btnShowInputFile.addEventListener("click",()=>{
    if($btnShowInputFile.checked){
        $fileContainer.classList.add("active")
    }
})

$inputFile.addEventListener("change",(e)=>{
    console.log($inputFile.files)
})