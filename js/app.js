let ctx = document.getElementById("myChart").getContext("2d");
let table = document.getElementById("meterTableBody");

let myChart = new Chart(ctx, {
  type: "line",
  data: {
    labels: "",
    datasets: [
      {
        label: "Units Used",
        data: "",
        backgroundColor: "rgba(255, 206, 68, 0.6)",
        borderColor: "black",
        borderWidth: 1
      }
    ]
  },
  options: {
    maintainAspectRatio: true,
    legend: {
      display: true
    },
    scales: {
      yAxes: [
        {
          ticks: {
            beginAtZero: true
          }
        }
      ]
    }
  }
});

myChart.data.labels = $readings['created_at'];
myChart.data.datasets[0].data = $readings['meter_reading'];
