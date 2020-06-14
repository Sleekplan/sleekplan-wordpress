jQuery(document).ready(function($) {

    // init chart element
    var links_pageviews = document.getElementById('csatisfaction').getContext('2d');

    // draw a chart
    new Chart(links_pageviews, {
        type: 'line',
        data: {
            labels: satisfaction.labels,
            datasets: [{
                borderColor: '#0071a1',
                pointBorderColor: '#fff',
                pointBackgroundColor: '#01b2fe',
                pointHoverBackgroundColor: '#01b2fe',
                pointHoverBorderColor: '#01b2fe',
                backgroundColor: '#0071a1',
                fill: false,
                pointRadius: ((satisfaction.data && satisfaction.data.length < 60) ? 5 : 0 ),
                borderWidth: 3,
                label: 'Average customer satisfaction',
                data: satisfaction.data,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: false,
            layout: {
                padding: {
                    top: 5,
                    bottom: 5
                }
            },
            scales: {
                yAxes: [{
                    display: true,
                    ticks: {
                        stepSize: 1,
                        suggestedMax: 5,
                        suggestedMin: 0,
                        display: false,
                        beginAtZero: true,
                    },
                    gridLines: {
                        display: true,
                        color: "#e4e8ea",
                        drawBorder: false
                    }
                }],
                xAxes: [{
                    
                    display: true,
                    ticks: {
                        beginAtZero: true,
                        autoSkip: true,
                        maxTicksLimit: 7,
                        maxRotation: 0,
                        minRotation: 0
                    },
                    gridLines: {
                        display:false,
                        drawBorder: false
                    },
                }]
            }
        }
    });

});