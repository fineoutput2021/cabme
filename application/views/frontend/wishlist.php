<!-- ================================================== START SECTION BREADCRUMB =====================================================-->
<div class="breadcrumb_section bg_gray page-title-mini">
  <div class="container">
    <!-- STRART CONTAINER -->
    <div class="row align-items-center">

      <div class="col-md-12">
        <ol class="breadcrumb justify-content-md-start">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Pages</a></li>
          <li class="breadcrumb-item active">Wishlist</li>
        </ol>
      </div>
    </div>
  </div><!-- END CONTAINER-->
</div>
<!-- =================================================== END SECTION BREADCRUMB ==========================================================-->

<!--  ================================================== START MAIN CONTENT ================================================================-->
<div class="main_content">

  <!-- ================================================== START SECTION WISHLIST ==================================================================-->
  <div class="section" id="wishlist">
    <?if (!empty($wishlist_data)) {?>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="table-responsive wishlist_table">
            <table class="table">
              <thead>
                <tr>
                  <th class="product-thumbnail">&nbsp;</th>
                  <th class="product-name">Product</th>
                  <th class="product-price">Price</th>
                  <th class="product-stock-status">Stock Status</th>
                  <th class="product-add-to-cart"></th>
                  <th class="product-remove">Remove</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($wishlist_data as $wishlist) { ?>
                <tr>
                  <td class="product-thumbnail"><a href="<?=base_url()?>Home/product_detail/<?=$wishlist['url']?>?type=<?=base64_encode($wishlist['type_id'])?>"><img src="<?=$wishlist['image']?>" alt="product1"></a></td>
                  <td class="product-name" data-title="Product"><a href="<?=base_url()?>Home/product_detail/<?=$wishlist['url']?>?type=<?=base64_encode($wishlist['type_id'])?>"><?=$wishlist['product_name']?></a>
                    <br /><span style="font-size: 12px;">Size: <?=$wishlist['size']?><br />Color: <?=$wishlist['color']?></span>

                  </td>
                  <td class="product-price" data-title="Price">₹<?=$wishlist['price']?></td>
                  <td class="product-stock-status" data-title="Stock Status">
                    <?if ($wishlist['stock']==1) {?>
                    <span class="badge badge-pill badge-success">In Stock</span>
                    <?} else {?>
                    <span class="badge badge-pill badge-danger">Out of Stock</span>
                    <?}?>
                  </td>
                  <td class="product-add-to-cart">
                    <?if ($wishlist['stock']==1) {?>
                    <a href="javascript:;" class="btn btn-fill-out" product_id="<?=base64_encode($wishlist['product_id'])?>" type_id="<?=base64_encode($wishlist['type_id'])?>" status="move"  onclick="wishlist(this)"><i class="icon-basket-loaded"></i> Move to Cart</a>
                    <?}?>
                  </td>
                  <td class="product-remove" data-title="Remove"><a href="javascript:void(0)" product_id="<?=base64_encode($wishlist['product_id'])?>" type_id="<?=base64_encode($wishlist['type_id'])?>" status="remove"  onclick="wishlist(this)"><i class="ti-close"></i></a></td>
                </tr>
                <?php $i++; } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?} else {?>
    <div class="text-center">
      <img src="<?=base_url()?>assets/frontend/images/wishlist_empty.jpg" alt="Empty Wishlist" class="img-fluid">
    </div>
    <?}?>
  </div>
  <!-- ================================================================== END SECTION WISHLIST ========================================================-->
