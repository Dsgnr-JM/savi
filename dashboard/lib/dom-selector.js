/**
 * 
 * @param {string} element 
 * @returns HTMLElement
 */
const $ = (element) => document.querySelector(element)
/**
 * 
 * @param {string} element 
 * @returns ListHTMLElement
 */
const $$ = (element) => document.querySelectorAll(element)

export {
    $,
    $$
}