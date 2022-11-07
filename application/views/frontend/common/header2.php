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
	<input type="hidden" id="active" value="1">
	<input type="hidden" id="device" value="">

	<!--====== Sort By Modal ======-->

	<div class="sortbyModal fade" id="sortbyModal" role="dialog">
		<div class="modal-dialog" style="margin-left: -1px;">

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
						<li onclick ="mobile_sort('none')" style="color:<?if($sort=='none'||$sort==''){echo 'red';}?>">
							None
						</li>
						<li onclick ="mobile_sort('asc')" style="color:<?if($sort=='asc'){echo 'red';}?>">
						Price: &nbsp;	Low To High
						</li>
						<li onclick ="mobile_sort('desc')" style="color:<?if($sort=='desc'){echo 'red';}?>">
							Price: &nbsp; High To Low
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<!--======Sort By Modal End ======-->

	<!--====== Info Modal End ======-->
	<!--====== Select City Modal ======-->
	<?
	$top_data = $this->db->order_by('id', 'desc')->get_where('tbl_cities', array('is_active'=> 1,'top'=> 1,'city_type'=>1))->result();
	$other_data = $this->db->order_by('id', 'desc')->get_where('tbl_cities', array('is_active'=> 1,'top'=> 0,'city_type'=>1))->result();
	?>
	<div class="modal fade" id="selectcity" role="dialog" style="z-index:99999">
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
	<div class="modal fade " id="selectcity2" role="dialog" style="z-index:99999">
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
						<div class=" menu_button_end ml-2 text-center row mt-2">
							 <a class="menu-button px-4" href="<?=base_url()?>">
								<!-- <i class="fa fa-home" style="color: #fff;font-size: 20px;margin-top: 10px;"></i><br /> -->
								<span class="underline"  style="color: #fff;">Home</span>
							</a>
							</a>
							 <a class="menu-button px-4" href="<?=base_url()?>Home/about">
								<!-- <i class="fa fa-clock-o" style="color: #fff;font-size: 20px;margin-top: 10px;"></i><br /> -->
								<span class="underline" style="color: #fff;">About Us</span>
							</a>
							 <a class="menu-button px-4" href="<?=base_url()?>Home/contact">
								<!-- <i class="fa fa-sign-out" style="color: #fff;font-size: 20px;margin-top: 10px;"></i><br /> -->
								<span class="underline"  style="color: #fff;">Contact Us</span>
							</a>
						</div>
					  <?if(empty($this->session->userdata('user_data'))){?>
						<button class="btn bg-b" style="margin: 0 20px 0 20px;"  data-toggle="modal" data-target="#signupModal"> <span style="color: #fff;"> <i class="fa fa-user"></i> &nbsp;Sign Up </span></button>
						<button class="btn bg-b" style="margin: 0 20px 0 20px;"  data-toggle="modal" data-target="#loginModal"> <span style="color: #fff;"> <i class="fa fa-power-off"></i> &nbsp;Login </span></button>
						<?}else{?>
						<div class="dropdown-wrapper menu-button menu_button_end ml-2 text-center row mt-2">
							<a class="menu-button px-4" href="<?=base_url()?>Home/my_profile">
							 <!-- <i class="fa fa-user" style="color: #fff;font-size: 20px;margin-top: 10px;"></i><br /> -->
							 <span  style="color: #fff;">Profile</span>
						 </a>
						 </a>
							<a class="menu-button px-4" href="<?=base_url()?>Home/my_profile#booking">
							 <!-- <i class="fa fa-clock-o" style="color: #fff;font-size: 20px;margin-top: 10px;"></i><br /> -->
							 <span  style="color: #fff;">Booking</span>
						 </a>
							<a class="menu-button px-4" href="<?=base_url()?>User/logout">
							 <!-- <i class="fa fa-sign-out" style="color: #fff;font-size: 20px;margin-top: 10px;"></i><br /> -->
							 <span  style="color: #fff;">Logout</span>
						 </a>
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
												<?if(!empty($this->session->userdata('user_data'))){?>
												<h5 class="ml-4 mt-3">Hello,<b><?=$this->session->userdata('name')?></b></h5>
												<?}?>
											</div>
											<div class="col-2">
												<a href="#0" class="cd-close" style="margin-right: 25px;">Close</a>
											</div>
											<ul class="cd-dropdown-content mobilelinks mt-3">
												<?if(empty($this->session->userdata('user_data'))){?>
												<li class="mb-3 mt-2">
													<button class="btn ml-5 house_toggle" data-toggle="modal"  data-target="#loginModal" style="background-color:red;color: #fff;"><i class="fa fa-power-off"></i>
														&nbsp;Login </button>
													<button class="btn ml-5 house_toggle" data-toggle="modal"  data-target="#signupModal" style="background-color:red;color: #fff;"><i class="fa fa-user"></i> &nbsp;Sign
														Up
													</button>
												</li>
												<?}else{?>
													<li>
														<a href="<?=base_url()?>Home/my_profile">My Profile</a>
													</li>
													<?}?>
												<li>
													<a href="<?=base_url()?>Home/about">About Us</a>
												</li>
												<li>
													<a href="<?=base_url()?>Home/privacy_policy">Privacy Policy</a>
												</li>
												<li>
													<a href="<?=base_url()?>Home/term_and_condition">Terms & Conditions</a>
												</li>
												<li>
													<a href="<?=base_url()?>Home/contact">Contact Us</a>
												</li>
												<li>
													<a href="#">FAQ's</a>
												</li>
												</li>
												<?if(!empty($this->session->userdata('user_data'))){?>
												<li>
													<a href="<?=base_url()?>User/logout">Log Out</a>
												</li>
												<?}?>
												</li>
												<h2><a href="<?=base_url()?>"><img src="<?=base_url()?>assets/frontend/images/cabme_logo.png" alt="cabme_logo" width="50%"></a></h2>
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
			<?
			$days = (int)$search[0]->duration/24;
			$hours =  $search[0]->duration%24;
			if($hours>0 && $days >0){
				$s_duration="Duration: ".(int)$days." days, ".$hours." hours";
			}else if($hours==0 && $days>0){
				$s_duration="Duration: ".(int)$days." days";
			}else{
				$s_duration="Duration: ".$hours." hours";
			}
			$city = $this->db->get_where('tbl_cities', array('is_active'=> 1,'id'=> $search[0]->city_id))->result();
			?>
    				<div class="container">
						<form method="post" enctype="multipart/form-data" action="<?=base_url()?>Home/self_drive_cars">
    				<div class="row mobileform" style="border-radius: 10px;display: flex;flex-wrap: nowrap;">
    					<div class="col-md-3 col-12 p-0" data-toggle="modal" data-target="#selectcity" data-dismiss="modal">
    						<div class="selectcity" style="border: 1px solid rgb(226, 225, 225);height: 55px;">
    							<i class="fa fa-map-marker"></i>
									<?if(!empty($city)){?>
    							<h5 class="city_title"><?=$city[0]->name?></h5>
									<?}else{?>
    							<h5 class="city_title">Select City</h5>
									<?}?>
    						</div>
    					</div>
    					<div class="col-md-3 col-6 mobileradius"
    						style="z-index: 0;display: flex;height: 54px;padding: 0px;border: 1px solid rgb(226, 225, 225);margin-top: 1px;">
    						<div class="form-sec-header" style="height: 50px;">
    							<label class="cal-icon" style="top:11px;left: 10px;"> Start Date
    								<input type="text" autocomplete="off" id="sdsd" name="start_date" placeholder="" value="<?=$search[0]->start_date?>" class="form-control datepicker"
    									style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -5px;background: transparent;">

    							</label>

    						</div>
    						<div class="timepicker_div form-sec-header" style="height: 50px;width: 80px;margin-left: 12px;">
    							<label class="cal-icon" style="top:11px;left: 10px;">TIME
    								<input type="text" autocomplete="off" id="sdst" name="start_time" class="form-control timepicker" placeholder="" value="<?=$search[0]->start_time?>"
    									style="background-color: transparent;border: none;margin-left: -13px; margin-top: -5px; width: 122%;">
    						</div>
    					</div>
							<?if(!empty($search[0]->end_date)){?>
    					<div class="col-md-3 col-6 mobileradius brright"
    						style="z-index: 0;display: flex;height: 54px;padding: 0px;border: 1px solid rgb(226, 225, 225);margin-top: 1px;">
    						<div class="form-sec-header" style="height: 50px;">
    							<label class="cal-icon" style="top:11px;left: 10px;"> End Date
    								<input type="text" autocomplete="off" id="sded" name="end_date" placeholder="" value="<?=$search[0]->end_date?>" class="form-control datepicker"
    									style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -5px;background: transparent;">
    							</label>
    						</div>
    						<div class="timepicker_div form-sec-header" style="height: 50px;width: 80px;margin-left: 12px;">
    							<label class="cal-icon" style="top:11px;left: 10px;">TIME
    								<input type="text" autocomplete="off" id="sdet" name="end_time" class="form-control timepicker" placeholder="" value="<?=$search[0]->end_time?>"
    									style="background-color: transparent;border: none;margin-left: -13px; margin-top: -5px; width: 122%;">
    						</div>
    					</div>
							<?}?>
							<input type="hidden" name="city_id" class="city_id"  value="<?=$search[0]->city_id?>"/>
							<input type="hidden" name="duration" value="" id="duration">
							<input type="hidden" name="index" value="1" id="index">
    					<button class="headerbtn mt-2 desktopbtn shadowbtn pdbtn"
    						style="height: 45px;font-weight: bold;letter-spacing: 1px;margin-left: 20px;" type="submit" id="self_btn" >Search</button>
    					<button class="headerbtn mt-2 mobilebtn shadowbtn pdbtn d-none"
    						style="height: 31px;font-weight: bold;letter-spacing: 1px;margin-left:30%;" type="submit" id="self_btn" >Search</button>
    				</div>
							</form>
							<?if(!empty($search[0]->end_date)){?>
    				<div class="text-center col-md-12 col-12 pt-2">
    				<h6 id="s_duration"><?=$s_duration?></h6>
    					</div>
							<?}?>
    			</div>
    			</div>
	</div>
	<!-- HeaqderEnd -->
	<script>
			$(".datepicker").datepicker();
	</script>
