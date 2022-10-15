<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="utf-8" />
	<title>Cabme</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="MobileOptimized" content="320" />
	<!--Template style -->
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/frontend/css/cabme.css" />
	<!--favicon-->
	<link rel="shortcut icon" type="image/png" href="<?=base_url()?>assets/frontend/images/cabmenewlogo.png" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?=base_url()?>assets/frontend/js/bootstrap-notify.min.js"></script>
	<style>
		.mobilenav-tabs .nav-item .nav-link {
			padding-left: 16px;
			padding: 3px 10px !important;
			padding-right: 16px;
		}
	</style>
</head>

<body>


	<!--====== Sort By Modal ======-->

	<div class="sortbyModal fade" id="sortbyModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class=" sortbyModal-content modal-content" style="z-index: 999999;">
				<div class="modal-header p-1">
					<div class="col-md-11 col-11 text-center">
						<h6 class="modal-title">Sort By</h6>
					</div>
					<div class="col-md-1 col-1"> <button type="button" class="close"
							data-dismiss="modal">&times;</button>
					</div>

				</div>
				<div class="modal-body">
					<ul class="sortul">
						<li>
							<a href="#">Popularity</a>
						</li>
						<li>
							<a href="#">Price: &nbsp; Low To High</a>

						</li>
						<li>
							<a href="#">Price: &nbsp; High To Low</a>
						</li>
						<!-- <li>
							<a href="#">Extra Km Charges: &nbsp; Low To High</a>
						</li>
						<li>
							<a href="#">Extra Km Charges: &nbsp; High To Low</a>
						</li> -->
					</ul>

				</div>
			</div>
		</div>
	</div>

	<!--======Sort By Modal End ======-->

	<!--====== Info Modal ======-->
	<div class="modal fade " id="searchbtn" role="dialog">
		<div class="modal-dialog " style="width: auto;">
			<!-- Modal content-->
			<div class="modal-content ">
				<div class="modal-header">
					<h4 class="modal-title">Information</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body" id="mobilefont">
					<div class="row mb-2">
						<div class="col-md-6 col-6">
							<h5>City :</h5>
						</div>
						<div class="col-md-6 col-6">
							<h6>Jaipur</h6>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-md-6 col-6">
							<h5>Car Type :</h5>
						</div>
						<div class="col-md-6 col-6">
							<h6>Sedan</h6>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-md-6 col-6">
							<h5>Start Date & <span>Time</span> :</h5>
						</div>
						<div class="col-md-6 col-6">
							<h6>12-10-2003 & <span>10:23</span> </h6>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-md-6 col-6">
							<h5>End Date & <span>Time</span> :</h5>
						</div>
						<div class="col-md-6 col-6">
							<h6>14-10-2003 & <span>12:23</span> </h6>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-md-6 col-6">
							<h5>Price</h5>
						</div>
						<div class="col-md-6 col-6">
							<h6>₹ 2000</h6>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-md-6 col-6">
							<h5>Killometer Cab</h5>
						</div>
						<div class="col-md-6 col-6">
							<h6>100 Kms</h6>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-md-6 col-6">
							<h5>Minimum Booking Amt.</h5>
						</div>
						<div class="col-md-6 col-6">
							<h6>₹ 1000</h6>
						</div>
					</div>
					<div class="row justify-content-center">
						<a href="summary.html" class="col-md-12 text-center">
							<button class="btn col-md-10  searchbtn shadowbtn">Book</button>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--====== Info Modal End ======-->
	<!--====== Select City Modal ======-->
	<?
	$top_data = $this->db->order_by('id', 'desc')->get_where('tbl_cities', array('is_active'=> 1,'top'=> 1))->result();
	$other_data = $this->db->order_by('id', 'desc')->get_where('tbl_cities', array('is_active'=> 1,'top'=> 0))->result();
	?>
	<div class="modal fade " id="selectcity" role="dialog">
		<div class="modal-dialog " style="width: auto;">
			<!-- Modal content-->
			<div class="modal-content ">
				<div class="modal-header">
					<h4 class="modal-title" >Select City</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p style="font-size:18px;">Top Cities</p>
					<?php $i=1; foreach($top_data as $data) {?>
					<h5 class="citieslist" onclick="set_city(this)" city_id="<?=$data->id?>" name="<?=$data->name?>" id="wc_<?=$data->id?>"> <img src="<?=base_url().$data->photo?>" alt="<?=$data->name?>" width="10%" style="margin-top: -13px;"><?=$data->name?></h5>
					<?php $i++; } ?>
					<p style="font-size: 16px;">Other Cities</p>
					<?php $i=1; foreach($other_data as $data) { ?>
					<h5 class="citieslist" onclick="set_city(this)" city_id="<?=$data->id?>" name="<?=$data->name?>" id="wc_<?=$data->id?>"> <img src="<?=base_url().$data->photo?>" alt="<?=$data->name?>" width="10%" style="margin-top: -13px;"> <?=$data->name?></h5>
					<?php $i++; } ?>
				</div>
			</div>
		</div>
	</div>
	<!--====== Select City Modal End ======-->
	<!--====== Select City2 Modal ======-->
	<div class="modal fade " id="selectcity2" role="dialog">
		<div class="modal-dialog " style="width: auto;">
			<!-- Modal content-->
			<div class="modal-content ">
				<div class="modal-header">
					<h4 class="modal-title">Select City</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p style="font-size:18px;">Top Cities</p>
					<?php $i=1; foreach($top_data as $data) { ?>
					<h5 class="citieslist"  onclick="set_city(this)" city_id="<?=$data->id?>" name="<?=$data->name?>"id="mc_<?=$data->id?>"> <img src="<?=base_url().$data->photo?>" alt="<?=$data->name?>" width="10%" style="margin-top: -13px;"> <?=$data->name?></h5>
					<?php $i++; } ?>
					<p style="font-size: 16px;">Other Cities</p>
					<?php $i=1; foreach($other_data as $data) { ?>
					<h5 class="citieslist"  onclick="set_city(this)" city_id="<?=$data->id?>" name="<?=$data->name?>" id="mc_<?=$data->id?>"> <img src="<?=base_url().$data->photo?>" alt="<?=$data->name?>" width="10%" style="margin-top: -13px;"> <?=$data->name?></h5>
					<?php $i++; } ?>
				</div>
			</div>
		</div>
	</div>
	<!--====== Select City2 Modal End ======-->
	<!--======Promo Modal ======-->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Flat 5% off</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p>Use code Demo4 and get flat 5% off</p>
					<div class="row">
						<div class="promopath">
							<span class="span_1" id="textcopy">Demo4</span>
							<span class="span_2 float-right">
								<i class="fa fa-copy" style="cursor: pointer;" onclick="myFunction()"></i>
							</span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<p> Terms & Conditions</p> <br>
					<ul class="listdots">
						<li>Applicable on booking with minimum duration 6 days</li>
						<li>Not applicable on booking where fuel is included</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--======Promo Modal End ======-->
	<!--======login Modal ======-->
	<div class="modal fade" id="loginModal" role="dialog" style="z-index: 999999;">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content loginModal-content">
				<div class="modal-header">
					<div class="col-md-11 text-center">
						<h4 class="modal-title">Login</h4>
					</div>
					<div class="col-md-1"> <button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
				</div>
				<div class="modal-body">
				<form method="post" id="loginForm"  enctype="multipart/form-data" action="javascript:void(0)">
					<div class="formsix-pos">
						<div class="form-group mb-4">
							<input type="text" class="form-control modalinput" required="" name="phone" id="loginPhone" placeholder="Enter Mobile Number *"  onkeypress="return isNumberKey(event)" maxlength="10" minlength="10" >
						</div>
						<div class="form-group" style="display:none" id="loginotp_div">
							<input type="text" class="form-control modalinput" name="otp" id="loginOTP" placeholder="Enter OTP *" onkeypress="return isNumberKey(event)" maxlength="6" minlength="6">
						</div>
					</div>
						<input type="hidden" id="loginverify" value="0" name="loginverify" />
					<div class="row justify-content-center mt-4">
						<button class="btn col-md-4 loginbtn" type="submit"> <i class="fa fa-power-off"></i> &nbsp; Login</button></div>
				</form>
					<div class="row justify-content-center mt-2">
						<span> Dont't have account yet? &nbsp; <a href="#" class="getlink" data-toggle="modal" data-target="#signupModal" data-dismiss="modal">Sign Up</a> </span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--======login Modal End ======-->
	<!--======Sign Up Modal ======-->
	<div class="modal fade" id="signupModal" role="dialog" style="z-index: 999999;">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content loginModal-content">
				<div class="modal-header">
					<div class="col-md-11 text-center">
						<h4 class="modal-title">Sign Up</h4>
					</div>
					<div class="col-md-1"> <button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
				</div>
				<div class="modal-body">
						<form method="post" id="registerForm"  enctype="multipart/form-data" action="javascript:void(0)">
					<div class="formsix-pos">
						<div class="row">
							<div class="form-group mb-4 col-md-6 col-12">
								<input type="text" name="fname" id="signupFname" class="form-control modalinput" required="" placeholder="First Name *">
							</div>
							<div class="form-group col-md-6 col-12">
								<input type="text" name="lname" id="signupLname" class="form-control modalinput" required="" placeholder="Last Name*">
							</div>
							<div class="form-group col-md-6 col-12">
								<input type="email" name="email" id="signupEmail" class="form-control modalinput" required="" placeholder="E-mail*">
							</div>
							<div class="form-group mb-4 col-md-6 col-12">
								<input type="text" name="phone" id="signupPhone" class="form-control modalinput" required="" placeholder="Enter mobile Number*" onkeypress="return isNumberKey(event)" maxlength="10" minlength="10">
							</div>
							<input type="hidden" id="signupverify" value="0" name="signupverify" />
							<div class="form-group col-md-12 col-12" style="display:none" id="otp_div">
								<input type="text" class="form-control modalinput" id="signupOTP"  name="signupOTP"   placeholder="Enter OTP*" onkeypress="return isNumberKey(event)" maxlength="6" minlength="6">
							</div>
						</div>
					</div>
					<div class="row justify-content-center"><button class="btn col-md-4 loginbtn" type="submit"> <i class="fa fa-user"></i> &nbsp; Sign Up</button></div>
				</form>
					<div class="row justify-content-center mt-2">
						<span> Already have an account? &nbsp; <a href="#" class="getlink" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Login</a> </span>
					</div>
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
	<!--======Sign Up Modal End ======-->
	<!--====================== Header Start ======================-->
	<div class="hs_navigation_header_wrapper" style="position: fixed;top: 0;z-index: 11111;box-shadow: 0px 1px 10px rgb(209 209 209);">
		<div class="container">
			<div class="row">
				<div class=" col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 mb-3 d-none d-sm-none d-xs-none d-md-block">
					<div class="hs_logo_wrapper ">
						<a href="<?=base_url()?>">
							<img src="<?=base_url()?>assets/frontend/images/cabmenewlogo.png" alt="" width="80%">
						</a>
					</div>
				</div>
				<div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12">
					<div class="row justify-content-end mobileheaderbtn" style="margin-top: 30px;">
					  <?if(empty($this->session->userdata('user_data'))){?>
						<button class="btn bg-b mr-3" data-toggle="modal" data-target="#signupModal"> <span style="color: #fff;"> <i class="fa fa-user"></i> &nbsp;Sign Up </span></button>
						<button class="btn bg-b mr-3" data-toggle="modal" data-target="#loginModal"> <span style="color: #fff;"> <i class="fa fa-power-off"></i> &nbsp;Login </span></button>
						<?}else{?>
						<div class="dropdown-wrapper menu-button menu_button_end ml-2 text-center">
							 <a class="menu-button" href="#">
								<i class="fa fa-user" style="color: #fff;font-size: 20px;margin-top: 10px;"></i><br />
								<span  style="color: #fff;"><?=$this->session->userdata('name')?></span>
							</a>
							<div class="drop-menu" style="top: 90%;right: -100px;">
								<div class="cc_cart_wrapper1">
									<div class="cc_cart_img_wrapper">
										<i class="fa fa-user"></i> &nbsp;
										<a href="my_profile.html">My Profile</a>
									</div>
								</div>
								<div class="cc_cart_wrapper1 cc_cart_wrapper2">
									<div class="cc_cart_img_wrapper mt-3">
										<i class="fa fa-car"></i> &nbsp;
										<a href="my_profile.html#booking">My Booking</a>
									</div>
								</div>
								<div class="cc_cart_wrapper1">
									<div class="cc_cart_img_wrapper mt-3">
										<i class="fa fa-power-off"></i> &nbsp;
										<a href="<?=base_url()?>User/logout">Logout</a>
									</div>
								</div>
							</div>
						</div>
						<?}?>
					</div>
					<!--====================== Mobile Navigation Start ======================-->
					<header class="mobail_menu d-none d-block d-xs-block d-sm-block d-md-none d-lg-none d-xl-none">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-4">
									<div class="cd-dropdown-wrapper" style="float: left;">
										<a class="house_toggle" href="#0">
											<i class="fa fa-bars" id="Capa_1" style="font-size:25px;color :red;"></i>
										</a>
										<!-- .cd-dropdown -->
									</div>
									<nav class="cd-dropdown">
										<div class="row mb-5">
											<div class="col-10">
												<p class="ml-4 mt-3">demo@gmail.com</p>
											</div>
											<div class="col-2">
												<a href="#0" class="cd-close" style="margin-right: 25px;">Close</a>
											</div>
											<ul class="cd-dropdown-content mobilelinks mt-3">
												<li class="mb-3 mt-2">
													<button class="btn ml-5" data-toggle="modal" data-target="#loginModal" style="background-color:red;color: #fff;"><i class="fa fa-power-off"></i>
														&nbsp;Login </button>
													<button class="btn ml-5" data-toggle="modal" data-target="#signupModal" style="background-color:red;color: #fff;"><i class="fa fa-user"></i> &nbsp;Sign
														Up
													</button>
												</li>
												<li>
													<a href="summary.html">Summary</a>
												</li>
												</li>
												<li>
													<a href="my_profile.html">My Profile</a>
												</li>
												</li>
												<li>
													<a href="faq.html">FAQ's</a>
												</li>
												</li>
												<li>
													<a href="#">Checkout</a>
												</li>
												</li>
												<li>
													<a href="#">Policy</a>
												</li>
												</li>
												<li>
													<a href="#">Contact Us</a>
												</li>
												</li>
												<li>
													<a href="#">Log Out</a>
												</li>
												</li>
												<h2><a href="index.html"><img src="images/cabme_logo.png" alt="cabme_logo" width="50%"></a></h2>
											</ul>
										</div>
										<!-- .cd-dropdown-content -->
									</nav>
								</div>
								<div class="col-xs-6 col-sm-6 col-8">
									<div class="hs_logo mb-3">
										<a href="<?=base_url()?>">
											<img src="<?=base_url()?>assets/frontend/images/cabmenewlogo.png" alt="Logo" title="Logo" width="60%" style="margin-left:-15px;">
										</a>
									</div>
								</div>
							</div>
						</div>
						<!-- .cd-dropdown-wrapper -->
					</header>
					<!--====================== mobile Navigation End ======================-->
				</div>
			</div>
		</div>
    <div class="container-fluid p-2" style="background-color: #fff;">
    				<div class="container">
    				<div class="row mobileform" style="border-radius: 10px;display: flex;flex-wrap: nowrap;">
    					<div class="col-md-3 col-12 p-0" data-toggle="modal" data-target="#selectcity" data-dismiss="modal">
    						<div class="selectcity" style="border: 1px solid rgb(226, 225, 225);height: 55px;">
    							<i class="fa fa-map-marker"></i>
    							<h5 class="city_title">Select City</h5>
    						</div>
    					</div>
    					<div class="col-md-3 col-6 mobileradius"
    						style="z-index: 0;display: flex;height: 54px;padding: 0px;border: 1px solid rgb(226, 225, 225);margin-top: 1px;">
    						<div class="form-sec-header" style="height: 50px;">
    							<label class="cal-icon" style="top:11px;left: 10px;"> Start Date
    								<input type="text" placeholder="" value="<?=$search[0]->start_date?>" class="form-control datepicker"
    									style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -5px;background: transparent;">
    							</label>

    						</div>
    						<div class="timepicker_div form-sec-header" style="height: 50px;width: 80px;margin-left: 12px;">
    							<label class="cal-icon" style="top:11px;left: 10px;">TIME
    								<input type="text" class="form-control timepicker" placeholder="" value="<?=$search[0]->start_time?>"
    									style="background-color: transparent;border: none;margin-left: -13px; margin-top: -5px; width: 122%;">
    						</div>
    					</div>

    					<div class="col-md-3 col-6 mobileradius brright"
    						style="z-index: 0;display: flex;height: 54px;padding: 0px;border: 1px solid rgb(226, 225, 225);margin-top: 1px;">
    						<div class="form-sec-header" style="height: 50px;">
    							<label class="cal-icon" style="top:11px;left: 10px;"> End Date
    								<input type="text" placeholder="" value="<?=$search[0]->end_date?>" class="form-control datepicker"
    									style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -5px;background: transparent;">
    							</label>

    						</div>
    						<div class="timepicker_div form-sec-header" style="height: 50px;width: 80px;margin-left: 12px;">
    							<label class="cal-icon" style="top:11px;left: 10px;">TIME
    								<input type="text" class="form-control timepicker" placeholder="" value="<?=$search[0]->end_time?>"
    									style="background-color: transparent;border: none;margin-left: -13px; margin-top: -5px; width: 122%;">
    						</div>
    					</div>
    					<button class="headerbtn mt-2 desktopbtn shadowbtn pdbtn"
    						style="height: 45px;font-weight: bold;letter-spacing: 1px;margin-left: 20px;">Search</button>
    				</div>
    				<div class="text-center col-md-12 col-12 pt-2">
    				<h6>Duration: 1 day, 2 hours</h6>
    					</div>
    			</div>
    			</div>
	</div>
	<!-- HeaqderEnd -->
