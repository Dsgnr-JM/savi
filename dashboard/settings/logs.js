import getData from '../lib/getData.js';
let index = 2;
let $btnMoreLogs = document.querySelector("#view-more")
let $containerLogs = document.querySelector("#container_logs")

export default async function(){
    index = 2
    $btnMoreLogs = document.querySelector("#view-more")
    $containerLogs = document.querySelector("#container_logs")
    if(!$btnMoreLogs) return
    const {data,length} = await getData(`slot=logs&page=${index}`);
    $btnMoreLogs.addEventListener("click",()=>{
        createLogs(data,length)
    })
}
/**
 * 
 * @param {Array} data 
 */
function createLogs(data,length){
    data.forEach(item => {
        const log = `
            <li>
                <i class="ri-notification-3-line"></i>
                <div class="details">
                    <p>${item.message}.</p>
                    <p>${item.date}</p>
                    <span class="badge info">Accion realizada por el usuario ${item.user}</span>
                </div>
            </li>
        `
        $containerLogs.innerHTML += log
    });
    if(length <= index ) {
        $btnMoreLogs.remove()
        return
    }
    index++

}