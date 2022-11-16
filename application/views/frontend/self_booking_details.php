
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
	              <li>Self Drive Booking Details</li>
	            </ul>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- btc tittle Wrapper End -->
	<?
$days =  $booking_data[0]->duration/24;
	$hours =  $booking_data[0]->duration%24;
	if($hours>0 && $days >0){
		$s_duration=(int)$days." days, ".$hours." hours";
	}else if($hours==0 && $days>0){
		$s_duration=(int)$days." days";
	}else{
		$s_duration=$hours." hours";
	}
	?>
	<!--============================== Mobile Car Detail =======================================-->
	<div class="coontainer-fluid" id="mobilecardetail" style="background-color: #fff;margin-top: 20px;padding: 20px;">
	  <div class="row">
	    <div class="col-md-12 col-xs-12 text-center">
			  <h2 class="mb-3"><b>Order ID :-</b> #<?=$booking_data[0]->id?></h2>
	      <img src="<?=base_url().$car_data['photo']?>" alt="c1" style="width: 50%;">
	      <h3 style="margin-top: 10px;"><b><?=$car_data['car_name']?></b></h3>
         <h4 style="margin-top: 3px;" class="mb-1"><?=$car_data['brand_name']?></h4>
	    </div>
	    <div class="col-md-12 col-xs-12 text-center">
				<span><img src="<?=base_url()?>assets/frontend/images/gear-shift.png" alt="Gear" class="img-fluid"/></span> <span><?=$car_data['transmission']?></span>&nbsp&nbsp
 			 <span><img src="<?=base_url()?>assets/frontend/images/gas.png" alt="Gas" class="img-fluid"/></span> <span><?=$car_data['fuel_type']?></span>&nbsp
 			 <span><img src="<?=base_url()?>assets/frontend/images/seat.png" alt="seat" class="img-fluid"/></span> <span><?=$car_data['seating']?></span>
	    </div>
	  </div>
	  <div class="row text-center" style="flex-wrap: nowrap;margin-top: 10px;">
	    <div class="col-md-6 col-xs-6 mt-2">
	      <h6> <?=$booking_data[0]->start_date?> <br> <?=$booking_data[0]->start_time?></h6>
	    </div> <span style="color: #000;margin-top: 12px;">To</span>
	    <div class="col-md-6  col-xs-6 mt-2">
				<h6> <?=$booking_data[0]->end_date?> <br> <?=$booking_data[0]->end_time?></h6>
	    </div>
	  </div>
	  <div class="row text-center" style="flex-wrap: nowrap;margin-top: 10px;">
	    <div class="col-md-12 col-xs-12">
	      <p>Duration</p>
	      <h6><?=$s_duration?></h6>
	    </div>
	  </div>
	  <div class="row  text-center">
	    <div class="col-md-12" style="margin-top: 10px;">
	      <p><?=$city_data[0]->name?> </p>
	    </div>
	  </div>
	  <div class="row text-center" style="flex-wrap: nowrap;margin-top: 10px;">
	    <div class="col-md-12 col-xs-12">
	      <p> Includes <?=$booking_data[0]->kilometer?> kms</p>
	    </div>
	  </div>
	</div>
	<!--============================== Mobile Car Detail End =======================================-->

	</div>
	<!--============================== Desktop Car DetailEnd  =======================================-->
	<div class="container-fluid">
	  <div class="row" >
	    <div class="col-md-7 d-none d-sm-none d-md-none  d-lg-block d-xl-block">
	      <div class="x_car_donr_main_box_wrapper float_left mt-3">
	        <div class="x_car_donr_main_box_wrapper_inner">
	          <div class="order-done">
							<div class="col-md-12">
								  <h2 class="mb-4">Order ID :- #<?=$booking_data[0]->id?></h2>
								<img src="<?=base_url().$car_data['photo']?>" alt="<?=$car_data['car_name']?>">
								<h4 style="margin-top: 30px;"><b><?=$car_data['car_name']?></b></h4>
								<h5 style="margin-top: 5px;"><?=$car_data['brand_name']?></h5>
								<div class="row justify-content-center mt-2">
									<div class="col-md-12" class="carmanuals">
										<span><img src="<?=base_url()?>assets/frontend/images/gear-shift.png" alt="Gear" class="img-fluid"/></span> <span><?=$car_data['transmission']?></span>&nbsp&nbsp
										<span><img src="<?=base_url()?>assets/frontend/images/gas.png" alt="Gas" class="img-fluid"/></span> <span><?=$car_data['fuel_type']?></span>&nbsp
										<span><img src="<?=base_url()?>assets/frontend/images/seat.png" alt="seat" class="img-fluid"/></span> <span><?=$car_data['seating']?></span>
									</div>
								</div>
							</div>
							<div class="col-md-12">

					      <div class="col-md-12" style="margin-top: 20px;">
					        <div class="row">
					          <div class="col-md-5">
					            <p> <?=$booking_data[0]->start_date?> @ <?=$booking_data[0]->start_time?>
					          </div>
					          <div class="col-md-1 tolines">To</div>
					          <div class="col-md-5">
					            <p> <?=$booking_data[0]->end_date?> @ <?=$booking_data[0]->end_time?>
					          </div>
					        </div>
					      </div>
					      <p style="margin-top: 10px;"><span style="color: #000;">Duration: </span> &nbsp; <span>
									<?=$s_duration;?></span> </p>
					      <div class="row">
					        <div class="col-md-12 text-center" style="margin-top: 10px;">
					          <p><?=$city_data[0]->name?></p>
					        </div>
					      </div>
					      <div class="row">
					        <div class="col-md-12 p-0 text-center" style="margin-top: 10px;">
					          <p style=""> Includes <?=$booking_data[0]->kilometer?> kms </p>
					        </div>
					      </div>
					    </div>
	          </div>
	        </div>
	      </div>
	    </div>
	    <div class="col-md-5">
	      <div class="x_car_donr_main_box_wrapper float_left mt-3">
	        <div class="x_car_donr_main_box_wrapper_inner">
	          <div class="order-done">
	            <ul class="row list-unstyled">
	              <li class="col-md-12">
	                <h6 class="farelines">FARE DETAILS</h6>
	                <p>Base fare <span>₹ <?=$booking_data[0]->total_amount?></span></p>
	                <p>Insurance & GST <span>Included</span></p>
	                <p>Refundable Security Deposit <span>₹ <?=$booking_data[0]->rsda?></span></p>
	              </li>
	              <li class="col-md-12">
	                <h6 class="totallines">Total</h6>
	                <p>Total <span>₹ <?=$booking_data[0]->final_amount?></span></p>
									<?if(!empty($booking_data[0]->promocode)){?>
	                <p>Promocode Discount <span>₹<?=$booking_data[0]->promo_discount?></span></p>
	                <p>Subtotal <span><?=$booking_data[0]->final_amount-$booking_data[0]->promo_discount?></span></p>
									<?}?>
	                <p>Fuel <span>Excluded</span></p>
	                <p>Tolls, Parking, Inter-State Taxes: <span>To be paid by you</span></p>
	                <p>Extra kms charge <span>₹ <?=$car_data['extra_kilo']?>/km</span></p>
	                <!-- <div class="x_slider_form_input_wrapper mt-2">
	                  <input type="text" placeholder="Pick-Up Location" style="border: none;border-bottom: 1px solid grey;border-radius: 0px;">
	                </div> -->
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
