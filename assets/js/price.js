function addChart() {
    ctx = document.getElementById('myChart').getContext('2d');
    myChart = new Chart(ctx, {
        type: 'line',
        data: {
        labels: [],
        datasets: [{
            label: 'Force',
            data: [],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function saveChart() {
    let nomDate = new Date();    
    let nom = name + "_" + nomDate.getFullYear() + "-" + nomDate.getMonth() + "-" + nomDate.getDate() + "_" + nomDate.getHours() + "h" + nomDate.getMinutes() + ".csv";
    let blob = new Blob([export_data], {type: "text/plain;charset=utf-8"});
    saveAs(blob, nom);
}