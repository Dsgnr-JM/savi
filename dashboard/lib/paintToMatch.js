/**
 * 
 * @param {String} match 
 * @param {String} value 
 * @returns 
 */
 export default function paintTextMatched(match="",value=""){
    const reg = new RegExp(match,"gi")
    const text = value.match(reg) && value.match(reg)[0]
    return value.replace(reg,`<span class="match">${text}</span>`)
}