<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Update Type <?=$productName?>
      <?=$productView?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="<?php echo base_url() ?>dcadmin/Type/view_type/<?=$id?>"><i class="fa fa-undo" aria-hidden="true"></i> View Type </a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update type</h3>
          </div>

          <?php if (!empty($this->session->flashdata('smessage'))) { ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <?php echo $this->session->flashdata('smessage'); ?>
          </div>
          <?php }
                                       if (!empty($this->session->flashdata('emessage'))) { ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            <?php echo $this->session->flashdata('emessage'); ?>
          </div>
          <?php } ?>


          <div class="panel-body">
            <div class="col-lg-10">
              <form action="<?php echo base_url() ?>dcadmin/type/add_type_data/<?php echo base64_encode(2); ?>/<?=$id?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <input type="hidden" name="product_id" value="<?=base64_encode($type->product_id)?>">
                    <!-- <tr>
                      <td> <strong>Name</strong> <span style="color:red;"></span></strong> </td>
                      <td>
                        <input type="text" name="name" class="form-control" placeholder="" value="<?=$type->name?>" />
                      </td>
                    </tr> -->
                    <tr>
                      <td><strong>Size</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="size_id" id="size_id" class="form-control" required>
                          <option value="">----select size------</option>
                          <?php $i=1; foreach ($size_data->result() as $size) { ?>
                          <option value="<?=$size->id?>" <?if ($size->id==$type->size_id) {
                                           echo "selected";
                                       }?>><?=$size->name?></option>
                          <?php $i++; } ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td><strong>Colour</strong> <span style="color:red;"></span></strong> </td>
                      <td>
                        <select name="colour_id" id="colour_id" class="form-control">
                          <option value="">----select colour------</option>
                          <?php $i=1; foreach ($colour_data->result() as $colour) { ?>
                          <option value="<?=$colour->id?>" <?if ($colour->id==$type->colour_id) {
                                           echo "selected";
                                       }?>><?=$colour->colour_name?></option>
                          <?php $i++; } ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Image</strong> <span style="color:red;"><br />Size: 640px X 960px</span></strong> </td>
                      <td>
                        <input type="file" name="image" class="form-control" placeholder="" />
                        <?if (!empty($type->image)) {?>
                        <img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$type->image?>">
                        <?} else {?>
                        Sorry No image Found
                        <?}?>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Image2</strong> <span style="color:red;"><br />Size: 640px X 960px</span></strong> </td>
                      <td>
                        <input type="file" name="image2" class="form-control" placeholder="" />
                        <?if (!empty($type->image2)) {?>
                        <img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$type->image2?>">
                        <?} else {?>
                        Sorry No image Found
                        <?}?>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Image3</strong> <span style="color:red;"><br />Size: 640px X 960px</span></strong> </td>
                      <td>
                        <input type="file" name="image3" class="form-control" placeholder="" />
                        <?if (!empty($type->image3)) {?>
                        <img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$type->image3?>">
                        <?} else {?>
                        Sorry No image Found
                        <?}?>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Image4</strong> <span style="color:red;"><br />Size: 640px X 960px</span></strong> </td>
                      <td>
                        <input type="file" name="image4" class="form-control" placeholder="" />
                        <?if (!empty($type->image4)) {?>
                        <img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$type->image4?>">
                        <?} else {?>
                        Sorry No image Found
                        <?}?>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Image5</strong> <span style="color:red;"><br />Size: 640px X 960px</span></strong> </td>
                      <td>
                        <input type="file" name="image5" class="form-control" placeholder="" />
                        <?if (!empty($type->image5)) {?>
                        <img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$type->image5?>">
                        <?} else {?>
                        Sorry No image Found
                        <?}?>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Image6</strong> <span style="color:red;"><br />Size: 640px X 960px</span></strong> </td>
                      <td>
                        <input type="file" name="image6" class="form-control" placeholder="" />
                        <?if (!empty($type->image6)) {?>
                        <img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$type->image6?>">
                        <?} else {?>
                        Sorry No image Found
                        <?}?>
                      </td>
                    </tr>
                    <?if($productView==1 || $productView==3){
                      ?>
                    <tr>
                      <td> <strong>Retailer MRP</strong> <span style="color:red;"></span></strong> </td>
                      <td>
                        <input type="text" id="mrp" name="mrp" class="form-control" placeholder="" onkeypress="return isNumberKey(event)" required value="<?=$type->retailer_mrp?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Retailer Selling Price</strong> <span style="color:red;"></span></strong> </td>
                      <td>
                        <input type="text" name="sp" id="sp" class="form-control" placeholder="" onkeypress="return isNumberKey(event)" required value="<?=$type->retailer_sp?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Retailer GST(%)</strong> <span style="color:red;"></span></strong> </td>
                      <td>
                        <input type="text" name="gst" id="gst" class="form-control" onkeypress="return isNumberKey(event)" placeholder="" required value="<?=$type->retailer_gst?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Retailer Selling price with(GST)</strong> <span style="color:red;"></span></strong> </td>
                      <td>
                        <input type="text" onkeypress="return isNumberKey(event)" readonly id="spgst" name="spgst" class="form-control" placeholder="" required value="<?=$type->retailer_spgst?>" />
                      </td>
                    </tr>
                    <?}?>
                    <?if($productView==2 || $productView==3){?>
                      <tr>
                        <td> <strong>Reseller MRP</strong> <span style="color:red;"></span></strong> </td>
                        <td>
                          <input type="text" id="re_mrp" name="re_mrp" class="form-control" placeholder="" onkeypress="return isNumberKey(event)" required value="<?=$type->reseller_mrp?>" />
                        </td>
                      </tr>
                      <tr>
                        <td> <strong>Reseller Selling Price</strong> <span style="color:red;"></span></strong> </td>
                        <td>
                          <input type="text" name="re_sp" id="re_sp" class="form-control" placeholder="" onkeypress="return isNumberKey(event)" required value="<?=$type->reseller_sp?>" />
                        </td>
                      </tr>
                      <tr>
                        <td> <strong>Reseller GST(%)</strong> <span style="color:red;"></span></strong> </td>
                        <td>
                          <input type="text" name="re_gst" id="re_gst" class="form-control" onkeypress="return isNumberKey(event)" placeholder="" required value="<?=$type->reseller_gst?>" />
                        </td>
                      </tr>
                      <tr>
                        <td> <strong>Reseller Selling price with(GST)</strong> <span style="color:red;"></span></strong> </td>
                        <td>
                          <input type="text" onkeypress="return isNumberKey(event)" readonly id="re_spgst" name="re_spgst" class="form-control" placeholder="" required value="<?=$type->reseller_spgst?>" />
                        </td>
                      </tr>
                    <tr>
                      <td> <strong>Reseller Minimum Quantity</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" onkeypress="return isNumberKey(event)" name="reseller_min_qty" class="form-control" placeholder="" required value="<?=$type->reseller_min_qty?>" />
                      </td>
                    </tr>
                    <?}?>
                    <tr>
                      <td> <strong>Inventory</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" onkeypress="return isNumberKey(event)" name="inventory" class="form-control" required placeholder="" value="<?=$type->inventory?>" />
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <input type="submit" class="btn btn-success" value="save">
                      </td>
                    </tr>
                  </table>
                </div>

              </form>

            </div>



          </div>

        </div>

      </div>
    </div>
  </section>
</div>
</script>
<script>
  $(document).ready(function() {
    //   $('#spgst, #mrp').keyup(function(ev) {
    //     var mrp = $('#mrp').val() * 1;
    //     var spgst = $('#spgst').val() * 1;
    //     var gst = ((spgst-mrp) / spgst) * 100;
    //     gst = Math.round(gst)
    //     var sp = mrp + ((spgst-mrp) / spgst);
    //     sp = Math.round(sp)
    //     $("#sp").val(sp)
    //     $("#gst").val(gst)
    //   });
    // });
    $('#gst,#sp').keyup(function(ev) {
      // var mrp = $('#mrp').val() * 1;
      var sp = $('#sp').val() * 1;
      var gst = $('#gst').val() * 1;
      var gst_price = (gst / 100) * sp;
      var spgst = sp + gst_price;
      $("#spgst").val(spgst)
    });
    $('#re_gst,#re_sp').keyup(function(ev) {
      // var mrp = $('#mrp').val() * 1;
      var sp = $('#re_sp').val() * 1;
      var gst = $('#re_gst').val() * 1;
      var gst_price = (gst / 100) * sp;
      var spgst = sp + gst_price;
      $("#re_spgst").val(spgst)
    });
  });
</script>



<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/ajaxupload.3.5.js"></script>
<link href="<?php echo base_url() ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />
