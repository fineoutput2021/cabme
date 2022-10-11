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
	<link rel="shortcut icon" type="image/png" href="<?=base_url()?>assets/frontend/images/cabme_logo.png" />
	<style>
		/* .mobilenav-tabs {
			border: .5px solid rgb(194, 192, 192);
		} */
		.mobilenav-tabs .nav-item .nav-link {
			/* border-left: .5px solid rgb(194, 193, 193); */
			padding-left: 16px;
			padding: 3px 10px !important;
			padding-right: 16px;
		}
	</style>
</head>

<body>
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
							<button class="btn col-md-10  searchbtn">Book</button>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--====== Info Modal End ======-->
	<!--====== Select City Modal ======-->
	<div class="modal fade " id="selectcity" role="dialog">
		<div class="modal-dialog " style="width: auto;">
			<!-- Modal content-->
			<div class="modal-content ">
				<div class="modal-header">
					<h4 class="modal-title">Select City</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<?$tbl_cities = $this->db->get_where('tbl_cities', array('is_active'=> 1))->result();
					foreach ($tbl_cities as $city) {
					?>
					<h5 class="citieslist"> <img src="<?=base_url().$city->photo?>" alt="<?=$city->name?>" width="10%" style="margin-top: -13px;"> <?=$city->name?></h5>
					<?}?>
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
					<h4 class="modal-title">Select City5</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<p style="font-size:18px;">Top Cities</p>
					<h5 class="citieslist"> <img src="<?=base_url()?>assets/frontend/images/jaipur.webp" alt="jaipur" width="10%" style="margin-top: -13px;"> Jaipur</h5>
					<h5 class="citieslist">Banglore</h5>
					<h5 class="citieslist">Mumbai</h5>
					<h5 class="citieslist">Chennai</h5>
					<h5 class="citieslist">Pune</h5>
					<p style="font-size: 16px;">Other Cities</p>
					<h5 class="citieslist2">Kolkata</h5>
					<h5 class="citieslist2">Ahemdabad</h5>
					<h5 class="citieslist2">Kochi</h5>
					<h5 class="citieslist2">Nagpur</h5>
					<h5 class="citieslist2">Surat</h5>
					<h5 class="citieslist2">Triputi</h5>
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
					<div class="formsix-pos">
						<div class="form-group mb-4">
							<input type="text" class="form-control modalinput" required="" placeholder="Enter Mobile Number *">
						</div>
						<div class="form-group">
							<input type="text" class="form-control modalinput" required="" placeholder="Enter OTP *">
						</div>
					</div>
					<div class="row justify-content-center"><button class="btn col-md-4 loginbtn"> <i class="fa fa-power-off"></i> &nbsp; Login</button></div>
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
					<div class="formsix-pos">
						<div class="row">
							<div class="form-group mb-4 col-md-6 col-12">
								<input type="text" class="form-control modalinput" required="" placeholder="First Name *">
							</div>
							<div class="form-group col-md-6 col-12">
								<input type="text" class="form-control modalinput" required="" placeholder="Last Name*">
							</div>
							<div class="form-group col-md-6 col-12">
								<input type="text" class="form-control modalinput" required="" placeholder="E-mail*">
							</div>
							<div class="form-group mb-4 col-md-6 col-12">
								<input type="text" class="form-control modalinput" required="" placeholder="Enter mobile Number*">
							</div>
							<div class="form-group col-md-12 col-12">
								<input type="text" class="form-control modalinput" required="" placeholder="Enter OTP*">
							</div>
						</div>
					</div>
					<div class="row justify-content-center"><button class="btn col-md-4 loginbtn"> <i class="fa fa-user"></i> &nbsp; Sign Up</button></div>
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
							<img src="<?=base_url()?>assets/frontend/images/cabme_logo.png" alt="">
						</a>
					</div>
				</div>
				<div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12">
					<div class="hs_navi_cart_wrapper  d-none d-sm-none d-xs-none d-md-block d-lg-block d-xl-block">
						<div class="dropdown-wrapper menu-button menu_button_end"> <a class="menu-button" href="#"> <i class="fa fa-user"></i></a>
							<div class="drop-menu">
								<div class="cc_cart_wrapper1">
									<div class="cc_cart_img_wrapper">
										<i class="fa fa-user"></i> &nbsp;
										<a href="my_profile.html#profile">My Profile</a>
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
										<a href="#">Logout</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<button class="btn headerloginbtn" data-toggle="modal" data-target="#signupModal"><i class="fa fa-user"></i> &nbsp;Sign Up </button>
					<button class="btn headerloginbtn mr-3" data-toggle="modal" data-target="#loginModal"><i class="fa fa-power-off"></i> &nbsp;Login </button>
					<!--====================== Mobile Navigation Start ======================-->
					<header class="mobail_menu d-none d-block d-xs-block d-sm-block d-md-none d-lg-none d-xl-none">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-6">
									<div class="hs_logo mb-3">
										<a href="<?=base_url()?>">
											<img src="images/cabme_logo.png" alt="Logo" title="Logo" width="90%">
										</a>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-6">
									<div class="cd-dropdown-wrapper">
										<a class="house_toggle" href="#0">
											<i class="fa fa-bars" id="Capa_1" style="font-size:25px;color :red;"></i>
										</a>
										<!-- .cd-dropdown -->
									</div>
									<nav class="cd-dropdown">
										<div class="row mb-5">
											<div class="col-10">
												<h2><a href="<?=base_url()?>"><img src="<?=base_url()?>assets/frontend/images/cabme_logo.png" alt="cabme_logo" width="50%"></a></h2>
												<p class="ml-4" style="margin-top: -10px;">demo@gmail.com</p>
											</div>
											<div class="col-2">
												<a href="#0" class="cd-close" style="margin-right: 25px;">Close</a>
											</div>
											<ul class="cd-dropdown-content mobilelinks mt-3">
												<li class="mb-3 mt-5">
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
											</ul>
										</div>
										<!-- .cd-dropdown-content -->
									</nav>
								</div>
							</div>
						</div>
						<!-- .cd-dropdown-wrapper -->
					</header>
					<!--====================== mobile Navigation End ======================-->
				</div>
			</div>
		</div>
	</div>
	<!-- HeaqderEnd -->
