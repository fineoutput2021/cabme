

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
	              <li><a href="<?=base_url()?>Home/show_outstation_cars/<?=base64_encode($booking_data[0]->search_id)?>">Outstation Car</a> <i class="fa fa-angle-right"></i>
	              </li>
	              <li>Booking Summary</li>
	            </ul>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- btc tittle Wrapper End -->
	<!--============================== Mobile Car Detail =======================================-->
	<div class="coontainer-fluid" id="mobilecardetail" style="background-color: #fff;margin-top: 20px;padding: 20px;">
	  <div class="row">
	    <div class="col-md-12 col-xs-12 text-center">
	      <img src="<?=base_url().$car_data['photo']?>" alt="c1" style="width: 50%;">
	      <h3 style="margin-top: 10px;"><b><?=$car_data['car_name']?></b></h3>
         <h4 style="margin-top: 3px;" class="mb-1"><?=$car_data['brand_name']?></h4>
	    </div>
	    <div class="col-md-12 col-xs-12 text-center">
        <span></span>
        <span><img src="<?=base_url()?>assets/frontend/images/seat.png" alt="seat" class="img-fluid"/></span> <span><?=$car_data['seating']?></span>
        <span></span>
	    </div>
	  </div>
	  <div class="row text-center" style="flex-wrap: nowrap;margin-top: 10px;">
			 <?if(!empty($booking_data[0]->end_date)){?>
	    <div class="col-md-6 col-xs-6 mt-2">
	      <h6> <?=$booking_data[0]->start_date?> <br> <?=$booking_data[0]->start_time?></h6>
	    </div> <span style="color: #000;margin-top: 12px;">To</span>
	    <div class="col-md-6  col-xs-6 mt-2">
				<h6> <?=$booking_data[0]->end_date?> <br> <?=$booking_data[0]->end_time?></h6>
	    </div>
			<?}else{?>
				<div class="col-md-12 col-xs-12 mt-2">
					<h6> <?=$booking_data[0]->start_date?> <br> <?=$booking_data[0]->start_time?></h6>
				</div>
				<?}?>
	  </div>
	  <div class="row text-center" style="flex-wrap: nowrap;margin-top: 10px;">
	    <div class="col-md-12 col-xs-12">
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
				<p>Duration</p>
				<h6><?=$s_duration?></h6>
	    </div>
	  </div>
	  <div class="row  text-center">
	    <div class="col-md-12" style="margin-top: 10px;">
	      <p><?=$city_data[0]->name?> <span style="margin-left: 30px;"> <a href="#" style="color: red;" data-toggle="modal" data-target="#selectcity4" data-dismiss="modal">Change City</a> </span> </p>
	    </div>
	  </div>
	</div>
	<!--============================== Mobile Car Detail End =======================================-->
	<!--============================== Desktop Car Detail =======================================-->
	<div class="container-fluid desktopcardetail" style="background-color: #fff;margin-top: 10px;padding: 20px;">
	  <div class="row" style="text-align: center;">
	    <div class="col-md-6">
	      <img src="<?=base_url().$car_data['photo']?>" alt="<?=$car_data['car_name']?>">
	      <h4 style="margin-top: 30px;"><b><?=$car_data['car_name']?></b></h4>
	      <h5 style="margin-top: 5px;"><?=$car_data['brand_name']?></h5>
	      <div class="row justify-content-center mt-2">
	        <div class="col-md-12" class="carmanuals">
	          <span></span>
            <span><img src="<?=base_url()?>assets/frontend/images/seat.png" alt="seat" class="img-fluid"/></span> <span><?=$car_data['seating']?></span>
	          <span></span>
	        </div>
	      </div>
	    </div>
	    <div class="col-md-6">
	      <h2 class="bookingline">Booking Details</h2>
	      <div class="col-md-12" style="margin-top: 20px;">
	        <div class="row justify-content-center">
						 <?if(!empty($booking_data[0]->end_date)){?>
	          <div class="col-md-5">
	            <p> <?=$booking_data[0]->start_date?> @ <?=$booking_data[0]->start_time?>
	          </div>
	          <div class="col-md-1 tolines">To</div>
	          <div class="col-md-5">
	            <p> <?=$booking_data[0]->end_date?> @ <?=$booking_data[0]->end_time?>
	          </div>
						<p style="margin-top: 10px;"><span style="color: #000;">Duration: </span> &nbsp; <span><?=$s_duration?></span> </p>
						<?}else{?>
							<div class="col-md-12">
								<p><span style="color: #000;">Date & Time: </span> &nbsp; <span><?=$booking_data[0]->start_date?> @ <?=$booking_data[0]->start_time?></span> </p>
		          </div>
								<?}?>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
	</div>
	<!--============================== Desktop Car DetailEnd  =======================================-->
	<div class="container-fluid">
	  <div class="row" id="reversedivs">
	    <div class="col-md-8">
	      <div class="x_car_donr_main_box_wrapper float_left mt-3">
	        <div class="x_car_donr_main_box_wrapper_inner">
	          <div class="order-done">
	            <ul class="row list-unstyled">
	              <li class="col-md-12">
	                <h6 class="implines">IMPORTANT POINTS TO REMEMBER</h6>
	                <div class="row">
	                  <div class="col-md-6" style="color: #000;">CHANGE IN PRICING PLAN:</div>
	                  <div class="col-md-6"> The pricing plan (7 kms/hr, without fuel) cannot be
	                    changed after
	                    the booking is made
	                  </div>
	                </div>
	                <div class="row mt-2">
	                  <div class="col-md-6" style="color: #000;">FUEL:</div>
	                  <div class="col-md-6"> In case you are returning the car at a lower fuel level
	                    than what
	                    was received, we will charge a flat Rs 500 refuelling service charge +
	                    actual fuel
	                    cost to get the tank to the same level as what was received
	                  </div>
	                </div>
	                <div class="row mt-2">
	                  <div class="col-md-6" style="color: #000;">TOLLS, PARKING, INTER-STATE TAXES:
	                  </div>
	                  <div class="col-md-6"> To be paid by you.</div>
	                </div>
	              </li>
	            </ul>
	          </div>
	        </div>
	      </div>
	    </div>
	    <div class="col-md-4">
	      <div class="x_car_donr_main_box_wrapper float_left mt-3">
	        <div class="x_car_donr_main_box_wrapper_inner">
	          <div class="order-done">
	            <ul class="row list-unstyled">
	              <li class="col-md-12">
	                <h6 class="farelines">FARE DETAILS</h6>
	                <p>Rate Per Kilometer <span>₹ <?=$booking_data[0]->kilometer_price?></span></p>
	                <p>Insurance & GST <span>Included</span></p>
	              </li>
	              <li class="col-md-12">
	                <h6 class="totallines">Total</h6>
	                <p>Min Booking Amount <span>₹ <?=$booking_data[0]->mini_booking?></span></p>
	                <p>Fuel <span>Excluded</span></p>
	                <p>Tolls, Parking, Inter-State Taxes: <span>To be paid by you</span></p>
	              </li>
	            </ul>
	            <a href="<?=base_url()?>Home/outstation_checkout/<?=base64_encode($booking_data[0]->id)?>"><button class="bookbtn col-md-4">Pay</button></a>
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
	<!--====== Content ======-->
	<div class="container">
	  <div class="row p-3">
	    <h4 class="mt-5">Self-Drive Car Rentals in Delhi NCR</h4>
	    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam amet nihil, voluptatem incidunt tempore
	      praesentium. Explicabo, minus quaerat in illo obcaecati impedit repellat quae esse, dolore incidunt modi
	      pariatur sed?</p>
	  </div>
	  <div class="row p-3">
	    <h4 class="mt-5">Places to Go</h4>
	    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam amet nihil, voluptatem incidunt tempore
	      praesentium. Explicabo, minus quaerat in illo obcaecati impedit repellat quae esse, dolore incidunt modi
	      pariatur sed?</p>
	  </div>
	  <div class="row p-3">
	    <h4 class="mt-5">Selecting a Car</h4>
	    <p class="mb-4">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam amet nihil, voluptatem
	      incidunt tempore praesentium. Explicabo, minus quaerat in illo obcaecati impedit repellat quae esse,
	      dolore incidunt modi pariatur sed?</p>
	  </div>
	</div>
	<!--====== Content End ======-->
