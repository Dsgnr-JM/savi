import Bell from '../../lib/bell.esm.js'
import checkInputFile from '../lib/checkInputFile.js'

export default function () {
    checkInputFile()
    const msgResult = {
        updatePersonal: {
            title: "Nombre y Apellido actualizado",
            description: "Nombre u apellido actualizado correctamente"
        },
        updatePassword: {
            title: "Contraseña cambiada",
            description: "Contraseña cambiada correctamente"
        },
        updateAditional: {
            title: "Información actualizada",
            description: "Informacion cambiada correctamente"
        }
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
            const data = await fetching.json();

            if (data.result) {
                const bell = new Bell(
                    { title: msgResult[action].title},
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
            } else {
                const bell = new Bell(
                    { title: "Algo anda mal", description: "Hubo un error en su operacion" },
                    "warning",
                    {
                        position: "top-center",
                        typeAnimation: "bound-2",
                        theme: "light",
                        timeScreen: 8000,
                        expand: true,
                    }
                );
                bell.launch()
                $btn.disabled = false
            }
        })
    })
}