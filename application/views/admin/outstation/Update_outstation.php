<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Update Outstation
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/Outstation/View_outstation"><i class="fa fa-undo" aria-hidden="true"></i> View Outstation </a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update Outstation</h3>
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
              <form action="<?php echo base_url() ?>dcadmin/Outstation/Add_outstation_data/<?php echo base64_encode(2); ?>/<?=$id?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <tr>
                      <td> <strong>City</strong> <span style="color:red;"></span></strong> </td>
                      <td>
                        <select name="city_id" class="form-control" required>
                          <option value="">--- Select City -----</option>
                          <?php $i=1; foreach ($city_data->result() as $city) { ?>
                          <option value="<?=$city->id?>" <?if ($city->id==$station->city_id) {
                            echo 'selected'
                            ;
                            }?>><?=$city->name?></option>
                          <?php $i++; } ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Brand-Name</strong> <span style="color:red;"></span></strong> </td>
                      <td>
                        <input type="text" name="brand_name" class="form-control" placeholder="brand_name" required value="<?=$station->brand_name?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Car-Name</strong> <span style="color:red;"></span></strong> </td>
                      <td>
                        <input type="text" name="car_name" class="form-control" placeholder="car_name" required value="<?=$station->car_name?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Seatting</strong> <span style="color:red;"></span></strong> </td>
                      <td>
                        <input type="text" name="seatting" class="form-control" placeholder="name" required value="<?=$station->seatting?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Rate Per Kilometre</strong> <span style="color:red;"></span></strong> </td>
                      <td>
                        <input type="text" name="per_kilometre" class="form-control" placeholder="name" required value="<?=$station->per_kilometre?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Location</strong> <span style="color:red;"></span></strong> </td>
                      <td>
                        <input type="text" name="location" class="form-control" placeholder="name" required value="<?=$station->location?>" />
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
      $('#change').html('<td><strong>name</strong><span style="color:red;">*</span></strong></td><td><input type="text" name="percentage_amount" class="form-control" placeholder="" required value="<?=$cities->name?>" /></td>');
      $('#change2').html(
        '<td><strong>Maximum discount</strong> <span style="color:red;">*</span></strong> </td><td><input type="text" name="max" class="form-control" placeholder="" required value="<?=$promocode->max?>" onkeypress="return isNumberKey(event)"/></td>'
      );
    } else {
      $('#change').html('<td><strong>Amount</strong><span style="color:red;">*</span></strong></td><td><input type="text" name="percentage_amount" class="form-control" placeholder=""   value="<?=$cities->p?>" /></td>');
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
