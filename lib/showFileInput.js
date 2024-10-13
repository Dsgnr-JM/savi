const $btnShowInputFile = document.getElementById("setFile")
const $fileContainer = document.querySelector(".inputFile")
const $inputFile = document.getElementById("inputFile")
const $btnShowInputEnterprise = document.getElementById("setShowInput")

if($btnShowInputEnterprise){
    const $enterpriseContainer = document.querySelector(".input-enterprise")
    const $name = document.getElementById("name")
    const $surname = document.getElementById("surname")
    const $dni = document.getElementById("dni")
    $btnShowInputEnterprise.addEventListener("change",()=>{
        $enterpriseContainer.classList.toggle("active")
        if($btnShowInputEnterprise.checked){
            $name.textContent = "Nombre de encargado"
            $surname.textContent = "Apellido de encargado"
            $dni.textContent = "Rif"
        }else{
            $name.textContent = "Nombre:"
            $surname.textContent = "Apellido:"
            $dni.textContent = "CI:"
            $enterpriseContainer.querySelector("input").value = "";
        }
    })
}
if($btnShowInputFile){
    $btnShowInputFile.addEventListener("change",()=>{
        $fileContainer.classList.toggle("active")
        if(!$btnShowInputFile.checked){
            $inputFile.value = ""
        }
    
    })
}