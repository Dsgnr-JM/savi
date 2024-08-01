function createPasswordIcon(){

    const $passwordInput = document.querySelector("input[type='password']")
    const $iconPassword = document.createElement("i")

    $iconPassword.classList.add("ri-eye-line")
    $iconPassword.style.right = "0"
    $iconPassword.style.cursor = "pointer"
    $iconPassword.style.marginRight = "8px"

    $passwordInput.parentElement.appendChild($iconPassword)

    $iconPassword.addEventListener("click",() => {
        if($passwordInput.type === "text"){
            $passwordInput.type = "password"
            $iconPassword.classList.remove("ri-eye-close-line")
            $iconPassword.classList.add("ri-eye-line")
        }else{
            $passwordInput.type = "text"
            $iconPassword.classList.remove("ri-eye-line")
            $iconPassword.classList.add("ri-eye-close-line")
        }
    })
    
}
createPasswordIcon()