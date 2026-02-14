// Endpoint para los ingresos por país
const dataUrlEndpointCountry = "/student022/backend/endpoints/charts/chartCountryIncome.php";

const colorPaletteCountry = {
  blue: "rgba(54, 162, 235, 0.8)",
  red: "rgba(255, 99, 132, 0.8)",
  orange: "rgba(255, 159, 64, 0.8)",
  green: "rgba(75, 192, 192, 0.8)",
  purple: "rgba(153, 102, 255, 0.8)",
  grey: "rgba(128, 128, 128, 0.8)"
};

let titleChartCountry = "Total Income per Country";

async function fetchData(endpointURL) {
  try {
    const response = await fetch(endpointURL);
    if (!response.ok) {
      console.log("RESPONSE ERROR:" + response.status);
      return null;
    } else {
      const data = await response.json();
      return data;
    }
  } catch (error) {
    console.log("ERROR:" + error);
    return null;
  }
}

async function getCountryChartData(endpointURL) {
  const responseData = await fetchData(endpointURL);
  
  if (responseData) {
    // Extrac name
    let xValues = [];
    let yValues = [];
    let fieldsColors = [];
    let lastValue = 0;

    // Iterate key-value
    responseData.forEach((item, index) => {
      const country = item.country;
      const income = parseFloat(item.total_income);

      xValues.push(country);
      yValues.push(income);

      // Comparation Logic
      if (index === 0) {
        fieldsColors.push(colorPaletteCountry.blue); // Neutral
      } else if (income > lastValue) {
        fieldsColors.push(colorPaletteCountry.green); // Higher than the last
      } else if (income < lastValue) {
        fieldsColors.push(colorPaletteCountry.red);   // Lower than the last
      } else {
        fieldsColors.push(colorPaletteCountry.grey);  // Equal
      }

      lastValue = income;
    });

    renderCountryChart(xValues, yValues, fieldsColors);
  } else {
    console.log("Data not received for Country Chart");
  }
}

function renderCountryChart(xValues, yValues, colors) {
  new Chart("chartCountryIncome", {
    type: "bar",
    data: {
      labels: xValues,
      datasets: [
        {
          backgroundColor: colors,
          data: yValues,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: { display: false },
      title: {
        display: true,
        text: titleChartCountry,
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    },
  });
}
// Render
getCountryChartData(dataUrlEndpointCountry);