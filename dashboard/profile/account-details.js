import Bell from '../../lib/bell.esm.js'
import checkInputFile from '../lib/checkInputFile.js'

export default function () {
    checkInputFile()
    const msgResult = {
        updatePersonal: {
            title: "Datos actualizados",
            description: "Nombre u apellido actualizado correctamente"
        },
        updatePassword: {
            title: "Datos actualizados",
            description: "Contraseña cambiada correctamente"
        },
        updateAditional: {
            title: "Datos actualizados",
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
                    { title: msgResult[action].title, description: msgResult[action].description },
                    "success",
                    {
                        isColored: false,
                        position: "top-center",
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
                        isColored: false,
                        position: "top-center",
                        typeAnimation: "bound-2",
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