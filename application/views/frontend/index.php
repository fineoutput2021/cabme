	<!-- ================================ web Form slider start ======================================================= -->
	<!-- hs Slider Start -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Goldman">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt">
	<style>
		.btn.disabled,
		.btn:disabled {
			opacity: 1 !important;
		}


		.testimonial {
			position: relative;


			background: url('<?=base_url()?>assets/frontend/images/bg.png') no-repeat 0 0/cover;
			z-index: 1;
			/* display: none !important; */
		}

		.color_liner {
			background-image: linear-gradient(to right, #161616 0, #f50303 36%, #d93232 65%, #5e5e5e 100%);

		}

		.text_animation {
			font-weight: 700;
			color: transparent;
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			-webkit-animation: hue 6s infinite linear;
		}

		.testimonial:after {
			position: absolute;
			content: "";
			top: 0;
			right: 0;
			width: 100%;
			height: 100%;
			z-index: -1;

		}

		.head:after {
			right: 0px;
		}

		.head:before {
			left: 0px;
		}

		.head {
			padding: 0px 40px;
			position: relative;
			display: inline-block;

		}

		.head:before,
		.head:after {
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
									<li class="nav-item" style="width: 33%;" onclick="setActive(1)"> <a class="nav-link dnav active" data-toggle="tab" href="#first">
											Self-Drive Cars</a>
									</li>
									<li class="nav-item" style="width: 33%" onclick="setActive(2)"> <a class="nav-link dnav" data-toggle="tab" href="#second">Outstation Booking</a>
									</li>
									<li class="nav-item" style="width: 34%;" onclick="setActive(3)"> <a class="nav-link dnav" data-toggle="tab" href="#third">Intercity Travel</a>
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
															<input type="text" autocomplete="off" readonly id="sdsd" name="start_date" placeholder="Date" required class="form-control datepicker"
																style="border: none;padding-right: 0px;padding-left: 5px;background-color: transparent;">
														</label>
													</div>
													<div class="timepicker_div form-sec-headers" style="height: 50px;margin-top: 2px;width: 90px;padding: 12px 0px;">
														<label class="cal-icon" style="margin-left: 8px;font-size: 11px;color: #000;font-weight: bold;margin-top: -3px;">START TIME
															<input type="text" autocomplete="off" id="sdst" readonly name="start_time" class="form-control timepicker" required placeholder="Time"
																style="padding: 23px 0px;background-color: transparent;border: none;width: 90%;margin-top: -10px;margin-left: -5px;" value="">
														</label>
													</div>
												</div>
												<div class="col-md-6 " style="z-index: 0;display: flex;height: 70px;border: 1px solid rgb(212, 208, 208);padding: 0px;">
													<div class="form-sec-header" style="height: 50px;padding: 12px 0px;">
														<label class="cal-icon" style="margin-top: 10px;margin-left: 10px;">End Date
															<input type="text" autocomplete="off" id="sded" readonly name="end_date" placeholder="Date" class="form-control datepicker" required
																style="border: none;padding-right: 0px;padding-left: 5px;background-color: transparent;">
														</label>
													</div>
													<div class="timepicker_div form-sec-headers" style="height: 50px;margin-top: 2px;width: 90px;padding: 12px 0px;">
														<label class="cal-icon" style="margin-left: 8px;font-size: 11px;color: #000;font-weight: bold;margin-top: -3px;">END TIME
															<input type="text" autocomplete="off" id="sdet" readonly name="end_time" class="form-control timepicker" placeholder="Time" required
																style="padding: 23px 0px;background-color: transparent;border: none;width: 90%;margin-top: -10px;margin-left: -5px;" value="">
														</label>
													</div>
												</div>
											</div>
											<div class="text-center col-md-12 col-12 p-2">
												<h6 id="s_duration"></h6>
											</div>
											<input type="hidden" name="city_id" class="city_id" value="" />
											<input type="hidden" name="duration" value="" id="duration">
											<input type="hidden" name="index" value="1" id="index">

											<div class="col-md-12 my-3">
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
														<input type="text" placeholder="Pickup Location" name="pick_location" required class="form-control" style="">
													</div>
												</div>
											</div>
											<div class="row" style="border: 1px solid rgb(212, 208, 208);width: 99%;margin-left: 7px;border-radius: 10px;">
												<div class="col-md-12" data-toggle="modal" data-target="#selectcity3" data-dismiss="modal" id="ss">
													<div class="selectcity">
														<i class="fa fa-map-marker"></i>
														<h5 style="margin-top: 3px;" class="city_title2">Select City</h5>
													</div>
												</div>
												<div id="change2" style="display: flex;" class="col-md-12 col-12 p-0">
													<div class="col-md-12 " style="z-index: 0;display: flex;height: 55px;border: 1px solid rgb(212, 208, 208);padding: 0px;justify-content: space-around;">
														<div class="form-sec-header" style="height: 50px;">
															<label class="cal-icon" style="margin-top: 10px;margin-left: 10px;">Start Date
																<input type="text" id="oosd" onchange=one_way() autocomplete="off" readonly placeholder="Date" name="start_date" class="form-control datepicker"
																	style="border: none;padding-right: 0px;padding-left: 5px;background-color: transparent;">
															</label>
														</div>
														<div class="timepicker_div form-sec-headers" style="height: 50px;width: 90px;">
															<label class="cal-icon" style="margin-left: 10px;font-size: 11px;color: #000;font-weight: bold;">START
																TIME
																<input type="text" id="oost" autocomplete="off" onchange=one_way() readonly name="start_time" class="form-control timepicker" placeholder="Time"
																	style="padding: 23px 0px;background-color: transparent;border: none;width: 84%;margin-top: -11px;">
															</label>
														</div>
													</div>
												</div>
											</div>
											<div class="text-center col-md-12 col-12 p-2">
												<h6 id="ot_duration"></h6>
											</div>
											<input type="hidden" name="city_id" class="city_id2" value="" />
											<input type="hidden" name="round_type" id="round_type" value="1" />
											<input type="hidden" name="duration" id="o_duration" value="1">

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
														<option value="SUV">SUV</option>
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
															<input type="text" autocomplete="off" readonly id="icsd" name="start_date" placeholder="Date" required class="form-control datepicker"
																style="border: none;padding-right: 0px;padding-left: 5px;background-color: transparent;">
														</label>
													</div>
													<div class="timepicker_div form-sec-headers" style="height: 50px;margin-top: 2px;width: 90px;">
														<label class="cal-icon" style="margin-left: 10px;font-size: 11px;color: #000;font-weight: bold;margin-top: -3px;">TIME
															<input type="text" autocomplete="off" readonly id="icst" name="start_time" placeholder="Time" required class="form-control timepicker"
																style="padding: 23px 0px;background-color: transparent;border: none;width: 90%;margin-top: -10px;margin-left: -5px;">
														</label>
													</div>
												</div>
												<div class="col-md-6 " style="z-index: 0;display: flex;height: 55px;border: 1px solid rgb(212, 208, 208);padding: 0px;">
													<div class="form-sec-header" style="height: 50px;">
														<label class="cal-icon" style="margin-top: 10px;margin-left: 10px;">End Date
															<input type="text" autocomplete="off" readonly id="iced" name="end_date" placeholder="Date" required class="form-control datepicker"
																style="border: none;padding-right: 0px;padding-left: 5px;background-color: transparent;">
														</label>
													</div>
													<div class="timepicker_div form-sec-headers" style="height: 50px;margin-top: 2px;width: 90px;">
														<label class="cal-icon" style="margin-left: 10px;font-size: 11px;color: #000;font-weight: bold;margin-top: -3px;">TIME
															<input type="text" autocomplete="off" readonly id="icet" name="end_time" class="form-control timepicker" required placeholder="Time"
																style="padding: 23px 0px;background-color: transparent;border: none;width: 90%;margin-top: -10px;margin-left: -5px;">
														</label>
													</div>
												</div>
											</div>
											<div class="text-center col-md-12 col-12 p-2">
												<h6 id="ic_duration"></h6>
											</div>
											<input type="hidden" name="city_id" class="city_id" value="" />
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
					<img src="<?=base_url().$banner->photo1?>" alt="banner_<?=$i?>" class="img-fluid">
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
	<div class="x_responsive_form_wrapper x_responsive_form_wrapper2 float_left d-block d-sm-block d-md-block  d-lg-none d-xl-none mt-0">
		<!-- <div class="container">
			<div class="x_slider_form_main_wrapper float_left">
				<div class="content_tabs" style="margin-top: -8px;">
					<div class="row">
						<div class="x_offer_tabs_wrapper" style="background-color: #fff;border-radius: 15px;width: 97%;margin-left: 5px;">
							<ul class="nav nav-tabs mobilenav-tabs justify-content-center" style="display: flex; flex-wrap: nowrap;box-shadow: 0px 1px 20px #fff;padding: 5px;border-radius: 10px;">
								<li class="nav-item" style="width: 120px;border-radius: 8px 0px 0px 8px;" onclick="setActive(1)"> <a class="nav-link molink active" data-toggle="tab" href="#firsttt" style="border-radius: 8px 0px 0px 8px;">Self-Drive </a>
								</li>
								<li class="nav-item" style="width: 147px;"> <a class="nav-link molink" data-toggle="tab" href="#thirddd" onclick="setActive(2)">Outstation </a>
								</li>
								<li class="nav-item" style="width: 147px;border-radius: 0px 8px 8px 0px;"> <a class="nav-link molink" data-toggle="tab" href="#seconddd" style="border-radius: 0px 8px 8px 0px;" onclick="setActive(3)">Intercity
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="tab-content">
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
														<input type="text" autocomplete="off" readonly required id="msdsd" name="start_date" placeholder="Date" class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -9px;">
													</label>
												</div>
												<div class="timepicker_div form-sec-header" style="height: 50px;margin-top: 2px;width: 80px;margin-left: 12px;">
													<label class="cal-icon" style="top:11px;left: 10px;">TIME
														<input type="text" autocomplete="off" id="msdst" required name="start_time" class="form-control timepicker" placeholder="Time"
															style="background-color: transparent;border: none;margin-left: -13px; margin-top: -10px; width: 122%;">
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
														<input type="text" autocomplete="off" readonly id="msdet" required name="end_time" placeholder="Time" class="form-control timepicker"
															style="background-color: transparent;border: none;margin-left: -13px; margin-top: -10px; width: 122%;">
												</div>
											</div>
										</div>
										<div class="text-center col-md-12 col-12 p-2">
											<h6 id="ms_duration"></h6>
										</div>
										<input type="hidden" name="city_id" class="city_id" value="" />
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
					<div id="seconddd" class="tab-pane">
						<form method="post" enctype="multipart/form-data" action="javascript:void(0)" id="m_intercity_form">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="x_slider_form_main_wrapper float_left">
									<div class="row">
										<div class="col-md-12 p-0">
											<div class="x_slider_select x_slider_select_2" style="margin-top: 0px;margin-left: -14px;">
												<select class="myselect" name="cab_type" required>
													<option value="Hatchback">Hatchback</option>
													<option value=""></option>
													<option value="Sedan">Sedan</option>
												</select> &nbsp; <i class="fa fa-car"></i>
											</div>
										</div>
										<div class="row mt-1" style="border: 1px solid rgb(226, 225, 225);border-radius: 10px;">
											<div class="col-md-12 p-0 selectcity" data-toggle="modal" data-target="#selectcity" data-dismiss="modal" style="border-bottom:1px solid rgb(226, 225, 225);">
												<div class="selectcity">
													<i class="fa fa-map-marker"></i>
													<h5 class="city_title">Select City</h5>
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
														<input type="text" autocomplete="off" readonly required class="form-control timepicker" id="micst" name="start_time" placeholder="Time"
															style="background-color: transparent;border: none;margin-left: -13px; margin-top: -10px; width: 122%;">
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
														<input type="text" autocomplete="off" readonly required id="micet" name="end_time" class="form-control timepicker" placeholder="Time"
															style="background-color: transparent;border: none;margin-left: -13px; margin-top: -10px; width: 122%;">
												</div>
											</div>
										</div>
										<div class="text-center col-md-12 col-12 p-2">
											<h6 id="mic_duration"></h6>
										</div>
										<input type="hidden" name="city_id" class="city_id" value="" />
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
					<div id="thirddd" class="tab-pane">
						<form method="post" enctype="multipart/form-data" action="<?=base_url()?>Home/outstaion_cars">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="x_slider_form_main_wrapper float_left">
									<div class="row justify-content-center" style="flex-wrap: nowrap;width: 100%;">
										<ul class="nav nav-tabs roundtab mobilenav-tabs justify-content-center" style="display: flex; flex-wrap: nowrap;">
											<li class="nav-item" style="border-radius: 8px 0px 0px 8px;" onclick="change(1)"> <a class="nav-link roundtab active" data-toggle="tab" href="#firstt" style="font-size: 13px;border-radius: 6px 0px 0px 6px;">
													One Way </a>
											</li>
											<li class="nav-item" style="border-radius: 0px 8px 8px 0px;" onclick="change(2)"> <a class="nav-link roundtab" data-toggle="tab" href="#thirdd" style="font-size: 13px;border-radius: 0px 6px 6px 0px;">Round-Trip </a>
											</li>
										</ul>
									</div>
									<div class="row">
										<div id="location2" style="display: flex;width: 100%;">
											<div class="col-md-12 col-12 p-0">
												<div class="x_slider_select x_slider_select_2" style="margin-left: -14px;">
													<input type="text" placeholder="Pickup Location" name="pick_location" required class="form-control" style="">
												</div>
											</div>
										</div>
										<div class="row" style="border: 1px solid rgb(226, 225, 225);margin-top: 10px;border-radius: 10px;">
											<div class="col-md-12 p-0" data-toggle="modal" data-target="#selectcity" data-dismiss="modal" style="border-bottom:1px solid rgb(226, 225, 225);">
												<div class="selectcity">
													<i class="fa fa-map-marker"></i>
													<h5 class="city_title">Select City</h5>
												</div>
											</div>
											<div id="change" style="display: flex;" class="col-md-12 col-12 p-0">
												<div class="col-md-12 col-12 mobileradius" style="z-index: 0;display: flex;height: 55px;padding: 0px;border-right: 1px solid rgb(226, 225, 225);justify-content: space-around;">
													<div class="form-sec-header" style="height: 50px;">
														<label class="cal-icon" style="top:11px;left: 10px;"> Start Date
															<input type="text" autocomplete="off" id="moosd" onchange=mone_way() readonly required placeholder="Date" name="start_date" class="form-control datepicker"
																style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -9px;">
														</label>
													</div>
													<div class="timepicker_div form-sec-header" style="height: 50px;margin-top: 2px;width: 80px;margin-left: 12px;">
														<label class="cal-icon" style="top:11px;left: 10px;"> Start Time
															<input type="text" autocomplete="off" id="moost" onchange=mone_way() readonly required name="start_time" placeholder="Time" class="form-control timepicker"
																style="background-color: transparent;border: none;margin-left: 5px; margin-top: -10px; width: 84%;">
													</div>
												</div>
											</div>
										</div>
										<div class="text-center col-md-12 col-12 p-2">
											<h6 id="mot_duration"></h6>
										</div>
										<input type="hidden" name="city_id" class="city_id" value="" />
										<input type="hidden" name="round_type" id="mround_type" value="1" />
										<input type="hidden" name="duration" value="1" id="mo_duration">
										<div class="col-md-12 mt-3">
											<div class="row mt-2 justify-content-center">
												<button class="btn col-md-10 searchbtn shadowbtn" type="submit" id="moutstation_btn" disabled> <i class="fa fa-search"></i> &nbsp;Search</button>
											</div>
										</div>
									</div>
								</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div> -->
		<style>
			.swiper-container {
				width: 100%;
			}

			.head_c {
				width: 100%;
				height: 3rem;
				margin-bottom: 1em;
				background-color: #ffeeee;
				border-radius: 10px;
			}

			.text {
				background-image: linear-gradient(to right, #DB0F07 0, #d42907 36%, #EF1700 65%, #D62A05 100%);
				text-decoration: none;
				color: #fff;
				-webkit-animation: hue 30s infinite linear;
				border-radius: 20px;
				padding: 8px 54px;
			}

			.head_s {
				text-align: center;
				font-size: 1em;
				line-height: 3.1rem;
			}

			.swiper-button-next,
			.swiper-button-prev {
				height: 30px !important;
				margin-top: -15px !important;
				background-size: 20px 15px !important;
				border: 1px solid #d73435 !important;
				border-radius: 5px !important;
				background-color: white !important;
			}

			.swiper-button-next,
			.swiper-container-rtl .swiper-button-prev {
				background-image: url("data:image/svg+xml;charset=utf-8,<svg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'><path%20d%3D'M27%2C22L27%2C22L5%2C44l-2.1-2.1L22.8%2C22L2.9%2C2.1L5%2C0L27%2C22L27%2C22z'%20fill%3D'%23d73435'%2F><%2Fsvg>");
			}

			.swiper-button-prev,
			.swiper-container-rtl .swiper-button-next {
				background-image: url("data:image/svg+xml;charset=utf-8,<svg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg'%20viewBox%3D'0%200%2027%2044'><path%20d%3D'M0%2C22L22%2C0l2.1%2C2.1L4.2%2C22l19.9%2C19.9L22%2C44L0%2C22L0%2C22L0%2C22z'%20fill%3D'%23d73435'%2F><%2Fsvg>");
			}
		</style>
		<!-- Slider #1 main container -->
		<div class="col-md-12 p-0" style="z-index: 0;">
			<div class="screenshot">
				<div class="owl-carousel screen nplr screen-loop">
					<?php $i=1; foreach($banner_data as $banner) {?>
					<div style="cursor:pointer" class="card valign-wrapper new">
						<img src="<?=base_url().$banner->photo2?>" />
					</div>
					<?php	$i++; } ?>
				</div>
			</div>
		</div>
		<div class="x_slider_form_main_wrapper float_left">

			<div style="box-shadow: 0px 0 8px rgb(254 241 240);padding: 10px 5px;border-radius: 15px;">
			<div class="swiper-container head_c">
				<!-- Additional required wrapper -->
				<div class="swiper-wrapper">
					<!-- Slides -->
					<!-- //================= first form ================= -->
					<div class="swiper-slide head_s">
						<div><span class="text">Self-Drive</span> </div>
					</div>
					<!-- //========= second form ======== -->
					<div class="swiper-slide head_s">
						<div><span class="text">Outstation</span></div>
					</div>
					<!-- //========= third form ========= -->
					<div class="swiper-slide head_s">
						<div><span class="text">Intercity</span></div>
					</div>
				</div>

				<!-- If we need navigation buttons -->
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div>

			<!-- Slider #2 main container -->
			<div class="swiper-container ">
				<!-- Additional required wrapper -->
				<div class="swiper-wrapper">
					<!-- Slides -->
					<!-- //================= first form ================= -->
					<div class="swiper-slide">
						<div id="firsttt" class="tab-pane active">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="x_slider_form_main_wrapper float_left">
									<form method="post" enctype="multipart/form-data" action="<?=base_url()?>Home/self_drive_cars">
										<div class="row mr-0 ml-0" style="margin-top: 20px;">
											<div class="row" style="border: 1px solid rgb(226, 225, 225);border-radius: 10px;">
												<div class="col-md-12 p-0" data-toggle="modal" data-target="#selectcity" data-dismiss="modal" style="border-bottom:1px solid rgb(226, 225, 225);">
													<div class="selectcity">
														<i class="fa fa-map-marker"></i>
														<h5 class="city_title">Select City</h5>
													</div>
												</div>
												<div class="col-md-3 col-6 mobileradius" style="z-index: 0;display: flex;height: 55px;padding: 0px;border-right: 1px solid rgb(226, 225, 225);">
													<div class="form-sec-header" style="height: 50px;">
														<label class="cal-icon" style="top:11px;left: 17px;"> Start Date
															<input type="text" autocomplete="off" readonly required id="msdsd" name="start_date" placeholder="Date" class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -9px;">
														</label>
													</div>
													<div class="timepicker_div form-sec-header" style="height: 50px;margin-top: 2px;width: 80px;margin-left: 12px;">
														<label class="cal-icon" style="top:11px;left: 10px;">TIME
															<input type="text" autocomplete="off" id="msdst" required name="start_time" class="form-control timepicker" placeholder="Time"
																style="background-color: transparent;border: none;margin-left: -13px; margin-top: -10px; width: 122%;">
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
															<input type="text" autocomplete="off" readonly id="msdet" required name="end_time" placeholder="Time" class="form-control timepicker"
																style="background-color: transparent;border: none;margin-left: -13px; margin-top: -10px; width: 122%;">
													</div>
												</div>
											</div>
											<div class="text-center col-md-12 col-12 p-2">
												<h6 id="ms_duration"></h6>
											</div>
											<input type="hidden" name="city_id" class="city_id" value="" />
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
					</div>

					<!-- //========= second form ========= -->
					<div class="swiper-slide">
						<div id="thirddd" class="tab-pane">
							<form method="post" enctype="multipart/form-data" action="<?=base_url()?>Home/outstaion_cars">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="x_slider_form_main_wrapper float_left">
										<div class="row justify-content-center mr-0 ml-0" style="flex-wrap: nowrap;width: 100%;">
											<ul class="nav nav-tabs roundtab mobilenav-tabs justify-content-center" style="display: flex; flex-wrap: nowrap;">
												<li class="nav-item" style="border-radius: 8px 0px 0px 8px;" onclick="change(1)"> <a class="nav-link roundtab active" data-toggle="tab" href="#firstt" style="font-size: 13px;border-radius: 6px 0px 0px 6px;">
														One Way </a>
												</li>
												<li class="nav-item" style="border-radius: 0px 8px 8px 0px;" onclick="change(2)"> <a class="nav-link roundtab" data-toggle="tab" href="#thirdd" style="font-size: 13px;border-radius: 0px 6px 6px 0px;">Round-Trip </a>
												</li>
											</ul>
										</div>
										<div class="row">
											<div id="location2" style="display: flex;width: 100%;">
												<div class="col-md-12 col-12 p-0">
													<div class="x_slider_select x_slider_select_2" style="">
														<input type="text" placeholder="Pickup Location" name="pick_location" required class="form-control" style="">
													</div>
												</div>
											</div>
											<div class="row mr-0 ml-0" style="border: 1px solid rgb(226, 225, 225);margin-top: 10px;border-radius: 10px;">
												<div class="col-md-12 p-0" data-toggle="modal" data-target="#selectcity4" data-dismiss="modal" style="border-bottom:1px solid rgb(226, 225, 225);">
													<div class="selectcity">
														<i class="fa fa-map-marker"></i>
														<h5 class="city_title2">Select City</h5>
													</div>
												</div>
												<div id="change" style="display: flex;" class="col-md-12 col-12 p-0">
													<div class="col-md-12 col-12 mobileradius" style="z-index: 0;display: flex;height: 55px;padding: 0px;border-right: 1px solid rgb(226, 225, 225);justify-content: space-around;">
														<div class="form-sec-header" style="height: 50px;">
															<label class="cal-icon" style="top:11px;left: 17px;"> Start Date
																<input type="text" autocomplete="off" id="moosd" onchange=mone_way() readonly required placeholder="Date" name="start_date" class="form-control datepicker"
																	style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -9px;">
															</label>
														</div>
														<div class="timepicker_div form-sec-header" style="height: 50px;margin-top: 2px;width: 80px;margin-left: 12px;">
															<label class="cal-icon" style="top:11px;left: 10px;"> Start Time
																<input type="text" autocomplete="off" id="moost" onchange=mone_way() readonly required name="start_time" placeholder="Time" class="form-control timepicker"
																	style="background-color: transparent;border: none;margin-left: 5px; margin-top: -10px; width: 84%;">
														</div>
													</div>
												</div>
											</div>
											<div class="text-center col-md-12 col-12 p-2">
												<h6 id="mot_duration"></h6>
											</div>
											<input type="hidden" name="city_id" class="city_id2" value="" />
											<input type="hidden" name="round_type" id="mround_type" value="1" />
											<input type="hidden" name="duration" value="1" id="mo_duration">
											<div class="col-md-12 mt-3">
												<div class="row mt-2 justify-content-center">
													<button class="btn col-md-10 searchbtn shadowbtn" type="submit" id="moutstation_btn" disabled> <i class="fa fa-search"></i> &nbsp;Search</button>
												</div>
											</div>
										</div>
									</div>
							</form>
						</div>
					</div>
				</div>
				<!-- //========= third form ======== -->
				<div class="swiper-slide">
					<div id="seconddd" class="tab-pane">
						<form method="post" enctype="multipart/form-data" action="javascript:void(0)" id="m_intercity_form">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="x_slider_form_main_wrapper float_left">
									<div class="row mr-0 ml-0">
										<div class="col-md-12 p-0">
											<div class="x_slider_select x_slider_select_22" style="margin-top: 0px;margin-left: -14px;">
												<select class="myselect" name="cab_type" required>
													<option value="Hatchback">Hatchback</option>
													<option value="SUV">SUV</option>
													<option value="Sedan">Sedan</option>
												</select> &nbsp; <i class="fa fa-car"></i>
											</div>
										</div>
										<div class="row mt-1" style="border: 1px solid rgb(226, 225, 225);border-radius: 10px;">
											<div class="col-md-12 p-0 selectcity" data-toggle="modal" data-target="#selectcity" data-dismiss="modal" style="border-bottom:1px solid rgb(226, 225, 225);">
												<div class="selectcity">
													<i class="fa fa-map-marker"></i>
													<h5 class="city_title">Select City</h5>
												</div>
											</div>
											<div class="col-md-3 col-6 mobileradius" style="z-index: 0;display: flex;height: 55px;padding: 0px;border-right: 1px solid rgb(226, 225, 225);">
												<div class="form-sec-header" style="height: 50px;">
													<label class="cal-icon" style="top:11px;left: 17px;"> Start Date
														<input type="text" autocomplete="off" readonly required id="micsd" name="start_date" placeholder="Date" class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -9px;">
													</label>
												</div>
												<div class="timepicker_div form-sec-header" style="height: 50px;margin-top: 2px;width: 80px;margin-left: 12px;">
													<label class="cal-icon" style="top:11px;left: 10px;">Time
														<input type="text" autocomplete="off" readonly required class="form-control timepicker" id="micst" name="start_time" placeholder="Time"
															style="background-color: transparent;border: none;margin-left: -13px; margin-top: -10px; width: 122%;">
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
														<input type="text" autocomplete="off" readonly required id="micet" name="end_time" class="form-control timepicker" placeholder="Time"
															style="background-color: transparent;border: none;margin-left: -13px; margin-top: -10px; width: 122%;">
												</div>
											</div>
										</div>
										<div class="text-center col-md-12 col-12 p-2">
											<h6 id="mic_duration"></h6>
										</div>
										<input type="hidden" name="city_id" class="city_id" value="" />
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
				</div>
			</div>

		</div>
	</div>
	</div>
	</div>
	<!-- ================================  Mobile Form End =========================================== -->

	<!-- =================== Featured ================================== -->
	<div class="float_left ">
		<div class="container">
			<div class="row">
				<div class="col-md-12 mt-5 mt_c">
					<div class="text-center">
						<h4 class="heading mt-5 ">
							Featured
						</h4>
					</div>
				</div>
				<div class="col-md-12" style="z-index: 0;">
					<div class="screenshot">
						<div class="owl-carousel screen nplr screen-loop">
							<?php $i=1; foreach($promocode_data as $data) {
								date_default_timezone_set("Asia/Calcutta");
								$cur_date=strtotime(date("Y-m-d"));
								  // if (strtotime($data->end_date) >= $cur_date && strtotime($data->start_date) <= $cur_date) {
										?>
							<div style="cursor:pointer" class="card valign-wrapper new" id="p_<?=$i?>" p_name="<?=$data->promocode?>" p_perc="<?=$data->percentage?>" p_min="<?=$data->mindays?>" p_max="<?=$data->max?>" onclick="show_promo_model(<?=$i?>)">
								<img src="<?=base_url().$data->photo?>" />
							</div>
							<?php
					// }
					$i++; } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--================================= Why Cabme slider Start ======================================-->

	<div class="x_ln_car_main_wrapper float_left my-5 testimonial why_pd">
		<div class="container">
			<div class="row mt-5">
				<div class="col-md-12">
					<div class="text-center ">
						<h4 class="heading">Why Cabme?</h4>
					</div>
				</div>
				<div class="col-md-12" style="">
					<div class="btc_ln_slider_wrapper">
						<div class="row">
							<div class="col-md-3 my-4 ">
								<div class="text-center cabme-box">
									<img src="<?=base_url()?>assets/frontend/images/car.png" />
									<h3 class="my-3">Safe and Santised cars</h3>
									<p>Cabme is the ONLY company that focuses on this innovative business model of allowing its customer to take the car </p>
								</div>
							</div>
							<div class="col-md-3 my-4 ">
								<div class="text-center cabme-box">
									<img src="<?=base_url()?>assets/frontend/images/dollar-symbol.png" />
									<h3 class="my-3">No hidden charges</h3>
									<p>Cabme is the ONLY company that focuses on this innovative business model of allowing its customer to take the car </p>
								</div>
							</div>
							<div class="col-md-3 my-4 ">
								<div class="text-center cabme-box">
									<img src="<?=base_url()?>assets/frontend/images/fast-delivery.png" />
									<h3 class="my-3">Doorstep Delivery</h3>
									<p>Cabme is the ONLY company that focuses on this innovative business model of allowing its customer to take the car </p>
								</div>
							</div>
							<div class="col-md-3 my-4 ">
								<div class="text-center cabme-box">
									<img src="<?=base_url()?>assets/frontend/images/24-hours.png" />
									<h3 class="my-3">24*7 customer support</h3>
									<p>Cabme is the ONLY company that focuses on this innovative business model of allowing its customer to take the car </p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--================================= Mobile FAQ's ======================================-->
	<section class="x_ln_car_main_wrapper float_left mt-5 mb-5">
		<div class="text-center mb-5">
			<h4 class="heading">FAQs</h4>
		</div>
		<div class="container">
			<div class="accordion">
				<div class="card">
					<div class="label">Booking criteria & documents?</div>
					<div class="content">
						Min. 18 years old, have valid original government ID (Aadhar, Passport, or PAN only) and a valid driving license for “Light Motor Vehicles”, which is min. 1 year old at the time of starting the trip.
					</div>
				</div>
				<div class="card">
					<div class="label">How do I check-in for my booking?</div>
					<div class="content">
						Our delivery executive will deliver the car to your doorstep. Before he hands- over the car to you, he will share with you a pre-filled checklist that summarises the car’s condition at that time. Please confirm the details in the
						checklist, sign it and you are good to go. In case any information in the checklist is not correct, please notify the delivery executive or call us.
					</div>
				</div>
				<div class="card">
					<div class="label">What if I leave something in Cabme's car?</div>
					<div class="content">
						Well, we will do our best to help you find your belongings if you inform us soon enough. But as you can imagine, we cannot guarantee it since finding it back is not fully in our control. So, please check the car thoroughly before handing
						it back to us.
					</div>
				</div>
				<div class="card">
					<div class="label">What modes of payments are accepted?</div>
					<div class="content">
						We accept payments by credit cards, debit cards, net-banking, UPI and popular wallets. Payments need to be made in advance through our website or mobile app.
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--================================= Our journey End ======================================-->
	<!-- =================== Testimonial ================================== -->

	<div class="test-wrapper float_left testimonial my-5 ">
		<div class="container">
			<div class="row">
				<div class="col-md-12 mt-5">
					<div class="text-center">
						<h4 class="heading mt-5">
							Happy Customers
						</h4>
					</div>
				</div>
				<div class="col-md-12" style="z-index: 0;">
					<div class="screenshot">
						<div class="owl-carousel screen nplr screen-loop">
							<?php $i=1; foreach($testimonials_data as $testimonials) { ?>
							<div class="card valign-wrapper">
								<div class="test-content">
									<p style="color:black">“<?=$testimonials->content?>”</p>

									<div class="text-center w-100">
										<img class="img-fluid" src="<?=base_url()?>assets/frontend/images/quote_right.png" style="width:20%;float:right">
									</div>
								</div>
								<!-- Client's image -->
								<div class="test-bottom">
									<div class="testimonial-image">
										<?if(!empty($testimonials->photo)){?>
										<img class="test-avatar" src="<?=base_url().$testimonials->photo?>" alt="img">
										<?}else{?>
										<img class="test-avatar" src="<?=base_url()?>assets/frontend/images/avatar.png" alt="img">
										<?}?>
									</div>
									<h4 class="card-title mt-2"><b><?=$testimonials->name?></b></h4>
								</div>
							</div>
							<?php $i++; } ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!--========================-choose-------------------------->
	<section class="section6" style="background-color: #ffffff">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 pv-4 pb-md-0">
					<img src="<?=base_url()?>assets/frontend/images/choose.png" class="img-fluid" alt="img" />
				</div>
				<div class="col-md-6 pv-4 pb-md-0">
					<p class="section6-title">
						About Us
					</p>
					<h4 class="heading">
						Cabme
					</h4>
					<div class="content hideContent">
						<p class="section6-para text-justify">
							We are India's leading Car Rental Company with an innovative way of servicing the requirements of the ever growing car rental industry in India as compared to other such service providers.
						</p>
						<p class="section6-para text-justify">The company was incorporated in year 2020 with a small fleet of 10 cars. Today with its strong determination and strong competition edge over other car rentals companies, it has managed to grab a large
							share in car rental industry. Over the years Cabme's fleet has exponentially grown. The ultra strong Unique Selling Proposition of Cabme has been its value system to delight the customer with its professional approach, passion to excel.
						</p>
						<p class="section6-para text-justify">Cabme is the ONLY company that focuses on this innovative business model of allowing its customer to take the car on a Short Term & Long Term Lease, Weekend Gateways for SELF DRIVE.</p>
						<p class="section6-para text-justify">Cabme, is an e-commerce portal which allows the clients to book a car online & pay directly via the payment gateway. An unique E- Commerce website which helped over 50000 people, traveling across
							various cities with a online spot booking, Car Conformation & making Payments.</p>
					</div>
					<div class="show-more">
						<a href="javascript:void(0);"><button type="button" class="btn read-button">Read More</button></a>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!--==========================-why choose us-------------------------->
	<section class="choose padding-50" style="background-color: #ffffff">
		<div class="container">
			<div class="choose-bg">
				<h4>
					why choose us
				</h4>
				<div class="choose-option">
					<div class="row text-center justify-content-center">
						<div class="col-md-3 col-6 pb-3 pb-md-0">
							<div class="choose-section">
								<div class="choose-img">
									<img src="<?=base_url()?>assets/frontend/images/customer.png" alt="img" class="img-fluid">
								</div>
								<p id="number1">
									420
								</p>
								<span>Happy Customers</span>
							</div>
						</div>
						<div class="col-md-3 col-6 pb-3 pb-md-0">
							<div class="choose-section">
								<div class="choose-img">
									<img src="<?=base_url()?>assets/frontend/images/cities-location.png" alt="img" class="img-fluid">
								</div>
								<p>
									<span id="number2">115</span>+
								</p>
								<span>cities across india</span>
							</div>
						</div>
						<div class="col-md-3 col-6 pb-3 pb-md-0">
							<div class="choose-section">
								<div class="choose-img">
									<img src="<?=base_url()?>assets/frontend/images/travell.png" alt="img" class="img-fluid">
								</div>
								<p id="number3">
									2000
								</p>
								<span>km's travelled</span>
							</div>
						</div>
						<div class="col-md-3 col-6 pb-3 pb-md-0">
							<div class="choose-section">
								<div class="choose-img">
									<img src="<?=base_url()?>assets/frontend/images/review.png" alt="img" class="img-fluid">
								</div>
								<p>
									<span id="number4">25</span>+
								</p>
								<span>20k+ reviewers</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!---------------------------------end why choose us-------------------------->



	<script>
		// var galleryTop = new Swiper('.gallery-top', {
		// 	spaceBetween: 0,
		// 	navigation: {
		// 		nextEl: '.swiper-button-next',
		// 		prevEl: '.swiper-button-prev',
		// 	},
		// 	loop: true,
		// 	loopedSlides: 4
		// });
		// var galleryThumbs = new Swiper('.gallery-thumbs', {
		// 	spaceBetween: 10,
		// 	centeredSlides: true,
		// 	slidesPerView: 'auto',
		// 	touchRatio: 0.2,
		// 	slideToClickedSlide: true,
		// 	loop: true,
		// 	loopedSlides: 4
		// });
		// galleryTop.controller.control = galleryThumbs;
		// galleryThumbs.controller.control = galleryTop;
		//---------- Counter code start ---------------------------
		$.fn.jQuerySimpleCounter = function(options) {
			var settings = $.extend({
				start: 0,
				end: 100,
				easing: 'swing',
				duration: 400,
				complete: ''
			}, options);

			var thisElement = $(this);

			$({
				count: settings.start
			}).animate({
				count: settings.end
			}, {
				duration: settings.duration,
				easing: settings.easing,
				step: function() {
					var mathCount = Math.ceil(this.count);
					thisElement.text(mathCount);
				},
				complete: settings.complete
			});
		};


		$('#number1').jQuerySimpleCounter({
			end: 420,
			duration: 3000
		});
		$('#number2').jQuerySimpleCounter({
			end: 115,
			duration: 3000
		});
		$('#number3').jQuerySimpleCounter({
			end: 2000,
			duration: 2500
		});
		$('#number4').jQuerySimpleCounter({
			end: 25,
			duration: 2500
		});

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
				if (j + 1 < this.contentArray.length) {
					this.$space.clone().appendTo(this.$cloned);
				}

				// get ball position above word
				var ballLeft = $word[0].offsetLeft + wordLength / 2;
				var ballTop = $word[0].offsetTop;

				var ballProps = {
					left: ballLeft,
					top: ballTop,
					wordLength: wordLength,
					wordIndex: j
				};

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
			this.$ball.css({
				'left': ballHalfWay + 'px',
				'top': '-30px'
			});

			// finish animation when the ball reach halfway
			var halfwayReached = ballProps.wordLength * bounceSpeed / 2;
			var timer = setTimeout((function(instance, ballProps) {
				return function() {

					// animate ball to finish the bounce
					instance.$ball.css({
						'left': ballProps.left + 'px',
						'top': '0px'
					});

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


	<script>
		let label = document.querySelectorAll(".card")



		label.forEach((e) => {
			e.addEventListener("click", () => {
				removeClass()
				e.classList.toggle("active")
			})
		})

		function removeClass() {
			label.forEach((e) => {
				e.classList.remove("active")
			})
		}
	</script>
