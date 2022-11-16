<!-- btc tittle Wrapper Start -->
<div class="btc_tittle_main_wrapper" style="margin-top: 100px;">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 full_width">
				<div class="btc_tittle_right_heading">
					<div class="btc_tittle_right_cont_wrapper">
						<ul>
							<li><a href="<?=base_url()?>">Home</a> <i class="fa fa-angle-right"></i>
							</li>
							<li><a href="<?=base_url()?>Home/my_profile#booking">Booking</a> <i class="fa fa-angle-right"></i>
							</li>
							<li>Intercity Booking Details</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- btc tittle Wrapper End -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 mx-auto">
			<div class="x_car_donr_main_box_wrapper float_left mt-3">
				<div class="x_car_donr_main_box_wrapper_inner">
					<div class="order-done">
						<ul class="row list-unstyled">
							<li class="col-md-12">
								<h6 class="farelines" ><b>Order ID:- </b> #<?=$booking_data[0]->id?></h6>
								<p><b>City :</b> <span><?=$city_data[0]->name?></span></p>
								<p><b>Car Type :</b><span><?=$booking_data[0]->cab_type?></span></p>
								<p><b>Start Date & Time :</b><span><?=$booking_data[0]->start_date?> @ <?=$booking_data[0]->start_time?></span></p>
								<p><b>End Date & Time :</b><span><?=$booking_data[0]->end_date?> @ <?=$booking_data[0]->end_time?></span></p>
								<p><b>Price</b><span>₹<?=$booking_data[0]->kilometer_price?></span></p>
								<p><b>Killometer Cap</b><span><?=$booking_data[0]->kilometer?> Kms</span></p>
								<p><b>Minimum Booking Amt.</b><span>₹<?=$booking_data[0]->mini_booking?></span></p>
							</li>
						</ul>

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
</div>
<!--====== Content End ======-->
