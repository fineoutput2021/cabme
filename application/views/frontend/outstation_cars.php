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
<div class="btc_tittle_main_wrapper" style="margin-top: 100px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 full_width">
        <div class="btc_tittle_right_heading">
          <div class="btc_tittle_right_cont_wrapper">
            <ul>
              <li><a href="<?=base_url()?>">Home</a> <i class="fa fa-angle-right"></i>
              </li>
              <li>Outstatin Cars</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- btc tittle Wrapper End -->
<!-- x car book sidebar section Wrapper Start -->
<div class="x_car_book_sider_main_Wrapper float_left mt-4">
  <div class="container-fluid">
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
                      <li>Outstation Cars</li>
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
                <div class="row">
                  <div class="col-md-6">
                    <h3 style="margin-top: 5px;">Filters</h3>
                  </div>
                  <div class="col-md-6">
                    <a href="#" style="color: red;float: right;">Reset
                      All</a>
                  </div>
                </div>
                <hr>
                <!-- Segment -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h5 class="panel-title"> <a data-toggle="collapse" href="#collapseOne" class="collapse"> Segment</a> </h5>
                  </div>
                  <div id="collapseOne" class="collapse show">
                    <div class="panel-body">
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="c3" name="cb" class="clearcheckbox">
                        <label for="c3">Hatchback</label>
                      </div>
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="c4" name="cb">
                        <label for="c4">Sedan</label>
                      </div>
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="c5" name="cb">
                        <label for="c5">SUV</label>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <!-- Segment End -->
                <!-- Brand -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h5 class="panel-title"> <a data-toggle="collapse" href="#collapseTwo" class="collapse">Brand</a> </h5>
                  </div>
                  <div id="collapseTwo" class="collapse ">
                    <div class="panel-body">
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="brand_1" name="cb">
                        <label for="brand_1">Hyundai</label>
                      </div>
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="brand_2" name="cb">
                        <label for="brand_2">Maruti</label>
                      </div>
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="brand_3" name="cb">
                        <label for="brand_3">Mahindra</label>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <!-- Brand End -->
                <!-- Seating Capacity -->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h5 class="panel-title"> <a data-toggle="collapse" href="#collapseFive" class="collapse"> Seating Capacity</a> </h5>
                  </div>
                  <div id="collapseFive" class="collapse ">
                    <div class="panel-body">
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="5_Seats" name="cb">
                        <label for="5_Seats">5 Seats</label>
                      </div>
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="7_Seats" name="cb">
                        <label for="7_Seats">7 Seats</label>
                      </div>
                      <div class="x_slider_checkbox x_slider_checkbox_bottom_filter_use">
                        <input type="checkbox" id="9_Seatss" name="cb">
                        <label for="9_Seatss">9 Seats</label>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 col-12">
        <div class="x_carbooking_right_section_wrapper float_left">
          <div class="row mt-2">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="x_carbook_right_select_box_wrapper float-right desktopsortbydiv"> <span style="font-size: 17px;color: #494848;font-weight: bold;">Sort By: &nbsp;</span>
                <select class="myselect">
                  <option>Popularity</option>
                  <option>Price: Low To High</option>
                  <option>Price: High To Low</option>
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
                        <ul class=" car_menual_lists" style="border:none;">
                          <li style="border:none;"> </li>
                          <li  style="border:none;"> <span>💺</span> <span><?=$cars['seating']?></span>
                          </li>
                          <li style="border:none;"> </li>
                        </ul>
                      </div>
                      <div class="x_offer_tabs_wrapper">
                        <h5>Rate Per Kilometer @ ₹<?=$cars['per_kilometer']?></h5>
                      </div>
                      <div class="x_car_offer_bottom_btn">
                        <ul>
                          <div class="row">
                            <div class="col-md-8 col-8 p-0 mt-2">
                              Current Location:   <b><?=$cars['location']?></b>
                            </div>
                            <div class="col-md-4 col-4 p-0">
                              <?if(!empty($this->session->userdata('user_data'))){?>
                              <form method="post" enctype="multipart/form-data" action="<?=base_url()?>Home/outstation_calculate">
                              <input type="hidden" name="start_date" value="<?=$search[0]->start_date?>">
                              <input type="hidden" name="start_time" value="<?=$search[0]->start_time?>">
                              <input type="hidden" name="end_date" value="<?=$search[0]->end_date?>">
                              <input type="hidden" name="end_time" value="<?=$search[0]->end_time?>">
                              <input type="hidden" name="duration" value="<?=$search[0]->duration?>">
                              <input type="hidden" name="round_type" value="<?=$search[0]->round_type?>">
                              <input type="hidden" name="city_id" value="<?=$cars['city_id']?>">
                              <input type="hidden" name="car_id" value="<?=$cars['car_id']?>">
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
                </div>
              </div>
              <!--============================== All Cars End ==============================-->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ======================================  Mobile Sort by & Filters Start   ====================================== -->
    <div class="container-fluid" style="position: fixed;bottom: 0; background-color: #fff;z-index: 110000;">
      <div class="row text-center mobiledown">
        <div class="col-6 p-3">
          <a href="#" data-toggle="modal" data-target="#sortbyModal" id="sbymodal"> <img src="<?=base_url()?>assets/frontend/images/sortbyimg.png" alt="sortbyimg"> Sort By</a>
        </div>
        <div class="col-6  p-3">
          <a href="#" data-toggle="modal" data-target="#filterbyModal" id="fbymodal"> <img src="<?=base_url()?>assets/frontend/images/filterimg.png" alt=""> Filters</a>
        </div>
      </div>
    </div>
    <!-- ======================================  Mobile Sort by & Filters End   ====================================== -->
  </div>
  <!-- x car book sidebar section Wrapper End -->
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