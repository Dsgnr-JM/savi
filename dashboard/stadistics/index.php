<?php require "../ui/header.php" ?>
<title>Estadisticas - Inv.Refrihogar</title>
<link rel="stylesheet" href="index.css">
</head>

<body>
    <?php include '../ui/navbar.php' ?>
    <section>
        <header class="description">
            <i class="ri-pie-chart-fill"></i>
            <div>
                <h1>Estadisticas</h1>
                <p><i class="ri-information-fill"></i>Esta es el area de visualizacion de estadisticas</p>
            </div>
        </header>
        <div class="stadistics">
        <canvas id="bar-chart"></canvas>
        <canvas id="line-chart"></canvas>
        <canvas id="pie-chart"></canvas>
        <canvas id="doughnut-chart"></canvas>
        <canvas id="bar-chart-grouped" width="800" height="450"></canvas>
        </div>
        <script src="../lib/chart.js"></script>
        <script>
            new Chart(document.getElementById("bar-chart"), {
                type: 'bar',
                data: {
                    labels: ["Tornillo KFC", "Manguera doble", "Disco de corte", "Villa XS", "Tuerca Mistic"],
                    datasets: [{
                        label: "Mas vendido",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                        data: [2478, 5267, 734, 784, 433]
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Mejores ventas(clientes)'
                    }
                }
            });
            new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
    labels: [2020,2021,2022,2023,2024],
    datasets: [{ 
        data: [10,30,106,106,107],
        label: "Jota",
        borderColor: "#3e95cd",
        fill: false
      }, { 
        data: [20,50,411,502,635],
        label: "Midu",
        borderColor: "#8e5ea2",
        fill: false
      }, { 
        data: [2,1,10,190,203],
        label: "Fazt",
        borderColor: "#3cba9f",
        fill: false
      }, { 
        data: [6,2,4,16,24],
        label: "Falcon",
        borderColor: "#e8c3b9",
        fill: false
      }, { 
        data: [6,3,2,402,7],
        label: "Hector",
        borderColor: "#c45850",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'Mejores clientes'
    }
  }
});
            new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
      labels: ["Disco american", "Cable UTP", "Pilas Dv", "Motor Trifasico", "Cable simple dual"],
      datasets: [{
        label: "Mas costosos",
        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
        data: [2478,5267,734,784,433]
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Mas costosos'
      }
    }
});
            new Chart(document.getElementById("doughnut-chart"), {
    type: 'doughnut',
    data: {
      labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
      datasets: [
        {
          label: "Population (millions)",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: [2478,5267,734,784,433]
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Predicted world population (millions) in 2050'
      }
    }
});
            new Chart(document.getElementById("bar-chart-grouped"), {
    type: 'bar',
    data: {
      labels: ["1900", "1950", "1999", "2050"],
      datasets: [
        {
          label: "Africa",
          backgroundColor: "#3e95cd",
          data: [133,221,783,2478]
        }, {
          label: "Europe",
          backgroundColor: "#8e5ea2",
          data: [408,547,675,734]
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Population growth (millions)'
      }
    }
});
        </script>
    </section>
</body>