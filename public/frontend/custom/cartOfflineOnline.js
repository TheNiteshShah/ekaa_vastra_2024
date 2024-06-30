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
        successToast('Item successfully added to your cart');
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

// ================================== DELETE FROM USER'S CART ===================================
function deleteCart(obj) {
  var product_id = $(obj).attr("product_id");
  var type_id = $(obj).attr("type_id");
  $.ajax({
    url: base_url + 'Cart/deleteFromCart',
    method: 'post',
    data: {
      product_id: product_id,
      type_id: type_id
    },
    dataType: 'json',
    success: function (response) {
      if (response.status == true) {
        successToast(response.message)
        $("#headerCount").load(window.location.href + " #headerCount > *");   // cart count
        $("#footerCount").load(window.location.href + " #footerCount > *");   // cart count
        $(".refreshing").load(window.location.href + " .refreshing > *");
      } else if (response.status == false) {
        errorToast(response.message)
        $(".refreshing").load(window.location.href + " .refreshing > *");
      }
    }
  });
}


// ======================================= UPDATE CART ========================================
function updateCart(i) {
  var product_id = $("#quantity" + i).attr("product_id");
  var type_id = $("#quantity" + i).attr("type_id");
  var quantity = $("#quantity" + i).val();
  if (quantity == 0) {
    window.location.reload();
    return;
  }
  $.ajax({
    url: base_url + 'Cart/updateCart',
    method: 'post',
    data: {
      product_id: product_id,
      quantity: quantity,
      type_id: type_id
    },
    dataType: 'json',
    success: function (response) {
      if (response.status == true) {
        window.location.reload();
      } else if (response.status == false) {
        window.location.reload();
      }
    }
  });
}
