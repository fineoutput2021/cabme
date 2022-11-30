<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Add self_drive
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url() ?>dcadmin/Home"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url() ?>dcadmin/Self_drive/view_selfdrive"><i class="fa fa-undo" aria-hidden="true"></i></i> View Self-drive </a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Add Self-drive</h3>
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
              <form action="<?php echo base_url() ?>dcadmin/Self_drive/add_selfdrive_data/<?php echo base64_encode(1); ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
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
                      <td> <strong>Brand name</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                      <select name="brand_name" class="form-control" required>
                          <option value="Maruti Suzuki">Maruti Suzuki</option>
                          <option value="Mahindra">Mahindra</option>
                          <option value="Chervolet">Chervolet</option>
                          <option value="Tata">Tata</option>
                        </select>
                        <!-- <input type="text" name="brand_name" class="form-control" placeholder="" required value="" /> -->
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Car name</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="car_name" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Image</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="file" name="photo" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Fuel-type</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="fule_type" class="form-control" required>
                          <option value="">Fuel Type</option>
                          <option value="1">Petrol</option>
                          <option value="2">Diesel</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Transmission</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="transmission" class="form-control" required>
                          <option value="">Transmission</option>
                          <option value="1 ">Manual </option>
                          <option value="2  ">Automatic </option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Seating Capacity</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <select name="seatting" class="form-control" required>
                          <option value="">Seating</option>
                          <option value="1">5 Seater</option>
                          <option value="2">7 Seater</option>
                          <option value="3">9 Seater</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Kilometer1</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="kilometer1" onkeypress="return isNumberKey(event)" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Price1</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="price1" onkeypress="return isNumberKey(event)" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Kilometer2</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="kilometer2" onkeypress="return isNumberKey(event)" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Price2</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="price2"  onkeypress="return isNumberKey(event)" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Kilometre3</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="kilometer3" onkeypress="return isNumberKey(event)" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Price3</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="price3"  onkeypress="return isNumberKey(event)" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Extra_kilomerter</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="extra_kilo"  onkeypress="return isNumberKey(event)" class="form-control" placeholder="" required value="" />
                      </td>
                    </tr>
                    <tr>
                      <td> <strong>Refundable Security Deposit Amount</strong> <span style="color:red;">*</span></strong> </td>
                      <td>
                        <input type="text" name="rsda" onkeypress="return isNumberKey(event)" class="form-control" placeholder="" required value="" />
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
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>
