<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
  <div class="container">
    <!-- STRART CONTAINER -->
    <div class="row align-items-center">

      <div class="col-md-12">
        <ol class="breadcrumb justify-content-md-start">
          <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
          <li class="breadcrumb-item active">My Account</li>
        </ol>
      </div>
    </div>
  </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->
<style>
  @media (max-width: 991px) {
    .desktopsection {
      display: none;
    }
  }

  a.active {
    color: white !important;
  }

  @media (min-width: 991px) {
    .mobilesection {
      display: none;
    }
  }
</style>
<!-- START MAIN CONTENT -->
<div class="main_content">

  <!-- START DESKTOP SECTION SHOP -->
  <div class="section desktopsection">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-2 col-md-4" style="padding-right:0px;">
          <div class="dashboard_menu">
            <ul class="nav nav-tabs flex-column" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="ti-layout-grid2"></i>Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="ti-shopping-cart-full"></i>Orders</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="account-detail-tab" data-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="ti-id-badge"></i>Account details</a>
              </li>
              <? if($this->session->userdata('user_type')==1){
              if ($user_data[0]->is_model==1) {?>
              <li class="nav-item">
                <a class="nav-link" id="account-detail-tab" data-toggle="tab" href="#modalproduct" role="tab" aria-controls="account-detail" aria-selected="true"><i class="linearicons-user"></i>Model Product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="address-tab" data-toggle="tab" href="#pointstransaction" role="tab" aria-controls="address" aria-selected="true"><i class="ti-id-badge"></i>Points Redeem Requests</a>
              </li>
              <?}
            }?>
              <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>User/logout"><i class="ti-lock"></i>Logout</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-10 col-md-8" style="padding:0px 0px 1.25rem;">
          <div class="tab-content dashboard_content">
            <div class="tab-pane fade active show " id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
              <div class="card">
                <div class="card-header">
                  <h3>Dashboard</h3>
                </div>
                <div class="card-body">
                  <p>From your account dashboard. you can easily check &amp; view your recent orders.</p>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
              <div class="card">
                <div class="card-header">
                  <h3>Orders</h3>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr class="text-center" style="vertical-align: top;">
                          <th>Order Id</th>
                          <th style="vertical-align:middle;">Date</th>
                          <th>Total Amount</th>
                          <th>Shipping Charge</th>
                          <th>Promocode Discount</th>
                          <th>Final Amount</th>
                          <th>Status</th>
                          <th>Action</th>
                          <th>Track</th>
                          <th>Cancel</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?foreach ($order1_dataa->result() as $orderOne) {?>
                        <tr class="text-center">
                          <td>#<?=$orderOne->id?></td>
                          <td><?=$orderOne->date?></td>
                          <td>₹<?=$orderOne->total_amount?></td>
                          <td><?if(empty($orderOne->shipping)){echo 'Free Shipping';}else{echo '₹'.$orderOne->shipping;}?></td>
                          <td>
                            <?if (!empty($orderOne->promo_discount)) {
    echo $orderOne->promo_discount;
} else {
    echo "N/A";
}?>
                          </td>
                          <td>₹<?=$orderOne->final_amount?></td>
                          <td class="product-stock-status" data-title="Stock Status">
                            <?php if ($orderOne->order_status==1) { ?>
                            <span class="badge badge-pill badge-warning">Placed</span>
                            <?php } elseif ($orderOne->order_status==2) { ?>
                            <span class="badge badge-pill badge-info">Accepted</span>
                            <?php		} elseif ($orderOne->order_status==3) { ?>
                            <span class="badge badge-pill badge-info">Dispatched</span>
                            <?php		} elseif ($orderOne->order_status==4) { ?>
                            <span class="badge badge-pill badge-success">Delivered</span>
                            <?} elseif ($orderOne->order_status==5) { ?>
                            <span class="badge badge-pill badge-danger">Rejected</span>
                            <?php		} if ($orderOne->order_status==6) { ?>
                            <span class="badge badge-pill badge-danger">Cancelled</span>
                            <?}?>
                          </td>
                          <td> <a style="padding:6px 20px;" class="btn btn-fill-out checkout" href="<?=base_url()?>Home/order_details/<?=base64_encode($orderOne->id)?>">View</a></td>
                          <td>
                          <!-- <?if($orderOne->order_status==3){?> -->
                            <a href="<?=base_url()?>Home/track_order/<?=base64_encode($orderOne->id)?>" class="btn btn-fill-out checkout" style="padding:6px 20px;"><i class="linearicons-truck" style="vertical-align:text-top;"></i>Track</a>
                            <!-- <?}?> -->
                          </td>
                          <td>
                            <?if ($orderOne->order_status==1) {?>
                            <a style="padding:6px 20px;" class="btn btn-fill-out checkout" href="<?=base_url()?>Order/cancel_order/<?=base64_encode($orderOne->id)?>">X</a>
                            <?}?>
                          </td>
                        </tr>
                        <?}?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pointstransaction" role="tabpanel" aria-labelledby="orders-tab">
              <div class="card">
                <div class="card-header">
                  <h3>Referral Points Redeem Requests</h3>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr class="text-center" style="vertical-align: top;">
                          <th>Request ID</th>
                          <th>Requested Points</th>
                          <th>Request Date</th>
                          <th>Completion Date</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?foreach($model_points->result() as $modelPo){?>
                        <tr class="text-center">
                          <td>#<?=$modelPo->id?></td>
                          <td><?=$modelPo->req_points?></td>
                          <td><?$newdate = new DateTime($modelPo->date);
                          echo $newdate->format('F j, Y, g:i a');?></td>
                          <td><?$completed = new DateTime($modelPo->completed_date);
                          echo $completed->format('F j, Y, g:i a');?></td>
                          <td class="product-stock-status" data-title="Stock Status">
                            <?if($modelPo->status==0){?>
                            <span class="badge badge-pill badge-warning">Pending</span>
                            <?}elseif($modelPo->status==1){?>
                            <span class="badge badge-pill badge-success">Accepted</span>
                            <?}elseif($modelPo->status=2){?>
                            <span class="badge badge-pill badge-danger">Rejected</span>
                            <?}?>
                          </td>
                        </tr>
                        <?}?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
              <div class="row justify-content-center">
                <div class="card col-lg-8">
                  <div class="card-header">
                    <h3>Account Details</h3>
                  </div>
                  <?if($this->session->userdata('user_type')==1){
                  if ($user_data[0]->is_model==1) {?>
                  <div class="container mt-2">
                    <div class="row">
                      <h5 style="margin-left: 20px;">Referal Code:&nbsp;
                        <!-- <span style="font-size:17px;" >
                        <?=$user_data[0]->reference_code;?>
                      </span> -->
                      <input type="text" style="font-size:17px;" id="myInput" readonly value="<?=$user_data[0]->reference_code;?>"  />
                      &nbsp;&nbsp;<span onclick="myFunction()" style="cursor: pointer" title="Click to copy referral"><i class="bi bi-clipboard"></i></span>
                    </h5>

                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-lg-8">
                      <h5 style="margin-left: 20px;">Total Points: &nbsp;<span style="font-size:17px;"><?=$user_data[0]->total_points;?> Points</span></h5>
                    </div>
                    <div class="col-lg-4"><button type="submit" class="btn btn-fill-out" name="submit" value="Submit" data-target="#onload-popup5" data-toggle="modal" data-dismiss="modal" style="padding:5px 10px;">Redeem Points</button></div>
                  </div>
                  <?}
                }?>
                  <div class="card-body">
                    <!-- <p>Already have an account? <a href="#">Log in instead!</a></p> -->
                    <?if($this->session->userdata('user_type')==2){?>
                    <form method="POST" action="<?=base_url()?>User/update_reseller_profile" enctype="multipart/form-data">
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label>Name <span class="required">*</span></label>
                          <input required="" class="form-control" value="<?=$user_data[0]->name;?>" name="name" type="text">
                        </div>
                        <div class="form-group col-md-6">
                          <label>Email<span class="required">*</span></label>
                          <input required="" class="form-control" value="<?=$user_data[0]->email;?>" name="email">
                        </div>
                        <div class="form-group col-md-6">
                          <label>Phone <span class="required">*</span></label>
                          <input required="" class="form-control" readonly value="<?=$user_data[0]->phone;?>" name="phone" type="text">
                        </div>
                        <div class="form-group col-md-6">
                          <label>Shop<span class="required">*</span></label>
                          <input required="" class="form-control" value="<?=$user_data[0]->shop;?>" name="shop">
                        </div>
                        <div class="form-group col-md-6">
                          <label>GST Number <span class="required"></span></label>
                          <input class="form-control" value="<?=$user_data[0]->gst_number;?>" name="gstin" type="text">
                        </div>
                        <div class="form-group col-md-6">
                          <label>City<span class="required">*</span></label>
                          <input required="" class="form-control" value="<?=$user_data[0]->city;?>" name="city">
                        </div>
                        <div class="form-group col-md-12">
                          <label>Address <span class="required">*</span></label>
                          <input required class="form-control" name="address" value="<?=$user_data[0]->address;?>" type="text">
                        </div>
                        <div class="col-md-12">
                          <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">Save</button>
                        </div>
                      </div>
                    </form>
                    <?}else{?>
                    <form method="POST" action="<?=base_url()?>User/update_profile" enctype="multipart/form-data">
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label>First Name <span class="required">*</span></label>
                          <input required="" class="form-control" value="<?=$user_data[0]->f_name;?>" name="fname" type="text">
                        </div>
                        <div class="form-group col-md-6">
                          <label>Last Name <span class="required">*</span></label>
                          <input required="" class="form-control" value="<?=$user_data[0]->l_name;?>" name="lname">
                        </div>
                        <div class="form-group col-md-12">
                          <label>Phone Number <span class="required">*</span></label>
                          <input required class="form-control" name="phonenumber" readonly value="<?=$user_data[0]->phone;?>" type="text">
                        </div>
                        <div class="col-md-12">
                          <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">Save</button>
                        </div>
                      </div>
                    </form>
                    <?}?>
                  </div>
                </div>
              </div>
            </div>
            <?if($this->session->userdata('user_type')==1){
            if ($user_data[0]->is_model==1) {?>
            <div class="tab-pane fade" id="modalproduct" role="tabpanel" aria-labelledby="orders-tab">
              <div class="card">
                <div class="card-header">
                  <h3>Model Products</h3>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="product-thumbnail">Image</th>
                          <th class="product-name">Product Name</th>
                          <th class="product-price">SKU</th>


                        </tr>
                      </thead>
                      <tbody>
                        <?foreach ($model_table->result() as $model) {
                          $product_data = $this->db->get_where('tbl_product', array('id = ' => $model->product_id, 'is_active'=>1))->result();
                          $type_data = $this->db->get_where('tbl_type', array('product_id = ' => $product_data[0]->id))->result();
                           ?>
                        <tr>
                          <td class="product-thumbnail"><a href="<?=base_url()?>Home/product_detail/<?=$product_data[0]->url?>?type=<?=base64_encode($type_data[0]->id)?>"><img src="<?=base_url().$type_data[0]->image?>" alt="product1"></a></td>
                          <td class="product-name" data-title="Product"><a href="javascript:;"><?=$product_data[0]->name?></a></td>
                          <td class="product-price" data-title="Price"><?=$product_data[0]->sku?></td>
                        </tr>
                        <?
}?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <?}
          }?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END DESKTOP SECTION SHOP -->

  <!-- START MOBILE SECTION SHOP -->
  <div class="section mobilesection">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-4">
          <div class="dashboard_menu">
            <ul class="nav nav-tabs flex-column" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dash" role="tab" aria-controls="dashboard" aria-selected="false"><i class="ti-layout-grid2"></i>Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="orders-tab" data-toggle="tab" href="#order" role="tab" aria-controls="orders" aria-selected="false"><i class="ti-shopping-cart-full"></i>Orders</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="account-detail-tab" data-toggle="tab" href="#account_detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="ti-id-badge"></i>Account details</a>
              </li>
              <? if($this->session->userdata('user_type')==1){
              if ($user_data[0]->is_model==1) {?>
              <li class="nav-item">
                <a class="nav-link" id="modelproduct-detail-tab" data-toggle="tab" href="#mobmodelproduct" role="tab" aria-controls="modelproduct-detail" aria-selected="true"><i class="linearicons-user"></i>Model Product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pointredeem-tab" data-toggle="tab" href="#mobpoint" role="tab" aria-controls="pointredeem" aria-selected="true"><i class="ti-id-badge"></i>Points Redeem Requests</a>
              </li>
              <?}
            }?>
              <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>User/logout"><i class="ti-lock"></i>Logout</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-9 col-md-8" style="padding:0px 0px 1.25rem;">
          <div class="tab-content dashboard_content">
            <div class="tab-pane fade active show" id="dash" role="tabpanel" aria-labelledby="dashboard-tab">
              <div class="card">
                <div class="card-header">
                  <h3>Dashboard</h3>
                </div>
                <div class="card-body">
                  <p>From your account dashboard. you can easily check &amp; view your recent orders, manage your shipping and billing addresses.</p>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="orders-tab">
              <div class="card">
                <div class="card-header">
                  <h3>Orders</h3>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr class="text-center" style="vertical-align: top;">
                          <th>Order Id</th>
                          <th style="vertical-align:middle;">Date</th>
                          <th>Total Amount</th>
                          <th>Shipping Charge</th>
                          <th>Promocode Discount</th>
                          <th>Final</th>
                          <th>Status</th>
                          <th>Action</th>
                          <th>Track</th>
                          <th>Cancel</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?foreach ($order1_dataa->result() as $orderOne) {?>
                        <tr class="text-center">
                          <td>#<?=$orderOne->id?></td>
                          <td><?=$orderOne->date?></td>
                          <td>₹<?=$orderOne->total_amount?></td>
                          <td><?if(empty($orderOne->shipping)){echo 'Free Shipping';}else{echo '₹'.$orderOne->shipping;}?></td>
                          <td>
                            <?if (!empty($orderOne->promo_discount)) {
        echo $orderOne->promo_discount;
    } else {
        echo "N/A";
    }?>
                          </td>
                          <td>₹<?=$orderOne->final_amount?></td>
                          <td class="product-stock-status" data-title="Stock Status">
                            <?php if ($orderOne->order_status==1) { ?>
                            <span class="badge badge-pill badge-warning">Placed</span>
                            <?php } elseif ($orderOne->order_status==2) { ?>
                            <span class="badge badge-pill badge-info">Accepted</span>
                            <?php		} elseif ($orderOne->order_status==3) { ?>
                            <span class="badge badge-pill badge-info">Dispatched</span>
                            <?php		} elseif ($orderOne->order_status==4) { ?>
                            <span class="badge badge-pill badge-success">Delivered</span>
                            <?} elseif ($orderOne->order_status==5) { ?>
                            <span class="badge badge-pill badge-danger">Rejected</span>
                            <?php		} if ($orderOne->order_status==6) { ?>
                            <span class="badge badge-pill badge-danger">Cancelled</span>
                            <?}?>
                          </td>
                          <td> <a style="padding:6px 20px;" class="btn btn-fill-out checkout" href="<?=base_url()?>Home/order_details/<?=base64_encode($orderOne->id)?>">View</a></td>
                          <td>
                            <!-- <a href="#" class="btn btn-fill-out checkout" style="padding:6px 20px;"><i class="linearicons-truck" style="vertical-align:text-top;"></i>Track</a> -->
                          </td>
                          <td>
                            <?if ($orderOne->order_status==1) {?>
                            <a style="padding:6px 20px;" class="btn btn-fill-out checkout" href="<?=base_url()?>Order/cancel_order/<?=base64_encode($orderOne->id)?>">X</a>
                            <?}?>
                          </td>
                        </tr>
                        <?}?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="mobpoint" role="tabpanel" aria-labelledby="orders-tab">
              <div class="card">
                <div class="card-header">
                  <h3>Referral Points Redeem Requests</h3>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr class="text-center" style="vertical-align: top;">
                          <th>Request ID</th>
                          <th>Requested Points</th>
                          <th>Request Date</th>
                          <th>Completion Date</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?foreach($model_points->result() as $modelPo){?>
                        <tr class="text-center">
                          <td>#<?=$modelPo->id?></td>
                          <td><?=$modelPo->req_points?></td>
                          <td><?$newdate = new DateTime($modelPo->date);
                          echo $newdate->format('F j, Y, g:i a');?></td>
                          <td><?$completed = new DateTime($modelPo->completed_date);
                          echo $completed->format('F j, Y, g:i a');?></td>
                          <td class="product-stock-status" data-title="Stock Status">
                            <?if($modelPo->status==0){?>
                            <span class="badge badge-pill badge-warning">Pending</span>
                            <?}elseif($modelPo->status==1){?>
                            <span class="badge badge-pill badge-success">Accepted</span>
                            <?}elseif($modelPo->status=2){?>
                            <span class="badge badge-pill badge-danger">Rejected</span>
                            <?}?>
                          </td>
                        </tr>
                        <?}?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <?if($this->session->userdata('user_type')==1){
            if ($user_data[0]->is_model==1) {?>
            <div class="tab-pane fade" id="mobmodelproduct" role="tabpanel" aria-labelledby="orders-tab">
              <div class="card">
                <div class="card-header">
                  <h3>Model Products</h3>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="product-thumbnail">Image</th>
                          <th class="product-name">Product Name</th>
                          <th class="product-price">SKU</th>


                        </tr>
                      </thead>
                      <tbody>
                        <?foreach ($model_table->result() as $model) {
    $product_data = $this->db->get_where('tbl_product', array('id = ' => $model->product_id, 'is_active'=>1))->result(); ?>
                        <tr>
                          <td class="product-thumbnail"><a href="<?=base_url()?>Home/product_detail/<?=$product_data[0]->url?>"><img src="<?=base_url().$product_data[0]->image1?>" alt="product1"></a></td>
                          <td class="product-name" data-title="Product"><a href="shop-product-detail%20(1).html"><?=$product_data[0]->name?></a></td>
                          <td class="product-price" data-title="Price"><?=$product_data[0]->sku?></td>
                        </tr>
                        <?
}?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <?}
          }?>
            <div class="tab-pane fade" id="account_detail" role="tabpanel" aria-labelledby="account-detail-tab">
              <div class="card">
                <div class="card-header">
                  <h3>Account Details</h3>
                </div>
                <div class="container mt-2">
                  <div class="row">
                    <h5 style="margin-left: 20px;">Referal Code:&nbsp;
                      <!-- <span style="font-size:17px;"><?=$user_data[0]->reference_code;?></span> -->
                      <input type="text" style="font-size:17px;" id="myInput" readonly value="<?=$user_data[0]->reference_code;?>"  />
                      &nbsp;&nbsp;<span onclick="myFunction()" style="cursor: pointer" title="Click to copy referral"><i class="bi bi-clipboard"></i></span>
                    </h5>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-8">
                    <h5 style="margin-left: 20px;">Total Points: &nbsp;<span style="font-size:17px;"><?=$user_data[0]->total_points;?> Points</span></h5>
                  </div>
                  <div class="col-lg-4 text-center"><button type="submit" class="btn btn-fill-out" name="submit" value="Submit" data-target="#onload-popup5" data-toggle="modal" data-dismiss="modal" style="padding:5px 10px;">Redeem Points</button></div>
                </div>
                <div class="card-body">

                  <!-- <p>Already have an account? <a href="#">Log in instead!</a></p> -->
                  <?if($this->session->userdata('user_type')==2){?>
                    <form method="POST" action="<?=base_url()?>User/update_reseller_profile" enctype="multipart/form-data">
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label>Name <span class="required">*</span></label>
                          <input required="" class="form-control" value="<?=$user_data[0]->name;?>" name="name" type="text">
                        </div>
                        <div class="form-group col-md-6">
                          <label>Email<span class="required">*</span></label>
                          <input required="" class="form-control" value="<?=$user_data[0]->email;?>" name="email">
                        </div>
                        <div class="form-group col-md-6">
                          <label>Phone <span class="required">*</span></label>
                          <input required="" class="form-control" readonly value="<?=$user_data[0]->phone;?>" name="phone" type="text">
                        </div>
                        <div class="form-group col-md-6">
                          <label>Shop<span class="required">*</span></label>
                          <input required="" class="form-control" value="<?=$user_data[0]->shop;?>" name="shop">
                        </div>
                        <div class="form-group col-md-6">
                          <label>GST Number <span class="required"></span></label>
                          <input class="form-control" value="<?=$user_data[0]->gst_number;?>" name="gstin" type="text">
                        </div>
                        <div class="form-group col-md-6">
                          <label>City<span class="required">*</span></label>
                          <input required="" class="form-control" value="<?=$user_data[0]->city;?>" name="city">
                        </div>
                        <div class="form-group col-md-12">
                          <label>Address <span class="required">*</span></label>
                          <input required class="form-control" name="address" value="<?=$user_data[0]->address;?>" type="text">
                        </div>
                        <div class="col-md-12">
                          <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">Save</button>
                        </div>
                      </div>
                    </form>
                    <?}else{?>
                  <form method="POST" action="<?=base_url()?>User/update_profile" enctype="multipart/form-data">
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label>First Name <span class="required">*</span></label>
                        <input required="" class="form-control" value="<?=$user_data[0]->f_name;?>" name="fname" type="text">
                      </div>
                      <div class="form-group col-md-6">
                        <label>Last Name <span class="required">*</span></label>
                        <input required="" class="form-control" value="<?=$user_data[0]->l_name;?>" name="lname">
                      </div>
                      <div class="form-group col-md-12">
                        <label>Phone Number <span class="required">*</span></label>
                        <input required class="form-control" readonly value="<?=$user_data[0]->phone;?>" name="phone" type="text">
                      </div>
                      <div class="col-md-12">
                        <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">Save</button>
                      </div>
                    </div>
                  </form>
                  <?}?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- END MOBILE SECTION SHOP -->
