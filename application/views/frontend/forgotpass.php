<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bg="img/bg/9.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                    <div class="section-title-area ltn__section-title-2">
                        <h1 class="section-title white-color">Reset Password</h1>
                    </div>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="<?=base_url()?>Home">Home</a></li>
                            <li>Reset Password</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ltn__login-area pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Reset Password <br> </h1>
                    <p> Apna Kirana Store
                         </p>
                </div>
            </div>
        </div>
				<div class="row">
						<div class="col-lg-6 offset-lg-3">
								<div class="account-login-inner">
  <form  onsubmit ="return validateForm()" action="<?=base_url()?>User/update_password/<?=$auth?>" enctype="multipart/form-data" method="POST">
        <label for="" class="form-label">Enter Password</label>
        <input type="password" class="form-control" placeholder="Enter Password" id="pswd1" aria-label="Enter password">
        <span id = "message1" style="color:red"> </span>
      </div>
        <label for=""  class="form-label">Enter Confirm Password</label>
        <input type="password" class="form-control" placeholder="Confirm Password" name="reset_password" id="pswd2" aria-label="Confirm password">
        <span id = "message2" style="color:red"> </span>

		<div class="btn-wrapper">
				<button class="theme-btn-1 btn reverse-color btn-block" type="submit">SUBMIT</button>
		</div>
</form>
<div class="by-agree text-center">
		<!-- <p>By creating an account, you agree to our:</p>
		<p><a href="#">TERMS OF CONDITIONS  &nbsp; &nbsp; | &nbsp; &nbsp;  PRIVACY POLICY</a></p> -->
		<!-- <div class="go-to-btn mt-50">
				<a href="<?=base_url()?>">Sign In?</a>
		</div> -->
</div>
</div>
</div>
</div>
</div>
</div>
<script>
function validateForm() {
    var pw1 = document.getElementById("pswd1").value;
    var pw2 = document.getElementById("pswd2").value;

    if(pw1 == "") {
      document.getElementById("message1").innerHTML = "**Fill the password please!";
      return false;
    }

    if(pw2 == "") {
      document.getElementById("message2").innerHTML = "**Fill the password please!";
      return false;
    }

    if(pw1.length < 4) {
      document.getElementById("message1").innerHTML = "**Password length must be atleast 4 characters";
      return false;
    }

    if(pw1.length > 15) {
      document.getElementById("message1").innerHTML = "**Password length must not exceed 15 characters";
      return false;
    }

    if(pw1 != pw2) {
      document.getElementById("message2").innerHTML = "**Passwords are not same";
      return false;
    } else {
      // alert ("Your password Reset successfully");
      // document.write("JavaScript form has been submitted successfully");
    }
 }
</script>
