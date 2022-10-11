<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
  <div class="container">
    <!-- STRART CONTAINER -->
    <div class="row align-items-center">
      <div class="col-md-12">
        <ol class="breadcrumb justify-content-md-start">
          <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
          <li class="breadcrumb-item active">Checkout</li>
        </ol>
      </div>
    </div>
  </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">


  <!-- START SECTION SHOP -->
  <div class="section topp" style="padding-top: 20px; position: sticky; top: 0;">
    <div class="container">

      <div class="row">
        <div class="col-12">
          <div class="medium_divider"></div>
          <div class="divider center_icon"><i class="linearicons-credit-card"></i></div>
          <div class="medium_divider"></div>
        </div>
      </div>

      <div class="row reversecheckout">
        <div class="col-md-6">
          <div class="heading_s1">
            <h4>Shipping Address</h4>
          </div>
          <form method="POST" id="placeOrderForm" action="javascript:;" enctype="multipart/form-data">
            <div class="row">
              <div class="form-group col-lg-6">
                <input type="text" required class="form-control" id="fname" onkeyup='saveValue(this);' name="fname" placeholder="First name *">
              </div>
              <div class="form-group col-lg-6">
                <input type="text" required class="form-control" id="lname" onkeyup='saveValue(this);' name="lname" placeholder="Last name *">
              </div>
            </div>
            <div class="form-group">
              <input class="form-control" required type="email" id="email" onkeyup='saveValue(this);' name="email" placeholder="Email Address *">
            </div>
            <input type="hidden" id="totAmt" name="totalAmount" value="<?=$order_data[0]->final_amount?>" />
            <div class="form-group">
              <input class="form-control" onkeypress="return isNumberKey(event)" maxlength="10" minlength="10"  required type="text" id="phonenumber" onkeyup='saveValue(this);' name="phonenumber" placeholder="Phone Number *">
            </div>
            <div class="row">
              <div class="form-group col-lg-6">
                <div class="custom_select">
                  <select class="form-control" id="state">
                    <?foreach ($state_data->result() as $state) {?>
                    <option value="<?=$state->state_name?>"><?=$state->state_name?></option>
                    <?}?>
                  </select>
                </div>
              </div>
              <div class="form-group col-lg-6">
                <input class="form-control" id="city" onkeyup='saveValue(this);' required type="text" name="city" placeholder="City *">
              </div>
            </div>
            <div class="form-group">
              <input class="form-control" required type="text" id="address" onkeyup='saveValue(this);' name="address" placeholder="Address *">
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <input class="form-control" type="text" id="referalcode" name="reffercode" placeholder="Enter Referral Code">
                </div>
              </div>

            </div>
            <div class="payment_method" style="padding-bottom: 0px;">
              <div class="heading_s1">
                <h4>Payment</h4>
                <!-- <p style="color: red;padding-bottom:0px;">Delivery Free Above RS 2499</p> -->
              </div>
              <div class="payment_option">
                <div class="custome-radio">
                  <input class="form-check-input payment_option payment_emthod" required="" type="radio" name="payment_option" id="exampleRadios3" value="1" checked="">
                  <label class="form-check-label" for="exampleRadios3">Cash On Delivery (COD)</label>
                </div>
                <div class="custome-radio">
                  <input class="form-check-input payment_option payment_emthod" type="radio" name="payment_option" id="exampleRadios4" value="2">
                  <label class="form-check-label" for="exampleRadios4">Online Payment</label>
                </div>
              </div>
            </div>
            <div class="row detailborder" style="position: sticky;bottom: 0;background: #fff;">
              <div class="col-sm-4 col-6 mt-2 mobileviewdetail">
                <p style="margin-bottom: 3px;color: black;">₹ <?=$order_data[0]->final_amount?></p>
                <a href="javascript:void(0)" id="totop" style="color: #FF324D ;">View details</a>
              </div>
              <div class="col-sm-8 col-6 mt-2">
                <button type="submit" class="btn btn-fill-out btn-block col-sm-8 mb-3">Place Order</a>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-6" id="summary">
          <div class="order_review" >
            <div class="heading_s1">
              <h4>Order Summary</h4>
            </div>
            <div class="table-responsive order_table">
              <table class="table" id="order_review">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th></th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($cart_fetch['cart_data'] as $cart) {?>
                  <tr>
                    <td width="10%"><img src="<?=$cart['image']?>" alt=""></td>
                    <td><?=$cart['product_name']?> <span class="product-qty">x <?=$cart['quantity']?></span></td>
                    <td>₹<?=$cart['price']?></td>
                  </tr>
                  <?}?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Total</th>
                    <td></td>
                    <td class="product-subtotal">₹<?=$order_data[0]->total_amount?></td>
                  </tr>
                  <?
                  if (!empty($order_data[0]->promo_discount) && $order_data[0]->promo_discount > 1) {
                      ?>
                   <tr>
                    <th>Discount</th>
                    <td></td>
                    <td style="color:green">-₹<?=$order_data[0]->promo_discount?></td>
                  </tr>
                  <?
                  }?>
                  <tr>
                    <th>Shipping</th>
                    <td></td>
                    <td><?if(empty($order_data[0]->shipping)){echo 'Free Shipping';}else{echo '₹'.$order_data[0]->shipping;}?></td>
                  </tr>
                  <tr>
                    <th>SubTotal</th>
                    <td></td>
                    <td class="product-subtotal">₹<?=number_format($order_data[0]->final_amount,2);?></td>
                  </tr>
                  <?$promo_string = $this->db->get_where('tbl_promocode', array('id = ' => $order_data[0]->promocode))->result();
                  $input = "";
                  if (!empty($promo_string)) {
                      $input = $promo_string[0]->promocode;
                  }
                  if (!empty($input)) {
                      ?>
                  <tr>
                    <th colspan="2" style="color: #FF324D"><a href="javascript:void(0);" onclick="remove_promocode()" style="color:unset;"><?=$input?>&nbsp;&nbsp<i class="fa fa-times" aria-hidden="true"></i></a></th>
                    <!-- <td></td> -->
                    <td></td>
                  </tr>
                  <?
                  }?>
                </tfoot>
              </table>
            </div>
            <form id="promocode_form" method="POST" enctype="multipart/form-data" action="javascript:void(0)">
            <div class="row">
              <div class="col-lg-8">
                <div class="form-group">
                  <input class="form-control" type="text" name="promocode" id="inputPromocode" required placeholder="Apply Coupon">
                </div>
              </div>
              <div class="col-lg-4" id="apply_promocode">
                <button type="submit" href="javascript:void(0);" class="btn btn-fill-out btn-block">Apply</button>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END SECTION SHOP -->

</div>
<!-- END MAIN CONTENT -->
