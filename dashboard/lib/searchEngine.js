import getData from "../lib/getData.js"

let interval;
/**
 * @param {String} value
 * @param {String} slot
 */
export default function searchEngine(slot,value){
    clearTimeout(interval)
     interval = setTimeout(async()=>{
        console.log(`slot=${slot}&like=${value}`)
        const fetch = await getData(`slot=${slot}&search=${value}`)
        console.log(fetch)
    },1000)
}