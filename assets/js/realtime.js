$.ajax({
  url: 'fetch_data/fetch_data_realtime_beban_pembangkit.php', // Ganti dengan path ke file PHP yang berisi script untuk mengambil data monitoring
  method: 'GET',
  dataType: 'html',
  success: function(data) {
    // Menampilkan data monitoring ke dalam elemen dengan id "monitoring-data"
    $('#card_left').html(data);
  console.log(data);
  },
  error: function(xhr, status, error) {
    console.error(error); // Menampilkan pesan error jika permintaan AJAX gagal
  }
});

$.ajax({
  url: 'fetch_data/fetch_date_update.php', // Ganti dengan path ke file PHP yang berisi script untuk mengambil data monitoring
  method: 'GET',
  dataType: 'html',
  success: function(data) {
    // Menampilkan data monitoring ke dalam elemen dengan id "monitoring-data"
    $('#date').html(data);
  console.log(data);
  },
  error: function(xhr, status, error) {
    console.error(error); // Menampilkan pesan error jika permintaan AJAX gagal
  }
});

$.ajax({
  url: 'fetch_data/fetch_data_tabel_bauran_energi.php', // Ganti dengan path ke file PHP yang berisi script untuk mengambil data monitoring
  method: 'GET',
  dataType: 'html',
  success: function(data) {
    // Menampilkan data monitoring ke dalam elemen dengan id "monitoring-data"
    $('#bauran_energe_timor').html(data);
  console.log(data);
  }
});


setInterval(function() {
  $.ajax({
    url: 'fetch_data/fetch_data_realtime_beban_pembangkit.php', // Ganti dengan path ke file PHP yang berisi script untuk mengambil data monitoring
    method: 'GET',
    dataType: 'html',
    success: function(data) {
      // Menampilkan data monitoring ke dalam elemen dengan id "monitoring-data"
      $('#card_left').html(data);
    console.log(data);
    }
  });
}, 1000);

setInterval(function() {
  $.ajax({
    url: 'fetch_data/fetch_date_update.php', // Ganti dengan path ke file PHP yang berisi script untuk mengambil data monitoring
    method: 'GET',
    dataType: 'html',
    success: function(data) {
      // Menampilkan data monitoring ke dalam elemen dengan id "monitoring-data"
      $('#date').html(data);
    console.log(data);
    }
  });
}, 1000);

setInterval(function() {
  $.ajax({
    url: 'fetch_data/fetch_data_tabel_bauran_energi.php', // Ganti dengan path ke file PHP yang berisi script untuk mengambil data monitoring
    method: 'GET',
    dataType: 'html',
    success: function(data) {
      // Menampilkan data monitoring ke dalam elemen dengan id "monitoring-data"
      $('#bauran_energe_timor').html(data);
    console.log(data);
    }
  });
}, 1000);


//langgam
  const chartData = {
    labels: [
      "00:00",
      "00:30",
      "01:00",
      "01:30",
      "02:00",
      "02:30",
      "03:00",
      "03:30",
      "04:00",
      "04:30",
      "05:00",
      "05:30",
      "06:00",
      "06:30",
      "07:00",
      "07:30",
      "08:00",
      "08:30",
      "09:00",
      "09:30",
      "10:00",
      "10:30",
      "11:00",
      "11:30",
      "12:00",
      "12:30",
      "13:00",
      "13:30",
      "14:00",
      "14:30",
      "15:00",
      "15:30",
      "16:00",
      "16:30",
      "17:00",
      "17:30",
      "18:00",
      "18:30",
      "19:00",
      "19:30",
      "20:00",
      "20:30",
      "21:00",
      "21:30",
      "22:00",
      "22:30",
      "23:00",
      "23:30",
    ],
    datasets: [
      {
        label: "Data Aktual",
        borderColor: "red",
        backgroundColor: "rgba(255, 0, 0, 0.2)",
        borderWidth: 2, 
      },
      {
        label: "Data Prediksi",
        borderColor: "blue",
        backgroundColor: "rgba(0, 0, 255, 0.2)",
        borderWidth: 2
      }
    ]
  };

  const ctx = document.getElementById("chart").getContext("2d");
  $(document).ready(function() {
    var chart = new Chart(ctx, {
      type: "line",
      data: chartData,
      options: {
        legend:{
          display: false,
        },
        scales: {
          x: {
            grid: {
              drawOnChartArea: false,
            },
          },
          y: {
            min: 0,
            max: 140,
            beginAtZero: true,
            ticks: {
              min: 0,
              max: 2
            },
          },
        },
        plugins: {
          title: {
            display: false
          }
        },
        elements: {
          line: {
            tension: 0.4,
          },
          point: {
            radius: 0,
            hitRadius: 10,
            hoverRadius: 4,
            hoverBorderWidth: 3,
          },
        },
      }
    });
    
    $.ajax({
      url: 'fetch_data/fetch_data_forecasting.php',
      method: 'POST',
      dataType: 'json',
      success: function(data) {
        chart.data.datasets[1].data = data;
        chart.update();
      }
    });
    
    $.ajax({
      url: 'fetch_data/fetch_data_langgam.php',
      method: 'POST',
      dataType: 'json',
      success: function(data) {
        chart.data.datasets[0].data = data.langgam_beban;
        chart.update();
      }
    });
    
    setInterval(function() {
      $.ajax({
        url: 'fetch_data/fetch_data_langgam.php',
        method: 'POST',
        dataType: 'json',
        success: function(data) {
          chart.data.datasets[0].data = data.langgam_beban;
          chart.update();
        }
      });
    }, 1000); // Mengambil data setiap 3 detik
  });

