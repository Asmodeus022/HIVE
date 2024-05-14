$(document).ready(function () {
    var table1 = $('#all-table').DataTable({
        paging: false,
        scrollCollapse: true,
        scrollY: 'calc(100vh - 300px)',
        select: {
            style: 'single'
        },
        order: [[1, 'asc']]
    });

    var table = $('#shared-table').DataTable({
        paging: false,
        scrollCollapse: true,
        scrollY: 'calc(100vh - 300px)',
        select: {
            style: 'single'
        },
        order: [[1, 'asc']]
    });

    table1.on('select', function (e, dt, type, indexes) {
        $('#dailyAverageSale').text(0);
        $('#renderPoint').text(0);
        $('#available').text(0);
        $('#sold').text(0);

        var selectedRowData = table1.rows(indexes).data().toArray(); // Change 'table' to 'table1'
        if (selectedRowData.length > 0) {
            var productId = selectedRowData[0][1];
            console.log(productId);
            
            $.ajax({
                url: 'http://localhost/hive/includes/fetch_daily_average_sales.php',
                method: 'POST',
                data: { productId: productId },
                dataType: 'json', 
                success: function (response) {
                    if ('error' in response) {
                        console.error('Error fetching daily average sales data:', response.error);
                    } else {
                        
                        $('#dailyAverageSale').text(response.Daily_Ave);
                        $('#renderPoint').text(response.Daily_Ave * response.Render_Point);
                        $('#available').text(response.Stocks);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching daily average sales data:', error);
                }
            });

            $.ajax({
                url: '../API/fetchTotalSold.php',
                method: 'POST',
                data: { productId: productId },
                dataType: 'json', 
                success: function (response) {
                    console.log(response);
                    $('#sold').text(response.TotalSold);
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching sold data:', error);
                }
            });
            
        }
    });


    
        $('.toggle-btn').click(function() {
            $('#dailyAverageSale').text(0);
            $('#renderPoint').text(0);
            $('#available').text(0);
            $('#sold').text(0);
            var target = $(this).data('target');
            console.log(target);
            $('allTable').hide();
            $('sharedTable').hide();
    
            $('#' + target ).show();
    
            if (target === 'allTable') {
                $('#sharedTable').hide();
                $('#allTable').show();
            } else {
                $('#sharedTable').show();
                $('#allTable').hide();
            }
    
            $('.toggle-btn').removeClass('active');
    
            $(this).addClass('active');

            if ($(this).hasClass('active')) {
                $('#' + target).css('display', 'block');
            } else {
                $('#' + target).css('display', 'none');
            }
        });
    
        $('#allTable').show();
        $('.toggle-btn[data-target="all"]').addClass('active');
    
});


