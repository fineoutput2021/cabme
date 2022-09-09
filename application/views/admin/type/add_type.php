<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Add New Type in <?=$productName?>
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
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Add New Type</h3>
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
              <form action="<?php echo base_url() ?>dcadmin/Type/add_type_data/<?php echo base64_encode(1); ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <input type="hidden" name="product_id" value="<?=$id?>">
                    <tr>
                      <td> <strong>Size</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="size_id" id="size_id" class="form-control" required>
                          <option value="">----select size------</option>
                          <?php $i=1; foreach ($size_data->result() as $size) { ?>
                          <option value="<?=$size->id?>"><?=$size->name?></option>
                          <?php $i++; } ?>
                        </select>

                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Colour</strong> <span style="color:red;"></span></strong> </td>
                      <td>
                        <select name="colour_id" id="colour_id" class="form-control">
                          <option value="">----select colour------</option>
                          <?php $i=1; foreach ($colour_data->result() as $colour) { ?>
                          <option value="<?=$colour->id?>"><?=$colour->colour_name?></option>
                          <?php $i++; } ?>
                        </select>

                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Image</strong> <span style="color:red;">*<br />Size: 640px X 960px</span></strong> </td>
                      <td>
                        <input type="file" name="image" class="form-control" required placeholder="" value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Image2</strong> <span style="color:red;"><br />Size: 640px X 960px</span></strong> </td>
                      <td>
                        <input type="file" name="image2" class="form-control" placeholder="" value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Image3</strong> <span style="color:red;"><br />Size: 640px X 960px</span></strong> </td>
                      <td>
                        <input type="file" name="image3" class="form-control" placeholder="" value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Image4</strong> <span style="color:red;"><br />Size: 640px X 960px</span></strong> </td>
                      <td>
                        <input type="file" name="image4" class="form-control" placeholder="" value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Image5</strong> <span style="color:red;"><br />Size: 640px X 960px</span></strong> </td>
                      <td>
                        <input type="file" name="image5" class="form-control" placeholder="" value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Image6</strong> <span style="color:red;"><br />Size: 640px X 960px</span></strong> </td>
                      <td>
                        <input type="file" name="image6" class="form-control" placeholder="" value="" />
                      </td>
                    </tr>
                    <!-- <tr>
  <td> <strong>Name</strong> <span style="color:red;">*</span></strong> </td>
  <td>
    <input type="text" name="name" class="form-control" placeholder="" required value="" />
  </td>
</tr> -->
              <?if($productView==1 || $productView==3){?>
                    <tr>
                      <td> <strong>Retailer MRP</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="mrp" id="mrp" class="form-control" placeholder="" required value="" onkeypress="return isNumberKey(event)"/>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Retailer Selling Price</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="sp" id="sp" class="form-control" placeholder="" required value="" onkeypress="return isNumberKey(event)"/>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Retailer GST(%)</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="gst" id="gst" class="form-control" placeholder="" required value="" onkeypress="return isNumberKey(event)"/>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Retailer Selling Price with(GST)</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" id="spgst" name="spgst" class="form-control" placeholder="" required value="" onkeypress="return isNumberKey(event)"/>
                      </td>
                    </tr>
                    <?}?>
                    <?if($productView==2 || $productView==3){?>
                      <tr>
                        <td> <strong>Reseller MRP</strong> <span style="color:red;">*</span></strong> </td>
                        <td>
                          <input type="text" name="re_mrp" id="re_mrp" class="form-control" placeholder="" required value="" onkeypress="return isNumberKey(event)"/>
                        </td>
                      </tr>
                      <tr>
                        <td> <strong>Reseller Selling Price</strong> <span style="color:red;">*</span></strong> </td>
                        <td>
                          <input type="text" name="re_sp" id="re_sp" class="form-control" placeholder="" required value="" onkeypress="return isNumberKey(event)"/>
                        </td>
                      </tr>
                      <tr>
                        <td> <strong>Reseller GST(%)</strong> <span style="color:red;">*</span></strong> </td>
                        <td>
                          <input type="text" name="re_gst" id="re_gst" class="form-control" placeholder="" required value="" onkeypress="return isNumberKey(event)"/>
                        </td>
                      </tr>
                      <tr>
                        <td> <strong>Reseller Selling Price with(GST)</strong> <span style="color:red;">*</span></strong> </td>
                        <td>
                          <input type="text" id="re_spgst" name="re_spgst" class="form-control" placeholder="" required value="" onkeypress="return isNumberKey(event)"/>
                        </td>
                      </tr>
                    <tr>
                      <td> <strong>Reseller Minimum Quantity</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="reseller_min_qty" class="form-control" required placeholder="" value="" onkeypress="return isNumberKey(event)"/>
                      </td>
                    </tr>
                    <?}?>
                    <tr>
                      <td> <strong>Inventory</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="inventory" class="form-control" required placeholder="" value="" onkeypress="return isNumberKey(event)"/>
                      </td>
                    </tr>
                    <tr>
                  <td> <strong>Type Code</strong>  <span style="color:red;">*</span></strong> </td>
                  <td> <input type="text" name="t_code"  class="form-control" placeholder="" required value="" />  </td>
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
</script>


<script>
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>

<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/ajaxupload.3.5.js"></script>
<link href="<?php echo base_url() ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />
