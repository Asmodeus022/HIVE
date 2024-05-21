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
                    responsive: true,
                    maintainAspectRatio: false,
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

    $.ajax({
        url: '../API/getTopSoldProducts.php',
        type: 'GET',
        success: function(response) {
            var data = JSON.parse(response);

            var labels = data.labels.slice(0, 5); // Get top 5 product names
            var quantities = data.quantities.slice(0, 5); // Get top 5 product quantities

            var topProductsData = {
                labels: labels,
                datasets: [{
                    data: quantities,
                    backgroundColor: [
                        '#ff0000', // red
                        '#0000ff', // blue
                        '#ffff00', // yellow
                        '#00ff00', // green
                        '#800080'  // purple
                    ]
                }]
            };

            var options = {
                responsive: true,
                maintainAspectRatio: false,
            };

            var ctx = document.getElementById('myPieChart').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: topProductsData,
                options: options
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Error occurred while fetching data. Please try again.');
        }
    });

    // Fetch total sales
$.ajax({
    url: '../API/getTotalSales.php',
    type: 'GET',
    success: function(response) {
        document.getElementById('totalSales').textContent = parseFloat(response.totalSales).toFixed(2);
    },
    error: function(xhr, status, error) {
        console.error(xhr.responseText);
        alert('Error occurred while fetching total sales. Please try again.');
    }
});


});
