let ctx = document.getElementById("myChart").getContext("2d");
let table = document.getElementById("meterTableBody");

let entryDate = [];
let prevMeter = [];
let dbMeter = [];
let units = [];

fetch("data.json")
  .then((response) => response.json())
  .then((jsonResponse) => {
    let resData = Object.values(jsonResponse);
    let output = "";
    resData.forEach((e, index) => {
      output += `
            <tr>
              <td>${moment.unix(e.date).format("DD MMM YYYY")}</td>
              <td>${e.prevMeter} units</td>
              <td>${e.dbMeter} units</td>
              <td>${(e.dbMeter - e.prevMeter).toFixed(1)} units</td>
              </tr>
          `;
      entryDate.push(moment.unix(e.date).format("DD MMM YYYY"));
      prevMeter.push(e.prevMeter);
      dbMeter.push(e.dbMeter);
      units.push(e.dbMeter - e.prevMeter).toFixed(1);
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

myChart.data.labels = entryDate;
myChart.data.datasets[0].data = units;
