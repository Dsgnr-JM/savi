if (true) {
    const msgResult = {
        updatePersonal:{
            title: "Datos actualizados",
            description: "Nombre u apellido actualizado correctamente"
        },
        updatePassword:{
            title: "Datos actualizados",
            description: "Contraseña cambiada correctamente"
        },
    }
    const $forms = document.querySelectorAll("form")

    $forms.forEach($form => {
        $form.addEventListener("submit", async (e) => {
            e.preventDefault()
            const formData = new FormData(e.target)
            const $btn = e.submitter
            $btn.disabled = true
            formData.append("ci", document.querySelector("input[type='hidden']").value)
            const action = e.target.getAttribute("data-action")
            const fetching = await fetch(`../api/?slot=profile&action=${action}`, {
                method: "POST",
                body: formData,
            });
            const data = await fetching.text();
            console.log(data)

            if (data.result) {
                const bell = new Bell(
                    { title: msgResult[action].title, description: msgResult[action].description},
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
            } else {
                const bell = new Bell(
                    { title: "Algo anda mal", description: "Hubo un error en su operacion" },
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
                $btn.disabled = false
            }
        })
    }) 
}