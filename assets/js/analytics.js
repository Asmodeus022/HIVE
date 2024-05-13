// $(document).ready(function(){
//     // Sample data for the chart
//     var months = ['January', 'February', 'March', 'April', 'May', 'June'];
//     var datasets = [];

//     // Generate random data for each month (replace with your actual data)
//     for (var i = 0; i < months.length; i++) {
//         var data = [];
//         for (var j = 1; j <= 31; j++) {
//             data.push(Math.floor(Math.random() * 100)); // Random data between 0 and 100
//         }
//         datasets.push({
//             label: months[i],
//             data: data,
//             borderColor: 'rgb(' + Math.random() * 255 + ', ' + Math.random() * 255 + ', ' + Math.random() * 255 + ')',
//             tension: 0.1
//         });
//     }

//     // Initialize the chart
//     var ctx = document.getElementById('myChart').getContext('2d');
//     var myChart = new Chart(ctx, {
//         type: 'line',
//         data: {
//             labels: Array.from({ length: 31 }, (_, i) => 'Day ' + (i + 1)),
//             datasets: datasets
//         },
//         options: {
//             scales: {
//                 y: {
//                     beginAtZero: true
//                 }
//             }
//         }
//     });
// });

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
