<style>
  @media(max-width: 767px) {
    .desktopbtn {
      display: none;
    }
  }

  .fa-user {
    color: #fff !important;
  }

  @media(min-width:767px) {
    .selectcity {
      border-top-left-radius: 20px;
      border-bottom-left-radius: 20px;
    }

    .brright {
      border-top-right-radius: 20px;
      border-bottom-right-radius: 20px;
    }
  }
</style>
<!-- btc tittle Wrapper Start -->
<!--====== Sort By Modal ======-->

<div class="filterbyModal fade" id="filterbyModal" role="dialog" style="z-index: 99999;">
  <div class="sortbyModal-dialog modal-dialog">

    <!-- Modal content-->
    <div class="sortbyModal-content modal-content" >
      <div class="modal-header p-1">
        <div class="col-md-11 col-11 text-center">
          <h6 class="modal-title">Filters</h6>
        </div>
        <div class="col-md-1 col-1"> <button type="button" class="close"
            data-dismiss="modal">&times;</button>
        </div>
      </div>
      <!-- Segment -->
      <div class="modal-body">
        <form method="get" enctype="multipart/form-data" action="<?=base_url()?>Home/show_self_drive_cars/<?=base64_encode($search[0]->id)?>">
          <button type="submit" class="btn  bg-b" style="color:white;float: right;box-shadow:none;">Apply</button>
        <br>
        <!-- Brand -->
        <h5 class="mb-2" style="font-weight: bold;">Brand</h5>
        <div class="doflex">
          <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
            <input type="checkbox" id="Hyu1" name="brand[]" value="Maruti Suzuki" <?if(!empty($brand)){foreach ($brand as $value) {
              if($value=='Maruti Suzuki'){echo "checked";break;}
            }}?>>
            <label for="Hyu1">Maruti Suzuki</label>
          </div> &nbsp; &nbsp;
          <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
            <input type="checkbox" id="Mar" name="brand[]" value="Mahindra"<?if(!empty($brand)){foreach ($brand as $value) {
              if($value=='Mahindra'){echo "checked";break;}
            }}?>>
            <label for="Mar">Mahindra</label>
          </div> &nbsp; &nbsp;
          <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
            <input type="checkbox" id="Chervolet" name="brand[]" value="Chervolet"<?if(!empty($brand)){foreach ($brand as $value) {
              if($value=='Chervolet'){echo "checked";break;}
            }}?>>
            <label for="Chervolet">Chervolet</label>
          </div> &nbsp; &nbsp;
          <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
            <input type="checkbox" id="Tata" name="brand[]" value="Tata"<?if(!empty($brand)){foreach ($brand as $value) {
              if($value=='Tata'){echo "checked";break;}
            }}?>>
            <label for="Tata">Tata</label>
          </div> &nbsp; &nbsp;
        </div>

        <!-- Fuel Type -->
        <h5 class="mb-2" style="font-weight: bold;">Fuel Type</h5>
        <div class="doflex">
          <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
            <input type="checkbox" id="Diesel" name="fuel[]" value="1"<?if(!empty($fuel)){foreach ($fuel as $value) {
              if($value==1){echo "checked";break;}
            }}?>>
            <label for="Diesel">Petrol</label>
          </div> &nbsp; &nbsp;
          <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
            <input type="checkbox" id="Petrol" name="fuel[]" value="2" <?if(!empty($fuel)){foreach ($fuel as $value) {
              if($value==2){echo "checked";break;}
            }}?>>
            <label for="Petrol">Diesel</label>
          </div> &nbsp; &nbsp;
          <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
            <input type="checkbox" id="CNG2" name="fuel[]" value="3" <?if(!empty($fuel)){foreach ($fuel as $value) {
              if($value==3){echo "checked";break;}
            }}?>>
            <label for="CNG2">CNG</label>
          </div> &nbsp; &nbsp;
        </div>

        <!-- Transmission Type -->
        <h5 class="mb-2" style="font-weight: bold;">Transmission Type</h5>
        <div class="doflex">
          <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
            <input type="checkbox" id="Automaticcc" name="transmission[]" value="1" <?if(!empty($transmission)){foreach ($transmission as $value) {
              if($value==1){echo "checked";break;}
            }}?>>
            <label for="Automaticcc">Manual</label>
          </div> &nbsp; &nbsp;
          <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
            <input type="checkbox" id="Manualll" name="transmission[]" value="2" <?if(!empty($transmission)){foreach ($transmission as $value) {
              if($value==2){echo "checked";break;}
            }}?>>
            <label for="Manualll">Automatic</label>
          </div> &nbsp; &nbsp;
        </div>

        <!-- Seating Capacity -->
        <h5 class="mb-2" style="font-weight: bold;">Seating Capacity</h5>
        <div class="doflex">
          <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
            <input type="checkbox" id="5-Seats" name="seating[]" value="1" <?if(!empty($seating)){foreach ($seating as $value) {
              if($value==1){echo "checked";break;}
            }}?>>
            <label for="5-Seats"> 5 Seats </label>
          </div> &nbsp; &nbsp;
          <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
            <input type="checkbox" id="7-Seats" name="seating[]" value="2" <?if(!empty($seating)){foreach ($seating as $value) {
              if($value==2){echo "checked";break;}
            }}?>>
            <label for="7-Seats">7 Seats </label>
          </div> &nbsp; &nbsp;
          <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
            <input type="checkbox" id="9-Seatsss"  name="seating[]" value="3" <?if(!empty($seating)){foreach ($seating as $value) {
              if($value==3){echo "checked";break;}
            }}?>>
            <label for="9-Seatsss">9 Seats </label>
          </div> &nbsp; &nbsp;
        </div>
  </form>
      </div>
      <!-- Segment End -->
    </div>
  </div>
