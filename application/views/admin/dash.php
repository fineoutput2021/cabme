      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
          </h1>
          <ol class="breadcrumb">
            <li class="active">Dashboard</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="<?=base_url()?>dcadmin/Employee/view_employee">
                <div class="info-box">
                  <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Booking</span>
                    <span class="info-box-number">
                    <?=$total_booking?>
                    </span>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="<?=base_url()?>dcadmin/Farmer_details/view_details">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Self Drive</span>
                    <span class="info-box-number">
                  <?=$total_self_drive?>
                    </span>
                  </div>
                </div>
              </a>
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="<?=base_url()?>dcadmin/Orders/view_orders">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total INTERCITY</span>
                    <span class="info-box-number">
                      <?=$total_intercity?>
                    </span>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="<?=base_url()?>dcadmin/Products/view_products">
                <div class="info-box">
                  <span class="info-box-icon bg-red"><i class="ion ion-ios-pricetags-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Total Outstation</span>
                    <span class="info-box-number">
              <?=$total_outstation?>
                    </span>
                  </div><!-- /.info-box-content -->
                </div>
              </a><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      </div><!-- ./wrapper -->
