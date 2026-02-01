const dataUrlEndpoint = "/student022/sandbox/sandboxEndPoint.php";
const colorPalette = {
  blue: "rgba(54, 162, 235, 0.8)",
  red: "rgba(255, 99, 132, 0.8)",
  orange: "rgba(255, 159, 64, 0.8)",
  green: "rgba(75, 192, 192, 0.8)",
  purple: "rgba(153, 102, 255, 0.8)",
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
    console.log(responseData);
    let xValues = [];
    let yValues = [];
    let fieldsColors = [];

    responseData.map((data) => {
      yValues.push(data.total_order_income);
      xValues.push(data.orders_month);
    });
    // Add colors from palette
    for (const[key,value] of Object.entries(colorPalette)){
      fieldsColors.push(value);
    }
    // Render the chart
    renderChart(xValues,yValues,fieldsColors);
  } else {
    console.log("Data not recived");
  }
}

function renderChart(xValues,yValues,colorPalette){
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
