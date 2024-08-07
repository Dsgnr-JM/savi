export default async function getData(params){
    try{
        const fetching = await fetch(`../api?${params}`)
        const data = await fetching.json();
        return data;
    }catch(e){
        console.log(e)
    }
}