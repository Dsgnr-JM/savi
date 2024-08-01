(()=>{

    const $inputFile = document.querySelector("input[type='file']")
    const $labelFile = document.querySelector(".inputFile")
    const typeValid = ['image/png', 'image/webp']

    $inputFile.addEventListener("change", e => {
        let file = $inputFile.files[0]
        if(file){
            if (!typeValid.includes(file.type)) {
              $labelFile.classList.add("wrong")
              $inputFile.value = ''; // Limpia el campo de entrada
              return false;
            }
        }
        $labelFile.classList.remove("wrong")
        const url = URL.createObjectURL(file)
        const $before = window.getComputedStyle($labelFile, "::before")
        $labelFile.style.background = `url(${url}`
        $labelFile.querySelector(".presentation").style.opacity = "0"
    })

})()