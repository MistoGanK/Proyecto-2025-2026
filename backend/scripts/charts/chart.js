const dataUrlEndpoint =
  "/student022/backend/endpoints/charts/chartOrderMonthIncome.php";

const colorPalette = {
  blue: "rgba(54, 162, 235, 0.8)",
  red: "rgba(255, 99, 132, 0.8)",
  orange: "rgba(255, 159, 64, 0.8)",
  green: "rgba(75, 192, 192, 0.8)",
  purple: "rgba(153, 102, 255, 0.8)",
  grey: "rgba(128, 128, 128, 0.8)"
};

let titleChart = "Income Orders 2025";
// Later on the endpointURL will be a option of a select
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

async function getChartData(endpointURL) {
  const responseData = await fetchData(endpointURL);
  if (responseData) {
    let xValues = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ]; // Fill per default  Month name

    let yValues = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    let fieldsColors = [];
    let currentValue = 0;

    for (const [key, value] of Object.entries(responseData)) {
      xValues.forEach((month, index) => {
        if (month === key) {
          // Value for the month
          yValues[index] = parseInt(value);
          console.log("Before Current Value:", currentValue);
          // Check if value is higher than the last
          const numericValue = parseInt(value);
          if (currentValue < numericValue) {
            // Profit
            fieldsColors[index] = colorPalette.green;
          } else if (currentValue > numericValue) {
            // Loss
            fieldsColors[index] = colorPalette.red;
          } else {
            // Even
            fieldsColors[index] = colorPalette.grey;
          }
          console.log(fieldsColors);
          // Update currentValue
          currentValue = parseInt(value);
          console.log("Afther Current Value:", currentValue);
        }
      });
    }
    // Render the chart
    renderChart(xValues, yValues, fieldsColors);
  } else {
    console.log("Data not recived");
  }
}

function renderChart(xValues, yValues, colorPalette) {
  new Chart("myChart", {
    type: "bar",
    data: {
      labels: xValues,
      datasets: [
        {
          backgroundColor: colorPalette,
          data: yValues,
        },
      ],
    },
    options: {
      responsive:true,
      maintainAspectRatio: false,
      legend: { display: false },
      title: {
        display: true,
        text: titleChart,
      },
    },
  });
}

// Render chart (Later will be implemented with select)
getChartData(dataUrlEndpoint);
