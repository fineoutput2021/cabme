<style>
  .nav-tabs .nav-item h4 {
    color: #fff;
    font-size: 16px;
  }

  .nav-tabs .nav-item .nav-link {
    color: #fff;
    font-size: 12px;
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
              <li>My Profile</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- btc tittle Wrapper End -->

<!--==================================== Content =============================-->
<?$name =$user_data[0]->f_name." ".$user_data[0]->l_name?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      <div class="content_tabs mt-4 mb-4">
        <div class="row">
          <div class="x_offer_tabs_wrapper profiletab" style="background-color: #fff;width: 93%;margin-left: 12px;">
            <ul class="nav nav-tabs" style="background-color:#4d4d4d;border-radius: 10px">
              <li class="nav-item mb-3 pt-3">
                <h4>Hi, <?=$name?></h4>
              </li>
              <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" id="profile_tab">
                  <i class="fa fa-user"></i> &nbsp; My Profile </a>
              </li>
              <li class="nav-item desktoplist"> <a class="nav-link " data-toggle="tab" href="#booking" id="booking_tab">
                  <i class="fa fa-car"></i> My Booking
                </a>
              </li>
              <li class="nav-item mobilelist"> <a class="nav-link " data-toggle="tab" href="#booking_2 " id="booking_tab2">
                  <i class="fa fa-car"></i> My Booking
                </a>
              </li>
              <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="<?=base_url()?>User/logout">
                  <i class="fa fa-power-off"></i> &nbsp; Log Out
                </a>
              </li>
            </ul>
          </div>

        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="tab-content mt-3 mb-3">
        <!-- first Form Tab -->

        <div id="profile" class="tab-pane active" style="padding: 20px;border-radius: 10px;background-color: #fff;box-shadow: 0px 0 8px rgb(0 0 0 / 10%);">
          <form class="profileform">
            <div class="row">
              <div class="col-md-6 mt-2 mb-2">
                <div class="form-group mb-4">
                  <label>Name</label>
                  <input type="text" class="form-control modalinput" required="" placeholder="Name *" value="<?=$name?>">
                </div>
              </div>
              <div class="col-md-6 mt-2 mb-2">
                <label>Email Id</label>
                <div class="form-group">
                  <input type="text" class="form-control modalinput" required="" placeholder="Email Id *" value="<?=$user_data[0]->email?>">
                </div>
              </div>
              <div class="col-md-6 mt-2 mb-2">
                <label>Phone Number</label>
                <div class="form-group">
                  <input type="text" class="form-control modalinput" required="" placeholder="Phone Number *" readonly value="<?=$user_data[0]->phone?>">
                </div>
              </div>
              <div class="col-md-6 mt-2 mb-2">
                <div class="form-sec-header">
                  <p>Date of birth</p>
                  <label class="cal-icon">
                    <input type="date" placeholder="Tue 16 Jan 2018" value="<?=$user_data[0]->dob?>" class="form-control " style="border: none;border-bottom: 1px solid rgb(226, 223, 223);border-radius: 0px;">
                  </label>
                </div>
              </div>
              <div class="col-md-6 mt-2 mb-2">
                <label>Aadhar Card</label>
                <div class="form-group">
                  <input type="text" class="form-control modalinput" required="" placeholder="165516156515655 *" value="<?=$user_data[0]->aadhar_no?>">
                </div>
              </div>
              <div class="col-md-6 mt-2 mb-2">
                <label>Driving Licence Number</label>
                <div class="form-group">
                  <input type="text" class="form-control modalinput" required="" placeholder="1254546564564556*" value="<?=$user_data[0]->driving_lience?>">
                </div>
              </div>
            </div>
            <div class="row justify-content-center">
              <button class="btn col-md-3 col-xs-2 searchbtn">Update</button>
            </div>
          </form>
        </div>
        <!-- ================ MOBILE BOOKING ========== -->
        <div id="booking_2" class="tab-pane">
          <?php $i=1; foreach($booking_data as $booking) {?>
          <div class="profiletable mt-4">
            <div class="row justify-content-between px-3">
              <ul style="line-height: 30px;">
                <li><b>Booking ID</b></li>
                <li><b>Booking Type</b></li>
                <li><b>Booking Amount</b></li>
                <li><b>Status</b></li>
                <li><b>Details</b></li>
                  <?if(!empty($booking->invoice_image)){?>
                <li><b>Invoice</b></li>
                <?}?>
              </ul>
              <ul  style="line-height: 30px;">
                <li>#<?=$booking->id?></li>
                <li>
                  <?if($booking->booking_type==1){echo'Self Drive';}else if($booking->booking_type==2){echo'Inertcity';}else if($booking->booking_type==3){echo'Outstation';}?>
                </li>
                <li>???<?=$booking->final_amount?></li>
                <li>
                  <?if($booking->order_status==1){?>
                  <span class="activespan bg-warning" style="color:white;padding: 6px;border-radius: 15px;">Pending</span>
                  <?}else if($booking->order_status==2){?>
                  <span class="activespan bg-info" style="color:white;padding: 6px;border-radius: 15px;">Accepted</span>
                  <?}else if($booking->order_status==3){?>
                  <span class="activespan bg-success" style="color:white;padding: 6px;border-radius: 15px;">Completed</span>
                  <?}else{?>
                  <span class="activespan bg-danger" style="color:white;padding: 6px;border-radius: 15px;">Rejected</span>
                  <?}?>
                </li>
                <li>
                  <?if($booking->booking_type==1){?>
                  <!-- //-selfdrive -->
                  <a href="<?=base_url()?>Home/self_booking_details/<?=base64_encode($booking->id)?>">View</a>
                  <?}else if($booking->booking_type==2){?>
                  <!-- //-intercity -->
                  <a href="<?=base_url()?>Home/intercity_booking_details/<?=base64_encode($booking->id)?>">View</a>
                  <?}else if($booking->booking_type==3){?>
                  <!-- //-oustation -->
                  <a href="<?=base_url()?>Home/outstation_booking_details/<?=base64_encode($booking->id)?>">View</a>
                  <?}?>
                </li>
                  <?if(!empty($booking->invoice_image)){?><li><a download="Order_<?=$booking->id?>_Invoice.png" href="<?=base_url().$booking->invoice_image?>" title="invoice">Download</a>
                </li>
                <?}?>
              </ul>
            </div>
          </div>
          <?php $i++; } ?>
        </div>
        <!-- ================ WEB BOOKING ========== -->
        <div id="booking" class="tab-pane">
          <table class="profiletable">
            <thead>
              <tr class="tr1">
                <th>Booking ID</th>
                <th>Booking Type</th>
                <th>Booking Amount</th>
                <th>Status</th>
                <th>Details</th>
                <th>Invoice</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; foreach($booking_data as $booking) {?>
              <tr>
                <td>#<?=$booking->id?></td>
                <td>
                  <?if($booking->booking_type==1){echo'Self Drive';}else if($booking->booking_type==2){echo'Inertcity';}else if($booking->booking_type==3){echo'Outstation';}?>
                </td>
                <td>???<?=$booking->final_amount?></td>
                <td>
                  <?if($booking->order_status==1){?>
                  <span class="activespan bg-warning">Pending</span>
                  <?}else if($booking->order_status==2){?>
                  <span class="activespan bg-info">Accepted</span>
                  <?}else if($booking->order_status==3){?>
                  <span class="activespan bg-success">Completed</span>
                  <?}else{?>
                  <span class="activespan bg-danger">Rejected</span>
                  <?}?>
                </td>
                <td>
                  <?if($booking->booking_type==1){?>
                  <!-- //-selfdrive -->
                  <a href="<?=base_url()?>Home/self_booking_details/<?=base64_encode($booking->id)?>">View</a>
                  <?}else if($booking->booking_type==2){?>
                  <!-- //-intercity -->
                  <a href="<?=base_url()?>Home/intercity_booking_details/<?=base64_encode($booking->id)?>">View</a>
                  <?}else if($booking->booking_type==3){?>
                  <!-- //-oustation -->
                  <a href="<?=base_url()?>Home/outstation_booking_details/<?=base64_encode($booking->id)?>">View</a>
                  <?}?>
                </td>
                <td>
                  <?if(!empty($booking->invoice_image)){?><a download="Order_<?=$booking->id?>_Invoice.png" href="<?=base_url().$booking->invoice_image?>" title="invoice">Download</a>
                  <?}?>
                </td>
              </tr>
              <?php $i++; } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>




<!--==================================== Content End=============================-->




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
<script type="text/javascript">
  $(window).on('load', function() {
    var pageURL = $(location).attr("href");
    if (pageURL.includes('booking')) {
      if (window.matchMedia('(max-width: 767px)').matches) {
        $('#profile_tab').removeClass('active');
        $('#booking_tab2').addClass('active');
        $('#profile').removeClass('active show');
        $('#booking_2').addClass('active show');
      } else {
        $('#profile_tab').removeClass('active');
        $('#booking_tab').addClass('active');
        $('#profile').removeClass('active show');
        $('#booking').addClass('active show');
      }


    }
  });
</script>
