<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">

            <div class="col-md-12">
                <ol class="breadcrumb justify-content-md-starrt">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active">Reseller</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START LOGIN SECTION -->
<div class="login_register_wrap section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-md-12">
                <div class="login_wrap">
                  <form action="javascript:void(0)" id="reseller_resgisteration_form" method="POST" enctype="multipart/form-data">
            		<div class="padding_eight_all bg-white">
                        <div class="heading_s1">
                            <h3>Register as reseller</h3>
                        </div>
                        <div class="row" id="reseller_row">
                            <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" required class="form-control" id="rename" name="fname" placeholder="Name *">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="verify" id="reverify" value="0" />
                                <input type="email" required class="form-control" id="reemail" name="Email" placeholder="Email *">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="reshopname" name="shopname" required="" placeholder="Shop Name *">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="regstnumber" name="gstnumber" placeholder="GST Number">
                            </div>
                            </div>

                            <div class="col-lg-6">
                            <div class="form-group">
                              <select class="form-control" name="state" id="restate" required>
                                <?foreach ($state_data->result() as $state) {?>
                                <option value="<?=$state->state_name?>"><?=$state->state_name?></option>
                                <?}?>
                              </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control" required type="text" id="recity" name="city" placeholder="City*">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" onkeypress="return isNumberKey(event)" minlength="10" maxlength="10" required id="rephonenumber" name="phonenumber" placeholder="Phone Number *">
                            </div>
                            <div class="form-group">
                                <input class="form-control" required type="text" id="readdress" name="state" placeholder="Address *">
                            </div>
                            </div>
                        </div>
                        <div class="row hidden-OTP-field">
                            <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="reConfirmPhone" name="phone" placeholder="">
                            </div>
                            </div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                <input class="form-control" type="text" id="reOTP" name="otp" placeholder="Enter OTP">
                            </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-fill-out btn-block" id="reSendbtn" value="register">Send OTP</button>
                        </div>
                        <div class="different_login">
                            <span> or</span>
                        </div>
                        <div class="form-note text-center">Already have an account? <a href="#"  data-target="#onload-popup1" data-toggle="modal" data-dismiss="modal" >Log in</a></div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- END LOGIN SECTION -->
