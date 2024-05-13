$(document).ready(function() {
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
                            <div class='card product-card' onclick='addToCheckout(${product.Id})' data-product-id='${product.Id}'>
                                <img src='../includes/phpupload/uploads/${product.file_path}' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>${product.Name}</h5>
                                    <p class='card-text card-category'>${product.Category}</p>
                                    <div class='d-flex justify-content-between'>
                                        <p class='card-text card-price'>₱ ${parseFloat(product.Price).toFixed(2)}</p>
                                        <p>(${product.Stocks} left)</p>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    $('#productContainer').append(cardHtml);
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    loadProducts();
});
