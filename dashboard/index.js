import { $ } from "./lib/dom-selector.js";
// Obtener una referencia al elemento canvas del DOM
const $grafica = document.querySelector("canvas");
const ctx = $grafica.getContext("2d")
const gradient = ctx.createLinearGradient(0,$grafica.getBoundingClientRect().height,0,0)
gradient.addColorStop(.8,"#2586ccd0")
gradient.addColorStop(0,"#2586cc36")
// Las etiquetas son las que van en el eje X. 
const etiquetas = ["Ene", "Feb", "Mar", "Abr","May","Jun","Jul","Ago","Sep"]
// Podemos tener varios conjuntos de datos. Comencemos con uno
const datosVentas2020 = {
    label: "Ventas por mes",
    data: [90, 110, 30, 70,20,30,100,90,110,110,0], // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
    backgroundColor: gradient, // Color de fondo
    borderColor: '#11557e', // Color del borde
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

document.querySelector("#btn-profile").addEventListener("click",() => {
  document.querySelector(".dropdown_profile").classList.toggle("active")
  console.log("hola")
})
