import Bell from "../../lib/bell.esm.js"

/**
 * 
 * @param {String} params 
 * @param {HTMLFormElement} $form 
 * @param {HTMLButtonElement} $btn 
 * @param {Array} message 
 */
export default async function registData(params, $form, $btn, message){

    const formData = new FormData($form);

    const fetching = await fetch(`../api/?${params}`, {
        method: "POST",
        body: formData,
    });
    const data = await fetching.json();
    if (data.result) {
        const bell = new Bell(
            { title: message[202].title, description: message[202].description},
            "success",
            {
                position: "top-center",
                theme: "light",
                typeAnimation: "bound-2",
                timeScreen: 8000,
                expand: true,
            }
        );
        bell.launch();
        $btn.disabled = false
        $form.reset()
    }
    else {
        const bell = new Bell(
            { title: message[data.description.errorInfo[1]].title, description: message[data.description.errorInfo[1]].description },
            "warning",
            {
                position: "top-center",
                theme: "light",       
                typeAnimation: "bound-2",
                timeScreen: 8000,
                expand: true,
            }
        );
        bell.launch()
        $btn.disabled = false
    }
}