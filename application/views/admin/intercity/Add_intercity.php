<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Add New intercity
    </h1>
    <style>
      .btn-success {
        background-color: red;
        border-color: red;
      }

      .btn-success:hover {
        background-color: red;
        border-color: red;
      }
    </style>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/Intercity/View_intercity"><i class="fa fa-undo" aria-hidden="true"></i> View intercity </a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Add New intercity</h3>
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
              <form action="<?php echo base_url() ?>dcadmin/Intercity/add_intercity_data/<?php echo base64_encode(1); ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <tr>
                      <td> <strong>Cab Type</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="cab_type" class="form-control" required>
                          <option value="">---Select Cab Type-----</option>
                          <option value="1">HATCHBACK</option>
                          <option value="2">SEDAN</option>
                          <option value="3">SUV</option>

                          
                        </select>
                      </td>
                    </tr>
                    <tr id="change">
                      <td> <strong>price</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="price" class="form-control" placeholder="" required value="" onkeypress="return isNumberKey(event)" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Kilomitere</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" id="" name="Kilomitere_cab" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Mini_Amout_Booking</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" id="" name="min_amount" class="form-control" placeholder="" required value="" />
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
<script>
  function change(x) {
    if (x == 1) {
      $('#change').html('<td><strong>Percentage</strong><span style="color:red;">*</span></strong></td><td><input type="text" name="percentage_amount" class="form-control" placeholder="" required value="" /></td>');
      $('#change2').html('<td><strong>Maximum discount</strong> <span style="color:red;">*</span></strong> </td><td><input type="text" name="max" class="form-control" placeholder="" required value="" onkeypress="return isNumberKey(event)"/></td>');
    } else {
      $('#change').html('<td><strong>Amount</strong><span style="color:red;">*</span></strong></td><td><input type="text" name="percentage_amount" class="form-control" placeholder=""   value="" /></td>');
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