export const dolarPrice = document.querySelector("#dolarPrice").value

export let conversion = true;

export function cleanPrice(convert, num){
    return Number(convert ? num * dolarPrice : num).toFixed(2)
}