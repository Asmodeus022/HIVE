

$(document).ready(function(){
    $.ajax({
        url: '../API/getDataRecords.php',
        type: 'GET',
        success: function(response) {
            var data = JSON.parse(response);

            var labels = data.labels;
            var totalAmountData = data.totalAmountData;

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Amount',
                        data: totalAmountData,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
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
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Error occurred while fetching data. Please try again.');
        }
    });
});


$(document).ready(function() {
    // Data for the pie chart
    var data = {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'red',
                'blue',
                'yellow',
                'green',
                'purple',
                'orange'
            ]
        }]
    };

    // Configuration options
    var options = {
        responsive: true,
        maintainAspectRatio: false,
    };

    // Get the canvas element
    var ctx = document.getElementById('myPieChart').getContext('2d');

    // Create the pie chart
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: options
    });
});
