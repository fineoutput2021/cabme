
<!--======proof Modal ======-->

<div class="modal fade" id="proofModal" role="dialog">
	<div class="modal-dialog proofModal">
		<!-- Modal content-->
		<div class="modal-content loginModal-content">
			<div class="modal-header">
				<div class="col-md-11 col-11 text-center">
					<h4 class="modal-title">Eligibility & ID</h4>
				</div>
				<div class="col-md-1 col-1"> <button type="button" class="close"
						data-dismiss="modal">&times;</button>
				</div>
			</div>
			<div class="modal-body">
				<form method="post" enctype="multipart/form-data" action="<?=base_url()?>Home/self_checkout" >
				<div class="formsix-pos">
					<div class="form-sec-header proofdateofbirth mb-4">
						<label class="cal-icon">
							  <td>
							<?
							  $newdate = new DateTime($user_data[0]->dob);
							  $dob= $newdate->format('Y-m-d');   #d-m-Y  // March 10, 2001, 5:16 pm
							  ?>
							</td>
							<input type="date" name="dob" placeholder="Date Of Birth" required class="form-control " value="<?=$dob?>">
						</label>
					</div>
					<div class="form-group mb-4">
						<input type="text" name="aadhar_no" minlength="12" maxlength="12" class="form-control modalinput" required="" placeholder="Aadhar Number*" value="<?=$user_data[0]->aadhar_no?>"   onkeypress="return isNumberKey(event)">
					</div>
					<div class="form-group mb-4">
						<input type="text" name="driving_lience" minlength="16" maxlength="16" class="form-control modalinput" required="" placeholder="Driving License*"  value="<?=$user_data[0]->driving_lience?>">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<p class="mt-1 mb-1">Upload <b>Aadhar Front</b> Image</p>
						<input type="file" name="aadhar_front" required value="">
					</div>
					<div class="col-md-12">
						<p class="mt-1  mb-1">Upload <b>Aadhar Back</b> Image</p>
						<input type="file"  name="aadhar_back" required value="">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<p class="mt-1 mb-1">Upload <b>License Front</b> Image</p>
						<input type="file" name="license_front" required value="">
					</div>
					<div class="col-md-12">
						<p class="mt-1  mb-1">Upload <b>License Back</b> Image</p>
						<input type="file" name="license_back" required value="">
					</div>
				</div>
				<div class="row  mt-2">
					<div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
						<input type="checkbox" id="agree" name="agree" required>
						<label for="agree">I Accept Terms & Conditions</label>
					</div>
				</div>
				<input type="hidden" name="id" value="<?=base64_encode($booking_data[0]->id)?>">
				<div class="row justify-content-center mt-2">
					<button type="submit" class="btn loginbtn">Proceed To Pay</button>
				</div>
			</div>
		</form>
		</div>
	</div>
</div>

