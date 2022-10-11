<!--========================================== START SECTION BREADCRUMB ============================================-->
<div class="breadcrumb_section  page-title-mini">
  <div class="container-fluid">
    <div class="row align-items-center px-4 roxy">
      <div class="col-md-6">
        <div class="page-title">
          <h1>Track Order</h1>
        </div>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb justify-content-md-end">
          <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=base_url()?>Home/my_profile/order">My Orders</a></li>
          <li class="breadcrumb-item active">Track Order</li>
        </ol>
      </div>
    </div>
  </div><!-- END CONTAINER-->
</div>
<!-- ========================================== END SECTION BREADCRUMB ====================================================-->

<div class="rightarrow"></div>
<?
if (!empty($track_data)) {
  $track_activity = $track_data->shipment_track_activities;
  $expected_date = $track_data->etd;
} else {
  $track_activity = [];
  $expected_date = '10-12-22';
}
?>

<div class="container" style="margin-top:40px;">
  <div class="row">
    <div class="col-md-7">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
          <div id="tracking-pre"></div>
          <div id="tracking" style="box-shadow:0px 0px 20px #e7e2e2;border-radius:15px;">
            <div class="tracking-list">
              <div class="tracking-item">
                <div class="tracking-icon status-intransit">
              <i class="rightarrow"></i> 
                  <svg class="svg-inline--fa fa-circle fa-w-16 " aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                    <path  fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                  </svg>
                </div> 
                <div class="tracking-date"><b><?= $order1_data[0]->date ?></b></div>
                <div class="tracking-content">Order Placed<span><?= $order1_data[0]->date ?></span></div>
              </div>
              <?php
              $i = 1;
              foreach ($track_activity as $track) { ?>
                <div class="tracking-item">
                  <div class="tracking-icon status-intransit">
                    <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                      <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                    </svg>
                  </div>
                  <div class="tracking-date"><?= $track->date ?></div>
                  <div class="tracking-contents">Activity :<span><?= $track->activity ?></span></div>
                  <div class="tracking-contents">Location :<span><?= $track->location ?></span></div>
                </div>
              <?
              } ?>
              <div class="tracking-item-pending">
                <div class="tracking-icon status-intransit">
                  <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                    <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                  </svg>
                </div>
                <div class="tracking-date"><img src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg" class="img-responsive" alt="order-placed" /></div>
                <div class="tracking-content">Expected Delivery<span><?= $expected_date ?></span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-md-5">
      <div class="boxxxx">
        <h5 style="border-bottom: 1px solid #CFD4D6;padding: 10px 0px;margin-left:10px">
          <img src="<?=base_url()?>assets\frontend\images\box.png" alt="">
         &nbsp; Order Details
        </h5>
         <div class="d-flex">
        <h5 class="managewidth">Order ID : </h5> <span> <?= $order1_data[0]->id ?></span>
        </div>
        <?if(!empty($order1_data[0]->courier_name)){
          ?>
         <div class="d-flex">
        <h5 class="managewidth">Courier Name : </h5> <span> <?=$order1_data[0]->courier_name ?></span>
        </div>
         <div class="d-flex">
        <h5 class="managewidth">Tracking id : </h5> <span> <?= $order1_data[0]->awb_code ?></span>
        </div>
        <?}?>
      </div>
    </div>
  </div>
</div>
<!-- <div class="container py-5">
  <?
  if (!empty($track_data)) {
    $track_activity = $track_data->shipment_track_activities;
    $expected_date = $track_data->etd;
  } else {
    $track_activity = [];
    $expected_date = '10-12-22';
  }
  ?>
  <div>
    <h4>Order ID : <?= $order1_data[0]->id ?></h4>
    <h4>Order ID : <?= $order1_data[0]->id ?></h4>
  </div>
  <div class="row">
    <div class="col-md-12 col-lg-12 col-12">
      <div id="tracking-pre"></div>
      <div id="tracking">
        <div class="tracking-list">
          <div class="tracking-item">
            <div class="tracking-icon status-intransit">
              <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
              </svg>
            </div>
            <div class="tracking-date"><b><?= $order1_data[0]->date ?></b></div>
            <div class="tracking-content">Order Placed<span><?= $order1_data[0]->date ?></span></div>
          </div>
          <?php
          $i = 1;
          foreach ($track_activity as $track) { ?>
            <div class="tracking-item">
              <div class="tracking-icon status-intransit">
                <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                  <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                </svg>
              </div>
              <div class="tracking-date"><?= $track->date ?></div>
              <div class="tracking-contents">Activity :<span><?= $track->activity ?></span></div>
              <div class="tracking-contents">Location :<span><?= $track->location ?></span></div>
            </div>
          <?
          } ?>
          <div class="tracking-item-pending">
            <div class="tracking-icon status-intransit">
              <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
              </svg>
            </div>
            <div class="tracking-date"><img src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg" class="img-responsive" alt="order-placed" /></div>
            <div class="tracking-content">Expected Delivery<span><?= $expected_date ?></span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->