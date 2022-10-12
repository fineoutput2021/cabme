//=================================== APPLY PROMOCODE/PROMOCODE FORM SUBMIT ===================================
 $('#promocode_form').on('submit',function(e){
  e.preventDefault(); // avoid to execute the actual submit of the form.
  var frm = $(this).closest("#promocode_form");
  var dataString = frm.serialize();
    url = base_url+"Order/apply_promocode";
  $.ajax({
    url: url,
    method: 'post',
     data: dataString, // serializes the form's elements.
     dataType: 'json',
    success: function(response) {
      if (response.status == true) {
        notifySuccess(response.message)
        $("#order_review").load(window.location.href + " #order_review > *");
      } else if (response.status == false) {
        notifyError(response.message)
      }
    }
  });
});

//=========================================== REMOVE PROMOCODE ==============================================
function remove_promocode() {
  $.ajax({
    url: base_url+'Order/remove_promocode',
    method: 'GET',
    data: '',
    dataType: 'json',
    success: function(response) {
      if (response.status == true) {
        $("#order_review").load(window.location.href + " #order_review > *");
        notifySuccess(response.message)
      } else if (response.status == false) {
        notifyError(response.message)
      }
    }
  });
}
