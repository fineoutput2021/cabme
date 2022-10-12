// =========================================================== REGISTER USER ===========================================================
$("#registerForm").on('submit',function(e){
  e.preventDefault();
  var fname = $('#signinFname').val()
  var lname = $('#signinLname').val()
  var phone = $('#signinPhone').val()
  var verify = $('#signinverify').val()
  if(verify==0){
    $.ajax({
    type: "POST",
    url: base_url+'User/register_process',
    data: {phone: phone, fname: fname, lname: lname},
    dataType: "json",
    success: function(response) {
      if(response.status==true){
        notifySuccess(response.message)
        $('.hidden-OTP-field').css('display', 'inline')
        $('#signinFname').attr('readonly', 'readonly')
        $('#signinLname').attr('readonly', 'readonly')
        $('#signinPhone').attr('readonly', 'readonly')
        $('#signinOTP').attr('required', 'required')
        $('#signinverify').val(1)
      }else{
        notifyError(response.message)
      }
    }
  });
}else if(verify==1){
    var otp = $('#signinOTP').val()
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


// ========================================= REGISTER RESELLER ===========================================================
$("#reseller_resgisteration_form").on('submit',function(e){
  e.preventDefault();
  var name = $('#rename').val()
  var email = $('#reemail').val()
  var shopname = $('#reshopname').val()
  var gstnumber = $('#regstnumber').val()
  var city = $('#recity').val()
  var address = $('#readdress').val()
  var state = $('#restate').val()
  var phone = $('#rephonenumber').val()
  var verify = $('#reverify').val()
  if(verify==0){
    $.ajax({
    type: "POST",
    url: base_url+'User/reseller_register_process',
    data: {name: name, email: email, shopname: shopname, gstnumber: gstnumber, city: city, state: state, phone: phone, address: address},
    dataType: "json",
    success: function(response) {
      if(response.status==true){
        notifySuccess(response.message)
        $('.hidden-OTP-field').css('display', 'inline')
        $('#reseller_row').css('display', 'none')
        document.getElementById("reSendbtn").innerHTML = "Register";
        $('#reConfirmPhone').val(phone)
        $('#reConfirmPhone').attr("readonly", "readonly")
        $('#reOTP').attr("required", "required")
        $('#reverify').val(1)
      }else{
        notifyError(response.message)
      }
    }
  });
}else if(verify==1){
    var otp = $('#reOTP').val()
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
        $('.hidden-OTP-field').css('display', 'inline')
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
