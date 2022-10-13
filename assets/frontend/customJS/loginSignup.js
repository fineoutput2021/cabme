// =========================================================== REGISTER USER ===========================================================
$("#registerForm").on('submit',function(e){
  e.preventDefault();
  var fname = $('#signupFname').val()
  var lname = $('#signupLname').val()
  var email = $('#signupEmail').val()
  var phone = $('#signupPhone').val()
  var verify = $('#signupverify').val()
  if(verify==0){
    $.ajax({
    type: "POST",
    url: base_url+'User/register_process',
    data: {phone: phone, fname: fname, lname: lname, email: email},
    dataType: "json",
    success: function(response) {
      if(response.status==true){
        notifySuccess(response.message)
        $('#otp_div').css('display', 'inline')
        $('#signupFname').attr('readonly', 'readonly')
        $('#signupLname').attr('readonly', 'readonly')
        $('#signupEmail').attr('readonly', 'readonly')
        $('#signupPhone').attr('readonly', 'readonly')
        $('#signupOTP').attr('required', 'required')
        $('#signupverify').val(1)
      }else{
        notifyError(response.message)
      }
    }
  });
}else if(verify==1){
    var otp = $('#signupOTP').val()
    $.ajax({
    type: "POST",
    url: base_url +'User/register_otp_verify',
    data: {phone: phone, otp: otp},
    dataType: "json",
    success: function(response) {
      if(response.status==true){
        notifySuccess(response.message)
        location.reload()
      }else{
        notifyError(response.message)
        location.reload()
      }
    }
  });
  }
});

// =========================================================== log in ===========================================================
$("#loginForm").on('submit',function(e){
  e.preventDefault();
  var phone = $('#loginPhone').val()
  var verify = $('#loginverify').val()
  if(verify==0){
    $.ajax({
    type: "POST",
    url: base_url+'User/login_process',
    data: {phone: phone},
    dataType: "json",
    success: function(response) {
      if(response.status==true){
        $('#loginotp_div').css('display', 'inline')
        $('#loginPhone').attr('readonly', 'readonly')
        $('#loginOTP').attr('required', 'required')
        $('#loginverify').val(1)
        notifySuccess(response.message)
      }else{
        notifyError(response.message)
      }
    }
  });
}else if(verify==1){
    var otp = $('#loginOTP').val()
    $.ajax({
    type: "POST",
    url: base_url +'User/login_otp_verify',
    data: {phone: phone, otp: otp},
    dataType: "json",
    success: function(response) {
      if(response.status==true){
        location.reload()
      }else{
        notifyError(response.message)
      }
    }
  });
  }
});