</div>

<div class="btc_tittle_main_wrapper" style="margin-top: 100px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 full_width">
        <div class="btc_tittle_right_heading">
          <div class="btc_tittle_right_cont_wrapper">
            <ul>
              <li><a href="<?=base_url()?>">Home</a> <i class="fa fa-angle-right"></i>
              </li>
              <li>Self Drive Cars</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- btc tittle Wrapper End -->
<!-- x car book sidebar section Wrapper Start -->
<div class=" float_left mt-4">
  <div class="container-fluid mb-5">
    <div class="row mt-5">
      <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12 desktopfilterdiv">
        <!-- btc tittle Wrapper Start -->
        <div class="btc_tittle_main_wrapper" style="margin-top: 10px;">
          <div class="container-fluid">
            <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 full_width">
                <div class="btc_tittle_right_heading">
                  <div class="btc_tittle_right_cont_wrapper">
                    <ul>
                      <li><a href="<?=base_url()?>">Home</a> <i class="fa fa-angle-right"></i>
                      </li>
                      <li>Self Drive Cars</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- btc tittle Wrapper End -->
        <div class="x_car_book_left_siderbar_wrapper float_left">
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <!-- Filter Results -->
              <div class="car-filter accordion car_booking_onliy_side" style="margin-top: 46px;">
                <form method="get" enctype="multipart/form-data" action="<?=base_url()?>Home/show_self_drive_cars/<?=base64_encode($search[0]->id)?>">
                <div class="row">
                  <div class="col-md-6" style="align-self: center">
                    <h3 style="margin-top: 5px;">Filters</h3>
                  </div>
                  <div class="col-md-6">
                    <button type="submit" class="btn  bg-b" style="color:white;float: right;box-shadow:none;">Apply</button>
                  </div>
                </div>
                <hr>
                <!-- Brand -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h5 class="panel-title"> <a data-toggle="collapse" href="#collapseTwo" class="collapse">Brand</a> </h5>
                  </div>
                  <div id="collapseTwo" class="collapse show">
                    <div class="panel-body">
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="brand_1" name="brand[]" value="Maruti Suzuki" <?if(!empty($brand)){foreach ($brand as $value) {
                          if($value=='Maruti Suzuki'){echo "checked";break;}
                        }}?>>
                        <label for="brand_1">Maruti Suzuki</label>
                      </div>
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="brand_2" name="brand[]" value="Mahindra"<?if(!empty($brand)){foreach ($brand as $value) {
                          if($value=='Mahindra'){echo "checked";break;}
                        }}?>>
                        <label for="brand_2">Mahindra</label>
                      </div>
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="brand_3" name="brand[]" value="Chervolet"<?if(!empty($brand)){foreach ($brand as $value) {
                          if($value=='Chervolet'){echo "checked";break;}
                        }}?>>
                        <label for="brand_3">Chervolet</label>
                      </div>
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="brand_4" name="brand[]" value="Tata"<?if(!empty($brand)){foreach ($brand as $value) {
                          if($value=='Tata'){echo "checked";break;}
                        }}?>>
                        <label for="brand_4">Tata</label>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <!-- Brand End -->
                <!-- Fuel Type -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h5 class="panel-title"> <a data-toggle="collapse" href="#collapseThree" class="collapsed"> Fuel Type</a> </h5>
                  </div>
                  <div id="collapseThree" class="collapse ">
                    <div class="panel-body">
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="c10" name="fuel[]" value="1"<?if(!empty($fuel)){foreach ($fuel as $value) {
                          if($value==1){echo "checked";break;}
                        }}?>>
                        <label for="c10">Petrol</label>
                      </div>
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="c11" name="fuel[]" value="2" <?if(!empty($fuel)){foreach ($fuel as $value) {
                          if($value==2){echo "checked";break;}
                        }}?>>
                        <label for="c11">Diesel</label>
                      </div>
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="CNG" name="fuel[]" value="3" <?if(!empty($fuel)){foreach ($fuel as $value) {
                          if($value==3){echo "checked";break;}
                        }}?>>
                        <label for="CNG">CNG</label>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <!-- Fuel Type End -->
                <!-- Transmission Type -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h5 class="panel-title"> <a data-toggle="collapse" href="#collapseFour" class="collapsed"> Transmission Type</a> </h5>
                  </div>
                  <div id="collapseFour" class="collapse ">
                    <div class="panel-body">
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="Manual" name="transmission[]" value="1" <?if(!empty($transmission)){foreach ($transmission as $value) {
                          if($value==1){echo "checked";break;}
                        }}?>>
                        <label for="Manual">Manual</label>
                      </div>
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="Automatic" name="transmission[]" value="2" <?if(!empty($transmission)){foreach ($transmission as $value) {
                          if($value==2){echo "checked";break;}
                        }}?>>
                        <label for="Automatic">Automatic</label>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <!-- Transmission Type End -->
                <!-- Seating Capacity -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h5 class="panel-title"> <a data-toggle="collapse" href="#collapseFive" class="collapsed"> Seating Capacity</a> </h5>
                  </div>
                  <div id="collapseFive" class="collapse ">
                    <div class="panel-body">
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="5_Seats" name="seating[]" value="1" <?if(!empty($seating)){foreach ($seating as $value) {
                          if($value==1){echo "checked";break;}
                        }}?>>
                        <label for="5_Seats">5 Seats</label>
                      </div>
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="7_Seats" name="seating[]" value="2" <?if(!empty($seating)){foreach ($seating as $value) {
                          if($value==2){echo "checked";break;}
                        }}?>>
                        <label for="7_Seats">7 Seats</label>
                      </div>
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="9_Seatss" name="seating[]" value="3" <?if(!empty($seating)){foreach ($seating as $value) {
                          if($value==3){echo "checked";break;}
                        }}?>>
                        <label for="9_Seatss">9 Seats</label>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?if(!empty($car_data)){?>
      <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
        <div class="x_carbooking_right_section_wrapper float_left">
          <div class="row mt-2">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <!-- <div class="float-left mt-3 col-md-6 col-12 mobilejustify">
                <h5>Car Rental In: &nbsp; <span style="font-size: 20px;color: black;margin-top: -5px;" >Jaipur</span></h5>
              </div> -->
                <?$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                // echo $actual_link;die();
                ?>
              <div class="x_carbook_right_select_box_wrapper float-right desktopsortbydiv"> <span style="font-size: 17px;color: #494848;font-weight: bold;">Sort By Price: &nbsp;</span>
                <select class="myselect" name="filter" id="sort_by">
                  <option>None</option>
                  <option value="asc">Price: Low To High</option>
                  <option value="desc">Price: High To Low</option>
                </select>
              </div>
            </div>
            <!--============================== All Cars ==============================-->
            <div class="col-md-12">
              <div class="x_car_book_tabs_content_main_wrapper">
                <div class="row">
                  <?php $i=1;foreach($car_data as $cars) {?>
                  <!-- Car-1 -->
                  <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="x_car_offer_main_boxes_wrapper float_left">
                      <div class="x_car_offer_starts text-center">
                        <h4 class="mb-2"><b><?=$cars['car_name']?></b></h4>
                        <h5><?=$cars['brand_name']?></h5>
                      </div>
                      <div class="x_car_offer_img float_left">
                        <img src="<?=base_url().$cars['photo']?>" alt="<?=$cars['car_name']?>">
                      </div>
                      <div class="x_car_offer_heading float_left">
                        <ul class=" car_menual_lists">
                          <li> <span><img src="<?=base_url()?>assets/frontend/images/gear-shift.png" alt="Gear" class="img-fluid"/></span><span><?=$cars['transmission']?></span>
                          </li>
                          <li> <span><img src="<?=base_url()?>assets/frontend/images/gas.png" alt="Gas" class="img-fluid"/></span> <span><?=$cars['fuel_type']?></span>
                          </li>
                          <li><img src="<?=base_url()?>assets/frontend/images/seat.png" alt="seat" class="img-fluid"/></span> <span><?=$cars['seating']?></span>
                          </li>
                        </ul>
                      </div>
                      <div class="x_offer_tabs_wrapper">
                        <ul class="nav nav-tabs All_Car_tabs w-100 mt-3" style="display: inline-flex; flex-wrap: nowrap;">
                          <li class="nav-item" onclick="planChange(<?=$i?>,1)"> <a class="nav-link active" data-toggle="tab" href="#first" id="km1_<?=$i?>"> ₹ <?=round($cars['price1'])?> <br><span style="font-size:10px"><?=round($cars['kilometer1'])?> Kms</span></a>
                          </li>
                          <li class="nav-item" onclick="planChange(<?=$i?>,2)"> <a class="nav-link " data-toggle="tab" href="#second" id="km2_<?=$i?>"> ₹ <?=round($cars['price2'])?> <br><span style="font-size:10px"><?=round($cars['kilometer2'])?> Kms</span>
                            </a>
                          </li>
                          <li class="nav-item" onclick="planChange(<?=$i?>,3)"> <a class="nav-link" data-toggle="tab" href="#third" id="km3_<?=$i?>"> ₹ <?=round($cars['price3'])?> <br> <span style="font-size:10px"><?=round($cars['kilometer3'])?> Kms</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                      <div class="x_car_offer_bottom_btn">
                        <ul>
                          <div class="row">
                            <div class="col-md-8 col-8 p-0 mt-2">
                              Extra charge @ <?=$cars['extra_kilo']?>/Kms
                            </div>
                            <div class="col-md-4 col-4 p-0">
                              <?if(!empty($this->session->userdata('user_data'))){?>
                              <form method="post" enctype="multipart/form-data" action="<?=base_url()?>Home/self_drive_calculate">
                              <input type="hidden" name="start_date" value="<?=$search[0]->start_date?>">
                              <input type="hidden" name="start_time" value="<?=$search[0]->start_time?>">
                              <input type="hidden" name="end_date" value="<?=$search[0]->end_date?>">
                              <input type="hidden" name="end_time" value="<?=$search[0]->end_time?>">
                              <input type="hidden" name="duration" value="<?=$search[0]->duration?>">
                              <input type="hidden" name="city_id" value="<?=$cars['city_id']?>">
                              <input type="hidden" name="car_id" value="<?=$cars['car_id']?>">
                              <input type="hidden" name="type_id" id="ct_<?=$i?>" value="1">
                              <input type="hidden" name="search_id" id="search_id" value="<?=$id?>">
                              <button class="bookbtn shadowbtn">Book
                              &nbsp; <i class="fa fa-angle-double-right"></i></button>
                            </form>
                            <?}else{?>
                            <button class="bookbtn shadowbtn" data-toggle="modal" data-target="#loginModal">Book
                            &nbsp; <i class="fa fa-angle-double-right"></i></button>
                              <?}?>
                            </div>
                          </div>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <?php $i++; } ?>
                  <!-- Car-1 End-->
                  <!-- <div class="col-md-12">
											<div class="pager_wrapper prs_blog_pagi_wrapper">
												<ul class="pagination">
													<li><a href="#"><i class="flaticon-left-arrow"></i></a>
													</li>
													<li class="btc_shop_pagi"><a href="#">01</a>
													</li>
													<li class="btc_shop_pagi"><a href="#">02</a>
													</li>
													<li class="btc_third_pegi btc_shop_pagi"><a href="#">03</a>
													</li>
													<li class="btc_four_pegi"><a href="#">...</a>
													</li>
													<li><a href="#"><i class="flaticon-right-arrow"></i></a>
													</li>
												</ul>
											</div>
										</div>
										<div class="col-md-12">
											<div class="pager_wrapper prs_blog_pagi_wrapper">
												<?
                        // =$links?>
											</div>
										</div>
									</div> -->
                  <!-- </div>
									</div> -->
                </div>
              </div>
              <!--============================== All Cars End ==============================-->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ======================================  Mobile Sort by & Filters Start   ====================================== -->
    <div class="container-fluid pl-0" style="position: fixed;bottom: 0; background-color: #fff;z-index: 110000;">
      <div class="row text-center mobiledown">
        <div class="col-6 p-3">
          <a href="#"  data-toggle="modal" data-target="#sortbyModal" id="sbymodal"> <img src="<?=base_url()?>assets/frontend/images/sortbyimg.png" alt="sortbyimg"> Sort By</a>
        </div>
        <div class="col-6  p-3">
          <a href="#" data-toggle="modal" data-target="#filterbyModal" id="fbymodal"> <img src="<?=base_url()?>assets/frontend/images/filterimg.png" alt=""> Filters</a>
        </div>
      </div>
    </div>
    <?}else{?>
<div class="col-lg-8 col-md-12 p-3 mt-5 text-center" style="align-self:center">
  <h4>No Car Available! </h4>
</div>
      <?}?>
    <!-- ======================================  Mobile Sort by & Filters End   ====================================== -->
  </div>
  <script>
  $(".myselect").change(function(){
alert("The text has been changed.");
});
  </script>
  <!-- x car book sidebar section Wrapper End -->
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