const myChartData2 = {
  type: 'doughnut',
  data: {
      labels: ["Batubara", "B30", "MFO", "Surya"],
      datasets: [{
          data: [],
          backgroundColor: [
              'rgb(244, 190, 55)',
              'rgb(83, 136, 216)',
              'rgb(13, 37, 53)',
              'rgb(255, 159, 64)'
          ],
          borderColor: [
            'rgb(244, 190, 55)',
            'rgb(83, 136, 216)',
            'rgb(13, 37, 53)',
            'rgb(255, 159, 64)'
          ],
          borderWidth: 1
      }]
  },
  options: {
    
      title: {
        display: false,
      },
    animation: {
        animateScale: true,
        animateRotate: true
      },
    responsive: true,
    maintainAspectRatio: false,
      
    legend: {
      display: false,
      },
      cutoutPercentage: 70,
  }
};

const ctxx = document.getElementById("chart-donut");
$(document).ready(function() {
var myChart = new Chart(ctxx, {
    type: myChartData2.type,
    data: myChartData2.data,
    options: myChartData2.options,
  });
    
  $.ajax({
    url: 'fetch_data/fetch_data_forecasting.php',
    method: 'POST',
    dataType: 'json',
    success: function(data) {
      myChart.data.datasets[1].data = data;
      myChart.update();
    }
  });
  
  $.ajax({
    url: 'fetch_data/fetch_data_langgam.php',
    method: 'POST',
    dataType: 'json',
    success: function(data) {
      myChart.data.datasets[0].data = data.data_chart_donut;
      myChart.update();
    }
  });
  
  setInterval(function() {
    $.ajax({
      url: 'fetch_data/fetch_data_langgam.php',
      method: 'POST',
      dataType: 'json',
      success: function(data) {
        myChart.data.datasets[0].data = data.data_chart_donut;
        myChart.update();
      }
    });
  }, 1000); // Mengambil data setiap 3 detik
});

// const Color = d3.scaleOrdinal()
//   .range(['#F4BE37', '#5388D8', '#0D2535', '#FF9F40', '#888']);


// // Donut Chart
// const donutContainer = d3.select("#chart-donut");
// const donutWidth = 250;
// const donutHeight = 250;
// const donutRadius = Math.min(donutWidth, donutHeight) / 2;

// const innerRadius = 80;
// const outerRadius = Math.min(donutWidth, donutHeight) / 2;

// const donutSvg = donutContainer.append("svg")
//   .attr("width", donutWidth)
//   .attr("height", donutHeight)
//   .append("g")
//   .attr("transform", `translate(${donutWidth / 2}, ${donutHeight / 2})`);

// const donutData = [
//   { value: 40 },
//   { value: 10 },
//   { value: 30 },
//   { value: 20 }
// ];

// const donutArc = d3.arc()
//   .innerRadius(innerRadius)
//   .outerRadius(outerRadius);

// const donutPie = d3.pie()
//   .value(d => d.value);

// const donutArcs = donutSvg.selectAll("arc")
//   .data(donutPie(donutData))
//   .enter()
//   .append("g");

// donutArcs.append("path")
//   .attr("d", donutArc)
//   .attr("fill", (d, i) => Color(i));

// // Pie Chart
// const pieContainer = d3.select("#chart-pie");
// const pieWidth = 250;
// const pieHeight = 250;
// const pieRadius = Math.min(pieWidth, pieHeight) / 2;

// const pieSvg = pieContainer.append("svg")
//   .attr("width", pieWidth)
//   .attr("height", pieHeight)
//   .append("g")
//   .attr("transform", `translate(${pieWidth / 2}, ${pieHeight / 2})`);

// const pieData = [
//   { value: 30 },
//   { value: 25 },
//   { value: 25 },
//   { value: 20 }
// ];

// const pieArc = d3.arc()
//   .innerRadius(0)
//   .outerRadius(pieRadius);

// const piePie = d3.pie()
//   .value(d => d.value);

// const pieArcs = pieSvg.selectAll("arc")
//   .data(piePie(pieData))
//   .enter()
//   .append("g");

// pieArcs.append("path")
//   .attr("d", pieArc)
//   .attr("fill", (d, i) => Color(i));

// pieArcs.append("text")
//   .attr("transform", d => `translate(${pieArc.centroid(d)})`)
//   .attr("text-anchor", "middle")
//   .text(d => d.data.label);



 