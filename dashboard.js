(() => {
  'use strict'

  const ctx = document.getElementById('myChart')
  const myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
      datasets: [{
        data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
        backgroundColor: 'rgba(0, 123, 255, 0.5)',
        borderColor: '#007bff',
        borderWidth: 2,
        hoverBackgroundColor: '#0056b3'
      }]
    },
    options: {
      plugins: {
        legend: {
          display: true
        },
        tooltip: {
          boxPadding: 3
        }
      }
}
})
})()