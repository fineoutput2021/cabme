<!-- =================================================== START SECTION BREADCRUMB  =========================================== -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
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
<div class="main_content">

<!-- =================================================== START SECTION SHOP ============================================================-->
<div class="section">
	<div class="container">
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
                          <?php $i=1; foreach($cart_data as $cart) {?>
                        	<tr>
                            	<td class="product-thumbnail"><a href="#"><img src="assets/images/product_img1.jpg" alt="product1"></a></td>
                                <td class="product-name" data-title="Product"><a href="#"><?=$cart->product_name?></a></td>
                                <td class="product-price" data-title="Price">₹<?=$cart->price?></td>
                                <td class="product-quantity" data-title="Quantity"><div class="quantity">
                                <input type="button" value="-" class="minus">
                                <input type="text" name="quantity" value="<?=$cart->quantity?>" title="Qty" class="qty" size="4">
                                <input type="button" value="+" class="plus">
                              </div></td>
                              	<td class="product-subtotal" data-title="Total">₹<?=$cart->total?></td>
                                <td class="product-remove" data-title="Remove"><a href="#"><i class="ti-close"></i></a></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            	<div class="medium_divider"></div>
            	<div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
            	<div class="medium_divider"></div>
            </div>
        </div>
        <div class="row">
        	<div class="col-md-6">
            	<div class="heading_s1 mb-3">
            		<h4>Calculate Shipping</h4>
                </div>
                <form class="field_form shipping_calculator">

                    <div class="form-row">

                        <div class="form-group col-lg-12">
                            <input required="required" placeholder="PostCode / ZIP" class="form-control" name="name" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <button class="btn btn-fill-line" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
            	<div class="border p-3 p-md-4">
                    <div class="heading_s1 mb-3">
                        <h4>Cart Summary</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="cart_total_label">Cart Subtotal</td>
                                    <td class="cart_total_amount">₹<?=$sub_total?></td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">Shipping</td>
                                    <td class="cart_total_amount">Free Shipping</td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">Total</td>
                                    <td class="cart_total_amount"><strong>₹<?=$sub_total?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="checkout.html" class="btn btn-fill-out">Proceed To CheckOut</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->

</div>
<!-- END MAIN CONTENT -->
