function book_intercity(){
  var id = $("#ic_id").val()
  var amount = $("#ic_amount").val()
  var formData = {
    id: id,
    amount: amount,
  };
  $.ajax({
    type: "POST",
    url: base_url + 'Home/intercity_checkout',
    data: formData,
    dataType: "json",
    success: function(response) {
        // ------ Razorpay Order ID Created -----------------
        if (response.status == true) {
          var data = $("#totAmt").val()
          $.ajax({
            url: base_url + 'Order/place_prepaid_order',
            type: 'post',
            dataType: 'json',
            data: data,
            success: function(respawn) {
              if (respawn.status == true) {
                localStorage.removeItem("shipping");
                localStorage.removeItem("sub_total");
                localStorage.removeItem("pincode");
                localStorage.removeItem("courier_id");
                window.location.replace(base_url + "Order/order_success");
              } else if (respawn.status == false) {
                window.location.replace(base_url + "Order/order_failed");
              }
            }
          });
          var payuForm = document.forms.payuForm;
          payuForm.submit();
        } else {
          alert('Not OKay');
        }

    }
  });
}
$('#intercity_checkout').on('submit', function(e) {
  e.preventDefault();
  var fname = $("#id").val()
  var lname = $("#lname").val()
  var email = $("#email").val()
  var phonenumber = $("#phonenumber").val()
  var state = $("#state").val()
  var city = $("#city").val()
  var address = $("#address").val()
  var referalcode = $("#referalcode").val()
  var payment_method = $(".payment_emthod:checked").val()

  var formData = {
    fname: fname,
    lname: lname,
    email: email,
    phonenumber: phonenumber,
    state: state,
    city: city,
    address: address,
    referalcode: referalcode,
    payment_method: payment_method
  };
  $("#loader").css("display",'block');
  $("#place").css("display",'none');
  // return;
  $.ajax({
    type: "POST",
    url: base_url + 'Order/checkout',
    data: formData,
    dataType: "json",
    success: function(response) {
        // ------ Razorpay Order ID Created -----------------
        if (response.status == true) {
          var totalAmount = $("#totAmt").val()
          var options = {
            "key": api_key,
            "amount": totalAmount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000
            "currency": "INR",
            "name": "Tiara",
            "description": "Test Transaction",
            "prefill": {
              "name": fname+" "+lname,
              "email": email,
              "contact": phonenumber,
            },
            // "image": "https://example.com/your_logo",
            "order_id": response.razorpayOrder,
            "handler": function(response) {
              if (response.razorpay_payment_id.length !== 0) {
                // alert(response.razorpay_payment_id)
                $.ajax({
                  url: base_url + 'Order/place_prepaid_order',
                  type: 'post',
                  dataType: 'json',
                  data: {
                    razorpay_payment_id: response.razorpay_payment_id,
                    razorpay_order_id: response.razorpay_order_id,
                    razorpay_signature: response.razorpay_signature,
                    fname: fname,
                    lname: lname,
                    email: email,
                    phonenumber: phonenumber,
                    state: state,
                    city: city,
                    address: address,
                    referalcode: referalcode,
                    payment_method: payment_method
                  },
                  "prefill": {
                    "name": fname+ " "+lname,
                    "email": email,
                    "phone": phonenumber,
                  },
                  "notes": {
                    "address": address,
                  },
                  success: function(respawn) {
                    if (respawn.status == true) {
                      localStorage.removeItem("shipping");
                      localStorage.removeItem("sub_total");
                      localStorage.removeItem("pincode");
                      localStorage.removeItem("courier_id");
                      window.location.replace(base_url + "Order/order_success");
                    } else if (respawn.status == false) {
                      window.location.replace(base_url + "Order/order_failed");
                    }
                  }
                });
              } else {
                    notifyError(response.message)
                $("#loader").css("display",'none');
                $("#place").css("display",'block');
              }
            },
            "theme": {
              "color": "#FF324D"
            }
          };
          var payuForm = document.forms.payuForm;
          payuForm.submit();
        } else {
          alert('Not OKay');
        }

    }
  });
});
