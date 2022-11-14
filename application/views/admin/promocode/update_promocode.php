<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Update Promocode
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/Promocode/view_promocode"><i class="fa fa-undo" aria-hidden="true"></i> View Promocode </a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update Promocode</h3>
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
              <form action="<?php echo base_url() ?>dcadmin/Promocode/add_promocode_data/<?php echo base64_encode(2); ?>/<?=$id?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <tr>
                      <td> <strong>Promocode</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="promocode" class="form-control" placeholder="" required value="<?=$promocode->promocode?>" />
                      </td>
                    </tr>
                    <tr id="change">
                      <td> <strong>Percentage</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="percentage" class="form-control" placeholder="" required value="<?=$promocode->percentage?>" onkeypress="return isNumberKey(event)" />
                      </td>
                    </tr>
                    <tr>
                    <tr>
                      <td> <strong>Promocode Type</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select class="form-control" required name="ptype">
                          <!-- <option value="" selected>select type</option> -->
                          <option value="1" <?php if ($promocode->ptype==1) {
    echo "selected";
}?>>One Time</option>
                          <option value="2" <?php if ($promocode->ptype==2) {
    echo "selected";
}?>>Every Time</option>
                        </select>
                      </td>
                      <!-- </tr>
<td> <strong>Gift(%)</strong> <span style="color:red;">*</span></strong> </td>
<td>
<input type="number" name="giftpercent" class="form-control" placeholder="" required value="" />
</td>
</tr> -->
                    <tr>
                      <td> <strong>Start Date</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="date" id="startdate" name="start_date" class="form-control" placeholder="" required value="<?=$promocode->start_date?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>End Date</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="date" id="enddate" name="end_date" class="form-control" placeholder="" required value="<?=$promocode->end_date?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Minimum Booking days</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="mindays" class="form-control" placeholder="" required value="<?=$promocode->mindays?>" onkeypress="return isNumberKey(event)" />
                      </td>
                    </tr>
                    <tr id="change2">
                      <?if ($promocode
) {?>
                      <td> <strong>Maximum discount</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="max" class="form-control" placeholder="" required value="<?=$promocode->max?>" onkeypress="return isNumberKey(event)" />
                      </td>
                      <?}?>
                    </tr>
                    <tr>
                      <td> <strong>Image</strong> <span style="color:red;"><br />Size: 9920px * 992px</span></strong> </td>
                      <td>
                        <input type="file" name="photo" class="form-control" placeholder="" value="<?=$promocode->photo?>" />
                        <?php if ($promocode->photo!="") {  ?>
                        <img id="slide_img_path" height=50 width=100 src="<?php echo base_url().$promocode->photo ?>">
                        <?php } else {  ?>
                        Sorry No image Found
                        <?php } ?>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <input type="submit" class="btn btn-success primary" value="save">
                      </td>
                    </tr>
                  </table>
                </div>
                <style>
                  .primary {
                    background-color: #ff0000;
                  }

                  .primary:hover {
                    background-color: #ff0000 !important;
                  }
                </style>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
  function change(x) {
    if (x == 1) {
      $('#change').html('<td><strong>Percentage</strong><span style="color:red;">*</span></strong></td><td><input type="text" name="percentage_amount" class="form-control" placeholder="" required value="<?=$promocode->percentage_amount?>" /></td>');
      $('#change2').html(
        '<td><strong>Maximum discount</strong> <span style="color:red;">*</span></strong> </td><td><input type="text" name="max" class="form-control" placeholder="" required value="<?=$promocode->max?>" onkeypress="return isNumberKey(event)"/></td>'
      );
    } else {
      $('#change').html('<td><strong>Amount</strong><span style="color:red;">*</span></strong></td><td><input type="text" name="percentage_amount" class="form-control" placeholder=""   value="<?=$promocode->percentage_amount?>" /></td>');
      $('#change2').html('');
    }
  }
</script>
<script>
  $(function() {
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if (month < 10)
      month = '0' + month.toString();
    if (day < 10)
      day = '0' + day.toString();
    var maxDate = year + '-' + month + '-' + day;
    // alert(maxDate);
    $('#startdate').attr('min', maxDate);
    $('#enddate').attr('min', maxDate);
  });
</script>
</script>
<script>
  function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
    return true;
  }
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/ajaxupload.3.5.js"></script>
<link href="<?php echo base_url() ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />
