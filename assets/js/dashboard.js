$(document).ready(function(){

    $.ajax({
        url: '../API/getRecentTransaction.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $.each(data, function(index, transaction) {
                var itemsHtml = '';
                
                if (transaction.items && transaction.quantities) {
                    var itemsArray = transaction.items.split(',');
                    var quantitiesArray = transaction.quantities.split(',');

                    for (var i = 0; i < itemsArray.length; i++) {
                        itemsHtml += '<div class="item-box d-flex justify-content-between">' + 
                                        '<p>'+ itemsArray[i] +'</p>' +
                                        '<p>'+ quantitiesArray[i] +' qty</p>' +
                                      '</div>';
                    }
                } else {
                    itemsHtml = 'N/A';
                }

                $('#recentTransactBody').append('<tr><td>' + transaction.Id + '</td><td>' + itemsHtml + '</td><td>' + transaction.Total_Amount + '</td><td>' + transaction.Cashier + '</td><td>' + transaction.Created_At + '</td></tr>');
            });

            $('#myTable').DataTable({
                paging: false,
                scrollCollapse: true,
                scrollY: 'calc(100vh - 700px)'
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
    
    $.ajax({
        url: '../API/getTopSoldProducts.php',
        type: 'GET',
        success: function(response) {

            var labels = response.labels.slice(0, 5); // Get top 5 product names
            var quantities = response.quantities.slice(0, 5); // Get top 5 product quantities

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


    
});
