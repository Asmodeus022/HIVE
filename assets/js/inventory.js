$(document).ready(function () {
    var table = $('#myTable').DataTable({
        paging: false,
        scrollCollapse: true,
        scrollY: 'calc(100vh - 300px)',
        bInfo: false,
        columnDefs: [
            {
                orderable: false,
                render: DataTable.render.select(),
                targets: 0
            }
        ],
        select: true,
        order: [[1, 'asc']]
    });

    table.on('select', function (e, dt, type, indexes) {
        var selectedRowData = table.rows(indexes).data().toArray();
        if (selectedRowData.length > 0) {
            var productId = selectedRowData[0][2];
            
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

    $(document).ready(function() {
        function loadProducts() {
            $.ajax({
                url: '../API/getAllProducts.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#productTableBody').empty();
    
                    data.forEach(function(product) {
                        var row = '<tr>' +
                            '<td></td>' +
                            '<td><img src="../includes/phpupload/uploads/' + product['file_path'] + '" style="width: 100px; height: 100px;" alt="Image"></td>' +
                            '<td>' + product['Id'] + '</td>' +
                            '<td>' + product['Name'] + '</td>' +
                            '<td>' + product['Brand'] + '</td>' +
                            '<td>' + product['Price'] + '</td>' +
                            '<td>' + product['Stocks'] + '</td>' +
                            '<td>' +
                            '<button type="button" class="btn btn-hive update-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop_update" data-product-id="' + product['Id'] + '" data-product-name="' + product['Name'] + '" data-category="' + product['Category'] + '" data-brand="' + product['Brand'] + '" data-price="' + product['Price'] + '" data-quantity="' + product['Stocks'] + '" data-daily-ave="' + product['Daily_Ave'] + '" data-render-point="' + product['Render_Point'] + '">Update</button>' +
                            '</td>' +
                            '</tr>';
                        $('#productTableBody').append(row);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error loading products:', error);
                }
            });
        }
    
        loadProducts();
    });
    

});


