	<!-- ================================ web Form slider start ======================================================= -->
	<!-- hs Slider Start -->
	<input type="hidden" id="active" value="1">
	<input type="hidden" id="device" value="">
	<input type="hidden" id="sd" value="">
	<input type="hidden" id="st" value="">
	<input type="hidden" id="ed" value="">
	<input type="hidden" id="et" value="">
	<div class="slider-area float_left desktopmainslider">
		<div id="carousel-example-generic" class="carousel slide" data-interval="5000" data-ride="carousel">
			<div class="carousel-inner" role="listbox">
				<div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12 d-none d-sm-none d-md-none  d-lg-block d-xl-block" style="position: absolute;z-index: 99;top: 25%;left: 10%;">
					<div class="content_tabs">
						<div class="row">
							<div class="x_offer_tabs_wrapper" style="border-radius: 15px;width: 90%;margin-left: 29px;">
								<ul class="nav nav-tabs" style="width: 100%;border: 1px solid #d5d0d0;">
									<li class="nav-item" style="width: 33%;border-right: 1px solid #d5d0d0;"  onclick="setActive(1)"> <a class="nav-link dnav active" data-toggle="tab" href="#first">
											Self-Drive Cars</a>
									</li>
									<li class="nav-item" style="width: 33%;border-right: 1px solid #d5d0d0;"  onclick="setActive(2)"> <a class="nav-link dnav" data-toggle="tab" href="#second" >Outstation Booking</a>
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
														<input type="text" autocomplete="off" id="sdsd" name="start_date" placeholder="Date" required class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 5px;background-color: transparent;">
													</label>
												</div>
												<div class="timepicker_div form-sec-headers" style="height: 50px;margin-top: 2px;width: 90px;padding: 12px 0px;">
													<label class="cal-icon" style="margin-left: 8px;font-size: 11px;color: #000;font-weight: bold;margin-top: -3px;">START TIME
														<input type="text" autocomplete="off" id="sdst" name="start_time" class="form-control timepicker" required placeholder="Time" style="padding: 23px 0px;background-color: transparent;border: none;width: 90%;margin-top: -10px;margin-left: -5px;" value="">
													</label>
												</div>
											</div>
											<div class="col-md-6 " style="z-index: 0;display: flex;height: 70px;border: 1px solid rgb(212, 208, 208);padding: 0px;">
												<div class="form-sec-header" style="height: 50px;padding: 12px 0px;">
													<label class="cal-icon" style="margin-top: 10px;margin-left: 10px;">End Date
														<input type="text" autocomplete="off" id="sded" name="end_date" placeholder="Date" class="form-control datepicker" required style="border: none;padding-right: 0px;padding-left: 5px;background-color: transparent;">
													</label>
												</div>
												<div class="timepicker_div form-sec-headers" style="height: 50px;margin-top: 2px;width: 90px;padding: 12px 0px;">
													<label class="cal-icon" style="margin-left: 8px;font-size: 11px;color: #000;font-weight: bold;margin-top: -3px;">END TIME
														<input type="text" autocomplete="off" id="sdet" name="end_time" class="form-control timepicker" placeholder="Time" required style="padding: 23px 0px;background-color: transparent;border: none;width: 90%;margin-top: -10px;margin-left: -5px;" value="">
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
														<input type="text"  placeholder="Pickup Location"  name="pick_location" required class="form-control" style="">
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
															<input type="text" autocomplete="off" placeholder="Date" name="start_date"  class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 5px;background-color: transparent;">
														</label>
													</div>
													<div class="timepicker_div form-sec-headers" style="height: 50px;width: 90px;">
														<label class="cal-icon" style="margin-left: 10px;font-size: 11px;color: #000;font-weight: bold;">START
															TIME
															<input type="text" autocomplete="off" name="start_time" class="form-control timepicker" placeholder="Time" style="padding: 23px 0px;background-color: transparent;border: none;width: 84%;margin-top: -11px;">
														</label>
													</div>
												</div>
											</div>
										</div>
										<input type="hidden" name="city_id" class="city_id"  value=""/>
										<input type="hidden" name="round_type" id="round_type"  value="1"/>
										<input type="hidden" name="duration" value="" id="o_duration">

										<div class="col-md-12 mt-3">
											<div class="row mt-2 justify-content-center">
													<button class="btn col-md-10 searchbtn shadowbtn" type="submit" id="outstation_btn"> <i class="fa fa-search"></i> &nbsp;Search</button>
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
														<input type="text" autocomplete="off" id="icsd" name="start_date" placeholder="Date" required  class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 5px;background-color: transparent;">
													</label>
												</div>
												<div class="timepicker_div form-sec-headers" style="height: 50px;margin-top: 2px;width: 90px;">
													<label class="cal-icon" style="margin-left: 10px;font-size: 11px;color: #000;font-weight: bold;margin-top: -3px;">TIME
														<input type="text" autocomplete="off" id="icst" name="start_time" placeholder="Time" required  class="form-control timepicker"  style="padding: 23px 0px;background-color: transparent;border: none;width: 90%;margin-top: -10px;margin-left: -5px;">
													</label>
												</div>
											</div>
											<div class="col-md-6 " style="z-index: 0;display: flex;height: 55px;border: 1px solid rgb(212, 208, 208);padding: 0px;">
												<div class="form-sec-header" style="height: 50px;">
													<label class="cal-icon" style="margin-top: 10px;margin-left: 10px;">End Date
														<input type="text" autocomplete="off" id="iced" name="end_date" placeholder="Date" required class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 5px;background-color: transparent;">
													</label>
												</div>
												<div class="timepicker_div form-sec-headers" style="height: 50px;margin-top: 2px;width: 90px;">
													<label class="cal-icon" style="margin-left: 10px;font-size: 11px;color: #000;font-weight: bold;margin-top: -3px;">TIME
														<input type="text" autocomplete="off" id="icet" name="end_time" class="form-control timepicker" required placeholder="Time" style="padding: 23px 0px;background-color: transparent;border: none;width: 90%;margin-top: -10px;margin-left: -5px;">
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
												<button class="btn col-md-10 searchbtn shadowbtn" type="submit" id="iter_btn"> <i class="fa fa-search"></i> &nbsp;Search</button>
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
													<input type="text" autocomplete="off" id="msdsd"  name="start_date" placeholder="Date" class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -9px;">
												</label>
											</div>
											<div class="timepicker_div form-sec-header" style="height: 50px;margin-top: 2px;width: 80px;margin-left: 12px;">
												<label class="cal-icon" style="top:11px;left: 10px;">TIME
													<input type="text" autocomplete="off"  id="msdst" name="start_time" class="form-control timepicker" placeholder="Time" style="background-color: transparent;border: none;margin-left: -13px; margin-top: -10px; width: 122%;">
											</div>
										</div>
										<div class="col-md-3 col-6 mobileradius" style="z-index: 0;display: flex;height: 55px;padding: 0px;">
											<div class="form-sec-header" style="height: 50px;">
												<label class="cal-icon" style="top:11px;left: 10px;"> End Date
													<input type="text" autocomplete="off" id="msded" name="end_date" placeholder="Date" class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -9px;">
												</label>
											</div>
											<div class="timepicker_div form-sec-header" style="height: 50px;margin-top: 2px;width: 80px;margin-left: 12px;">
												<label class="cal-icon" style="top:11px;left: 10px;">TIME
													<input type="text" autocomplete="off"  id="msdet" name="end_time" placeholder="Time" class="form-control timepicker" style="background-color: transparent;border: none;margin-left: -13px; margin-top: -10px; width: 122%;">
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
													<input type="text" autocomplete="off" id="micsd" name="start_date" placeholder="Date" class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -9px;">
												</label>
											</div>
											<div class="timepicker_div form-sec-header" style="height: 50px;margin-top: 2px;width: 80px;margin-left: 12px;">
												<label class="cal-icon" style="top:11px;left: 10px;">Time
													<input type="text" autocomplete="off" class="form-control timepicker"id="micst" name="start_time" placeholder="Time" style="background-color: transparent;border: none;margin-left: -13px; margin-top: -10px; width: 122%;">
											</div>
										</div>
										<div class="col-md-3 col-6 mobileradius" style="z-index: 0;display: flex;height: 55px;padding: 0px;">
											<div class="form-sec-header" style="height: 50px;">
												<label class="cal-icon" style="top:11px;left: 10px;"> End Date
													<input type="text" autocomplete="off" id="miced" name="end_date" placeholder="Date" class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -9px;">
												</label>
											</div>
											<div class="timepicker_div form-sec-header" style="height: 50px;margin-top: 2px;width: 80px;margin-left: 12px;">
												<label class="cal-icon" style="top:11px;left: 10px;">TIME
													<input type="text" autocomplete="off" id="micet" name="end_time" class="form-control timepicker" placeholder="Time" style="background-color: transparent;border: none;margin-left: -13px; margin-top: -10px; width: 122%;">
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
												<button class="btn col-md-10 searchbtn shadowbtn" type="submit" id="miter_btn"> <i class="fa fa-search"></i> &nbsp;Search</button>
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
														<input type="text" autocomplete="off" placeholder="Date" name="start_date"  class="form-control datepicker" style="border: none;padding-right: 0px;padding-left: 1px;margin-top: -9px;">
													</label>
												</div>
												<div class="timepicker_div form-sec-header" style="height: 50px;margin-top: 2px;width: 80px;margin-left: 12px;">
													<label class="cal-icon" style="top:11px;left: 10px;"> Start Time
														<input type="text" autocomplete="off" name="start_time" placeholder="Time" class="form-control timepicker" style="background-color: transparent;border: none;margin-left: 5px; margin-top: -10px; width: 84%;">
												</div>
											</div>
										</div>
									</div>
									<input type="hidden" name="city_id" class="city_id"  value=""/>
									<input type="hidden" name="round_type" id="mround_type"  value="1"/>
									<input type="hidden" name="duration" value="" id="mo_duration">
									<div class="col-md-12 mt-3">
										<div class="row mt-2 justify-content-center">
												<button class="btn col-md-10 searchbtn shadowbtn" type="submit" id="outstation_btn"> <i class="fa fa-search"></i> &nbsp;Search</button>
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
	<!--================================= Featured Slider Start ======================================-->
	<div class="x_ln_car_main_wrapper float_left ">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="x_ln_car_heading_wrapper float_left mt-2">
						<h3>Featured</h3>
					</div>
				</div>
				<div class="col-md-12" style="z-index: 0;">
					<div class="btc_ln_slider_wrapper">
						<div class="owl-carousel owl-theme">
							<div class="item">
								<span data-toggle="modal" data-target="#myModal">
									<div class="btc_team_slider_cont_main_wrapper">
										<div class="btc_ln_img_wrapper float_left">
											<img src="<?=base_url()?>assets/frontend/images/promo_2.png" alt="promo_1">
										</div>
								</span>
							</div>
						</div>
						<div class="item">
							<span data-toggle="modal" data-target="#myModal">
								<div class="btc_team_slider_cont_main_wrapper">
									<div class="btc_ln_img_wrapper float_left">
										<img src="<?=base_url()?>assets/frontend/images/promo_3.png" alt="promo_3">
									</div>
							</span>
						</div>
					</div>
					<div class="item">
						<span data-toggle="modal" data-target="#myModal">
							<div class="btc_team_slider_cont_main_wrapper">
								<div class="btc_ln_img_wrapper float_left">
									<img src="<?=base_url()?>assets/frontend/images/promo_2.png" alt="promo_2">
								</div>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================================= Featured Slider End ======================================-->
	<!--================================= Safe Slider Start ======================================-->
	<div class="x_ln_car_main_wrapper float_left  mb-3 mt-3" style="z-index: 0;">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="x_ln_car_heading_wrapper float_left">
						<h3>Safe</h3>
					</div>
				</div>
				<div class="col-md-12">
					<div class="btc_ln_slider_wrapper btc_ln_slider_wrapper_2">
						<div class="owl-carousel owl-theme">
							<div class="item">
								<div class="btc_team_slider_cont_main_wrapper">
									<div class="btc_ln_img_wrapper float_left">
										<img src="<?=base_url()?>assets/frontend/images\safety.jpg" alt="safety">
									</div>
								</div>
							</div>
							<div class="item">
								<div class="btc_team_slider_cont_main_wrapper">
									<div class="btc_ln_img_wrapper float_left">
										<img src="<?=base_url()?>assets/frontend/images\sanitisation.jpg" alt="sanitisation">
									</div>
								</div>
							</div>
							<div class="item">
								<div class="btc_team_slider_cont_main_wrapper">
									<div class="btc_ln_img_wrapper float_left">
										<img src="<?=base_url()?>assets/frontend/images\doorstep.jpg" alt="doorstep">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================================= Safe Slider End ======================================-->
	<!--================================= Why Cabme slider Start ======================================-->
	<div class="x_ln_car_main_wrapper float_left  mb-3" style="z-index: 0;">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="x_ln_car_heading_wrapper float_left">
						<h3>Why cabme</h3>
					</div>
				</div>
				<div class="col-md-12">
					<div class="btc_ln_slider_wrapper">
						<div class="owl-carousel owl-theme">
							<div class="item">
								<div class="btc_team_slider_cont_main_wrapper">
									<div class="btc_ln_img_wrapper float_left p-3">
										<div class="row justify-content-center">
											<div class="col-md-3 mobileimageicon">
												<img src="<?=base_url()?>assets/frontend/images\homeicon.png" alt="homeicon">
											</div>
											<div class="col-md-9 text-center">
												<h5>Home delivery & return</h5>
												<p>On time doorstep services</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="btc_team_slider_cont_main_wrapper">
									<div class="btc_ln_img_wrapper float_left p-3">
										<div class="row justify-content-center">
											<div class="col-md-3 mobileimageicon">
												<img src="<?=base_url()?>assets/frontend/images\timericon.png" alt="homeicon">
											</div>
											<div class="col-md-9 text-center">
												<h5>Well Maintained Cars</h5>
												<p>Regular services & maintenance</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="btc_team_slider_cont_main_wrapper">
									<div class="btc_ln_img_wrapper float_left p-3">
										<div class="row justify-content-center">
											<div class="col-md-3 mobileimageicon">
												<img src="<?=base_url()?>assets/frontend/images\caricon.png" alt="homeicon">
											</div>
											<div class="col-md-9 text-center">
												<h5>Flexible pricing Plans</h5>
												<p>Choose unlimited kms or with fuel plans </p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================================= Why Cabme slider End ======================================-->
	<!--================================= Mobile FAQ's ======================================-->
	<div class="col-md-12">
		<div class="x_ln_car_heading_wrapper float_left mb-5">
			<h3>FAQ's</h3>
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
	<div class="x_ln_car_heading_wrapper faqunderline mt-3 mb-3 ml-3">
		<h3>Our journey so far</h3>
	</div>
	<div class="container-fluid p-2">
		<div class="container-fluid mt-3 p-3" style="background-color: #fff;box-shadow:0px 1px 10px rgb(209, 209, 209);">
			<div class="row">
				<div class="col-md-3 col-6 text-center imagewidth p-3">
					<div class="row justify-content-center"> <img src="<?=base_url()?>assets/frontend/images/mouthicon.png" alt="mouthicon" style="width: 20%;"> </div>
					<h5 class="mt-2">1 Mn +</h5>
					<p>Happy Customers</p>
				</div>
				<div class="col-md-3 col-6 text-center imagewidth p-3">
					<div class="row justify-content-center"> <img src="<?=base_url()?>assets/frontend/images/locationicon.png" alt="mouthicon" style="width: 20%;"> </div>
					<h5 class="mt-2">22+ cities</h5>
					<p>Across India</p>
				</div>
				<div class="col-md-3 col-6 text-center imagewidth p-3">
					<div class="row justify-content-center"> <img src="<?=base_url()?>assets/frontend/images/caricon_2.png" alt="mouthicon" style="width: 20%;"> </div>
					<h5 class="mt-2">50 Mn +</h5>
					<p>Kms travelled</p>
				</div>
				<div class="col-md-3 col-6 text-center imagewidth p-3">
					<div class="row justify-content-center"> <img src="<?=base_url()?>assets/frontend/images/staricon.png" alt="mouthicon" style="width: 20%;"> </div>
					<h5 class="mt-2">4.8 / 5</h5>
					<p>20K+ reviewers</p>
				</div>
			</div>
		</div>
	</div>
	<!--================================= Our journey End ======================================-->
	<!-- =================== Testimonial ================================== -->
	<div class="x_offer_car_main_wrapper float_left ">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="x_ln_car_heading_wrapper mb-5 mt-3">
						<h3>Reviews</h3>
					</div>
				</div>
				<div class="col-md-12" style="z-index: 0;">
					<div class="screenshot">
						<div class="owl-carousel screen nplr screen-loop">
							<?php $i=1; foreach($testimonials_data as $testimonials) { ?>
							<div>
								<div class="card  valign-wrapper">
										<p>“<?=$testimonials->content?>”</p>
										<p class="card-title"><?=$testimonials->name?></p>
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
