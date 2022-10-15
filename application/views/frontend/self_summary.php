	<!-- btc tittle Wrapper Start -->
	<div class="btc_tittle_main_wrapper" style="margin-top: 100px;">
	  <div class="container-fluid">
	    <div class="row">
	      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 full_width">
	        <div class="btc_tittle_right_heading">
	          <div class="btc_tittle_right_cont_wrapper">
	            <ul>
	              <li><a href="index.html">Home</a> <i class="fa fa-angle-right"></i>
	              </li>
	              <li><a href="self_cars.html">self_cars</a> <i class="fa fa-angle-right"></i>
	              </li>
	              <li>Summary</li>
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
	      <img src="<?=base_url().$car_data[0]->photo?>" alt="c1" style="width: 50%;">
	      <h3 style="margin-top: 10px;"><b><?=$car_data[0]->car_name?></b></h3>
         <h4 style="margin-top: 3px;"><?=$car_data[0]->brand_name?></h4>
	    </div>
	    <div class="col-md-12 col-xs-12 text-center">
	      <span>⚙️</span> <span>Manual</span>
	      <span>⛽</span> <span>Petrol</span>
	      <span>💺</span> <span>5 Seats</span>
	    </div>
	  </div>
	  <div class="row text-center" style="flex-wrap: nowrap;margin-top: 10px;">
	    <div class="col-md-6 col-xs-6">
	      <p>Start Date</p>
	      <h6>20 Sep 2002</h6>
	    </div> <span style="color: #000;margin-top: 12px;">To</span>
	    <div class="col-md-6  col-xs-6">
	      <p>End Date</p>
	      <h6>22 Sep 2002</h6>
	    </div>
	  </div>
	  <div class="row text-center" style="flex-wrap: nowrap;margin-top: 10px;">
	    <div class="col-md-12 col-xs-12">
	      <p>Duration</p>
	      <h6>48 : 00 Hours</h6>
	    </div>
	  </div>
	  <div class="row  text-center">
	    <div class="col-md-12" style="margin-top: 10px;">
	      <p>Jaipur <span style="margin-left: 30px;"> <a href="#" style="color: red;" data-toggle="modal" data-target="#selectcity" data-dismiss="modal">Change City</a> </span> </p>
	    </div>
	  </div>
	  <div class="row text-center" style="flex-wrap: nowrap;margin-top: 10px;">
	    <div class="col-md-12 col-xs-12">
	      <p> Includes 1344 kms <span style="margin-left: 30px;"> <a href="#" style="color: red;" data-toggle="modal" data-target="#changeplan" data-dismiss="modal">Change plan</a> </span>
	      </p>
	    </div>
	  </div>
	</div>
	<!--============================== Mobile Car Detail End =======================================-->
	<!--============================== Desktop Car Detail =======================================-->
	<div class="container-fluid desktopcardetail" style="background-color: #fff;margin-top: 10px;padding: 20px;">
	  <div class="row" style="text-align: center;">
	    <div class="col-md-6">
	      <img src="<?=base_url().$car_data[0]->photo?>" alt="<?=$car_data[0]->car_name?>">
	      <h4 style="margin-top: 30px;"><b><?=$car_data[0]->car_name?></b></h4>
	      <h5 style="margin-top: 5px;"><?=$car_data[0]->brand_name?></h5>
	      <div class="row justify-content-center mt-2">
	        <div class="col-md-12" class="carmanuals">
	          <span>⚙️</span> <span><?=$car_data[0]->transmission?></span>
	          <span>⛽</span> <span><?=$car_data[0]->fule_type?></span>
	          <span>💺</span> <span><?=$car_data[0]->seatting?></span>
	        </div>
	      </div>
	    </div>
	    <div class="col-md-6">
	      <h2 class="bookingline">Booking Details</h2>
	      <div class="col-md-12" style="margin-top: 20px;">
	        <div class="row justify-content-center">
	          <div class="col-md-5">
	            <p> <?=$booking_data[0]->start_date?> @ <?=$booking_data[0]->start_time?>
	          </div>
	          <div class="col-md-1 tolines">To</div>
	          <div class="col-md-5">
	            <p> <?=$booking_data[0]->end_date?> @ <?=$booking_data[0]->end_time?>
	          </div>
	        </div>
	      </div>
	      <p style="margin-top: 10px;"><span style="color: #000;">Duration: </span> &nbsp; <span>4 Days : 8
	          Hours</span> </p>
	      <div class="row">
	        <div class="col-md-4" style="margin-top: 10px;">
	          <p>Jaipur</p>
	        </div>
	        <div class="col-md-4" style="margin-top: 10px;"><span style="margin-left: 30px;"> <a href="#" style="color: red;" data-toggle="modal" data-target="#selectcity" data-dismiss="modal">Change City</a> </span></div>
	      </div>
	      <div class="row">
	        <div class="col-md-4 p-0" style="margin-top: 10px;">
	          <p style="margin-left: 85px;"> Includes <?=$booking_data[0]->kilometer?> kms </p>
	        </div>
	        <div class="col-md-4" style="margin-top: 10px;"><span style="margin-left: 30px;"> <a href="#" style="color: red;" data-toggle="modal" data-target="#changeplan" data-dismiss="modal">Change plan</a> </span></div>
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
	                <p>Base fare <span>₹ <?=$booking_data[0]->total_amount?></span></p>
	                <!-- <p>Doorstep delivery & pickup <span>₹ 200</span></p> -->
	                <p>Insurance & GST <span>included</span></p>
	                <p>Refundable Security Deposit <span>₹ <?=$booking_data[0]->rsda?></span></p>
	                <div class="row mt-2">
	                  <div class="x_slider_form_input_wrapper col-md-8 col-8 p-0">
	                    <input type="text" placeholder="Promo Code" style="border: none;border-bottom: 1px solid grey;border-radius: 0px;">
	                  </div>
	                  <div class="col-md-4 col-4">
	                    <button class="bookbtn float-left" style="margin-top: 7px;">Apply</button>
	                  </div>
	                </div>
	              </li>
	              <li class="col-md-12">
	                <h6 class="totallines">Total</h6>
	                <p>Payment <span>₹ <?=$booking_data[0]->final_amount?></span></p>
	                <!-- <p>Kms limit <span>131 kms</span></p> -->
	                <p>Fuel <span>Excluded</span></p>
	                <p>Extra kms charge <span>₹ <?=$car_data[0]->extra_kilo?>/km</span></p>
	                <div class="x_slider_form_input_wrapper mt-2">
	                  <input type="text" placeholder="Pick-Up Location" style="border: none;border-bottom: 1px solid grey;border-radius: 0px;">
	                </div>
	              </li>
	            </ul>
	            <button class="bookbtn col-md-4" data-toggle="modal" data-target="#proofModal" data-dismiss="modal">Pay</button>
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