<div class="modal fade subscribe_popup" id="onload-popup5" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="margin-top:90px;">
          <div class="modal-content">
              <div class="modal-body">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                  </button>
                  <div class="row no-gutters">
                       <div class="col-sm-5">
                          <div class="background_bg h-100" data-img-src="assets/images/popup_img.jpg"></div>
                      </div>
                       <div class="col-sm-12">
                          <div class="popup_content">
                              <div class="popup-text">
                                  <div class="heading_s1">
                                      <h6>Redeem your points</h6><br /><span class="required" style="color: red;">Minimum redeem points: <?=MINREDEEM_POINTS?></span>
                                  </div>
                              </div>
                                  <div class="card col-lg-12">
                                      <div class="card-header">
                                        <h6>Total Points: <?=$user_data[0]->total_points?></h6>
                                      </div>
                                      <div class="card-body">

                                          <form method="POST" action="<?=base_url()?>User/redeem_points" enctype="multipart/form-data">
                                              <div class="row">
                                                  <div class="form-group col-md-6">
                                                      <label>Points Redeem <span class="required" style="color: red;">*</span></label>
                                                      <input required="" onkeypress="return isNumberKey(event)" min="<?=MINREDEEM_POINTS?>" value="<?=MINREDEEM_POINTS?>" class="form-control" name="points" type="number">
                                                   </div>

                                                  <div class="form-group col-md-6">
                                                      <label>Account Number<span class="required" style="color: red;">*</span></label>
                                                      <input required class="form-control" name="accountnumber" onkeypress="return isNumberKey(event)" type="text">
                                                  </div>
                                                  <div class="form-group col-md-6">
                                                      <label>IFSC Code<span class="required" style="color: red;">*</span></label>
                                                      <input required class="form-control" name="ifsccode" type="text">
                                                  </div>
                                                  <div class="form-group col-md-6">
                                                      <label>A/C Holder Name<span class="required" style="color: red;">*</span></label>
                                                      <input required class="form-control" name="name" type="text">
                                                  </div>
                                                  <div class="col-md-12">
                                                      <button type="submit" class="btn btn-fill-out" name="submit" value="Redeem">Redeem</button>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                              <!-- <div class="chek-form">
                                  <div class="custome-checkbox">
                                      <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                      <label class="form-check-label" for="exampleCheckbox3"><span>Don't show this popup again!</span></label>
                                  </div>
                              </div> -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
<!-- END MAIN CONTENT -->
<script type="text/javascript">
    $(window).on('load',function(){
      var pageURL = $(location).attr("href");
      if(pageURL.includes('order')){
      $('#dashboard-tab').removeClass('active');
      $('#orders-tab').addClass('active');
      $('#dash').removeClass('active show');
      $('#dashboard').removeClass('active show');
      $('#orders').addClass('active show');
    }
      if(pageURL.includes('account')){
      $('#dashboard-tab').removeClass('active');
      $('#account-detail-tab').addClass('active');
      $('#dash').removeClass('active show');
      $('#dashboard').removeClass('active show');
      $('#account-detail').addClass('active show');
    }
    });
</script>
<script>
function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);

  /* Alert the copied text */
  notifyInfo("Copied")
}
</script>
