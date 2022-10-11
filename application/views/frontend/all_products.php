<link rel="stylesheet" href="<?=base_url()?>assets/frontend/css/jquery-ui.css">
<!--========================================== START SECTION BREADCRUMB ============================================-->
<div class="breadcrumb_section  page-title-mini">
  <div class="container-fluid">
    <div class="row align-items-center px-4 roxy">
      <div class="col-md-6">
        <div class="page-title">
          <h1><?=$subcategory_name?></h1>
        </div>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb justify-content-md-end">
          <?$cat = explode(" ", $category_name);
            $caturl = implode("-", $cat);?>
          <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?=base_url()?>Home/all_products/<?=$caturl?>/1"><?=$category_name?></a></li>
          <li class="breadcrumb-item active"><?=$subcategory_name?></li>
        </ol>
      </div>
    </div>
  </div><!-- END CONTAINER-->
</div>
<!-- ========================================== END SECTION BREADCRUMB ====================================================-->

<!--============================================ START MAIN CONTENT =========================================================-->
<div class="main_content" id="wishlist">
  <!--=========================================== START SECTION SHOP ==========================================================-->
  <div class="section" style="padding-top: 10px;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-10" style="">
          <!-- ===================================== START SORT BY ===========================================================   -->
          <div class="row align-items-center mb-4 pb-1 hidee">
            <div class="col-12">
              <div class="product_header">
                <div class="product_header_right" style="float: right;margin-right:20px; position: absolute; right: 21.5%;">
                  <li class="dropdown  sortbyhover" data-toggle="dropdown"><span style="font-size: 15px;">Sort By </span><span id="sort by">Price</span> <img src="<?=base_url()?>assets\frontend\images\down-arrow.png" alt=""
                      style="float: right;margin-top: 6px;">
                    <div class="cart_box cart_right dropdown-menu dropdown-menu-right" style="right: auto;margin-left: -10px;min-width: 14.3rem;">
                      <ul class="hovercolor">
                        <li  onclick="soryBy('ASC')" class="<?if($sort=='ASC'){echo 'first';}?>" style="color: black;">
                         Low to high
                        </li>
                        <li onclick="soryBy('DESC')" class="<?if($sort=='DESC'){echo 'first';}?>" style="color: black;">
                             High to low
                        </li>
                      </ul>
                    </div>
                  </li>
                </div>
              </div>
            </div>
          </div>
          <!-- ===================================== END SORT BY ===========================================================   -->

          <!-- ===================================== START ALL PRODUCTS ===========================================================   -->

          <div class="col-md-12 ppadding" style="padding-right: 0px;">
            <?if(!empty($product)){?>
            <div class="row m-0">

              <?foreach($product as $data){
                $type_mrp = 0;
                $type_spgst = 0;
                $type_datas = $this->db->get_where('tbl_type', array('product_id = ' => $data->id, 'is_active'=>1, 'color_active'=>1, 'size_active'=>1));
                $type_data = $type_datas->result();
                if(!empty($type_data)){
                  if($data->product_view == 3){
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
                  }elseif($data->product_view == 2){
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
              <div class="col-md-3 col-6 productpadding">
                <div class="product">
                  <?if($data->exclusive==1){?><span class="pr_flash">Exclusive</span>
                  <?}
                  $user_id=$this->session->userdata('user_id');
                  if(!empty($user_id)){
                  $wihslist = $this->db->get_where('tbl_wishlist', array('user_id'=> $user_id,'product_id'=> $data->id,'type_id'=> $type_data[0]->id))->result();
                  if(!empty($wihslist)){
                  ?>
                  <span class="htc float-right">
                    <a href="javascript:void(0)" product_id="<?=base64_encode($data->id)?>" type_id="<?=base64_encode($type_data[0]->id)?>" status="remove" onclick="wishlist(this)"><i class="fa fa-heart float-right" style="color:red;"></i></a>
                    </li></span>
                  <?}else{?>
                  <span class="htc float-right">
                    <a href="javascript:void(0)" product_id="<?=base64_encode($data->id)?>" type_id="<?=base64_encode($type_data[0]->id)?>" status="add" onclick="wishlist(this)"><i class="icon-heart float-right" style="color:red;"></i></a>
                    </li></span>
                  <?}}?>
                  <div class="product_img">
                    <a href="<?=base_url()?>Home/product_detail/<?=$data->url?>?type=<?=base64_encode($type_data[0]->id)?>">
                      <img src="<?=base_url().$type_data[0]->image?>" onmouseover="pro_change(this)" onmouseout="pro_default(this)" img="<?=base_url().$type_data[0]->image?>" img2="<?=base_url().$image1?>" alt="">
                    </a>
                    <div class="product_action_box">
                      <ul class="list_none pr_action_btn">
                        <?php $i=1;
                        $size_arr=[];
                         $more=0; foreach($type_datas->result() as $type_size) {
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
                        <li class="add-to-cart"><a href="<?=base_url()?>Home/product_detail/<?=$data->url?>?type=<?=base64_encode($type_size->id)?>" class="popup-ajax"><?=$size_data->name?></a></li>
                        <?php
                      }}
                      }else{$more++;}$i++;  }
                      // print_r($size_arr);die();
                        if($more > 0){
                          if(!empty($size_data)){
                      ?>
                        <li><a href="<?=base_url()?>Home/product_detail/<?=$data->url?>?type=<?=base64_encode($type_data[0]->id)?>" class="popup-ajax" style="background:transparent; color:white;">+<?=$more?></a></li>
                        <?}
                      }?>
                      </ul>
                    </div>
                  </div>
                  <div class="product_info">
                    <h6 class="product_title"><a href="<?=base_url()?>Home/product_detail/<?=$data->url?>?type=<?=base64_encode($type_data[0]->id)?>"><?=$data->name?></a></h6>
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
                    <div class="pr_desc">
                      <p><?=$data->description?></p>
                    </div>
                  </div>
                </div>
              </div>
              <?}
            }?>
            </div>
            <?}else{?>
              <div>

              </div>
              <?}?>
          </div>
          <div class="row">
            <div class="col-12">
              <?php echo $links; ?>
            </div>
          </div>
        </div>

        <div class="col-lg-2 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0 desktopfilterlist" style="padding-left: 40px;">
          <form action="<?=base_url()?>Home/apply_filter" id="applyFilter" method="get" enctype="multipart/form-data">
            <div class="sidebar" style="position: sticky;top: 20%;">

              <div class="widget">
                <div class="row" style="height: 20px;">
                  <h6 class="widget_title mt-1 pl-3">Refine By</h6>
                  <p style="margin-left: 20px;font-size: 13px;"> <span style="border-right: 1px solid grey; cursor: pointer" onclick="clearAllFilters()"> Clear All </span> &nbsp;<span style="cursor: pointer;" onclick="submitFilters()">Apply</span>
                  </p>

                </div>
                <div id="accordion" class="accordion accordion_style1 mt-3">

                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h6 class="mb-0"> <a class="collapsed fontweidth" data-toggle="collapse" href="#collapseOne" aria-controls="collapseOne" aria-expanded="false">Price</a> </h6>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body p-0">
                        <p style="text-align: end;font-size: 12px;margin-bottom: 0px;cursor: pointer;" class="pb-2" onclick="priceReset()"> RESET</p>
                        <div class="filter_price" style="padding: 0px 25px;">
                          <div id="price_filter" data-min="0" data-max="3017" data-min-value="500" data-max-value="2000" data-price-sign="₹"></div>
                          <div class="price_range">
                            <span> <span id="flt_price"></span></span>
                            <input type="hidden" id="price_first" name="minprice">
                            <input type="hidden" id="price_second" name="maxprice">
                            <input type="hidden" id="sort_by" name="sort_by" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!--  -->
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h6 class="mb-0"> <a class="collapsed fontweidth" data-toggle="collapse" href="#collapseSec" aria-expanded="false" aria-controls="collapseSec">Size</a> </h6>
                    </div>
                    <div id="collapseSec" class="collapse scrollbarr " aria-labelledby="headingOne" data-parent="#accordion" style="max-height:11rem;overflow-y: scroll;">
                      <div class="card-body">
                        <div class="row float-right mr-2">
                          <p style="font-size: 12px;margin-bottom: 0px;cursor: pointer;" class="mr-1" onclick="selectSize()"> Select All |</p>
                          <p style="font-size: 12px;margin-bottom: 0px;cursor: pointer;" onclick="clearSize()">Clear All</p>
                        </div>
                        <ul class="list_brand mt-4">
                          <?foreach($filter_size->result() as $size_filter){
                            foreach ($product as $pro ) {
                              $check = $this->db->get_where('tbl_type', array('size_id'=> $size_filter->id,'product_id'=>$pro->id))->result();
                                if(!empty($check)){
                                  break;
                                }
                            }
                            if(!empty($check)){
                            ?>
                          <li>
                            <div class="custome-checkbox">
                              <input class="form-check-input sizeCheck" type="checkbox" id="s<?=$size_filter->id?>" name="size[]" value="<?=$size_filter->id?>">
                              <label class="form-check-label" for="s<?=$size_filter->id?>"><span><?=$size_filter->name?></span></label>
                            </div>
                          </li>
                          <?}}?>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" value="<?=$url?>" name="url" />
                  <div class="card">
                    <div class="card-header" id="headingThree">
                      <h6 class="mb-0"> <a class="collapsed fontweidth" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseSec">Colors</a> </h6>
                    </div>
                    <div id="collapseThree" class="collapse scrollbarr " aria-labelledby="headingThree" data-parent="#accordion" style="max-height:11rem;overflow-y: scroll;">
                      <div class="card-body">
                        <div class="row float-right mr-2">
                          <p style="font-size: 12px;margin-bottom: 0px;cursor: pointer;" class="mr-1" onclick="selectColor()"> Select All |</p>
                          <p style="font-size: 12px;margin-bottom: 0px;cursor: pointer;" onclick="clearColor()">Clear All</p>
                        </div>
                        <ul class="list_brand product_color_switch mt-4">
                          <?foreach($filter_color->result() as $olor_filter){
                            foreach ($product as $pro ) {
                              $check = $this->db->get_where('tbl_type', array('colour_id'=> $olor_filter->id,'product_id'=>$pro->id))->result();
                                if(!empty($check)){
                                  break;
                                }
                            }
                            if(!empty($check)){
                            ?>
                          <li>
                            <div class="custome-checkbox colorcheckboxess">
                              <input class="form-check-input colorCheck" type="checkbox" id="c<?=$olor_filter->id?>" name="color[]" value="<?=$olor_filter->id?>">
                              <label class="form-check-label colorcheckboxes" for="c<?=$olor_filter->id?>"><span data-color="<?=$olor_filter->name?>" class="colorspann"></span>
                              <span style="width:100px;height:auto;font-size:14px;vertical-align:top;"><?=$olor_filter->colour_name?> </span>
                           </label>
                            </div>

                          </li>
                          <?}}?>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <!--  -->

                  <?foreach($filter_main->result() as $filter){
                    if($t==1){
                      $column = 'category_id';
                    }else{
                      $column = 'subcategory_id';
                    }
                    $check = $this->db->get_where('tbl_product', array("(JSON_CONTAINS(all_filters,'[\"$filter->id\"]')) > "=> 0,$column=> $id))->result();
                    if(!empty($check)){
                    ?>
                  <div class="card">
                    <div class="card-header" id="headingFour">
                      <h6 class="mb-0"> <a class="collapsed fontweidth" data-toggle="collapse" href="#collapse<?=$filter->id?>" aria-expanded="false" aria-controls="collapseFour"><?=$filter->name?></a> </h6>
                    </div>
                    <div id="collapse<?=$filter->id?>" class="collapse scrollbarr" aria-labelledby="headingThree" data-parent="#accordion" style="max-height:11rem;overflow-y: scroll;">
                      <div class="card-body">
                        <div class="row float-right mr-2">
                          <p style="font-size: 12px;margin-bottom: 0px;cursor: pointer;" class="mr-1" onclick="selectAttribute(<?=$filter->id?>)"> Select All |</p>
                          <p style="font-size: 12px;margin-bottom: 0px;cursor: pointer;" onclick="removeAttributes(<?=$filter->id?>)">Clear All</p>
                        </div>
                        <ul class="list_brand mt-4">
                          <?$attributes = $this->db->get_where('tbl_attribute', array('filter_id = ' => $filter->id));
                        foreach($attributes->result() as $attr){
                          if($t==1){
                            $column = 'category_id';
                          }else{
                            $column = 'subcategory_id';
                          }
                          $check2 = $this->db->get_where('tbl_product', array("(JSON_CONTAINS(all_attributes,'[\"$attr->id\"]')) > "=> 0,$column=> $id))->result();
                          if(!empty($check2)){
                        ?>
                          <li>
                            <div class="custome-checkbox">
                              <input class="form-check-input attribute<?=$filter->id?>" type="checkbox" name="attribute[]" id="f<?=$attr->id?>" value="<?=$attr->id?>">
                              <label class="form-check-label" for="f<?=$attr->id?>" style="width:auto;height:auto;font-size:14px;vertical-align:top;"><span><?=$attr->name?></span></label>


                            </div>

                          </li>
                          <?}}?>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <?}}?>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- END SECTION SHOP -->


  <!-- ============================================= START  BOTTOM FILTER ============================================= -->
  <div class="modal subscribe_popup" id="filter" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 100321;overflow: hidden;">
    <div class="modal-dialog modal-lg modal-dialog-top m-0" role="document" style="max-width: 100%;">
      <div class="modal-content" style="top: 0;">
        <div class="modal-body text-center">
          <h6 style="padding-top: 10px;background: rgb(253, 250, 250);font-size: 12px;padding-bottom: 15px;">FILTER</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
          </button>
          <div class="row no-gutters">
            <div class="col-sm-12" style="margin-top:-15px;">
              <div class="popup_content" style="padding: 0px 20px ;">
                <div class="row mt-2">
                  <div class="col-6">
                    <a href="javascript:void(0);" onclick="clearAllFilters()" class="btn">CLEAR ALL</a>
                  </div>
                  <div class="col-6" style="background: rgb(253, 250, 250);">
                    <a href="javascript:;" onclick="submitMOB()" class="btn">APPLY</a>
                  </div>
                </div>

                <form action="<?=base_url()?>Home/apply_filter" id="applyFilteronMobile" method="get" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-4" style="border-right: 2px solid rgb(240, 238, 238); min-height: 100vh;">
                      <ul class="nav nav-tabs visitedcolor" role="tablist" style="display: block; border-bottom: 0px;">
                        <li class="nav-item p-2">
                          <a class="nav-link active" id="price-tab" data-toggle="tab" href="#price" role="tab" aria-controls="price" aria-selected="true">Price</a>
                        </li>
                        <input type="hidden" value="<?=$url?>" name="url" />
                        <li class="nav-item p-2">
                          <a class="nav-link" id="size-tab" data-toggle="tab" href="#size" role="tab" aria-controls="size" aria-selected="false">Size</a>
                        </li>

                        <li class="nav-item p-2">
                          <a class="nav-link" id="color-tab" data-toggle="tab" href="#color" role="tab" aria-controls="color" aria-selected="false">Color</a>
                        </li>
                        <?foreach($filter_main->result() as $filter){?>
                        <li class="nav-item p-2">
                          <a class="nav-link" id="tab<?=$filter->id?>" data-toggle="tab" href="#tog<?=$filter->id?>" role="tab" aria-controls="tog<?=$filter->id?>" aria-selected="false"><?=$filter->name?></a>
                        </li>
                        <?}?>
                      </ul>
                    </div>
                    <div class="col-8">
                      <div class="tab-content shop_info_tab" style="margin-top:5px;">
                        <div class="tab-pane show active" id="price" role="tabpanel" aria-labelledby="price-tab">
                          <div class="row justify-content-end">
                            <div class="col-4 mb-2">
                              <button style="background:transparent;border: none; color: #FF324D;font-size: 14px;" onclick="priceReset()">RESET</button>
                            </div>
                          </div>
                          <div class="filter_price">
                            <div id="price_filter22" class="reset-price" data-min="0" data-max="5000" data-min-value="1000" data-max-value="2500" data-price-sign="₹"></div>
                            <div class="price_range">
                              <span> <span id="flt_price22"></span></span>
                              <input type="hidden" id="price_first22" name="minprice">
                              <input type="hidden" id="price_second22" name="maxprice">
                              <input type="hidden" id="sort_byWeb" name="sort_by" />
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="size" role="tabpanel" aria-labelledby="size-tab">
                          <div class="row float-right mr-2" style="margin-top:-20px;">
                            <p style="font-size: 12px;margin-bottom: 0px;cursor: pointer;" class="mr-1" onclick="selectSize()"> Select All |</p>
                            <p style="font-size: 12px;margin-bottom: 0px;cursor: pointer;" onclick="clearSize()">Clear All</p>
                          </div>
                          <ul class="list_brand mt-4" style="text-align: left;max-height:87vh;overflow:auto;">
                            <?foreach($filter_size->result() as $size_filter){
                              foreach ($product as $pro ) {
                              $check = $this->db->get_where('tbl_type', array('size_id'=> $size_filter->id,'product_id'=>$pro->id))->result();
                                if(!empty($check)){
                                  break;
                                }
                            }
                            if(!empty($check)){
                              ?>
                            <li>
                              <div class="custome-checkbox">
                                <input class="form-check-input sizeCheck" type="checkbox" name="size[]" id="size<?=$size_filter->id?>" value="<?=$size_filter->id?>">
                                <label class="form-check-label" for="size<?=$size_filter->id?>"><span><?=$size_filter->name?></span></label>
                              </div>
                            </li>
                            <?}}?>
                          </ul>
                        </div>
                        <div class="tab-pane fade" id="color" role="tabpanel" aria-labelledby="color-tab">
                          <div class="row float-right mr-2" style="margin-top:-25px;">
                            <p style="font-size: 12px;margin-bottom: 0px;cursor: pointer;" class="mr-1" onclick="selectColor()"> Select All |</p>
                            <p style="font-size: 12px;margin-bottom: 0px;cursor: pointer;" onclick="clearColor()">Clear All</p>
                          </div>
                          <ul class="list_brand product_color_switch mt-4" style="text-align: left;max-height:82vh;overflow:auto;">
                            <?foreach($filter_color->result() as $olor_filter){
                              foreach ($product as $pro ) {
                            $check = $this->db->get_where('tbl_type', array('colour_id'=> $olor_filter->id,'product_id'=>$pro->id))->result();
                              if(!empty($check)){
                                break;
                              }
                          }
                          if(!empty($check)){
                              ?>
                            <li>
                              <div class="custome-checkbox">
                                <input class="form-check-input colorCheck" type="checkbox" name="color[]" id="color<?=$olor_filter->id?>" value="<?=$olor_filter->id?>">
                                <label class="form-check-label" for="color<?=$olor_filter->id?>"> <span data-color="<?=$olor_filter->name?>"></span>
                                <?=$olor_filter->colour_name?></label>
                              </div>
                            </li>
                            <?}}?>
                          </ul>

                        </div>

                        <?foreach($filter_main->result() as $filter){
                          if($t==1){
                            $column = 'category_id';
                          }else{
                            $column = 'subcategory_id';
                          }
                          $check = $this->db->get_where('tbl_product', array("(JSON_CONTAINS(all_filters,'[\"$filter->id\"]')) > "=> 0,$column=> $id))->result();
                          if(!empty($check)){
                          ?>
                        <div class="tab-pane fade" id="tog<?=$filter->id?>" role="tabpanel" aria-labelledby="<?=$filter->id?>-tab">
                          <div class="row float-right mr-2" style="margin-top:-30px;">
                            <p style="font-size: 12px;margin-bottom: 0px;cursor: pointer;" class="mr-1" onclick="selectAttribute(<?=$filter->id?>)"> Select All |</p>
                            <p style="font-size: 12px;margin-bottom: 0px;cursor: pointer;" onclick="removeAttributes(<?=$filter->id?>)">Clear All</p>
                          </div>
                          <ul class="list_brand scrollbarr mt-5" style="text-align: left;max-height:80vh;overflow:auto;">
                            <?$attributes = $this->db->get_where('tbl_attribute', array('filter_id = ' => $filter->id));
                          foreach($attributes->result() as $attr){
                            if($t==1){
                            $column = 'category_id';
                          }else{
                            $column = 'subcategory_id';
                          }
                            $check2 = $this->db->get_where('tbl_product', array("(JSON_CONTAINS(all_attributes,'[\"$attr->id\"]')) > "=> 0,$column=> $id))->result();
                            if(!empty($check2)){
                          ?>
                            <li>
                              <div class="custome-checkbox">
                                <input class="form-check-input attribute<?=$filter->id?>" type="checkbox" name="attribute[]" id="attr<?=$attr->id?>" value="<?=$attr->id?>">
                                <label class="form-check-label" for="attr<?=$attr->id?>"><span><?=$attr->name?></span></label>
                              </div>
                            </li>
                            <?}}?>
                          </ul>
                        </div>
                        <?}}?>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ============================================= END BOTTOM FILTER ============================================= -->
  <!-- ============================================= START BOTTOM SORT BY ============================================= -->
  <div class="modal subscribe_popup" id="sortby" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg  m-0 modal-dialog12" role="document" style="width: 100%; min-width: -webkit-fill-available;">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
          </button>
          <div class="row no-gutters">
            <div class="col-sm-12">
              <div class="popup_content">
                <div class="popup-text">
                  <div class="heading_s1">
                    <h6>SORT BY</h6>
                  </div>
                </div>
                <ul style="list-style-type: none;">
                  <li style="padding:15px 0px; border-bottom: 2px solid rgb(235, 232, 232);"> <a href="javascript:;" onclick="soryBy('ASC')">Sort by price: Low to High</a></li>
                  <li style="padding:15px 0px; border-bottom: 2px solid rgb(235, 232, 232);"> <a href="javascript:;" onclick="soryBy('DESC')">Sort by price: High to Low</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ============================================= END BOTTOM SORT BY ============================================= -->


  <!-- ============================================= START BOTTOM BAR ============================================= -->
  <div class="container-fluid mobilefilter" style="position: sticky; bottom: 0; background: #fff;z-index:9999;">
    <div class="row text-center">
      <div class="col-6 p-2" style="border-right: 2px solid #dee2e6 ;">
        <a href="#" data-target="#sortby" data-toggle="modal" data-bs-dismiss="modal"> <img src="<?=base_url()?>assets\frontend\images\sort.png"> SORT BY</a>
      </div>
      <div class="col-6 p-2">
        <a href="#" data-target="#filter" data-toggle="modal" data-bs-dismiss="modal"> <img src="<?=base_url()?>assets\frontend\images\filter.png"> FILTER</a>
      </div>
    </div>
  </div>
  <!-- ============================================= END BOTTOM BAR ============================================= -->


</div>
<!-- END MAIN CONTENT -->
<script>
  function submitFilters() {
    document.getElementById("applyFilter").submit();
  }

  function submitMOB() {
    document.getElementById("applyFilteronMobile").submit();
  }

  function soryBy(sort) {
    if (sort == "ASC") {
      $('#sort_by').val('ASC')
      $('#sort_byWeb').val('ASC')
    } else {
      $('#sort_by').val('DESC')
      $('#sort_byWeb').val('DESC')
    }
    var width = screen.availWidth
    if(width > 446){
      submitFilters()
    }else{
      submitMOB()
    }
  }

  function selectAllFilters() {
    $('.form-check-input').attr("checked", "true")
  }

  function clearAllFilters() {
    $('.form-check-input').prop("checked", false)
  }

  function selectAttribute(i) {
    $('.attribute' + i).prop("checked", true)
  }
function removeAttributes(i){
  $('.attribute'+i).prop("checked", false)
}

  function LASTaTTR(i) {
    $('.attribute' + i).prop("checked", true)
  }

  function selectColor() {
    $('.colorCheck').prop("checked", true)
  }

  function clearColor() {
    $('.colorCheck').prop("checked", false)
  }



  function selectSize() {
    $('.sizeCheck').prop("checked", true)
  }

  function clearSize() {
    $('.sizeCheck').prop("checked", false)
  }

  function priceReset() {
    $('.reset-price').prop("data-min-value", "false")
    $('.reset-price').prop("data-max-value", "false")
  }
</script>
