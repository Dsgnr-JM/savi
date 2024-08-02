const colorsAvatar = {
    "A": "#108953",
    "B": "#9214042",
    "C": "#a95e11",
    "D": "#132359",
    "E": "#106174",
    "F": "#412430",
    "G": "#98A719",
    "H": "#600631",
    "I": "#164133",
    "J": "#163031",
    "K": "#138163",
    "L": "#117688",
    "M": "#154716",
    "N": "#199386",
    "O": "#155977",
    "P": "#136300",
    "Q": "#124849",
    "R": "#148313",
    "S": "#149876",
    "T": "#107882",
    "U": "#818492",
    "V": "#143838",
    "W": "#119285",
    "X": "#120071",
    "Y": "#178365",
    "Z": "#133868",
}


/**
 * @param {String} text
 **/
function createAvatar(text){
    const container = document.createElement("span")
    container.textContent = text
    container.classList.add("avatar")
    container.style.background = colorsAvatar[text]
    return container
}

/**
 * @param {HTMLElement} element
 * */
function appendAvatar(element) {
    const avatarText = element.getAttribute("data-avatar")
    const avatar = createAvatar(avatarText)
    element.appendChild(avatar)
}

