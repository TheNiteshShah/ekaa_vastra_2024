//============================================= ADD TO CART ===================================================
$('#add-to-cart-btn').click(function (e) {
  e.preventDefault();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

  var product_id = $('#product_id').val();
  var type_id = $('#type_id').val();
  var quantity = $('#quantity').val();
  if (!type_id) {
    errorToast("Please select size!");
    return;
  }
  $.ajax({
    url: baseUrl + 'add-to-cart',
    method: 'post',
    data: {
      product_id: product_id,
      type_id: type_id,
      quantity: quantity
    },
    dataType: 'json',
    success: function (response) {
      console.log(response)
      if (response.status == true) {
        // successToast('Item successfully added to your cart');
        location.reload();
      } else {
        errorToast(response.message);
      }
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
      errorToast("An error occurred while adding the item to the cart!");
    }
  });
});

