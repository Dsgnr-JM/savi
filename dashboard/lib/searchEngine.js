import getData from "../lib/getData.js"

let interval;
/**
 * @param {String} value
 * @param {String} slot
 * @param {Boolean} isAll
 */
export default function searchEngine(slot,value,isAll,filter=""){
    clearTimeout(interval)
    return new Promise((res,rej)=>{
        interval = setTimeout(async()=>{
            //if(!value) return
            let params = `slot=${slot}&like=${value}`
            if(isAll) params+= `&all=true`
            if(filter) params+= `&filter=${filter}`
            const fetch = await getData(params)
            res(fetch)
        },500)
    })
}