$(document).ready(function () {
    var table1 = $('#all-table').DataTable({
        paging: false,
        scrollCollapse: true,
        scrollY: 'calc(100vh - 300px)',
        select: {
            style: 'single'
        }
    });

    var table = $('#shared-table').DataTable({
        paging: false,
        scrollCollapse: true,
        scrollY: 'calc(100vh - 300px)',
        select: {
            style: 'single'
        }
    });

    table1.on('select', function (e, dt, type, indexes) {
        var selectedRowData = table.rows(indexes).data().toArray();
        if (selectedRowData.length > 0) {
            var productId = selectedRowData[0][1];
            
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


        // DataTable initialization code for both tables (all-table and shared-table)
    
        // Add click event listener to the toggle buttons
        $('.toggle-btn').click(function() {
            // Get the target type (all or shared) from the data attribute
            var target = $(this).data('target');
            console.log(target);
            // Hide all tables by default
            $('allTable').hide();
            $('sharedTable').hide();
    
            // Show the table corresponding to the target type
            $('#' + target ).show();
    
            // Hide the shared table if the "All" button is selected
            if (target === 'allTable') {
                $('#sharedTable').hide();
                $('#allTable').show();
            } else {
                $('#sharedTable').show();
                $('#allTable').hide();

            }
    
            // Remove 'active' class from all toggle buttons
            $('.toggle-btn').removeClass('active');
    
            // Add 'active' class to the clicked button
            $(this).addClass('active');

            if ($(this).hasClass('active')) {
                $('#' + target).css('display', 'block');
            } else {
                $('#' + target).css('display', 'none');
            }
        });
    
        // Initially show the 'All' table and add 'active' class to the 'All' button
        $('#allTable').show();
        $('.toggle-btn[data-target="all"]').addClass('active');
    
});