<!--====== proof Modal End ======-->
		<!--====== Change Plan Modal ======-->
		<div class="modal fade " id="changeplan" role="dialog">
			<div class="modal-dialog " style="width: auto;">

				<!-- Modal content-->
				<div class="modal-content ">
					<div class="modal-header">
						<h4 class="modal-title">Change Pricing Plan</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<p style="font-size: 18px;margin-top: 15px;">Change Plan</p>
					<div class="x_offer_tabs_wrapper">
						<ul class="nav nav-tabs All_Car_tabs plantabs w-100 mt-3"
							style="display: inline-flex; flex-wrap: nowrap;">
							<li class="nav-item"> <a class="nav-link <?if($booking_data[0]->kilometer_type==1){echo'active';}?>"
									data-toggle="tab" href="#first" id="tab_1" value="1" idd="<?=base64_encode($booking_data[0]->id)?>" onclick="change_plan(this)"> ₹ <?=$car_data['price1']?> <br> <?=$car_data['kilometer1']?> Kms</a>
							</li>
							<li class="nav-item borderright"> <a class="nav-link <?if($booking_data[0]->kilometer_type==2){echo'active';}?> " data-toggle="tab"
									href="#second" id="tab_2" value="2" idd="<?=base64_encode($booking_data[0]->id)?>" onclick="change_plan(this)"> ₹ <?=$car_data['price2']?> <br> <?=$car_data['kilometer2']?> Kms
								</a>
							</li>
							<li class="nav-item" style="width: 34%;"> <a class="nav-link <?if($booking_data[0]->kilometer_type==3){echo'active';}?>" data-toggle="tab"
									href="#third" id="tab_3" value="3" idd="<?=base64_encode($booking_data[0]->id)?>" onclick="change_plan(this)"> ₹ <?=$car_data['price3']?> <br> <?=$car_data['kilometer3']?> Kms
								</a>
							</li>
						</ul>
					</div>
					<div class="modal-footer mt-2">
						Please Note:
						<ul>
							<li style="font-size: 13px;">* Pricing plan cannot be changed after the creation of a booking
								Extra Kms charge: Rs <?=$car_data['extra_kilo']?>/km</li>
							<li style="font-size: 13px;">* We don not permit taking Cabme vehicles to Let/Ladakh region,
								Kaza/Nako region and Spiti Valley</li>
						</ul>
					</div>
				</div>

			</div>
		</div>

		<!--====== Change Plan Modal End ======-->

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
	              <li><a href="<?=base_url()?>Home/show_self_drive_cars/<?=base64_encode($booking_data[0]->search_id)?>">Self Drive Car</a> <i class="fa fa-angle-right"></i>
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
	<?
	$days =  (int)$booking_data[0]->duration/24;
	$hours =  $booking_data[0]->duration%24;
	if($hours>0 && $days >0){
		$s_duration=$days." days, ".$hours." hours";
	}else if($hours==0 && $days>0){
		$s_duration=$days." days";
	}else{
		$s_duration=$hours." hours";
	}
	?>
	<!--============================== Mobile Car Detail =======================================-->
	<div class="coontainer-fluid" id="mobilecardetail" style="background-color: #fff;margin-top: 20px;padding: 20px;">
	  <div class="row">
	    <div class="col-md-12 col-xs-12 text-center">
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
	      <p><?=$city_data[0]->name?> <span style="margin-left: 30px;"> <a href="<?=base_url()?>Home/show_self_drive_cars/<?=base64_encode($booking_data[0]->search_id)?>"  style="color: red;" >Change City</a> </span> </p>
	    </div>
	  </div>
	  <div class="row text-center" style="flex-wrap: nowrap;margin-top: 10px;">
	    <div class="col-md-12 col-xs-12">
	      <p> Includes <?=$booking_data[0]->kilometer?> kms <span style="margin-left: 30px;"> <a href="#" style="color: red;" data-toggle="modal" data-target="#changeplan" data-dismiss="modal">Change plan</a> </span>
	      </p>
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
	          <span><img src="<?=base_url()?>assets/frontend/images/gear-shift.png" alt="Gear" class="img-fluid"/></span> <span><?=$car_data['transmission']?></span>&nbsp&nbsp
	          <span><img src="<?=base_url()?>assets/frontend/images/gas.png" alt="Gas" class="img-fluid"/></span> <span><?=$car_data['fuel_type']?></span>&nbsp
	          <span><img src="<?=base_url()?>assets/frontend/images/seat.png" alt="seat" class="img-fluid"/></span> <span><?=$car_data['seating']?></span>
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
	      <p style="margin-top: 10px;"><span style="color: #000;">Duration: </span> &nbsp; <span>
					<?=$s_duration;?></span> </p>
	      <div class="row">
	        <div class="col-md-4" style="margin-top: 10px;">
	          <p>Jaipur</p>
	        </div>
	        <div class="col-md-4" style="margin-top: 10px;"><span style="margin-left: 30px;"> <a href="<?=base_url()?>Home/show_self_drive_cars/<?=base64_encode($booking_data[0]->search_id)?>" style="color: red;">Change City</a> </span></div>
	      </div>
	      <div class="row">
	        <div class="col-md-4 p-0" style="margin-top: 10px;">
	          <p style="margin-left: 78px;"> Includes <?=$booking_data[0]->kilometer?> kms </p>
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
	                <p>Insurance & GST <span>Included</span></p>
	                <p>Refundable Security Deposit <span>₹ <?=$booking_data[0]->rsda?></span></p>
									<?if(!empty($booking_data[0]->promocode)){
										$promo = $this->db->get_where('tbl_promocode', array('id'=> $booking_data[0]->promocode))->result();
										?>
										<div class="mt-3 d-flex">
									<p style="color:red"><b><?=$promo[0]->promocode?></b></p>
										<a href="<?=base_url()?>Home/remove_promo/<?=base64_encode($booking_data[0]->id)?>" class="ml-5"><button type="button" class="close" >×</button></a>
								</div>
									<?}?>
	                <div class="row mt-2">
										<form method="post" action="<?=base_url()?>Home/self_promocode" style="display:contents">
											<input type="hidden" name="id" value="<?=base64_encode($booking_data[0]->id)?>">
	                  <div class="x_slider_form_input_wrapper col-md-8 col-8 p-0">
	                    <input type="text" name="promocode" placeholder="Promo Code" style="border: none;border-bottom: 1px solid grey;border-radius: 0px;">
	                  </div>
	                  <div class="col-md-4 col-4">
	                    <button class="bookbtn float-left" style="margin-top: 7px;" type="submit">Apply</button>
	                  </div>
									</form>
	                </div>
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
	            <button class="bookbtn col-md-4" data-toggle="modal" data-target="#proofModal" data-dismiss="modal">Pay</button>
	            <!-- <a href="<?=base_url()?>Home/self_checkout/<?=base64_encode($booking_data[0]->id)?>"><button class="bookbtn col-md-4">Pay</button></a> -->
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
	<!-- <div class="container">
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
	</div> -->
	<!--====== Content End ======-->

<script>
function change_plan(obj) {
  var booking_id = $(obj).attr("idd");
  var km_type = $(obj).attr("value");
  // alert(value);
	// return;
  var base_path = "<?=base_url();?>";
  $.ajax({
    url: '<?=base_url();?>Home/change_plan',
    method: 'post',
    data: {
      booking_id: booking_id,
      km_type: km_type
    },
    dataType: 'json',
    success: function(response) {
			// alert(response.status)
      if (response.status == true) {
      location.reload()

      } else if (response.status == false) {
      location.reload()
      }
    }
  });
}
</script>
<script>
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>
