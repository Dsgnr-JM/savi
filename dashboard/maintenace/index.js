import { openDialog, closeDialog } from "../../lib/dialog.js"
import { emailjs } from '../../lib/emailjs.js'

const $btns = document.querySelectorAll("button.card")

$btns.forEach($btn => $btn.addEventListener("click", () => {
    const $dialog = document.querySelector(`#${$btn.dataset.dialog}`)
    openDialog($dialog)
}))

document.querySelector("#contact").querySelector("form").addEventListener("submit", e => {
    e.preventDefault()
    const data = Object.fromEntries(new FormData(e.target))
    data.reply_to = data.email
    let text = e.submitter.textContent
    e.submitter.disabled = true
    e.submitter.textContent = "Enviando..."

    emailjs.init({
        publicKey: "PBV2uL3DJG1Ov0-9C"
    })

    const email = emailjs.send("service_k3usssk", "template_j3n0j85", data).then(() => {
        e.submitter.disabled = false
        e.submitter.textContent = text
        e.target.reset()
    }, (err) => {
        e.submitter.disabled = false
        e.submitter.textContent = text
    })

})
document.querySelector("#export_bd .btn.success").addEventListener("click",()=>{
    alert("has")
})