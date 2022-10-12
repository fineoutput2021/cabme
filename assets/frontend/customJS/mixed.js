if($('#fname').length){
document.getElementById("fname").value = getSavedValue("fname");
document.getElementById("lname").value = getSavedValue("lname");
document.getElementById("email").value = getSavedValue("email");
document.getElementById("phonenumber").value = getSavedValue("phonenumber");
document.getElementById("city").value = getSavedValue("city");
document.getElementById("address").value = getSavedValue("address");
document.getElementById("referalcode").value = getSavedValue("referalcode");
}
// if($('#shipping').length){
//   if (getSavedValue("shipping") != '') {
//   $('#shipping').html('₹'+getSavedValue("shipping"));
//   $('#subtotal').html('₹'+getSavedValue("subtotal"));
//   $('#pincode').val(getSavedValue("pincode"))
//   $('#courier_id').val(getSavedValue("courier_id"))
//   $('#zip').val(getSavedValue("pincode"))
// }
// }

function getSavedValue(v) {
  if (!localStorage.getItem(v)) {
    return ""; // You can change this to your defualt value.
  }
  return localStorage.getItem(v);
}

function saveValue(e) {
  var id = e.id; // get the sender's id to save it .
  var val = e.value; // get the value.
  localStorage.setItem(id, val); // Every time user writing something, the localStorage's value will override .
  document.getElementById("fname").value = getSavedValue("fname");
  document.getElementById("lname").value = getSavedValue("lname");
  document.getElementById("email").value = getSavedValue("email");
  document.getElementById("phonenumber").value = getSavedValue("phonenumber");
  document.getElementById("city").value = getSavedValue("city");
  document.getElementById("address").value = getSavedValue("address");
}
//==================================================== CHANGE SIZE BY COLOR ===============================================
function SetSize(obj) {
  var color_id = $(obj).attr("color_id");
  var product_id = $(obj).attr("product_id");
  $.ajax({
    url: base_url + 'Home/GetSize',
    method: 'post',
    data: {
      color_id: color_id,
      product_id: product_id,
    },
    dataType: 'json',
    success: function(response) {
      var opton = '';
      if (response.status == true) {
        $('#size_div').html("");
        var data = response.data;
        $.each(data, function(i) {
          if (data[i]['stock'] == 0) {
            opton += '<a href="'+base_url+'Home/product_detail/' + data[i]['product_url'] + '?type=' + btoa(data[i]['type_id']) + '" ><span class="spananim mr-1">' + data[i]['size_name'] + '</span></a>';
          } else {
            opton += '<a href="'+base_url+'Home/product_detail/' + data[i]['product_url'] + '?type=' + btoa(data[i]['type_id']) + '" ><span class="mr-1">' + data[i]['size_name'] + '</span></a>';
          }
        });
        console.log(opton)
        $('#size_div').html(opton);


      } else if (response.status == false) {
        notifyError(response.message)

      }
    }
  });
}
