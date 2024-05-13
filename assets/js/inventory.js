$(document).ready(function () {
    var table = $('#myTable').DataTable({
        paging: false,
        scrollCollapse: true,
        scrollY: 'calc(100vh - 300px)',
        select: {
            style: 'single'
        }
    });

    table.on('select', function (e, dt, type, indexes) {
        var selectedRowData = table.rows(indexes).data().toArray();
        if (selectedRowData.length > 0) {
            var productId = selectedRowData[0][1];
            
            $.ajax({
                url: 'http://localhost/hive/includes/fetch_daily_average_sales.php',
                method: 'POST',
                data: { productId: productId },
                dataType: 'json', 
                success: function (response) {
                    $('#dailyAverageSale').text(response);
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching daily average sales data:', error);
                }
            });
        }
    });

});
