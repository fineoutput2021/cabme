
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard 
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <!-- <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li> -->
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">

              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-truck" aria-hidden="true"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Orders</span>
                  <span class="info-box-number"><?            $this->db->select('*');
                  $this->db->from('tbl_order1');
                  $this->db->where('payment_status', 1);
                  $order= $this->db->count_all_results(); echo $order;?></span>
                </div><!-- /.info-box-content -->
              </div></a><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
  <? if ($this->load->get_var('position')=="Super Admin") {?>
              <a href="<?=base_url()?>dcadmin/order/view_order">
                <?}else{?>
                  <a href="javascript:void(0);">
                  <?}?>
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-truck" aria-hidden="true"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">New Orders</span>
                  <span class="info-box-number"><?              $this->db->select('*');
                  $this->db->from('tbl_order1');
                  $this->db->where('order_status',1);
                  $order1= $this->db->count_all_results(); echo $order1;?>
                  </span>
                </div><!-- /.info-box-content -->
              </div></a><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <!-- <? if ($this->load->get_var('position')=="Super Admin") {?>
              <a href="<?=base_url()?>dcadmin/Product/view_category">
                <?}else{?>
                  <a href="javascript:void(0);">
                  <?}?> -->
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-truck" aria-hidden="true"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Today Orders</span>
                  <span class="info-box-number"><?            $this->db->select('*');
                  $this->db->from('tbl_product');
                  //$this->db->where('id',$usr);
                  $product= $this->db->count_all_results(); echo $product;?></span>
                </div><!-- /.info-box-content -->
              </div></a><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <? if ($this->load->get_var('position')=="Super Admin") {?>
              <a href="<?=base_url()?>dcadmin/Model/view_model">
                <?}else{?>
                  <a href="javascript:void(0);">
                  <?}?>
              <div class="info-box">
                <span class="info-box-icon bg-purple"><i class="fa fa-users" aria-hidden="true"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Model</span>
                  <span class="info-box-number"><?                 $this->db->select('*');
                  $this->db->from('tbl_users');
                  //$this->db->where('id',$usr);
                  $model= $this->db->count_all_results(); echo $model;?>
                  </span>
                </div><!-- /.info-box-content -->
              </div></a><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <!-- <? if ($this->load->get_var('position')=="Super Admin") {?>
              <a href="<?=base_url()?>dcadmin/contact_us/view_contact_us">
                <?}else{?>
                  <a href="javascript:void(0);">
                  <?}?> -->
              <div class="info-box">
                <span class="info-box-icon bg-cyan"><i class="fa fa-cubes" aria-hidden="true"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Out Of Stock Products</span>
                  <span class="info-box-number"><?                 $this->db->select('*');
                  $this->db->from('tbl_contact_us');
                  //$this->db->where('id',$usr);
                  $contact= $this->db->count_all_results(); echo $contact;?>
                  </span>
                </div><!-- /.info-box-content -->
              </div></a><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <? if ($this->load->get_var('position')=="Super Admin") {?>
              <a href="<?=base_url()?>dcadmin/users/view_users">
                <?}else{?>
                  <a href="javascript:void(0);">
                  <?}?>
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Users</span>
                  <span class="info-box-number"><?             $this->db->select('*');
                  $this->db->from('tbl_users');
                  //$this->db->where('id',$usr);
                  $users= $this->db->count_all_results(); echo $users;?>
                  </span>
                </div><!-- /.info-box-content -->
              </div></a><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


    </div><!-- ./wrapper -->
