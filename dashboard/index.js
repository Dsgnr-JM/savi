import { $$ } from "./lib/dom-selector.js";

const $charts = $$("#Chart");

$charts.forEach(($chart) => {
  new Chart($chart, {
    type: "bar",
    data: {
      labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
      datasets: [
        {
          label: "# of Votes",
          data: [12, 19, 3, 5, 2, 3],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
});

document.querySelector("#btn-profile").addEventListener("click",() => {
  document.querySelector(".dropdown_profile").classList.toggle("active")
  console.log("hola")
})
