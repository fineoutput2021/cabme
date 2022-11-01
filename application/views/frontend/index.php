	<!-- ================================ web Form slider start ======================================================= -->
	<!-- hs Slider Start -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Goldman">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt">
	<style>
	.btn.disabled, .btn:disabled {
    opacity: 1 !important;
}
	.ball {
  position: absolute;
  top: 0;
  left: -20px;
  width: 10px;
  height: 10px;
  border-radius: 100%;
  background: #ff0000;
  margin-left: -5px;
  transition-property: left, top;
  transition-timing-function: cubic-bezier(.25,.1,.25,1), cubic-bezier(.25,.1,.25,1);
}
.reveal{
  position: relative;
  transform: translateY(150px);
  opacity: 0;
  transition: 2s all ease;
}
.reveal.active{
  transform: translateY(0);
  opacity: 1;
}
 #txt{
  position: relative;
  margin: 0;
  display: inline-block;
  text-align: center;
  font-size: 30px;
  outline: none;
}

.word.lit {
  color: #ff0000;
  /* text-shadow: 0px 0px 3px #ff0000; */
}

.testimonial{
	position: relative;
		background: url('<?=base_url()?>assets/frontend/images/test_bg.jpg') no-repeat fixed 0 0/cover;
		z-index: 1;
		padding-bottom: 50px;
}
.color_liner{
	background-image:linear-gradient(to right, #161616 0, #f50303 36%, #d93232 65%, #5e5e5e 100%);

}
.text_animation{
	font-weight: 700;
color: transparent;
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
-webkit-animation: hue 6s infinite linear;
}
.testimonial:after{
	position: absolute;
	content: "";
	top: 0;
	right: 0;
	width: 100%;
	height: 100%;
	background: rgba(0, 0, 0, 0.8) none repeat scroll 0 0;
	z-index: -1;
}
	.head:after {
	    right: 0px;
	}
	.head:before {
	    left: 0px;
	}
	.head{
		padding: 0px 40px;
	    position: relative;
	    display: inline-block;

	}
.head:before, .head:after {
    top: 50%;
    width: 20px;
    height: 8px;
    content: "";
    position: absolute;
    display: inline-block;
    transform: translateY(-50%);
    background-color: #EA001E;
}
	</style>
	<input type="hidden" id="active" value="1">
	<input type="hidden" id="device" value="">
	<input type="hidden" id="sd" value="">
	<input type="hidden" id="st" value="">
	<input type="hidden" id="ed" value="">
	<input type="hidden" id="et" value="">
	<div class="slider-area float_left desktopmainslider">
		<div id="carousel-example-generic" class="carousel slide" data-interval="5000" data-ride="carousel">
			<div class="carousel-inner" role="listbox">
				<div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12 d-none d-sm-none d-md-none  d-lg-block d-xl-block" style="position: absolute;z-index: 99;top: 25%;left: 10%;background-color: white;
    padding-top: 30px;border-radius: 20px;box-shadow: 0px 0 8px rgb(0 0 0 / 10%);">
					<div class="content_tabs">
						<div class="row">
							<div class="x_offer_tabs_wrapper" style="border-radius: 15px;width: 90%;margin-left: 29px;">
								<ul class="nav nav-tabs" style="width: 100%;padding: 8px;box-shadow: 0px 0 8px rgb(0 0 0 / 10%);">
									<li class="nav-item" style="width: 33%;"  onclick="setActive(1)"> <a class="nav-link dnav active" data-toggle="tab" href="#first">
											Self-Drive Cars</a>
									</li>
									<li class="nav-item" style="width: 33%"  onclick="setActive(2)"> <a class="nav-link dnav" data-toggle="tab" href="#second" >Outstation Booking</a>
									</li>
									<li class="nav-item" style="width: 34%;"  onclick="setActive(3)"> <a class="nav-link dnav" data-toggle="tab" href="#third">Intercity Travel</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="tab-content">
						<!-- self drive Form Tab -->
						<div id="first" class="tab-pane active">
							<form method="post" enctype="multipart/form-data" action="<?=base_url()?>Home/self_drive_cars">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="z-index: 0;">
								<div class="x_slider_form_main_wrapper float_left" style="margin-top: -5px;">
									<div class="row">
										<div class="row" style="border: 1px solid rgb(212, 208, 208);width: 99%;margin-left: 7px;border-radius: 10px;">
											<div class="col-md-12" data-toggle="modal" data-target="#selectcity" data-dismiss="modal" id="ss">
												<div class="selectcity">
													<i class="fa fa-map-marker"></i>
													<h5 style="margin-top: 3px;" class="city_title">Select City</h5>
												</div>
											</div>
											<div class="col-md-6 " style="z-index: 0;display: flex;height: 70px;border: 1px solid rgb(212, 208, 208);padding: 0px;">
												<div class="form-sec-header" style="height: 50px;padding: 12px 0px;">
													<label class="cal-icon" style="margin-top: 10px;margin-left: 10px;">Start Date
														<input type="text" autocomplete="off" readonly id="sdsd" name="start_date" placeholder="Date" required class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 5px;background-color: transparent;">
													</label>
												</div>
												<div class="timepicker_div form-sec-headers" style="height: 50px;margin-top: 2px;width: 90px;padding: 12px 0px;">
													<label class="cal-icon" style="margin-left: 8px;font-size: 11px;color: #000;font-weight: bold;margin-top: -3px;">START TIME
														<input type="text" autocomplete="off" id="sdst" readonly name="start_time" class="form-control timepicker" required placeholder="Time" style="padding: 23px 0px;background-color: transparent;border: none;width: 90%;margin-top: -10px;margin-left: -5px;" value="">
													</label>
												</div>
											</div>
											<div class="col-md-6 " style="z-index: 0;display: flex;height: 70px;border: 1px solid rgb(212, 208, 208);padding: 0px;">
												<div class="form-sec-header" style="height: 50px;padding: 12px 0px;">
													<label class="cal-icon" style="margin-top: 10px;margin-left: 10px;">End Date
														<input type="text" autocomplete="off" id="sded" readonly name="end_date" placeholder="Date" class="form-control datepicker" required style="border: none;padding-right: 0px;padding-left: 5px;background-color: transparent;">
													</label>
												</div>
												<div class="timepicker_div form-sec-headers" style="height: 50px;margin-top: 2px;width: 90px;padding: 12px 0px;">
													<label class="cal-icon" style="margin-left: 8px;font-size: 11px;color: #000;font-weight: bold;margin-top: -3px;">END TIME
														<input type="text" autocomplete="off" id="sdet" readonly name="end_time" class="form-control timepicker" placeholder="Time" required style="padding: 23px 0px;background-color: transparent;border: none;width: 90%;margin-top: -10px;margin-left: -5px;" value="">
													</label>
												</div>
											</div>
											<div class="text-center col-md-12 col-12 p-2">
												<h6 id="s_duration"></h6>
											</div>
										</div>
										<input type="hidden" name="city_id" class="city_id"  value=""/>
										<input type="hidden" name="duration" value="" id="duration">
										<input type="hidden" name="index" value="1" id="index">
										<div class="col-md-12">
											<div class="row mt-4 justify-content-center">
													<button class="btn col-md-10 searchbtn shadowbtn" type="submit" id="self_btn" disabled> <i class="fa fa-search"></i> &nbsp; Search</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							</form>
						</div>
						<!-- outstation Form Tab -->
						<div id="second" class="tab-pane">
							<form method="post" enctype="multipart/form-data" action="<?=base_url()?>Home/outstaion_cars">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="x_slider_form_main_wrapper float_left" style="margin-top: -5px;padding-top: 5px;">
									<div class="row justify-content-center" style="flex-wrap: nowrap;width: 100%;margin-top: 15px;">
										<ul class="nav nav-tabs roundtab mobilenav-tabs justify-content-center" style="display: flex; flex-wrap: nowrap;">
											<li class="nav-item" style="border-radius: 8px 0px 0px 8px;"> <a class="nav-link roundtab active" data-toggle="tab" href="#firsttttt" style="font-size: 13px;border-radius: 6px 0px 0px 6px;" onclick="change(3)">
													One Way </a>
											</li>
											<li class="nav-item" style="border-radius: 0px 8px 8px 0px;"> <a class="nav-link roundtab" data-toggle="tab" href="#thirdddddd" style="font-size: 13px;border-radius: 0px 6px 6px 0px;" onclick="change(4)">Round-Trip </a>
											</li>
										</ul>
									</div>
									<div class="row">
										<div id="location" style="display: flex;width: 100%;">
											<div class="col-md-12 mb-3">
												<div class="x_slider_select x_slider_select_2">
														<input type="text"  placeholder="Pickup Location" name="pick_location" required class="form-control" style="">
												</div>
											</div>
										</div>
										<div class="row" style="border: 1px solid rgb(212, 208, 208);width: 99%;margin-left: 7px;border-radius: 10px;">
											<div class="col-md-12" data-toggle="modal" data-target="#selectcity" data-dismiss="modal" id="ss">
												<div class="selectcity">
													<i class="fa fa-map-marker"></i>
													<h5 style="margin-top: 3px;" class="city_title">Select City</h5>
												</div>
											</div>
											<div id="change2" style="display: flex;" class="col-md-12 col-12 p-0">
												<div class="col-md-12 " style="z-index: 0;display: flex;height: 55px;border: 1px solid rgb(212, 208, 208);padding: 0px;justify-content: space-around;">
													<div class="form-sec-header" style="height: 50px;">
														<label class="cal-icon" style="margin-top: 10px;margin-left: 10px;">Start Date
															<input type="text" id="oosd" autocomplete="off" readonly placeholder="Date" name="start_date"  class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 5px;background-color: transparent;">
														</label>
													</div>
													<div class="timepicker_div form-sec-headers" style="height: 50px;width: 90px;">
														<label class="cal-icon" style="margin-left: 10px;font-size: 11px;color: #000;font-weight: bold;">START
															TIME
															<input type="text" id="oost" autocomplete="off" readonly name="start_time" class="form-control timepicker" placeholder="Time" style="padding: 23px 0px;background-color: transparent;border: none;width: 84%;margin-top: -11px;">
														</label>
													</div>
												</div>
											</div>
											<div class="text-center col-md-12 col-12 p-2">
												<h6 id="ot_duration"></h6>
											</div>
										</div>
										<input type="hidden" name="city_id" class="city_id"  value=""/>
										<input type="hidden" name="round_type" id="round_type"  value="1"/>
										<input type="hidden" name="duration" value="" id="o_duration">

										<div class="col-md-12 mt-3">
											<div class="row mt-2 justify-content-center">
													<button class="btn col-md-10 searchbtn shadowbtn" type="submit" id="outstation_btn" disabled> <i class="fa fa-search"></i> &nbsp;Search</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							</form>
						</div>
						<!-- intercity Form Tab -->
						<div id="third" class="tab-pane">
							<form method="post" enctype="multipart/form-data" action="javascript:void(0)" id="w_intercity_form">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="x_slider_form_main_wrapper float_left" style="margin-top: -5px;">
									<div class="row">
										<div class="col-md-12" style="margin-bottom: 10px;">
											<div class="x_slider_select x_slider_select_2" style="margin-top: 0px;">
												<select class="myselect" name="cab_type" required id=>
													<option value="Hatchback">Hatchback</option>
													<option value="XUV">XUV</option>
													<option value="Sedan">Sedan</option>
												</select> &nbsp; <i class="fa fa-car"></i>
											</div>
										</div>
										<div class="row" style="border: 1px solid rgb(212, 208, 208);width: 99%;margin-left: 7px;border-radius: 10px;">
											<div class="col-md-12" data-toggle="modal" data-target="#selectcity" data-dismiss="modal" id="ss">
												<div class="selectcity">
													<i class="fa fa-map-marker"></i>
													<h5 style="margin-top: 3px;" class="city_title">Select City</h5>
												</div>
											</div>
											<div class="col-md-6 " style="z-index: 0;display: flex;height: 55px;border: 1px solid rgb(212, 208, 208);padding: 0px;">
												<div class="form-sec-header" style="height: 50px;">
													<label class="cal-icon" style="margin-top: 10px;margin-left: 10px;">Start Date
														<input type="text" autocomplete="off" readonly id="icsd" name="start_date" placeholder="Date" required  class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 5px;background-color: transparent;">
													</label>
												</div>
												<div class="timepicker_div form-sec-headers" style="height: 50px;margin-top: 2px;width: 90px;">
													<label class="cal-icon" style="margin-left: 10px;font-size: 11px;color: #000;font-weight: bold;margin-top: -3px;">TIME
														<input type="text" autocomplete="off" readonly id="icst" name="start_time" placeholder="Time" required  class="form-control timepicker"  style="padding: 23px 0px;background-color: transparent;border: none;width: 90%;margin-top: -10px;margin-left: -5px;">
													</label>
												</div>
											</div>
											<div class="col-md-6 " style="z-index: 0;display: flex;height: 55px;border: 1px solid rgb(212, 208, 208);padding: 0px;">
												<div class="form-sec-header" style="height: 50px;">
													<label class="cal-icon" style="margin-top: 10px;margin-left: 10px;">End Date
														<input type="text" autocomplete="off" readonly id="iced" name="end_date" placeholder="Date" required class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 5px;background-color: transparent;">
													</label>
												</div>
												<div class="timepicker_div form-sec-headers" style="height: 50px;margin-top: 2px;width: 90px;">
													<label class="cal-icon" style="margin-left: 10px;font-size: 11px;color: #000;font-weight: bold;margin-top: -3px;">TIME
														<input type="text" autocomplete="off" readonly id="icet" name="end_time" class="form-control timepicker" required placeholder="Time" style="padding: 23px 0px;background-color: transparent;border: none;width: 90%;margin-top: -10px;margin-left: -5px;">
													</label>
												</div>
											</div>
											<div class="text-center col-md-12 col-12 p-2">
												<h6 id="ic_duration"></h6>
											</div>
										</div>
										<input type="hidden" name="city_id" class="city_id"  value=""/>
										<input type="hidden" name="duration" value="" id="i_duration">
										<div class="col-md-12 mt-3">
											<div class="row mt-2 justify-content-center">
												<button class="btn col-md-10 searchbtn shadowbtn" type="submit" id="iter_btn" disabled> <i class="fa fa-search"></i> &nbsp;Search</button>
											</div>
										</div>
									</div>
								</div>
							</div>
								</form>
						</div>


					</div>
				</div>
				<!-- =================== Start Slider ============================ -->
				<?php $i=1; foreach($banner_data as $banner) { ?>
				<div class="carousel-item <?if($i==1){echo 'active';}?>">
					<img src="<?=base_url().$banner->photo1?>" alt="banner_<?=$i?>">
				</div>
				<?php $i++; } ?>
				<ol class="carousel-indicators">
					<?php $i=0; foreach($banner_data as $banner) { ?>
					<li data-target="#carousel-example-generic" data-slide-to="<?=$i?>" class="<?if($i==0){echo 'active';}?>"><span class="number"></span>
					</li>
					<?php $i++; } ?>
				</ol>
				<div class="carousel-nevigation">
					<a class="prev" href="#carousel-example-generic" role="button" data-slide="prev"> <i class="fa fa-angle-left"></i>
					</a>
					<a class="next" href="#carousel-example-generic" role="button" data-slide="next"> <i class="fa fa-angle-right"></i>
					</a>
				</div>
				<!-- =================== End Slider ============================ -->
			</div>
		</div>
	</div>
	<!-- hs Slider End -->
	<!-- ================================  Web Form slider End ======================================================= -->
	<!-- ================================  Mobile Form =========================================== -->
	<div class="x_responsive_form_wrapper x_responsive_form_wrapper2 float_left d-block d-sm-block d-md-block  d-lg-none d-xl-none" style="margin-top: 100px;">
		<div class="container">
			<div class="x_slider_form_main_wrapper float_left">
				<div class="content_tabs" style="margin-top: -8px;">
					<div class="row">
						<div class="x_offer_tabs_wrapper" style="background-color: #fff;border-radius: 15px;width: 97%;margin-left: 5px;">
							<ul class="nav nav-tabs mobilenav-tabs justify-content-center" style="display: flex; flex-wrap: nowrap;box-shadow: 0px 1px 20px #fff;padding: 5px;border-radius: 10px;">
								<li class="nav-item" style="width: 120px;border-radius: 8px 0px 0px 8px;"  onclick="setActive(1)"> <a class="nav-link molink active" data-toggle="tab" href="#firsttt" style="border-radius: 8px 0px 0px 8px;">Self-Drive </a>
								</li>
								<li class="nav-item" style="width: 147px;"> <a class="nav-link molink" data-toggle="tab" href="#thirddd"  onclick="setActive(2)">Outstation </a>
								</li>
								<li class="nav-item" style="width: 147px;border-radius: 0px 8px 8px 0px;"> <a class="nav-link molink" data-toggle="tab" href="#seconddd" style="border-radius: 0px 8px 8px 0px;"  onclick="setActive(3)">Intercity
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="tab-content">
						<!-- self drive Form Tab -->
					<div id="firsttt" class="tab-pane active">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="x_slider_form_main_wrapper float_left">
							<form method="post" enctype="multipart/form-data" action="<?=base_url()?>Home/self_drive_cars">
								<div class="row" style="margin-top: 20px;">
									<div class="row" style="border: 1px solid rgb(226, 225, 225);border-radius: 10px;">
										<div class="col-md-12 p-0" data-toggle="modal" data-target="#selectcity" data-dismiss="modal" style="border-bottom:1px solid rgb(226, 225, 225);">
											<div class="selectcity">
												<i class="fa fa-map-marker"></i>
												<h5 class="city_title">Select City</h5>
											</div>
										</div>
										<div class="col-md-3 col-6 mobileradius" style="z-index: 0;display: flex;height: 55px;padding: 0px;border-right: 1px solid rgb(226, 225, 225);">
											<div class="form-sec-header" style="height: 50px;">
												<label class="cal-icon" style="top:11px;left: 10px;"> Start Date
													<input type="text" autocomplete="off" readonly required id="msdsd"  name="start_date" placeholder="Date" class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -9px;">
												</label>
											</div>
											<div class="timepicker_div form-sec-header" style="height: 50px;margin-top: 2px;width: 80px;margin-left: 12px;">
												<label class="cal-icon" style="top:11px;left: 10px;">TIME
													<input type="text" autocomplete="off"  id="msdst" required name="start_time" class="form-control timepicker" placeholder="Time" style="background-color: transparent;border: none;margin-left: -13px; margin-top: -10px; width: 122%;">
											</div>
										</div>
										<div class="col-md-3 col-6 mobileradius" style="z-index: 0;display: flex;height: 55px;padding: 0px;">
											<div class="form-sec-header" style="height: 50px;">
												<label class="cal-icon" style="top:11px;left: 10px;"> End Date
													<input type="text" autocomplete="off" readonly id="msded" required name="end_date" placeholder="Date" class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -9px;">
												</label>
											</div>
											<div class="timepicker_div form-sec-header" style="height: 50px;margin-top: 2px;width: 80px;margin-left: 12px;">
												<label class="cal-icon" style="top:11px;left: 10px;">TIME
													<input type="text" autocomplete="off" readonly  id="msdet" required name="end_time" placeholder="Time" class="form-control timepicker" style="background-color: transparent;border: none;margin-left: -13px; margin-top: -10px; width: 122%;">
											</div>
										</div>
									</div>
									<div class="text-center col-md-12 col-12 p-2">
										<h6 id="ms_duration"></h6>
									</div>
									<input type="hidden" name="city_id" class="city_id"  value=""/>
									<input type="hidden" name="duration" value="" id="mduration">
									<input type="hidden" name="index" value="1" id="mindex">
									<div class="col-md-12">
										<div class="row mt-4 justify-content-center">
														<button class="btn col-md-10 searchbtn shadowbtn" type="submit" id="mself_btn" disabled> <i class="fa fa-search"></i> &nbsp; Search</button>
										</div>
									</div>
								</div>
									</form>
							</div>
						</div>
					</div>
					<!-- second Form Tab -->
					<div id="seconddd" class="tab-pane">
						<form method="post" enctype="multipart/form-data" action="javascript:void(0)" id="m_intercity_form">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="x_slider_form_main_wrapper float_left">
								<div class="row">
									<div class="col-md-12 p-0">
										<div class="x_slider_select x_slider_select_2" style="margin-top: 0px;margin-left: -14px;">
											<select class="myselect" name="cab_type" required>
												<option value="Hatchback">Hatchback</option>
												<option value="XUV">XUV</option>
												<option value="Sedan">Sedan</option>
											</select> &nbsp; <i class="fa fa-car"></i>
										</div>
									</div>
									<div class="row mt-1" style="border: 1px solid rgb(226, 225, 225);border-radius: 10px;">
										<div class="col-md-12 p-0 selectcity" data-toggle="modal" data-target="#selectcity" data-dismiss="modal" style="border-bottom:1px solid rgb(226, 225, 225);">
											<div class="selectcity">
												<i class="fa fa-map-marker"></i>
												<h5  class="city_title">Select City</h5>
											</div>
										</div>
										<div class="col-md-3 col-6 mobileradius" style="z-index: 0;display: flex;height: 55px;padding: 0px;border-right: 1px solid rgb(226, 225, 225);">
											<div class="form-sec-header" style="height: 50px;">
												<label class="cal-icon" style="top:11px;left: 10px;"> Start Date
													<input type="text" autocomplete="off" readonly required id="micsd" name="start_date" placeholder="Date" class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -9px;">
												</label>
											</div>
											<div class="timepicker_div form-sec-header" style="height: 50px;margin-top: 2px;width: 80px;margin-left: 12px;">
												<label class="cal-icon" style="top:11px;left: 10px;">Time
													<input type="text" autocomplete="off" readonly required class="form-control timepicker"id="micst" name="start_time" placeholder="Time" style="background-color: transparent;border: none;margin-left: -13px; margin-top: -10px; width: 122%;">
											</div>
										</div>
										<div class="col-md-3 col-6 mobileradius" style="z-index: 0;display: flex;height: 55px;padding: 0px;">
											<div class="form-sec-header" style="height: 50px;">
												<label class="cal-icon" style="top:11px;left: 10px;"> End Date
													<input type="text" autocomplete="off" readonly required id="miced" name="end_date" placeholder="Date" class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -9px;">
												</label>
											</div>
											<div class="timepicker_div form-sec-header" style="height: 50px;margin-top: 2px;width: 80px;margin-left: 12px;">
												<label class="cal-icon" style="top:11px;left: 10px;">TIME
													<input type="text" autocomplete="off" readonly required id="micet" name="end_time" class="form-control timepicker" placeholder="Time" style="background-color: transparent;border: none;margin-left: -13px; margin-top: -10px; width: 122%;">
											</div>
										</div>
										<div class="text-center col-md-12 col-12 p-2">
											<h6 id="mic_duration"></h6>
										</div>
									</div>
									<input type="hidden" name="city_id" class="city_id"  value=""/>
									<input type="hidden" name="duration" value="" id="mi_duration">
									<div class="col-md-12 mt-3">
										<div class="row mt-2 justify-content-center">
												<button class="btn col-md-10 searchbtn shadowbtn" type="submit" id="miter_btn" disabled> <i class="fa fa-search"></i> &nbsp;Search</button>
										</div>
									</div>
								</div>
							</div>
						</div>
							</form>
					</div>
					<!-- Third Form Tab -->
					<div id="thirddd" class="tab-pane">
					<form method="post" enctype="multipart/form-data" action="<?=base_url()?>Home/outstaion_cars">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="x_slider_form_main_wrapper float_left">
								<div class="row justify-content-center" style="flex-wrap: nowrap;width: 100%;">
									<ul class="nav nav-tabs roundtab mobilenav-tabs justify-content-center" style="display: flex; flex-wrap: nowrap;">
										<li class="nav-item" style="border-radius: 8px 0px 0px 8px;"> <a class="nav-link roundtab active" data-toggle="tab" href="#firstt" style="font-size: 13px;border-radius: 6px 0px 0px 6px;" onclick="change(1)">
												One Way </a>
										</li>
										<li class="nav-item" style="border-radius: 0px 8px 8px 0px;"> <a class="nav-link roundtab" data-toggle="tab" href="#thirdd" style="font-size: 13px;border-radius: 0px 6px 6px 0px;" onclick="change(2)">Round-Trip </a>
										</li>
									</ul>
								</div>
								<div class="row">
									<div id="location2" style="display: flex;width: 100%;">
										<div class="col-md-12 col-12 p-0">
											<div class="x_slider_select x_slider_select_2" style="margin-left: -14px;">
											<input type="text" placeholder="Pickup Location"  name="pick_location" required class="form-control" style="">
											</div>
										</div>
									</div>
									<div class="row" style="border: 1px solid rgb(226, 225, 225);margin-top: 10px;border-radius: 10px;">
										<div class="col-md-12 p-0" data-toggle="modal" data-target="#selectcity" data-dismiss="modal" style="border-bottom:1px solid rgb(226, 225, 225);">
											<div class="selectcity">
												<i class="fa fa-map-marker"></i>
												<h5  class="city_title">Select City</h5>
											</div>
										</div>
										<div id="change" style="display: flex;" class="col-md-12 col-12 p-0">
											<div class="col-md-12 col-12 mobileradius" style="z-index: 0;display: flex;height: 55px;padding: 0px;border-right: 1px solid rgb(226, 225, 225);justify-content: space-around;">
												<div class="form-sec-header" style="height: 50px;">
													<label class="cal-icon" style="top:11px;left: 10px;"> Start Date
														<input type="text" autocomplete="off" readonly required placeholder="Date" name="start_date"  class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -9px;">
													</label>
												</div>
												<div class="timepicker_div form-sec-header" style="height: 50px;margin-top: 2px;width: 80px;margin-left: 12px;">
													<label class="cal-icon" style="top:11px;left: 10px;"> Start Time
														<input type="text" autocomplete="off" readonly required name="start_time" placeholder="Time" class="form-control timepicker" style="background-color: transparent;border: none;margin-left: 5px; margin-top: -10px; width: 84%;">
												</div>
											</div>
										</div>
									</div>
									<input type="hidden" name="city_id" class="city_id"  value=""/>
									<input type="hidden" name="round_type" id="mround_type"  value="1"/>
									<input type="hidden" name="duration" value="" id="mo_duration">
									<div class="col-md-12 mt-3">
										<div class="row mt-2 justify-content-center">
												<button class="btn col-md-10 searchbtn shadowbtn" type="submit" id="outstation_btn" disabled> <i class="fa fa-search"></i> &nbsp;Search</button>
										</div>
									</div>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- ================================  Mobile Form End =========================================== -->

		<!--================================= Why Cabme slider Start ======================================-->
		<div class="x_ln_car_main_wrapper float_left  mb-5 reveal" style="z-index: 0;background-image: linear-gradient(0deg, rgb(12, 12, 15), rgb(41, 45, 69))">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="text-center">
							<h3 class="head mt-5" style="font-family:Goldman;color:white"><b>Why Cabme</b></h3>
						</div>
					</div>
					<div class="col-md-12" style="">
						<div class="btc_ln_slider_wrapper " style="margin-bottom: 80px;" >
							<div class="row">
							<div class="col-md-4 my-4 ">
								<div class="text-center">
									<img  src="<?=base_url()?>assets/frontend/images/shield.png"/>
									<h3 class="mt-3" style="font-weight: 500;color:white;font-family:Goldman">Secured Payment Guarantee</h3>
								</div>
							</div>
							<div class="col-md-4 my-4 ">
								<div class="text-center">
									<img  src="<?=base_url()?>assets/frontend/images/support.png"/>
									<h3 class="mt-3" style="font-weight: 500;color:white; font-family:Goldman">Help Center & Support 24/7</h3>
								</div>
							</div>
							<div class="col-md-4 my-4 ">
								<div class="text-center">
									<img  src="<?=base_url()?>assets/frontend/images/car.png"/>
									<h3 class="mt-3" style="font-weight: 500;color:white; font-family:Goldman">Booking any Class Vehicles</h3>
								</div>
							</div>
							<div class="col-md-4 my-4 " >
								<div class="text-center">
									<img  src="<?=base_url()?>assets/frontend/images/safety.png"/>
									<h3 class="mt-3" style="font-weight: 500;color:white; font-family:Goldman">Safety & Hygiene Best Practices</h3>
								</div>
							</div>
							<div class="col-md-4 my-4 " >
								<div class="text-center">
									<img  src="<?=base_url()?>assets/frontend/images/sprey.png"/>
									<h3 class="mt-3" style="font-weight: 500;color:white; font-family:Goldman">Internal & External Sanitization</h3>
								</div>
							</div>
							<div class="col-md-4 my-4 ">
								<div class="text-center">
									<img  src="<?=base_url()?>assets/frontend/images/deal.png"/>
									<h3 class="mt-3" style="font-weight: 500;color:white; font-family:Goldman">Contact-less Doorstep Delivery</h3>
								</div>
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--================================= Why Cabme slider End ======================================-->
		<!--================================= Featured Slider Start ======================================-->
		<div class="container reveal">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<img src="<?=base_url()?>assets/frontend/images/scorpio.png" class="img-fluid" />
						</div>
						<div class="col-md-6 text-justify">
							<div>
								<h3 id="txt" class="mt-5 bouncer" contenteditable style="font-family:Goldman;"><b>Your Travel Partner</b></h3>
							</div>
							<br />
							<p>We are India's leading Car Rental Company with an innovative way of servicing the requirements of the ever growing car rental industry in India as compared to other such service provider</p>
							<br />
							<p>Cabme is the ONLY company that focuses on this innovative business model of allowing its customer to take the car on a Short Term & Long Term Lease, Weekend Gateways for SELF DRIVE.</p>
						</div>
					</div>
				</div>

	<!--================================= Mobile FAQ's ======================================-->
	<div class="col-md-12">
		<div class="text-center mb-5">
			<h3 class="head mt-5" style="font-family:Goldman;"><b>FAQ's</b></h3>
		</div>
	</div>
	<div class="container-fluid p-5" style="background-color: #fff;border-radius: 10px;box-shadow:0px 1px 10px rgb(209, 209, 209);">
		<div class="car-filter accordion ">
			<div class="panel panel-default">
				<div class="panel-heading" style="border-bottom: 1px solid rgb(173, 173, 173);">
					<h4 class="panel-title  mb-2 mt-2"> <a data-toggle="collapse" href="#collapse_1" class="collapse">Is there a speed limit?</a> </h4>
				</div>
				<div id="collapse_1" class="collapse show mb-3">
					<div class="panel-body">
						<p>110 Kms/Hr is the speed limit. Exceeding it willattract a penalty for over-speeding. In some states(e.g., Karnataka, Maharashtra, Delhi-NCR), some carsmight be equipped with speed governors, which willautomatically restrict the speed to 80Kms/Hr. This isas per government directives.</p>
					</div>
				</div>
				<div class="panel-heading" style="border-bottom: 1px solid rgb(173, 173, 173);">
					<h4 class="panel-title mb-2 mt-2"> <a data-toggle="collapse" href="#collapse_3" class="collapse">"KILOMETRES LIMIT" TO HOW MUCH I CAN DRIVE?</a> </h4>
				</div>
				<div id="collapse_3" class="collapse show mb-3">
					<div class="panel-body">
						<p>This depends on the pricing plan that you select. Ifyou go for the “Unlimited kms” pricing plans(available only without fuel, and only for bookingswhose duration is more than 72 hours), there isabsolutely no limit to the kilometres that you candrive, and you have complete flexibility of drivingthe car as much as you want. Revv it up!</p>
					</div>
				</div>
				<div class="panel-heading" style="border-bottom: 1px solid rgb(173, 173, 173);">
					<h4 class="panel-title mb-2 mt-2"> <a data-toggle="collapse" href="#collapse_2" class="collapse">PRICE IN PEAK SEASON</a>
					</h4>
				</div>
				<div id="collapse_2" class="collapse show mb-3">
					<div class="panel-body">
						<p>Peak season refers to festive periods of very highdemand. Our hourly rental tariffs are different forweekdays (Mon-Fri), weekends (Sat-Sun) and thePeak Season. The dates and prices for the PeakSeason are dynamically decided based on thedemand.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================================= Mobile FAQ's End ======================================-->
	<!--================================= Our journey Start ======================================-->
	<div class="col-md-12">
		<div class="text-center mb-5">
			<h3 class="head mt-5" style="font-family:Goldman;"><b>Our journey so far</b></h3>
		</div>
	</div>
	<div class="container-fluid p-2 mb-5">
		<div class="container-fluid mt-3 p-3" style="background-color: #fff;box-shadow:0px 1px 10px rgb(209, 209, 209);">
			<div class="row">
				<div class="col-md-3 col-6 text-center imagewidth p-3">
					<div class="row justify-content-center"> <img src="<?=base_url()?>assets/frontend/images/customers.png" alt="Happy Customers"> </div>
					<h4 class="mt-2"><span id="number1" style="font-weight: 700;">800</span>+</h4>
					<p>Happy Customers</p>
				</div>
				<div class="col-md-3 col-6 text-center imagewidth p-3">
					<div class="row justify-content-center"> <img src="<?=base_url()?>assets/frontend/images/cities.png" alt="Across India" > </div>
					<h4 class="mt-2"><span id="number2" style="font-weight: 700;">25</span>+</h4>
					<p>Cities Across India</p>
				</div>
				<div class="col-md-3 col-6 text-center imagewidth p-3">
					<div class="row justify-content-center"> <img src="<?=base_url()?>assets/frontend/images/travel.png" alt="Travelled"> </div>
					<h4 class="mt-2"><span id="number3" style="font-weight: 700;">50000</span>+</h4>
					<p>Km's Travelled</p>
				</div>
				<div class="col-md-3 col-6 text-center imagewidth p-3">
					<div class="row justify-content-center"> <img src="<?=base_url()?>assets/frontend/images/rating.png" alt="Ratings"> </div>
					<h4 class="mt-2"><span id="number4" style="font-weight: 700;">4.5</span> / 5</h4>
					<p>20K+ reviewers</p>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
	<!--================================= Our journey End ======================================-->
	<!-- =================== Testimonial ================================== -->
	<div class="x_offer_car_main_wrapper float_left testimonial reveal">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="text-center">
						<h3 class="head mt-5" style="font-family:Goldman;color:white"><b>Reviews</b></h3>
					</div>
				</div>
				<div class="col-md-12" style="z-index: 0;">
					<div class="screenshot" >
						<div class="owl-carousel screen nplr screen-loop" >
							<?php $i=1; foreach($testimonials_data as $testimonials) { ?>
							<div style="background-color:#ffeeee">
								<div class="card valign-wrapper" >
									<div class="text-center w-100">
										<img src="<?=base_url()?>assets/frontend/images/quote_left.png" style="width:10%;opacity:0.1;">
									</div>
										<p>“<?=$testimonials->content?>”</p>
										<h4 class="card-title mt-2"><b><?=$testimonials->name?></b></h4>
										<div class="text-center w-100">
											<img src="<?=base_url()?>assets/frontend/images/quote_right.png" style="width:10%;opacity:0.1;float:right">
										</div>
									</div>
								</div>
								<?php $i++; } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- =================== Testimonial End ================================== -->
	<!--====== Content ======-->
	<div class="container reveal">
		<div class="row">
	<div class="container">
		<div class="row p-3">
			<h4 class="mt-5">Self-Drive Car Rentals in Delhi NCR</h4>
			<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam amet nihil, voluptatem incidunt
				tempore
				praesentium. Explicabo, minus quaerat in illo obcaecati impedit repellat quae esse, dolore
				incidunt
				modi
				pariatur sed?</p>
		</div>
		<div class="row p-3">
			<h4 class="mt-5">Places to Go</h4>
			<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam amet nihil, voluptatem incidunt
				tempore
				praesentium. Explicabo, minus quaerat in illo obcaecati impedit repellat quae esse, dolore
				incidunt
				modi
				pariatur sed?</p>
		</div>
		<div class="row p-3">
			<h4 class="mt-5">Selecting a Car</h4>
			<p class="mb-4">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam amet nihil,
				voluptatem
				incidunt tempore praesentium. Explicabo, minus quaerat in illo obcaecati impedit repellat quae
				esse,
				dolore incidunt modi pariatur sed?</p>
		</div>
	</div>
	<!--====== Content End ======-->
	</div>
	</div>
<script>
function reveal() {
  var reveals = document.querySelectorAll(".reveal");

  for (var i = 0; i < reveals.length; i++) {
    var windowHeight = window.innerHeight;
    var elementTop = reveals[i].getBoundingClientRect().top;
    var elementVisible = 150;

    if (elementTop < windowHeight - elementVisible) {
      reveals[i].classList.add("active");
    } else {
      reveals[i].classList.remove("active");
    }
  }
}

window.addEventListener("scroll", reveal);
//---------- Counter code start ---------------------------
$.fn.jQuerySimpleCounter = function( options ) {
		var settings = $.extend({
				start:  0,
				end:    100,
				easing: 'swing',
				duration: 400,
				complete: ''
		}, options );

		var thisElement = $(this);

		$({count: settings.start}).animate({count: settings.end}, {
		duration: settings.duration,
		easing: settings.easing,
		step: function() {
			var mathCount = Math.ceil(this.count);
			thisElement.text(mathCount);
		},
		complete: settings.complete
	});
};


$('#number1').jQuerySimpleCounter({end: 800,duration: 3000});
$('#number2').jQuerySimpleCounter({end: 25,duration: 3000});
$('#number3').jQuerySimpleCounter({end: 30000,duration: 2500});
$('#number4').jQuerySimpleCounter({end: 4,duration: 2500});

//---------- Counter code start ---------------------------
// Set bounce animation speed
var bounceSpeed = 7;

/* Ball Bouncing On Text © Yogev Ahuvia
 * ===========================================
 * This bouncing ball jumps over the words
 * inside the contentEditable paragraph.
 * The text itself is editable, the jump speed
 * is dynamic, and the ball bounce animation
 * duration is set by the length of each word.
 *
 * Have you tried switching off the light? :)
 * -------------------------------------------
 * Works best on Google Chrome.
 */

var Bouncer = function(elem) {
  // init bouncable element and helpers
  this.$elem = $(elem);
  this.$ball = $('<div class="ball"></div>');
  this.$space = $('<span>&nbsp;</span>');
  this.timers = [];

  // handle in-place editing events
  this.$elem.on('blur', (function(instance) {
    return function() {
      instance.init();
      instance.bounce();
    };
  })(this));

  this.$elem.on('keypress', function(e) {
    var code = (e.keyCode ? e.keyCode : e.which);
    if (code == 13) {
      $(this).blur();
    }
  });

  // make it bounce
  this.init();
  this.bounce();

};

Bouncer.prototype.init = function() {
  // get element text for parsing
  this.elemText = this.$elem.text();

  // clone element for new text injection
  this.$cloned = this.$elem.clone()
                           .empty()
                           .addClass('cloned')
                           .removeAttr('contenteditable')
                           .appendTo(this.$elem.parent());

  // handle cloned element termination
  this.$cloned.on('click', (function(instance) {
    return function() {
      instance.reset();
      instance.$elem.focus();
      document.execCommand('selectAll', false, null);
    };
  })(this));

  this.$elem.hide(); // hide original element while animating
  this.$ball.appendTo(this.$cloned); // add ball to new element
  this.contentArray = this.elemText.split(' ');


};

Bouncer.prototype.bounce = function() {
  // ball animation incrementing delay
  var incrementingDelay = 0;

  // run through the text
  for (var j = 0; j < this.contentArray.length; j++) {
    var word = this.contentArray[j];

    // handle multiple spaces
    if (/\s/g.test(word)) {
      this.$space.clone().appendTo(this.$cloned);
      this.contentArray.splice(j, 1);
      j--;
      continue;
    }

    // escape each word with a span, add it to cloned element
    var $word = $('<span class="word">' + word + '</span>');
    this.$cloned.append($word);
    var wordLength = $word.width();

    // add white space elements between words
    if (j+1 < this.contentArray.length) {
      this.$space.clone().appendTo(this.$cloned);
    }

    // get ball position above word
    var ballLeft = $word[0].offsetLeft + wordLength/2;
    var ballTop = $word[0].offsetTop;

    var ballProps = {left: ballLeft,
                     top: ballTop,
                     wordLength: wordLength,
                     wordIndex: j};

    // preset timers for the whole text
    var timer = setTimeout((function(instance, ballProps) {
      return function() {
        instance.animateBall(ballProps);
      };
    })(this, ballProps), incrementingDelay);
    this.timers.push(timer);

    incrementingDelay += wordLength * bounceSpeed;
  }

  // hide ball when finished bouncing
  var timer = setTimeout((function(instance) {
    return function() {
      instance.$ball.fadeOut();
			$('.word').addClass('color_liner');
	$('.word').addClass('text_animation');
    };
  })(this), incrementingDelay);
  this.timers.push(timer);
}

Bouncer.prototype.animateBall = function(ballProps) {

  // set ball transition duration per word length
  var leftDuration = ballProps.wordLength * bounceSpeed + 'ms';
  var topDuration = (ballProps.wordLength * bounceSpeed / 2) + 'ms';
  this.$ball.css('transition-duration',
                 leftDuration + ', ' + topDuration);

  // animate ball halfway and up
  var ballOffsetLeft = this.$ball[0].offsetLeft;
  var delta = ballProps.left - ballOffsetLeft;
  var ballHalfWay = ballOffsetLeft + delta;
  this.$ball.css({'left': ballHalfWay + 'px',
                  'top': '-30px'});

  // finish animation when the ball reach halfway
  var halfwayReached = ballProps.wordLength * bounceSpeed / 2;
  var timer = setTimeout((function(instance, ballProps) {
    return function() {

      // animate ball to finish the bounce
      instance.$ball.css({'left': ballProps.left + 'px' ,
                          'top': '0px'});

      // light the bounced word when the ball bounces on it
      var bouncedOnWord = ballProps.wordLength * bounceSpeed / 2;
      var timer = setTimeout((function(instance, ballProps) {
        return function() {
          instance.$cloned
                  .find('.word')
                  .eq(ballProps.wordIndex)
                  .addClass('lit');
        };
      })(instance, ballProps), bouncedOnWord);
      instance.timers.push(timer);
    };
  })(this, ballProps), halfwayReached);
  this.timers.push(timer);
}

Bouncer.prototype.reset = function() {
  for (var i = 0; i < this.timers.length; i++) {
    clearTimeout(this.timers[i]);
  }
  this.timers.length = 0;

  this.$elem.show();
  this.$cloned.remove();
  this.$ball.removeAttr('style');
}

var bouncers = [];
$(document).ready(function() {
  // make all 'bouncer' classes, bounce
  $('.bouncer').each(function(index, element) {
    bouncers.push(new Bouncer(element));
  });;
});
</script>
