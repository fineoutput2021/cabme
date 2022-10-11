<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
            <div class="col-md-12">
              <?$cat_name = $this->db->get_where('tbl_category', array('id = ' => $product_data[0]->category_id))->result();
                $subcat_name = $this->db->get_where('tbl_subcategory', array('id = ' => $product_data[0]->subcategory_id))->result();?>
                <ol class="breadcrumb justify-content-md-start">
                    <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?=base_url()?>Home/all_products/<?=$cat_name[0]->url?>/1"><?=$cat_name[0]->name?></a></li>
                    <li class="breadcrumb-item"><a href="<?=base_url()?>Home/all_products/<?=$subcat_name[0]->url?>/1"><?=$subcat_name[0]->name?></a></li>
                    <li class="breadcrumb-item active"><?=$product_data[0]->name?></li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->
<!-- START MAIN CONTENT -->
<div class="main_content">

<!-- START SECTION SHOP -->
<div class="section pt-2">
	<div class="container">
		<div class="row">
            <div class="col-lg-2 thumb">
              <?php $type_mrp = 0;
              $type_spgst = 0;
              $type_datas = $this->db->get_where('tbl_type', array('product_id = ' => $product_data[0]->id, 'is_active = ' =>1, 'color_active'=>1, 'size_active'=>1));
              $type_data = $this->db->get_where('tbl_type', array('id = ' => $type_id))->result();
              if($product_data[0]->product_view == 3){
                if(!empty($this->session->userdata('user_type'))){
                  if($this->session->userdata('user_type')==2){
                    $type_mrp = $type_data[0]->reseller_mrp;
                    $type_spgst = $type_data[0]->reseller_spgst;
                  }else{
                    $type_mrp = $type_data[0]->retailer_mrp;
                    $type_spgst = $type_data[0]->retailer_spgst;
                  }
                }else{
                  $type_mrp = $type_data[0]->retailer_mrp;
                  $type_spgst = $type_data[0]->retailer_spgst;
                }
              }elseif($product_data[0]->product_view == 2){
                $type_mrp = $type_data[0]->reseller_mrp;
                $type_spgst = $type_data[0]->reseller_spgst;
              }else{
                $type_mrp = $type_data[0]->retailer_mrp;
                $type_spgst = $type_data[0]->retailer_spgst;
              }
              $discount = $type_mrp - $type_spgst;
              $percent=0;
              if($discount>0){
              $percent=$discount/$type_mrp*100;
              $percent  = round($percent, 2);
              }
              if(!empty($type_data[0]->image2)){
                $image1 = $type_data[0]->image2;
              }else{
                $image1 = $type_data[0]->image;
              }?>
                <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="3" data-slides-to-scroll="1" data-infinite="false" data-autoplay="true">
                    <div class="item">
                        <a href="#" class="product_gallery_item active" data-image="<?=base_url().$type_data[0]->image?>" data-zoom-image="<?=base_url().$type_data[0]->image?>">
                            <img src="<?=base_url().$type_data[0]->image?>" alt="product_small_img1" />
                        </a>
                    </div>
                    <?if(!empty($type_data[0]->image2)){?>
                    <div class="item">
                        <a href="#" class="product_gallery_item" data-image="<?=base_url().$type_data[0]->image2?>" data-zoom-image="<?=base_url().$type_data[0]->image2?>">
                            <img src="<?=base_url().$type_data[0]->image2?>" alt="product_small_img2" />
                        </a>
                    </div>
                    <?} if(!empty($type_data[0]->image3)){?>
                    <div class="item">
                        <a href="#" class="product_gallery_item" data-image="<?=base_url().$type_data[0]->image3?>" data-zoom-image="<?=base_url().$type_data[0]->image3?>">
                            <img src="<?=base_url().$type_data[0]->image3?>" alt="product_small_img3" />
                        </a>
                    </div>
                    <?} if(!empty($type_data[0]->image4)){?>
                    <div class="item">
                        <a href="#" class="product_gallery_item" data-image="<?=base_url().$type_data[0]->image4?>" data-zoom-image="<?=base_url().$type_data[0]->image4?>">
                            <img src="<?=base_url().$type_data[0]->image4?>" alt="product_small_img4" />
                        </a>
                    </div>
                    <?} if(!empty($type_data[0]->image5)){?>
                    <div class="item">
                        <a href="#" class="product_gallery_item" data-image="<?=base_url().$type_data[0]->image5?>" data-zoom-image="<?=base_url().$type_data[0]->image5?>">
                            <img src="<?=base_url().$type_data[0]->image5?>" alt="product_small_img2" />
                        </a>
                    </div>
                    <?} if(!empty($type_data[0]->image6)){?>
                    <div class="item">
                        <a href="#" class="product_gallery_item" data-image="<?=base_url().$type_data[0]->image6?>" data-zoom-image="<?=base_url().$type_data[0]->image6?>">
                            <img src="<?=base_url().$type_data[0]->image6?>" alt="product_small_img3" />
                        </a>
                    </div>
                    <?}?>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 mb-md-0  preview">
              <div class="product-image">
                    <div class="product_img_box">
                        <img id="product_img" src='<?=base_url().$type_data[0]->image?>' data-zoom-image="<?=base_url().$type_data[0]->image?>" alt="product_img1" />
                        <a href="#" class="product_img_zoom" title="Zoom">
                            <span class="linearicons-zoom-in"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 description">
                <div class="pr_detail">
                    <div class="product_description mt-3">
                      <div class="row">
                        <div class="col-md-8">
                        <h4 class="product_title twoline"><a href="#"><?=$product_data[0]->name?></a></h4>
                        </div>
                      <div class="col-md-4">
                      <div class="rating_wrap">
                        <? $review_count = 0;
                           $totalStars = 0;
                          foreach($product_reviews->result() as $count){
                          $review_count++;
                          $totalStars = $count->star_rating + $totalStars;
                        }
                        if($review_count==0){$review_countdiv = 1;}else{ $review_countdiv = $review_count;}
                        ?>
                                <div class="rating">
                                  <?
                                  $rating = ($totalStars/$review_countdiv)*100;
                                  ?>
                                    <div class="product_rate" style="width:<?=$rating?>%"></div>
                                </div>
                                <span class="rating_num"><?
                                echo "(".$review_count.")";
                                ?></span>
                            </div>
                      </div>
                      </div>
                        <div class="product_price ">
                            <span class="price">₹<?=$type_spgst?></span>
                            <?if($type_mrp > $type_spgst){?><del>₹<?=$type_mrp?></del>
                            <?}?>
                            <?if($percent>0){?>
                            <div class="on_sale">
                              <span><?=round($percent)?>% Off</span>
                            </div>
                            <?}?>
                            <div class="mt-2" style="font-size: 15px;">Product Code: <a href="#" style="font-size: 14px;"><?=$product_data[0]->sku?></a></div>
                            <?if($this->session->userdata('user_type')==2){?>
                            <div class="mt-2" style="font-size: 15px;">Minimum Quantity: <a href="#" style="font-size: 14px;"><?=$type_data[0]->reseller_min_qty;?></a></div>
                            <?}?>

                        </div>
                        <div class="pr_desc"> </div>
                        </div>
                        <div class="pr_switch_wrap clr_mrg">
                            <span class="switch_lable text-left">Color</span>
                            <div class="product_color_switch mb-3">
                              <?foreach($color_arr as $type){
                                $color = $this->db->get_where('tbl_colour', array('id = ' => $type->colour_id, 'is_active = ' =>1))->result();
                                ?>
                                <span <?if($type_data[0]->colour_id==$type->colour_id){?> class="active" <?}?> data-color="<?=$color[0]->name?>" color_id="<?=$color[0]->id?>" product_id="<?=$product_data[0]->id?>" onclick="location.href='<?=base_url()?>Home/product_detail/<?=$product_data[0]->url?>?type=<?=base64_encode($type->id)?>'"></span>
                                <?}?>
                            </div>

                        <div class="pr_switch_wrap mt-4">
                            <span class="switch_lable mt-1">Size</span>
                            <div class="product_size_switch spanpadding" id="size_div">
                              <?
                                foreach($size_arr as $size){
                                ?>
                                <a href="<?=base_url()?>Home/product_detail/<?=$product_data[0]->url?>?type=<?=base64_encode($size['type_id'])?>" ><span <?if($size['stock']==0){?> class="spananim" <?}?> <?if($size['id']==$type_data[0]->size_id){?> class="active" <?}?>><?=$size['size_name'];?></span></a>
                                <?}?>
                            </div>
                        </div>
                        <div class="pr_switch_wrap">
                            <!-- <span class="switch_lable mt-1">Size</span> -->
                            <div class=" switch2 spanpadding d-flex" style="margin-left: 3px;margin-top: -7px;">
                              <span><?if($type_data[0]->inventory < 15){echo "Left:".$type_data[0]->inventory;}?></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <p style="color:#FF324D"><a href="javascript:;" data-target="#chart_size_modal" data-toggle="modal" data-dismiss="modal" style="color:#FF324D;"><b>Size Chart</b></a></p>
                    </div>
                    <hr />
                    <?if($this->session->userdata('user_type')==2){
                      $minQty = $type_data[0]->reseller_min_qty;
                    }else{
                      $minQty = 1;
                    }?>
                    <div class="row mb-2" id="wishlist">
                    <div class="col-lg-7">
                    <div class="cart_extra">
                        <div class="cart-product-quantity">
                            <div class="quantity">
                                <input type="button" value="-" change=0 id="myminus" class="minus">
                                <input type="text" readonly onkeypress="return isNumberKey(event)" min-qty="<?=$minQty?>" name="quantity" product_id='' value="<?=$minQty?>" title="Qty" id="quantity" class="qty" size="4">
                                <input type="button" value="+" change=0 id="" class="plus">
                            </div>
                        </div>
                    </div>

                    <div class="cart_btn desktop_p_detail">
                      <button class="btn btn-fill-out btn-addtocart" product_id="<?=base64_encode($product_data[0]->id)?>" type_id="<?=base64_encode($type_data[0]->id)?>" quantity="1" id="addtoCartButton" onclick="addToCart(this)" type="button"><i class="linearicons-bag2"></i> <span class="mt-2"> Add to bag</span></button>
                      <?if(!empty($this->session->userdata('user_data'))){
                        $user_id=$this->session->userdata('user_id');
                        $wihslist = $this->db->get_where('tbl_wishlist', array('user_id'=> $user_id,'product_id'=> $product_data[0]->id,'type_id'=> $type_data[0]->id))->result();
                        if(!empty($wihslist)){
                        ?>
                        <a class="add_wishlist" href="javascript:void(0)"product_id="<?=base64_encode($product_data[0]->id)?>" type_id="<?=base64_encode($type_data[0]->id)?>" status="remove"  onclick="wishlist(this)"><i class="fa fa-heart" style="color:red;"></i></a>
                        <?}else{?>
                          <a class="add_wishlist" href="javascript:void(0)"product_id="<?=base64_encode($product_data[0]->id)?>" type_id="<?=base64_encode($type_data[0]->id)?>" status="add"  onclick="wishlist(this)"><i class="icon-heart"></i></a>
                        <?}?>
                        <?}else{?>
                          <a class="add_wishlist" href="javascript:void(0)" data-target="#onload-popup1" data-toggle="modal" data-dismiss="modal"><i class="icon-heart"></i></a>
                          <?}?>
                    </div>
                    </div>
                   </div>

<style>
    .owl-carousel>.owl-nav
    {
        display: none !important;
    }
</style>

                    <div class="carousel_slider owl-carousel owl-theme" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "1"}, "768":{"items": "1"}, "992":{"items": "1"}, "1199":{"items": "1"}}' data-autoplay="true" data-loop="true">
                      <?$promocode_data = $this->db->get_where('tbl_promocode', array('is_active = ' =>1));
                      foreach($promocode_data->result() as $promocode){?>
                        <div class="item" style="box-shadow: 4px 0px 3px rgb(175, 174, 174);">
                            <div class="product">
                                <div class="product_img pt-2 pb-2">
                                    <div class="ml-3 d-flex">  <img src="<?=base_url()?>assets\frontend\images\offerpic.png" alt="" style="width: 10%;"><span class="mt-1"> Offers for you </span> </div>
                                    <div class="row">
                                          <div class="col-md-12 ml-3"><p>COUPON: <b><?=$promocode->promocode;?></b> </p></div>
                                      <div class="col-md-12 ml-3" style="padding-top: 5px;"><span>Congratulation! You are eligible for <?if($promocode->type==1){echo $promocode->percentage_amount."%";}else{echo "₹".$promocode->percentage_amount;}?> extra discount</span></div>
                                </div>
                                </div>

                            </div>
                        </div>
                        <?}?>
                    </div>

                    <hr />
                    <div class="product_sort_info">
                    <ul>
                      <li><i class="linearicons-bag-dollar"></i> Cash On Delivery Available</li>
                      <li><i class="linearicons-truck"></i>Free Home Delivery</li>
                      <li><i class="linearicons-sync"></i> Return And Exchange</li>
                    </ul></div>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12">
            	<div class="tab-style3">
					<ul class="nav nav-tabs" role="tablist">
                      	<li class="nav-item ">
                        	<a class="nav-link active" id="Additional-info-tab" data-toggle="tab" href="#Additional-info" role="tab" aria-controls="Additional-info" aria-selected="true">Product Detail</a>
                      	</li>
                      	<li class="nav-item">
                        	<a class="nav-link" id="Reviews-tab" data-toggle="tab" href="#Reviews" role="tab" aria-controls="Reviews" aria-selected="false">Reviews</a>
                      	</li>
                    </ul>
                	<div class="tab-content shop_info_tab">
                      	<div class="tab-pane show fade active" id="Additional-info" role="tabpanel" aria-labelledby="Additional-info-tab">
                        	<table class="table table-bordered">
                            <? $description = explode(',', $product_data[0]->description);?>
                            <tr>
                                <?$i = 1; foreach($description as $desc){?>
                                	<td><?=$desc?></td>
                                  <?if($i%2 == 0){?>
                                  </tr>
                                  <tr>
                                  <?}?>
                                  <?$i++;}?>
                              </tr>
                        	</table>
                      	</div>
                      	<div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                        	<div class="comments">
                            	<h5 class="product_tab_title">Review For <span><?=$product_data[0]->name;?></span></h5>
                                <ul class="list_none comment_list mt-4">
                                  <?foreach($product_reviews->result() as $reviews){?>
                                    <li>
                                        <div class="comment_block">
                                            <div class="rating_wrap">
                                                <div class="rating">
                                                  <?if($reviews->star_rating==1){
                                                    $width = 20;
                                                  } elseif($reviews->star_rating==2){
                                                    $width = 40;
                                                  } elseif($reviews->star_rating==3){
                                                    $width = 60;
                                                  } elseif($reviews->star_rating==4){
                                                    $width = 80;
                                                  } else{
                                                    $width = 100;
                                                  }
                                                  ?>
                                                    <div class="product_rate" style="width: <?=$width?>%"></div>
                                                </div>
                                            </div>
                                            <p class="customer_meta">
                                                <span class="review_author"><?=$reviews->name?></span>
                                                <span class="comment-date"><?$newdate = new DateTime($reviews->date);
                                                echo $newdate->format('F j, Y');?></span>
                                            </p>
                                            <div class="description">
                                                <?=$reviews->review?>
                                            </div>
                                        </div>
                                    </li>
                                    <?}?>
                                </ul>
                        	</div>
                            <div class="review_form field_form">
                                <h5>Add a review</h5>
                                <form class="row mt-3" method="POST" action="<?=base_url()?>Home/product_review" enctype="multipart/form-data">
                                    <div class="form-group col-12">
                                        <div class="star_rating">
                                            <span data-value="1" class="selected" onclick="saveStarValue(1)"><i class="far fa-star"></i></span>
                                            <span data-value="2" class="selected" onclick="saveStarValue(2)"><i class="far fa-star"></i></span>
                                            <span data-value="3" class="selected" onclick="saveStarValue(3)"><i class="far fa-star"></i></span>
                                            <span data-value="4" onclick="saveStarValue(4)"><i class="far fa-star"></i></span>
                                            <span data-value="5" onclick="saveStarValue(5)"><i class="far fa-star"></i></span>
                                        </div>
                                    </div>
                                    <input type="hidden" value="<?=$product_data[0]->id?>" name="product_data" />
                                    <div class="form-group col-12">
                                        <textarea required="required" placeholder="Your review *" class="form-control" name="message" rows="4"></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input required="required" placeholder="Enter Name *" class="form-control" name="name" type="text">
                                     </div>
                                    <div class="form-group col-md-6">
                                        <input required="required" placeholder="Enter Email *" class="form-control" name="email" type="email">
                                        <input type="hidden" name="star_rating" id="star_rating" value="3" />
                                    </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">Submit Review</button>
                                    </div>
                                </form>
                            </div>
                      	</div>
                	</div>
                </div>
            </div>
        </div>
        <!-- mobile/cart/wishlist -->
      <div class="cart_btn mobile_p_detail text-center refreshing" style="position:sticky; bottom:0;z-index:9999;">
        <?if(!empty($this->session->userdata('user_data'))){
          $user_id=$this->session->userdata('user_id');
          $wihslist = $this->db->get_where('tbl_wishlist', array('user_id'=> $user_id,'product_id'=> $product_data[0]->id,'type_id'=> $type_data[0]->id))->result();
          if(!empty($wihslist)){
          ?>
        <button class="btn  btn-addtocart" type="button" product_id="<?=base64_encode($product_data[0]->id)?>" type_id="<?=base64_encode($type_data[0]->id)?>" status="remove"  onclick="wishlist(this)" style="padding:8px 35px;letter-spacing:1px;background:#FF324D;color:white;"><i class="fa fa-heart"></i><span class="mt-1"> Wishlist</span></button>
          <?}else{?>
            <button class="btn  btn-addtocart" type="button" product_id="<?=base64_encode($product_data[0]->id)?>" type_id="<?=base64_encode($type_data[0]->id)?>" status="add"  onclick="wishlist(this)" style="padding:8px 35px;letter-spacing:1px;background:#FF324D;color:white;"><i class="icon-heart"></i><span class="mt-1"> Wishlist</span></button>
          <?}?>
          <?}else{?>
            <button class="btn  btn-addtocart" type="button" data-target="#onload-popup1" data-toggle="modal" data-dismiss="modal" style="padding:8px 35px;letter-spacing:1px;background:#FF324D;color:white;"><i class="icon-heart"></i><span class="mt-1"> Wishlist</span></button>
            <?}?>

          <button class="btn  btn-addtocart" product_id="<?=base64_encode($product_data[0]->id)?>" type_id="<?=base64_encode($type_data[0]->id)?>" quantity="1" id="addtoCartButton" onclick="addToCart(this)" type="button" style="padding:8px 35px;background:#FF324D;color:white;"><i class="linearicons-bag2"></i> <span class="mt-1"> Add to bag</span></button>

      </div>
      <!-- mobile cart/wishlist -->
        <div class="row">
        	<div class="col-12">
            	<div class="small_divider"></div>
            	<div class="divider"></div>
                <div class="medium_divider"></div>
            </div>
        </div>

           <!-- START SECTION SHOP -->
           <!-- BUY WITH IT SECTION START  -->
           <? if(!empty($buy_with_it)){?>
<div class="section" style="padding:0px;">
	<div class="container">
    	<div class="row">
			<div class="col-md-6">
            	<div class="heading_s1">
                	<h2>Buy With It</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            	<div class="product_slider carousel_slider owl-carousel owl-theme nav_style1" data-loop="false" data-dots="false" data-nav="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "300":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                <?foreach($buy_with_it as $buy_with){
                  $type_mrp = 0;
                  $type_spgst = 0;
                  $type_datas = $this->db->get_where('tbl_type', array('product_id = ' => $buy_with[0]->id, 'is_active'=>1));
                  $type_data = $type_datas->result();
                  if(!empty($type_data)){
                    if($buy_with[0]->product_view == 3){
                      if(!empty($this->session->userdata('user_type'))){
                        if($this->session->userdata('user_type')==2){
                          $type_mrp = $type_data[0]->reseller_mrp;
                          $type_spgst = $type_data[0]->reseller_spgst;
                        }else{
                          $type_mrp = $type_data[0]->retailer_mrp;
                          $type_spgst = $type_data[0]->retailer_spgst;
                        }
                      }else{
                        $type_mrp = $type_data[0]->retailer_mrp;
                        $type_spgst = $type_data[0]->retailer_spgst;
                      }
                    }elseif($buy_with[0]->product_view == 2){
                      $type_mrp = $type_data[0]->reseller_mrp;
                      $type_spgst = $type_data[0]->reseller_spgst;
                    }else{
                      $type_mrp = $type_data[0]->retailer_mrp;
                      $type_spgst = $type_data[0]->retailer_spgst;
                    }
                  $discount = $type_mrp - $type_spgst;
                  $percent=0;
                  if($discount>0){
                  $percent=$discount/$type_mrp*100;
                  $percent  = round($percent, 2);
                  }
                  if(!empty($type_data[0]->image2)){
                    $image1 = $type_data[0]->image2;
                  }else{
                    $image1 = $type_data[0]->image;
                  }
                  ?>
                  <div class="item">
                    <div class="product">
                      <?if($buy_with[0]->exclusive==1){?><span class="pr_flash">Exclusive</span>
                      <?}
                      $user_id=$this->session->userdata('user_id');
                      if(!empty($user_id)){
                      $wihslist = $this->db->get_where('tbl_wishlist', array('user_id'=> $user_id,'product_id'=> $buy_with[0]->id,'type_id'=> $type_data[0]->id))->result();
                      if(!empty($wihslist)){
                      ?>
                      <span class="htc float-right">
                        <a href="javascript:void(0)" product_id="<?=base64_encode($buy_with[0]->id)?>" type_id="<?=base64_encode($type_data[0]->id)?>" status="remove"  onclick="wishlist(this)"><i class="fa fa-heart float-right" style="color:red;"></i></a>
                      </li></span>
                      <?}else{?>
                        <span class="htc float-right">
                          <a href="javascript:void(0)"product_id="<?=base64_encode($buy_with[0]->id)?>" type_id="<?=base64_encode($type_data[0]->id)?>" status="add"  onclick="wishlist(this)"><i class="icon-heart float-right" style="color:red;"></i></a>
                        </li></span>
                      <?}
                      }else{?>
                        <span class="htc float-right">
                          <a href="javascript:void(0)"data-target="#onload-popup1" data-toggle="modal" data-dismiss="modal"><i class="icon-heart float-right" style="color:red;"></i></a>
                        </li></span>
                        <?}?>
                      <div class="product_img">
                        <a href="<?=base_url()?>Home/product_detail/<?=$buy_with[0]->url?>?type=<?=base64_encode($type_data[0]->id)?>">
                          <img src="<?=base_url().$type_data[0]->image?>" onmouseover="pro_change(this)" onmouseout="pro_default(this)" img="<?=base_url().$type_data[0]->image?>" img2="<?=base_url().$image1?>" alt="">
                        </a>
                        <div class="product_action_box">
                          <ul class="list_none pr_action_btn">
                            <?php $i=1; $more=0;
                            $size_arr=[];
                             foreach($type_datas->result() as $type_size) {
                               $status=0;
                          if($i<5){
                              $this->db->select('*');
                              $this->db->from('tbl_size');
                              $this->db->where('id',$type_size->size_id);
                              $this->db->where('is_active',1);
                              $size_data= $this->db->get()->row();
                              if(!empty($size_data)){
                              if($i==1){
                                array_push($size_arr,$size_data->id);
                                $status=0;
                              }else{
                                foreach ($size_arr as $key) {
                                if($key==$size_data->id){
                                  $status=1;
                                  break;
                                }
                                }
                              }
                              if($status==0){
                                array_push($size_arr,$size_data->id);
                              ?>
                            <li class="add-to-cart"><a href="<?=base_url()?>Home/product_detail/<?=$buy_with[0]->url?>?type=<?=base64_encode($type_size->id)?>" class="popup-ajax"><?=$size_data->name?></a></li>
                          <?php }}}else{$more++;}$i++; }
                          if($more > 0){
                          ?>
                            <li><a href="<?=base_url()?>Home/product_detail/<?=$buy_with[0]->url?>?type=<?=base64_encode($type_data[0]->id)?>" class="popup-ajax" style="background:transparent; color:white;">+<?=$more?></a></li>
                            <?}?>
                          </ul>
                        </div>
                      </div>
                      <div class="product_info">
                        <h6 class="product_title"><a href="<?=base_url()?>Home/product_detail/<?=$buy_with[0]->url?>?type=<?=base64_encode($type_data[0]->id)?>"><?=$buy_with[0]->name?></a></h6>
                        <div class="product_price">
                          <span class="price">₹<?=$type_spgst?></span>
                          <?if($type_mrp > $type_spgst){?><del>₹<?=$type_mrp?></del>
                          <?}?>
                          <?if($percent>0){?>
                          <div class="on_sale">
                            <span><?=round($percent)?>% Off</span>
                          </div>
                          <?}?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } }  ?>
                </div>
            </div>
		</div>
    </div>
</div>
<?}?>
<!-- BUY WITH IT SECTION END  -->
<!-- RELATED PRODUCTS SECTION START -->
<?if(!empty($related_data)){?>
<div class="section" style="padding:0px;">
	<div class="container">
    	<div class="row">
			<div class="col-md-6">
            	<div class="heading_s1">
                	<h2>Related Products</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            	<div class="product_slider carousel_slider owl-carousel owl-theme nav_style1" data-loop="false" data-dots="false" data-nav="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "300":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                    <?foreach($related_data->result() as $related){
                      $type_datas = $this->db->get_where('tbl_type', array('product_id = ' => $related->id));
                      $type_data = $type_datas->result();
                      if(!empty($type_data)){
                        if($related->product_view == 3){
                          if(!empty($this->session->userdata('user_type'))){
                            if($this->session->userdata('user_type')==2){
                              $type_mrp = $type_data[0]->reseller_mrp;
                              $type_spgst = $type_data[0]->reseller_spgst;
                            }else{
                              $type_mrp = $type_data[0]->retailer_mrp;
                              $type_spgst = $type_data[0]->retailer_spgst;
                            }
                          }else{
                            $type_mrp = $type_data[0]->retailer_mrp;
                            $type_spgst = $type_data[0]->retailer_spgst;
                          }
                        }elseif($related->product_view == 2){
                          $type_mrp = $type_data[0]->reseller_mrp;
                          $type_spgst = $type_data[0]->reseller_spgst;
                        }else{
                          $type_mrp = $type_data[0]->retailer_mrp;
                          $type_spgst = $type_data[0]->retailer_spgst;
                        }
                        $discount = $type_mrp - $type_spgst;
                        $percent=0;
                        if($discount>0){
                        $percent=$discount/$type_mrp*100;
                        $percent  = round($percent, 2);
                        }
                        if(!empty($type_data[0]->image2)){
                          $image1 = $type_data[0]->image2;
                        }else{
                          $image1 = $type_data[0]->image;
                        }?>
                      <div class="item">
                        <div class="product">
                          <?if($related->exclusive==1){?><span class="pr_flash">Exclusive</span>
                          <?}
                          $user_id=$this->session->userdata('user_id');
                          if(!empty($user_id)){
                          $wihslist = $this->db->get_where('tbl_wishlist', array('user_id'=> $user_id,'product_id'=> $related->id,'type_id'=> $type_data[0]->id))->result();
                          if(!empty($wihslist)){
                          ?>
                          <span class="htc float-right">
                            <a href="javascript:void(0)" product_id="<?=base64_encode($related->id)?>" type_id="<?=base64_encode($type_data[0]->id)?>" status="remove"  onclick="wishlist(this)"><i class="fa fa-heart float-right" style="color:red;"></i></a>
                          </li></span>
                          <?}else{?>
                            <span class="htc float-right">
                              <a href="javascript:void(0)"product_id="<?=base64_encode($related->id)?>" type_id="<?=base64_encode($type_data[0]->id)?>" status="add"  onclick="wishlist(this)"><i class="icon-heart float-right" style="color:red;"></i></a>
                            </li></span>
                          <?}
                          }else{?>
                            <span class="htc float-right">
                              <a href="javascript:void(0)" data-target="#onload-popup1" data-toggle="modal" data-dismiss="modal"><i class="icon-heart float-right" style="color:red;"></i></a>
                            </li></span>
                            <?}?>
                          <div class="product_img">
                            <a href="<?=base_url()?>Home/product_detail/<?=$related->url?>?type=<?=base64_encode($type_data[0]->id)?>">
                              <img src="<?=base_url().$type_data[0]->image?>" onmouseover="pro_change(this)" onmouseout="pro_default(this)" img="<?=base_url().$type_data[0]->image?>" img2="<?=base_url().$image1?>" alt="">
                            </a>
                            <div class="product_action_box">
                              <ul class="list_none pr_action_btn">
                                <?php $i=1; $more=0;
                                $size_arr=[];
                                foreach($type_datas->result() as $type_size) {
                                     $status=0;
                              if($i<5){
                                  $this->db->select('*');
                                  $this->db->from('tbl_size');
                                  $this->db->where('id',$type_size->size_id);
                                  $this->db->where('is_active',1);
                                  $size_data= $this->db->get()->row();
                                  if(!empty($size_data)){
                                  if($i==1){
                                    array_push($size_arr,$size_data->id);
                                    $status=0;
                                  }else{
                                    foreach ($size_arr as $key) {
                                    if($key==$size_data->id){
                                      $status=1;
                                      break;
                                    }
                                    }
                                  }
                                  if($status==0){
                                    array_push($size_arr,$size_data->id);
                                  ?>
                                <li class="add-to-cart"><a href="<?=base_url()?>Home/product_detail/<?=$related->url?>?type=<?=base64_encode($type_size->id)?>" class="popup-ajax"><?=$size_data->name?></a></li>
                              <?php }}}else{$more++;}$i++; }
                              if($more > 0){
                              ?>
                                <li><a href="<?=base_url()?>Home/product_detail/<?=$related->url?>?type=<?=base64_encode($type_data[0]->id)?>" class="popup-ajax" style="background:transparent; color:white;">+<?=$more?></a></li>
                                <?}?>
                              </ul>
                            </div>
                          </div>
                          <div class="product_info">
                            <h6 class="product_title"><a href="<?=base_url()?>Home/product_detail/<?=$related->url?>?type=<?=base64_encode($type_data[0]->id)?>"><?=$related->name?></a></h6>
                            <div class="product_price">
                              <span class="price">₹<?=$type_spgst?></span>
                              <?if($type_mrp > $type_spgst){?><del>₹<?=$type_mrp?></del>
                              <?}?>
                              <?if($percent>0){?>
                              <div class="on_sale">
                                <span><?=round($percent)?>% Off</span>
                              </div>
                              <?}?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php }$i++; }  ?>
                </div>
            </div>
		     </div>
    </div>
</div>
<?}?>
<!-- RELATED PRODUCTS SECTION END  -->
<!-- END SECTION SHOP -->

    </div>
</div>
</div>
<!-- END SECTION SHOP -->
<!-- =================================== Start PRODUCT IMAGE SIZE CHART ============================================-->
<div class="modal fade subscribe_popup" id="chart_size_modal" tabindex="-1" role="dialog" style="overflow: hidden;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered mediadevice" role="document" style="margin-top:85px;">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                </button>
                <div class="row" style="padding: 40px;">
                  <img src="<?=base_url().$product_data[0]->image1?>" class="img-fluid" />
                </div>
            </div>
    	</div>
    </div>
</div>
<!-- =================================== END PRODUCT IMAGE SIZE CHART ============================================-->


<script>
  $(document).ready(function() {
    $('.star_rating span').on('click', function() {
      var onStar = parseFloat($(this).data('value'), 10); // The star currently selected
      var stars = $(this).parent().children('.star_rating span');
      for (var i = 0; i < stars.length; i++) {
        $(stars[i]).removeClass('selected');
      }
      for (i = 0; i < onStar; i++) {
        $(stars[i]).addClass('selected');
      }
    });
  });

  function saveStarValue(i){
    $('#star_rating').val(i);
  }
</script>
