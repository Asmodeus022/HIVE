$(document).ready(function() {
    function showAlertModal(message, type) {
        var alertModal = $('#alertModal');
        alertModal.html(message);
        alertModal.addClass('alert-modal ' + type).show();

        setTimeout(function(){
            location.reload();
        }, 3000);
    }

    function loadProducts() {
        $.ajax({
            type: "GET",
            url: "../API/getAllProducts.php",
            dataType: "json",
            success: function(response) {
                $('#productContainer').empty();

                response.forEach(function(product) {
                    var cardHtml = `
                        <div class='col-4 mb-4'>
                            <div class='card product-card' data-product-id='${product.Id}'>
                                <img src='../includes/phpupload/uploads/${product.file_path}' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>${product.Name}</h5>
                                    <p class='card-text card-category'>${product.Category}</p>
                                    <div class='d-flex justify-content-between'>
                                        <p class='card-text card-price'>₱ ${parseFloat(product.Price).toFixed(2)}</p>
                                        <p>(${product.Quantity} left)</p>
                                    </div>
                                    <button class='btn btn-primary btn-sm addToCheckout'>Add to Checkout</button>
                                </div>
                            </div>
                        </div>`;
                    $('#productContainer').append(cardHtml);
                });
            },
            error: function(xhr, status, error) {
                showAlertModal()
                console.error(xhr.responseText);
            }
        });
    }

    loadProducts();

    $(document).on('click', '.addToCheckout', function() {
        var card = $(this).closest('.card');
        var productId = card.data('product-id');
        var productName = card.find('.card-title').text();
        var productCategory = card.find('.card-category').text();
        var productPrice = card.find('.card-price').text();
        var productImage = card.find('.card-img-top').attr('src');
        addToSelectedItems(productId, productName, productCategory, productPrice, productImage);
    });
});
