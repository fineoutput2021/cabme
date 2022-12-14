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
                      <td> <strong>City</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="city_id" class="form-control" required>
                          <option value="">-----select city-----</option>
                          <?php $i=1; foreach ($cities_data->result() as $cat) { ?>
                          <option value="<?=$cat->id?>"><?=$cat->name?></option>
                          <?php } ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Cab Type</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="cab_type" class="form-control" required>
                          <option value="">---Select Cab Type-----</option>
                          <option value="Hatchback">HATCHBACK</option>
                          <option value="Sedan">SEDAN</option>
                          <option value="SUV">SUV</option>
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
                        <input type="text" id="" name="Kilomitere_cab" onkeypress="return isNumberKey(event)" class="form-control" placeholder="" required value="" />
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
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
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
