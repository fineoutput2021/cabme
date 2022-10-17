<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Update Intercity
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/Intercity/View_intercity"><i class="fa fa-undo" aria-hidden="true"></i> View Intercity </a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Update Intercity</h3>
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
              <form action="<?php echo base_url() ?>dcadmin/Intercity/add_intercity_data/<?php echo base64_encode(2); ?>/<?=$id?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <tr>
                      <td> <strong>City</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="city_id" class="form-control" required>
                          <option value="">--- Select City -----</option>
                          <?php $i=1; foreach ($cities_data->result() as $city) { ?>
                          <option value="<?=$city->id?>" <?if ($city->id==$intercity->city_id) {
                            echo 'selected'
                            ;
                            }?>><?=$city->name?></option>
                          <?php $i++; } ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Cab Type</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="cab_type" class="form-control" required>
                          <option value="">Cab Type</option>
                          <option value="Hatchback" <?if($intercity->cab_type=='Hatchback'){echo 'selected' ;}?>>HATCHBACK</option>
                          <option value="Sedan" <?if($intercity->cab_type=='Sedan'){echo 'selected' ;}?>>SEDAN</option>
                          <option value="XUV" <?if($intercity->cab_type=='XUV'){echo 'selected' ;}?>>XUV</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Price</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="price" class="form-control" onkeypress="return isNumberKey(event)"  placeholder="car_name" required value="<?=$intercity->price?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Kilometer Cap</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="Kilomitere_cab" onkeypress="return isNumberKey(event)"  class="form-control" placeholder="name" required value="<?=$intercity->Kilomitere_cab?>" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Minimum Booking Amount</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="min_amount" onkeypress="return isNumberKey(event)"  class="form-control" placeholder="name" required value="<?=$intercity->min_amount?>" />
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
  function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
    return true;
  }
</script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/ajaxupload.3.5.js"></script>
<link href="<?php echo base_url() ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />
