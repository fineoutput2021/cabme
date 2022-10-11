<!-- =================================================== START SECTION BREADCRUMB  =========================================== -->
<div class="breadcrumb_section bg_gray page-title-mini">
  <div class="container">
    <!-- STRART CONTAINER -->
    <div class="row align-items-center">
      <div class="col-md-12">
        <ol class="breadcrumb justify-content-md-start">
          <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
          <li class="breadcrumb-item active">Shopping Bag</li>
        </ol>
      </div>
    </div>
  </div><!-- END CONTAINER-->
</div>
<!-- ===================================================== END SECTION BREADCRUMB ==================================================== -->

<!-- ==================================================== START MAIN CONTENT ==========================================================-->
<div class="main_content refreshing">

  <!-- =================================================== START SECTION SHOP ============================================================-->
  <div class="section">
    <?
    if (!empty($cart_data)) {?>
    <div class="container">
      <!-- ===================================================== START CART PRODUCTS ======================================================= -->
      <div class="row">
        <div class="col-12">
          <div class="table-responsive shop_cart_table">
            <table class="table">
              <thead>
                <tr>
                  <th class="product-thumbnail">&nbsp;</th>
                  <th class="product-name">Product</th>
                  <th class="product-price">Price</th>
                  <th class="product-quantity">Quantity</th>
                  <th class="product-subtotal">Total</th>
                  <th class="product-remove">Remove</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($cart_data as $cart) {?>
                <tr>
                  <td class="product-thumbnail"><a href="#"><img src="<?=$cart['image']?>" alt="<?=$cart['product_name']?>"></a></td>
                  <td class="product-name" data-title="Product"><a href="javascript:;"><?=$cart['product_name']?></a>
                    <br /><span style="font-size: 12px;">Size: <?=$cart['size']?><br />Color: <?=$cart['color']?>
                        </span>
                        <br />
                      <?if($cart['stock']==1){?>
                        <span style="font-size: 12px;color:green">In stock</span>
                      <?}else{?>
                        <span style="font-size: 12px;color:red">Out Of Stock</span>
                      <?}?>

                  </td>
                  <td class="product-price" data-title="Price">₹<?=$cart['price']?></td>
                  <td class="product-quantity" data-title="Quantity">
                    <div class="quantity">
                      <input type="button" value="-" product_id="<?=base64_encode($cart['product_id'])?>" type_id="<?=base64_encode($cart['type_id'])?>" change="<?=$cart['type_id']?>" class="minus">
                      <input type="text" name="quantity" readonly id="quantity<?=$cart['type_id']?>" product_id="<?=base64_encode($cart['product_id'])?>" type_id="<?=base64_encode($cart['type_id'])?>"  value="<?=$cart['quantity']?>" title="Qty" class="qty" size="4">
                      <input type="button" value="+" product_id="<?=base64_encode($cart['product_id'])?>" type_id="<?=base64_encode($cart['type_id'])?>" change="<?=$cart['type_id']?>" class="plus">
                    </div>
                  </td>
                  <td class="product-subtotal" data-title="Total" id="total<?=$cart['type_id']?>">₹<?=$cart['total']?></td>
                  <td class="product-remove" data-title="Remove"><a href="javascript:;" product_id="<?=base64_encode($cart['product_id'])?>" type_id="<?=base64_encode($cart['type_id'])?>" onclick="deleteCart(this)"><i class="ti-close"></i></a></td>
                </tr>
                <?php $i++; } ?>
              </tbody>

            </table>
          </div>
        </div>
      </div>
      <!-- ===================================================== END CART PRODUCTS ======================================================= -->
      <!-- ===================================================== START CART IMAGE DIVIDER==================================================== -->
      <div class="row">
        <div class="col-12">
          <div class="medium_divider"></div>
          <div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
          <div class="medium_divider"></div>
        </div>
      </div>
      <!-- ================================ END CART IMAGE DIVIDER================================= -->
      <!-- ==================================== START CART CALCULATION ================================== -->

      <div class="row">
        <!-- ==================== START SHIPPING CALCULATION ================== -->
        <div class="col-md-6">
          <div class="heading_s1 mb-3">
            <h4>Calculate Shipping</h4>
          </div>
          <form class="field_form shipping_calculator" id="shipping_form" >
            <input type="hidden" name="sub_total" id="stotal" value="<?=$sub_total?>">
            <input type="hidden" name="total_weight" id="sweight" value="<?=$total_weight?>">
            <div class="form-row">
              <div class="form-group col-lg-12">
                <input required="required" onkeypress="return isNumberKey(event)" maxlength="6" placeholder="PostCode / ZIP" class="form-control" name="pincode" type="text" id="zip" value="">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-lg-12">
                <button class="btn btn-fill-line" type="submit">Update</button>
              </div>
            </div>
          </form>
        </div>
        <!-- ==================== END SHIPPING CALCULATION ================== -->
        <!-- ==================== START SUMMARY ================== -->
        <div class="col-md-6">
          <div class="border p-3 p-md-4">
            <div class="heading_s1 mb-3">
              <h4>Cart Summary</h4>
            </div>
            <input type="hidden" id="pincode" value="">
            <input type="hidden" id="courier_id" value="">
            <div class="table-responsive">
              <table class="table">
                <tbody>
                  <tr>
                    <td class="cart_total_label">Cart Subtotal</td>
                    <td class="cart_total_amount">₹<?=$sub_total?></td>
                  </tr>
                  <tr>
                    <td class="cart_total_label">Shipping</td>
                    <td class="cart_total_amount" id="shipping">Free Shipping</td>
                  </tr>
                  <tr>
                    <td class="cart_total_label">Total</td>
                    <td class="cart_total_amount" id="subtotal"><strong>₹<?=$sub_total?></strong></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <?if(!empty($this->session->userdata('user_data'))){?>
            <a href="javascript:void(0)" onclick="call_calculate()" class="btn btn-fill-out">Proceed To Checkout</a>
            <?}else{?>
            <a href="#onload-popup1" data-toggle="modal" data-target="#onload-popup1" class="btn btn-fill-out">Proceed To Checkout</a>
            <?}?>
          </div>
        </div>
        <!-- ==================== END SUMMARY ================== -->

      </div>
      <!-- ===================================== END CART CALCULATION ================================ -->
    </div>
    <?} else {?>
    <div class="text-center">
      <img src="<?=base_url()?>assets/frontend/images/cart_empty.jpg" alt="Empty Cart" class="img-fluid">
    </div>
    <?}?>
  </div>
  <!-- ============================================================= END SECTION SHOP ========================================================= -->

</div>
<!-- ============================================================= END MAIN CONTENT ==========================================================-->
<script>
$(document).ready ( function(){
  if (getSavedValue("pincode") != '') {
    //============================= CALCULATE SHIPPING =========
    var sub_total = $('#stotal').val();
    var total_weight = $('#sweight').val();
    var pincode = getSavedValue("pincode");
     url = base_url+"Cart/get_courier_serviceability";
    $.ajax({
     url: url,
     method: 'post',
     data: {
       sub_total: sub_total,
       total_weight: total_weight,
       pincode: pincode
     },
     dataType: 'json',
     success: function(response) {
       if (response.status == true) {
         $('#shipping').html('₹'+response.data['shipping'])
         $('#subtotal').html('₹'+response.data['sub_total'])
         $('#zip').val(response.data['pincode'])
         $('#pincode').val(response.data['pincode'])
         $('#courier_id').val(response.data['courier_id'])
           localStorage.setItem('pincode', response.data['pincode']);
         notifySuccess(response.message)
       } else if (response.status == false) {
         notifyError(response.message)
       }
     }
    });

}
});
</script>
