const rgx = {
    text: /[a-z]/gi,
    numbers: /[0-9]/g,
    textAndNumbers: /[a-z0-9]/gi,
    all: /[a-zA-Z0-9@#$.&*]/g
}
let wrong = 0;

const inputsTypeValidate = {
    ci: rgx.numbers,
    name: rgx.text,
    surname: rgx.text,
    username: rgx.textAndNumbers,
    phone: rgx.numbers,
    password: rgx.all
}

/**
 * @param {HTMLInputElement} input
 * @param {Boolen} block
 * */
export default function validatedInput(input, block) {
    const value = input.value.replaceAll(" ", "")
    const length = input.getAttribute("data-length") ?? 0
    const type = inputsTypeValidate[input.name] ?? rgx.textAndNumbers

    if (![...document.querySelectorAll("input")].every(item => item.getAttribute("data-checked"))) {
        [...document.querySelector("input").form.childNodes].find(item => item.localName == "button").disabled = true
    }
    if ((value.match(type)?.length ?? 0) < value.length || value.length < length) {
        input.classList.add("wrong");
        input.setAttribute("data-checked", true);
        [...document.querySelector("input").form.childNodes].find(item => item.localName == "button").disabled = true
        return
    }
    input.classList.remove("wrong")
    input.setAttribute("data-checked", true)

    if ([...document.querySelectorAll("input")].every(item => item.getAttribute("data-checked"))) {
        [...document.querySelector("input").form.childNodes].find(item => item.localName == "button").disabled = false
    }
}
