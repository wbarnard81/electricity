let ctx = document.getElementById("myChart").getContext("2d");
let table = document.getElementById("meterTableBody");

let entryDate = [];
let meter = [];
let dbMeter = [];

fetch("data.json")
  .then((response) => response.json())
  .then((jsonResponse) => {
    let resData = Object.values(jsonResponse);
    let output = "";
    resData.forEach((e) => {
      output += `
            <tr>
              <td>${moment.unix(e.date).format("DD MMM YYYY")}</td>
              <td>${e.meter} units</td>
              <td>${e.dbMeter} units</td>
              <td>${e.meter - e.dbMeter} units</td>
              </tr>
          `;
      entryDate.push(moment.unix(e.date).format("DD MMM YYYY"));
      meter.push(e.meter);
      dbMeter.push(e.dbMeter);
      myChart.update();
    });
    table.innerHTML = output;
  });

let myChart = new Chart(ctx, {
  type: "line",
  data: {
    labels: "",
    datasets: [
      {
        label: "Electricity Meter",
        data: "",
        backgroundColor: "rgba(76, 139, 245, 0.6)",
        borderColor: "black",
        borderWidth: 1
      },
      {
        label: "DB Meter",
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

myChart.data.labels = entryDate;
myChart.data.datasets[0].data = meter;
myChart.data.datasets[1].data = dbMeter;
