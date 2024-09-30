import { $ } from "./lib/dom-selector.js";
// Obtener una referencia al elemento canvas del DOM
const $grafica = document.querySelector("canvas");
const ctx = $grafica.getContext("2d")
/*const $graficaTwo = document.querySelector("#Chart2")*/
const gradient = ctx.createLinearGradient(0,$grafica.getBoundingClientRect().height,0,0)
gradient.addColorStop(1,"#3b9ff6ce")
gradient.addColorStop(0,"#3b9ff61e")
/*const gradient2 = ctx.createLinearGradient(0,$graficaTwo.getBoundingClientRect().height,0,0)
gradient2.addColorStop(1,"#0000003d")
gradient2.addColorStop(0,"#00000009")*/
//Las etiquetas son las que van en el eje X. 
const etiquetas = ["Ene", "Feb", "Mar", "Abr", "May"]
// Podemos tener varios conjuntos de datos. Comencemos con uno
const datosVentas2020 = {
    label: "Ventas por mes",
    data: [20, 50, 30, 30,70], // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
    backgroundColor: gradient, // Color de fondo
    borderColor: 'rgb(26, 135, 224)', // Color del borde
    borderWidth: 2,// Ancho del borde
};
new Chart($grafica, {
    type: 'line',// Tipo de gráfica
    data: {
        labels: etiquetas,
        datasets: [
            datosVentas2020,
        ]
    },
    options: {
        labels:{
            display: false
        },
        scales: {
            x: {
                ticks: {
                    beginAtZero: true
                }
            },
        },
        fill:true
    }
});

const etiquetas2 = ["01", "02", "03", "04", "05","06","07","08"]
// Podemos tener varios conjuntos de datos. Comencemos con uno
/*const datosVentas20202 = {
    label: "Primera semana",
    data: [50,100, 50,50, 100, 30, 100,100], // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
    backgroundColor: gradient2, // Color de fondo
    borderColor: 'transparent', // Color del borde
    borderWidth: 0,// Ancho del borde
};
const datosVentas202022 = {
    label: "Segunda semana",
    data: [30, 10, 50, 30,50,50,50,60], // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
    borderColor: 'rgb(26, 135, 224)', // Color del borde
    backgroundColor: "transparent",
    borderWidth: 2,// Ancho del borde
};
new Chart($graficaTwo, {
    type: 'line',// Tipo de gráfica
    data: {
        labels: etiquetas2,
        datasets: [
            datosVentas202022,
            datosVentas20202,
        ]
    },
    options: {
        labels:{
            display: false
        },
        scales: {
            y: {
                ticks: {
                    beginAtZero: true
                }
            },
        },
        fill:true
    }
});
*/
document.querySelector("#btn-profile").addEventListener("click",() => {
  document.querySelector(".dropdown_profile").classList.toggle("active")
})
