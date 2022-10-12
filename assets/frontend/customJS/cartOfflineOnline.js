//============================================= ADD TO CART ===================================================
function addToCart(obj) {
  var product_id = $(obj).attr("product_id");
  var type_id = $(obj).attr("type_id");
  var quantity = $(obj).attr("quantity");
  $.ajax({
    url: base_url + 'Cart/addToCart',
    method: 'post',
    data: {
      product_id: product_id,
      quantity: quantity,
      type_id: type_id
    },
    dataType: 'json',
    success: function(response) {
      if (response.status == true) {
        notifySuccess(response.message)
        $(".refreshing").load(window.location.href + " .refreshing > *");
        $("#headerCount").load(window.location.href + " #headerCount > *");   //cart count
        $("#footerCount").load(window.location.href + " #footerCount > *");   //cart count
      } else if (response.status == false) {
        notifyError(response.message)
        if(response.message=='Item is already in your cart'){
          $("#mob_cart").addClass("show");
          $("#minicart").addClass("show");
          $("#carto").attr("aria-expanded","true");
        }
      }
    }
  });

}

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
    success: function(response) {
      if (response.status == true) {
        notifySuccess(response.message)
        $(".refreshing").load(window.location.href + " .refreshing > *");
        $("#headerCount").load(window.location.href + " #headerCount > *");   // cart count
        $("#footerCount").load(window.location.href + " #footerCount > *");   // cart count
      } else if (response.status == false) {
        notifyError(response.message)
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
    success: function(response) {
      if (response.status == true) {
        window.location.reload();
      } else if (response.status == false) {
        window.location.reload();
      }
    }
  });
}
//============================= CALCULATE SHIPPING =========
$('#shipping_form').on('submit',function(e){
e.preventDefault(); // avoid to execute the actual submit of the form.
var frm = $(this).closest("#shipping_form");
var dataString = frm.serialize();
 url = base_url+"Cart/get_courier_serviceability";
$.ajax({
 url: url,
 method: 'post',
  data: dataString, // serializes the form's elements.
  dataType: 'json',
 success: function(response) {
   if (response.status == true) {
     $('#shipping').html('₹'+response.data['shipping'])
     $('#subtotal').html('₹'+response.data['sub_total'])
     $('#pincode').val(response.data['pincode'])
     $('#courier_id').val(response.data['courier_id'])
       // localStorage.setItem('shipping', response.data['shipping']);
       // localStorage.setItem('subtotal', response.data['sub_total']);
       localStorage.setItem('pincode', response.data['pincode']);
       // localStorage.setItem('courier_id', response.data['courier_id']);
     notifySuccess(response.message)
   } else if (response.status == false) {
     notifyError(response.message)
   }
 }
});
});
