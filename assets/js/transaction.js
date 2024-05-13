$(document).ready(function(){
    $.ajax({
        url: '../API/getAllTransactions.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $.each(data, function(index, transaction) {
                var itemsHtml = '';
                
                if (transaction.items && transaction.quantities) {
                    var itemsArray = transaction.items.split(',');
                    var quantitiesArray = transaction.quantities.split(',');

                    for (var i = 0; i < itemsArray.length; i++) {
                        // Format item with quantity as a box using flexbox
                        itemsHtml += '<div class="item-box d-flex justify-content-between">' + 
                                        '<p>'+ itemsArray[i] +'</p>' +
                                        '<p>'+ quantitiesArray[i] +' qty</p>' +
                                      '</div>';
                    }
                } else {
                    itemsHtml = 'N/A';
                }

                $('#transactionTableBody').append('<tr><td>' + transaction.Id + '</td><td>' + itemsHtml + '</td><td>' + transaction.Total_Amount + '</td><td>' + transaction.Cashier + '</td></tr>');
            });

            $('#myTable').DataTable({
                paging: false,
                scrollCollapse: true,
                scrollY: 'calc(100vh - 300px)'
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});
