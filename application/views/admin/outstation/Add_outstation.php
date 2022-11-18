<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Add New Outstation
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/Outstation/View_outstation"><i class="fa fa-undo" aria-hidden="true"></i></i> View Outstation </a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Add New Outstation</h3>
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
              <form action="<?php echo base_url() ?>dcadmin/Outstation/Add_outstation_data/<?php echo base64_encode(1); ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <tr>
                      <td> <strong>City</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="city_id" class="form-control" required>
                          <option value="">--- Select City -----</option>
                          <?php $i=1; foreach ($city_data->result() as $city) {
                            if($city->ot_city_type==0){
                            $type= 'None';
                          }else if($city->ot_city_type==1){
                          $type= 'One Way';
                          }else if($city->ot_city_type==2){
                            $type= 'Round Trip';
                          }
                             ?>
                          <option value="<?=$city->id?>"><?=$city->name?> (<?=$type?>)</option>
                          <?php $i++; } ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Brand-Name</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="brand_name" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Car-Name</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="car_name" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Seating Capacity</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="seatting" class="form-control" required>
                          <option value="">Seating</option>
                          <option value="1">4 Seater</option>
                          <option value="2">5 Seater</option>
                          <option value="3">7 Seater</option>
                        </select>
                      </td>
                    </tr>
                    </tr>
                    <tr>
                      <td> <strong>Image</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="file" name="photo" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Rate Per Kilometer</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="per_kilometre" onkeypress="return isNumberKey(event)" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Location</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="location" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Minimum Booking Amount</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" id="" name="min_amount" onkeypress="return isNumberKey(event)" class="form-control" placeholder="" required value="" />
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
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>assets/size/ajaxupload.3.5.js"></script>
<link href="<?php echo base_url() ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />
<script>
  function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
    return true;
  }
</script>
