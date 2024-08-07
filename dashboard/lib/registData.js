import Bell from "../../lib/bell.js"

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
    console.log(data)
    if (data.result) {
        const bell = new Bell(
            { title: message[202].title, description: message[202].description},
            "check",
            {
                animate: true,
                isColored: true,
                transitionDuration: 300,
                position: "bottom-right",
                typeAnimation: "fade-in",
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
                animate: true,
                isColored: true,
                transitionDuration: 300,
                position: "bottom-right",
                typeAnimation: "fade-in",
                timeScreen: 8000,
                expand: true,
            }
        );
        bell.launch()
        $btn.disabled = false
    }
}