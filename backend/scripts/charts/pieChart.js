//  Pie charts related to company market share

const globalShareEndPoint =
  "/student022/backend/endpoints/charts/chartMarketGlobalShare.php";

const colorPalettePie = {
  blue: "rgba(54, 162, 235, 0.8)",
  red: "rgba(255, 99, 132, 0.8)",
  orange: "rgba(255, 159, 64, 0.8)",
  green: "rgba(75, 192, 192, 0.8)",
  purple: "rgba(153, 102, 255, 0.8)",
  grey: "rgba(128, 128, 128, 0.8)",
};

let pieTitleChart = "Global Market Share & Income";

async function fetchData(urendpointURL) {
  try {
    const response = await fetch(urendpointURL);
    if (!response.ok) {
      console.log("RESPONSE ERROR: " + response.status);
      return null;
    } else {
      const data = await response.json();
      return data;
    }
  } catch (error) {
    console.log("ERROR: " + error);
    return null;
  }
}

async function getChartData(endpointURL) {
  const responseData = await fetchData(endpointURL);

  let labels = [];
  let marketShare = [];
  let incomes = [];

  if (!responseData) {
    console.log("Data not recived");
  } else {
    console.log(responseData);

    responseData.map((e) => {
      labels.push(e.country);
      marketShare.push(e.market_share_percent);
      incomes.push(e.total_income);
    });

    console.log(labels);
    console.log(marketShare);
    console.log(incomes);

    // Render the chart
    renderPieChart(labels, marketShare, incomes);
  }
}

getChartData(globalShareEndPoint);

function renderPieChart(labels, marketShare, incomes) {
  // Tipe of chart
  const ctx = document.getElementById("pieGlobalShareChart").getContext("2d");

  // Chart data
  const pieData = {
    labels: labels,
    datasets: [
      {
        label: "Market Share %",
        data: marketShare,
        backgroundColor: Object.values(colorPalettePie),
        customIncome: incomes,
      },
    ],
  };
  new Chart(ctx, {
    type: "pie",
    data: {
      labels: labels,
      datasets: [
        {
          label: "Market Share %",
          data: marketShare,
          backgroundColor: Object.values(colorPalettePie),
          // Guardamos los ingresos aquí para que el tooltip pueda leerlos
          customIncome: incomes,
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: "top" },
        title: {
          display: true,
          text: pieTitleChart,
        },
        tooltip: {
          callbacks: {
            // Esta es la parte que "dibuja" el contenido del cuadro negro
            label: function (context) {
              const label = context.label || "";
              const value = context.raw || 0; // Porcentaje (12.99)

              // Recuperamos el ingreso usando el índice de la porción actual
              const incomeIndex = context.dataIndex;
              const incomeValue = context.dataset.customIncome[incomeIndex];

              // Formateamos el ingreso como moneda (ej: 1.745.130,98 €)
              const formattedIncome = new Intl.NumberFormat("es-ES", {
                style: "currency",
                currency: "EUR",
              }).format(incomeValue);

              return `${label}: ${value}% (Ingresos: ${formattedIncome})`;
            },
          },
        },
      },
    },
  });
}
